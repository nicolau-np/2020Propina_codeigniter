<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ListaPagamentoMDL extends CI_Model {

    private $tabela = "tbl_listapagamento";
    private $view = "tbl_listapagamento";
    private $stmt;

    public function buscar() {
        $this->db->select("*");
        $this->db->order_by('id_listaPagamento', 'ASC');
        $this->stmt = $this->db->get($this->view);

        return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
    }

}




