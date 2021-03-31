<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormaDePagamento
 *
 * @author 033234581
 */
class FormaDePagamento extends CI_Model{
    //put your code here
    public function criaGaleriaFormaPagamento($formas){
        $total = count($formas);
        $botoes = array();
        $galeria = array();
        for($i=0; $i < $total; $i++){
            $galeria[$i] = array(
                "title"=> $formas[$i]["descricao_forma_pagamento"],
                "image_url"=> "",
                "subtitle"=> $formas[$i]["descricao_forma_pagamento"],
                "buttons" =>array(
                    array(
                        "type"=> "show_block",
                        "block_name"=> "Fluxo 37",
                        "title"=> $formas[$i]["descricao_forma_pagamento"]
                    )
                )
            );
        }
        $dados = array('messages' => array(
                    array('attachment' => array(
                        'type' => 'template',
                        'payload' => array(
                            'template_type' => "generic",
                            'elements' => $galeria                         
                        )                
                    ))
                 ));
        $json_str = json_encode($dados);
        return $json_str;
    }
    
    public function setaFormaPagamentoNaVariavel($pizzaria, $FormaPgSelecionada){
        $this->load->model("banco_produto/Forma_pagamento_model");
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $formaPagamento = $this->Forma_pagamento_model->buscarFormaPagamentoDescricaoAtivas($FormaPgSelecionada, $pizzaria);
        if($formaPagamento == null){
            throw new Exception("buscar Forma Pagamento Descricao Ativas, nao retornou dados. Funcionalidade: setaValorFormaPagamento->setaFormaPagamentoNaVariavel");
        }
        return $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("FormaPgCliente" => $formaPagamento["codigo_forma_pagamento"]));
    }
}
