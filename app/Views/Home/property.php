<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <?php
                if(isset($data['insertedstatus'])){
                    if($data['insertedstatus'] === true){
                        echo "
                        <div class='alert alert-success alert-dismissible' role='alert'>
                            Property Uploaded Successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }else{
                        echo "
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                            Property Could not upload
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                
                }
                ?>

                <?php
                if(isset($data['deletedstatus'])){
                    if($data['deletedstatus'] === true){
                        echo "
                        <div class='alert alert-success alert-dismissible' role='alert'>
                            Property Deleted Successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }else{
                        echo "
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                            Property Could not Delete
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add New Property</h5>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="<?=PROOT?>property/index">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Property Name</label>
                            <input type="text" required name="property_name" class="form-control" id="basic-default-fullname" placeholder="Enter Property name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Property Price</label>
                            <input type="number" required name="amount" class="form-control" id="basic-default-fullname" placeholder="Enter Property price" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Property description</label>
                            <input type="text" required name="description" class="form-control" id="basic-default-fullname" placeholder="Description" />
                        </div>
                        <!-- <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Position</label>
                            <select name="position" required id="basic-default-company" class="form-select form-select">
                                <option>Select</option>
                                <option value="1">President</option>
                                <option value="2">Vice President</option>
                                <option value="3">Gen Secretary</option>
                                <option value="4">Treasurer</option>
                                <option value="5">Cultural Secretary</option>
                                <option value="6">Sports Secretary</option>
                                <option value="7">Public Relation Secretary</option>
                                <option value="8">Trustee</option>
                                <option value="9">Women Affairs Secretary ( Lady Member)</option>
                            </select>
                        </div> -->
                        <button name="submit" type="submit" class="btn btn-primary">Add Property</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Dark Table -->
        <div class="card">
            <h5 class="card-header">All Properties</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-dark">
                <thead>
                    <tr>
                    <th>Property name</th>
                    <th>Amount</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <?php
                    $Properties = $this->Properties;
                    if(!empty($Properties)){
                        foreach($Properties as $Property){
                            echo "<tr>
                                    <td>$Property->property_name </td>
                                    <td>$Property->amount</td>
                                    <td>
                                        <div class='dropdown'>
                                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </button>
                                        <div class='dropdown-menu'>
                                            <a class='dropdown-item' href='".PROOT."property/editproperty/$Property->id'
                                            ><i class='bx bx-edit-alt me-1'></i> Edit</a
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
                            No Property Uploaded
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