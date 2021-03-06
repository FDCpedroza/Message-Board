<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {
    
    public $helpers = array('Html', 'Form');

    public function beforeFilter() {
        $this->Auth->allow('register', 'create', 'checkEmail');
    }
    
    public function register() {
        
    }
    
    public function person() {
        if($this->Auth->user()) {
            $this->set('person', $this->User->getUser($this->request->id)[0]["users"]);
        }  
    }
    
    public function profile() {
        
        $user = $this->Auth->user();
        $updatedUser = $this->User->find('first', array(
            'conditions' => array('User.id' => $user['id'])
        ));
    
        $this->set('user', $updatedUser['User']);
        if($this->request->is('post')) {
            $this->User->read(null, $user['id']);
            if (
                !empty($this->request->data['User']['Upload Pic']['tmp_name'])
                && is_uploaded_file($this->request->data['User']['Upload Pic']['tmp_name'])
            ) {
                // Strip path information
                $filename = basename($this->request->data['User']['Upload Pic']['name']); 
                move_uploaded_file(
                    $this->data['User']['Upload Pic']['tmp_name'],
                    WWW_ROOT . DS . 'img' . DS . $filename
                );
                $this->User->set(['image' => $this->request->data['User']['Upload Pic']['name']]);
            }
    
            
            $this->User->set([
                // 'image' => $this->request->data['User']['Upload Pic']['name'],
                'name' => $this->request->data['User']['name'],
                'email' => $this->request->data['User']['email'],
                'birthdate' => $this->request->data['User']['date'],
                'gender' => $this->request->data['User']['gender'],
                'hubby' => $this->request->data['User']['hubby']
            ]);
            
            
            
            if($this->User->save()) {
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
                $this->flash(__("Profile Updated! Please wait for a moment. Thank you!"), array("action" => "profile"));
            }else {
                $this->flash(__("Try again next time! Please wait for a moment. Thank you!"), array("action" => "profile"));
            }
            //$this->redirect($this->referer());
            
        }
        
        
    }
    
    public function create() {
        if($this->request->is('post')) {
            $user = $this->request->data['User'];
        
            if($user['password'] == $user['confirm_password']) {
                
                //added some data during beforesave in users model
                $this->User->create();
                if($this->User->save($user)) {
                    $this->Session->setFlash(__('Saved!'));
                }else {
                    $this->flash(__("Try again next time! Please wait for a moment. Thank you!"), array("action" => "register"));
                }
            }
        }
        
    }
    
    public function checkEmail() {
        
        $email =  $this->request->query['data']['User']['email'];  
        $this->render(false);
        
        if($email){
            $count = $this->User->find('first', array(
                'conditions' => array('User.email' => $email)
            ));
            $id = $this->Auth->user('id');
            $loged_user = $this->Auth->user('email');
            if(!$count) {
                //valid email or can be use
                $response = 'true'; 
            }elseif($count && $id && $loged_user === $email) { //checks logged in user for its email 
                //valid email
                $response = 'true';
            }
            else{
                //not valid email or cant be use
                $response = 'Please use another email.';
            }          
        }
        
        //echo $response;
        $this->response->type('application/json');
        $this->response->body(json_encode($response));
        return;
        
        
    }



    // public function logout() {
    //     return $this->redirect($this->Auth->logout());
    // }

    // public function login() {
       
    //     if ($this->request->is('post')) {
            
    //         $attempt = $this->request->data['User'];
    //         $user = $this->User->findByEmail($attempt['email']);
            
    //         if(!empty($user)) {
               
    //             $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
    //             $valid_user = $passwordHasher->check($attempt['password'], $user['User']['password']);
               
    //             if($valid_user) {
    //                 $this->Auth->login($user['User']);
    //                 //store value on last login
    //                 $this->User->id = $this->Auth->user('id');
    //                 $this->User->saveField('last_login_time', date("Y-m-d H:i:s")); 
    //                 return $this->redirect('profile');
    //             }
    //         }
    //         $this->flash(__("Incorrect credentials.."), array("action" => "login"));
    //     }
    // }
    
    
}