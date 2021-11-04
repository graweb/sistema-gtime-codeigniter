<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        $this->load->model('usuarios_model', '', TRUE);
    }

    // PÁGINA DE USUÁRIOS
	public function index()
	{
        $this->load->model('permissoes_model');
        $this->data['dados_permissao'] = $this->permissoes_model->get();
		$this->load->view('configuracoes/usuarios/usuarios', $this->data);
	}

    // LISTAR
    public function listar()
    {
        echo $this->usuarios_model->getJson();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DEFINIR SENHA
    public function definir_senha($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->definir_senha($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}