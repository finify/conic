<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>
<?php
$Client = $this->client[0];

$client_first_name = $Client->first_name;
$client_last_name = $Client->last_name;
$client_email = $Client->email;
$client_phone_number = $Client->phone_number;
$client_id = $Client->id;

?>
<?php $this->start('body');?>
    <div id="full-page" class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Client /</span> <?=$client_first_name?></h4>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                    <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal"
                        >
                          Purchase Property <i class="bx bx-wallet me-1"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Purchase Property</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="<?=PROOT?>client/purchaseproperty/<?=$client_id?>">
                                <div class="row">
                                  <div class="col-12 mb-3">
                                    <label class="form-label" for="basic-default-company">Select Property</label>
                                    <select name="property" required id="basic-default-company" class="form-select form-select">
                                    <?php
                                    $Properties = $this->Properties;
                                    if(!empty($Properties)){
                                        foreach($Properties as $Property){
                                            echo "<option value='$Property->id'>$Property->property_name</option>";
                                        }
                                    }else{
                                        echo "<option value=''>No property available</option>";
                                    }
                                    
                                ?>
                                    </select>
                                  </div>
                                  <div class="col-12 mb-3">
                                    <label for="organization" class="form-label">Quantity</label>
                                    <input
                                    type="number"
                                    required
                                    class="form-control"
                                    id="organization"
                                    name="quantity"
                                    />
                                  </div>
                                  <div class="col-12 mb-3">
                                    <label for="organization" class="form-label">first payment</label>
                                    <input
                                    type="number"
                                    required
                                    class="form-control"
                                    id="organization"
                                    name="first_payment"
                                    />
                                  </div>
                                  <div class="col-12 mb-3">
                                    <label for="organization" class="form-label">Duration(in months)</label>
                                    <input
                                    type="number"
                                    required
                                    class="form-control"
                                    id="organization"
                                    name="duration"
                                    />
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Purchase</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </li>
                </ul>
                <?php
            if(isset($data['updatedstatus'])){
                if($data['updatedstatus'] === true){
                    echo "
                    <div class='alert alert-success alert-dismissible' role='alert'>
                        Client Update Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Client Could not Update
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
               
            }
            ?>
            <?php
            if(isset($data['insertedstatus'])){
                if($data['insertedstatus'] === true){
                    echo "
                    <div class='alert alert-success alert-dismissible' role='alert'>
                        Property Purchased Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Property Could not Purchase
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
               
            }
            ?>

            
                <div class="card mb-4">
                    <h5 class="card-header">Edit Client Details</h5>
                    <button
                          type="button"
                          style="width:200px"
                          class="btn btn-primary"
                          onclick="window.print()"
                        >
                          Print page <i class="bx bx-printer me-1"></i>
                        </button>

                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings" action="<?=PROOT?>client/updateclient/<?=$client_id?>" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="first_name"
                              value="<?=$client_first_name?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="lastName" value="<?=$client_last_name?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="email"
                              id="email"
                              name="email"
                              value="<?=$client_email?>"
                              placeholder="john.doe@example.com"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Phone number</label>
                            <input
                              type="number"
                              class="form-control"
                              id="organization"
                              name="phone_number"
                              value="<?=$client_phone_number?>"
                            />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          
                        </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">All Properties purchase</h5>
                    <div class="table-responsive text-nowrap">
                        <table id="homeTable" class="table table-dark">
                        <thead>
                            <tr>
                            <th>Property</th>
                            <th>Amount Due</th>
                            <th>Amount paid</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php
                            $ClientPurchases = $this->ClientPurchases;
                            if(!empty($ClientPurchases)){
                                foreach($ClientPurchases as $ClientPurchase){
                                    if($ClientPurchase->purchase_status == 0){
                                        $status = "<span class='badge bg-label-primary me-1'>Active</span>";
                                    }elseif($ClientPurchase->purchase_status == 1){
                                        $status = "<span class='badge bg-label-success me-1'>Completed</span>";
                                    }
                                    $amount_due = number_format($ClientPurchase->amount_due);
                                    $amount_paid = number_format($ClientPurchase->amount_paid);
                                    echo "<tr>
                                            <td>$ClientPurchase->property_name </td>
                                            <td>₦$amount_due </td>
                                            <td>₦$amount_paid </td>
                                            <td>$status </td>
                                            <td>
                                                <div class='dropdown'>
                                                <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                    <i class='bx bx-dots-vertical-rounded'></i>
                                                </button>
                                                <div class='dropdown-menu'>
                                                    <a class='dropdown-item' href='".PROOT."purchase/editpurchase/$ClientPurchase->id'
                                                    ><i class='bx bx-edit-alt me-1'></i> Edit Purchase</a
                                                    >
                                                    <a class='dropdown-item' href='".PROOT."property/deleteproperty/$Property->id'
                                                    ><i class='bx bx-trash me-1'></i> Delete</a
                                                    >
                                                </div>
                                                </div>
                                            </td>
                                        </tr>";
                                }
                            }else{
                                echo "
                                <div class='alert alert-danger alert-dismissible' role='alert'>
                                    No Property Purchased yet
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                            
                        ?>
                            
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->end();?>