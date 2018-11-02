<?php
/**
 * Author: Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * Website: https://github.com/firoz-ahmad-likhon
 *
 * Copyright (c) 2018 Firoz Ahmad Likhon
 * Released under the MIT license
 *       ___            ___  ___    __    ___      ___  ___________  ___      ___
 *      /  /           /  / /  /  _/ /   /  /     /  / / _______  / /   \    /  /
 *     /  /           /  / /  /_ / /    /  /_____/  / / /      / / /     \  /  /
 *    /  /           /  / /   __|      /   _____   / / /      / / /  / \  \/  /
 *   /  /_ _ _ _ _  /  / /  /   \ \   /  /     /  / / /______/ / /  /   \    /
 *  /____________/ /__/ /__/     \_\ /__/     /__/ /__________/ /__/     /__/
 * Likhon the hackman, who claims himself as a hacker but really he isn't.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Model
{
    /**
     * Role constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Find data.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->db->get_where("roles", array("id" => $id, "deleted_at" => null))->row(0);
    }

    /**
     * Read all data.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->db->get_where("roles", array("deleted_at" => null))->result();
    }

    /**
     * Insert data.
     *
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        return $this->db->insert('roles', $data);
    }

    /**
     * Edit data.
     *
     * @param $data
     * @return mixed
     */
    public function edit($data)
    {
        return $this->db->update('roles', $data, array('id' => $data['id']));
    }

    /**
     * Delete data.
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $data['deleted_at'] = date("Y-m-d H:i:s");

        return $this->find($id) ? $this->db->update('roles', $data, array('id' => $id)) : 0;
    }

    /**
     * Insert permissions.
     *
     * @param $role_id
     * @param $permissions
     * @return int
     */
    public function addPermissions($role_id, $permissions)
    {
        $data["role_id"] = $role_id;
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                $data["permission_id"] = $permission;
                $this->addPermission($data);
            }
        }
        else {
            $data["permission_id"] = $permissions;
            $this->addPermission($data);
        }

        return 1;
    }

    /**
     * Insert permission.
     *
     * @param $data
     * @return mixed
     */
    public function addPermission($data)
    {
        return $this->db->insert('permission_roles', $data);
    }

    /**
     * Edit permissions.
     *
     * @param $role_id
     * @param $permissions
     * @return int
     */
    public function editPermissions($role_id, $permissions)
    {
        if($this->deletePermissions($role_id, $permissions))
            $this->addPermissions($role_id, $permissions);

        return 1;
    }

    /**
     * Delete permission.
     *
     * @param $role_id
     * @param $permissions
     * @return mixed
     */
    public function deletePermissions($role_id, $permissions)
    {

        return $this->db->delete('permission_roles', array('role_id' => $role_id));
    }

    /**
     * Read role wise permissions.
     *
     * @param $id
     * @return array
     */
    public function roleWisePermissions($id)
    {
        return array_map(function($item){
            return $item["permission_id"];
        }, $this->db->get_where("permission_roles", array("role_id" => $id))->result_array());
    }

    /**
     * Read permission details associated with role.
     *
     * @param $id
     * @return array
     */
    public function roleWisePermissionDetails($id)
    {
        return array_map(function($item){
            $role = new Role();
            return $role->findPermission($item);
        }, $this->roleWisePermissions($id));
    }

    /**
     * Find permission.
     *
     * @param $id
     * @return mixed
     */
    public function findPermission($id)
    {
        return $this->db->get_where("permissions", array("id" => $id, "deleted_at" => null))->row(0);
    }

    /**
     * Read role id against name.
     *
     * @param $name
     * @return mixed
     */
    public function roleID($name)
    {
        return $this->db->get_where("roles", array("name" => $name, "deleted_at" => null))->row(0)->id;
    }
}