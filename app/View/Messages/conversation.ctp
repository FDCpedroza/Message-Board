<?php
$this->extend('/Layouts/card');
echo $this->element('navbar', array('messageListActive' => 'active'));
//echo $this->html->link('New Message', ['controller' => 'messages', 'action' => 'compose']);
echo $this->html->css('navbar');
echo $this->Html->script('conversation.js');
?>


<h5 class='text-capitalize'> <?php echo $reciever['name']?></h2>


<div class='row'>
    <div class='col-lg-9'></div>
    <div class='col-lg-3'></div>
</div>
<?php 

    echo $this->form->create('Message', 
        array(
            'url' => array(
                'controller' => 'messages',
                'action' => 'create'   
            )
        ));
    echo $this->form->input('Recepient', array('type' => 'hidden', 'value' => $reciever['id']));
    echo $this->form->textarea(
        'Message', 
        array(
            'id' => 'message-input',
            'class'=>"form-control mb-1 message-input",
            'aria-label'=>"With textarea",
            ));
    echo $this->Form->end(array(
        'label' => __('Send'),
        'class' => 'btn btn-block btn-sm message-btn',
        'disabled' => 'disabled',
        'id' => 'form-submit',
        'div' => array(
            'class' => 'control-group',
            ),
        'before' => '<div class="controls">',
        'after' => '</div>'
        ));
    echo $this->html->css('conversation');
    
?>

<br><hr>

<div id='message-div'>
    <?php
        foreach ($conversation as $convo) :
            $avatar = 'https://ui-avatars.com/api/?name='.($convo['message']['to_id'] == AuthComponent::user()['id']? $reciever['name']: AuthComponent::user()['name']);
            if($convo['message']['to_id'] == AuthComponent::user()['id'] && $reciever['image'] ) {
                $avatar = $reciever['image'];
            }elseif($convo['message']['to_id'] != AuthComponent::user()['id'] && AuthComponent::user()['image']) {
                $avatar = AuthComponent::user()['image'];
            }
    ?>
    <div class='row'>
        
        <?php if($convo['message']['to_id'] == AuthComponent::user()['id']): ?>    
            <div class='col-2'>
                <?php
                    echo $this->Html->image(
                        $avatar , 
                        array(
                            'alt' => 'CakePHP',
                            'class' => 'rounded-circle receiver-pic',
                            )
                        );
                ?>
            </div>
        <?php endif; ?>
        
        <div class='message-div col-9 alert <?php echo ($convo['message']['to_id'] == AuthComponent::user()['id']? 'alert-primary': 'alert-secondary offset-1');?>' msg-id='<?php echo $convo['message']['id']?>'>
            <?php echo $convo['message']['content'] ?>
        </div>
        
        <?php if($convo['message']['to_id'] != AuthComponent::user()['id']): ?>    
            <div class='col-2'>
                <?php echo $this->Html->image(
                    $avatar , 
                    array(
                        'alt' => 'CakePHP',
                        'class' => 'rounded-circle user-pic',
                        )
                    );?>
            </div>
        <?php endif; ?>
        
        
    </div>
    
    <?php endforeach; ?>
</div>  
    
    <div class="row" id='show-res'>
        <div class='col text-center'>
        <?php echo $this->Html->link(
        'Show Messages',
        array(
            'controller' => 'messages', 
            'action' => 'loadMsg'),
        array(
            'id' => 'show-more-msg',
            'data-user-id' => AuthComponent::user()['id'],
            'data-reciever-id' => $reciever['id']
            ));?>
        </div>
    
    </div>
    
    
  
    

    
    
    
    

