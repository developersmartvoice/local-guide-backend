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
                  <h4 class="mb-0"><?php echo e(__("message.Save Subscription")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('admin/services')); ?>"><?php echo e(__("message.Subscription")); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__("message.Save Subscription")); ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-6">
               <div class="card">
                  <div class="card-body">
                     <form action="<?php echo e(url('admin/update_subscriptio_price')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>  
                        <input type="hidden" name="id" value="<?php echo e($id); ?>"> 
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Price")); ?></label>
                           <input type="number" class="form-control" id="price" name="price" placeholder='' value="<?php echo e(isset($data)?$data->price:''); ?>">
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/subscription/save.blade.php ENDPATH**/ ?>