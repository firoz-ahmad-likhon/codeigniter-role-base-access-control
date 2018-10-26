<?php
/**
 * Migration_permission_roles Class
 *
 * @author       Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * @purpose      Migration.
 */
class Migration_permission_roles extends CI_Migration {

    /**
     * Create table.
     */
    public function up() {
        $this->dbforge->add_field([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'permission_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        
        $this->dbforge->add_key('role_id', TRUE);
        $this->dbforge->add_key('permission_id', TRUE);
        $this->dbforge->create_table('permission_roles');
    }

    /**
     * Drop table.
     */
    public function down() {
        $this->dbforge->drop_table('permission_roles');
    }

}