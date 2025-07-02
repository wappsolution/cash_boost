<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_gasto_to_campanhas extends CI_Migration {

    public function up() {
        $fields = array(
            'gasto' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'null' => FALSE,
            ),
        );
        $this->dbforge->add_column('campanhas', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('campanhas', 'gasto');
    }
}
