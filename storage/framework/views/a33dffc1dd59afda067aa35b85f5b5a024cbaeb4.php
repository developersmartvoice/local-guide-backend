<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Subscription List")); ?>

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
                  <h4 class="mb-0"><?php echo e(__("message.Subscription List")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?php echo e(__("message.Subscription List")); ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <?php if(Session::has('message')): ?>
                     <div class="col-sm-12">
                        <div class="alert  <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert"><?php echo e(Session::get('message')); ?>

                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                     </div>
                     <?php endif; ?>
                     <h4 class="card-title"><?php echo e(__("message.Subscription List")); ?> </h4>
                     
                     <table id="subscriber_doc" class="table table-bordered dt-responsive tablels">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th><?php echo e(__("message.Doctor Name")); ?></th>
                              <th><?php echo e(__("message.Payment Type")); ?></th>
                              <th><?php echo e(__("message.Amount")); ?></th>
                              <!-- <th>TransactionID</th>
                              <th>Description</th>
                              <th>subscription Plan</th>-->
                              <th><?php echo e(__("message.Status")); ?></th>
                              <!--<th>Date</th>-->
                              <th><?php echo e(__("message.Receipt File")); ?></th>
                              <th><?php echo e(__("message.Action")); ?></th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script>
      function active_order(record_id,status)
      {
        var x = confirm("Are you sure active this subscription");
        if(x){
             $.ajax({
              url: '<?php echo e(route("active-order")); ?>',
              method: "POST",
              data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "record_id": record_id,
                "status":status
              },
              success: function (data) 
              {
                window.location.reload();
              }
          }); 
        }
      } 
         

  function disable_order(record_id,status)
  {
    var x = confirm("Are you sure disable this subscription");
    if(x){
      $.ajax({
        url: '<?php echo e(route("disable-order")); ?>',
        method: "POST",
        data: {
          "_token": "<?php echo e(csrf_token()); ?>",
          "record_id": record_id,
          "status":status
        },
        success: function (data) 
        {
          window.location.reload();
        }
    }); 
    }  
  } 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubnzxmjc/localguide/resources/views/admin/subscription/subscriber_doc.blade.php ENDPATH**/ ?>