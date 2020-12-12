<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institucional extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->usuariomdl->nao_logado();
        $this->load->model('CursoMDL', 'cursomdl');
        $this->load->model('ClasseMDL', 'classemdl');
        $this->load->model('TurmaMDL', 'turmamdl');
        $this->load->model('TurnoMDL', 'turnomdl');
        $this->load->model('TipoPagamentoMDL', 'tipopagamentomdl');
        $this->load->model('ExtraMDL', 'extramdl');
    }

    public function index()
    {
        $data = array(
            'titulo' => "Intitucional",
            'menu' => "Institucional",
            'submenu' => "Institucional",
            'tipo' => "view"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('institucional/institucional');
        $this->load->view('templates/footer');
    }

    public function curso()
    {
        $data = array(
            'titulo' => "Intitucional",
            'menu' => "Institucional",
            'submenu' => "Cursos",
            'tipo' => "view"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('institucional/list_curso');
        $this->load->view('templates/footer');
    }


    public function turma()
    {
        $data = array(
            'titulo' => "Intitucional",
            'menu' => "Institucional",
            'submenu' => "Turmas",
            'tipo' => "view"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('institucional/list_turma');
        $this->load->view('templates/footer');
    }

    public function novo_curso($indice = null)
    {
        $data = array(
            'titulo' => "Intitucional",
            'menu' => "Institucional",
            'submenu' => "Cursos",
            'tipo' => "form"
        );

        $this->load->view('templates/header', $data);
        if ($indice != null) {
            $data2['msg'] = null;

            if ($indice == 1) {
                $data2['msg'] = "Curso já existente";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Feito com sucesso";
                $this->load->view('msg/success', $data2);
            }
        }
        $this->load->view('institucional/new_curso');
        $this->load->view('templates/footer');
    }


    public function novo_turma($indice = null)
    {
        $retorno = $this->cursomdl->buscar();
        $retorno1 = $this->classemdl->buscar();
        $retorno2 = $this->turnomdl->buscar();

        $data = array(
            'titulo' => "Intitucional",
            'menu' => "Institucional",
            'submenu' => "Turmas",
            'tipo' => "form",
            'getCurso' => $retorno['dataset'],
            'getClasse' => $retorno1['dataset'],
            'getTurno' => $retorno2['dataset']
        );

        $this->load->view('templates/header', $data);
        if ($indice != null) {
            $data2['msg'] = null;

            if ($indice == 1) {
                $data2['msg'] = "Turma já existente";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Feito com sucesso";
                $this->load->view('msg/success', $data2);
            }
        }
        $this->load->view('institucional/new_turma');
        $this->load->view('templates/footer');
    }

    public function save_curso()
    {
        $this->form_validation->set_rules("curso", null, "required");
        if ($this->form_validation->run() == false) {
            $this->novo_curso();
        } elseif ($this->form_validation->run() == true) {
            $data_form = array(
                'curso' => $this->input->post('curso')
            );
            $retorno = $this->cursomdl->verificar($data_form);
            if ($retorno['row_count'] >= 1) {
                redirect(base_url() . "institucional/novo_curso/1");

            } else {
                $retorno1 = $this->cursomdl->salvar($data_form);
                if ($retorno1['id'] > 0) {
                    redirect(base_url() . "institucional/novo_curso/2");
                }
                echo "feito";
            }
        }
    }

    public function save_turma()
    {

        $this->form_validation->set_rules("curso", null, "required");
        $this->form_validation->set_rules("classe", null, "required");
        $this->form_validation->set_rules("turma", null, "required");
        $this->form_validation->set_rules("turno", null, "required");

        if ($this->form_validation->run() == false) {
            $this->novo_turma();
        } elseif ($this->form_validation->run() == true) {
            $form_data = array(
                'id_curso' => $this->input->post('curso'),
                'id_classe' => $this->input->post('classe'),
                'id_turno' => $this->input->post('turno'),
                'turma' => $this->input->post('turma')
            );
            $retorno = $this->turmamdl->verificar($form_data);
            if ($retorno['row_count'] >= 1) {
                redirect(base_url() . "institucional/novo_turma/1");
            } elseif ($retorno['row_count'] <= 0) {
                $retorno1 = $this->turmamdl->salvar($form_data);
                if ($retorno1['id'] > 0) {
                    redirect(base_url() . "institucional/novo_turma/2");
                }
            }
        }
    }


    public function datatable_curso($indice = null)
    {

        if ($indice == null) {
            $pagina = 1;
        } else {
            $pagina = $indice;
        }


        $retorno = $this->cursomdl->buscar();
        $total = $retorno['row_count'];
        $registros = 10;
        $numpaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;

        $retorno2 = $this->cursomdl->buscar_limit($registros, $inicio);


        $json = array(
            'getCurso' => $retorno2['dataset'],
            'pagina' => $pagina,
            'numpagina' => $numpaginas
        );

        $this->load->view('institucional/load_ajax/curso', $json);
    }

    public function datatable_turma($indice = null)
    {

        if ($indice == null) {
            $pagina = 1;
        } else {
            $pagina = $indice;
        }


        $retorno = $this->turmamdl->buscar();
        $total = $retorno['row_count'];
        $registros = 10;
        $numpaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;

        $retorno2 = $this->turmamdl->buscar_limit($registros, $inicio);


        $json = array(
            'getTurma' => $retorno2['dataset'],
            'pagina' => $pagina,
            'numpagina' => $numpaginas
        );

        $this->load->view('institucional/load_ajax/turma', $json);
    }

    public function turmas_details($id_turma)
    {


        if ($id_turma != null) {
            $this->session->set_userdata('id_turmaINS', $id_turma);

            $retorno = $this->tipopagamentomdl->buscar();
            $retorno1 = $this->turmamdl->verificar(array('id_turma' => $id_turma));
            foreach ($retorno1['dataset'] as $turma) {
            }

            $retorno2 = $this->extramdl->verificar(array(
                'curso' => $turma->curso,
                'classe' => $turma->classe,
                'turno' => $turma->turno
            ));

            $data = array(
                'titulo' => "Intitucional",
                'menu' => "Institucional",
                'submenu' => "Turmas",
                'tipo' => "form",
                'getTurma' => $retorno1['dataset'],
                'getTipoPagamento' => $retorno['dataset'],
                'getPagamento' => $retorno2
            );

            $this->load->view('templates/header', $data);
            $this->load->view('institucional/details_turma');
            $this->load->view('templates/footer');

        }
    }

    public function listas()
    {
        $this->form_validation->set_rules('ano_lectivo', "Ano lectivo", "required");
        if ($this->form_validation->run() == false) {
            $this->turmas_details($this->session->userdata('id_turmaINS'));
        } elseif ($this->form_validation->run() == true) {
            $form_data = array(
                'id_tipoPagamento' => $this->input->post('id_tipoPagamento'),
                'ano_lectivo' => $this->input->post('ano_lectivo')
            );

            if ($form_data['id_tipoPagamento'] == "") {
                redirect(base_url() . "excel/lista_nominal/{$this->session->userdata('id_turmaINS')}/{$form_data['ano_lectivo']}");
            } elseif ($form_data['id_tipoPagamento'] != "") {

                redirect(base_url() . "pdf/listas_pagamento/{$form_data['id_tipoPagamento']}/{$form_data['ano_lectivo']}/{$this->session->userdata('id_turmaINS')}");
            }
        }
    }


}




