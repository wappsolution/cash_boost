<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_participacoes_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'campanha_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'usuario_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'data_participacao' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'status_participacao' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'pendente',
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
        $this->dbforge->create_table('participacoes');

        // Adicionar chaves estrangeiras (opcional, mas recomendado para integridade)
        $this->db->query('ALTER TABLE `participacoes` ADD CONSTRAINT `fk_participacoes_campanhas` FOREIGN KEY (`campanha_id`) REFERENCES `campanhas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `participacoes` ADD CONSTRAINT `fk_participacoes_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('participacoes');
    }
}
