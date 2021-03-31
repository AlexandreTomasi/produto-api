<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidoChatbot
 *
 * @author 033234581
 */
class PedidoChatbot extends CI_Model{
    //put your code here
    public function incluirPedidoSolicitadoFacebook($empresa, $produtoSelecionado, $observacaoCliente, $trocoCliente, $nome, $sobrenome, $fb_id, $telefoneCliente, $sexo,
                                                    $mapUrl, $messengerId, $bairro, $estado, $cep, $cidade, $endereco, $complementoEndereco, $formaPagamento){
        $this->load->model("banco_gerencia/Cidade_model");
        $this->load->model("banco_gerencia/Uf_model");
        $this->load->model("banco_produto/Cliente_model");
        $this->load->model("banco_produto/Pedido_model");
        $this->load->model("banco_produto/Taxa_entrega_model");
        $this->load->model("banco_produto/Item_pedido_model");
        $this->load->model("banco_produto/Produto_model");
        $this->db->trans_start();
        if($sexo == "male"){
                $sexo='M';
        }else{
                $sexo='F';
        }
        $estado=$this->Uf_model->buscaEstadoPorNome($estado);
        $cidade=$this->Cidade_model->buscaCidadePorNome($cidade);
        $cliente = $this->Cliente_model->buscarClientesFBid($fb_id, $empresa);
        if($trocoCliente != 0){
            $trocoCliente = "Levar troco para R$".$trocoCliente.". ";
        }else{
            $trocoCliente = "";
        }
        if($observacaoCliente != null && 0 == strnatcasecmp($observacaoCliente,"Nenhuma")){
            $observacaoCliente="";
        }else{
            $observacaoCliente = " Observação do cliente: ".$observacaoCliente;
        }
        // verifica se cliente esta ativo ou seja nao esta bloquiado.
        if($cliente != null && $cliente["ativo_cliente"] != 1){
            throw new Exception("Cliente: ".$cliente['nome_cliente']." está bloquiado para fazer pedido");
        }
        if($cliente == null){
            // inserir novo cliente
            $cliente = array(
                //"cpf_cliente" => "",
                "nome_cliente" => $nome." ".$sobrenome,
                //"email_cliente" => "",
                "id_facebook_cliente" => $fb_id,
                "telefone_cliente" => $telefoneCliente,
                "cep_cliente" => $cep,
                "endereco_cliente" => $complementoEndereco ,
                "complemento_endereco_cliente" => $mapUrl,
                "cidade_cliente" => $cidade["codigo_cidade"],
                "uf_cliente" => $estado["codigo_uf"],
                "sexo_cliente" => $sexo,
                "referencia_endereco_cliente" => "",//$endereco,
                "empresa_cliente" => $empresa,                    
                "bairro_cliente" =>$bairro,
                "ativo_cliente" =>1
            );
            $this->Cliente_model->inserirCliente($cliente);            
        }
        $cliente = $this->Cliente_model->buscarClientesFBid($fb_id, $empresa); 
        $custoTotalPedido = $this->calcularValorTotalPedido($bairro, $produtoSelecionado, $empresa);
        $pedido = array(
                //"codigo_pedido" => "",
                "data_hora_pedido" => date('Y-m-d H:i:s'),
                "cliente_pedido" => $cliente["codigo_cliente"],
                "valor_total_pedido" => $custoTotalPedido[0],
                "forma_pagamento_pedido" => $formaPagamento,
                "observacao_pedido" => $trocoCliente.$observacaoCliente,
                "empresa_pedido" => $empresa,
                "telefone_pedido" => $telefoneCliente,
                "endereco_pedido" => $complementoEndereco ,
               //"numero_endereco_pedido" => ,
                //"complemento_endereco_pedido" => $mapUrl,
                "cidade_pedido" => $cidade["codigo_cidade"],
                "uf_pedido" => $estado["codigo_uf"],
                "referencia_endereco_pedido" => "",//$endereco,
                "bairro_pedido" => $bairro,
                "cep_pedido"=> $cep,
                "mapa_url_pedido" => $mapUrl,
                "status_pedido"=> 1
        );
        $pedido["codigo_pedido"] = $this->Pedido_model->inserirPedidoRetornadoCodigoInserido($pedido);
        
        $completo = explode("F",$produtoSelecionado);
        $a=1;
        for($i=0; $i < count($completo); $i++){
            if($completo[$i] != null && $completo[$i] != ""){
                $produtos = explode("@",$completo[$i]);
                $temp = $produtos[0];
                for($p=0; $p < count($produtos); $p++){
                    $item = explode("q",$produtos[$p]);
                    $itemAtual = $this->Produto_model->buscarProdutoPorCodigo($item[0], $empresa);
                    $itemPedido = array();
                    if($itemAtual["preco_produto"] != null){
                        if($item[1] == 0){$item[1] = 1;}
                        $itemPedido = array(
                            "quantidade_item_pedido" => $item[1],
                            "valor_subtotal_item_pedido"=> $itemAtual["preco_produto"]*$item[1],
                            "pedido_item_pedido" => $pedido["codigo_pedido"],
                            "produto_item_pedido" =>$item[0]
                        );
                    }else{
                        $itemPedido = array(
                            "quantidade_item_pedido" => $item[1],
                            "valor_subtotal_item_pedido"=> 0,
                            "pedido_item_pedido" => $pedido["codigo_pedido"],
                            "produto_item_pedido" => $item[0]
                        );

                    }
                    if($itemPedido["quantidade_item_pedido"] == 0){$itemPedido["quantidade_item_pedido"] = 1;}
                    $this->Item_pedido_model->inserirItemPedido($itemPedido);
                }
            }
        }
        
        //inserir taxa de entrega como item pedido
        $taxa = $this->Taxa_entrega_model->buscarTaxaEntregaPorBairro($empresa, $bairro);
        if($taxa == null){throw new Exception("buscarTaxaEntregaPorBairro nao retornou dados. Funcionalidade: pedidoPizzaria->incluirPedidoSolicitadoFacebook");}
        if($taxa != null){
            $itemPedido = array(
                "quantidade_item_pedido" => 1,
                "valor_subtotal_item_pedido"=> $taxa["preco_taxa_entrega"],
                "pedido_item_pedido" => $pedido["codigo_pedido"]
            );
            $this->Item_pedido_model->inserirItemPedido($itemPedido);
        }
        $this->db->trans_complete();
        $inserido = 1;
        return $inserido;
    }
    
