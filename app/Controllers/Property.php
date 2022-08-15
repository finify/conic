<?php 

namespace App\Controllers;

use Session;

class Property extends \Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->load_model('Property');
    }

    public function indexAction(){
        $data = [];
        if($_POST){
            $property_name = $_POST['property_name'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $datecreated = date("d/m/Y");
            
            $fields = [
                'property_name' => $property_name,
                'amount' => $amount,
                'description' => $description,
                'datecreated' => $datecreated 
            ];

            $inserted = $this->PropertyModel->insertRows($fields);


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
        $Properties = $this->PropertyModel->getProperties();
        $this->view->Properties = $Properties;
        $this->view->render('home/property',$data);
    }

    public function editpropertyAction($param,$data = null){
        $param = intval($param);
        $Property = $this->PropertyModel->getProperty($param);

        $this->view->Property = $Property;
        $this->view->render('home/editproperty',$data);
    }

    public function updatepropertyAction($param){
        $param = intval($param);

        $data = [];
        if($_POST){
            $property_name = $_POST['property_name'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            
            $fields = [
                'property_name' => $property_name,
                'amount' => $amount,
                'description' => $description
            ];

            $updated = $this->PropertyModel->updateProperty($fields,$param);


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
        $this->editpropertyAction($param,$data);
    }

    public function deletepropertyAction($param){
        $data = [];
         $params = intval($param);
         $deleted = $this->PropertyModel->deleteProperty($params);
         if($deleted){
            $data = [
                'deletedstatus'=> true
            ];
        }else{
            $data = [
                'deletedstatus'=> false
            ];
        }
        $Properties = $this->PropertyModel->getProperties();
        $this->view->Properties = $Properties;
        $this->view->render('home/property',$data);
    }
}