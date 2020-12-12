<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ModalidadeMDL extends CI_Model {

    private $tabela = "tbl_modalidade";
    private $view = "tbl_modalidade";
    private $stmt;

    public function buscar() {
        $this->db->select("*");
        $this->db->order_by('id_modalidade', 'ASC');
        $this->stmt = $this->db->get($this->view);

        return array('row_count' => $this->stmt->num_rows(), 'dataset' => $this->stmt->result());
    }

}
