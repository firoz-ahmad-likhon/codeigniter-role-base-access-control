# Role Base Access Control

It is a library for CodeIgniter to manage role base access control.

### Requirement ###
* CodeIgniter Version >= 3
* PHP Version >= 5.6

### Installation ###

* Download/Clone the repository
* Put all files into your project directory respectively.
* Ensure the session library and auth_helper are auto loaded in config/autoload.php:


        $autoload['libraries'] = array('session');
        $autoload['helper'] = array('auth_helper', 'url');
    
* You can set login as a default controller in config/route.php.


        $route['default_controller'] = 'login';

* Run sql file attached with this repository. The default username and password are: admin

Now you are ready to browse the application.

### Manage ##
**Add permission:**

Name format: **method_name-controller_name**
 _Example: if the controller name is 'roles; and 'edit' is a method then name will be 'edit-roles'_
               
    $this->Permission->add([
        'name' => 'add-roles',
        'display_name' => 'Create Role',
        'status' => 1,
    ]);
              

**Add role:**
  
    $this->Role->add([
        'name' => 'editor',
        'display_name' => 'editor',
        'description' => 'Editor can edit and   publish posts',
        'status' => 1,
    ]);

**Assign permissions with role:**

_$permissions will be a permission id or an array of permission id_

    $this->Role->addPermissions($role_id, $permissions);

Example:

    $this->Role->addPermissions(1, [2, 3]);
**Add User:**


    $this->User->add([
        'name' => 'Likhon',
        'username' => 'likhon',
        'password' => password_hash('admin',   PASSWORD_BCRYPT),,
        'status' => 1,
    ]);
               

**Assign roles with user:**

_$roles will be a role id or an array of role id_

    $this->User->addRoles($user_id, $roles);

Example:

    $this->User->addRoles(2, [2, 3]);
### Role base access control ###

Role base access control is a library that makes decision for access on the permissions. This library can handle multi roles.
To enable authentication put these line in controller's construction method:

    $this->load->library(['auth']);
    $this->auth->route_access();
    
If you want to authenticate only some methods of a controller then use

    $this->auth->only($methods)
    
Uses: 

    $this->auth->only(['edit-posts', 'publish-posts'])
Or if you need to not check authentication for some methods then use:

    $this->auth->except($methods)

Uses: 

    $this->auth->except(['add-posts'])
Helper
======
Check if current user is logged in.

    check()
    
Check if current user has a permission by its name.

    can($permissions)
    
Uses:

    if( can('edit-posts') ) {}
    if( can(['edit-posts', 'publish-posts']) ) {}

Checks if the current user has a role by its name.

    hasRole($roles)

Uses

    if( hasRoles(['admin', 'editor']) ) {}
    if( hasRoles('subscriber') ) {}    
Method
======
Check login status: return true|false
  
    $this->auth->loginStatus()

Guest user check: return true|false

    $this->auth->guest()
   
Read authenticated user ID

    $this->auth->userID()
  
Read authenticated user Name
   
    $this->auth->userName()

Read authenticated user roles

    $this->auth->roles()

Read authenticated user permissions

    $this->auth->permissions()
    
Logout

    $this->auth->logout()