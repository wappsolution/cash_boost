<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // AIDEV-GENERATED: Método para criar um novo pagamento
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('pagamentos', $data);
    }

    // AIDEV-GENERATED: Método para obter o objeto de resultado da consulta para todos os pagamentos
    public function getAllQueryObject() {
        $this->db->select('p.*, u.nome as usuario_nome');
        $this->db->from('pagamentos p');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        return $this->db->get(); // Retorna o objeto de resultado da consulta
    }

    // AIDEV-GENERATED: Método para obter todos os pagamentos como array de objetos
    public function getAll() {
        return $this->getAllQueryObject()->result();
    }

    // AIDEV-GENERATED: Método para obter um pagamento por ID
    public function getById($id) {
        $this->db->select('p.*, u.nome as usuario_nome');
        $this->db->from('pagamentos p');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    // AIDEV-GENERATED: Método para atualizar um pagamento existente
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('pagamentos', $data);
    }

    // AIDEV-GENERATED: Método para deletar um pagamento
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pagamentos');
    }

    // AIDEV-GENERATED: Método para listar pagamentos pendentes
    public function getPendingPayments() {
        $this->db->select('p.*, u.nome as usuario_nome');
        $this->db->from('pagamentos p');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        $this->db->where('status_pagamento', 'pendente');
        return $this->db->get()->result();
    }

    // AIDEV-GENERATED: Método para atualizar o status de pagamento
    public function updatePaymentStatus($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('pagamentos', ['status_pagamento' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    // AIDEV-GENERATED: Método para obter histórico de pagamentos por usuário
    public function getPaymentHistoryByUser($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->get('pagamentos')->result();
    }
}