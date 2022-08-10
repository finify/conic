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
            $dateending = $purchase->dateending;

            $client = $this->ClientsModel->getClient($client_id);
            $client_first_name = $client[0]->first_name;
            $client_last_name = $client[0]->last_name;

            $client_name = "$client_first_name $client_last_name";

            $description = "Reminder of <b>$client_name</b>'s monthly payment for <b>$property_name</b> due in one week time";

            $description1 = "Reminder of <b>$client_name</b>'s monthly payment for <b>$property_name</b> due today";

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
                            'client_name' => $client_name,
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
                            'client_name' => $client_name,
                            'notification_type' => $notification_type,
                            'description' => $description1,
                            'seen' => 0,
                            'datecreated' => $dates 
                        ];

                        if($currentdate === $dates1){
                            $this->NotificationModel->insertRows($fields);
                        }

                        

                        //email admin
                        
                    }
                    // echo "real" .$dates ."</br>";
                }
            }

            //nofication for ending date
            $dateending = $purchase->dateending;

            $dateending1  = strtotime($dateending);

            $d=strtotime("-1 Week",strtotime($dateending));
            $lessdate = date('d-m-Y', $d);
            $lessdate1    = strtotime($lessdate);

            
            $Notification = $this->NotificationModel->getNotificationBydate($lessdate,$client_id);

            if(!$Notification){ //if nofication is not found in db
                //add to notification


                $fields = [
                    'client_id' => $client_id,
                    'client_name' => $client_name,
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

            $Notification1 = $this->NotificationModel->getNotificationBydate($dateending,$client_id);

            if(!$Notification1){
                //add to notification
                $fields = [
                    'client_id' => $client_id,
                    'client_name' => $client_name,
                    'notification_type' => $notification_type,
                    'description' => $description1,
                    'seen' => 0,
                    'datecreated' => $dates 
                ];

                if($currentdate === $dateending1){
                    $this->NotificationModel->insertRows($fields);
                }
            }

        }
    }


    
}