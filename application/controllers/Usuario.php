<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->load->model('PessoaMDL', 'pessoamdl');
        $this->load->model('TipoPermicaoMDL', 'tipoPermicaomdl');
        $this->load->model('PermicaoMDL', 'permicaomdl');
    }

    public function index($indice = null)
    {
        $data = array(
            'titulo' => "Iniciar Sessão",
            'menu' => "Login",
            'submenu' => "",
            'tipo' => "login"
        );
        $this->load->view('templates/header', $data);
        if ($indice != null) {
            $data2['msg'] = null;

            if ($indice == 1) {
                $data2['msg'] = "Deve Iniciar primeiro a sessão";
                $this->load->view('msg/info', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Nome de usuário ou Palavra Passe incorrectos";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 3) {
                $data2['msg'] = "Usuário sem acesso, bloqueado!";
                $this->load->view('msg/info', $data2);
            }
        }
        $this->load->view('usuario/login');
        $this->load->view('templates/footer');
    }

    public function logar()
    {
        $this->form_validation->set_rules("usuario", null, "required");
        $this->form_validation->set_rules("palavra_passe", null, "required");
        if ($this->form_validation->run()) {
            $form_data = array(
                'nome_usuario' => $this->input->post('usuario'),
                'palavra_passe' => $this->input->post('palavra_passe')
            );
            $retorno = $this->usuariomdl->verificar($form_data);
            if ($retorno['row_count'] <= 0) {
                redirect(base_url() . "usuario/2");
            } elseif ($retorno['row_count'] >= 1) {
                foreach ($retorno['dataset'] as $usuario) {
                    $retorno3 = $this->permicaomdl->verificar(array('id_usuario' => $usuario->id_usuario));

                    $session_data = array(
                        'id_usuarioDB' => $usuario->id_usuario,
                        'nomeDB' => $usuario->nome,
                        'nome_usuarioDB' => $usuario->nome_usuario,
                        'estado_usuarioDB' => $usuario->estado_usuario,
                        'logado' => null
                    );


                    foreach ($retorno3['dataset'] as $permissao) {
                        $this->session->set_userdata("{$permissao->descricao_permicao}", 'on');
                    }
                }

                if ($session_data['estado_usuarioDB'] == "off") {
                    redirect(base_url() . "usuario/3");
                } elseif ($session_data['estado_usuarioDB'] == "on") {
                    $session_data['logado'] = true;
                    $this->session->set_userdata($session_data);

                    redirect(base_url() . "home");
                }
            }
        } else {
            $this->index();
        }
    }

    public function terminar_sessao()
    {
        if ($this->session->has_userdata('logado')) {
            $this->session->set_userdata('logado', false);
            $this->session->sess_destroy();
            redirect(base_url() . "usuario");
        }
    }

    public function listar()
    {
        $this->usuariomdl->nao_logado();
        $data = array(
            'titulo' => "Usuários",
            'menu' => "Usuários",
            'submenu' => "Listar",
            'tipo' => "view"
        );
        $this->load->view('templates/header', $data);
        $this->load->view('usuario/list');
        $this->load->view('templates/footer');

    }

    public function novo($indice = null)
    {
        $this->usuariomdl->nao_logado();
        $data = array(
            'titulo' => "Usuários",
            'menu' => "Usuários",
            'submenu' => "Novo",
            'tipo' => "form"
        );
        $this->load->view('templates/header', $data);
        if ($indice != null) {
            if ($indice == 1) {
                $data2['msg'] = "Nº do Bilhete existente";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Feito com sucesso";
                $this->load->view('msg/success', $data2);
            }
        }
        $this->load->view('usuario/new');
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $this->usuariomdl->nao_logado();
        $this->form_validation->set_rules("bi", null, "required");
        $this->form_validation->set_rules("nome", null, "required");
        $this->form_validation->set_rules("genero", null, "required");
        $this->form_validation->set_rules("data_nascimento", null, "required");
        $this->form_validation->set_rules("usuario", null, "required");
        $this->form_validation->set_rules("estado", null, "required");

        if ($this->form_validation->run() == false) {
            $this->novo();
        } elseif ($this->form_validation->run() == true) {
            $data_pessoa = array(
                'bi' => $this->input->post('bi'),
                'nome' => $this->input->post('nome'),
                'genero' => $this->input->post('genero'),
                'data_nascimento' => $this->input->post('data_nascimento'),
                'data_cadastro' => date('Y-m-d')

            );

            $data_usuario = array(
                'id_pessoa' => null,
                'nome_usuario' => $this->input->post('usuario'),
                'palavra_passe' => $this->input->post('bi'),
                'estado_usuario' => $this->input->post('estado')
            );

            $retorno = $this->pessoamdl->verificar_BI($data_pessoa['bi']);
            if ($retorno['row_count'] >= 1) {
                redirect(base_url() . "usuario/novo/1");
            } elseif ($retorno['row_count'] <= 0) {
                $retorno1 = $this->pessoamdl->salvar($data_pessoa);
                if ($retorno1['id'] > 0) {
                    $data_usuario['id_pessoa'] = $retorno1['id'];
                    $retorno2 = $this->usuariomdl->salvar($data_usuario);
                    if ($retorno2['id'] > 0) {
                        redirect(base_url() . "usuario/novo/2");
                    }
                }
            }

        }
    }


    public function datatable($indice = null)
    {

        if ($indice == null) {
            $pagina = 1;
        } else {
            $pagina = $indice;
        }


        $retorno = $this->usuariomdl->buscar();
        $total = $retorno['row_count'];
        $registros = 10;
        $numpaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;

        $retorno2 = $this->usuariomdl->buscar_limit($registros, $inicio);


        $json = array(
            'getUsuario' => $retorno2['dataset'],
            'pagina' => $pagina,
            'numpagina' => $numpaginas
        );

        $this->load->view('usuario/load_ajax/usuario', $json);
    }

    public function permissao($indice, $indice1 = null)
    {
        $this->usuariomdl->nao_logado();
        if ($indice != null) {

            $this->session->set_userdata('id_usuarioPER', $indice);
            $retorno = $this->usuariomdl->verificar(array('id_usuario' => $indice));

            $retorno1 = $this->tipoPermicaomdl->buscar();
            $retorno2 = $this->permicaomdl->verificar(array('id_usuario' => $indice));

            $data = array(
                'titulo' => "Usuários",
                'menu' => "Usuários",
                'submenu' => "Permissão",
                'tipo' => "form",
                'getUsuario' => $retorno['dataset'],
                'getPermicao' => $retorno1['dataset'],
                'getPerExistentes' => $retorno2['dataset']
            );
            $this->load->view('templates/header', $data);
            if ($indice1 != null) {
                if ($indice1 == 1) {
                    $data2['msg'] = "Já cadastrou esta permissão";
                    $this->load->view('msg/error', $data2);
                } elseif ($indice1 == 2) {
                    $data2['msg'] = "Feito com sucesso";
                    $this->load->view('msg/success', $data2);
                }
            }
            $this->load->view('usuario/permission');
            $this->load->view('templates/footer');
        }
    }

    public function save_permission()
    {
        $this->form_validation->set_rules('id_permicao[]', null, "required");
        $this->form_validation->set_rules('usuario', null, "required");
        $this->form_validation->set_rules('nome', null, "required");
        if ($this->form_validation->run() == false) {
            $this->permissao($this->session->userdata('id_usuarioPER'));
        } elseif ($this->form_validation->run() == true) {
            $resp = 1;
            $form_data = array(
                'id_usuario' => $this->session->userdata('id_usuarioPER'),
                'id_tipoPermicao' => null);

            foreach ($this->input->post('id_permicao') as $id_permicao) {
                $form_data['id_tipoPermicao'] = $id_permicao;
                $retorno = $this->permicaomdl->verificar($form_data);
                if ($retorno['row_count'] <= 0) {
                    $retorno1 = $this->permicaomdl->salvar($form_data);
                    if ($retorno1) {
                        $resp = 2;
                    }
                } elseif ($retorno['row_count'] >= 1) {
                    $retorno1 = $this->permicaomdl->eliminar($form_data);
                    if ($retorno1) {
                        $resp = 2;
                    }

                }
            }
            redirect(base_url() . "usuario/permissao/{$this->session->userdata('id_usuarioPER')}/$resp");

        }
    }

}
