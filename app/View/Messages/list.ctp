<h2>Messagess!</h2>

<?php

echo $this->html->link('New Message', ['controller' => 'messages', 'action' => 'compose']);
//echo $this->html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');

echo $this->html->css('list');



?>

  

<?php
foreach($messageList as $data) {
    $link = '/cake-msg/messages/conversation/'.((int)$data['from']['id'] == AuthComponent::user('id')? $data['to']['name'] : $data['from']['name']);
    
?>
    <a href="<?php echo $link?>">
        <div class='msg-div'>
            <div class='avatar-div'>
                <?php
                    $avatar = 'https://ui-avatars.com/api/?name='.$data['to']['name'];
                    if(!$data['to']['name']){
                        $avatar = $data['to']['image'];
                    }
                    echo $this->Html->image($avatar , 
                                        array(
                                            'alt' => 'CakePHP',
                                            'style' => 'width:100px; 
                                                        height:100px;'
                                            )
                                        );
                ?>
            </div>
            <div class='content-div'>
                <?php
                    echo $data['message']['content'];        
                ?>
            </div>
            <div class='date-div'> 
                <?php
                    echo $data['message']['created'];        
                ?>
            </div>
        </div>


    </a>
<?php
}
?>