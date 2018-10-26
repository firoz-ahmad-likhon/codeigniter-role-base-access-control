<?php
/**
 * Login View
 *
 * @author       Firoz Ahmad Likhon <likh.deshi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="author" content="Firoz Ahmad Likhon <likh.deshi@gmail.com>"/>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style>
        .err {
            color: red;
            font-weight: bold;
        }
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
</head>

<body class="text-center">
<form class="form-signin" method="post" id="loginForm" action="<?= site_url('login') ?>">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
           value="<?= $this->security->get_csrf_hash(); ?>">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?= isset($failed) && !empty($failed) ? "<p class='err'>{$failed}</p>" : ""; ?>
    <?= $this->session->flashdata('success'); ?>

    <label for="username" class="sr-only">Email address</label>
    <?= form_error('username', '<div class="err">', '</div>'); ?>
    <input type="text" id="inputEmail" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>"
           name="username" autofocus>

    <label for="password" class="sr-only">Password</label>
    <?= form_error('password', '<div class="err">', '</div>'); ?>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password"
           value="<?= set_value('password'); ?>" name="password">

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018 <a href="https://github.com/firoz-ahmad-likhon">Likhon</a></p>
</form>
</body>
</html>
