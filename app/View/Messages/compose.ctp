<?php
$this->extend('/Layouts/card');
echo $this->element('navbar', array('composeActive' => 'active'));
echo $this->html->css('navbar');
?>

<h2>
Write A Message
</h2>
<br>
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
        'empty' => '',
        'class' => 'custom-select'
    ),
    
);

echo $this->form->input('compose', 
    array(
        'value' => '1',
        'class' => 'custom-select',
        'type' => 'hidden',
    ),
    
);

echo '<br>';

echo $this->form->textarea('Message', array(
    'class'=>"form-control message-input",
    'aria-label'=>"With textarea",
    'rows' => 10,
    'placeholder'  => 'Write your message here.'
));

echo '<br>'.$this->Form->end(array(
    'label' => __('Send'),
    'class' => 'btn btn-block message-btn',
    'id' => 'form-submit',
    'disabled' => 'disabled',
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
                      