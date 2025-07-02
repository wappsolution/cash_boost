<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campanhas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // AIDEV-GENERATED: Método para criar uma nova campanha
    public function create($data) {
        return $this->db->insert('campanhas', $data);
    }

    // AIDEV-GENERATED: Método para obter todas as campanhas
    public function getAll() {
        return $this->db->get('campanhas')->result();
    }

    // AIDEV-GENERATED: Método para obter uma campanha por ID
    public function getById($id) {
        return $this->db->get_where('campanhas', ['id' => $id])->row();
    }

    // AIDEV-GENERATED: Método para atualizar uma campanha existente
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('campanhas', $data);
    }

    // AIDEV-GENERATED: Método para deletar uma campanha
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('campanhas');
    }

    // AIDEV-GENERATED: Método para ativar/desativar uma campanha
    public function toggleStatus($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('campanhas', ['status' => $status]);
    }

    // AIDEV-GENERATED: Método para obter o total de gastos de todas as campanhas
    public function getTotalGasto() {
        $this->db->select_sum('gasto', 'total_gasto');
        $query = $this->db->get('campanhas');
        return $query->row()->total_gasto;
    }

    // AIDEV-GENERATED: Método para contar o número de campanhas ativas
    public function countActiveCampanhas() {
        $this->db->where('status', 1);
        return $this->db->count_all_results('campanhas');
    }

    // AIDEV-GENERATED: Método para contar o número de novas campanhas criadas esta semana
    public function countNewCampanhasThisWeek() {
        $this->db->where('created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)');
        return $this->db->count_all_results('campanhas');
    }
}
