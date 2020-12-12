<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CursoMDL extends CI_Model
{
    private $tabela = "tbl_curso";
    private $view = "tbl_curso";
    private $stmt;

    public function salvar($dados) {
        if ($dados != null) {
            $this->db->insert($this->tabela, $dados);
            return array('id' => $this->db->insert_id());
        }
    }

    public function verificar($dados_where) {
        if ($dados_where != null) {
            $this->db->where($dados_where);
            $this->stmt = $this->db->get($this->view);

            return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
        }
    }

    public function buscar() {
        $this->db->select("*");
        $this->db->order_by('id_curso', 'ASC');
        $this->stmt = $this->db->get($this->view);

        return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
    }

    public function buscar_limit($registros, $inicio) {
        $this->stmt = $this->db->select()
            ->from($this->view)
            ->order_by('id_curso', 'asc')
            ->limit($registros, $inicio)
            ->get();

        return array('row_count' => $this->stmt->num_rows(), 'dataset'=> $this->stmt->result());

    }

    public function alterar() {

    }

    public function eliminar() {

    }

}