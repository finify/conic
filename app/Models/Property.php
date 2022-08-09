<?php

namespace App\Models;

class Property extends \Model
{
    public $table_name = 'properties';
    
    public function __construct($user = ''){
        $table = 'properties';
        parent::__construct($table);
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getProperty($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getProperties(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getPropertiescount(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function deleteProperty($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updateProperty($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}