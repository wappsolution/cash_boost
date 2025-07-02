<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // AIDEV-GENERATED: Método para criar um novo usuário
    public function create($data) {
        // Hash da senha antes de salvar
        $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('usuarios', $data);
    }

    // AIDEV-GENERATED: Método para obter todos os usuários
    public function getAll() {
        return $this->db->get('usuarios')->result();
    }

    // AIDEV-GENERATED: Método para obter um usuário por ID
    public function getById($id) {
        return $this->db->get_where('usuarios', ['id' => $id])->row();
    }

    // AIDEV-GENERATED: Método para atualizar um usuário existente
    public function update($id, $data) {
        // Hash da senha se ela for fornecida para atualização
        if (isset($data['senha']) && !empty($data['senha'])) {
            $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
        } else {
            unset($data['senha']); // Não atualiza a senha se estiver vazia
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('usuarios', $data);
    }

    // AIDEV-GENERATED: Método para deletar um usuário
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('usuarios');
    }

    // AIDEV-GENERATED: Método para verificar credenciais de login
    public function verify_login($email, $senha) {
        $this->db->where('email', $email);
        $query = $this->db->get('usuarios');
        $user = $query->row();

        if ($user && password_verify($senha, $user->senha)) {
            return $user;
        }
        return FALSE;
    }
}
