
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Appointment")); ?> | <?php echo e(__("message.Admin")); ?> <?php echo e(__("message.Appointment")); ?>

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
                  <h4 class="mb-0"><?php echo e(__("message.Appointment")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?php echo e(__("message.Appointment")); ?></li>
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
                     <h4 class="card-title"><?php echo e(__("message.Appointment")); ?> <?php echo e(__("message.List")); ?></h4>
                     <table id="appointmenttable" class="table table-bordered dt-responsive tablels">
                        <thead>
                           <tr>
                              <th><?php echo e(__("message.Id")); ?></th>
                              <th><?php echo e(__("message.Doctor Name")); ?></th>
                              <th><?php echo e(__("message.Patient Name")); ?></th>
                              <th><?php echo e(__("message.DateTime")); ?></th>
                              <th><?php echo e(__("message.Phone")); ?></th>
                              <th><?php echo e(__("message.User Description")); ?></th>
                              <th><?php echo e(__("message.Status")); ?></th>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\local-guide-backend\resources\views/admin/appointment/default.blade.php ENDPATH**/ ?>