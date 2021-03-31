<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuracao
 *
 * @author Alexandre
 */
class Configuracao extends CI_Model{
    //put your code here
    public function buscaConfigPorDescricao($descri){
         if($descri == null){throw new Exception("(Configuracao) metodo buscaConfigPorDescricao com parametros nulos");}
         $this->db->where("descricao_configuracao", $descri);
         return $this->db->get("configuracao")->row_array();
    }
    public function buscaConfigPorDescricaoReturnCodigo($descri){
         if($descri == null){throw new Exception("(Configuracao) metodo buscaConfigPorDescricao com parametros nulos");}
         $this->db->where("descricao_configuracao", $descri);
         $resp =  $this->db->get("configuracao")->row_array();
         return $resp["codigo_configuracao"];
    }
     
    // cada nova personalização coloque mais um aki
    public function todasConfiguracoesAlteraveis(){
        $resp =  $this->db->get("configuracao")->result_array();
        for($i=0;$i < count($resp); $i++){
           $configuracao[] = $resp[$i]["descricao_configuracao"]; 
        }
        return $configuracao;
    }

}
