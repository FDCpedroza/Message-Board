<?php

class MessagesController extends AppController {
    
    public $uses = ['message', 'user'];
    
    public function list(){
        
    }
    
    public function compose(){
        
        $alluser = $this->user->find('all');
        $this->set('users', $alluser);
        
    }
    
}