<?php 
    $this->extend('/Layouts/card');
    echo $this->element('navbar', array('profileActive' => 'active'));
    echo $this->html->css('navbar');
?>


<div class='text-center div-img'>
    <?php
        $avatar = 'https://ui-avatars.com/api/?name='.$user['name'];
        if($user['image']){
            $avatar = $user['image'];
        }
        echo $this->Html->image($avatar , 
            array(
                'id' => 'user-avatar',
                'class' => 'rounded-circle',
                'alt' => 'CakePHP',
                'style' => 'width:100px; 
                height:100px;'
                )
        );
        echo '<br>'.$this->Html->link('Upload', '', array('id' => 'upload-link'));
    ?>    
</div>
<div id='error' class='alert alert-danger alert-dismissible fade show' style='display:none;'></div>
<?php                    
    echo $this->Form->create(
        'User',
        array(
            'enctype'=>'multipart/form-data',
            'id' => 'app-form',
            'url' => array(
                'controller' => 'users',
                'action' => 'profile',
            )
    ));
    //echo $user['image'];
    echo $this->Form->input(
        'Upload Pic', 
        array( 
            'type' => 'file', 
            'style' => 'display:none;', 
            'label' => false,
            'value' => $user['image']
        ));
    echo $this->Form->input(
        'name', 
        array(
            'value' => $user['name'],
            'class' => 'form-control'
        ));
    echo $this->Form->input(
        'email', 
        array(
            'value' => $user['email'],
            'class' => 'form-control'
        ));
    echo $this->Form->input(
        'date',
        array(
            'value' => $user['birthdate'],
            'class' => 'form-control'
        ));
    $options = array('1' => 'Male', '2' => 'Female');
    $attributes = array(
        'value' => (int)$user['gender'],
        'legend' =>false
    );
    echo '<br>'.$this->Form->radio(
        'gender', 
        $options, 
        $attributes
    );
    echo '<br>Hobby<br>';
    echo $this->Form->textarea(
        'hubby', 
        array(
            'value' => $user['hubby'], 'class' => 'form-control'));
    echo '<br>'.$this->Form->end(array(
        'label' => __('Save'),
        'class' => 'btn',
        'id' => 'form-submit',
        'div' => array(
            'class' => 'control-group',
            ),
        'before' => '<div class="controls">',
        'after' => '</div>'
    ));

    
    
    echo $this->Html->script([
        // 'https://code.jquery.com/jquery-1.10.2.js',
        'https://code.jquery.com/ui/1.10.4/jquery-ui.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js',
        'datepicker.js',
        // 'validation-profile.js',
        'picture-profile.js',
    ]);
    echo $this->Html->script('disable-form-submit.js');

    
    ?>