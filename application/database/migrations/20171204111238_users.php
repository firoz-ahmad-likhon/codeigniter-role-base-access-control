<?php
/**
 * Migration_users Class
 *
 * @author       Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * @purpose      Migration.
 */
class Migration_users extends CI_Migration {

    /**
     * Create table.
     */
    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('users');
    }

    /**
     * Drop table.
     */
    public function down() {
        $this->dbforge->drop_table('users');
    }

}