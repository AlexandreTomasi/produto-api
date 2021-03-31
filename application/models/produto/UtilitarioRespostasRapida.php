<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilitarioRespostasRapida
 *
 * @author 033234581
 */
class UtilitarioRespostasRapida extends CI_Model{
    //put your code here
    //gera reposta rapida apenas com botoes e um bloco em cada botão
    public function gerarRespostaRapida($mensagem, $atributos){//os atributos tem que ser um array de titulo e bloco
        if($mensagem == null){$mensagem = "";}
        if($atributos != null && count($atributos) != 0){
            //gerar os botoes
            $botoes = array();
            for($i=0; $i < count($atributos); $i++){
                $botoes[] = array('title' => $atributos[$i]["titulo"],'block_names' => array($atributos[$i]["bloco"]));
            }
            $dados = array('messages' => array(
                            array(
                                'text' => $mensagem,
                                'quick_replies' => $botoes
                            ))
                          );
            return $dados;
        }
        return "";
    }
    public function pergunta1a9normal($quantidade, $faixa){
        $botoes = array();
        if($quantidade == -1){// ilimitado
            // vai de 8 a 8 para facilitar
            $max = $faixa *8;
            $min= $max - 7;
            if($min >= 9){
                $botoes[] = array("titulo" => "Menos","bloco" => "Fluxo 11");
            }
            for($i=$min; $i <= $max; $i++){
                $botoes[] = array("titulo" => $i,"bloco" => "Fluxo 13");
            }
            $botoes[] = array("titulo" => "Mais","bloco" => "Fluxo 11");
        }
        return $this->gerarRespostaRapida("Selecione", $botoes);
    }
    
    /*public function perguntaAteOMaximo($quantidade, $faixa){
        $botoes = array();
        $atingiu = false;
            // vai de 8 a 8 para facilitar
            $max = $faixa *8;
            $min= $max - 7;
            if($max >= $quantidade){
                $max = $quantidade;
                $atingiu = true;
            }
            if($faixa > 1){
                $botoes[] = array("titulo" => "Menos","bloco" => "Fluxo 11");
            }
            for($i=$min; $i <= $max; $i++){
                $botoes[] = array("titulo" => $i,"bloco" => "Fluxo 13");
            }
            if($atingiu == false){
                $botoes[] = array("titulo" => "Mais","bloco" => "Fluxo 11");
            }
        return $this->gerarRespostaRapida("Selecione", $botoes);
    }*/
    
    public function perguntaAteQuantidadeMaxima($quantidade, $faixa){
        $botoes = array();
        $atingiu = false;
            // vai de 8 a 8 para facilitar
            $max = $faixa *8;
            $min= $max - 7;
            if($max >= $quantidade){
                $max = $quantidade;
                $atingiu = true;
            }
            if($faixa > 1){
                $botoes[] = array("titulo" => "Menos","bloco" => "Fluxo 11");
            }
            for($i=$min; $i <= $max; $i++){
                $botoes[] = array("titulo" => $i,"bloco" => "Fluxo 13");
            }
            if($atingiu == false){
                $botoes[] = array("titulo" => "Mais","bloco" => "Fluxo 11");
            }
        return $this->gerarRespostaRapida("Selecione", $botoes);
    }
}
