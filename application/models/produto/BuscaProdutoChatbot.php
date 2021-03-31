<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BuscaProdutoChatbot
 *
 * @author Alexandre
 */
class BuscaProdutoChatbot extends CI_Model{
    //put your code here
    
    public function descricaoProduto($caminhoProduto, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        if($caminhoProduto == null || $caminhoProduto == "0"){
            return "";
        }
        $produtoTemp = explode("-",$caminhoProduto);
        $produtoRaiz = $produtoTemp[0];
        $produtoAtual = $produtoTemp[count($produtoTemp)-1];
        $produtoAtual = $this->Produto_model->buscarProdutoPorCodigo($produtoAtual, $empresa);
        return $this->UtilitarioGeradorDeJSON->gerarMensagemDeTexto($produtoAtual["descricao_produto"]);
    }
    public function perguntaRapidaQuantidade($botaoSelecionado, $faixa, $empresa){
        $this->load->model("produto/UtilitarioRespostasRapida");
        $this->load->model("banco_produto/Produto_model");
        $botoes = array();
        if($botaoSelecionado == "Não, obrigado(a)" || $botaoSelecionado == "+ Opções"){return "";}
        $produtoEscolhido = $this->Produto_model->buscarProdutoPorNome($botaoSelecionado, $empresa);
        if($produtoEscolhido != null){
            $filhos= $this->Produto_model->buscaroProdutosFilhos($produtoEscolhido["codigo_produto"], $empresa);
            // se o produto não tem filhos entao ele é folha só para ter certeza
            if(($filhos != null || count($filhos) > 0)){return "";}
            if($produtoEscolhido["quantidade_maxima_produto"] == -1){
                return $this->UtilitarioRespostasRapida->pergunta1a9normal($produtoEscolhido["quantidade_maxima_produto"], $faixa);
            }else{
                return $this->UtilitarioRespostasRapida->perguntaAteQuantidadeMaxima($produtoEscolhido["quantidade_maxima_produto"], $faixa);
            }
        }
    }
    public function precisaDeQuantidade($botaoSelecionado, $quantidade, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        if($quantidade != 0){
            return "";
        }
        if($botaoSelecionado == "Não, obrigado(a)" || $botaoSelecionado == "+ Opções"){
            return "";
        }
        $produtoEscolhido = $this->Produto_model->buscarProdutoPorNome($botaoSelecionado, $empresa);
        $filhos= $this->Produto_model->buscaroProdutosFilhos($produtoEscolhido["codigo_produto"], $empresa);
        // se o produto não tem filhos entao ele é folha
        if(($filhos == null || count($filhos) <=0) && ($produtoEscolhido["quantidade_maxima_produto"] == -1 || $produtoEscolhido["quantidade_maxima_produto"] > 1)){
            $reposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos("","Fluxo 11");
            return $reposta;
        }
    }
    public function buscaProdutoPorFaixa($caminhoProduto, $produtoSelecionado, $empresa, $faixaProduto){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        $nao = false;//variavel que indica se vai ter opção nao obrigado
        if($caminhoProduto != null || $caminhoProduto != "0"){
            
        }
        if($caminhoProduto == null || $caminhoProduto == "0"){// sei que é primeira vez que vem aki
           //busco as raizes para usuario escolher   
            $raiz = $this->Produto_model->buscarProdutosRaiz($empresa);
            if(count($raiz) == 1){
                $reposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos("","Fluxo 9");
                return $reposta;
            }
            $galeria = $this->gerarGaleriaProdutoFim($raiz, $faixaProduto, false);
            $reposta = $this->UtilitarioGeradorDeJSON->gerarGaleria($galeria);
            return $reposta;
        }else{
            $produtoTemp = explode("-",$caminhoProduto);
            $produtoRaiz = $produtoTemp[0];
            $produtoAtual = $produtoTemp[count($produtoTemp)-1];
            
            $pai = $this->Produto_model->buscarProdutoPorCodigo($produtoAtual, $empresa);
            $filhos= $this->Produto_model->buscaroProdutosFilhos($pai["codigo_produto"], $empresa);
            if($pai["quantidade_minima_produto"] == 0){
                $nao = true;
            }
            $filhos = $this->retiraItensJaSelecionados($filhos, $produtoSelecionado);
            if($filhos == null || count($filhos) <= 0){//ou seja foi selecionado todas as opçoes
                $reposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos("","Fluxo 9");
                return $reposta;
            }
            $galeria = $this->gerarGaleriaProdutoFim($filhos, $faixaProduto,$nao);
            $reposta = $this->UtilitarioGeradorDeJSON->gerarGaleria($galeria);
            return $reposta;
        }
        
    }
    
