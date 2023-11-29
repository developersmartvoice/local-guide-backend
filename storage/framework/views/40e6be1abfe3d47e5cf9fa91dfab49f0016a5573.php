
<?php $__env->startSection('title'); ?>
<?php echo e(__('message.Favourite')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo e(__('message.System Name')); ?>"/>
<meta property="og:title" content="<?php echo e(__('message.System Name')); ?>"/>
<meta property="og:image" content="<?php echo e(asset('public/image_web/').'/'.$setting->favicon); ?>"/>
<meta property="og:image:width" content="250px"/>
<meta property="og:image:height" content="250px"/>
<meta property="og:site_name" content="<?php echo e(__('message.System Name')); ?>"/>
<meta property="og:description" content="<?php echo e(__('message.meta_description')); ?>"/>
<meta property="og:keyword" content="<?php echo e(__('message.Meta Keyword')); ?>"/>
<link rel="shortcut icon" href="<?php echo e(asset('public/image_web/').'/'.$setting->favicon); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="page-title-two">
   <div class="title-box centred bg-color-2">
      <div class="pattern-layer">
         <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-70.png')); ?>');"></div>
         <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-71.png')); ?>');"></div>
      </div>
      <div class="auto-container">
         <div class="title">
            <h1><?php echo e(__('message.Favourite')); ?></h1>
         </div>
      </div>
   </div>
   <div class="lower-content">
      <ul class="bread-crumb clearfix">
         <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
         <li><?php echo e(__('message.Favourite')); ?></li>
      </ul>
   </div>
</section>
<section class="patient-dashboard bg-color-3">
   <div class="left-panel">
      <div class="profile-box patient-profile">
         <div class="upper-box">
            <figure class="profile-image">
               <?php if($userdata->profile_pic!=""): ?>
               <img src="<?php echo e(asset('public/upload/profile').'/'.$userdata->profile_pic); ?>" alt="">
               <?php else: ?>
               <img src="<?php echo e(asset('public/upload/profile/profile.png')); ?>" alt="">
               <?php endif; ?>
            </figure>
            <div class="title-box centred">
               <div class="inner">
                  <h3><?php echo e($userdata->name); ?></h3>
                  <p><i class="fas fa-envelope"></i><?php echo e($userdata->email); ?></p>
               </div>
            </div>
         </div>
         <div class="profile-info">
            <ul class="list clearfix">
               <li><a href="<?php echo e(url('userdashboard')); ?>"><i class="fas fa-columns"></i><?php echo e(__('message.Dashboard')); ?></a></li>
               <li><a href="<?php echo e(url('favouriteuser')); ?>" class="current"><i class="fas fa-heart"></i><?php echo e(__('message.Favourite Doctors')); ?></a></li>
               <li><a href="<?php echo e(url('viewschedule')); ?>"><i class="fas fa-clock"></i><?php echo e(__('message.Schedule Timing')); ?></a></li>
               <li><a href="<?php echo e(url('userreview')); ?>" ><i class="fas fa-comments"></i><?php echo e(__('message.Review')); ?></a></li>
               <li><a href="<?php echo e(url('usereditprofile')); ?>"><i class="fas fa-user"></i><?php echo e(__('message.My Profile')); ?></a></li>
               <li><a href="<?php echo e(url('changepassword')); ?>"><i class="fas fa-unlock-alt"></i><?php echo e(__('message.Change Password')); ?></a></li>
               <li><a href="<?php echo e(url('logout')); ?>"><i class="fas fa-sign-out-alt"></i><?php echo e(__('message.Logout')); ?></a></li>
            </ul>
         </div>
      </div>
   </div>
   <div class="right-panel">
      <div class="content-container">
         <div class="outer-container">
            <div class="favourite-doctors">
               <div class="doctors-list">
                  <div class="row clearfix">
                     <?php if(count($userfavorite)>0): ?>
                     <?php $__currentLoopData = $userfavorite; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="col-xl-4 col-lg-6 col-md-12 doctors-block">
                        <div class="team-block-three">
                           <div class="inner-box">
                              <figure class="image-box">
                                 <img src="<?php echo e(asset('public/upload/doctors').'/'.$uf->doctorls->image); ?>" alt="">
                                 <a href="javascript:userfavoritedashboard('<?php echo e($uf->doctor_id); ?>')" class="activefav"><i class="far fa-heart"></i></a>
                              </figure>
                              <div class="lower-content">
                                 <ul class="name-box clearfix">
                                    <li class="name">
                                       <h3><a href="<?php echo e(url('viewdoctor').'/'.$uf->doctor_id); ?>"><?php echo e(substr($uf->doctorls->name,0,10)); ?></a></h3>
                                    </li>
                                    <li><i class="icon-Trust-1"></i></li>
                                    <li><i class="icon-Trust-2"></i></li>
                                 </ul>
                                 <span class="designation"><?php echo e($uf->doctorls->department_name); ?></span>
                                 <div class="rating-box clearfix">
                                    <ul class="rating clearfix">
                                       <?php
                                          $arr = $uf->doctorls->avgratting;
                                          if (!empty($arr)) {
                                            $i = 0;
                                            if (isset($arr)) {
                                                for ($i = 0; $i < $arr; $i++) {
                                                    echo '<li><i class="icon-Star"></i></li>';
                                                }
                                            }
                                            
                                                $remaing = 5 - $i;
                                                for ($j = 0; $j < $remaing; $j++) {
                                                    echo '<li><i class="icon-Star" style="color: gray;"></i></li>';
                                                }
                                           
                                          }else{
                                             for ($j = 0; $j <5; $j++) {
                                                    echo '<li><i class="icon-Star" style="color: gray;"></i></li>';
                                                }
                                          }?>
                                       <li><a href="">(<?php echo e($uf->doctorls->totalreview); ?>)</a></li>
                                    </ul>
                                 </div>
                                 <div class="location-box">
                                    <p><i class="fas fa-map-marker-alt"></i><?php echo e(substr($uf->doctorls->address,0,25)); ?></p>
                                 </div>
                                 <div class="lower-box clearfix">
                                    <a href="<?php echo e(url('viewdoctor').'/'.$uf->doctor_id); ?>"><?php echo e(__('message.Book Now')); ?></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                     <?php echo e(__('message.No any doctors In your Favorite list')); ?>

                     <?php endif; ?>
                  </div>
               </div>
               <?php echo e($userfavorite->links()); ?>

            </div>
         </div>
      </div>
   </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/patient/favourite.blade.php ENDPATH**/ ?>