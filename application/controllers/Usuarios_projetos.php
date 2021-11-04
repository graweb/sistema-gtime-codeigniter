<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_projetos extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        $this->load->model('usuarios_projetos_model', '', TRUE);
    }

    // ATUALIZAR
    public function salvarProjetoSelecionado()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_projetos_model->salvarProjetoSelecionado())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_projetos_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // REMOVER
    public function remover($idprojeto, $idusuario)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_projetos_model->remover($idprojeto, $idusuario))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }
}