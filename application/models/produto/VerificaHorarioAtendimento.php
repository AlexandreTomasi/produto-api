<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerificaHorarioAtendimento
 *
 * @author 033234581
 */
class VerificaHorarioAtendimento extends CI_Model {
    //put your code here
    
    public function AutenticaHorario($empresa){
        date_default_timezone_set('America/Cuiaba');
        $this->load->model("banco_produto/HorariosEmpresa");
        $horarioNormal = $this->HorariosEmpresa->consultaHorarioAtendimento($empresa);
        if($horarioNormal == null){throw new Exception("consulta Horario Atendimento nao retornou nenhum dado. Funcionalidade: consultaHorarioAtendimento");}
        $horarioEspecial = $this->HorariosEmpresa->consultaHorarioEspecialDiaAtualCodigoPizzaria($empresa, date('Y-m-d'));//2017-03-13 00:00:00
        $permitido = 0;
        if($horarioEspecial != null){
            foreach ($horarioEspecial as $horarioDia) {
                if($horarioDia["inicio_horario_especial"] <= date('H:i:s') && $horarioDia["fim_horario_especial"] >= date('H:i:s') && $horarioDia["aberto_horario_especial"] == 2){
                        $permitido =2;
                        return $permitido;
                }
                if($horarioDia["inicio_horario_especial"] <= date('H:i:s') && $horarioDia["fim_horario_especial"] >= date('H:i:s') && $horarioDia["aberto_horario_especial"] == 1){
                        $permitido =1;
                        return $permitido;
                }
                if($horarioDia["inicio_horario_especial"] <= date('H:i:s') && $horarioDia["fim_horario_especial"] >= date('H:i:s') && $horarioDia["aberto_horario_especial"] == 0){
                        $permitido =0;
                        return $permitido;
                }
                
            }
        }
        
        
        foreach ($horarioNormal as $horarioDia) {
            if($horarioDia["dia_semana_horario_atendimento"] == date('N')){
                if($horarioDia["inicio_horario_atendimento"] <= date('H:i:s') && $horarioDia["fim_horario_atendimento"] >= date('H:i:s')){
                    $permitido =1;
                    return $permitido;
                }
            }
        }
        return $permitido;
    }
    
    public function MensagemNaoFuncionamento($empresa){        
        date_default_timezone_set('America/Cuiaba');
        $this->load->model("banco_produto/HorariosEmpresa");
        $horarioNormal = $this->HorariosEmpresa->consultaHorarioAtendimento($empresa);
        $horarioEspecial = $this->HorariosEmpresa->consultaHorarioEspecialDiaAtualCodigoPizzaria($empresa, date('Y-m-d'));//2017-03-13 00:00:00
        $resp = "";
        foreach ($horarioEspecial as $horarioDia) {
            if(!($horarioDia["inicio_horario_especial"] <= date('H:i:s') && $horarioDia["fim_horario_especial"] >= date('H:i:s')) && $horarioDia["aberto_horario_especial"] == 1){
                $resp = "Hoje estaremos funcionando das ".$horarioDia["inicio_horario_especial"]." ??s ".$horarioDia["fim_horario_especial"]." Tente novamente nesse hor??rio.";
            }else if(($horarioDia["inicio_horario_especial"] <= date('H:i:s') && $horarioDia["fim_horario_especial"] >= date('H:i:s')) && $horarioDia["aberto_horario_especial"] == 0){
                $resp = "Especialmente hoje n??o estaremos funcionando. Agradecemos a compreens??o.";
            }
            else if(($horarioDia["inicio_horario_especial"] <= date('H:i:s') && $horarioDia["fim_horario_especial"] >= date('H:i:s')) && $horarioDia["aberto_horario_especial"] == 2){
                $resp = "Devido ao grande volume de pedidos, estamos suspendendo novos pedidos at?? conseguirmos regularizar a entrega. Tente novamente mais tarde. Agradecemos a compreens??o!";
            }
        }
 
        if($resp == ""){
            foreach ($horarioNormal as $horarioDia) {
                if($horarioDia["dia_semana_horario_atendimento"] == date('N')){
                    if(!($horarioDia["inicio_horario_atendimento"] <= date('H:i:s') && $horarioDia["fim_horario_atendimento"] >= date('H:i:s'))){
                        $resp = "O hor??rio do delivery ?? das ".$horarioDia['inicio_horario_atendimento']." ??s ".$horarioDia['fim_horario_atendimento'].". Tente novamente nesse hor??rio.";
                        break;
                    }                    
                }
            }
        }

        if($resp == ""){
            $resp = "Desculpa, n??o trabalhamos na ".$this->converteData(date("l"))." :'(";
        }
        return $resp;
    }
    
    // como codeingiter falhou em convertes as linguagens
    public function converteData($nome){
        if($nome == 'Sunday'){
            return  'Domingo';
        }
        if($nome == 'Monday'){
            return 'Segunda';
        }
        if($nome == 'Tuesday'){
            return 'Ter??a';
        }
        if($nome == 'Wednesday'){
            return 'Quarta';
        }
        if($nome == 'Thursday'){
            return 'Quinta';
        }
        if($nome == 'Friday'){
            return 'Sexta';
        }
        if($nome == 'Saturday'){
           return 'S??bado';
        }
    }
}
