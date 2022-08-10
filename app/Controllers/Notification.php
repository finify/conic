<?php 

namespace App\Controllers;

use Session;

class Notification extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Notification');

    }

    public function indexAction(){

        $Notifications = $this->NotificationModel->getNotifications();

        $this->view->Notifications = $Notifications;
        $this->view->render('home/notification');
    }
}