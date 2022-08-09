<?php

namespace App\Models;

class Clients extends \Model
{
    public $table_name = 'clients';
    
    public function __construct($user = ''){
        $table = 'clients';
        parent::__construct($table);
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getClient($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getClients(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getClientsCount(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function deleteClient($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updateClient($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}