<?php
$this->extend('/Layouts/card');
echo $this->element('navbar', array('composeActive' => 'active'));
//echo $this->html->link('New Message', ['controller' => 'messages', 'action' => 'compose']);
echo $this->html->css('navbar');
?>
<?php

echo $this->form->create('Message', 
    array(
        'url' => array(
            'controller' => 'messages',
            'action' => 'create'   
        )
    ));
echo $this->form->input('Recepient', 
    array(
        'options' => $users,
        'class' => 'custom-select'
    ),
    
);
echo '<br>';

echo $this->form->textarea('Message', array(
    'class'=>"form-control message-input",
    'aria-label'=>"With textarea",
    'rows' => 10
));
//echo $this->form->end('Send');

echo '<br>'.$this->Form->end(array(
    'label' => __('Send'),
    'class' => 'btn btn-block',
    'id' => 'form-submit',
    'div' => array(
        'class' => 'control-group',
        ),
    'before' => '<div class="controls">',
    'after' => '</div>'
));

echo $this->html->css('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
echo $this->html->css('compose-select');
echo $this->html->script(['https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js',
                        'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
                        'select.js']);
                      