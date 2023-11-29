<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Save Subscription")); ?> | <?php echo e(__("message.Admin")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0"><?php echo e(__("message.View Subscription")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('admin/subscriber_doc')); ?>"><?php echo e(__("message.Subscription")); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__("message.View Subscription")); ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-8">
               <div class="card">
                  <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Doctor Name")); ?></b></label> <?php echo e(isset($data)?$data->doctor_id:''); ?>

                                </div>
                            </div>
                             <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Payment Type")); ?></b></label> 
                                   <?php
                                        if(isset($data->payment_type) && $data->payment_type==1){
                                            echo __("message.Braintree");           
                                        }
                                         if(isset($data->payment_type) && $data->payment_type==2){
                                            echo __("message.Bank Deposit");           
                                        }
                                   ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Amount")); ?></b></label>
                                    <?php echo e(isset($data)?$data->amount:''); ?>

                                </div>
                            </div>
                             <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.TransactionID")); ?></b></label> 
                                   <?php echo e(isset($data)?$data->transaction_id:''); ?>

                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Subscription Plan")); ?></b></label>
                                   
                                    <?php
                                        if(isset($data->subscription_id)){
                                            echo $data->subscription_id." ".__("message.Month");           
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                             <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Status")); ?></b></label> 
                                   <?php
                                        if(isset($data->status) && $data->status==1)
                                        {
                                            echo __("message.Not Active");           
                                        }
                                        if(isset($data->status) && $data->status==2)
                                        {
                                            echo __("message.Active");           
                                        }
                                        if(isset($data->status) && $data->status==3)
                                        {
                                            echo __("message.Expired");           
                                        }
                                         if(isset($data->status) && $data->status==4)
                                        {
                                            echo "Reject";           
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Date")); ?></b></label>
                                   
                                    <?php
                                        if(isset($data->date)){
                                            echo $data->date;           
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Description")); ?></b></label> 
                                   <?php
                                        if(isset($data->description))
                                        {
                                            echo $data->description;           
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                   <label for="formrow-firstname-input"><b><?php echo e(__("message.Receipt File")); ?></b></label> 
                                   <?php
                                        if(isset($data->deposit_image))
                                        {
                                            $folderName = '/upload/bank_receipt/';
                                            $destinationPath = asset("public/upload/bank_receipt").'/'.$data->deposit_image;
                                           ?>
                                            <!--<img src="<?= $destinationPath ?>"  height="300" width="600">-->
                                            <a href="<?php echo $destinationPath; ?>"  target="_blank">Show Receipt</a>
                                           <?php
                                        }else{
                                            echo "-";
                                        }
                                   ?>
                                   
                                </div>
                            </div>
                            
                        </div>    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/subscription/view_subscriber.blade.php ENDPATH**/ ?>