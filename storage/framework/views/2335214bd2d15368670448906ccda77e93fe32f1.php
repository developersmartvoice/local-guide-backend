
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Edit Notification Key")); ?> | <?php echo e(__("message.admin")); ?> 
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
                  <h4 class="mb-0"><?php echo e(__("message.Edit Notification Key")); ?> </h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?php echo e(__("message.Edit Notification Key")); ?> </li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-9">
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
                     <form action="<?php echo e(url('admin/updatenotificationkey')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>  
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Android Key")); ?></label>
                           <textarea class="form-control" row="5" required name="android_key" id="android_key" placeholder='<?php echo e(__("message.Enter Android Notification Key")); ?>' ><?php echo e($user->android_key); ?>

                           </textarea>
                        </div>
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Ios Key")); ?></label>
                           <textarea class="form-control" row="5" required name="ios_key" id="ios_key" placeholder="Enter Ios Notification Key"><?php echo e($user->ios_key); ?>

                           </textarea>
                        </div>
                        <div class="mt-4">
                           <?php if(Session::get("is_demo")=='0'): ?>
                              <button type="button" onclick="disablebtn()" class="btn btn-primary"><?php echo e(__('message.Submit')); ?></button>
                           <?php else: ?>
                               <button  class="btn btn-primary" type="submit" value="Submit"><?php echo e(__("message.Submit")); ?></button>
                           <?php endif; ?>  
                        </div>
                     </form>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\local-guide-backend\resources\views/admin/notificationkey.blade.php ENDPATH**/ ?>