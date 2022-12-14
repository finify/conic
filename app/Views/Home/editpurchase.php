<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>
<?php
$Purchase = $this->Purchase[0];

$property_name = $Purchase->property_name;
$client_id = $Purchase->client_id;
$purchase_id = $Purchase->id;
$property_amount = $Purchase->property_amount;
$property_quantity = $Purchase->quantity;
$first_payment = $Purchase->first_payment;
$amount_paid = $Purchase->amount_paid;
$amount_due = $Purchase->amount_due;
$plot_number = $Purchase->plot_number;
$allocation_number = $Purchase->allocation_number;
$duration = $Purchase->duration;
$duration_dates = $Purchase->duration_dates;
$datecreated = $Purchase->datecreated;
$dateending = $Purchase->dateending;
$purchase_status = $Purchase->purchase_status;

$amount_due_monthly = ($property_amount - $first_payment) / $duration;

if($purchase_status == 0){
    $status = "<span class='badge bg-label-primary me-1'>Active</span>";
}elseif($purchase_status == 1){
    $status = "<span class='badge bg-label-success me-1'>Completed</span>";
}

?>
<?php
$Client = $this->client[0];

$client_first_name = $Client->first_name;
$client_last_name = $Client->last_name;

?>
<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Purchase /</span> <?= $client_first_name?>  <?= $client_last_name?></h4>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <?php 
                        if($purchase_status == 0){ ?>
                            <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal"
                        >
                          Make Payment <i class="bx bx-wallet me-1"></i>
                        </button>
                        <?php
                        } ?>
                        

                        <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Make payment</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="<?=PROOT?>purchase/makepayment/<?=$client_id?> ">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Amount</label>
                                    <input type="number" name="amount" id="nameBasic" required class="form-control" placeholder="Enter amount" />
                                  </div>
                                  <input type="hidden" name="purchase_id" value="<?= $purchase_id?>">
                                  <input type="hidden" name="amount_due" value="<?= $amount_due?>">
                                  <input type="hidden" name="amount_paid" value="<?= $amount_paid?>">
                                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Pay</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </li>
                </ul>
                <div class="card mb-4">
                <?php
                if(isset($data['insertedstatus'])){
                    if($data['insertedstatus'] === true){
                        echo "
                        <div class='alert alert-success alert-dismissible' role='alert'>
                            Payments Successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }else{
                        echo "
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                        Payment not made
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                
                }
                ?>

<?php
                if(isset($data['updatedstatus'])){
                    if($data['updatedstatus'] === true){
                        echo "
                        <div class='alert alert-success alert-dismissible' role='alert'>
                            Purchase updated successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }else{
                        echo "
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                        Purchase not updated
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                
                }
                ?>
                    <h5 class="card-header">Property Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <h1 class="display-5 mb-0"><?=$property_name?></h1> </br>
                            <h4> <?=$status?></h4>
                            <button
                          type="button"
                          style="width:200px"
                          class="btn btn-primary"
                          onclick="window.print()"
                        >
                          Print page <i class="bx bx-printer me-1"></i>
                        </button>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="card-header">Purchase Details</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>Value</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Property amount</strong></td>
                                    <td>???<?= number_format($property_amount)?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Quantity</strong></td>
                                    <td><?=$property_quantity?> Plot/s</td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>First payment</strong></td>
                                    <td>???<?= number_format($first_payment) ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Amount paid</strong></td>
                                    <td>???<?= number_format($amount_paid) ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Amount due</strong></td>
                                    <td>???<?= number_format($amount_due) ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Duration</strong></td>
                                    <td><?=$duration?> Months</td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Amount due monthly</strong></td>
                                    <td>???<?= number_format($amount_due_monthly)?> </td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Date created</strong></td>
                                    <td><?= $datecreated?> </td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Payment dates</strong></td>
                                    <td><?= ltrim($duration_dates, ',')?> </td>
                                </tr>
                                <!-- <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Propert</strong></td>
                                    <td>2,000,000</td>
                                </tr> -->
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card mb-4">
                    <h5 class="card-header">Edit Purchase details</h5>
                    
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings" action="<?=PROOT?>purchase/updatepurchase/<?=$purchase_id?>" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Plot number</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="plot_number"
                              value="<?=$plot_number?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Allocation number</label>
                            <input class="form-control" type="text" name="allocation_number" id="lastName" value="<?=$allocation_number?>" />
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
                    <h5 class="card-header">Payments history</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td> <strong>???<?= number_format($first_payment)?></strong></td>
                                <td><?= $datecreated?></td>
                            </tr>
                            <?php
                            $payments = $this->payments;
                            if(!empty($payments)){
                                foreach($payments as $payment){
                                    $amount = number_format($payment->amount);
                                    echo "<tr>
                                            <td>??? $amount </td>
                                            <td>$payment->datecreated </td>
                                        </tr>";
                                }
                            }else{
                                echo "";
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