    private function retiraItensJaSelecionados($produtos, $produtoSelecionado){
        $completo = explode("F",$produtoSelecionado);
        $temp = $completo[count($completo)-1]; 
        $escolhidos = explode("@",$temp);
        $listafim = array();
        for($i=0; $i < count($produtos); $i++){
            $existe = false;
            for($a=0; $a < count($escolhidos); $a++){
                $temp = explode("q",$escolhidos[$a]);
                if(intval($produtos[$i]["codigo_produto"]) == intval($temp[0])){
                    $existe = true;
                    break;
                }
            }
            if($existe == false){
                $listafim[] = $produtos[$i];
            }
        }
        return $listafim;   
    }
    public function recebeProdutoSelecionado($faixaProduto, $produtoSelecionado, $botaoSelecionado, $caminhoProduto, $quantidade, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        if($botaoSelecionado == "Não, obrigado(a)"){
            $produtoTemp = explode("-",$caminhoProduto);
            $produtoRaiz = $produtoTemp[0];
            $codgProdutoAtual = $produtoTemp[count($produtoTemp)-1];
            $produtoAtual = $this->Produto_model->buscarProdutoPorCodigo($codgProdutoAtual, $empresa);
            if($produtoAtual["produto_pai_produto"] == null || $produtoAtual["produto_pai_produto"] == $produtoRaiz){
                $irmao = $this->Produto_model->buscarProximoProdutoPai($produtoAtual["codigo_produto"], $empresa);
                if($irmao == null){
                    $reposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos("","Fluxo 15");
                    return $reposta;
                }
                $caminhoProduto = $caminhoProduto."-".$irmao["codigo_produto"];
                $atributos = array("CaminhoProduto" => $caminhoProduto,"ProdutoSelecionado" => $produtoSelecionado);
                $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                return $reposta;
            }
            for($i=((count($produtoTemp))-2); $i >= 0; $i--){
                $pai = $this->Produto_model->buscarProdutoPorCodigo($produtoTemp[$i], $empresa);
                if($pai["produto_pai_produto"] == null || $pai["produto_pai_produto"] == $produtoRaiz){
                    if($this->verificaAtingiuQuantidadeMaxima($pai["codigo_produto"], $produtoSelecionado, $empresa) == 0 ||
                            $this->verificaEscolheuTodasOpcoes($pai["codigo_produto"], $produtoSelecionado, $empresa) == 0){//se sim
                        $irmao = $this->Produto_model->buscarProximoProdutoPai($pai["codigo_produto"], $empresa);
                        if($irmao == null){
                            $reposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos("","Fluxo 15");
                            return $reposta;
                        }
                        $caminhoProduto = $caminhoProduto."-".$irmao["codigo_produto"];
                        $atributos = array("CaminhoProduto" => $caminhoProduto,"ProdutoSelecionado" => $produtoSelecionado);
                        $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                        return $reposta; 
                    }
                    $caminhoProduto = $caminhoProduto."-".$pai["codigo_produto"];
                    $atributos = array("CaminhoProduto" => $caminhoProduto,"ProdutoSelecionado" => $produtoSelecionado);
                    $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                    return $reposta;
                }
                $filhos= $this->Produto_model->buscaroProdutosFilhos($pai["codigo_produto"], $empresa);
                if($filhos != null && count($filhos) > 0){
                    if($this->verificaAtingiuQuantidadeMaxima($pai["codigo_produto"], $produtoSelecionado, $empresa) == 1 &&
                            $this->verificaEscolheuTodasOpcoes($pai["codigo_produto"], $produtoSelecionado, $empresa) == 1){//se não
                        if($produtoAtual["codigo_produto"] != $pai["codigo_produto"]){
                            $caminhoProduto = $caminhoProduto."-".$pai["codigo_produto"];
                            $atributos = array("CaminhoProduto" => $caminhoProduto,"ProdutoSelecionado" => $produtoSelecionado);
                            $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                            return $reposta;
                        }
                    }
                }
            }
        }
        
        if($caminhoProduto == null || $caminhoProduto == "0"){
            if($botaoSelecionado != null && $botaoSelecionado != ""){
                $raiz = $this->Produto_model->buscarProdutoPorNome($botaoSelecionado, $empresa);
                if($raiz == null){
                    $raiz = $this->Produto_model->buscarProdutosRaiz($empresa);
                    if($raiz != null && count($raiz) == 1){
                        $filhos= $this->Produto_model->buscaroProdutosFilhos($raiz[0]["codigo_produto"], $empresa);
                        $caminho =$raiz[0]["codigo_produto"]."-".$filhos[0]["codigo_produto"];
                        $selecionado = $raiz[0]["codigo_produto"]."q1@".$filhos[0]["codigo_produto"]."q1";
                        if($produtoSelecionado == 0 || $produtoSelecionado == null){
                            $atributos = array("CaminhoProduto" => $caminho,"ProdutoSelecionado" => $selecionado);
                            $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                            return $reposta;
                        }else{
                            $atributos = array("CaminhoProduto" => $caminho,"ProdutoSelecionado" => $produtoSelecionado.$selecionado);
                            $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                            return $reposta;
                        }
                    }
                }
                // sei quem é a raiz entao busco unico filho dela e seleciono já
                $filhos= $this->Produto_model->buscaroProdutosFilhos($raiz["codigo_produto"], $empresa);
                $caminho =$raiz["codigo_produto"]."-".$filhos[0]["codigo_produto"];
                $selecionado = $raiz["codigo_produto"]."q1"."@".$filhos[0]["codigo_produto"]."q1";
                if($produtoSelecionado == 0 || $produtoSelecionado == null){
                    $atributos = array("CaminhoProduto" => $caminho,"ProdutoSelecionado" => $selecionado);
                    $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                    return $reposta;
                }else{
                    $atributos = array("CaminhoProduto" => $caminho,"ProdutoSelecionado" => $produtoSelecionado.$selecionado);
                    $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                    return $reposta;
                }
                
            }else{//sei que existe uma raiz apenas
                
                $raiz = $this->Produto_model->buscarProdutosRaiz($empresa);
                $filhos= $this->Produto_model->buscaroProdutosFilhos($raiz[0]["codigo_produto"], $empresa);
                $caminho =$raiz[0]["codigo_produto"]."-".$filhos[0]["codigo_produto"];
                $selecionado = $raiz[0]["codigo_produto"]."q1@".$filhos[0]["codigo_produto"]."q1";
                if($produtoSelecionado == 0 || $produtoSelecionado == null){
                    $atributos = array("CaminhoProduto" => $caminho,"ProdutoSelecionado" => $selecionado);
                    $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                    return $reposta;
                }else{
                    $atributos = array("CaminhoProduto" => $caminho,"ProdutoSelecionado" => $produtoSelecionado.$selecionado);
                    $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
                    return $reposta;
                }
            }
        }else{
            
            $produtoEscolhido = $this->Produto_model->buscarProdutoPorNome($botaoSelecionado, $empresa);
            $caminhoProduto = $caminhoProduto."-".$produtoEscolhido["codigo_produto"];
            
            $produtoTemp = explode("-",$caminhoProduto);
            $produtoRaiz = $produtoTemp[0];
            $produtoAtual = $produtoTemp[count($produtoTemp)-1];
            
            $produtoSelecionado = $produtoSelecionado."@".$produtoEscolhido["codigo_produto"]."q".$quantidade;
            // ate aqui ja seletei o produto que ele selecionou
            $filhos = array();
            $pai = array();
            $buscarIrmao = false;
            // ir ate o proximo produto para selecionar
            for($i=((count($produtoTemp))-1); $i >= 0; $i--){
                $pai = $this->Produto_model->buscarProdutoPorCodigo($produtoTemp[$i], $empresa);
                if($pai["produto_pai_produto"] == null || $pai["produto_pai_produto"] == $produtoRaiz){
                    if($this->verificaAtingiuQuantidadeMaxima($pai["codigo_produto"], $produtoSelecionado, $empresa) == 1 && 
                            $this->verificaEscolheuTodasOpcoes($pai["codigo_produto"], $produtoSelecionado, $empresa) == 1){// se nao atingiu
                        if($produtoAtual != $pai["codigo_produto"]){
                            $caminhoProduto = $caminhoProduto."-".$pai["codigo_produto"];
                        }
                        break;
                    }else{
                        $buscarIrmao = true;
                        break;
                    }
                }
                $filhos= $this->Produto_model->buscaroProdutosFilhos($pai["codigo_produto"], $empresa);
                if($filhos != null && count($filhos) > 0){
                    if($this->verificaAtingiuQuantidadeMaxima($pai["codigo_produto"], $produtoSelecionado, $empresa) == 1 &&
                            $this->verificaEscolheuTodasOpcoes($pai["codigo_produto"], $produtoSelecionado, $empresa) == 1){//se não
                        if($produtoAtual != $pai["codigo_produto"]){
                            $caminhoProduto = $caminhoProduto."-".$pai["codigo_produto"];
                        }
                       break; 
                    }
                }
                if($produtoAtual != $pai["codigo_produto"]){
                    $caminhoProduto = $caminhoProduto."-".$pai["codigo_produto"];
                }
            }
            if($buscarIrmao == true){// então devo buscar o irmão do pai
                $irmao = $this->Produto_model->buscarProximoProdutoPai($pai["codigo_produto"], $empresa);
                if($irmao == null){
                    $reposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos("","Fluxo 15");
                    return $reposta;
                }
                $caminhoProduto = $caminhoProduto."-".$irmao["codigo_produto"];
            }
            $atributos = array("CaminhoProduto" => $caminhoProduto,"ProdutoSelecionado" => $produtoSelecionado);
            $reposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario($atributos);
            return $reposta;
        }
    }
    
