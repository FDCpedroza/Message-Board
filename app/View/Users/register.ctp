<div id='error' class='alert alert-danger alert-dismissible fade show' style='display:none;'></div>
<?php
    $this->extend('/Layouts/card');
    echo $this->Form->create(
        'User',
        array(
            'id' => 'addUserForm',
            'url' => array(
                'controller' => 'users',
                'action' => 'create'
            )
    ));
    echo $this->Form->input('name', array('class' => 'form-control'));
    echo $this->Form->input('email', array('class' => 'form-control'));
    echo $this->Form->input('password', array('class' => 'form-control'));
    echo $this->Form->input('confirm_password', array(
        'type' => 'password',
        'class' => 'form-control'
    ));
    echo '<br>'.$this->Form->end(array(
        'label' => __('Register'),
        'class' => 'btn',
        'id' => 'form-submit',
        'div' => array(
            'class' => 'control-group',
            ),
        'before' => '<div class="controls">',
        'after' => '</div>'
    ));
    
    echo $this->Html->script([
        //  'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js',
        // 'validation-register.js'
    ]);

        echo $this->Html->script('disable-form-submit.js');