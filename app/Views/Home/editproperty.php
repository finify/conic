<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>
<?php
$Property = $this->Property[0];

$property_name = $Property->property_name;
$property_amount = $Property->amount;
$property_description = $Property->description;
$property_id = $Property->id;

?>
<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
            <a href="<?=PROOT?>property">Properties</a>
         /</span><?=$property_name?></h4>
        <div class="row">
            <div class="col-md-12">
                
                <div class="card mb-4">
                    <h5 class="card-header">Edit Property Details</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings" action="<?=PROOT?>property/updateproperty/<?=$property_id?>" method="POST" >
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Property Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="property_name"
                              value="<?=$property_name?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Property price</label>
                            <input class="form-control" type="number" name="amount" id="lastName" value="<?=$property_amount?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?=$property_description?></textarea>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>


<?php $this->end();?>