    private function verificaEscolheuTodasOpcoes($produto, $produtoSelecionado, $empresa){
        $this->load->model("banco_produto/Produto_model");
        $filhos= $this->Produto_model->buscaroProdutosFilhos($produto, $empresa);
        $listafim = $this->retiraItensJaSelecionados($filhos, $produtoSelecionado);
        if(count($listafim) <= 0){
            return 0;//ja escolheu todas
        }else{
            return 1;// ainda tem para escolher
        }
    }
    
    private function verificaAtingiuQuantidadeMaxima($produto, $produtoSelecionado, $empresa){
        $this->load->model("banco_produto/Produto_model");
        $total = 0;
        $filhos= $this->Produto_model->buscaroProdutosFilhos($produto, $empresa);
        if($filhos != null && count($filhos) > 0){
            for($a=0; $a < count($filhos); $a++){
                if(substr_count("@".$produtoSelecionado, $filhos[$a]["codigo_produto"]) > 0 ){
                    $total++;
                }
            }
        }
        $pai = $this->Produto_model->buscarProdutoPorCodigo($produto, $empresa);
        if($pai["quantidade_maxima_produto"] == -1){
            return 1;
        }
        if($pai["quantidade_maxima_produto"] == $total || $pai["quantidade_maxima_produto"] < $total){
            return 0;//capacida foi atingida
        }else{
            return 1;//ainda nao atingiu
        }
        
    }
    
