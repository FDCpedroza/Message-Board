<?php
App::uses('Sanitize', 'Utility');

class Message extends AppModel {
    
    public function getSpecficMessage($to, $from, $msg) {
        return $this->find(
            'first',
            array(
                'conditions' => array(
                    'to_id' => $to,
                    'from_id' => $from,
                    'content LIKE' => $msg
                )
            )
        );
    }
    
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
    
    
    public function findWord($searchWord, $user){
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
    
                (SELECT `messages`.* 
                FROM 
                    (SELECT `id_table`.`id` FROM
                    (SELECT `m_table`.`id`,
                        `m_table`.`to_id`,
                        `m_table`.`from_id`,
                        `m_table`.`content`,
                        `m_table`.`created`,
                        `u_table`.`name`
                        FROM 
                            (SELECT * 
                            FROM `messages` 
                            WHERE `to_id` = $user
                            OR `from_id` = $user) AS `m_table`
                        INNER JOIN `cake_msg`.`users` AS `u_table`
                        ON (CASE
                                WHEN `m_table`.`to_id` = $user THEN `m_table`.`from_id` = `u_table`.`id`
                                WHEN `m_table`.`from_id` = $user THEN `m_table`.`to_id` = `u_table`.`id`
                            END)) AS `id_table`
                    WHERE
                        `id_table`.`content` LIKE '%$searchWord%'
                    OR
                        `id_table`.`name` LIKE '%$searchWord%') as `id_t`
                INNER JOIN `cake_msg`.`messages` 
                ON `id_t`.`id` =  `messages`.`id`) AS `latest_chat`
            LEFT JOIN `cake_msg`.`users` AS `chat_mate`
            ON 
                (CASE 
                    WHEN `latest_chat`.`to_id` = $user THEN `chat_mate`.`id` = `latest_chat`.`from_id`
                    WHEN `latest_chat`.`from_id` = $user THEN `chat_mate`.`id` = `latest_chat`.`to_id`
                END) 
            ORDER BY `latest_chat`.`id` DESC
        ");
    }

}
