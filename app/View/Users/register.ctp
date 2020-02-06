<h2>Registration Page</h2>

<?php

    echo $this->Form->create(
        'User',
        array(
            'id' => 'addUserForm',
            'url' => array(
                'controller' => 'users',
                'action' => 'create'
            )
    ));
    echo $this->Form->input('name');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('confirm_password', array(
        'type' => 'password'
    ));
    echo $this->Form->end('Register');
    
    echo $this->Html->script([
        'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js',
        'validation-register.js'
    ]);