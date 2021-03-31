<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorCliente
 *
 * @author 033234581
 */
class ControladorCliente extends CI_Controller{
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
    public function buscarClientesAtivos(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Cliente_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $resp = $this->Cliente_model->buscarClientes($empresaLogada["codigo_empresa"]);

            for($i=0; $i<count($resp); $i++){
                if($resp[$i]["ativo_cliente"] == 1){
                    $resp[$i]["ativo_cliente"] = "Ativo";
                }else{
                    $resp[$i]["ativo_cliente"] = "Bloqueado";
                }           
            }

            $dados = array("produto" => $resp);    
            $this->load->helper(array("currency"));
            $this->load->view("produto/ViewManterClientes.php", $dados); 
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date()." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function buscarClientesPorCodigo(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Cliente_model");
        $this->load->model("banco_gerencia/Cidade_model");
        $this->load->model("banco_gerencia/Bairro_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            $codigo = $json->{"codigo_cliente"};
            $cliente = $this->Cliente_model->buscarClientePorCodigo($codigo, $empresaLogada["codigo_empresa"]);    
            if($cliente["ativo_cliente"] == 1){
                    $cliente["ativo_cliente"] = "Ativo";
                }else{
                    $cliente["ativo_cliente"] = "Bloqueado";
            }
            
            $cidade = $this->Cidade_model->buscaCidadePorCodigo($cliente["cidade_cliente"]);
            $cliente["cidade_cliente"] = $cidade["descricao_cidade"];

            $bairro = $this->Bairro_model->buscaBairrosPorCodigo($cliente["bairro_cliente"]);
            $cliente["bairro_cliente"] = $bairro["descricao_bairro"];
            if($cliente["complemento_endereco_cliente"] != null && $cliente["complemento_endereco_cliente"] != ""){
                $cliente["endereco_cliente"] = $cliente["endereco_cliente"].". Complemento: ".$cliente["complemento_endereco_cliente"];
            }
            
            $json_str = json_encode($cliente);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function confirmarAlterarClientes(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Cliente_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );

            if($json->{"codigo_cliente"} != null && $json->{"codigo_cliente"} > 0){
                $clienteBanco = $this->Cliente_model->buscarClientePorCodigo($json->{"codigo_cliente"}, $empresaLogada["codigo_empresa"]);
                $cliente = array(
                    "codigo_cliente" => $json->{"codigo_cliente"},
                    "cpf_cliente" => ($clienteBanco["cpf_cliente"] != null && $clienteBanco["cpf_cliente"] != "") ? $clienteBanco["cpf_cliente"] : $json->{"cpf_cliente"},
                    "nome_cliente" => $json->{"nome_cliente"},
                    "email_cliente" => $json->{"email_cliente"},
                    "id_facebook_cliente" => $clienteBanco["id_facebook_cliente"],
                    "telefone_cliente" => $json->{"telefone_cliente"},
                    "cep_cliente" => doubleval($json->{"cep_cliente"}),
                    "endereco_cliente" => $json->{"endereco_cliente"},
                    "complemento_endereco_cliente" => $json->{"complemento_endereco_cliente"},
                    "referencia_endereco_cliente" => $json->{"referencia_endereco_cliente"},
                    "empresa_cliente" => $empresaLogada["codigo_empresa"],
                    "ativo_cliente" => 1,
                    "cidade_cliente" => $clienteBanco["cidade_cliente"],
                    "uf_cliente" => $clienteBanco["uf_cliente"],
                    "sexo_cliente" => $clienteBanco["sexo_cliente"],    
                    "bairro_cliente" => $clienteBanco["bairro_cliente"]

                );
                $this->Cliente_model->alterarCliente($cliente);
            }else{
                throw new Exception("Erro ao alterar dados.");
            } 
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function incluirClientes(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Cliente_model");
        try{
            $empresaLogado = $this->session->userdata("empresa_logada");
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            $cliente = array(
                    "cpf_cliente" => $json->{"cpf_cliente"},
                    "nome_cliente" => $json->{"nome_cliente"},
                    "email_cliente" => $json->{"email_cliente"},
                    "id_facebook_cliente" => $json->{"id_facebook_cliente"},
                    "telefone_cliente" => $json->{"telefone_cliente"},
                    "cep_cliente" => doubleval($json->{"cep_cliente"}),

                    "endereco_cliente" => $json->{"endereco_cliente"},
                    "complemento_endereco_cliente" => $json->{"complemento_endereco_cliente"},
                    "cidade_cliente" => $json->{"cidade_cliente"},
                    "uf_cliente" => $json->{"uf_cliente"},
                    "sexo_cliente" => $json->{"sexo_cliente"},
                    "referencia_endereco_cliente" => $json->{"referencia_endereco_cliente"},
                    "empresa_cliente" => $empresaLogada["codigo_empresa"],
                    "bairro_cliente" => $json->{"bairro_cliente"},
                    "ativo_cliente" => 1
                );

            $formaResp = $this->Forma_pagamento_model->inserirFormaPagamentoRetornandoForma($forma);  
            $json_str = json_encode($formaResp);
            echo $json_str; 
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function confirmarBloquearClientes(){
        $this->verificaUsuarioLogado();       
        $this->load->model("banco_produto/Cliente_model");
        try{
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            if( !($this->Cliente_model->bloquearCliente($json->{"codigo_cliente"})) ){
                throw new Exception("Erro ao bloquear cliente.");
            }
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }  
    
    public function confirmarDesbloquearCliente(){
        $this->verificaUsuarioLogado();       
        $this->load->model("banco_produto/Cliente_model");
        try{
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            if( !($this->Cliente_model->ativarCliente($json->{"codigo_cliente"})) ){
                throw new Exception("Erro ao ativar cliente.");
            }
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }  
}
