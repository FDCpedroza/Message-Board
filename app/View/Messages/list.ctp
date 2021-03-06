<?php
$this->extend('/Layouts/card');
echo $this->element('navbar', array('messageListActive' => 'active'));
//echo $this->html->link('New Message', ['controller' => 'messages', 'action' => 'compose']);
echo $this->html->css('list');
echo $this->html->script('list.js');
?>
<div class='row '>
    
    <div class="input-group my-3 mx-4">
    <input 
        id='search-input' 
        type="text" 
        class="form-control" 
        placeholder="Recipient's username" 
        aria-label="Recipient's username" 
        aria-describedby="basic-addon2"
        search-link='<?php echo Router::url(array('controller' => 'messages', 'action' => 'search')) ?>'
        data-user-id = '<?php echo AuthComponent::user()['id'] ?>'
    >
    <div class="input-group-append">
        <button onClick="window.location.href=window.location.href" id='reset-btn' class="btn btn-outline-secondary" type="button">Reset</button>
    </div>
    </div>

</div>

<div class="list-group" id='list-div'>
    
    <!-- <div class='row list-group-item list-group-item-action'>
        <div class='col-10'>
            <a href="" class='row'></a>
        </div>
        <div class='col-2'>
            <div class='delete-items'>
                Delete
            </div>
        </div>
    </div>
     -->
    
    <?php foreach($messageList as $message): ?>
    <?php
        $link =  Router::url([
            'controller' => 'messages', 
            'action' => 'conversation', 
            // 'name' => $message['chat_mate']['name'],
            'id' => $message['chat_mate']['id'],
            
        ]);
        
    ?>
    
    
    
    <a href="<?php echo $link?>" class="list-group-item list-group-item-action">
        <div class='row'>
            <div class='col row'>
                <div class='col-lg-2'>
                    <?php
                        $avatar = $message['chat_mate']['image'];
                        if(!$message['chat_mate']['image']){
                            $avatar = 'https://ui-avatars.com/api/?name='.$message['chat_mate']['name'];
                        }
                        echo $this->Html->image(
                            $avatar, 
                            array(
                                'alt' => 'CakePHP',
                                'class' => 'rounded-circle',
                                'style' => 'width:50px; 
                                            height:50px;'
                                )
                            );
                    ?>    
                </div>
                <div class='col-lg-10'>
                    <div class='row'>
                            <div id='name-div' class='row pl-4 text-capitalize font-weight-bold'>
                                <?php echo $message['chat_mate']['name'];?>
                            </div>
                    </div>
                    <div class='row'>
                            <div id='message-div' class='row pl-4 message-row' 
                            style='white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            display: block;'>
                            <?php echo $message['latest_chat']['content'];?>        
                            </div>
                    </div>
                    <div class='row'>
                            <div id='date-div' class='row pl-4 text-monospace text-muted' style='font-size: xx-small;'>
                                <?php echo date('g:i:s - n/j/y',strtotime($message['latest_chat']['created']));?>        
                            </div>
                    </div>
                </div>
            </div>               
           
        
        </div>
    </a>
    <?php endforeach; ?>
    </div>
    <div class="row pb-5" id='show-res'>
        <div class='col text-center'>
        <?php echo $this->Html->link(
        'Show Messages',
        array(
            'controller' => 'messages', 
            'action' => 'loadMessageList'),
        array(
            'id' => 'show-more-msg',
            'data-user-id' => AuthComponent::user()['id'],
            'path-to-user-inbox' => Router::url(array(
                'controller' => 'messages',
                'action' => 'conversation'
                )),
            'data-path-to-img' => $this->webroot.'img/'    
            ));?>
        </div>
</div>


    

