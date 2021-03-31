<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produto_model
 *
 * @author 033234581
 */
class Produto_model extends CI_Model{
    //put your code here
    
    public function buscarProdutoPorCodigo($codigo, $empresa){
        if($codigo == null || $empresa == null){
            throw new Exception("(Produto_model) metodo buscarProdutoPorCodigo com parametros nulos");
        }
        $this->db->where("codigo_produto", $codigo);
        $this->db->where("empresa_produto", $empresa);
        $this->db->where("ativo_produto", 1);
        return $this->db->get("produto")->row_array();
    }
    
    public function buscarProdutosRaiz($empresa){
        if($empresa == null){
            throw new Exception("(Produto_model) metodo buscarProdutoPorCodigo com parametros nulos");
        }
        $this->db->where("produto_pai_produto", null);
        $this->db->where("produto_irmao_produto", null);
        $this->db->where("empresa_produto", $empresa);
        $this->db->where("ativo_produto", 1);
        return $this->db->get("produto")->result_array();
    }
    
    public function buscarProdutoPorNome($nome, $empresa){
        if($nome == null || $empresa == null){
            throw new Exception("(Produto_model) metodo buscarProdutoPorCodigo com parametros nulos");
        }
        $this->db->where("nome_produto", $nome);
        $this->db->where("empresa_produto", $empresa);
        $this->db->where("ativo_produto", 1);
        return $this->db->get("produto")->row_array();
    }
    
    
    public function buscarProximoProdutoPai($codgIrmao, $empresa){
        if($codgIrmao == null || $empresa == null){
            throw new Exception("(Produto_model) metodo buscarProdutoPorCodigo com parametros nulos");
        }
        $this->db->where("produto_pai_produto", null);
        $this->db->where("produto_irmao_produto", $codgIrmao);
        $this->db->where("empresa_produto", $empresa);
        $this->db->where("ativo_produto", 1);
        return $this->db->get("produto")->row_array();
    }
    
    public function buscaroProdutosFilhos($codgPai, $empresa){
        if($codgPai == null || $empresa == null){
            throw new Exception("(Produto_model) metodo buscaroProdutoFilhos com parametros nulos");
        }
        $this->db->where("produto_pai_produto", $codgPai);
        $this->db->where("produto_irmao_produto", null);
        $this->db->where("empresa_produto", $empresa);
        $this->db->where("ativo_produto", 1);
        return $this->db->get("produto")->result_array();
    }
    
    
    public function alterarProdutoPorCodigo($produto, $empresa){
        if($produto == null || $empresa == null){
            throw new Exception("(Produto_model) metodo alterarProdutoPorCodigo com parametros nulos");
        }
        $this->db->where('codigo_produto', $produto['codigo_produto']);
        $this->db->where("empresa_produto", $empresa);
        $this->db->set($produto);
        $resultado =  $this->db->update("produto",$produto);
        return $resultado;
    }
}
