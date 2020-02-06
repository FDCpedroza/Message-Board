<?php

class MessagesController extends AppController {
    
    public $uses = ['message', 'user'];
    
    public function list(){
    
        $current_user = $this->Auth->user('id');        
        $this->set('messageList' ,$this->message->getMessageList($current_user));
        // echo '<pre>';
        // var_dump('messageList' ,$this->message->getMessageList($current_user));
        //    die();
    }
    
    public function compose(){
        $current_user = $this->Auth->user('id');
        $alluser = $this->user->getRecepient($current_user);        
        $this->set('users', $alluser);
        
    }
    
    public function create() {
        
        $msg = [
            'to_id' => $this->request->data['Message']['Recepient'],
            'from_id' => $this->Auth->user('id'),
            'content' => $this->request->data['Message']['Message']
            
        ];
        
       $this->message->create();
       if($this->message->save($msg)) {
            $this->flash(__("Message Sent!"), array("action" => "compose"));
       }else{
            $this->flash(__("Please try again!"), array("action" => "compose"));;
       }
       
    }
    public function conversation($name) {
        $this->set('name', $name);
    }
    
}