    private function gerarGaleriaProdutoFim($produtos, $faixaProduto, $nao){
        $total = count($produtos);
        $produtosGaleria = array();
        if($faixaProduto == 1){
            $max = $total;
            if($max > 8){
                $max = 8;
            }
            $temp = array();
            for($i=0; $i < $max; $i++){
               $produtosGaleria[] =  $produtos[$i];
            }
        }else{
            $max = $faixaProduto *10;
            $min= ($max -10)-($faixaProduto);
            $max=$max-($faixaProduto+1);
            if($max > $total){
                $max = $total;
            }
            $temp = array();
            for($i=$min; $i < $max; $i++){
               $produtosGaleria[] =  $produtos[$i];
            }
        }
        $galeria = $this->gerarGaleriaProduto($produtosGaleria, $nao);
        if($total > $max && count($galeria) < 10){// esse sera o 10 produto e fim
            $galeria[] = array(
                    "title"=> "Mais opções?",
                    "image_url"=> "",
                    "subtitle"=> "Clique aqui para mais opções",
                    "buttons" =>array(
                        array(
                            "type"=> "show_block",
                            "block_name"=> "Fluxo 7",
                            "title"=> "+ Opções"
                        )
                    )
                );
        }
        return $galeria;
    }
    
    private function gerarGaleriaProduto($produto, $nao){
        // obrigatoriamente tem que ser 8 produtos no maximo
        $total = count($produto);
        $a=0;
        $galeria = array();
        if($nao){// por causa desse pode ser que chega a 9 produtos
            $galeria[$a] = array(
                    "title"=> "Não, obrigado(a)",
                    "image_url"=> "",
                    "subtitle"=> "",
                    "buttons" =>array(
                        array(
                            "type"=> "show_block",
                            "block_name"=> "Fluxo 9",
                            "title"=> "Não, obrigado(a)"
                        )
                    )
                );
            $a++;
        }
        for($i=0; $i < $total; $i++){
            $galeria[$a] = array(
                "title"=> $produto[$i]["nome_produto"],
                "image_url"=> "",
                "subtitle"=> $produto[$i]["descricao_produto"],
                "buttons" =>array(
                    array(
                        "type"=> "show_block",
                        "block_name"=> "Fluxo 9",
                        "title"=> $produto[$i]["nome_produto"]
                    )
                )
            );
            $a++;
            if($i == 7){
                break;
            }
        }
        return $galeria;
    }
    
