
<?php $__env->startSection('title'); ?>
<?php echo e(__('message.Specialist')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo e(__('message.Specialist')); ?>"/>
<meta property="og:title" content="<?php echo e(__('message.Specialist')); ?>"/>
<meta property="og:image" content="<?php echo e(asset('public/image_web/').'/'.$setting->favicon); ?>"/>
<meta property="og:image:width" content="250px"/>
<meta property="og:image:height" content="250px"/>
<meta property="og:site_name" content="<?php echo e(__('message.Specialist')); ?>"/>
<meta property="og:description" content="<?php echo e(__('message.meta_description')); ?>"/>
<meta property="og:keyword" content="<?php echo e(__('message.Meta Keyword')); ?>"/>
<link rel="shortcut icon" href="<?php echo e(asset('public/image_web/').'/'.$setting->favicon); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="page-title centred bg-color-1">
   <div class="pattern-layer">
      <div class="pattern-1" style="background-image: url(assets/images/shape/shape-70.png);"></div>
      <div class="pattern-2" style="background-image: url(assets/images/shape/shape-71.png);"></div>
   </div>
   <div class="auto-container">
      <div class="content-box">
         <div class="title">
            <h1><?php echo e(__('message.Specialist')); ?></h1>
         </div>
         <ul class="bread-crumb clearfix">
            <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
            <li><?php echo e(__('message.Specialist')); ?></li>
         </ul>
      </div>
   </div>
</section>

<section class="category-viewspecialistp-section category-section bg-color-3 centred">
   <div class="pattern-layer">
      <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-47.png')); ?>');"></div>
      <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-48.png')); ?>');"></div>
   </div>
   <div class="auto-container">
      <div class="sec-title centred">
         <h2></h2>
      </div>
      <div class="row clearfix">
         <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="col-lg-3 col-md-6 col-sm-6 col-6 category-block">
            <div class="category-block-one wow fadeInUp animated animated animated" data-wow-delay="00ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
               <div class="inner-box">
                  <div class="pattern">
                     <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-45.png')); ?>');"></div>
                     <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-46.png')); ?>');"></div>
                  </div>
                  <figure class="icon-box"><img src="<?php echo e(asset('public/upload/services').'/'.$d->icon); ?>"  style="height: 62px;width: 62px;" alt=""></figure>
                  <h3><a href="<?php echo e(url('searchdoctor?type=').$d->id); ?>"><?php echo e($d->name); ?></a></h3>
                  <div class="link"><a href="<?php echo e(url('searchdoctor?type=').$d->id); ?>"><i class="icon-Arrow-Right"></i></a></div>
                  <div class="btn-box"><a href="<?php echo e(url('searchdoctor?type=').$d->id); ?>" class="theme-btn-one"><?php echo e(__('message.View List')); ?><i class="icon-Arrow-Right"></i></a></div>
               </div>
            </div>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
      </div>
   </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>



   <script type="text/javascript">
      document.querySelector('.show-btn').addEventListener('click', function() {
        document.querySelector('.sm-menu').classList.toggle('active');
      });
   </script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/viewspecialist.blade.php ENDPATH**/ ?>