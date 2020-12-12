<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->usuariomdl->nao_logado();
        $this->load->model('EstudanteMDL', 'estudantemdl');
        $this->load->model('TurmaMDL', 'turmamdl');
    }

    public function forcar_download($nome_arquivo)
    {
        if ($nome_arquivo != null) {
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header("Content-type: application/x-msexcel");
            header("Content-Disposition: attachment; filename=\"{$nome_arquivo}\"");
            header("Content-Description: PHP Generated Data");
        }

    }

    public function lista_nominal($id_turma, $ano_lectivo)
    {
        if ($id_turma != null && $ano_lectivo != null) {
            $retorno = $this->turmamdl->verificar(array('id_turma' => $id_turma));
            foreach ($retorno['dataset'] as $turma) {
            }
            $retorno1 = $this->estudantemdl->verificar(array(
                    'turma' => $turma->turma,
                    'ano_lectivo' => $ano_lectivo)
            );

            $nome_arquivo = "lista_nominal_" . $turma->turma . "_" . $ano_lectivo . ".xls";
            $data = array(
                'getTurma' => $retorno['dataset'],
                'getEstudante' => $retorno1['dataset'],
                'ano_lectivo' => $ano_lectivo
            );

            $this->forcar_download($nome_arquivo);
            $this->load->view('institucional/exports/excel1', $data);
        }

    }


}