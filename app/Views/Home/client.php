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
                        Client Uploaded Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Client Could not upload
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
                        Client Deleted Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Client Could not Delete
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
               
            }
            ?>
            
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add New Client</h5>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="<?= PROOT?>client">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">First Name</label>
                            <input type="text" required name="first_name" class="form-control" id="basic-default-fullname" placeholder="Enter full name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Last Name</label>
                            <input type="text" required name="last_name" class="form-control" id="basic-default-fullname" placeholder="Enter full name" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Phone number</label>
                            <input type="number" required name="phone_number" class="form-control" id="basic-default-fullname" placeholder="Enter Phone number" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="email" required name="email" class="form-control" id="basic-default-fullname" placeholder="Email" />
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
                        <button name="submit" type="submit" class="btn btn-primary">Add Client</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Dark Table -->
        <div class="card">
            <h5 class="card-header">All Clients</h5>
            <div class="table-responsive text-nowrap">
                <table id="homeTable" class="table table-dark">
                <thead>
                    <tr>
                    <th>Full name</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <?php
                    $Clients = $this->clients;
                    foreach($Clients as $client){
                        echo "<tr>
                                <td>$client->first_name $client->last_name</td>
                                <td>$client->phone_number</td>
                                <td>$client->email</td>
                                <td>
                                    <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item' href='".PROOT."client/editclient/$client->id'
                                        ><i class='bx bx-edit-alt me-1'></i> Edit</a
                                        >
                                        <a class='dropdown-item' href='".PROOT."client/deleteclient/$client->id'
                                        ><i class='bx bx-trash me-1'></i> Delete</a
                                        >
                                    </div>
                                    </div>
                                </td>
                              </tr>";
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>
        <!--/ Bootstrap Dark Table -->
    </div>

<?php $this->end();?>