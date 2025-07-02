<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participacao_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // AIDEV-GENERATED: Método para criar uma nova participação
    public function create($data) {
        $data['data_participacao'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('participacoes', $data);
    }

    // AIDEV-GENERATED: Método para obter todas as participações
    public function getAll() {
        $this->db->select('p.*, c.nome as campanha_nome, u.nome as usuario_nome');
        $this->db->from('participacoes p');
        $this->db->join('campanhas c', 'c.id = p.campanha_id', 'left');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        return $this->db->get()->result();
    }

    // AIDEV-GENERATED: Método para obter uma participação por ID
    public function getById($id) {
        $this->db->select('p.*, c.nome as campanha_nome, u.nome as usuario_nome');
        $this->db->from('participacoes p');
        $this->db->join('campanhas c', 'c.id = p.campanha_id', 'left');
        $this->db->join('usuarios u', 'u.id = p.usuario_id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    // AIDEV-GENERATED: Método para atualizar uma participação existente
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('participacoes', $data);
    }

    // AIDEV-GENERATED: Método para deletar uma participação
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('participacoes');
    }

    // AIDEV-GENERATED: Método para verificar se um usuário já participou de uma campanha
    public function hasParticipated($campanha_id, $usuario_id) {
        $this->db->where('campanha_id', $campanha_id);
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('participacoes');
        return $query->num_rows() > 0;
    }

    // AIDEV-GENERATED: Método para obter campanhas ativas para participação (não participadas pelo usuário)
    public function getAvailableCampanhasForUser($usuario_id) {
        $this->db->select('c.*, c.premio, p.id as participacao_id');
        $this->db->from('campanhas c');
        $this->db->where('c.status', 1); // Apenas campanhas ativas
        $this->db->where('c.data_fim >= CURDATE()'); // Apenas campanhas não expiradas
        $this->db->join('participacoes p', 'p.campanha_id = c.id AND p.usuario_id = ' . $this->db->escape($usuario_id), 'left');
        $this->db->where('p.id IS NULL'); // Onde não há participação para este usuário
        return $this->db->get()->result();
    }

    // AIDEV-GENERATED: Método para obter campanhas ativas com detalhes de participação
    public function getActiveCampaignsWithParticipationDetails() {
        $this->db->select('c.*, COUNT(pa.id) as total_participantes, DATEDIFF(c.data_fim, CURDATE()) as dias_restantes');
        $this->db->from('campanhas c');
        $this->db->join('participacoes pa', 'pa.campanha_id = c.id', 'left');
        $this->db->where('c.status', 1); // Apenas campanhas ativas
        $this->db->group_by('c.id');
        $this->db->order_by('c.data_fim', 'ASC');
        return $this->db->get()->result();
    }
}
