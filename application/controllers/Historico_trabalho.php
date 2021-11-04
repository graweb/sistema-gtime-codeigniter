<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historico_trabalho extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        $this->load->model('historico_trabalho_model', '', TRUE);
    }

    // PÁGINA DE CLIENTES
	public function index()
	{
        $this->load->model('projetos_model');
        $this->data['dados_projetos'] = $this->projetos_model->getProjetos();
		$this->load->view('cadastros/historico_trabalho/historico_trabalho', $this->data);
	}

    // LISTAR
    public function listar()
    {
        echo $this->historico_trabalho_model->getJson();
    }

    // CADASTRAR
    public function iniciar()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->historico_trabalho_model->iniciar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }

    // PARAR
    public function parar($id)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->historico_trabalho_model->parar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }

    // PAGAR
    public function pagar($id)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->historico_trabalho_model->pagar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }

    // CREDITO
    public function credito()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->historico_trabalho_model->credito())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>' Falha ao cadastrar os dados'));
    }
}