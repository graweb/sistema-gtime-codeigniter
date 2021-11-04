<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gtime extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('Gtime_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
    public function index()
    {
        if(!isset($_SESSION['idusuario']) || !isset($_SESSION['logado']))
        {
            redirect('login');
        }

        $this->load->view('tema/tema');
    }

    // CARREGA O MENU DO SISTEMA
    public function menu()
    {
        if(!isset($_SESSION['idusuario']) || !isset($_SESSION['logado']))
        {
            redirect('login');
        }

        $this->load->view('gtime/menu');
    }

    // CARREGA O CONTEÙDO DO PAINEL(DASHBOARD)
    public function painel()
    {
        if(!isset($_SESSION['idusuario']) || !isset($_SESSION['logado']))
        {
            redirect('login');
        }

        if($this->session->userdata('tipo') === '1')
        {
            $this->load->model('relatorios_model');
            $this->data['dashProjetos'] = $this->relatorios_model->dashProjetosAdmin();
            $this->load->view('gtime/painel_admin', $this->data);
        }
        else
        {
            $this->load->model('projetos_model');
            $this->data['info_projeto'] = $this->projetos_model->getProjetosByUser();
            $this->load->model('relatorios_model');
            $this->data['dashProjetos'] = $this->relatorios_model->dashProjetos();
            $this->load->view('gtime/painel', $this->data);
        }
    }

    // CARREGA O RODAPÉ DO SISTEMA
    public function rodape()
    {
        if(!isset($_SESSION['idusuario']) || !isset($_SESSION['logado']))
        {
            redirect('login');
        }
        
        $this->load->model('projetos_model');
        $this->data['info_projetos'] = $this->projetos_model->getProjetosByUser();
        $this->load->view('gtime/rodape', $this->data);
    }

    // REDIRECIONA PARA A PÁGINA LOGIN
    public function login()
    {
        $this->load->view('gtime/login');
    }

    // SAI DO SISTEMA
    public function sair()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    // VERICA SE OS DADOS DE ACESSO ESTAO CORRETOS E FAZ O LOGIN
    public function autenticar()
    {
        $retorno = $this->Gtime_model->autenticar();

        switch ($retorno) {
            case 0:
                $this->session->set_flashdata('danger', 'Favor, preencha todos os campos!');
                redirect('login');
                break;
            case 1:
                $this->session->set_flashdata('danger', 'Usuário/Senha incorreto!');
                redirect('login');
                break;
            case 2:
                $this->session->set_flashdata('warning','Usuário desativado, favor entrar em contato com o suporte.');
                redirect('login');
                break;
            case 3:
                redirect(base_url());
                break;
        }
    }
}
