<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome back Admin🎉</h5>
                        

                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                    </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img
                        src="<?=PROOT?>assets/img/illustrations/man-with-laptop-light.png"
                        height="140"
                        alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i style="font-size:30px;" class="tf-icons bx bx-spreadsheet"></i>
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt3"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="<?= PROOT?>property">View Properties</a>
                            </div>
                        </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">properties</span>
                        <h3 class="card-title mb-2"><?= $this->propertiescount?></h3>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i style="font-size:30px;" class="tf-icons bx bx-group"></i>
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn p-0"
                            type="button"
                            id="cardOpt6"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="<?= PROOT?>client">View clients</a>
                            </div>
                        </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Clients</span>
                        <h3 class="card-title text-nowrap mb-1"><?= $this->clientscount?> </h3>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Dark Table -->
        <div class="card">
        <?php
            if(isset($data['deletedstatus'])){
                if($data['deletedstatus'] === true){
                    echo "
                    <div class='alert alert-success alert-dismissible' role='alert'>
                        Purchase Deleted Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Purchase Could not Delete
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
               
            }
            ?>
            <h5 class="card-header">All Properties purchase</h5>
            <div class="table-responsive text-nowrap">
                <table id="homeTable" class="table table-dark">
                <thead>
                    <tr>
                    <th>Client name</th>
                    <th>Property</th>
                    <th>Amount Due</th>
                    <th>Amount paid</th>
                    <th>Status</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        $Purchases = $this->Purchases;
                        if(!empty($Purchases)){
                            foreach($Purchases as $Purchase){
                                if($Purchase->purchase_status == 0){
                                    $status = "<span class='badge bg-label-primary me-1'>Active</span>";
                                }elseif($Purchase->purchase_status == 1){
                                    $status = "<span class='badge bg-label-success me-1'>Completed</span>";
                                }
                                $amount_due = number_format($Purchase->amount_due);
                                $amount_paid = number_format($Purchase->amount_paid);
                                $onclick = "onclick=\"return confirm('Are you sure you want to Delete this purchase, please confirm');\"";
                                echo "<tr>
                                        <td>$Purchase->first_name  $Purchase->last_name</td>
                                        <td>$Purchase->property_name </td>
                                        <td>₦ $amount_due </td>
                                        <td>₦ $amount_paid </td>
                                        <td>$status </td>
                                        <td>
                                            <div class='dropdown'>
                                            <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <div class='dropdown-menu'>
                                                <a class='dropdown-item' href='".PROOT."purchase/editpurchase/$Purchase->id'
                                                ><i class='bx bx-edit-alt me-1'></i> Edit Purchase</a
                                                >
                                                <a $onclick class='dropdown-item' href='".PROOT."home/deletepurchase/$Purchase->id'
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
        <!--/ Bootstrap Dark Table -->
    </div>

<?php $this->end();?>