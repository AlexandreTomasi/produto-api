<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cliente_model
 *
 * @author 033234581
 */
class Cliente_model extends CI_Model{
    
    public function inserirCliente($cliente){
        if($cliente == null){
            throw new Exception("(Cliente_model) metodo inserirCliente com parametros nulos");
        }
        $resultado =  $this->db->insert("cliente",$cliente);    
        if($this->db->affected_rows() == 0){throw new Exception("(Cliente_model) metodo inserirCliente não alterou nenhuma linha");}
        return $resultado;
    }
    
    public function inserirClienteRetornandoCliente($cliente){
        if($cliente == null){
            throw new Exception("(Cliente_model) metodo inserirClienteRetornandoCliente com parametros nulos");
        }
        $resp=0;
        $this->db->trans_start();
        $this->db->insert("cliente",$cliente); 
        if($this->db->affected_rows() == 0){throw new Exception("(Cliente_model) metodo inserirClienteRetornandoCliente não alterou nenhuma linha");}
        $resp = $this->db->insert_id();
        $this->db->trans_complete();
        $cliente["codigo_cliente"] = $resp;
        return $cliente;
    }
    
    public function buscarClientes($codgEmpresa){
        if($codgEmpresa == null){
            throw new Exception("(Cliente_model) metodo buscarClientes com parametros nulos");
        }
        $this->db->where("empresa_cliente", $codgEmpresa);
        $this->db->order_by('nome_cliente', 'desc');
        return $this->db->get("cliente")->result_array();
    }
    // busca pelo cliente para verificar se existe no banco de dados ativou ou não
    public function buscarClientesFBid($id, $cdgPizza){
        if($cdgPizza == null || $id == null){
            throw new Exception("(Cliente_model) metodo buscarClientesFBid com parametros nulos");
        }
        $this->db->where("id_facebook_cliente", $id);
        $this->db->where("empresa_cliente", $cdgPizza);
        $this->db->order_by('nome_cliente', 'desc');
        return $this->db->get("cliente")->row_array();
    }
    
    public function buscarClienteCPF($cpf, $codigo){
        if($cpf == null || $codigo == null){
            throw new Exception("(Cliente_model) metodo buscarClienteCPF com parametros nulos");
        }
        $this->db->where("empresa_cliente", $codigo);
        $this->db->where("cpf_cliente", $cpf);
        return $this->db->get("cliente")->row_array();
    }
    
    public function buscarClientePorCodigo($codigo, $pizzaria){
        if($pizzaria == null || $codigo == null){
            throw new Exception("(Cliente_model) metodo buscarClientePorCodigo com parametros nulos");
        }
        $this->db->where("codigo_cliente", $codigo);
        $this->db->where("empresa_cliente", $pizzaria);
        return $this->db->get("cliente")->row_array();
    }
    
    public function alterarCliente($cliente){
        if($cliente == null){
            throw new Exception("(Cliente_model) metodo alterarCliente com parametros nulos");
        }
        $this->db->where('codigo_cliente', $cliente['codigo_cliente']);
        $this->db->set($cliente);
        $resultado = $this->db->update("cliente",$cliente);
        return $resultado;
    }
    
    public function bloquearCliente($codigo_cliente){
        if($codigo_cliente == null){
            throw new Exception("(Cliente_model) metodo bloquearCliente com parametros nulos");
        }
        $this->db->where("codigo_cliente", $codigo_cliente);
        $this->db->where("ativo_cliente", 1);
        $cliente = $this->db->get("cliente")->row_array();
        
        $cliente["ativo_cliente"]=0;       
        $this->db->where('codigo_cliente', $cliente['codigo_cliente']);
        $this->db->set($cliente);
        $resultado = $this->db->update("cliente",$cliente);
        if($this->db->affected_rows() == 0){throw new Exception("(Cliente_model) metodo bloquearCliente não alterou nenhuma linha");}
        return $resultado;
    }
    
    public function ativarCliente($codigo_cliente){
        if($codigo_cliente == null){
            throw new Exception("(Cliente_model) metodo ativarCliente com parametros nulos");
        }
        $this->db->where("codigo_cliente", $codigo_cliente);
        $this->db->where("ativo_cliente", 0);
        $cliente = $this->db->get("cliente")->row_array();
        
        $cliente["ativo_cliente"]=1;       
        $this->db->where('codigo_cliente', $cliente['codigo_cliente']);
        $this->db->set($cliente);
        $resultado = $this->db->update("cliente",$cliente);
        if($this->db->affected_rows() == 0){throw new Exception("(Cliente_model) metodo ativarCliente não alterou nenhuma linha");}
        return $resultado;
    }
}
