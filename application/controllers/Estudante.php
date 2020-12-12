<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estudante extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->load->model('PessoaMDL', 'pessoamdl');
        $this->load->model('EstudanteMDL', 'estudantemdl');
        $this->load->model('HistoricoMDL', 'historicomdl');
        $this->load->model('TurmaMDL', 'turmamdl');
        $this->load->model('EstComparticipadoresMDL', 'estcomparticipadoresmdl');
        $this->usuariomdl->nao_logado();
    }

    public function index()
    {
        $data = array(
            'titulo' => "Estudantes",
            'menu' => "Estudantes",
            'submenu' => "Listar",
            'tipo' => "view"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('estudante/list');
        $this->load->view('templates/footer');
    }

    public function novo($indice = null)
    {
        $retorno = $this->turmamdl->buscar();

        $data = array(
            'titulo' => "Estudantes",
            'menu' => "Estudantes",
            'submenu' => "Novo",
            'tipo' => "form",
            'getTurmas' => $retorno['dataset']
        );

        $this->load->view('templates/header', $data);
        if ($indice != null) {
            $data2['msg'] = null;

            if ($indice == 1) {
                $data2['msg'] = "Nº de Bilhete Existente";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Cadastro feito com sucesso";
                $this->load->view('msg/success', $data2);
            }
        }
        $this->load->view('estudante/new');
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $this->form_validation->set_rules("nome", null, "required");
        $this->form_validation->set_rules("genero", null, "required");
        $this->form_validation->set_rules("data_nascimento", null, "required");
        $this->form_validation->set_rules("ano_lectivo", null, "required");
        $this->form_validation->set_rules("id_turma", null, "required");
        if ($this->form_validation->run() == false) {
            $this->novo();
        } else {
            $dados_pessoa = array(
                'bi' => $this->input->post("bi"),
                'nome' => $this->input->post("nome"),
                'genero' => $this->input->post("genero"),
                'data_nascimento' => $this->input->post("data_nascimento"),
                'data_cadastro' => date("Y-m-d")
            );
            $dados_estudante = array(
                'id_pessoa' => null,
                'id_turma' => $this->input->post("id_turma"),
                'ano_lectivo' => $this->input->post("ano_lectivo")
            );

            $dados_historico = array(
                'id_estudante' => null,
                'id_turma' => $this->input->post("id_turma"),
                'ano_lectivo' => $this->input->post("ano_lectivo")
            );

            $retorno = $this->pessoamdl->verificar_BI($dados_pessoa['bi']);

            if ($retorno['row_count'] >= 1) {
                redirect(base_url() . "estudante/novo/1");
            } elseif ($retorno['row_count'] == 0) {
                $retorno1 = $this->pessoamdl->salvar($dados_pessoa);
                if ($retorno1['id'] > 0) {
                    $dados_estudante['id_pessoa'] = $retorno1['id'];
                    $retorno2 = $this->estudantemdl->salvar($dados_estudante);
                    if ($retorno2['id'] > 0) {
                        $dados_historico['id_estudante'] = $retorno2['id'];
                        if ($this->historicomdl->salvar($dados_historico)) {
                            redirect(base_url() . "estudante/novo/2");
                        }
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


        $retorno = $this->estudantemdl->buscar();
        $total = $retorno['row_count'];
        $registros = 10;
        $numpaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;

        $retorno2 = $this->estudantemdl->buscar_limit($registros, $inicio);


        $json = array(
            'getEstudantes' => $retorno2['dataset'],
            'pagina' => $pagina,
            'numpagina' => $numpaginas
        );

        $this->load->view('estudante/load_ajax/estudante', $json);
    }

    public function visualisar($indice)
    {
        if ($indice != null) {
            $encarregado = null;
            $retorno = $this->estudantemdl->verificar(array('id_estudante' => $indice));
            $retorno1 = $this->estcomparticipadoresmdl->verificar(array('id_estudante' => $indice));
            if ($retorno1['row_count'] <= 0) {
                $encarregado = "---";
            } else {
                foreach ($retorno1['dataset'] as $comparticipador) {
                    $encarregado = $comparticipador->nome_comparticipador;
                }
            }
            $data = array(
                'titulo' => "Estudantes",
                'menu' => "Estudantes",
                'submenu' => "Visualisar",
                'tipo' => "form",
                'getEstudantes' => $retorno['dataset'],
                'encarregado' => $encarregado
            );

            $this->load->view('templates/header', $data);
            $this->load->view('estudante/view');
            $this->load->view('templates/footer');
        }
    }

    public function pesquisa()
    {
        $nome = $this->input->post("nome");
        if ($nome != null) {
            $retorno = $this->estudantemdl->pesquisar($nome);

            $json = array(
                'getEstudantes' => $retorno['dataset'],
                'pagina' => null,
                'numpagina' => null
            );

            $this->load->view('estudante/load_ajax/estudante', $json);
        }
    }


    public function confirmacao($indice, $indice0, $indice1 = null)
    {
        if ($indice != null && $indice0 != null) {
            $retorno = $this->turmamdl->buscar();
            $retorno1 = $this->estudantemdl->verificar(array('id_estudante' => $indice));
            $this->session->set_userdata('id_estudanteCONF', $indice);
            $this->session->set_userdata('id_pessoaCONF', $indice0);
            $data = array(
                'titulo' => "Estudantes",
                'menu' => "Estudantes",
                'submenu' => "Confirmação",
                'tipo' => "form",
                'getTurmas' => $retorno['dataset'],
                'getEstudante' => $retorno1['dataset']
            );

            $this->load->view('templates/header', $data);
            if ($indice1 != null) {
                $data2['msg'] = null;

                if ($indice1 == 1) {
                    $data2['msg'] = "Ano lectivo nulo";
                    $this->load->view('msg/error', $data2);
                } elseif ($indice1 == 2) {
                    $data2['msg'] = "B.I existente";
                    $this->load->view('msg/error', $data2);
                } elseif ($indice1 == 3) {
                    $data2['msg'] = "Feito com sucesso";
                    $this->load->view('msg/success', $data2);
                }
            }
            $this->load->view('estudante/confirm');
            $this->load->view('templates/footer');
        }
    }

    public function confirm_save()
    {
        $this->form_validation->set_rules("nome", null, "required");
        $this->form_validation->set_rules("genero", null, "required");
        $this->form_validation->set_rules("data_nascimento", null, "required");
        $this->form_validation->set_rules("ano_lectivo", null, "required");
        $this->form_validation->set_rules("id_turma", null, "required");
        if ($this->form_validation->run() == false) {
            $this->confirmacao($this->session->userdata('id_estudanteCONF'), $this->session->userdata('id_pessoaCONF'));
        } elseif ($this->form_validation->run() == true) {

            $dados_pessoa = array(
                'bi' => $this->input->post("bi"),
                'nome' => $this->input->post("nome"),
                'genero' => $this->input->post("genero"),
                'data_nascimento' => $this->input->post("data_nascimento"),
                'data_cadastro' => date("Y-m-d")
            );
            $dados_estudante = array(
                'id_turma' => $this->input->post("id_turma"),
                'ano_lectivo' => $this->input->post("ano_lectivo")
            );

            $dados_historico = array(
                'id_estudante' => $this->session->userdata('id_estudanteCONF'),
                'id_turma' => $this->input->post("id_turma"),
                'ano_lectivo' => $this->input->post("ano_lectivo")
            );


            if ($dados_estudante['ano_lectivo'] <= $this->session->userdata('ano_lectivo_actualCONF')) {
                redirect(base_url() . "estudante/confirmacao/{$this->session->userdata('id_estudanteCONF')}/{$this->session->userdata('id_pessoaCONF')}/1");
            } else {
                $retorno = $this->pessoamdl->verificar_BI($dados_pessoa['bi']);

                if ($retorno['row_count'] >= 1) {
                    foreach ($retorno['dataset'] as $estudante) {}
                    if ($estudante->bi != $this->session->userdata('bi_actualCONF')) {
                        redirect(base_url() . "estudante/confirmacao/{$this->session->userdata('id_estudanteCONF')}/{$this->session->userdata('id_pessoaCONF')}/2");
                    } elseif ($estudante->bi == $this->session->userdata('bi_actualCONF')) {
                        if($this->pessoamdl->alterar($dados_pessoa, array('id_pessoa'=>$this->session->userdata('id_pessoaCONF')))){
                            if($this->estudantemdl->alterar($dados_estudante, array('id_pessoa'=>$this->session->userdata('id_pessoaCONF')))){
                                if($this->historicomdl->salvar($dados_historico)){
                                    redirect(base_url() . "estudante/confirmacao/{$this->session->userdata('id_estudanteCONF')}/{$this->session->userdata('id_pessoaCONF')}/3");
                                }
                            }
                        }
                    }
                } elseif ($retorno['row_count'] <= 0) {
                    if($this->pessoamdl->alterar($dados_pessoa, array('id_pessoa'=>$this->session->userdata('id_pessoaCONF')))){
                        if($this->estudantemdl->alterar($dados_estudante, array('id_pessoa'=>$this->session->userdata('id_pessoaCONF')))){
                            if($this->historicomdl->salvar($dados_historico)){
                                redirect(base_url() . "estudante/confirmacao/{$this->session->userdata('id_estudanteCONF')}/{$this->session->userdata('id_pessoaCONF')}/3");
                            }
                        }
                    }
                }
            }
        }
    }
}



