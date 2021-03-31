<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorFormaPagamento
 *
 * @author 033234581
 */
class ControladorFormaPagamento extends CI_Controller{
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
    public function buscarFormasPagamento(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Forma_pagamento_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $formas = $this->Forma_pagamento_model->buscarFormaPagamentoAtivas($empresaLogada["codigo_empresa"]);

            $dados = array("formas" => $formas);    
            $this->load->helper(array("currency"));
            $this->load->view("produto/ViewManterFormaPagamento.php", $dados); 
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function buscarFormaDePagamentoPorID(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Forma_pagamento_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            $codigo = $json->{"codigo_forma_pagamento"};
            $forma = $this->Forma_pagamento_model->buscarFormaPagamentoPorId($codigo, $empresaLogada["codigo_empresa"]);       
            $json_str = json_encode($forma);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function confirmarAlterarFormaDePagamento(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Forma_pagamento_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );

            if($json->{"codigo_forma_pagamento"} != null && $json->{"codigo_forma_pagamento"} > 0){
                $forma = array(
                    "codigo_forma_pagamento" => $json->{"codigo_forma_pagamento"},
                    "descricao_forma_pagamento" => $json->{"descricao_forma_pagamento"},
                    "empresa_forma_pagamento" => $empresaLogada["codigo_empresa"],
                    "ativo_forma_pagamento" => 1
                ); 
                $this->Forma_pagamento_model->alterarFormaPagamento($forma);
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
    
    public function incluirFormaDePagamento(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Forma_pagamento_model");
        try{
             $empresaLogada = $this->session->userdata("empresa_logada");

            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            $forma = array(
                "descricao_forma_pagamento" => $json->{"descricao_forma_pagamento"},
                "empresa_forma_pagamento" => $empresaLogada["codigo_empresa"],
                "ativo_forma_pagamento" => 1
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
    
    public function confirmarRemoverFormaDePagamento(){
        $this->verificaUsuarioLogado();       
        $this->load->model("banco_produto/Forma_pagamento_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");
            $meuPost = file_get_contents("php://input");
            $json = json_decode( $meuPost );
            if($json->{"codigo_forma_pagamento"} != null && $json->{"codigo_forma_pagamento"} > 1){
                if( !($this->Forma_pagamento_model->removerFormaPagamento($json->{"codigo_forma_pagamento"})) ){
                    throw new Exception("Erro ao excluir dados.");
                }  
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
    
}
