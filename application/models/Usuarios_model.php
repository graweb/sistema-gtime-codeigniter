<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->get('tb_usuarios')->result();
    }

    public function getClientes()
    {
        return $this->db->where('situacao', 1)->where('tipo', 2)->get('tb_usuarios')->result();
    }

    public function cadastrar()
    {
        $this->load->library('encryption');
        
        return $this->db->insert('tb_usuarios',array(
            'fk_id_permissao'=>$this->input->post('fk_id_permissao', true),
            'usuario'=>$this->input->post('usuario', true),
            'email'=>$this->input->post('email', true),
            'senha'=> hash("sha1", $this->input->post('senha')),
            'tipo'=>$this->input->post('tipo', true),
            'situacao'=>$this->input->post('situacao', true),
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('tb_usuarios',array(
            'fk_id_permissao'=>$this->input->post('fk_id_permissao', true),
            'usuario'=>$this->input->post('usuario', true),
            'email'=>$this->input->post('email', true),
            'tipo'=>$this->input->post('tipo', true),
            'situacao'=>$this->input->post('situacao', true),
        ));
    }

    public function definir_senha($id)
    {
        $this->load->library('encryption');

        $this->db->where('id_usuario', $id);
        return $this->db->update('tb_usuarios',array(
            'senha' => hash("sha1", $this->input->post('senha_definir', true)),
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('tb_usuarios',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_usuario';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_usuario = isset($_POST['id_usuario']) ? strval($_POST['id_usuario']) : '';
        $usuario = isset($_POST['usuario']) ? strval($_POST['usuario']) : '';
        $email = isset($_POST['email']) ? strval($_POST['email']) : '';

        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_usuario', $id_usuario);
        $this->db->like('usuario', $usuario);
        $this->db->like('email', $email);

        $criteria = $this->db->get('tb_usuarios');

        $result = array();
        $result['total'] = $this->db->get('tb_usuarios')->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_usuario'=>$data['id_usuario'],
                'usuario'=>$data['usuario'],
                'email'=>$data['email'],
                'senha'=>$data['senha'],
                'tipo'=>$data['tipo'],
                'situacao'=>$data['situacao'],
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}