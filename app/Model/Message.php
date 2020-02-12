<?php
App::uses('Sanitize', 'Utility');

class Message extends AppModel {
    // /public $belongsTo = 'User';
    // public $belongsTo = array(
    //     'User' => array(
    //         'className' => 'User',
    //         'foreignKey' => 'to_id',
    //     )
    // );
    
    public function getMessage($id){
        return $this->find('first', array(
            'conditions' => array('id' => $id)
        ));
    }
    
    public function deleteConvo($user, $someOne) {
       return $this->query("DELETE FROM `messages` where (`to_id` = $user AND `from_id` = $someOne) OR (`to_id` = $someOne AND `from_id` = $user)");  
    }
    
    public function paginateConvo($user, $chatMate, $offset = 0, $count = 10){
        return $this->query("SELECT * 
        FROM `cake_msg`.`messages` AS `message`
        WHERE (`message`.`to_id` = '$user' AND `message`.`from_id` = '$chatMate')
        OR (`message`.`to_id` = '$chatMate' AND `message`.`from_id` = '$user')
        ORDER BY `message`.`created` DESC
        LIMIT $offset, $count");
    } 

    public function paginateMessageList($user, $offset = 0, $count = 5) {
        $safe_id = Sanitize::escape($user);
        return $this->query("SELECT 
                `latest_chat`.`id`, 
                `latest_chat`.`to_id`, 
                `latest_chat`.`from_id`, 
                `latest_chat`.`content`, 
                `latest_chat`.`created`, 
                `chat_mate`.`id`,
                `chat_mate`.`name`, 
                `chat_mate`.`image`
            FROM
                (SELECT `messages`.* FROM
                    (SELECT MAX(`message`.`id`) AS `id`
                    FROM `cake_msg`.`messages` AS `message`
                    WHERE `message`.`to_id` = $safe_id
                    OR `message`.`from_id` = $safe_id
                    GROUP BY 
                            (CASE
                                WHEN `message`.`to_id` = $safe_id THEN `message`.`from_id`
                                WHEN `message`.`from_id` = $safe_id THEN `message`.`to_id`
                            END)) AS `max_id`
                INNER JOIN `cake_msg`.`messages` 
                ON `max_id`.`id` = `messages`.`id`) AS `latest_chat`
            LEFT JOIN `cake_msg`.`users` AS `chat_mate`
            ON 
                (CASE 
                    WHEN `latest_chat`.`to_id` = $safe_id THEN `chat_mate`.`id` = `latest_chat`.`from_id`
                    WHEN `latest_chat`.`from_id` = $safe_id THEN `chat_mate`.`id` = `latest_chat`.`to_id`
                END) 
            ORDER BY `latest_chat`.`id` DESC
            LIMIT $offset, $count");
            
    }
    
    
    // public function getConvo($user, $chatMate){
    //     return $this->query("SELECT * 
    //         FROM `cake_msg`.`messages` AS `message`
    //         WHERE (`message`.`to_id` = '$user' AND `message`.`from_id` = '$chatMate')
    //         OR (`message`.`to_id` = '$chatMate' AND `message`.`from_id` = '$user')
    //         ORDER BY `message`.`created` DESC");
    // } 
    
    // public function getMessageList($id) {
    //     $safe_id = Sanitize::escape($id);
    //     return $this->query("SELECT 
    //             `latest_chat`.`id`, 
    //             `latest_chat`.`to_id`, 
    //             `latest_chat`.`from_id`, 
    //             `latest_chat`.`content`, 
    //             `latest_chat`.`created`, 
    //             `chat_mate`.`id`,
    //             `chat_mate`.`name`, 
    //             `chat_mate`.`image`
    //         FROM
    //             (SELECT `messages`.* FROM
    //                 (SELECT MAX(`message`.`id`) AS `id`
    //                 FROM `cake_msg`.`messages` AS `message`
    //                 WHERE `message`.`to_id` = $safe_id
    //                 OR `message`.`from_id` = $safe_id
    //                 GROUP BY 
    //                         (CASE
    //                             WHEN `message`.`to_id` = $safe_id THEN `message`.`from_id`
    //                             WHEN `message`.`from_id` = $safe_id THEN `message`.`to_id`
    //                         END)) AS `max_id`
    //             INNER JOIN `cake_msg`.`messages` 
    //             ON `max_id`.`id` = `messages`.`id`) AS `latest_chat`
    //         LEFT JOIN `cake_msg`.`users` AS `chat_mate`
    //         ON 
    //             (CASE 
    //                 WHEN `latest_chat`.`to_id` = $safe_id THEN `chat_mate`.`id` = `latest_chat`.`from_id`
    //                 WHEN `latest_chat`.`from_id` = $safe_id THEN `chat_mate`.`id` = `latest_chat`.`to_id`
    //             END) 
    //         ORDER BY `latest_chat`.`created` DESC");
            
    // }

}
