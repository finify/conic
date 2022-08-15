<?php 

namespace App\Controllers;

use Session;

class Purchase extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Clients');
        $this->load_model('Purchase');
        $this->load_model('Payment');
    }

    public function indexAction(){
        $this->view->render('home/property');
    }


    public function editpurchaseAction($param,$data = null){
        $param = intval($param);
        $Purchase = $this->PurchaseModel->getPurchaseById($param);

        
        $client = $this->ClientsModel->getClient($Purchase[0]->client_id);

        $this->view->client = $client; //get client data
        $this->view->Purchase = $Purchase;

        $fields = [
            'conditions'=>  ['client_id = ?' , 'purchase_id= ?'],
            'bind' => [$Purchase[0]->client_id,$param]
        ];

        $payments = $this->PaymentModel->readPayments($fields);

        $this->view->payments = $payments; //get client data

        $this->view->render('home/editpurchase',$data);
    }

    public function makepaymentAction($param){
        $data = [];
        if($_POST){
            $amount = $_POST['amount'];
            $purchase_id = $_POST['purchase_id'];
            $amount_due = $_POST['amount_due'];
            $amount_paid = $_POST['amount_paid'];
            $datecreated = date("d-m-Y");
            
            $fields = [
                'amount' => $amount,
                'purchase_id' => $purchase_id,
                'client_id' => $param,
                'datecreated' => $datecreated 
            ];

            if($amount_due >= $amount){
                $newamount_paid = $amount_paid + $amount;
                $newamount_due = $amount_due - $amount;

                $fields1 = [
                    'amount_paid' => $newamount_paid,
                    'amount_due' => $newamount_due
                ];
                $updated = $this->PurchaseModel->updatePurchase($fields1,$purchase_id);

                $purchase = $this->PurchaseModel->getPurchaseById($purchase_id);

                $purchase = $purchase[0];
                if($purchase->amount_paid == $purchase->property_amount){
                    $fields2 = [
                        'purchase_status' => 1
                    ];
                    $updated2 = $this->PurchaseModel->updatePurchase($fields2,$purchase_id);
                }

                $inserted = $this->PaymentModel->insertRows($fields);


                if($inserted && $updated){
                    $data = [
                        'insertedstatus'=> true
                    ];
                }else{
                    $data = [
                        'insertedstatus'=> false
                    ];
                }


            }
        }

        $this->editpurchaseAction($purchase_id,$data);
    }


    public function updatepurchaseAction($param){
        $param = intval($param);

        $data = [];
        if($_POST){
            $plot_number = $_POST['plot_number'];
            $allocation_number = $_POST['allocation_number'];
            $fields = [
                'plot_number' => $plot_number,
                'allocation_number' => $allocation_number
            ];

            $updated = $this->PurchaseModel->updatePurchase($fields,$param);


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
        $this->editpurchaseAction($param,$data);
    }
}