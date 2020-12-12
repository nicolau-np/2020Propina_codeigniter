<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('UsuarioMDL', 'usuariomdl');
        $this->usuariomdl->nao_logado();
    }

    public function index() {
         $data = array(
            'titulo' => "NQ Propina",
            'menu' => "Home",
            'submenu' => "",
            'tipo' => "home"
        );
        
        $this->load->view('templates/header', $data);
        $this->load->view('index');
        $this->load->view('templates/footer');
    }

    public function sobre(){
        $data = array(
            'titulo' => "NQ Propina",
            'menu' => "Sobre",
            'submenu' => "",
            'tipo' => "sobre"
        );

        $this->load->view('templates/header', $data);
        $this->load->view('sobre');
        $this->load->view('templates/footer');
    }


}
