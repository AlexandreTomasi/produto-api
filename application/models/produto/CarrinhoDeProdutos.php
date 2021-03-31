<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarrinhoDeProdutos
 *
 * @author Alexandre
 */
class CarrinhoDeProdutos extends CI_Model{
    //put your code here
    function numeroEmReais($numero){
        return "R$ " . number_format($numero,2, ",",".");
    }
    public function mostrarCarrinhoProdutos($produtoSelecionado, $empresa){
        $this->load->model("banco_produto/Produto_model");
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $preco = 0;
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

                $subtitulo = $quantidade." x ".$preco." =".$this->numeroEmReais($preco*$quantidade);
                $galeria[] = array(
                    "title"=> $raiz["descricao_produto"],
                    "image_url"=> "",
                    "subtitle"=> $subtitulo,
                    "buttons" =>array(
                        array(
                            "type"=> "show_block",
                            "block_name"=> "Fluxo 17",
                            "title"=> "Alterar quantidade"
                        ),
                        array(
                            "type"=> "show_block",
                            "block_name"=> "Fluxo 17",
                            "title"=> "Remover"
                        )
                    )
                );
            }
        }
        if($galeria != null && count($galeria) >0){
            $galeriaFim = array();
            $max = 10;
            if($max > count($galeria)){
                $max = count($galeria);
            }
            for($i=0; $i < $max; $i++){
                $galeriaFim[] = $galeria[$i];
            }
            $reposta = $this->UtilitarioGeradorDeJSON->gerarGaleria($galeriaFim);
            return $reposta;
        }else{
            return "";
        }
    }
    
     /*Também é apresentado o subtotal do pedido de acordo com a galeria, a taxa de entrega e o total do pedido.*/
    public function mostrarSubtotalDoPedido($bairro, $produtoSelecionado, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        $this->load->model("banco_produto/Taxa_entrega_model");
        $preco = 0;
        $valorTotal = 0;
        $resposta = "";
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
                $resposta = $resposta.$raiz["descricao_produto"]." ".$this->numeroEmReais($preco*$quantidade).".\n";
                ///$subtitulo = $quantidade." x ".$preco." =".$this->numeroEmReais($preco*$quantidade);
                $valorTotal = $valorTotal + $preco;
            }
        }
        $taxa = $this->Taxa_entrega_model->buscarTaxaEntregaPorBairro($empresa, $bairro);
        $valorTotal = $valorTotal + $taxa["preco_taxa_entrega"];
        $resposta = $resposta."Taxa de entrega ".$this->numeroEmReais($taxa["preco_taxa_entrega"]).".\n";
        $resposta = $resposta."Valor total do pedido ".$this->numeroEmReais($valorTotal);
        $rep = $this->UtilitarioGeradorDeJSON->gerarMensagemDeTexto($resposta);
        return $rep;
    }
    
    public function mostrarSubmenuEmpresa(){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $rapida = array();
        $rapida[] = array("titulo" => "Adicionar Mais Itens","bloco" => "Fluxo 7");
        $rapida[] = array("titulo" => "Finalizar Pedido","bloco" => "Fluxo 31");
        $rep = $this->UtilitarioGeradorDeJSON->gerarRespostaRapida("Deseja mais alguma coisa?", $rapida);
        return $rep;
    }
    
    public function resumoDoPedido($bairro, $produtoSelecionado, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        $this->load->model("banco_produto/Taxa_entrega_model");
        $preco = 0;
        $valorTotal = 0;
        $resposta = "";
        $completo = explode("F",$produtoSelecionado);
        $galeria = array();
        for($p=0; $p < count($completo); $p++){
            $preco = 0;
            if($completo[$p] != null && $completo[$p] != ""){
                $produtos = explode("@",$completo[$p]);
                $texto = "";
                $temp = explode("q",$produtos[0]);
                $raiz = $this->Produto_model->buscarProdutoPorCodigo($temp[0], $empresa);
                $quantidade = $temp[1];
                for($i=0; $i < count($produtos); $i++){
                    $produto = explode("q",$produtos[$i]);
                    $atual = $this->Produto_model->buscarProdutoPorCodigo($produto[0], $empresa);      
                    if($produto[1] == 0){$produto[1] = 1;};
                    $texto = $texto." ".($produto[1] == 1 ? "":$produto[1]."-").$atual["nome_produto"];
                    if($atual["preco_produto"] != null && $atual["preco_produto"] > 0){
                        $preco = $preco + ($atual["preco_produto"]*$produto[1]);
                    }
                }
                $resposta = $resposta.$texto." Total:".$this->numeroEmReais($preco*$quantidade).".\n";
                //$resposta = $resposta.$texto;
                ///$subtitulo = $quantidade." x ".$preco." =".$this->numeroEmReais($preco*$quantidade);
                $valorTotal = $valorTotal + $preco;
            }
        }
        $taxa = $this->Taxa_entrega_model->buscarTaxaEntregaPorBairro($empresa, $bairro);
        $valorTotal = $valorTotal + $taxa["preco_taxa_entrega"];
        $resposta = $resposta."Taxa de entrega ".$this->numeroEmReais($taxa["preco_taxa_entrega"]).".\n";
        $resposta = $resposta."Valor total do pedido ".$this->numeroEmReais($valorTotal);
        $rep = $this->UtilitarioGeradorDeJSON->gerarMensagemDeTexto($resposta);
        return $rep;
    }
}
