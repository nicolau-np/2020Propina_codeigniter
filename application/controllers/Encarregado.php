<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Encarregado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->usuariomdl->nao_logado();
        $this->load->model('ComparticipadorMDL', 'comparticipadormdl');
        $this->load->model('EstudanteMDL', 'estudantemdl');
        $this->load->model('EstComparticipadoresMDL', 'estcomparticipadoresmdl');
    }

    public function index() {
        $data = array(
            'titulo' => "Encarregados",
            'menu' => "Encarregados",
            'submenu' => "Listar",
            'tipo' => "view"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('encarregado/list');
        $this->load->view('templates/footer');
    }

    public function novo($indice = null) {
        $data = array(
            'titulo' => "Encarregados",
            'menu' => "Encarregados",
            'submenu' => "Novo",
            'tipo' => "form"
        );

        $this->load->view('templates/header', $data);
        if ($indice != null) {
            $data2['msg'] = null;

            if ($indice == 1) {
                $data2['msg'] = "Já registrou este encarregado";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Cadastro feito com sucesso";
                $this->load->view('msg/success', $data2);
            }
        }
        $this->load->view('encarregado/new');
        $this->load->view('templates/footer');
    }

    public function save() {
        $this->form_validation->set_rules("nome", null, "required");
        $this->form_validation->set_rules("genero", null, "required");
        if ($this->form_validation->run() == false) {
            $this->novo();
        } else {
            $dados_comparticipadores = array(
                'nome_comparticipador' => $this->input->post("nome"),
                'genero' => $this->input->post("genero"),
                'telefone' => $this->input->post("telefone")
            );

            $retorno = $this->comparticipadormdl->verificar(array(
                'nome_comparticipador' => $dados_comparticipadores['nome_comparticipador'],
                'genero' => $dados_comparticipadores['genero']));
            if ($retorno['row_count'] >= 1) {
                redirect(base_url() . "encarregado/novo/1");
            } else {
                $retorno2 = $this->comparticipadormdl->salvar($dados_comparticipadores);
                if ($retorno2['id'] > 0) {
                    redirect(base_url() . "encarregado/novo/2");
                }
            }
        }
    }

    public function datatable($indice = null) {
        if ($indice == null) {
            $pagina = 1;
        } else {
            $pagina = $indice;
        }


        $retorno = $this->comparticipadormdl->buscar();
        $total = $retorno['row_count'];
        $registros = 10;
        $numpaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;

        $retorno2 = $this->comparticipadormdl->buscar_limit($registros, $inicio);


        $json = array(
            'getEncarregados' => $retorno2['dataset'],
            'pagina' => $pagina,
            'numpagina' => $numpaginas
        );

        $this->load->view('encarregado/load_ajax/encarregado', $json);
    }

    public function datatable2($indice = null) {
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

        $this->load->view('encarregado/load_ajax/estudante', $json);
    }

    public function datatable3($indice = null) {
        if ($indice == null) {
            $dados = array(
                'id_comparticipadores' => $this->session->userdata("id_comparticipadorENC")
            );
            $retorno2 = $this->estcomparticipadoresmdl->verificar($dados);

            $json = array(
                'getEstudantes' => $retorno2['dataset']
            );

            $this->load->view('encarregado/load_ajax/comparticipandos', $json);
        }
    }

    public function pesquisa() {
        $nome = $this->input->post("nome");
        if ($nome != null) {
            $retorno = $this->estudantemdl->pesquisar($nome);

            $json = array(
                'getEstudantes' => $retorno['dataset'],
                'pagina' => null,
                'numpagina' => null
            );

            $this->load->view('encarregado/load_ajax/estudante', $json);
        }
    }

    public function pesquisa_encarregado() {
        $nome = $this->input->post("nome");
        if ($nome != null) {
            $retorno = $this->comparticipadormdl->pesquisar($nome);

            $json = array(
                'getEncarregados' => $retorno['dataset'],
                'pagina' => null,
                'numpagina' => null
            );

            $this->load->view('encarregado/load_ajax/encarregado', $json);
        }
    }

    public function salvar_encarregado($id_estudante) {
        if ($id_estudante != null) {
            $dados_encarregado = array(
                'id_estudante' => $id_estudante,
                'id_comparticipadores' => $this->session->userdata("id_comparticipadorENC")
            );

            if ($dados_encarregado['id_comparticipadores'] != null && $dados_encarregado['id_estudante'] != null) {

                $retorno = $this->estcomparticipadoresmdl->verificar(array('id_estudante' => $dados_encarregado['id_estudante']));

                if ($retorno['row_count'] >= 1) {
                    redirect(base_url() . "encarregado/comparticipandos/{$this->session->userdata("id_comparticipadorENC")}/1");
                } else {
                    if ($this->estcomparticipadoresmdl->salvar($dados_encarregado)) {
                        redirect(base_url() . "encarregado/comparticipandos/{$this->session->userdata("id_comparticipadorENC")}/2");
                    }
                }
            }
        }
    }

    public function comparticipandos($indice, $indice2 = null) {
        if ($indice != null) {

            $this->session->set_userdata("id_comparticipadorENC", $indice);
            $retorno = $this->comparticipadormdl->verificar(array('id_comparticipadores' => $indice));
            $data = array(
                'titulo' => "Encarregados",
                'menu' => "Encarregados",
                'submenu' => "Encarregado & Estudante",
                'tipo' => "form",
                'getComparticipador' => $retorno['dataset']
            );

            $this->load->view('templates/header', $data);
            if ($indice2 != null) {
                $data2['msg'] = null;

                if ($indice2 == 1) {
                    $data2['msg'] = "Já efectuou este registro";
                    $this->load->view('msg/error', $data2);
                } elseif ($indice2 == 2) {
                    $data2['msg'] = "Cadastro feito com sucesso";
                    $this->load->view('msg/success', $data2);
                }
            }
            $this->load->view('encarregado/comparticipandos');
            $this->load->view('templates/footer');
        }
    }

    public function comparticipador($indice) {
        if ($indice != null) {

            $this->session->set_userdata("id_comparticipadorENC", $indice);
            $retorno = $this->comparticipadormdl->verificar(array('id_comparticipadores' => $indice));
            $data = array(
                'titulo' => "Encarregados",
                'menu' => "Encarregados",
                'submenu' => "Comparticipador",
                'tipo' => "form",
                'getComparticipador' => $retorno['dataset']
            );

            $this->load->view('templates/header', $data);
            $this->load->view('encarregado/comparticipador');
            $this->load->view('templates/footer');
        }
    }

}
