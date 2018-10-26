<?php
/**
 * Migration_roles_users Class
 *
 * @author       Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * @purpose      Migration.
 */
class Migration_roles_users extends CI_Migration {

    /**
     * Create table.
     */
    public function up() {
        $this->dbforge->add_field([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->dbforge->add_key('user_id', true);
        $this->dbforge->add_key('role_id', true);
        $this->dbforge->create_table('roles_users');
    }

    /**
     * Drop table.
     */
    public function down() {
        $this->dbforge->drop_table('roles_users');
    }

}