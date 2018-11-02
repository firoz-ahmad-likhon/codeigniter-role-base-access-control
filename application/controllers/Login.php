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

class Login extends CI_Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a library
    | to conveniently provide its functionality to your applications.
    |
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['auth', 'form_validation']);
    }

    /**
     * handle the login.
     */
    public function index()
    {
        $data = array();

        if($_POST) {
            $data = $this->auth->login($_POST);
        }

        return $this->auth->showLoginForm($data);
    }

    /**
     * Logout.
     */
    public function logout()
    {
        if($this->auth->logout())
            return redirect('login');

        return false;
    }
}
