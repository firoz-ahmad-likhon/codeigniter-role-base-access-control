<?php
/**
 * @author       Firoz Ahmad Likhon <likh.deshi@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Firoz Ahmad Likhon <likh.deshi@gmail.com>"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="text-center">
    Welcome to home.
    For logout: <a href="<?= site_url('login/logout')?>">Click here</a>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>#To add permission#</h3>
                <p>Name format: method_name-controller_name.</p>
                <p>Example: if the controller name is 'roles; and 'edit' is a method then name will be <code>'edit-roles'</code></p>
                <code>
                $this->Permission->add([
                    'name' => 'add-roles',
                    'display_name' => 'Create Role',
                    'status' => 1,
                ]);
                </code>

                <h3>#To add role#</h3>
                <code>
                    $this->Role->add([
                    'name' => 'editor',
                    'display_name' => 'editor',
                    'description' => 'Editor can edit and publish posts',
                    'status' => 1,
                    ]);
                </code>

                <h3>#To assign permissions with role#</h3>
                <p>$permissions will be a permission id or an array of permission id</p>
                <code>
                    $this->Role->addPermissions($role_id, $permissions);
                </code>

                <h3>#To add User#</h3>
                <code>
                    $this->User->add([
                    'name' => 'Likhon',
                    'username' => 'likhon',
                    'password' => password_hash('admin', PASSWORD_BCRYPT),
                    'status' => 1,
                    ]);
                </code>

                <h3>#To assign roles with user#</h3>
                <p>$roles will be a role id or an array of role id</p>
                <code>
                    $this->User->addRoles($user_id, $roles);
                </code>

                <div class="mt-5"></div>

                <h3>#To activate auth library#</h3>
                <p>To enable authentication put these line in controller's construction method:</p>

                <pre><strong>
                    $this->load->library(['auth']);
                    $this->auth->route_access();
                </strong></pre>

                <p>If you want to authenticate only some methods of a controller then use</p>
                <p>$methods is a single or array of method name of a controller</p>
                <samp>$this->auth->only['edit', 'delete']</samp><br>

                <code>$this->auth->only($methods)</code>

                <p> Or if you need to not check authentication for some methods then use:</p>
                <code>$this->auth->except($methods)</code>

                <p>Check if current user is logged in.</p>
                <code>
                    if( check() ) {}
                </code>

                <p>Check if current user has a permission by its name.</p>
                <code>
                    if( can($permissions) ) {}
                </code>
                <p>Example: <samp>if( can('edit-posts') ) {} or if( can(['edit-posts', 'publish-posts']) ) {}</samp></p>
            </div>
        </div>
    </div>
</body>
</html>

