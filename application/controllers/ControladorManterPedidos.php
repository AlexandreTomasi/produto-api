<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorManterPedidos
 *
 * @author 033234581
 */
class ControladorManterPedidos extends CI_Controller{
    //put your code here
    public function verificaUsuarioLogado(){      
        $this->load->helper(array("currency"));
        $empresaLogada = $this->session->userdata("empresa_logada");
        if($empresaLogada == null){
            $this->session->unset_userdata("empresa_logada");
            $this->session->set_flashdata("sucess" , "Sessão Expirada. Por favor logue novamente");
            redirect('/');
        }
    }
    
    public function buscarPedidos(){
        $this->verificaUsuarioLogado();
        $this->load->helper(array("currency"));
        $this->load->view("produto/ViewManterPedido.php"); 
    }
}
