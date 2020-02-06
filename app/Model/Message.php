<?php

class Message extends AppModel {
    // /public $belongsTo = 'User';
    // public $belongsTo = array(
    //     'User' => array(
    //         'className' => 'User',
    //         'foreignKey' => 'to_id',
    //     )
    // );
    
    public function getMessageList($id) {
    
        // $options = [
        //     'fields' => array('to_id','content','created','to.id' ,'to.name', 'to.image','from.id' ,'from.name', 'from.image'),
        //     'joins' => array(
        //         array(
        //             'table' => 'users',
        //             'alias' => 'to',
        //             'type' => 'LEFT',
        //             'conditions' => array('to.id = message.to_id')
        //         ), array(
        //             'table' => 'users',
        //             'alias' => 'from',
        //             'type' => 'LEFT',
        //             'conditions' => array('from.id = message.from_id')
        //         ),
        //     ),
        //     'conditions' => array('OR' => array('to_id' => $id, 'from_id' => $id)),
        //     'order' => array('created' => 'desc')
        // ];
        
        
        $options = [
            //'fields' => array('to_id','content','created','DISTINCT  (to.id)' ,'to.name', 'to.image','DISTINCT  (from.id)' ,'from.name', 'from.image'),
            'fields' => array('to_id','content','created','to.id' ,'to.name', 'to.image','from.id' ,'from.name', 'from.image'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'to',
                    'type' => 'LEFT',
                    'conditions' => array('to.id = message.to_id')
                ), array(
                    'table' => 'users',
                    'alias' => 'from',
                    'type' => 'LEFT',
                    'conditions' => array('from.id = message.from_id')
                ),
            ),
            'conditions' => array('OR' => array('to_id' => $id, 'from_id' => $id)),
            'order' => array('created' => 'desc'),
            'group' => array('to.id', 'from.id')
            
        ];
        
        return $this->find('all', $options);
    }

}
