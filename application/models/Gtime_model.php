<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gtime_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function autenticar()
    {
        // RETORNO = 0 - CAMPO E-MAIL/SENHA EM BRANCO
        // RETORNO = 1 - USUÁRIO DESATIVADO
        // RETORNO = 2 - E-MAIL/SENHA INCORRETO
        // RETORNO = 3 - ACESSA O SISTEMA
        $retorno = 3;

        if($this->input->post('email') != "" && $this->input->post('senha') != "")
        {
            $this->load->library('encryption');
            $this->db->where('senha', hash("sha1", $this->input->post('senha')));
            $this->db->where('usuario', $this->input->post('email'));
            $this->db->or_where('email', $this->input->post('email'));
            $pega_usuario = $this->db->get('vw_usuarios')->row();

            //if(is_array($pega_usuario) ? count($pega_usuario) : 1)
            if(isset($pega_usuario))
            {
                if($pega_usuario->situacao == true)
                {
                    $dadosUSuario = array(
                        'idusuario' => $pega_usuario->id_usuario,
                        'permissao' => $pega_usuario->fk_id_permissao,
                        'tipo' => $pega_usuario->tipo,
                        'usuario' => $pega_usuario->usuario,
                        'email' => $pega_usuario->email,
                        'fkidprojeto' => $pega_usuario->fk_id_projeto_atual,
                        'projeto' => $pega_usuario->projeto,
                        'valorhoraprojeto' => $pega_usuario->valor_hora,
                        'logado' => true
                    );

                    $this->session->set_userdata($dadosUSuario);
                    return $retorno;
                }
                else 
                {
                    $retorno = 2;
                    return $retorno;
                }
            } 
            else 
            {
                $retorno = 1;
                return $retorno;
            }
        }
        else
        {
            $retorno = 0;
            return $retorno;
        }
    }
}