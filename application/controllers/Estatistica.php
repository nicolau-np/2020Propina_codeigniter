<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estatistica extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->usuariomdl->nao_logado();
    }
    
    public function index() {
        
    }

}
