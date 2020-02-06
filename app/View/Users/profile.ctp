<div id='summary'></div>
<?php
    $avatar = 'https://ui-avatars.com/api/?name='.$user['name'];
    if($user['image']){
        $avatar = $user['image'];
    }
    echo $this->Html->image($avatar , 
                        array(
                            'alt' => 'CakePHP',
                            'style' => 'width:100px; 
                                        height:100px;'
                            )
                        );
                        
    echo $this->Form->create(
        'User',
        array(
            'enctype'=>'multipart/form-data',
            'id' => 'editUserForm',
            'url' => array(
                'controller' => 'users',
                'action' => 'profile',
            )
    ));
    echo $this->Form->input('Upload Pic', array( 'type' => 'file'));
    echo $this->Form->input('name', array('value' => $user['name']));
    echo $this->Form->input('email', array('value' => $user['email']));
    echo $this->Form->input('date', array('value' => $user['birthdate']));
    $options = array('1' => 'Male', '2' => 'Female');
    $attributes = array('value' => (int)$user['gender']);
    echo $this->Form->radio('gender', $options, $attributes);
    echo $this->Form->textarea('hubby', array('value' => $user['hubby']));
    echo $this->Form->end('Register');
    
    
    
    
    echo $this->Html->script([
        'https://code.jquery.com/jquery-1.10.2.js',
        'https://code.jquery.com/ui/1.10.4/jquery-ui.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js',
        'profile.js',
        'validation-profile.js'
    ]);
    
    echo $this->Html->css('profile');


