<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EstudanteMDL extends CI_Model {

    private $tabela = "tbl_estudante";
    private $view = "view_estudante";
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

    public function buscar_limit($registros, $inicio) {
        $this->stmt = $this->db->select()
                      ->from($this->view)
                      ->order_by('nome', 'asc')
                      ->limit($registros, $inicio)
                      ->get();
        
              return array('row_count' => $this->stmt->num_rows(), 'dataset'=> $this->stmt->result());
                
    }
    
   public function pesquisar($nome) {
        $this->stmt = $this->db->select()
                      ->from($this->view)
                      ->like('nome', $nome)
                      ->order_by('nome', 'asc')
                      ->get();
        
              return array('row_count' => $this->stmt->num_rows(), 'dataset'=> $this->stmt->result());
                
    }

    public function alterar($dados_update, $dados_where) {
        if($dados_update!=null){
            $this->db->set($dados_update);
            $this->db->where($dados_where);
            $this->db->update($this->tabela);

            return true;
        }
    }

    public function eliminar() {
        
    }

}
