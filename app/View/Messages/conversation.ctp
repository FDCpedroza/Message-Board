<?php
$this->extend('/Layouts/card');
echo $this->element('navbar', array('messageListActive' => 'active'));
echo $this->html->css('navbar');
echo $this->Html->script('conversation.js');
echo $this->Html->script('realtime.js');
?>


<div class='row'>
    <div class='col'>
        <h5 class='text-capitalize'> <?php echo $reciever['name']?></h2>
    </div>
    <div class='col text-right'>
        <?php echo $this->Html->link(
            'Delete Conversation',
            array(
                'controller' => 'messages', 
                'action' => 'deleteConvo',
                '?' => array(
                    'user' => AuthComponent::user()['id'],
                    'someone' => $reciever['id']
                )
            ));?>
    </div>
</div>

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
            'data-from' => AuthComponent::user()['id'],
            'data-to' => $reciever['id']
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

    $specficMessageUrl = Router::url(['controller' => 'messages', 'action' => 'findMsg']);
    
?>

<br><hr>

<div id='message-div' data-find-message-url="<?php echo $specficMessageUrl; ?>">
    <?php
        foreach ($conversation as $convo) :
            $avatar = 'https://ui-avatars.com/api/?name='.($convo['message']['to_id'] == AuthComponent::user()['id']? $reciever['name']: AuthComponent::user()['name']);
            if($convo['message']['to_id'] == AuthComponent::user()['id'] && $reciever['image'] ) {
                $avatar = $reciever['image'];
            }elseif($convo['message']['to_id'] != AuthComponent::user()['id'] && AuthComponent::user()['image']) {
                $avatar = AuthComponent::user()['image'];
            }
            $determiner = ($convo['message']['from_id'] == AuthComponent::user()['id']? 'msg-from-user': 'msg-from-someone')
    ?>
    <div class='row <?php echo $determiner ?>' id='msg-row-id-<?php echo $convo['message']['id']?>'>
        <!-- someone -->
        <?php if($convo['message']['to_id'] == AuthComponent::user()['id']): ?>    
            <div class='col-2 text-right'>
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
            
        <div class='message-div col-9 alert <?php echo ($convo['message']['to_id'] == AuthComponent::user()['id']? 'alert-primary': 'alert-secondary offset-1 ');?>' 
        msg-id='<?php echo $convo['message']['id']?>'
        msg-created='<?php echo $convo['message']['created']?>'
        data-link='<?php echo Router::url(['controller' => 'messages', 'action' => 'detail', '?'=> array('id' => $convo['message']['id'])]);?>'
        data-delete-link='<?php echo Router::url(['controller' => 'messages', 'action' => 'deleteMessage', '?'=> array('id' => $convo['message']['id'])]);?>'
        >
            <?php echo $convo['message']['content'] ?> <br>
        </div>
        <!-- user -->
        <?php if($convo['message']['to_id'] != AuthComponent::user()['id']): ?>    
            <div class='col-2 text-left'>
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
            'data-reciever-id' => $reciever['id'],
            'data-path-to-img' => $this->webroot.'img/'
            ));?>
        </div>
    
    </div>
    
    
    
    
    
  
    

    
    
    
    

