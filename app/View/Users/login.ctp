<h2>Login Page</h2>

<?php 

    echo $this->Form->create('User');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->end('Login');
?>
<br>
<?php
    echo $this->Html->link('Register', '/users/register');
    
    
  