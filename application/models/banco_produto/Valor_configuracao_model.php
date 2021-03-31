<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of valor_configuracao_model
 *
 * @author Alexandre
 */
class Valor_configuracao_model extends CI_Model{
    //put your code here
    public function tipoImpressao (){
        $tipoImpressao[0] = array("valor" => 1,"desc" => "Não Imprimir");
        $tipoImpressao[1] = array("valor" => 2,"desc" => "Bematech MP-4200");
        return $tipoImpressao;
    }
    
    public function buscaConfigEmpresa($descConfig, $codigo){
        if($codigo == null){
            throw new Exception("(Valor_configuracao_model) metodo buscaPorCodigoCliente com parametros nulos");
        }
        $this->db->where("descricao_configuracao", $descConfig);
        $this->db->where("empresa_valor_configuracao", $codigo);
        $this->db->join('configuracao', 'configuracao.codigo_configuracao = valor_configuracao.configuracao_valor_configuracao');
        $configuracao =  $this->db->get("valor_configuracao")->row_array();
        if($configuracao == null || $configuracao == "" || count($configuracao) == 0){
            return "";
        }
        return $configuracao["descricao_valor_configuracao"];
    }
    public function buscaPorCodigoCliente($codigo){
        if($codigo == null){
            throw new Exception("(Valor_configuracao_model) metodo buscaPorCodigoCliente com parametros nulos");
        }
        $this->db->where("empresa_valor_configuracao", $codigo);
        $this->db->join('configuracao', 'configuracao.codigo_configuracao = valor_configuracao.configuracao_valor_configuracao');
        $configuracao = $this->db->get("valor_configuracao")->result_array();
        return $configuracao;
    }

    public function buscaPorCodigoClienteEConfiguracao($codigo, $config){
        if($codigo == null || $config == null){
            throw new Exception("(Valor_configuracao_model) metodo buscaPorCodigoClienteEConfiguracao com parametros nulos");
        }
        $this->db->where("empresa_valor_configuracao", $codigo);
        $this->db->where("configuracao_valor_configuracao", $config);
        $configuracao = $this->db->get("valor_configuracao")->result_array();
        return $configuracao;
    }
    public function alterarValorConfiguracao($confg){
        if($confg == null){
            throw new Exception("(Valor_configuracao_model) metodo alterarValorConfiguracao com parametros nulos");
        }
        $this->db->where('codigo_valor_configuracao', $confg['codigo_valor_configuracao']);
        $this->db->set($confg);
        $resultado =  $this->db->update("valor_configuracao",$confg);
    }
    
    public function insereValorConfiguracao($valorConfg){
        if($valorConfg == null){throw new Exception("(Valor_configuracao_model) metodo insereValorConfiguracao com parametros nulos");}
        $resultado = $this->db->insert("valor_configuracao",$valorConfg);
        return $resultado;
    }
}
