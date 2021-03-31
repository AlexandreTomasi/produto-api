<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Alexandre
 */
class Comunicador_json_produto extends CI_Controller{
// Requisções do bot
    public function mensagemWelcomeDoProduto(){
        try{
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo do profissional não existente");}
            $empresa = intval($_GET["CodgEmpresa"]);
            $this->load->model("banco_produto/Valor_configuracao_model");
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            $mensagem = $this->Valor_configuracao_model->buscaConfigEmpresa("mensagem_de_inicializacao",$empresa);
            $rapida = array();
            $rapida[] = array("titulo" => "Ok","bloco" => "Começar");
            $dados = $this->UtilitarioGeradorDeJSON->gerarRespostaRapida($mensagem, $rapida);
            $json_str = json_encode($dados);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function respostaPadraoProduto(){
        try{
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            $this->load->model("banco_produto/Valor_configuracao_model");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo do profissional não existente");}
            if(!isset($_GET["last_visited_block_name"])){throw new Exception("last_visited_block_name não existente");}
            if(!isset($_GET["fluxo"])){throw new Exception("fluxo não existente");}
            if(!isset($_GET["first_name"])){throw new Exception("fb_first_name não existente");}
            if(!isset($_GET["last_name"])){throw new Exception("fb_last_name não existente");}
            if(!isset($_GET["last_user_freeform_input"])){throw new Exception("last_user_freeform_input não existente");}
            
            $empresa = intval($_GET["CodgEmpresa"]);
            $blocoAtual = $_GET["last_visited_block_name"];
            $fluxo = $_GET["fluxo"];
            $nome = $_GET["first_name"];
            $sobrenome = $_GET["last_name"];
            $msg = $_GET["last_user_freeform_input"];
            
            $mensagem = $this->Valor_configuracao_model->buscaConfigEmpresa("resposta_padrao",$empresa);
            $botao[] = array("bloco" => "Cancela Pedido","titulo" => "Cancelar");
            $botao[] = array("bloco" => "Cancela Pedido","titulo" => "Continuar requisição");
            $dados = $this->UtilitarioGeradorDeJSON->gerarBotaoPadrao($mensagem, $botao);
            $json_str = json_encode($dados);
            echo $json_str;
            
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function verificarHorarioAtendimentoNormalEspecial(){
        try{
            $this->load->model("produto/VerificaHorarioAtendimento");
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $resp = 0;
            $resp = $this->VerificaHorarioAtendimento->AutenticaHorario($empresa);
            if($resp != 1){
                $text =  $this->VerificaHorarioAtendimento->MensagemNaoFuncionamento($empresa);
                $dados = array('messages' => array(array('text' => $text)));
                    echo json_encode($dados);
            }else{
               $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("HorarioPermitido" => $resp));
               $json_str = json_encode($resposta);
               echo $json_str;
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
 // bairros   
    public function mensagemPerguntaBairroCliente(){//1
        try{
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            $this->load->model("banco_produto/Valor_configuracao_model");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da Empresa não existente");}
            if(!isset($_GET["NomeBairroCliente"])){throw new Exception("NomeBairroCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $nomeBairro = $_GET["NomeBairroCliente"];
            if($nomeBairro == null || $nomeBairro == ""){
                $mensagem = $this->Valor_configuracao_model->buscaConfigEmpresa("pergunta_bairro_do_cliente",$empresa);
                $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array('PerguntaBairro' =>$mensagem));
            }else{
                $mensagem = $this->Valor_configuracao_model->buscaConfigEmpresa("solicita_digitar_bairro_novamente",$empresa);
                $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array('PerguntaBairro' => $mensagem));
            }
            $json_str = json_encode($resposta);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function verificaBairroPermitidoPorNome(){   
        try{
            $this->load->model("produto/VerificaBairroPermitido");
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da Empresa não existente");}
            if(!isset($_GET["NomeBairroCliente"])){throw new Exception("NomeBairroCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $bairro = $_GET["NomeBairroCliente"];
            $resposta = "";
            $permissao = $this->VerificaBairroPermitido->identificaBairroDigitado($bairro, $empresa);
            if(count($permissao) == 1){
                $rapida = array();
                $rapida[] = array("titulo" => "Sim","bloco" => "Fluxo 5");
                $rapida[] = array("titulo" => "Não","bloco" => "Fluxo 3");
                $resposta = $this->UtilitarioGeradorDeJSON->gerarRespostaRapidaAlterandoAtributos(
                        "Seu bairro de entrega é: ".$permissao[0]["descricao_bairro"], array("BairroCliente" => $permissao[0]["codigo_bairro"]) ,$rapida);
            }else if(count($permissao) > 1){
                $rapida = array();
                for($i=0; $i < count($permissao); $i++){
                    $rapida[] = array("titulo" => $permissao[$i]["descricao_bairro"],"bloco" => "Fluxo 5");
                    if($i == 8){
                        break;
                    }
                }
                $rapida[] = array("titulo" => "Não","bloco" => "Fluxo 3");
                $resposta= $this->UtilitarioGeradorDeJSON->gerarRespostaRapida("Não fui capaz de definir o seu bairro. É algum dos bairros abaixo 👇?", $rapida);
            }
            $json_str = json_encode($resposta);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function recebeBairroDigitado(){//Recebe Endereco
        try{
            $this->load->model("produto/VerificaBairroPermitido");
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            $this->load->model("banco_produto/Valor_configuracao_model");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da Pizzaria não existente");}
            if(!isset($_GET["last_user_freeform_input"])){throw new Exception("last_user_freeform_input não existente");}
            if(!isset($_GET["BairroCliente"])){throw new Exception("BairroCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $bairroSelecionado = $_GET["last_user_freeform_input"];
            $bairro = $_GET["BairroCliente"]; 
            if($bairroSelecionado != "Sim" && $bairro == 0){
                $permissao = $this->VerificaBairroPermitido->buscaBairroPorBotaoSelecionado($bairroSelecionado, $empresa);
                $resposta = $this->VerificaBairroPermitido->finalizaResposta($permissao, $empresa);
                $json_str = json_encode($resposta);
                echo $json_str;
                
            }else{//quando clica em sim eu tenho o bairro do cliente ja, verifico se ta taxado
                $permissao = $this->VerificaBairroPermitido->verificaSeEntregaNoBairro($bairro, $empresa);
                if($permissao != null && $permissao != 0){
                    $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("BairroCliente" => $permissao));
                    $json_str = json_encode($resposta);
                    echo $json_str;
                }else{
                    $resposta = $this->VerificaBairroPermitido->finalizaResposta($permissao, $empresa);
                    $json_str = json_encode($resposta);
                    echo $json_str;
                } 
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
// fim bairros

    public function verificaTelefoneValido(){
        try{
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["TelefoneCliente"])){throw new Exception("TelefoneCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $telefone = $_GET["TelefoneCliente"];
            
            $fimTelefone = 0;
            $telefone = str_replace(" ","",$telefone);//retira espacos
            $telefone = str_replace("-","",$telefone);// retira o -
            $telefone = str_replace("(","",$telefone);// retira o (
            $telefone = str_replace(")","",$telefone);// retira o )
            if( $telefone != null && strlen($telefone) >= 8 && is_numeric($telefone) && substr_count($telefone, '0') != strlen($telefone) 
                        && substr_count($telefone, '1') != strlen($telefone) && substr_count($telefone, '2') != strlen($telefone) 
                        && substr_count($telefone, '3') != strlen($telefone) && substr_count($telefone, '4') != strlen($telefone)
                        && substr_count($telefone, '5') != strlen($telefone) && substr_count($telefone, '6') != strlen($telefone)
                        && substr_count($telefone, '7') != strlen($telefone) && substr_count($telefone, '8') != strlen($telefone)
                        && substr_count($telefone, '9') != strlen($telefone) )
            {

                $fimTelefone = 1;
            }else{
                $fimTelefone = 0;
            }
            $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("FimTelefone" => $fimTelefone));
            $json_str = json_encode($resposta);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function buscaFormaPagamento(){
        try{
            $this->load->model("produto/FormaDePagamento");
            $this->load->model("banco_produto/Forma_pagamento_model");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            $empresa = $_GET["CodgEmpresa"];
            
            $formas = $this->Forma_pagamento_model->buscarFormaPagamentoAtivas($empresa);
            if($formas != null){
                $cartao = $this->FormaDePagamento->criaGaleriaFormaPagamento($formas);
                echo $cartao;
            }else{
                throw new Exception("buscar Forma Pagamento Ativas, nao retornou nenhum dado. Funcionalidade: buscaFormaPagamento->buscarFormaPagamentoAtivas");
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function setaValorFormaPagamento(){
        try{
            $this->load->model("produto/FormaDePagamento");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["last_clicked_button_name"])){throw new Exception("last_clicked_button_name não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $formaPgSelecionada = $_GET["last_clicked_button_name"];

            $retorno = $this->FormaDePagamento->setaFormaPagamentoNaVariavel($empresa, $formaPgSelecionada);
            $json_str = json_encode($retorno);
            echo $json_str;
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function verificaTrocoValido(){
        try{
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["CustoTotalPedidoCliente"])){throw new Exception("CustoTotalPedidoCliente não existente");}
            if(!isset($_GET["TrocoCliente"])){throw new Exception("TrocoCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $custoPedido = $_GET["CustoTotalPedidoCliente"];
            $troco = $_GET["TrocoCliente"];          
            $resp = 0;
            
            if(is_numeric($troco)){
                if($troco >= $custoPedido){
                    $resp = 1; 
                }
            }
            $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("FimTroco" => $resp));
            $json_str = json_encode($resposta);
            echo $json_str;  
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
// começo produtos
    
    public function incrementaFaixaProduto(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["FaixaProduto"])){throw new Exception("Faixa não existente");};
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("produto selecionado não existente");};
            if(!isset($_GET["CaminhoProduto"])){throw new Exception("CaminhoProduto não existente");}
            if(!isset($_GET["last_clicked_button_name"])){throw new Exception("last_clicked_button_name não existente");}
            $botaoSelecionado = $_GET["last_clicked_button_name"];
            $empresa = $_GET["CodgEmpresa"];
            $faixaProduto = $_GET["FaixaProduto"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            $caminhoProduto = $_GET["CaminhoProduto"];
            
            $resposta = $this->BuscaProdutoChatbot->incrementaFaixaProdutos($faixaProduto, $produtoSelecionado, $caminhoProduto, $botaoSelecionado, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            } 
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function buscaProduto(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["FaixaProduto"])){throw new Exception("Faixa produto não existente");};
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("produto selecionado não existente");};
            if(!isset($_GET["CaminhoProduto"])){throw new Exception("CaminhoProduto não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $faixaProduto = $_GET["FaixaProduto"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            $caminhoProduto = $_GET["CaminhoProduto"];
            
            $produto = $this->BuscaProdutoChatbot->buscaProdutoPorFaixa($caminhoProduto, $produtoSelecionado, $empresa, $faixaProduto);
            if($produto != null){
                $json_str = json_encode($produto);
                echo $json_str;
            } 
            
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function recebeProduto(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["FaixaProduto"])){throw new Exception("Faixa não existente");};
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("Produto selecionado não existente");};
            if(!isset($_GET["last_clicked_button_name"])){throw new Exception("last_clicked_button_name não existente");}
            if(!isset($_GET["CaminhoProduto"])){throw new Exception("CaminhoProduto não existente");}
            if(!isset($_GET["QuantidadeItem"])){throw new Exception("quantidade item não existente");};
            $empresa = $_GET["CodgEmpresa"];
            $faixaProduto = $_GET["FaixaProduto"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            $botaoSelecionado = $_GET["last_clicked_button_name"];
            $caminhoProduto = $_GET["CaminhoProduto"];
            $quantidade = $_GET["QuantidadeItem"];
            
            $resposta = $this->BuscaProdutoChatbot->recebeProdutoSelecionado($faixaProduto, $produtoSelecionado, $botaoSelecionado, $caminhoProduto, $quantidade, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            } 
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function descricaoProdutoASelecionar(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["CaminhoProduto"])){throw new Exception("CaminhoProduto não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $caminhoProduto = $_GET["CaminhoProduto"];
            $resposta = $this->BuscaProdutoChatbot->descricaoProduto($caminhoProduto, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            } 
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
//fim produtos   
// fluxo quantidade de itens do produto   
    public function verificaNecessidadeQuantidade(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["QuantidadeItem"])){throw new Exception("quantidade item não existente");};
            //if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("Produto selecionado não existente");};
            if(!isset($_GET["last_clicked_button_name"])){throw new Exception("last_clicked_button_name não existente");}
            //if(!isset($_GET["CaminhoProduto"])){throw new Exception("CaminhoProduto não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $quantidade = $_GET["QuantidadeItem"];
            //$produtoSelecionado = $_GET["ProdutoSelecionado"];
            $botaoSelecionado = $_GET["last_clicked_button_name"];
            //$caminhoProduto = $_GET["CaminhoProduto"];
            
            $resposta = $this->BuscaProdutoChatbot->precisaDeQuantidade($botaoSelecionado, $quantidade, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            } 
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function incrementaFaixaQuantidade(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["FaixaQuantidade"])){throw new Exception("Faixa não existente");};
            if(!isset($_GET["last_user_freeform_input"])){throw new Exception("last_user_freeform_input não existente");}
            if(!isset($_GET["fluxo"])){throw new Exception("fluxo não existente");};
            $botaoSelecionado = $_GET["last_user_freeform_input"];
            $empresa = $_GET["CodgEmpresa"];
            $faixaQuantidade = $_GET["FaixaQuantidade"];
            $fluxo = $_GET["fluxo"];
            if($fluxo == 12){
                $resposta = $this->BuscaProdutoChatbot->incrementaQuantidadeProdutos($botaoSelecionado, $faixaQuantidade, $empresa);
                if($resposta != null){
                    $json_str = json_encode($resposta);
                    echo $json_str;
                } 
            }else{
                $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("FaixaQuantidade" => 1));
                if($resposta != null){
                    $json_str = json_encode($resposta);
                    echo $json_str;
                }
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function perguntaQuantidadeDesejada(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["last_clicked_button_name"])){throw new Exception("last_clicked_button_name não existente");}
            if(!isset($_GET["FaixaQuantidade"])){throw new Exception("Faixa não existente");};
            $botaoSelecionado = $_GET["last_clicked_button_name"];
            $empresa = $_GET["CodgEmpresa"];
            $faixa = $_GET["FaixaQuantidade"];
            $resposta = $this->BuscaProdutoChatbot->perguntaRapidaQuantidade($botaoSelecionado, $faixa, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            } 
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function recebeQuantidadeDesejada(){
        try{
            $this->load->model("produto/BuscaProdutoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["last_user_freeform_input"])){throw new Exception("last_user_freeform_input não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $quantidade = $_GET["last_user_freeform_input"];
            $this->load->model("produto/UtilitarioGeradorDeJSON");
            $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array("QuantidadeItem" => intval($quantidade)));
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            } 
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        } 
    }
// fim quantidade de itens do produto
    
    public function mostrarCarrinhoDeCompras(){
        try{
            $this->load->model("produto/CarrinhoDeProdutos");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("Produto selecionado não existente");};
            //if(!isset($_GET["CaminhoProduto"])){throw new Exception("CaminhoProduto não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            //$caminhoProduto = $_GET["CaminhoProduto"];
            
            
            $resposta = $this->CarrinhoDeProdutos->mostrarCarrinhoProdutos($produtoSelecionado, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    /*Também é apresentado o subtotal do pedido de acordo com a galeria, a taxa de entrega e o total do pedido.*/
    public function buscarSubtotalDoPedido(){
        try{
            $this->load->model("produto/CarrinhoDeProdutos");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("Produto selecionado não existente");};
            if(!isset($_GET["BairroCliente"])){throw new Exception("BairroCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            $bairro = $_GET["BairroCliente"];
            
            $resposta = $this->CarrinhoDeProdutos->mostrarSubtotalDoPedido($bairro, $produtoSelecionado, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function mostrarSubmenu(){
        try{
            $this->load->model("produto/CarrinhoDeProdutos");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            $empresa = $_GET["CodgEmpresa"];
            
            $resposta = $this->CarrinhoDeProdutos->mostrarSubmenuEmpresa($empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    public function resumoPedido(){
        try{
            $this->load->model("produto/CarrinhoDeProdutos");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");};
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("Produto selecionado não existente");};
            if(!isset($_GET["BairroCliente"])){throw new Exception("BairroCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            $bairro = $_GET["BairroCliente"];
            
            $resposta = $this->CarrinhoDeProdutos->resumoDoPedido($bairro, $produtoSelecionado, $empresa);
            if($resposta != null){
                $json_str = json_encode($resposta);
                echo $json_str;
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    public function incluiPedidoSolicitado(){
        try{
            $this->load->model("produto/VerificaHorarioAtendimento");
            $this->load->model("produto/PedidoChatbot");
            if(!isset($_GET["CodgEmpresa"])){throw new Exception("Codigo da empresa não existente");}
            if(!isset($_GET["ProdutoSelecionado"])){throw new Exception("Produto selecionado não existente");}
            if(!isset($_GET["ObservacaoCliente"])){throw new Exception("ObservacaoCliente não existente");}
            if(!isset($_GET["TrocoCliente"])){throw new Exception("TrocoCliente não existente");}
            $empresa = $_GET["CodgEmpresa"];
            $produtoSelecionado = $_GET["ProdutoSelecionado"];
            $observacaoCliente = $_GET["ObservacaoCliente"];
            $trocoCliente = $_GET["TrocoCliente"];
            
            if(!isset($_GET["first_name"])){throw new Exception("fb_first_name não existente");}
            if(!isset($_GET["last_name"])){throw new Exception("fb_last_name não existente");}
            if(!isset($_GET["chatfuel_user_id"])){throw new Exception("chatfuel_user_id não existente");}
            if(!isset($_GET["TelefoneCliente"])){throw new Exception("TelefoneCliente não existente");}
            if(!isset($_GET["gender"])){throw new Exception("gender não existente");}
            if(!isset($_GET["map_url"])){throw new Exception("map_url não existente");}
            if(!isset($_GET["messenger_user_id"])){throw new Exception("messenger_user_id não existente");}
            $nome = $_GET["first_name"];
            $sobrenome = $_GET["last_name"];
            $fb_id = $_GET["chatfuel_user_id"];
            $telefoneCliente = $_GET["TelefoneCliente"];
            $sexo = $_GET["gender"];
            $mapUrl = $_GET["map_url"];
            $messengerId = $_GET["messenger_user_id"];
            
            if(!isset($_GET["BairroCliente"])){throw new Exception("BairroCliente não existente");}          
            if(!isset($_GET["state"])){throw new Exception("state não existente");}
            if(!isset($_GET["city"])){throw new Exception("city não existente");}
            if(!isset($_GET["zip"])){throw new Exception("zip não existente");}
            if(!isset($_GET["address"])){throw new Exception("address não existente");}
            if(!isset($_GET["EnderecoComplemento"])){throw new Exception("EnderecoComplemento não existente");}
            if(!isset($_GET["FormaPgCliente"])){throw new Exception("FormaPgCliente não existente");}
            $bairro = $_GET["BairroCliente"];
            $estado = $_GET["state"];
            $cep = $_GET["zip"];
            if($cep == null || $cep == "" || strlen($cep)<6){$cep = 78000000;}
            $cidade = $_GET["city"];
            $endereco = $_GET["address"];
            $complementoEndereco = $_GET["EnderecoComplemento"];
            $formaPagamento = $_GET["FormaPgCliente"];
            
            $resp = $this->VerificaHorarioAtendimento->AutenticaHorario($empresa);
            //verificar se a empresa ta no horario de expediente
            if($resp == 1){
                $resposta = $this->PedidoChatbot->incluirPedidoSolicitadoFacebook($empresa, $produtoSelecionado, $observacaoCliente, $trocoCliente, $nome, $sobrenome, $fb_id
                                    , $telefoneCliente, $sexo, $mapUrl, $messengerId, $bairro, $estado, $cep, $cidade, $endereco, $complementoEndereco, $formaPagamento);
                if($resposta == 1){
                    $dados =  $this->mensagemFinalizandoPedido($empresa);
                    $json_str = json_encode($dados);
                    echo $json_str;
                }else{
                    $dados = array('messages' => array(
                        array(
                            'text' => ""
                        )
                    ));
                    $json_str = json_encode($dados);
                    echo $json_str;
                }
            }else{
                $dados = array('messages' => array(
                    array(
                        'text' => $this->VerificaHorarioAtendimento->MensagemNaoFuncionamento($empresa)
                    )
                ));
                $json_str = json_encode($dados);
                echo $json_str;
            }
        }catch (Exception $e){
            $fp = fopen("log_do_chatbot.txt", "a");
            $escreve = fwrite($fp, "\n".date('H:i:s d-m-Y')." - ".((isset($_GET["CodgEmpresa"])) ? "Codigo da empresa = ".$_GET["CodgEmpresa"] : "")." ".$e->getMessage());
            fclose($fp); 
        }
    }
    
    private function mensagemFinalizandoPedido($codgEmpresa){
        $this->load->model("banco_produto/Empresa_model");
        $this->load->model("banco_produto/Valor_configuracao_model");
        $this->load->model("banco_gerencia/Cliente_generico_model");     
        $empresa = $this->Empresa_model->buscaEmpresaPorCodigo($codgEmpresa);
        $telefone = $empresa['telefone_empresa'];
        $tempo = $this->Valor_configuracao_model->buscaConfigEmpresa("tempo_de_entrega_empresa",$codgEmpresa);
        $dados = array('messages' => array(
                array(
                    'text' => "Tempo estimado de entrega: ".($tempo)." minutos. Caso não receba uma confirmação do preparo do seu pedido,"
                    . " favor entrar em contato conosco pelo telefone ".$this->formataTelefone($telefone)."."
                )
            ));
         return $dados;
    }
    
    private function formataTelefone($numero){
        if(strlen($numero) == 10){
            $ddd = substr($numero, 0, 2);
            $pri = substr($numero, 2, 4);
            $seg = substr($numero, 6);
            $novo = "(".$ddd.")".$pri."-".$seg;
        }else{
            $ddd = substr($numero, 0, 2);
            $pri = substr($numero, 2, 5);
            $seg = substr($numero, 7);
            $novo = "(".$ddd.")".$pri."-".$seg;
        }
        return $novo;
    }
}
