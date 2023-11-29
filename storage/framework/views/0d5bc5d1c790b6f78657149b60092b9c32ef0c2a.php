
<?php $__env->startSection('title'); ?>
<?php echo e(__('message.Patient Dashboard')); ?>

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
            <h1><?php echo e(__('message.Patient Dashboard')); ?></h1>
         </div>
      </div>
   </div>
   <div class="lower-content">
      <ul class="bread-crumb clearfix">
         <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
         <li><?php echo e(__('message.Patient Dashboard')); ?></li>
      </ul>
   </div>
</section>
<section class="patient-dashboard bg-color-3">
   <div class="left-panel">
      <div class="profile-box patient-profile">
         <div class="upper-box">
            <figure class="profile-image">
               <?php if(isset($userdata)&&$userdata->profile_pic!=""): ?>
               <img src="<?php echo e(asset('public/upload/profile').'/'.$userdata->profile_pic); ?>" alt="">
               <?php else: ?>
               <img src="<?php echo e(asset('public/upload/profile/profile.png')); ?>" alt="">
               <?php endif; ?>
            </figure>
            <div class="title-box centred">
               <div class="inner">
                  <h3><?php echo e(isset($userdata->name)?$userdata->name:""); ?></h3>
                  <p><i class="fas fa-envelope"></i><?php echo e(isset($userdata->email)?$userdata->email:""); ?></p>
               </div>
            </div>
         </div>
         <div class="profile-info">
            <ul class="list clearfix">
               <li><a href="<?php echo e(url('userdashboard')); ?>" class="current"><i class="fas fa-columns"></i><?php echo e(__('message.Dashboard')); ?></a></li>
               <li><a href="<?php echo e(url('favouriteuser')); ?>"><i class="fas fa-heart"></i><?php echo e(__('message.Favourite Doctors')); ?></a></li>
               <li><a href="<?php echo e(url('viewschedule')); ?>"><i class="fas fa-clock"></i><?php echo e(__('message.Schedule Timing')); ?></a></li>
               <li><a href="<?php echo e(url('userreview')); ?>" ><i class="fas fa-comments"></i><?php echo e(__('message.Review')); ?></a></li>
               <li><a href="<?php echo e(url('usereditprofile')); ?>" ><i class="fas fa-user"></i><?php echo e(__('message.My Profile')); ?></a></li>
               <li><a href="<?php echo e(url('changepassword')); ?>"><i class="fas fa-unlock-alt"></i><?php echo e(__('message.Change Password')); ?></a></li>
               <li><a href="<?php echo e(url('logout')); ?>"><i class="fas fa-sign-out-alt"></i><?php echo e(__('message.Logout')); ?></a></li>
            </ul>
         </div>
      </div>
   </div>
   <div class="right-panel">
      <div class="content-container">
         <div class="outer-container">
            <div class="feature-content">
               <div class="row clearfix">
                  <div class="col-xl-4 col-lg-12 col-md-12 feature-block">
                     <div class="feature-block-two">
                        <div class="inner-box">
                           <div class="pattern">
                              <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-79.png')); ?>');"></div>
                              <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-80.png')); ?>');"></div>
                           </div>
                           <div class="icon-box"><i class="icon-Dashboard-3"></i></div>
                           <h3><?php echo e($totalappointment); ?></h3>
                           <h5><?php echo e(__('message.Total')); ?></h5>
                           <h5><?php echo e(__("message.Appointment")); ?></h5>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-12 col-md-12 feature-block">
                     <div class="feature-block-two">
                        <div class="inner-box">
                           <div class="pattern">
                              <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-81.png')); ?>');"></div>
                              <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-82.png')); ?>');"></div>
                           </div>
                           <div class="icon-box"><i class="icon-Dashboard-email-4"></i></div>
                           <h3><?php echo e($completeappointment); ?></h3>
                           <h5><?php echo e(__('message.Completed')); ?></h5>
                           <h5><?php echo e(__("message.Appointment")); ?></h5>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-12 col-md-12 feature-block">
                     <div class="feature-block-two">
                        <div class="inner-box">
                           <div class="pattern">
                              <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-83.png')); ?>');"></div>
                              <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-84.png')); ?>');"></div>
                           </div>
                           <div class="icon-box"><i class="icon-Dashboard-5"></i></div>
                           <h3><?php echo e($pendingappointment); ?></h3>
                           <h5><?php echo e(__("message.Pending")); ?></h5>
                           <h5><?php echo e(__("message.Appointment")); ?></h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="doctors-appointment">
               <div class="title-box">
                  <h3><?php echo e(__("message.Doctors Appointment")); ?></h3>
                  <div class="btn-box">
                     <?php if($type==2): ?>
                     <a href="<?php echo e(url('userdashboard?type=2')); ?>" class="theme-btn-one"><?php echo e(__('message.past')); ?> <i class="icon-Arrow-Right"></i></a>
                     <?php else: ?>
                     <a href="<?php echo e(url('userdashboard?type=2')); ?>" class="theme-btn-two"><?php echo e(__('message.past')); ?></a>
                     <?php endif; ?>
                     <?php if(!isset($type)): ?>
                     <a href="<?php echo e(url('userdashboard')); ?>" class="theme-btn-one"><?php echo e(__('message.Today')); ?> <i class="icon-Arrow-Right"></i></a>
                     <?php else: ?>
                     <a href="<?php echo e(url('userdashboard')); ?>" class="theme-btn-two"><?php echo e(__('message.Today')); ?></a>
                     <?php endif; ?>
                     <?php if($type==3): ?>
                     <a href="<?php echo e(url('userdashboard?type=3')); ?>" class="theme-btn-one"><?php echo e(__('message.Upcoming')); ?> <i class="icon-Arrow-Right"></i></a>
                     <?php else: ?>
                     <a href="<?php echo e(url('userdashboard?type=3')); ?>" class="theme-btn-two"><?php echo e(__('message.Upcoming')); ?></a>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="doctors-list">
                  <div class="table-outer">
                     <table class="doctors-table">
                        <thead class="table-header">
                           <tr>
                              <th><?php echo e(__('message.Doctor Name')); ?></th>
                              <th><?php echo e(__('message.Phone')); ?></th>
                              <th><?php echo e(__('message.Date')); ?></th>
                              <th><?php echo e(__('message.Status')); ?></th>
                              <th><?php echo e(__('message.Action')); ?></th>
                              
                           </tr>
                        </thead>
                        <tbody>
                           <?php $__currentLoopData = $bookdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                              <td>
                                 <div class="name-box">
                                    <figure class="image">
                                       <?php if(isset($bdata->doctorls)): ?>
                                       <img src="<?php echo e(asset('public/upload/doctors').'/'.$bdata->doctorls->image); ?>" alt="">
                                       <?php else: ?>
                                       <img src="<?php echo e(asset('public/upload/profile/profile.png')); ?>" alt="">
                                       <?php endif; ?>
                                    </figure>
                                    <h5><?php echo e(isset($bdata->doctorls)?$bdata->doctorls->name:""); ?></h5>
                                    <span class="designation"><?php echo e($bdata->department_name); ?></span>
                                 </div>
                              </td>
                              <td>
                                 <p><?php echo e($bdata->phone); ?></p>
                              </td>
                              <td>
                                 <p><?php echo e(date("F d,Y",strtotime($bdata->date))); ?></p>
                                 <span class="time"><?php echo e($bdata->slot_name); ?></span>
                              </td>
                              <td>
                                 <?php 
                                    if($bdata->status=='1'){
                                         echo '<span class="status">'.__("message.Received").'</span>';
                                    }else if($bdata->status=='2'){
                                         echo '<span class="status">'. __("message.Approved").'</span>';
                                    }else if($bdata->status=='3'){
                                         echo '<span class="status">'. __("message.In Process").'</span>';
                                    }
                                    else if($bdata->status=='4'){
                                         echo '<span class="status">'. __("message.Completed").'</span>';
                                    }
                                    else if($bdata->status=='5'){
                                         echo '<span class="status">'. __("message.Rejected").'</span>';
                                    }else{
                                         echo '<span class="status">'. __("message.Absent").'</span>';
                                    }   
                                    ?>
                                     <?php if($bdata->prescription_file!=""): ?>
                                             <li><a href="<?php echo e(asset('public/upload/prescription').'/'.$bdata->prescription_file); ?>" target="_blank" class="btn btn-success" style="color:white"><?php echo e(__("message.View Prescription")); ?></a></li>
                                             <?php endif; ?>
                              </td>
                              <td>
                                  <?php if($bdata->status=='2'||$bdata->status=='3'||$bdata->status=='1'): ?>
                                      <button type="button" class="btn btn-danger" onclick="reject_record('<?php echo e($bdata->id); ?>')">Reject</button>
                                  <?php endif; ?>
                              </td>
                             
                           </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                     </table>
                     <?php echo e($bookdata->links()); ?>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/patient/dashboard.blade.php ENDPATH**/ ?>