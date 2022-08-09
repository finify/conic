<?php

namespace App\Models;

class Payment extends \Model
{
    public $table_name = 'purchase_payments';
    
    public function __construct($user = ''){
        $table = 'purchase_payments';
        parent::__construct($table);
    }

    public function insertRows($fields) {
        return $this->_db->insert($this->table_name, $fields);
    }

    public function updateRows($fields, $col_name , $col_value) {
        
        return $this->_db->updateCol($this->table_name, $col_name, $col_value,$fields);
    }

    public function getPayment($id){
        $sql = "SELECT * FROM {$this->table_name} WHERE id= {$id} ";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function getPayments(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->results();
        }
    }

    public function readPayments($fields){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->find($this->table_name,$fields)){
            return $this->_db->results();
        }
    }

    public function getPaymentsCount(){
        $sql = "SELECT * FROM {$this->table_name} order by id desc";
        if($this->_db->query($sql)){
            return $this->_db->count();
        }
    }

    public function deletePayment($id){
        $deleted =  $this->_db->delete($this->table_name, $id);
        return $deleted;
    }


    public function updatePayment($fields, $id) {
        return $this->_db->update($this->table_name, $id ,$fields);
    }

}