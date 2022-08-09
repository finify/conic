<?php 

namespace App\Controllers;

use Session;

class Home extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Clients');
        $this->load_model('Property');
        $this->load_model('Purchase');
    }

    public function indexAction($data = null){

        $clientscount = $this->ClientsModel->getClientsCount();
        $this->view->clientscount = $clientscount;

        $propertiescount = $this->PropertyModel->getPropertiescount();
        $this->view->propertiescount = $propertiescount;


        $Purchases = $this->PurchaseModel->getPurchasesWithUser();
        // dnd($Purchases);
        $this->view->Purchases = $Purchases;


        $this->view->render('home/index',$data);
        
    }

    public function deletepurchaseAction($params){
        $data = [];
        $params = intval($params);
        $deleted = $this->PurchaseModel->deletePurchase($params);
        if($deleted){
           $data = [
               'deletedstatus'=> true
           ];
       }else{
           $data = [
               'deletedstatus'=> false
           ];
       }
       $this->indexAction($data);
   }


}