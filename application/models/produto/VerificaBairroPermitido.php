<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerificaBairroPermitido
 *
 * @author 033234581
 */
class VerificaBairroPermitido extends CI_Model{
    //put your code here
    public function finalizaResposta($permissao, $empresa){
        $this->load->model("modelos/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Valor_configuracao_model");
        
        if($permissao == 0 || $permissao == null){
            $msg = $this->Valor_configuracao_model->buscaConfigEmpresa("mensagem_nao_efetua_entrega",$empresa);
            $resposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos($msg, "Fim");
            return $resposta;
        }else{
            $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array('BairroCliente' => $permissao));
            return $resposta;
        }
    }
    
    public function finalizaRespostaUltimoPedido($permissao, $empresa){
        $this->load->model("modelos/UtilitarioGeradorDeJSON");
        $this->load->model("banco_produto/Empresa_model");
        if($permissao == 0){
            $msg = $this->Empresa_model->buscaConfigEmpresa("mensagem_nao_efetua_entrega",$empresa);
            $resposta = $this->UtilitarioGeradorDeJSON->redirecionarParaBlocos($msg, "Fluxo 106");
            return $resposta;
        }else{
            $resposta = $this->UtilitarioGeradorDeJSON->definirAtributosDoUsuario(array('BairroClienteUP' => $permissao));
            return $resposta;
        }
    }
    
    public function analizaLocalCompartilhado($texto, $empresa){
        $this->load->model("pizzaria/Taxa_entrega_model");
        $bairrosPermitidos = $this->Taxa_entrega_model->buscarTaxaEntregaAtivasJoinBairro($empresa);
        if($bairrosPermitidos == null){throw new Exception("buscar Taxa Entrega Ativas Join Bairro, nao retornou nenhum dado. Funcionalidade: verificaBairroPermitido->analizaLocalCompartilhado");}

        $permitido=0;
        $dados = explode(", ", $texto);
        for($i=0; $i < count($dados); $i++){
            for($a=0; $a<count($bairrosPermitidos);$a++){
                $primeira = trim($dados[$i]);
                $segunda = trim($bairrosPermitidos[$a]["descricao_bairro"]);
                if(strcasecmp($primeira, $segunda) == 0 && $primeira == $segunda){
                    $permitido=$bairrosPermitidos[$a]["codigo_bairro"];
                    return $permitido;
                }
            }
        }
        
    }
    
    public function verificaSeEntregaNoBairro($codigo, $empresa){
        $this->load->model("banco_produto/Taxa_entrega_model");
        $taxa = $this->Taxa_entrega_model->buscarTaxaEntregaPorBairro($empresa, $codigo);
        if($taxa == null){
            return 0;
        }else{
            return $taxa["bairro_taxa_entrega"];
        }
    }
    
    public function buscaBairroPorBotaoSelecionado($texto, $empresa){
        $this->load->model("banco_produto/Taxa_entrega_model");
        $bairrosPermitidos = $this->Taxa_entrega_model->buscarTaxaEntregaAtivasJoinBairro($empresa);
        if($bairrosPermitidos == null){throw new Exception("buscar Taxa Entrega Ativas Join Bairro, nao retornou nenhum dado. Funcionalidade: verificaBairroPermitido->analizaLocalCompartilhado");}

        $permitido=0;
        for($a=0; $a<count($bairrosPermitidos);$a++){
            $primeira = trim($texto);
            $segunda = trim($bairrosPermitidos[$a]["descricao_bairro"]);
            if(strcasecmp($primeira, $segunda) == 0 && $primeira == $segunda){
                $permitido=$bairrosPermitidos[$a]["codigo_bairro"];
                return $permitido;
            }
        }
        return $permitido;
    }
    
    public function identificaBairroDigitado($nomeBairro, $empresa){
        $this->load->model("banco_gerencia/Bairro_model");
        $bairrosPermitidos = $this->Bairro_model->buscaBairros();
        if($bairrosPermitidos == null){throw new Exception("buscar Taxa Entrega Ativas Join Bairro, nao retornou nenhum dado. Funcionalidade: verificaBairroPermitido->analizaLocalCompartilhado");}
        $bairrosCompativeis=array();
        $minima_distancia = 0;
        //encontra a palavra mais proxima
        for($a=0; $a<count($bairrosPermitidos);$a++){
            $palavra_do_dicionario = $bairrosPermitidos[$a]["descricao_bairro"];
            similar_text($nomeBairro,$palavra_do_dicionario,$distancia);

            if($distancia >= $minima_distancia) {
               $minima_distancia = $distancia;             
            }
        }
        //pega os bairros que foram mais proximos 
        for($a=0; $a<count($bairrosPermitidos);$a++){
            $palavra_do_dicionario = $bairrosPermitidos[$a]["descricao_bairro"];
            similar_text($nomeBairro,$palavra_do_dicionario,$distancia);

            if($distancia == $minima_distancia) {
                $bairrosCompativeis[] = $bairrosPermitidos[$a];
            }
        }
        return $bairrosCompativeis;
           /* $minima_distancia = 100;
            echo('levenshtein<br/>');
            foreach ($lista as $palavra_do_dicionario) {
            $distancia = levenshtein($nomeBairro,$palavra_do_dicionario);

                   if($distancia <= $minima_distancia) {
                           $minima_distancia = $distancia; 


                   }
            }
            foreach ($lista as $palavra_do_dicionario) {
            $distancia = levenshtein($palavra_procurada,$palavra_do_dicionario);

                   if($distancia == $minima_distancia) {
                           echo  $palavra_do_dicionario;
                                 echo ' - ';
                                    echo $distancia;
                                    echo '<br/>';


                   }
            }*/
    }
}