    public function calcularValorTotalPedido($bairro, $produtoSelecionado, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        $this->load->model("banco_produto/Taxa_entrega_model");
        $preco = 0;
        $valorTotal = 0;
        $orcamento = array();
        $orcamento[] = 0;
        $completo = explode("F",$produtoSelecionado);
        $galeria = array();
        for($p=0; $p < count($completo); $p++){
            $preco = 0;
            if($completo[$p] != null && $completo[$p] != ""){
                $produtos = explode("@",$completo[$p]);
                //$temp = $produtos[0];
                $temp = explode("q",$produtos[0]);
                $raiz = $this->Produto_model->buscarProdutoPorCodigo($temp[0], $empresa);
                $quantidade = $temp[1];
                for($i=0; $i < count($produtos); $i++){
                    $produto = explode("q",$produtos[$i]);
                    $atual = $this->Produto_model->buscarProdutoPorCodigo($produto[0], $empresa);
                    if($atual["preco_produto"] != null && $atual["preco_produto"] > 0){
                        if($produto[1] > 0){
                            $preco = $preco + ($atual["preco_produto"]*$produto[1]);
                        }else{
                            $preco = $preco + $atual["preco_produto"];
                        }
                    }
                }
                ///$subtitulo = $quantidade." x ".$preco." =".$this->numeroEmReais($preco*$quantidade);
                $orcamento[] = $preco;
                $valorTotal = $valorTotal + $preco;
            }
        }        
        $taxa = $this->Taxa_entrega_model->buscarTaxaEntregaPorBairro($empresa, $bairro);
        $valorTotal = $valorTotal + $taxa["preco_taxa_entrega"];
        $orcamento[0] = $valorTotal;
        return $orcamento;
    }
}
