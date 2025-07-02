<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_validacoes_table extends CI_Migration {

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
            'supervisor_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'meta_atingida' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ),
            'observacao' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'data_validacao' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('validacoes');

        // Adicionar chaves estrangeiras (opcional, mas recomendado para integridade)
        $this->db->query('ALTER TABLE `validacoes` ADD CONSTRAINT `fk_validacoes_participacoes` FOREIGN KEY (`participacao_id`) REFERENCES `participacoes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `validacoes` ADD CONSTRAINT `fk_validacoes_usuarios` FOREIGN KEY (`supervisor_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('validacoes');
    }
}
