<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12">
                <h6 class="text-muted">Notification Center</h6>
                <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-home"
                        aria-controls="navs-justified-home"
                        aria-selected="true"
                    >
                        <i class="tf-icons bx bx-wallet-alt"></i> Transaction 
                        <!-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span> -->
                    </button>
                    </li>
                    <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-profile"
                        aria-controls="navs-justified-profile"
                        aria-selected="false"
                    >
                        <i class="tf-icons bx bxs-bell-ring"></i> Reminders
                    </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                        <ul class="p-0 m-0">
                        <?php
                            $Notifications = $this->Notifications;
                            foreach($Notifications as $notification){
                                if($notification->notification_type == "transaction"){
                                    echo '
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-primary"
                                            ><i class="bx bxs-left-down-arrow-circle"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                            <h6 class="mb-0">'.$notification->client_name.'</h6>
                                            <small class="text-muted">'.$notification->description.'</small>
                                            </div>
                                            <div class="user-progress">
                                            <small class="fw-semibold">'.$notification->datecreated.'</small>
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                    ';
                                }
                            }
                        ?>
                            
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                        <ul class="p-0 m-0">
                        <?php
                            $Notifications = $this->Notifications;
                            foreach($Notifications as $notification){
                                if($notification->notification_type == "reminder"){
                                    echo '
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-primary"
                                            ><i class="bx bxs-bell-ring"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                            <h6 class="mb-0">'.$notification->client_name.'</h6>
                                            <small class="text-muted">'.$notification->description.'</small>
                                            </div>
                                            <div class="user-progress">
                                            <small class="fw-semibold">'.$notification->datecreated.'</small>
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                    ';
                                }
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->end();?>