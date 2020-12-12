<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->usuariomdl->nao_logado();
        $this->load->model('ListaPagamentoMDL', 'listapagamentomdl');
        $this->load->model('ModalidadeMDL', 'modalidademdl');
        $this->load->model('TipoPagamentoMDL', 'tipopagamentomdl');
        $this->load->model('EstudanteMDL', 'estudantemdl');
        $this->load->model('HistoricoMDL', 'historicomdl');
        $this->load->model('EstComparticipadoresMDL', 'estcomparticipadoresmdl');
        $this->load->model('PagamentoMDL', 'pagamentomdl');
        $this->load->model('TurmaMDL', 'turmamdl');
        $this->load->model('ClasseMDL', 'classemdl');
        $this->load->model('CursoMDL', 'cursomdl');
        $this->load->model('TurnoMDL', 'turnomdl');
        $this->load->model('ExtraMDL', 'extramdl');
        $this->load->model('MesMDL', 'mesmdl');
    }

    public function index()
    {
        $data = array(
            'titulo' => "Pagamentos",
            'menu' => "Pagamentos",
            'submenu' => "Listar",
            'tipo' => "view"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('pagamento/list');
        $this->load->view('templates/footer');
    }

    public function novo($indice = null)
    {

        $listaPagamento = $this->listapagamentomdl->buscar();
        $modalidade = $this->modalidademdl->buscar();

        $data = array(
            'titulo' => "Pagamentos",
            'menu' => "Pagamentos",
            'submenu' => "Novo",
            'tipo' => "form",
            'getListapagamento' => $listaPagamento['dataset'],
            'getModalidade' => $modalidade['dataset']
        );

        $this->load->view('templates/header', $data);
        if ($indice != null) {
            $data2['msg'] = null;

            if ($indice == 1) {
                $data2['msg'] = "Já registrou este tipo de Pagamento";
                $this->load->view('msg/error', $data2);
            } elseif ($indice == 2) {
                $data2['msg'] = "Cadastro feito com sucesso";
                $this->load->view('msg/success', $data2);
            }
        }
        $this->load->view('pagamento/new');
        $this->load->view('templates/footer');
    }

    public function efectuar($indice)
    {
        $retorno = $this->tipopagamentomdl->buscar();
        if ($indice != null) {

            $this->session->set_userdata("id_estudantePAGA", $indice);
            $retorno2 = $this->estudantemdl->verificar(array('id_estudante' => $indice));
            foreach ($retorno2['dataset'] as $estudante): endforeach;
            $form_data = array(
                'curso' => $estudante->curso,
                'classe' => $estudante->classe,
                'turno' => $estudante->turno
            );
            $retorno3 = $this->extramdl->verificar($form_data);

            $data = array(
                'titulo' => "Pagamentos",
                'menu' => "Pagamentos",
                'submenu' => "Efectuar",
                'tipo' => "view",
                'getPagamentos' => $retorno['dataset'],
                'getEstudantes' => $retorno2['dataset'],
                'extra' => $retorno3
            );

            $this->load->view('templates/header', $data);
            $this->load->view('pagamento/efectuar');
            $this->load->view('templates/footer');
        }
    }

    public function save()
    {

        $this->form_validation->set_rules("id_listaPagamento", null, "required");
        $this->form_validation->set_rules("id_modalidade", null, "required");
        $this->form_validation->set_rules("valor", null, "required");
        if ($this->form_validation->run() == false) {
            $this->novo();
        } else {
            $data_tipopagamento = array(
                'id_listaPagamento' => $this->input->post("id_listaPagamento"),
                'id_modalidade' => $this->input->post("id_modalidade"),
                'valor' => $this->input->post("valor")
            );
            $retorno = $this->tipopagamentomdl->verificar($data_tipopagamento);
            if ($retorno['row_count'] >= 1) {
                redirect(base_url() . "pagamento/novo/1");
            } elseif ($retorno['row_count'] <= 0) {
                $retorno2 = $this->tipopagamentomdl->salvar($data_tipopagamento);
                if ($retorno2['id'] > 0) {
                    redirect(base_url() . "pagamento/novo/2");
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


        $retorno = $this->tipopagamentomdl->buscar();
        $total = $retorno['row_count'];
        $registros = 10;
        $numpaginas = ceil($total / $registros);
        $inicio = ($registros * $pagina) - $registros;

        $retorno2 = $this->tipopagamentomdl->buscar_limit($registros, $inicio);


        $json = array(
            'getPagamentos' => $retorno2['dataset'],
            'pagina' => $pagina,
            'numpagina' => $numpaginas
        );

        $this->load->view('pagamento/load_ajax/pagamento', $json);
    }

    public function pronto($indice = null)
    {

        $ano_lectivo = $this->session->userdata('anolectivoPAGA');
        $id_estudante = $this->session->userdata('id_estudantePAGA');
        $id_tipoPagamento = $this->session->userdata("id_tipoPagamentoPAGA");

        if ($ano_lectivo != null && $id_estudante != null && $id_tipoPagamento != null) {
            $retorno = $this->tipopagamentomdl->verificar(array('id_tipoPagamento' => $id_tipoPagamento));

            foreach ($retorno['dataset'] as $pagamentos) {

                if ($pagamentos->modalidade == "Mensal") { //PAGAMENTO MENSAL -------------------------
                    $retorno2 = $this->mesmdl->verificar(array('tipo' => 1));
                    $array_existe = array();
                    foreach ($retorno2['dataset'] as $modalidades) {
                        $array_p2['id_mes'] = $modalidades->id_mes;
                        $array_p2['mes'] = $modalidades->mes;

                        array_push($array_existe, $array_p2);
                    }

                    $retorno5 = $this->pagamentomdl->verificar(array(
                        'id_estudante' => $id_estudante,
                        'ano_lectivo' => $ano_lectivo,
                        'id_tipoPagamento' => $id_tipoPagamento));

                    $array_pagos = array();

                    foreach ($retorno5['dataset'] as $efectuados) {
                        $array_p['id_mes'] = $efectuados->id_mes;
                        $array_p['mes'] = $efectuados->mes;
                        array_push($array_pagos, $array_p);
                    }
                    $array_naoPagos = array_diff_assoc($array_existe, $array_pagos);
                } elseif ($pagamentos->modalidade == "Trimestral") {//PAGAMENTO TRIMESTRAL -------------------------
                    $retorno2 = $this->mesmdl->verificar(array('tipo' => 2));
                    $array_existe = array();
                    foreach ($retorno2['dataset'] as $modalidades) {
                        $array_p2['id_mes'] = $modalidades->id_mes;
                        $array_p2['mes'] = $modalidades->mes;

                        array_push($array_existe, $array_p2);
                    }

                    $retorno5 = $this->pagamentomdl->verificar(array(
                        'id_estudante' => $id_estudante,
                        'ano_lectivo' => $ano_lectivo,
                        'id_tipoPagamento' => $id_tipoPagamento));

                    $array_pagos = array();

                    foreach ($retorno5['dataset'] as $efectuados) {
                        $array_p['id_mes'] = $efectuados->id_mes;
                        $array_p['mes'] = $efectuados->mes;
                        array_push($array_pagos, $array_p);
                    }
                    $array_naoPagos = array_diff_assoc($array_existe, $array_pagos);
                } elseif ($pagamentos->modalidade == "Semestral") { //PAGAMENTO SEMESTRAL -------------------------
                    $retorno2 = $this->mesmdl->verificar(array('tipo' => 3));
                    $array_existe = array();
                    foreach ($retorno2['dataset'] as $modalidades) {
                        $array_p2['id_mes'] = $modalidades->id_mes;
                        $array_p2['mes'] = $modalidades->mes;

                        array_push($array_existe, $array_p2);
                    }

                    $retorno5 = $this->pagamentomdl->verificar(array(
                        'id_estudante' => $id_estudante,
                        'ano_lectivo' => $ano_lectivo,
                        'id_tipoPagamento' => $id_tipoPagamento));

                    $array_pagos = array();

                    foreach ($retorno5['dataset'] as $efectuados) {
                        $array_p['id_mes'] = $efectuados->id_mes;
                        $array_p['mes'] = $efectuados->mes;
                        array_push($array_pagos, $array_p);
                    }
                    $array_naoPagos = array_diff_assoc($array_existe, $array_pagos);
                } elseif ($pagamentos->modalidade == "Anual") { //PAGAMENTO ANUAL -------------------------
                    $retorno2 = $this->mesmdl->verificar(array('tipo' => 4));
                    $array_existe = array();
                    foreach ($retorno2['dataset'] as $modalidades) {
                        $array_p2['id_mes'] = $modalidades->id_mes;
                        $array_p2['mes'] = $modalidades->mes;

                        array_push($array_existe, $array_p2);
                    }

                    $retorno5 = $this->pagamentomdl->verificar(array(
                        'id_estudante' => $id_estudante,
                        'ano_lectivo' => $ano_lectivo,
                        'id_tipoPagamento' => $id_tipoPagamento));

                    $array_pagos = array();

                    foreach ($retorno5['dataset'] as $efectuados) {
                        $array_p['id_mes'] = $efectuados->id_mes;
                        $array_p['mes'] = $efectuados->mes;
                        array_push($array_pagos, $array_p);
                    }
                    $array_naoPagos = array_diff_assoc($array_existe, $array_pagos);
                } elseif ($pagamentos->modalidade == "Nenhum") {//PAGAMENTO NENHUM -------------------------
                    $retorno2 = $this->mesmdl->verificar(array('tipo' => 5));
                    $array_existe = array();
                    foreach ($retorno2['dataset'] as $modalidades) {
                        $array_p2['id_mes'] = $modalidades->id_mes;
                        $array_p2['mes'] = $modalidades->mes;

                        array_push($array_existe, $array_p2);
                    }

                    $retorno5 = $this->pagamentomdl->verificar(array(
                        'id_estudante' => $id_estudante,
                        'ano_lectivo' => $ano_lectivo,
                        'id_tipoPagamento' => $id_tipoPagamento));

                    $array_naoPagos = $array_existe;
                }
            }
            $retorno3 = $this->historicomdl->verificar(array('id_estudante' => $id_estudante, 'ano_lectivo' => $ano_lectivo));
            $retorno4 = $this->estcomparticipadoresmdl->verificar(array('id_estudante' => $id_estudante));
            foreach ($retorno3['dataset'] as $historico) {

            }
            $retorno6 = $this->turmamdl->verificar(array('id_turma' => $historico->id_turma));

            $data = array(
                'titulo' => "Pagamentos",
                'menu' => "Pagamentos",
                'submenu' => "Efectuar Pagamento",
                'tipo' => "form",
                'getTipopagamentos' => $retorno['dataset'],
                'getHistorico' => $retorno3['dataset'],
                'getEncarregados' => $retorno4['dataset'],
                'getTurma' => $retorno6['dataset'],
                'getNaoPagos' => $array_naoPagos,
                'getPagos' => $retorno5['dataset']
            );

            $this->load->view('templates/header', $data);
            if ($indice != null) {
                $data2['msg'] = null;

                if ($indice == 1) {
                    $data2['msg'] = "Deve Selecionar os meses";
                    $this->load->view('msg/error', $data2);
                } elseif ($indice == 2) {
                    $data2['msg'] = "Pagamento feito com sucesso";
                    $this->load->view('msg/success', $data2);
                }
            }
            $this->load->view('pagamento/pront');
            $this->load->view('templates/footer');
        }
    }

    public function preparacao($indice, $indice2 = null)
    {
        if ($indice != null) {

            $this->session->set_userdata("id_tipoPagamentoPAGA", $indice);

            $data = array(
                'titulo' => "Pagamentos",
                'menu' => "Pagamentos",
                'submenu' => "Confirmar Ano Lectivo",
                'tipo' => "form"
            );

            $this->load->view('templates/header', $data);
            if ($indice2 != null) {
                $data2['msg'] = null;

                if ($indice2 == 1) {
                    $data2['msg'] = "Ano Lectivo não encontrado";
                    $this->load->view('msg/error', $data2);
                }
            }
            $this->load->view('pagamento/prep');
            $this->load->view('templates/footer');
        }
    }

    public function confirmar_ano()
    {
        $this->form_validation->set_rules("ano_lectivo", null, "required");
        if ($this->form_validation->run() == false) {
            $this->preparacao($this->session->userdata("id_tipoPagamentoPAGA"));
        } else {
            $dados = array(
                'ano_lectivo' => $this->input->post("ano_lectivo"),
                'id_estudante' => $this->session->userdata("id_estudantePAGA")
            );
            $retorno = $this->historicomdl->verificar($dados);
            if ($retorno['row_count'] <= 0) {
                redirect(base_url() . "pagamento/preparacao/{$this->session->userdata("id_tipoPagamentoPAGA")}/1");
            } elseif ($retorno['row_count'] >= 1) {
                $this->session->set_userdata("anolectivoPAGA", $dados['ano_lectivo']);
                redirect(base_url() . "pagamento/pronto");
            }
        }
    }

    public function efectuar_pagamento()
    {
        $this->form_validation->set_rules("preco", null, "required");
        $this->form_validation->set_rules("id_mes[]", "Mês", "required");
        if ($this->form_validation->run() == false) {
            $this->pronto();
        } else {

            $data_pagamento = array(
                'id_estudante' => $this->session->userdata('id_estudantePAGA'),
                'id_usuario' => $this->session->userdata("id_usuarioDB"),
                'id_tipoPagamento' => $this->session->userdata("id_tipoPagamentoPAGA"),
                'id_mes' => null,
                'valor_pago' => $this->input->post("preco"),
                'data_pagamento' => date("Y-m-d"),
                'hora_pagamento' => date("H:i:s"),
                'ano_lectivo' => $this->session->userdata('anolectivoPAGA')
            );


            foreach ($this->input->post("id_mes") as $id_mes) {
                $data_pagamento['id_mes'] = $id_mes;
                $retorno = $this->pagamentomdl->verificar(array(
                    'id_estudante' => $data_pagamento['id_estudante'],
                    'id_mes' => $id_mes,
                    'id_tipoPagamento' => $data_pagamento['id_tipoPagamento'],
                    'ano_lectivo' => $data_pagamento['ano_lectivo']
                ));
                if ($retorno['row_count'] > 0) { /* nada */
                } elseif ($retorno['row_count'] <= 0) {
                    $retorno2 = $this->pagamentomdl->salvar($data_pagamento);
                }

            }
            if ($retorno2['id'] > 0) {
                redirect(base_url() . "pagamento/pronto/2");
            }
        }
    }

    public function descricao_pagos()
    {
        $data_form = array(
            'id_mes' => $this->input->post('id_mes'),
            'data_pagamento' => $this->input->post('data_pagamento'),
            'hora_pagamento' => $this->input->post('hora_pagamento'),
            'id_estudante' => $this->session->userdata("id_estudantePAGA"),
            'ano_lectivo' => $this->session->userdata("anolectivoPAGA"),
            'id_tipoPagamento' => $this->session->userdata("id_tipoPagamentoPAGA")
        );

        $retorno = $this->pagamentomdl->verificar($data_form);
        $dados = array('getDescricao' => $retorno['dataset']);

        $this->load->view('pagamento/load_ajax/descricao_pagos', $dados);

    }

    public function calculos()
    {
        $data_form = array('total_meses' => $this->input->post('total_meses'),
            'valor' => $this->input->post('valor'));

        $calculo = ($data_form['total_meses'] * $data_form['valor']);
        $data = array('somatorio' => $calculo);
        $this->load->view('pagamento/load_ajax/calculos', $data);

    }

    public function extra($indice, $indice1 = null)
    {
        if ($indice != null) {
            $this->session->set_userdata("id_tipoPagamentoEXT", $indice);
            $retorno = $this->cursomdl->buscar();
            $retorno1 = $this->tipopagamentomdl->verificar(array('id_tipoPagamento' => $indice));
            $retorno2 = $this->classemdl->buscar();
            $retorno3 = $this->turnomdl->buscar();
            $data = array(
                'titulo' => "Pagamentos",
                'menu' => "Pagamentos",
                'submenu' => "Extras",
                'tipo' => "form",
                'getCurso' => $retorno['dataset'],
                'gettipoPagamento' => $retorno1['dataset'],
                'getClasse' => $retorno2['dataset'],
                'getTurno' => $retorno3['dataset']
            );

            $this->load->view('templates/header', $data);
            if ($indice1 != null) {
                $data2['msg'] = null;
                if ($indice1 == 1) {
                    $data2['msg'] = "Já efectuou este cadastro";
                    $this->load->view('msg/error', $data2);
                } elseif ($indice1 == 2) {
                    $data2['msg'] = "Feito com sucesso";
                    $this->load->view('msg/success', $data2);
                }
            }
            $this->load->view('pagamento/extra');
            $this->load->view('templates/footer');
        }

    }

    public function save_extra()
    {
        $this->form_validation->set_rules("id_curso", null, "required");
        $this->form_validation->set_rules("id_turno", null, "required");
        $this->form_validation->set_rules('id_classe[]',null, 'required');
        if ($this->form_validation->run() == false) {
            $this->extra($this->session->userdata("id_tipoPagamentoEXT"));
        } elseif ($this->form_validation->run() == true) {
            $resp = 0;
            $data_form = array(
                'id_tipoPagamento' => $this->session->userdata("id_tipoPagamentoEXT"),
                'id_curso' => $this->input->post('id_curso'),
                'id_classe' => null,
                'id_turno' => null
            );
            if ($this->input->post('id_turno') == "all") {
                $retorno = $this->turnomdl->buscar();
                foreach ($retorno['dataset'] as $turno) {
                    if ($turno->turno != "Nenhum") {
                        $data_form['id_turno'] = $turno->id_turno;

                        foreach ($this->input->post('id_classe') as $id_classe) {
                            $data_form['id_classe'] = $id_classe;
                            $retorno1 = $this->extramdl->verificar($data_form);
                            if ($retorno1['row_count'] >= 1) {
                                $resp = 0;
                            } elseif ($retorno1['row_count'] <= 0) {
                                $retorno2 = $this->extramdl->salvar($data_form);
                                if ($retorno2['id'] > 0) {
                                    $resp = 1;
                                }
                            }
                        }

                    }
                }
                if ($resp == 0) {
                    redirect(base_url() . "pagamento/extra/{$this->session->userdata('id_tipoPagamentoEXT')}/1");
                } elseif ($resp == 1) {
                    redirect(base_url() . "pagamento/extra/{$this->session->userdata('id_tipoPagamentoEXT')}/2");
                }

            } else {
                foreach ($this->input->post('id_classe') as $id_classe) {
                    $data_form['id_classe'] = $id_classe;
                    $data_form['id_turno'] = $this->input->post('id_turno');

                    $retorno1 = $this->extramdl->verificar($data_form);
                    if ($retorno1['row_count'] >= 1) {
                        $resp = 0;
                    } elseif ($retorno1['row_count'] <= 0) {
                        $retorno2 = $this->extramdl->salvar($data_form);
                        if ($retorno2['id'] > 0) {
                            $resp = 1;
                        }
                    }
                }
                if ($resp == 0) {
                    redirect(base_url() . "pagamento/extra/{$this->session->userdata('id_tipoPagamentoEXT')}/1");
                } elseif ($resp == 1) {
                    redirect(base_url() . "pagamento/extra/{$this->session->userdata('id_tipoPagamentoEXT')}/2");
                }
            }


        }
    }

    public function pesquisa()
    {
        $nome = $this->input->post("nome");
        if ($nome != null) {
            $retorno = $this->tipopagamentomdl->pesquisar($nome);

            $json = array(
                'getPagamentos' => $retorno['dataset'],
                'pagina' => null,
                'numpagina' => null
            );

            $this->load->view('pagamento/load_ajax/pagamento', $json);
        }
    }



}
