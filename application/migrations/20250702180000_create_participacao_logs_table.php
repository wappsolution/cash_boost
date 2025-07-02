<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_participacao_logs_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'participacao_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'usuario_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'acao' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'observacao' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('participacao_logs');

        // Adicionar chaves estrangeiras (opcional, mas recomendado para integridade)
        $this->db->query('ALTER TABLE `participacao_logs` ADD CONSTRAINT `fk_logs_participacoes` FOREIGN KEY (`participacao_id`) REFERENCES `participacoes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `participacao_logs` ADD CONSTRAINT `fk_logs_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('participacao_logs');
    }
}
