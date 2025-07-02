<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_pagamentos_table extends CI_Migration {

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
                'null' => TRUE, // Pode ser NULL por enquanto, até a tabela participacoes existir
            ),
            'usuario_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'valor' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ),
            'data_pagamento' => array(
                'type' => 'DATETIME',
            ),
            'status_pagamento' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'metodo_pagamento' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
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
        $this->dbforge->create_table('pagamentos');
    }

    public function down() {
        $this->dbforge->drop_table('pagamentos');
    }
}
