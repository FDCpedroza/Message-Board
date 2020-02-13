<?php

class MessagesController extends AppController {
    
    public $uses = ['message', 'user'];
    
    
    public function loadMessageList() {
        $this->render(false);
        $offset = $this->request->data['offset'];
        $count = $this->request->data['count'];
        $user = $this->request->data['user'];        
        $datas = $this->message->paginateMessageList($user, $offset, $count);
        $this->response->type('application/json');
        $this->response->body(json_encode($datas));
        return;   
    }
    
    public function loadMsg() {
        $this->render(false);
        $offset = $this->request->data['offset'];
        $count = $this->request->data['count'];
        $user = $this->request->data['user'];
        $reciever = $this->request->data['reciever'];
        $datas = $this->message->paginateConvo($user, $reciever, $offset, $count);
        $reciever = $this->user->getUser($reciever);
        $user = $this->user->getUser($user);  
        $res = array(
            'data' => $datas,
            'reciever' => $reciever[0]['users'],
            'user' => $user[0]['users']
        );
        $this->response->type('application/json');
        $this->response->body(json_encode($res));
        return;
    }
    
    public function list(){      
        $current_user = $this->Auth->user('id');        
        $this->set('messageList' ,$this->message->paginateMessageList($current_user));  
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
           if(isset($this->request->data['Message']['compose'])){
                $this->redirect(
                    array(
                        "controller" => "messages", 
                        "action" => "conversation",
                        'id' => $msg['to_id'] 
                    ));
                return ;
           }
        $response = 'Success';
       }else{
            if(isset($this->request->data['Message']['compose'])){
                $this->flash(__("Please try again!"), array("action" => "compose"));
                return ;
            }
            
        $response = 'Fail';
       }
       $this->response->type('application/json');
        $this->response->body(json_encode($response));
        return;
       
       
    }
    
    public function conversation() {
        $reciever = $this->user->getUser($this->request->id);
        $name = $reciever['0']['users']['name'];
        $conversaion = $this->message->paginateConvo($this->Auth->user('id'), $this->request->id);
        $this->set(
            array(
                'reciever' => $reciever['0']['users'] , 
                'conversation' => $conversaion
            ));
    }
    
    public function detail() {
        $this->render(false);
        $data = $this->message->getMessage($this->request->query['id']);    
        $this->response->type('application/json');
        $this->response->body(json_encode($data));
        return;
    }
    
    
    public function deleteMessage() {
        $this->render(false);
        $data = $this->message->delete($this->request->query['id']);        
        $this->response->type('application/json');
        $this->response->body(json_encode($data));
        return;
    }
    
    public function deleteConvo() {        
        $this->render(false);
        $this->message->deleteConvo($this->request->query['user'], $this->request->query['someone']);
        $this->flash(__("Conversation Deleted. Please wait for a moment Thank You!"), array("action" => "list"));
    }
    
    
    public function search() {
        $this->render(false);
        $data = $this->message->findWord($this->request->data['searchWord'], $this->request->data['user']);
        $this->response->type('application/json');
        $this->response->body(json_encode($data));
        return;
        
    }
    
}