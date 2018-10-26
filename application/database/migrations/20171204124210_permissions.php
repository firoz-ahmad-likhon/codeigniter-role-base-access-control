<?php
/**
 * Migration_permissions Class
 *
 * @author       Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * @purpose      Migration.
 */
class Migration_permissions extends CI_Migration {

    /**
     * Create table.
     */
    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'display_name' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'description' => [
                'type' => 'TINYTEXT',
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default' => NULL,
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'default' => NULL,
            ],
            'deleted_at' => [
                'type' => 'timestamp',
                'default' => NULL,
            ],
        ]);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('permissions');
    }

    /**
     * Drop table.
     */
    public function down() {
        $this->dbforge->drop_table('permissions');
    }

}