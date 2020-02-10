<?php

class MessagesController extends AppController {
    
    public $uses = ['message', 'user'];
    
    public function loadMsg() {
        $this->render(false);
        $offset = $this->request->data['offset'];
        $count = $this->request->data['count'];
        $user = $this->request->data['user'];
        $reciever = $this->request->data['reciever'];
        
        $data = $this->message->paginate($user, $reciever, $offset, $count);
        $this->response->type('application/json');
        $this->response->body(json_encode($data));
        return;
        

    }
    
    public function list(){
        
        $current_user = $this->Auth->user('id');        
        $this->set('messageList' ,$this->message->getMessageList($current_user));
        
    }
    
    public function compose(){
        
        $current_user = $this->Auth->user('id');
        $alluser = $this->user->getRecepient($current_user);        
        $this->set('users', $alluser);
        
    }
    
    public function create() {
        $this->render(false);
        $msg = [
            'to_id' => $this->request->data['Message']['Recepient'],
            'from_id' => $this->Auth->user('id'),
            'content' => $this->request->data['Message']['Message']
            
        ];
        
       $this->message->create();
       if($this->message->save($msg)) {
           $response = 'Success';
        // $this->redirect(array("controller" => "messages", 
        //                 "action" => "conversation",
        //                  $msg['to_id'] ));
       }else{
            $response = 'Fail';    
        // $this->flash(__("Please try again!"), array("action" => "compose"));;
       }
       $this->response->type('application/json');
        $this->response->body(json_encode($response));
        return;
       
       
    }
    
    public function conversation($id, $name = null) {
        $sender = $this->user->find('first', array('conditions' => array('User.id' => $id)));
        
        if(is_null($name)){
            $name = $sender['user']['name'];
        }
        $conversaion = $this->message->paginate($this->Auth->user('id'), $id);

        $this->set(
            array(
                'sender' => $sender['user'] , 
                'conversation' => $conversaion
            ));
    }
    
}