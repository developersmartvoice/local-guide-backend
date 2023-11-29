
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Save Specialities")); ?> | <?php echo e(__("message.Admin")); ?>

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
                  <h4 class="mb-0"><?php echo e(__("message.Save Specialities")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('admin/services')); ?>"><?php echo e(__("message.specialities")); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__("message.Save Specialities")); ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-6">
               <div class="card">
                  <div class="card-body">
                     <form action="<?php echo e(url('admin/updateservice')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>  
                        <input type="hidden" name="id" value="<?php echo e($id); ?>"> 
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Name")); ?></label>
                           <input type="text" class="form-control" id="name" name="name" placeholder='<?php echo e(__("message.Enter Specialities Name")); ?>' value="<?php echo e(isset($data)?$data->name:''); ?>">
                        </div>
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Icon")); ?></label>
                           <?php if($data): ?>
                           <img src="<?php echo e(asset('public/upload/services').'/'.$data->icon); ?>" style="width: 150px;height: 150px" />
                           <input type="file" class="form-control" id="icon" name="icon" >
                           <?php else: ?>
                           <input type="file" class="form-control" required="" id="icon" name="icon" >
                           <?php endif; ?>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubnzxmjc/localguide/resources/views/admin/service/saveservices.blade.php ENDPATH**/ ?>