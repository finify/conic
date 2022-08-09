<?php 

namespace App\Controllers;

use Session;

class Cron extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Clients');
        $this->load_model('Purchase');
        $this->load_model('Payment');
        $this->load_model('Notification');
    }

    public function indexAction(){
        $Purchases = $this->PurchaseModel->getPurchases();
        $todaydate = date("d-m-Y");
        $currentdate    = strtotime($todaydate);

        $d=strtotime("-1 Week",strtotime($todaydate));
        $lesstodaydate = date('d-m-Y', $d);
        $lesstodaydate1    = strtotime($lesstodaydate);


        $notification_type = "reminder";
        foreach($Purchases as $purchase){
            $client_id = $purchase->client_id;
            $property_id = $purchase->property_id;
            $property_name = $purchase->property_name;
            $property_amount = $purchase->property_amount;
            $return_dates = $purchase->duration_dates;

            $description = "Reminder of your monthly payment for $property_name due in one week time";
            $description1 = "Reminder of your monthly payment for $property_name";

            $remind_dates = explode (",", $return_dates);

            foreach ($remind_dates as $dates) { 
                if($dates != ""){
                    
                    $dates1  = strtotime($dates);

                    $d=strtotime("-1 Week",strtotime($dates));
                    $lessdate = date('d-m-Y', $d);
                    $lessdate1    = strtotime($lessdate);

                    
                    $Notification = $this->NotificationModel->getNotificationBydate($lessdate,$client_id);

                    if(!$Notification){ //if nofication is not found in db
                        //add to notification


                        $fields = [
                            'client_id' => $client_id,
                            'notification_type' => $notification_type,
                            'description' => $description,
                            'seen' => 0,
                            'datecreated' => $lessdate 
                        ];

                        
                        if($currentdate === $lessdate1){
                            $this->NotificationModel->insertRows($fields);

                            //email admin
                        }
                        

                        
                        
                    }

                    $Notification1 = $this->NotificationModel->getNotificationBydate($dates,$client_id);

                    if(!$Notification1){
                        //add to notification
                        $fields = [
                            'client_id' => $client_id,
                            'notification_type' => $notification_type,
                            'description' => $description1,
                            'seen' => 0,
                            'datecreated' => $dates 
                        ];

                        // dnd($currentdate."/".$dates1);
                        if($currentdate === $dates1){
                            $this->NotificationModel->insertRows($fields);
                        }

                        

                        //email admin
                        
                    }
                    // echo "real" .$dates ."</br>";
                }
            }
        }
    }


    
}