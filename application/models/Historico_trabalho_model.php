<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historico_trabalho_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->get('tb_historico_trabalho')->result();
    }

    public function iniciar()
    {
        // PEGA O CLIENTE PELO PROJETO
        $this->db->where('fk_id_projeto', $this->input->post('fk_id_projeto'));
        $projeto = $this->db->get('vw_historico_trabalho')->row();

        // ENVIA E-MAIL PARA O CLIENTE
        //$this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($this->session->userdata('email'));
        $this->email->to($projeto->email);
        $this->email->subject('Início de Atividade');
        $this->email->message('Olá '.$projeto->usuario.', o desenvolvedor '.$this->session->userdata('usuario').' iniciou a tarefa '.$this->input->post('tarefa').' no projeto '.$projeto->projeto.'.<p>Dia e horário de início: '.date('d/m/Y H:i:s').'</p>');
        $this->email->send();

        return $this->db->insert('tb_historico_trabalho',array(
            'fk_id_projeto'=>$this->input->post('fk_id_projeto', true),
            'tarefa'=>$this->input->post('tarefa', true),
            'dat_hor_inicio'=>date('Y-m-d H:i:s'),
        ));
    }

    public function parar($id)
    {
        // PEGA O CLIENTE PELO PROJETO
        $this->db->where('id_historico_trabalho', $id);
        $projeto = $this->db->get('vw_historico_trabalho')->row();

        // ENVIA E-MAIL PARA O CLIENTE
        //$this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($this->session->userdata('email'));
        $this->email->to($projeto->email);
        $this->email->subject('Fim de Atividade');
        $this->email->message('Olá '.$projeto->usuario.', o desenvolvedor '.$this->session->userdata('usuario').' finalizou a tarefa '.$this->input->post('tarefa_parar').' no projeto '.$projeto->projeto.'.<p>Dia e horário de finalização: '.date('d/m/Y H:i:s').'</p>');
        $this->email->send();

        $this->db->where('id_historico_trabalho', $id);
        return $this->db->update('tb_historico_trabalho',array(
            'dat_hor_fim'=>date('Y-m-d H:i:s'),
        ));
    }

    public function pagar($id)
    {
        $this->db->where('id_historico_trabalho', $id);
        return $this->db->update('tb_historico_trabalho',array(
            'pago'=>1,
        ));
    }

    public function credito()
    {
        return $this->db->insert('tb_historico_trabalho',array(
            'fk_id_projeto'=>$this->input->post('fk_id_projeto', true),
            'tarefa'=>'Credit',
            'dat_hor_inicio'=>date('Y-m-d H:i:s'),
            'dat_hor_fim'=>date('Y-m-d H:i:s', strtotime('+'.$this->input->post('credito', true).' minutes'))
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_historico_trabalho';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        $id_historico_trabalho = isset($_POST['id_historico_trabalho']) ? strval($_POST['id_historico_trabalho']) : '';
        $projeto = isset($_POST['projeto']) ? strval($_POST['projeto']) : '';
        $tarefa = isset($_POST['tarefa']) ? strval($_POST['tarefa']) : '';

        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_historico_trabalho', $id_historico_trabalho);
        $this->db->like('projeto', $projeto);
        $this->db->like('tarefa', $tarefa);


        $result = array();
        if($this->session->userdata('tipo') === "1")
        {
            $criteria = $this->db->get('vw_historico_trabalho');
            $result['total'] = $this->db->get('vw_historico_trabalho')->num_rows();
        }
        else
        {
            $criteria = $this->db->where('fk_id_projeto', $this->session->userdata('fkidprojeto'))->get('vw_historico_trabalho');
            $result['total'] = $this->db->where('fk_id_projeto', $this->session->userdata('fkidprojeto'))->get('vw_historico_trabalho')->num_rows();
        }
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_historico_trabalho'=>$data['id_historico_trabalho'],
                'fk_id_projeto'=>$data['fk_id_projeto'],
                'projeto'=>$data['projeto'],
                'usuario'=>$data['usuario'],
                'tarefa'=>$data['tarefa'],
                'pago'=>$data['pago'],
                'dat_hor_inicio'=>$data['dat_hor_inicio'],
                'dat_hor_fim'=>$data['dat_hor_fim'],
                'horas_total'=>$data['horas_total'],
                'minutos_total'=>$data['minutos_total'],
                'segundos_total'=>$data['segundos_total'],
            );
        }

        $result=array_merge($result, array('rows'=>$row));
        return json_encode($result);
    }
}