<h2>Messagess!</h2>

<?php

echo $this->html->link('New Message', ['controller' => 'messages', 'action' => 'compose']);
//echo $this->html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');

echo $this->html->css('list');



?>

  

<?php
foreach($messageList as $message) {
    $link = '/cake-msg/messages/conversation/'.$message['chat_mate']['id'] .'/'.$message['chat_mate']['name'];
    
?>
    <a href="<?php echo $link?>">
        <div class='msg-div'>
            <div class='avatar-div'>
                <?php
                    $avatar = $message['chat_mate']['image'];
                    if(!$message['chat_mate']['image']){
                        $avatar = 'https://ui-avatars.com/api/?name='.$message['chat_mate']['name'];
                    }
                    echo $this->Html->image($avatar , 
                                        array(
                                            'alt' => 'CakePHP',
                                            'style' => 'width:100px; 
                                                        height:100px;'
                                            )
                                        );
                ?>
            <div >
                <p class='name'><?php echo $message['chat_mate']['name'];?></p>
            </div>
            </div>
           
            <div class='content-div'>
                <p class='chat-paragraph'><i><?php echo $message['latest_chat']['content'];?></i></p>
            </div>
            <div class='date-div'> 
                <?php echo $message['latest_chat']['created'];?>
            </div>
           
        </div>


    </a>
<?php
}
?>