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
    
    
    
    public function getConversation($id){
        return $this->query('SELECT * 
                FROM `cake_msg`.`messages` AS `message`
                WHERE (`message`.`to_id` = 20 AND `message`.`from_id` = 2)
                OR (`message`.`to_id` = 2 AND `message`.`from_id` = 20)
                ORDER BY `message`.`created` DESC');
    } 
    
    public function getMessageList($id) {
        $safe_id = Sanitize::escape($id);
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
                    WHERE `message`.`to_id` = ".$safe_id."
                    OR `message`.`from_id` = ".$safe_id."
                    GROUP BY 
                            (CASE
                                WHEN `message`.`to_id` = ".$safe_id." THEN `message`.`from_id`
                                WHEN `message`.`from_id` = ".$safe_id." THEN `message`.`to_id`
                            END)) AS `max_id`
                INNER JOIN `cake_msg`.`messages` 
                ON `max_id`.`id` = `messages`.`id`) AS `latest_chat`
            LEFT JOIN `cake_msg`.`users` AS `chat_mate`
            ON 
            (CASE 
                 WHEN `latest_chat`.`to_id` = ".$safe_id." THEN `chat_mate`.`id` = `latest_chat`.`from_id`
                 WHEN `latest_chat`.`from_id` = ".$safe_id." THEN `chat_mate`.`id` = `latest_chat`.`to_id`
             END) ");
            
    }

}
