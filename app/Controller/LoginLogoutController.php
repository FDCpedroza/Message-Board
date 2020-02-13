<?php

    class LoginLogoutController extends AppController {

        public $uses = ['User'];

        public function login() {
            
            if($this->Auth->user()) {
                $this->redirect(array('controller' => 'messages', 'action' => 'list'));
                return;
            }
            
            $this->viewPath = '/';
            $this->render('login');

            if ($this->request->is('post')) {
            
                $attempt = $this->request->data['User'];
                $user = $this->User->findByEmail($attempt['email']);
                
                if(!empty($user)) {
                    App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
                    $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                    $valid_user = $passwordHasher->check($attempt['password'], $user['User']['password']);
                   
                    if($valid_user) {
                        $this->Auth->login($user['User']);
                        
                        //store value on last login
                        $this->User->id = $this->Auth->user('id');
                        $this->User->saveField('last_login_time', date("Y-m-d H:i:s")); 
                        return $this->redirect(array('controller' => 'users', 'action' => 'profile'));
                    }
                }
                $this->flash(__("Incorrect credentials.."), array("action" => "login"));
            }

        }

        public function logout() {
            return $this->redirect($this->Auth->logout());
        }



    }