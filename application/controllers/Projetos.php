<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projetos extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        $this->load->model('projetos_model', '', TRUE);
    }

    // PÁGINA DE CLIENTES
	public function index()
	{
        $this->load->model('usuarios_model');
        $this->data['dados_clientes'] = $this->usuarios_model->getClientes();
		$this->load->view('cadastros/projetos/projetos', $this->data);
	}

    // LISTAR
    public function listar()
    {
        echo $this->projetos_model->getJson();
    }

    // CONTEÚDO PROJETOS
    public function conteudo_projetos($id)
    {
        $this->data['id_usuario'] = $id;
        $this->load->model('projetos_model');
        $this->data['info_projeto'] = $this->projetos_model->getProjetos();
        $this->load->view('configuracoes/usuarios/conteudo_projetos', $this->data);
    }

    // LISTAR
    public function listarProjetoPorIdUsuario($id)
    {
        echo $this->projetos_model->pegarProjetoPorIdUsuario($id);
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->projetos_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->projetos_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }

    // CANCELAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->projetos_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }
}