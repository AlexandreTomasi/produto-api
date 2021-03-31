<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cadastroEmpresa
 *
 * @author 033234581
 */
class ControladorDadosEmpresa extends CI_Controller{

    public function verificaUsuarioLogado(){      
        $this->load->helper(array("currency"));
        $empresaLogada = $this->session->userdata("empresa_logada");
        $this->load->model("banco_produto/Empresa_model");      
        if($empresaLogada == null){
            $this->session->unset_userdata("empresa_logada");
            $this->session->set_flashdata("sucess" , "Deslogado com sucesso");
            redirect('/');
        }
    }
    
    public function alterarDadosEmpresa()
    {
        $this->verificaUsuarioLogado();
        $this->load->model("banco_gerencia/Bairro_model");
        $this->load->model("banco_gerencia/Cidade_model");
        $this->load->model("banco_gerencia/Uf_model");
        $this->load->model("banco_produto/Empresa_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");        
            $empresa = $this->Empresa_model->buscaEmpresaPorCodigo($empresaLogada["codigo_empresa"]);
            $bairros = $this->Bairro_model->buscaBairros();
            $cidade = $this->Cidade_model->buscaCidades();
            $uf = $this->Uf_model->buscaEstados();
            $dados = array("empresa" => $empresa, "bairro" =>$bairros, "cidade" =>$cidade, "uf" =>$uf);
            $this->session->set_userdata("empresa_logada" , $empresa);
            $this->load->view("produto/ViewManterDadosEmpresa.php",$dados);
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    public function confirmarAlterarDadosEmpresa()
    {
        $this->verificaUsuarioLogado();
        $this->load->model("banco_gerencia/Cliente_generico_model");
        $this->load->model("banco_produto/Empresa_model");
        $empresaLogado = $this->session->userdata("empresa_logada");
        $meuPost = file_get_contents("php://input");
        $json = json_decode( $meuPost );
        try{
            if($json->{"senha_cliente"} != null  && $json->{"nova_senha"} != null && $json->{"confirma_nova_senha"} != null){
                $cliente = $this->Cliente_generico_model->buscaPorEmailESenha($json->{"email_empresa"}, $json->{"senha_cliente"});
                if($cliente){
                   if(0 == strcmp($json->{"nova_senha"}, $json->{"confirma_nova_senha"}) ){
                       $cliente["senha_cliente"] = $json->{"nova_senha"};
                       if(!$this->Cliente_generico_model->alterarClienteEmpresaGerencia($cliente)){
                           $escreve = fwrite($fp, "Erro ao senha.");
                           throw new Exception("Erro ao alterar senha.");
                       }
                   }else{
                        throw new Exception("Erro ao alterar senha.");
                   } 
                }else{               
                    throw new Exception("Erro ao alterar dados. Senha incorreta");
                }
            }
            
            $empresa = array(
                "codigo_empresa" => $empresaLogado["codigo_empresa"],
                "nome_fantasia_empresa" => $json->{"nome_fantasia_empresa"},         
                "telefone_empresa" => $json->{"telefone_empresa"},
                "cep_empresa" => str_replace("-","",str_replace(".","",$json->{"cep_empresa"})),
                "endereco_empresa" => $json->{"endereco_empresa"},
                "numero_endereco_empresa" => $json->{"numero_endereco_empresa"},
                "complemento_endereco_empresa" => $json->{"complemento_endereco_empresa"},
                "cidade_empresa" => $json->{"cidade_empresa"},
                "uf_empresa" => $json->{"uf_empresa"},
                "bairro_empresa" => $json->{"bairro_empresa"}
            );

            if(!($this->Empresa_model->alteraCadastroPizzaria($empresa))){
                throw new Exception("Erro ao alterar dados.");
            }
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    
    public function alterarConfigEmpresa()
    {
        $this->verificaUsuarioLogado();
        $this->load->model("banco_gerencia/Bairro_model");
        $this->load->model("banco_gerencia/Cidade_model");
        $this->load->model("banco_gerencia/Uf_model");
        $this->load->model("banco_produto/Valor_configuracao_model");
        $this->load->model("banco_produto/Empresa_model");
        $this->load->model("banco_produto/Configuracao");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada");        
            $bairros = $this->Bairro_model->buscaBairros();
            $cidade = $this->Cidade_model->buscaCidades();
            $uf = $this->Uf_model->buscaEstados();
            
            $tipoImpressao = $this->Valor_configuracao_model->tipoImpressao();
            
            $configuracao = $this->Configuracao->todasConfiguracoesAlteraveis();
            $configuracoes = array();
            for($i=0;$i < count($configuracao); $i++){
                $temp = $this->Valor_configuracao_model->buscaConfigEmpresa($configuracao[$i], $empresaLogada["codigo_empresa"]);
                if(is_numeric($temp)){
                    $configuracoes[$configuracao[$i]] = doubleval($this->Valor_configuracao_model->buscaConfigEmpresa($configuracao[$i],$empresaLogada["codigo_empresa"]));
                }else{
                    $configuracoes[$configuracao[$i]] = $this->Valor_configuracao_model->buscaConfigEmpresa($configuracao[$i],$empresaLogada["codigo_empresa"]);
                }
            }    
            $dados = array("configuracoes" => $configuracoes, "tipoImpressao" => $tipoImpressao);
            $this->load->view("produto/ViewManterConfigEmpresa.php",$dados);
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
    
    
    public function confirmarAlterarConfigEmpresa()
    {
        $this->verificaUsuarioLogado();
        $this->load->model("banco_gerencia/Cliente_generico_model");
        $this->load->model("banco_produto/Empresa_model");
        $this->load->model("banco_produto/Valor_configuracao_model");
        $this->load->model("banco_produto/Configuracao");
        $empresaLogada = $this->session->userdata("empresa_logada");
        $meuPost = file_get_contents("php://input");
        $json = json_decode( $meuPost );
        try{
            $senhaCliente = $this->session->userdata("senhaCliente");
            $dadosConfigura = $this->Valor_configuracao_model->buscaPorCodigoCliente($empresaLogada["codigo_empresa"]);
            
            $configuracao = $this->Configuracao->todasConfiguracoesAlteraveis();
            for($i=0;$i < count($dadosConfigura); $i++){
                for($a=0;$a < count($configuracao); $a++){
                    if($dadosConfigura[$i]["descricao_configuracao"] == $configuracao[$a]){
                        $temp = array(
                                "codigo_valor_configuracao" => $dadosConfigura[$i]["codigo_valor_configuracao"],
                                "descricao_valor_configuracao" => $json->{$configuracao[$a]},
                                "configuracao_valor_configuracao" => $dadosConfigura[$i]["configuracao_valor_configuracao"],
                                "empresa_valor_configuracao" => $dadosConfigura[$i]["empresa_valor_configuracao"]
                                );
                        $this->Valor_configuracao_model->alterarValorConfiguracao($temp);
                    }
                }
            }
            for($i=0;$i < count($configuracao); $i++){ 
                $status = true;
                for($a=0;$a < count($dadosConfigura); $a++){
                    if($dadosConfigura[$a]["descricao_configuracao"] == $configuracao[$i]){
                        $status = false;
                    }
                }
                if($status){
                    $confg = array(
                        "descricao_valor_configuracao" => $json->{$configuracao[$i]},
                        "configuracao_valor_configuracao" => $this->Configuracao->buscaConfigPorDescricaoReturnCodigo($configuracao[$i]),
                        "empresa_valor_configuracao" => $empresaLogada["codigo_empresa"]
                        );
                    $this->Valor_configuracao_model->insereValorConfiguracao($confg);   
                }
            }
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
}
