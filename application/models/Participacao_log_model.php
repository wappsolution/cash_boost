<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participacao_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // AIDEV-GENERATED: Método para registrar um novo log de participação
    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('participacao_logs', $data);
    }

    // AIDEV-GENERATED: Método para obter logs de uma participação específica
    public function getLogsByParticipacaoId($participacao_id) {
        $this->db->select('pl.*, u.nome as usuario_nome');
        $this->db->from('participacao_logs pl');
        $this->db->join('usuarios u', 'u.id = pl.usuario_id', 'left');
        $this->db->where('participacao_id', $participacao_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }
}
