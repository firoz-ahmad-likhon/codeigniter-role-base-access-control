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

class User extends CI_Model
{
    /**
     * User constructor.
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
        return $this->db->get_where("users", array("id" => $id, "deleted_at" => null))->row(0);
    }

    /**
     * Find all data.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->db->get_where("users", array("deleted_at" => null))->result();
    }

    /**
     * Insert data.
     *
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        return $this->db->insert('users', $data);
    }

    /**
     * Edit data.
     *
     * @param $data
     * @return mixed
     */
    public function edit($data)
    {
        return $this->db->update('users', $data, array('id' => $data['id']));
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

        return $this->find($id) ? $this->db->update('users', $data, array('id' => $id)) : 0;
    }

    /**
     * Insert roles.
     *
     * @param $user_id
     * @param $roles
     * @return int
     */
    public function addRoles($user_id, $roles)
    {
        $data["user_id"] = $user_id;
        if (is_array($roles)) {
            foreach ($roles as $role) {
                $data["role_id"] = $role;
                $this->addRole($data);
            }
        }
        else {
            $data["role_id"] = $roles;
            $this->addRole($data);
        }

        return 1;
    }

    /**
     * Insert role.
     *
     * @param $data
     * @return mixed
     */
    public function addRole($data)
    {
        return $this->db->insert('roles_users', $data);
    }

    /**
     * Edit roles.
     *
     * @param $user_id
     * @param $roles
     * @return int
     */
    public function editRoles($user_id, $roles)
    {
        if($this->deleteRoles($user_id, $roles))
            $this->addRoles($user_id, $roles);

        return 1;
    }

    /**
     * Delete roles.
     *
     * @param $user_id
     * @param $roles
     * @return mixed
     */
    public function deleteRoles($user_id, $roles)
    {

        return $this->db->delete('roles_users', array('user_id' => $user_id));
    }

    /**
     * Delete role.
     *
     * @param $user_id
     * @param $role_id
     * @return mixed
     */
    public function deleteRole($user_id, $role_id)
    {

        return $this->db->delete('roles_users', array('user_id' => $user_id, 'role_id' => $role_id));
    }

    /**
     * Find roles associated with user.
     *
     * @param $id
     * @return array
     */
    public function userWiseRoles($id)
    {
        return array_map(function($item){
            return $item["role_id"];
        }, $this->db->get_where("roles_users", array("user_id" => $id))->result_array());
    }

    /**
     * Find role details associated with user.
     *
     * @param $id
     * @return array
     */
    public function userWiseRoleDetails($id)
    {
        return array_map(function($item){
            $user = new User();
            return $user->findRole($item);
        }, $this->userWiseRoles($id));
    }

    /**
     * Find role.
     *
     * @param $id
     * @return mixed
     */
    public function findRole($id)
    {
        return $this->db->get_where("roles", array("id" => $id, "deleted_at" => null))->row(0);
    }
}