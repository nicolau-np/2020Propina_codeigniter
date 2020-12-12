<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HistoricoMDL extends CI_Model {

    private $tabela = "tbl_historico";
    private $view = "view_historico";
    private $stmt;

    public function salvar($dados) {
        if ($dados != null) {
            $this->db->insert($this->tabela, $dados);
            return true;
        }
    }

    public function verificar($dados_where) {
        if ($dados_where != null) {
            $this->db->where($dados_where);
            $this->db->order_by('nome', 'ASC');
            $this->stmt = $this->db->get($this->view);

            return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
        }
    }

    public function buscar() {
        $this->db->select("*");
        $this->db->order_by('nome', 'ASC');
        $this->stmt = $this->db->get($this->view);

        return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
    }

    public function buscar_limit($inicio, $fim) {
        if ($inicio != null && $fim != null) {
            $this->db->select("*");
            $this->db->order_by('nome', 'ASC');
            $this->db->limit($inicio, $fim);
            $this->stmt = $this->db->get($this->view);

            return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
        }
    }

    public function alterar() {
        
    }

    public function eliminar() {
        
    }

}
