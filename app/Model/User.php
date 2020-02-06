<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    // public function beforeSave($options = array()) {
    //     $this->data['User']['password'] = AuthComponent::password(
    //       $this->data['User']['password']
    //     );
    //     return true;
    // }
    
    public function beforeSave($options = array()) {
    
       if(!$this->data[$this->alias]['id']) {
            //hash password
            if (!empty($this->data[$this->alias]['password'])) {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            
            //creates value for created ip 
            $this->data[$this->alias]['created_ip'] = CakeRequest::clientIp();
       }else {
            $this->data[$this->alias]['modified_ip'] = CakeRequest::clientIp();
       }
      
      
      return true;
  }
}