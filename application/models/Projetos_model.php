<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projetos_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->get('tb_projetos')->result();
    }

    public function getProjetos()
    {
        return $this->db->where('situacao', '1')->get('tb_projetos')->result();
    }

    public function getProjetosByUser()
    {
        $this->db->select('tb_projetos.id_projeto, tb_projetos.projeto, tb_projetos.valor_hora, tb_projetos.situacao');
        $this->db->from('tb_projetos');
        $this->db->join('tb_usuarios_projetos', 'tb_usuarios_projetos.fk_id_projeto = tb_projetos.id_projeto');
        $this->db->where('tb_usuarios_projetos.fk_id_usuario', $this->session->userdata('idusuario'));
        return $this->db->get()->result();
    }

    public function pegarProjetoPorIdUsuario($id)
    {
        $this->db->select('tb_projetos.id_projeto, tb_projetos.projeto, tb_projetos.valor_hora, tb_projetos.situacao');
        $this->db->from('tb_projetos');
        $this->db->join('tb_usuarios_projetos', 'tb_usuarios_projetos.fk_id_projeto = tb_projetos.id_projeto');
        $this->db->where('tb_usuarios_projetos.fk_id_usuario', $id);
        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $this->db->get('tb_projetos')->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_projeto'=>$data['id_projeto'],
                'projeto'=>$data['projeto'],
                'valor_hora'=>$data['valor_hora'],
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_projetos',array(
            'projeto'=>$this->input->post('projeto', true),
            'valor_hora'=>$this->input->post('valor_hora', true),
            'situacao'=>$this->input->post('situacao', true),
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_projeto', $id);
        return $this->db->update('tb_projetos',array(
            'projeto'=>$this->input->post('projeto', true),
            'valor_hora'=>$this->input->post('valor_hora', true),
            'situacao'=>$this->input->post('situacao', true),
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_projeto', $id);
        return $this->db->update('tb_projetos',array(
            'situacao'=>0,
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_projeto';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_projeto = isset($_POST['id_projeto']) ? strval($_POST['id_projeto']) : '';
        $projeto = isset($_POST['projeto']) ? strval($_POST['projeto']) : '';

        //$this->db->select('*');
        //$this->db->from('tb_projetos');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_projeto', $id_projeto);
        $this->db->like('projeto', $projeto);

        $criteria = $this->db->get('tb_projetos');

        $result = array();
        $result['total'] = $this->db->get('tb_projetos')->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_projeto'=>$data['id_projeto'],
                'projeto'=>$data['projeto'],
                'valor_hora'=>$data['valor_hora'],
                'situacao'=>$data['situacao'],
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}