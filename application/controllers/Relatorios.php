<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends MY_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('relatorios_model', '', TRUE);
    }

    // PÁGINA DE RELATÓRIOS
    public function index()
    {
        $this->load->model('projetos_model');
        $this->data['dados_projetos'] = $this->projetos_model->getProjetos();
        $this->load->view('configuracoes/relatorios/relatorios', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->relatorios_model->getJson();
    }

    // HISTÓRICO DE HORAS POR DATA E PROJETO
    public function relPorDataEprojeto()
    {
        // CARREGA AS INFRMAÇÕES
        $data['horasPorProjeto'] = $this->relatorios_model->relPorDataEprojeto();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('configuracoes/relatorios/imprimir_pdf/horas_por_projeto', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Invoice - Date: ". date('Y-m-d');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // HISTÓRICO DE TAREFAS POR PROJETO
    public function relTarefasPorProjeto()
    {
        // CARREGA AS INFRMAÇÕES
        $data['tarefasPorProjeto'] = $this->relatorios_model->relTarefasPorProjeto();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('configuracoes/relatorios/imprimir_pdf/tarefas_por_projeto', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Report - Date: ". date('Y-m-d');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
}