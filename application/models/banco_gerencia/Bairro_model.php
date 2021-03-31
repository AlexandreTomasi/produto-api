<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bairro_model
 *
 * @author 033234581
 */
class Bairro_model extends CI_Model{
    //put your code here
    public function buscaBairros(){
        $bdgerente = $this->load->database('gerencia', true);
        $bdgerente->order_by('descricao_bairro', 'asc');
        return $bdgerente->get('bairro')->result_array();
    }
    
    public function buscaBairrosPorCodigo($codigo){
        $bdgerente = $this->load->database('gerencia', true);
        $bdgerente->where("codigo_bairro", $codigo);
        return $bdgerente->get('bairro')->row_array();
    }
}