    public function incrementaFaixaProdutos($faixaProduto, $produtoSelecionado, $caminhoProduto, $botaoSelecionado, $empresa){
        $this->load->model("produto/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Produto_model");
        //descubro a quantidade de produtos
        $produtos = array();
        if($caminhoProduto == null || $caminhoProduto == "0"){// sei que é primeira vez que vem aki
           //busco as raizes para usuario escolher   
            $produtos = $this->Produto_model->buscarProdutosRaiz($empresa);

        }else{// estou escolhendo pais
            $produtoTemp = explode("-",$caminhoProduto);
            $produtoRaiz = $produtoTemp[0];
            $produtoAtual = $produtoTemp[count($produtoTemp)-1];
            $produtos= $this->Produto_model->buscaroProdutosFilhos($produtoAtual, $empresa);
        }

        if($faixaProduto != 0){
            if((count($produtos)/8) > $faixaProduto && $botaoSelecionado == "+ Opções"){
                $faixaProduto=$faixaProduto+1;
            }else{
                $faixaProduto=1;
            } 
        }else{
            $faixaProduto=$faixaProduto+1;
        }
        return $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("FaixaProduto" => $faixaProduto));
    }
    
     public function incrementaQuantidadeProdutos($botaoSelecionado, $faixaQuantidade, $empresa){
         $this->load->model("produto/UtilitarioGeradorDeJSON");
         if($botaoSelecionado == "Mais"){
             $faixaQuantidade = $faixaQuantidade + 1;
         }else if($botaoSelecionado == "Menos"){
             $faixaQuantidade = $faixaQuantidade - 1;
         }
         return $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("FaixaQuantidade" => $faixaQuantidade));
     }
}
