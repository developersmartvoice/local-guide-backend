
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.News")); ?> | <?php echo e(__("message.Admin")); ?> 
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
                  <h4 class="mb-0"><?php echo e(__("message.News")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo e(__("message.Dashboard")); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__("message.News")); ?></li>
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
                     <form action="<?php echo e(url('admin/sendnews')); ?>" method="post" >
                        <?php echo e(csrf_field()); ?>  
                        <div class="form-group">
                           <label for="formrow-firstname-input"><?php echo e(__("message.News Content")); ?></label>
                           <textarea id="content" name="content" required class="form-control" ></textarea>
                        </div>
                        <p> <span style="color:red">*</span> You can send email to news users who have subscribed news on website</p>
                        
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
<script>
    CKEDITOR.replace('content');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/news.blade.php ENDPATH**/ ?>