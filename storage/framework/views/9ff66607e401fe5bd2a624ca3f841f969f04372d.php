
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Edit Profile")); ?> | <?php echo e(__("message.admin")); ?>  
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
                  <h4 class="mb-0"><?php echo e(__("message.Edit Profile")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?php echo e(__("message.Edit Profile")); ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-6">
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
                     <form action="<?php echo e(url('admin/updateaccount')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>  
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.First Name")); ?></label>
                           <input type="text" class="form-control" id="first_name" name="first_name" placeholder='<?php echo e(__("message.Enter Your First Name")); ?>' value="<?php echo e($userdata->first_name); ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Last Name")); ?></label>
                           <input type="text" class="form-control" id="last_name" name="last_name" placeholder='<?php echo e(__("message.Enter Last Name")); ?>' value="<?php echo e($userdata->last_name); ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Email")); ?></label>
                           <input type="text" class="form-control" id="email" name="email" placeholder='<?php echo e(__("message.Enter Email Address")); ?>' value="<?php echo e($userdata->email); ?>" readonly>
                        </div>
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Phone")); ?></label>
                           <input type="text" class="form-control" id="phone" name="phone" placeholder='<?php echo e(__("message.Enter Phone")); ?>' value="<?php echo e($userdata->phone); ?>" required>
                        </div>
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.Image")); ?></label>
                           <img src="<?php echo e(asset('public/upload/profile/').'/'.$userdata->profile_pic); ?>" style="width: 150px;height: 150px" />
                           <input type="file" class="form-control" id="profile_pic" name="profile_pic" >
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\local-guide-backend\resources\views/admin/profile.blade.php ENDPATH**/ ?>