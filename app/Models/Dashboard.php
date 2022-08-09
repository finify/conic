<?php

namespace App\Models;

class Dashboard extends \Model
{
    public $table_name = 'purchases';
    
    public function __construct($user = ''){
        $table = 'purchases';
        parent::__construct($table);
    }

}