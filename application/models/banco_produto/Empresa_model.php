<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Empresa_model extends CI_Model{
    
    public function buscaPorCNPJ($email, $cnpj){
        if($email == null && $cnpj == null){throw new Exception("(Cliente_empresa_model) metodo buscaPorEmailECNPJ com parametros nulos");}
        $bdgerente = $this->load->database('gerencia', true);
        $bdgerente->where("email_cliente", $email);
        $bdgerente->where("cnpj_cliente", $cnpj);
        $cliente = $bdgerente->get("cliente")->row_array();
        return $cliente;
    }
    
    public function buscaPorEmailESenha($email, $senha){
        if($email == null || $senha == null){
            throw new Exception("(Empresa_model) metodo buscaPorEmailESenha com parametros nulos");
        }
        $this->db->where("email_empresa", $email);
        $this->db->where("senha_empresa", $senha);
        $empresa = $this->db->get("empresa")->row_array();
        return $empresa;
    }
    
    public function buscaEmpresaPorCodigo($codigo){
        if($codigo == null){
            throw new Exception("(Empresa_model) metodo buscaPizzariaPorCodigo com parametros nulos");
        }
        $this->db->where("codigo_empresa", $codigo);
        $empresa = $this->db->get("empresa")->row_array();
        return $empresa;
    }
    
    public function buscaPorCNPJemail($email, $cnpj){
        if($email == null || $cnpj == null){
            throw new Exception("(Empresa_model) metodo buscaPorCNPJemail com parametros nulos");
        }
        $this->db->where("email_empresa", $email);
        $this->db->where("cnpj_empresa", $cnpj);
        $empresa = $this->db->get("empresa")->row_array();
        return $empresa;
    }
    
    public function alteraCadastroPizzaria($empresa){
        if($empresa == null){
            throw new Exception("(Empresa_model) metodo alteraCadastroPizzaria com parametros nulos");
        }
        $this->db->where('codigo_empresa', $empresa['codigo_empresa']);
        $this->db->set($empresa);
        return $this->db->update("empresa",$empresa);
    }
}