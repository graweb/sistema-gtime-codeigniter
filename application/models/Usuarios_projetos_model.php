<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_projetos_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();
    }

    public function salvarProjetoSelecionado()
    {
        unset($_SESSION['fkidprojeto']);
        unset($_SESSION['projeto']);
        unset($_SESSION['valorhoraprojeto']);
        
        $this->db->where('id_usuario', $this->session->userdata('idusuario'));
        $this->db->update('tb_usuarios',array(
            'fk_id_projeto_atual'=> $this->input->post('fk_id_projeto_selecionado', true),
        ));

        $proj = $this->db->where('id_usuario', $this->session->userdata('idusuario'))->get('vw_usuarios')->row();

        $dadosProj = array(
            'fkidprojeto' => $proj->fk_id_projeto_atual,
            'projeto' => $proj->projeto,
            'valorhoraprojeto' => $proj->valor_hora,
        );
        $this->session->set_userdata($dadosProj);

        return true;
    }

    public function cadastrar()
    {
        $this->db->insert('tb_usuarios_projetos',array(
            'fk_id_projeto'=>$this->input->post('fk_id_projeto_add', true),
            'fk_id_usuario'=>$this->input->post('fk_id_usuario_add_projeto', true),
        ));

        $this->db->where('id_usuario', $this->input->post('fk_id_usuario_add_projeto'));
        return $this->db->update('tb_usuarios',array(
            'fk_id_projeto_atual'=> $this->input->post('fk_id_projeto_add', true),
        ));
    }

    public function remover($idprojeto, $idusuario)
    {
        $this->db->where('fk_id_projeto', $idprojeto);
        $this->db->where('fk_id_usuario', $idusuario);
        $this->db->delete('tb_usuarios_projetos');

        $this->db->where('fk_id_usuario', $idusuario);
        $idProjeto = $this->db->get('tb_usuarios_projetos')->row();

        if(!is_null($idProjeto))
        {
            $this->db->where('id_usuario', $idusuario);
            return $this->db->update('tb_usuarios',array(
                'fk_id_projeto_atual'=> $idProjeto->fk_id_projeto)
            );
        }
        else
        {
            $this->db->where('id_usuario', $idusuario);
            return $this->db->update('tb_usuarios',array(
                'fk_id_projeto_atual'=> null)
            );
        }
    }
}