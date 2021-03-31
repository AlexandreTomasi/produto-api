<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorProdutos
 *
 * @author 033234581
 */
/*
        $produto = $this->Produto_model->buscarProdutoPorCodigo($codigo, $empresa);
        $produto = $this->Produto_model->buscarProdutosRaiz($empresa);
        $produto = $this->Produto_model->buscarProximoProdutoPai($codgRaiz, $codgIrmao, $empresa);
        $produto = $this->Produto_model->buscaroProdutosFilhos($codgPai, $empresa);
        
 */
class ControladorProdutos extends CI_Controller{
    //put your code here
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
    
    public function buscarProduto(){
        $this->verificaUsuarioLogado();
        $this->load->model("banco_produto/Produto_model");
        try{
            $empresaLogada = $this->session->userdata("empresa_logada"); 
            $raiz = $this->Produto_model->buscarProdutosRaiz($empresaLogada["codigo_empresa"]);
            echo $raiz[0]["nome_produto"];

            $produto = $this->Produto_model->buscarProximoProdutoPai($raiz[0]["codigo_produto"], $raiz[0]["codigo_produto"], $empresaLogada["codigo_empresa"]);
            echo $produto["nome_produto"];

            $filhos= $this->Produto_model->buscaroProdutosFilhos($produto["codigo_produto"], $empresaLogada["codigo_empresa"]);
            echo $filhos[0]["nome_produto"];
            $produtoTemp = $this->Produto_model->buscarProdutoPorCodigo($filhos[0]["codigo_produto"], $empresaLogada["codigo_empresa"]);
            echo $produtoTemp["nome_produto"];
            $this->load->view("produto/ViewManterProduto.php");
            
        }catch (Exception $e){
            $fp = fopen("log_skybots.txt", "a");
            $escreve = fwrite($fp, "\n".date('Y-m-d H:i:s')." - ".($empresaLogada["codigo_empresa"])." ".$e->getMessage());
            fclose($fp); 
            throw new Exception($e->getMessage());
        }
    }
}
