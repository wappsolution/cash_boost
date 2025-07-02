<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    // AIDEV-GENERATED: Exibe a lista de usuários
    public function index() {
        $data['usuarios'] = $this->Usuarios_model->getAll();
        $this->load->view('templates/header_view');
        $this->load->view('usuarios/listar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Exibe o formulário para criar um novo usuário
    public function criar() {
        $this->load->view('templates/header_view');
        $this->load->view('usuarios/criar');
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa o envio do formulário de criação de usuário
    public function store() {
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->criar();
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'senha' => $this->input->post('senha'),
                'perfil' => $this->input->post('perfil')
            );
            $this->Usuarios_model->create($data);
            redirect('usuarios');
        }
    }

    // AIDEV-GENERATED: Exibe o formulário para editar um usuário existente
    public function editar($id) {
        $data['usuario'] = $this->Usuarios_model->getById($id);

        if (empty($data['usuario'])) {
            show_404();
        }

        $this->load->view('templates/header_view');
        $this->load->view('usuarios/editar', $data);
        $this->load->view('templates/footer_view');
    }

    // AIDEV-GENERATED: Processa o envio do formulário de edição de usuário
    public function update($id) {
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');

        // Apenas valida a senha se ela for fornecida
        if (!empty($this->input->post('senha'))) {
            $this->form_validation->set_rules('senha', 'Senha', 'min_length[6]');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->editar($id);
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'perfil' => $this->input->post('perfil')
            );

            // Adiciona a senha ao array de dados apenas se ela foi fornecida
            if (!empty($this->input->post('senha'))) {
                $data['senha'] = $this->input->post('senha');
            }

            $this->Usuarios_model->update($id, $data);
            redirect('usuarios');
        }
    }

    // AIDEV-GENERATED: Deleta um usuário
    public function delete($id) {
        $this->Usuarios_model->delete($id);
        redirect('usuarios');
    }
}
