<div class="container-fluid">
    <div class="row  justify-content-center">
        <div class='card justify-content-center mt-5'>
            <div class="card-header">
                Login
            </div>
            <div class="card-body text-center">
            <?php 

                echo $this->Form->create('User');
                echo $this->Form->input('email', array(
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Email'
                ));
                echo '<br>';
                echo $this->Form->input('password', array( 
                    'class' => 'form-control',
                    'label' => false,
                    'placeholder' => 'Password'
                ));
                echo '<br>';
                echo $this->Form->end(array(
                    'label' => __('Login'),
                    'class' => 'btn',
                    'div' => array(
                        'class' => 'control-group',
                        ),
                    'before' => '<div class="controls">',
                    'after' => '</div>'
                ));

                //echo $this->Form->end('login');
            ?>
            <br>
            <?php
                echo $this->Html->link('Sign Up!', '/users/register');
                
                
            ?>
            </div>
        </div>
    </div>
</div>