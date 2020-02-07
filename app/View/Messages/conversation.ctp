<h2>Convo with <u><?php echo $name?><u/></h2>

<br>
<br>

<?php 

    echo $this->form->create('Message', 
        array(
            'url' => array(
                'controller' => 'messages',
                'action' => 'create'   
            )
        ));
    echo $this->form->textarea('Message', ['rows' => '', 'style' => 'width:70%;'] );
    echo $this->form->end('Send', ['style' => 'float:left;']);
    
    
    echo $this->html->css('conversation');
    
?>



<div>
    
</div>