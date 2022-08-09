<?php

namespace App\Models;

class Notification extends \Model
{
    public $table_name = 'notifications';
    
    public function __construct($user = ''){
        $table = 'notifications';
        parent::__construct($table);
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getNotification($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE client_id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getNotificationBydate($date,$client_id){
        $sql = "SELECT * FROM {$this->table_name} WHERE datecreated='{$date}' AND client_id={$client_id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
        return false;
    }

    public function getNotifications(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getNotificationsWithUser(){
        $sql = "SELECT {$this->table_name}.id, {$this->table_name}.property_name,{$this->table_name}.property_amount,{$this->table_name}.amount_paid,{$this->table_name}.amount_due, {$this->table_name}.Notification_status,clients.first_name,clients.last_name FROM {$this->table_name} LEFT JOIN clients ON {$this->table_name}.client_id = clients.id order by {$this->table_name}.id desc";
        // dnd($sql);
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function deleteNotification($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updateNotification($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}