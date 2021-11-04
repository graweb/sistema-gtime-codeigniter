<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_relatorio';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_relatorio = isset($_POST['id_relatorio']) ? strval($_POST['id_relatorio']) : '';
        $descricao = isset($_POST['descricao']) ? strval($_POST['descricao']) : '';

        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_relatorio', $id_relatorio);
        $this->db->like('descricao', $descricao);

        $criteria = $this->db->get('tb_relatorios');

        $result = array();
        $result['total'] = $this->db->get('tb_relatorios')->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_relatorio'=>$data['id_relatorio'],
                'descricao'=>$data['descricao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    // RELATÓRIO DE INVOICE POR DATA E PROJETO
    public function relPorDataEprojeto()
    {
        $this->db->where('fk_id_projeto', $this->input->post('id_projeto'));
        $this->db->where('pago', 0);
        $this->db->where('dat_hor_fim !=', '00/00/0000 - 00:00:00');
        return $this->db->get('vw_historico_trabalho')->result();
    }

    // RELATÓRIO DE INVOICE TAREFAS POR PROJETO
    public function relTarefasPorProjeto()
    {
        $this->db->where('fk_id_projeto', $this->input->post('id_projeto'));
        return $this->db->get('vw_historico_trabalho')->result();
    }

    // DASHBOARD CLIENTES
    public function dashProjetos()
    {
        return $this->db->where('pago', '0')->where('fk_id_projeto', $this->session->userdata('fkidprojeto'))->get('vw_historico_trabalho')->result();
    }

    // DASHBOARD ADMIN
    public function dashProjetosAdmin()
    {
        return $this->db->where('pago', '0')->get('vw_historico_trabalho')->result();
    }
}