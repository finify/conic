<?php 

namespace App\Controllers;

use Session;

class Client extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Clients');
        $this->load_model('Property');
        $this->load_model('Purchase');
    }

    public function indexAction(){
        $data = [];
        if($_POST){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $email =  $_POST['email'];
            $datecreated = date("d/m/Y");
            
            $fields = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone_number' => $phone_number,
                'email' => $email,
                'datecreated' => $datecreated 
            ];

            $inserted = $this->ClientsModel->insertRows($fields);


            if($inserted){
                $data = [
                    'insertedstatus'=> true
                ];
            }else{
                $data = [
                    'insertedstatus'=> false
                ];
            }
        
        }
        $clients = $this->ClientsModel->getClients();
        $this->view->clients = $clients;
        $this->view->render('home/client',$data);
    }

    
    public function deleteclientAction($params){
         $data = [];
         $params = intval($params);
         $deleted = $this->ClientsModel->deleteClient($params);
         if($deleted){
            $data = [
                'deletedstatus'=> true
            ];
        }else{
            $data = [
                'deletedstatus'=> false
            ];
        }
        $clients = $this->ClientsModel->getClients();
        $this->view->clients = $clients;
        $this->view->render('home/client',$data);
    }

    public function editclientAction($param,$data = null){
        $param = intval($param);
        $client = $this->ClientsModel->getClient($param);

        $this->view->client = $client; //get client data

        $Properties = $this->PropertyModel->getProperties();
        $this->view->Properties = $Properties; //get property data

        $ClientPurchases = $this->PurchaseModel->getPurchase($param);
        $this->view->ClientPurchases = $ClientPurchases; //get client properties

        $this->view->render('home/editclient',$data);
    }

    public function updateclientAction($param){
        $param = intval($param);

        $data = [];
        if($_POST){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $email =  $_POST['email'];
            
            $fields = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone_number' => $phone_number,
                'email' => $email
            ];

            $updated = $this->ClientsModel->updateClient($fields,$param);


            if($updated){
                $data = [
                    'updatedstatus'=> true
                ];
            }else{
                $data = [
                    'updatedstatus'=> false
                ];
            }
        
        }
        $this->editclientAction($param,$data);
    }

    public function purchasepropertyAction($param){
        $param = intval($param);

        $data = [];
        if($_POST){
            $property_id = $_POST['property'];
            $quantity = $_POST['quantity'];
            $first_payment = $_POST['first_payment'];
            $duration = $_POST['duration'];

            $Properties = $this->PropertyModel->getProperty($property_id);

            $property_name = $Properties[0]->property_name;
            $property_amount = $Properties[0]->amount;

            $datecreated =  date("d-m-Y");
            $d=strtotime('+'.$duration.' Months');
            $endingdate = date("d-m-Y", $d);

            $property_amount = $property_amount * $quantity;
            $amount_due = $property_amount - $first_payment;

            $duration1 = $duration - 1 ;
            $return_dates = "";
            for ($x = 1; $x <= $duration1; $x++) {
                $d=strtotime("+$x Months");
                $nextdate = date("d-m-Y", $d);
        
                $return_dates = $return_dates. ',' . $nextdate; 
            }
            
            $fields = [
                'client_id' => $param,
                'property_id' => $property_id,
                'property_name' => $property_name,
                'property_amount' => $property_amount,
                'quantity' => $quantity,
                'first_payment' => $first_payment,
                'amount_paid' => $first_payment,
                'amount_due' => $amount_due,
                'duration' => $duration,
                'duration_dates' => $return_dates,
                'datecreated' => $datecreated,
                'dateending' => $endingdate,
                'purchase_status' => 0
            ];

            $inserted = $this->PurchaseModel->insertRows($fields);

            if($inserted){
                $data = [
                    'insertedstatus'=> true
                ];
            }else{
                $data = [
                    'insertedstatus'=> false
                ];
            }
        
        }
        $this->editclientAction($param,$data);
    }

    
}