<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validacao_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // AIDEV-GENERATED: Método para criar uma nova validação
    public function create($data) {
        $data['data_validacao'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('validacoes', $data);
    }

    // AIDEV-GENERATED: Método para obter todas as validações
    public function getAll() {
        $this->db->select('v.*, p.id as participacao_id, c.nome as campanha_nome, u.nome as usuario_nome, s.nome as supervisor_nome');
        $this->db->from('validacoes v');
        $this->db->join('participacoes p', 'p.id = v.participacao_id', 'left');
        $this->db->join('campanhas c', 'c.id = p.campanha_id', 'left');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        $this->db->join('usuarios s', 's.id = v.supervisor_id', 'left');
        return $this->db->get()->result();
    }

    // AIDEV-GENERATED: Método para obter uma validação por ID
    public function getById($id) {
        $this->db->select('v.*, p.id as participacao_id, c.nome as campanha_nome, u.nome as usuario_nome, s.nome as supervisor_nome');
        $this->db->from('validacoes v');
        $this->db->join('participacoes p', 'p.id = v.participacao_id', 'left');
        $this->db->join('campanhas c', 'c.id = p.campanha_id', 'left');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        $this->db->join('usuarios s', 's.id = v.supervisor_id', 'left');
        $this->db->where('v.id', $id);
        return $this->db->get()->row();
    }

    // AIDEV-GENERATED: Método para obter participações pendentes de validação
    public function getParticipacoesPendentesValidacao() {
        $this->db->select('p.id as participacao_id, p.data_participacao, c.nome as campanha_nome, c.descricao as campanha_descricao, c.premio, u.nome as usuario_nome');
        $this->db->from('participacoes p');
        $this->db->join('campanhas c', 'c.id = p.campanha_id', 'inner');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'inner');
        $this->db->where('p.status_participacao', 'pendente');
        // AIDEV-NOTE: Excluir participações que já foram validadas
        $this->db->where('NOT EXISTS (SELECT 1 FROM validacoes WHERE validacoes.participacao_id = p.id)', NULL, FALSE);
        return $this->db->get()->result();
    }

    // AIDEV-GENERATED: Método para obter todas as participações com status de validação
    public function getParticipacoesComStatusValidacao() {
        $this->db->select('p.id as participacao_id, p.data_participacao, p.status_participacao, c.nome as campanha_nome, c.descricao as campanha_descricao, c.premio, u.nome as usuario_nome, v.meta_atingida, v.observacao, v.data_validacao, s.nome as supervisor_nome');
        $this->db->from('participacoes p');
        $this->db->join('campanhas c', 'c.id = p.campanha_id', 'inner');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'inner');
        $this->db->join('validacoes v', 'v.participacao_id = p.id', 'left');
        $this->db->join('usuarios s', 's.id = v.supervisor_id', 'left');
        $this->db->order_by('p.data_participacao', 'DESC');
        return $this->db->get()->result();
    }
}
