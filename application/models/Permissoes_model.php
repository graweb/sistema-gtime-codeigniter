<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissoes_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_permissoes')->result();
    }

    public function pegarPorID($id){
        $this->db->where('id_permissao',$id);
        return $this->db->get('tb_permissoes')->row();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_permissoes',array(
            'nome'=>$this->input->post('nome',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function salvarAcessos()
    {
        $permissoes = array(
            'vConfigProjetos' => $this->input->post('vConfigProjetos'),
            'aConfigProjetos' => $this->input->post('aConfigProjetos'),
            'eConfigProjetos' => $this->input->post('eConfigProjetos'),
            'dConfigProjetos' => $this->input->post('dConfigProjetos'),

            'vConfigHistoricoTrabalho' => $this->input->post('vConfigHistoricoTrabalho'),
            'aConfigHistoricoTrabalho' => $this->input->post('aConfigHistoricoTrabalho'),
            'eConfigHistoricoTrabalho' => $this->input->post('eConfigHistoricoTrabalho'),
            'dConfigHistoricoTrabalho' => $this->input->post('dConfigHistoricoTrabalho'),

            'vConfigRelatorios' => $this->input->post('vConfigRelatorios'),

            'vConfigConfigProjetosSelecionar' => $this->input->post('vConfigConfigProjetosSelecionar'),

            'vConfigUsuarios' => $this->input->post('vConfigUsuarios'),
            'aConfigUsuarios' => $this->input->post('aConfigUsuarios'),
            'eConfigUsuarios' => $this->input->post('eConfigUsuarios'),
            'dConfigUsuarios' => $this->input->post('dConfigUsuarios'),

            'vConfigPermissoes' => $this->input->post('vConfigPermissoes'),
            'aConfigPermissoes' => $this->input->post('aConfigPermissoes'),
            'eConfigPermissoes' => $this->input->post('eConfigPermissoes'),
            'dConfigPermissoes' => $this->input->post('dConfigPermissoes'),
        );

        $permissoes = serialize($permissoes);

        $this->db->where('id_permissao', $this->input->post('id_permissao',true));
        return $this->db->update('tb_permissoes',array(
            'permissoes'=>$permissoes,
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_permissao', $id);
        return $this->db->update('tb_permissoes',array(
            'nome'=>$this->input->post('nome',true),
            'permissoes'=>$this->input->post('permissoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_permissao', $id);
        return $this->db->update('tb_permissoes',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }
    
    public function deletar($id)
    {
        return $this->db->delete('tb_permissoes', array('id_permissao' => $id)); 
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_permissao';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_permissao = isset($_POST['id_permissao']) ? strval($_POST['id_permissao']) : '';
        $nome = isset($_POST['nome']) ? strval($_POST['nome']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_permissoes');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_permissao', $id_permissao);
        $this->db->like('nome', $nome);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {
            $row[] = array(
                'id_permissao'=>$data['id_permissao'],
                'nome'=>$data['nome'],
                'permissoes'=>$data['permissoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}