<?php 

namespace App\Controllers;

use Session;

class Notification extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Clients');
    }

    public function indexAction(){
        $this->view->render('home/notification');
    }
}