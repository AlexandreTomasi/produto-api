<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logar
 *
 * @author 033234581
 */
class Logar extends CI_Controller{
    
    public function index()
    {    
        $this->load->model("banco_produto/Empresa_model");
        $this->load->model("banco_gerencia/Cliente_generico_model");
        $this->load->helper(array("currency"));
        $empresaLogada = $this->session->userdata("empresa_logada");
        $senha = $this->session->userdata("senhaCliente");
        if($empresaLogada == null){
            $this->load->view("login/ViewLogin.php");          
        }else if($empresaLogada["email_empresa"] != null && $senha != null){
            
            $cliente = $this->Cliente_generico_model->buscaPorEmailESenhaMD5($empresaLogada["email_empresa"], $senha);
            $empresa = null;
            if($cliente != null){
                $empresa = $this->Empresa_model->buscaPorCNPJemail($empresaLogada["email_empresa"], $cliente["cnpj_cliente"]);
            }
            
            if($empresa){
                $this->load->model("banco_produto/Pedido_model");
                $empresaLogada = $this->session->userdata("empresa_logada");
               // $resp = $this->Pedido_model->buscarPedidosCodgEmpresa($empresaLogada["codigo_pizzaria"]);

                /*for($i=0; $i<count($resp); $i++){
                    // descrevendo o status
                    if($resp[$i]["status_pedido"] == 0){
                        $resp[$i]["status_pedido"] = "Cancelado";
                    }else if($resp[$i]["status_pedido"] == 1){
                        $resp[$i]["status_pedido"] = "Solicitado";
                    }else if($resp[$i]["status_pedido"] == 2){
                        $resp[$i]["status_pedido"] = "Pedido Atendido";
                    }
                    //colocando nome dos clientes
                    $this->load->model("pizzaria/Cliente_model");                   
                    $cliente = $this->Cliente_model->buscarClientePorCodigo($resp[$i]["cliente_pizzaria_pedido"], $resp[$i]["pizzaria_pedido"]); 
                    $resp[$i]["nome_cliente"] = $cliente["nome_cliente_pizzaria"];

                    $resp[$i]["data_hora_pedido"] = date_format(date_create($resp[$i]["data_hora_pedido"]), 'd-m-Y H:i:s');
                }*/

                $dados = array("produto" => $resp);    
                $this->load->helper(array("currency"));
                $this->load->view("produto/ViewManterPedido.php", $dados); 
            }else{  
                
                $this->load->view("login/ViewLogin.php");
            }
        }else{   
            $this->load->view("login/ViewLogin.php");
        }
    }
    
    public function autenticar(){
        $this->load->model("banco_produto/Empresa_model");
        $this->load->model("banco_gerencia/Cliente_generico_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $senhaCliente = $this->session->userdata("senhaCliente");
            $empresa = null;
            $cliente = array();
            if($empresaLogada["email_empresa"] != null && $senhaCliente != null){     
                $empresa = null;
                $cliente = $this->Cliente_generico_model->buscaPorEmailESenhaMD5($empresaLogada["email_empresa"], $senhaCliente);
                if($cliente != null){
                    $empresa = $this->Empresa_model->buscaPorCNPJemail($empresaLogada["email_empresa"], $cliente["cnpj_cliente"]);
                }
            }else{
                $empresa = null;
                $email = $this->input->post("email");
                $senha = $this->input->post("senha");
                $cliente = $this->Cliente_generico_model->buscaPorEmailESenha($email, $senha);
                if($cliente != null){
                    $empresa = $this->Empresa_model->buscaPorCNPJemail($email, $cliente["cnpj_cliente"]);
                    echo $empresa["nome_fantasia_empresa"];
                }
            }

            if($empresa){
                $this->session->set_userdata("empresa_logada" , $empresa);
                $this->session->set_userdata("senhaCliente" , $cliente["senha_cliente"]);
                $this->load->helper(array("currency"));
                redirect('ControladorManterPedidos/buscarPedidos', 'refresh');
            }else{
                $this->session->unset_userdata("empresa_logada");
                $this->session->unset_userdata("senhaCliente");
                $this->session->set_flashdata("erro" , "Usuário ou senha inválida.");
                $this->load->view("login/ViewLogin.php");
            }
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_pizzaria"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function logout(){
        $this->session->unset_userdata("empresa_logada");
        $this->session->unset_userdata("senhaCliente");
        $this->session->set_flashdata("sucess" , "Deslogado com sucesso");
        redirect('/');
    }
    
    
    public function voltarPgInicial(){
        $this->load->view("/");
    }
}
