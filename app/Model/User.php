<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    
    public $hasMany = array(
        'Messages' => array(
            'className' => 'Message',
            'foreignKey' => 'from_id',
        )
    );

    public function beforeSave($options = array()) {
       //check if user id exists in the data 
        if(!array_key_exists('id',$this->data[$this->alias])) {
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
  
    public function getRecepient($id) {
        
        //returns all user except the logged in user
        return $this->find('list', array(
            'conditions' => array('id !=' => $id),
            'fields' => array('id', 'name')
        ));
    }
    
    public function getUser($id) {
        return $this->query("SELECT `id`, `name`, `email`, `image`, `gender`,`birthdate`, `hubby`, `last_login_time`, `created`, `modified`
            FROM `users`
            WHERE `id` = $id");
    }
  
  
}