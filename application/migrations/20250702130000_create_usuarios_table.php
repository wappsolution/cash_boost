<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_usuarios_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE,
            ),
            'senha' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'perfil' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'usuario',
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
        $this->dbforge->create_table('usuarios');
    }

    public function down() {
        $this->dbforge->drop_table('usuarios');
    }
}
