
<?php $__env->startSection('title'); ?>
<?php echo e(__('message.Doctor Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo e($data->name); ?>"/>
<meta property="og:title" content="<?php echo e($data->name); ?>"/>
<meta property="og:image" content="<?php echo e(asset('public/upload/doctors').'/'.$data->image); ?>"/>
<meta property="og:image:width" content="250px"/>
<meta property="og:image:height" content="250px"/>
<meta property="og:site_name" content="<?php echo e($data->name); ?>"/>
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
            <h1><?php echo e(__('message.Doctor Details')); ?></h1>
         </div>
      </div>
   </div>
   <div class="lower-content">
      <div class="auto-container">
         <ul class="bread-crumb clearfix">
            <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
            <li><?php echo e(__('message.Doctor Details')); ?></li>
         </ul>
      </div>
   </div>
</section>
<?php if(empty($data)): ?>
<?php echo e(__('message.Result Not Found')); ?>

<?php else: ?>
<section class="doctor-details bg-color-3">
   <div class="auto-container">
      <div class="row clearfix">
         <div class="col-lg-8 col-md-12 col-sm-12 content-side">
            <div class="clinic-details-content doctor-details-content">
               <div class="clinic-block-one">
                  <div class="inner-box">
                     <figure class="image-box">
                        <?php 
                           if($data->image==""){
                               $path=asset('public/upload/doctors/default.png');
                           }else{
                               $path=asset('public/upload/doctors').'/'.$data->image;
                           }
                           
                           ?>
                        <div class="doctor-detail-page-main-box" style="background-image:url('<?php echo e($path); ?>'); background-size: 311px 220px;" ></div>
                     </figure>
                     <div class="content-box">
                        <?php if($data->is_fav=='0'): ?>
                        <?php if(empty(Session::has("user_id"))): ?>
                        <a href="<?php echo e(url('patientlogin')); ?>" id="favdoc<?php echo e($dl->id); ?>">
                        <?php else: ?>
                        <a href="javascript:userfavorite('<?php echo e($data->id); ?>')" id="favdoc<?php echo e($data->id); ?>">
                        <?php endif; ?>
                        <?php else: ?>
                        <a href="javascript:userfavorite('<?php echo e($data->id); ?>')" class="activefav" id="favdoc<?php echo e($data->id); ?>">
                        <?php endif; ?>
                        </a>
                        <div class="like-box">
                           <a href="#">
                           <i class="far fa-heart"></i>
                           </a>
                        </div>
                        <div class="middle body">
                           <div class="sm-container">
                              <i class="show-btn fas fa-share-alt"></i>
                              <div class="sm-menu">
                                 <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url('viewdoctor').'/'.$data->id); ?>"><i class="fab fa-facebook-f"></i></a>
                                 <a href="https://web.whatsapp.com/send?url=<?php echo e(url('viewdoctor').'/'.$data->id); ?>"><i class="fab fa-whatsapp"></i></a>
                                 <a href="https://twitter.com/intent/tweet?text=<?php echo e($data->name); ?>&url=<?php echo e(url('viewdoctor').'/'.$data->id); ?>"><i class="fab fa-twitter"></i></a>
                              </div>
                           </div>
                        </div>
                        <ul class="name-box clearfix">
                           <li class="name">
                              <h2><?php echo e($data->name); ?></h2>
                           </li>
                        </ul>
                        <span class="designation"><?php echo e(isset($data->departmentls->name)?$data->departmentls->name:''); ?></span>
                        <div class="rating-box clearfix">
                           <ul class="rating clearfix">
                              <?php
                                 $arr = $data->avgratting;
                                 if (!empty($arr)) {
                                   $i = 0;
                                   if (isset($arr)) {
                                       for ($i = 0; $i < $arr; $i++) {
                                           echo '<li><i class="icon-Star"></i></li>';
                                       }
                                   }
                                   
                                       $remaing = 5 - $i;
                                       for ($j = 0; $j < $remaing; $j++) {
                                           echo '<li class="light" style="color:gray !important"><i class="icon-Star"></i></li>';
                                       }
                                  
                                 }else{
                                 
                                    for ($j = 0; $j <5; $j++) {
                                           echo '<li class="light" style="color:gray !important"><i class="icon-Star"></i></li>';
                                       }
                                 }?>
                              <li><a href="#">(<?php echo e($data->totalreview); ?>)</a></li>
                           </ul>
                        </div>
                        <div class="text">
                           <p><?php echo e(substr($data->aboutus,0,75)); ?></p>
                        </div>
                        <div class="lower-box clearfix">
                           <ul class="info clearfix">
                              <li><i class="fas fa-map-marker-alt"></i><?php echo e(substr($data->address,0,40)); ?></li>
                              <li><i class="fas fa-phone"></i><a href="<?php echo e($data->phoneno); ?>"><?php echo e($data->phoneno); ?></a></li>
                           </ul>
                           <div class="view-map"><a href="https://maps.google.com/?q=<?php echo e($data->lat); ?>,<?php echo e($data->lon); ?>" target="_blank"><?php echo e(__('message.View Map')); ?></a></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tabs-box">
                  <div class="tab-btn-box centred">
                     <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><?php echo e(__('message.About Us')); ?></li>
                        <li class="tab-btn" data-tab="#tab-2"><?php echo e(__('message.Services')); ?></li>
                        <li class="tab-btn" data-tab="#tab-3"><?php echo e(__('message.Health Care')); ?></li>
                        <li class="tab-btn" data-tab="#tab-4"><?php echo e(__('message.Review')); ?></li>
                     </ul>
                  </div>
                  <div class="tabs-content">
                     <div class="tab active-tab" id="tab-1">
                        <div class="inner-box">
                           <div class="text">
                              <h3><?php echo e(__('message.About')); ?> <?php echo e($data->name); ?>:</h3>
                              <p><?php echo e($data->aboutus); ?></p>
                           </div>
                        </div>
                     </div>
                     <div class="tab" id="tab-2">
                        <div class="experience-box">
                           <div class="text">
                              <h3><?php echo e(__('message.Services')); ?></h3>
                              <p><?php echo e($data->services); ?></p>
                           </div>
                        </div>
                     </div>
                     <div class="tab" id="tab-3">
                        <div class="location-box">
                           <h3><?php echo e(__('message.Health Care')); ?></h3>
                           <?php echo e($data->healthcare); ?>

                        </div>
                     </div>
                     <div class="tab" id="tab-4">
                        <div class="review-box">
                           <h3><?php echo e($data->name); ?> <?php echo e(__('message.Review')); ?></h3>
                           <div class="rating-inner">
                              <div class="rating-box">
                                 <h2><?php echo e(isset($data->avgratting)?number_format($data->avgratting,2):0); ?></h2>
                                 <ul class="clearfix">
                                      
                                      
                                    <?php
                                       $arr = $data->avgratting;
                                       if (!empty($arr)) {
                                         $i = 0;
                                         if (isset($arr)) {
                                             for ($i = 0; $i < $arr; $i++) {
                                                 echo '<li><i class="icon-Star"></i></li>';
                                             }
                                         }
                                         
                                             $remaing = 5 - $i;
                                             for ($j = 0; $j < $remaing; $j++) {
                                                 echo '<li class="light" style="color:gray !important"><i class="icon-Star"></i></li>';
                                             }
                                        
                                       }else{
                                          for ($j = 0; $j <5; $j++) {
                                                 echo '<li class="light" style="color:gray !important"><i class="icon-Star"></i></li>';
                                             }
                                       }?>
                                 </ul>
                                 <span><?php echo e(__('message.Based on 5 review')); ?></span>
                              </div>
                              <div class="rating-pregress">
                                 <div class="single-progress">
                                    <?php $star5=  isset($data->startrattinglines['start5'])?$data->startrattinglines['start5']:"0";
                                       $star4=  isset($data->startrattinglines['start4'])?$data->startrattinglines['start4']:"0";
                                       $star3=  isset($data->startrattinglines['start3'])?$data->startrattinglines['start3']:"0";
                                       $star2=  isset($data->startrattinglines['start2'])?$data->startrattinglines['start2']:"0";
                                       $star1=  isset($data->startrattinglines['start1'])?$data->startrattinglines['start1']:"0";
                                       ?>
                                    <style type="text/css">
                                       .doctor-details-content .tabs-box .tabs-content .review-box .rating-inner .  rating-pregress .single-progress:first-child .porgress-bar:before {
                                       width: <?php echo e($star5); ?>%;
                                       }
                                       .doctor-details-content .tabs-box .tabs-content .review-box .rating-inner .rating-pregress .single-progress:nth-child(2) .porgress-bar:before {
                                       width: <?php echo e($star4); ?>%;
                                       }
                                       .doctor-details-content .tabs-box .tabs-content .review-box .rating-inner .rating-pregress .single-progress:nth-child(3) .porgress-bar:before {
                                       width: <?php echo e($star3); ?>%;
                                       }
                                       .doctor-details-content .tabs-box .tabs-content .review-box .rating-inner .rating-pregress .single-progress:nth-child(4) .porgress-bar:before {
                                       width: <?php echo e($star2); ?>%;
                                       }
                                       .doctor-details-content .tabs-box .tabs-content .review-box .rating-inner .rating-pregress .single-progress:nth-child(5) .porgress-bar:before {
                                       width: <?php echo e($star1); ?>%;
                                       }
                                    </style>
                                    <span class="porgress-bar"></span>
                                    <div class="text">
                                       <p><i class="icon-Star"></i> <?php echo e(__('message.5 Stars')); ?></p>
                                    </div>
                                 </div>
                                 <div class="single-progress">
                                    <span class="porgress-bar"></span>
                                    <div class="text">
                                       <p><i class="icon-Star"></i><?php echo e(__('message.4 Stars')); ?></p>
                                    </div>
                                 </div>
                                 <div class="single-progress">
                                    <span class="porgress-bar"></span>
                                    <div class="text">
                                       <p><i class="icon-Star"></i><?php echo e(__('message.3 Stars')); ?></p>
                                    </div>
                                 </div>
                                 <div class="single-progress">
                                    <span class="porgress-bar"></span>
                                    <div class="text">
                                       <p><i class="icon-Star"></i><?php echo e(__('message.2 Stars')); ?></p>
                                    </div>
                                 </div>
                                 <div class="single-progress">
                                    <span class="porgress-bar"></span>
                                    <div class="text">
                                       <p><i class="icon-Star"></i><?php echo e(__('message.1 Stars')); ?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="review-inner">
                              <?php $__currentLoopData = $data->reviewslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="single-review-box">
                                 <figure class="image-box"><img src="<?php echo e(asset('public/upload/profile/profile.png')); ?>" alt=""></figure>
                                 <ul class="rating clearfix">
                                    <?php
                                       $arr = $dr->rating;
                                       if (!empty($arr)) {
                                         $i = 0;
                                         if (isset($arr)) {
                                             for ($i = 0; $i < $arr; $i++) {
                                                 echo '<li><i class="icon-Star"></i></li>';
                                             }
                                         }
                                         
                                             $remaing = 5 - $i;
                                             for ($j = 0; $j < $remaing; $j++) {
                                                 echo '<li class="light"><i class="icon-Star"></i></li>';
                                             }
                                        
                                       }else{
                                          for ($j = 0; $j <5; $j++) {
                                                 echo '<li class="light"><i class="icon-Star"></i></li>';
                                             }
                                       }?>                       
                                 </ul>
                                 <h6><?php echo e($dr->patientls->name); ?><span>- 
                                    <?php 
                                       ?><?php echo e(date("F d, Y",strtotime($dr->created_at))); ?></span>
                                 </h6>
                                 <p><?php echo e($dr->description); ?></p>
                              </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>
                           <div class="btn-box">
                              <a href="#" class="theme-btn-one"><?php echo e(__('message.Submit Review')); ?><i class="icon-Arrow-Right"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
            <div class="doctors-sidebar">
               <div class="form-widget">
                  <div class="form-title">
                     <h3><?php echo e(__('message.Book Appointment')); ?></h3>
                     <p><?php echo e(__('message.Monday to Sunday')); ?>: <?php echo e($data->working_time); ?></p>
                  </div>
                
                     <div class="form-inner">
                        <div class="appointment-time">
                           <?php if(Session::has('message')): ?>
                           <div class="col-sm-12">
                              <div class="alert  <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert">
                                 <?php echo e(Session::get('message')); ?>

                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                           </div>
                           <?php endif; ?>
                           <?php if($errors->any()): ?>
                           <div class="alert alert-danger">
                              <ul>
                                 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <li><?php echo e($error); ?></li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                           </div>
                           <?php endif; ?>
                           <?php $currency = explode("-", $setting->currency);?>
                           <p><?php echo e(__('message.consultation_fees')); ?> :  <?php echo e($currency[1]); ?><span id="consultation_fees"><?php echo e($data->consultation_fees); ?></span></p>
                           <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                           <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                           <div class="form-group">
                              <input type="text" name="date"  id="date" value="<?php echo e(date('m/d/Y')); ?>" id="datepicker" onchange="slotdivchange(this.value)">
                              <i class="fas fa-calendar-alt"></i>
                           </div>
                           <?php if(!empty($schedule)): ?>
                           <div class="custom-dropdown" id="timerange" style="    width: 100%;margin-bottom: 10px;" >
                              <select class="" name="slottime" id="slottime" required="" onchange="slotchange(this.value)">
                                 <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($s['id']); ?>" data-display-text="Fruits"><?php echo e($s['title']); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                           <?php endif; ?>
                           <div class="custom-slot-design-box">
                              <ul id="slotdiv">
                                 <?php if(empty($getdoctorhoilday)): ?>
                                    <?php if(!empty($schedule)): ?>
                                    <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $s['slottime']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                       <?php if($ns['is_book']==0): ?>
                                       <input type='radio' value='<?php echo e($ns["id"]."#".$ns["name"]); ?>' name='slot' id='<?php echo e($ns["id"]); ?>'/>
                                       <label for='<?php echo e($ns["id"]); ?>'><?php echo e($ns["name"]); ?></label>
                                       <?php else: ?>
                                       <input type='radio' value='<?php echo e($ns["id"]."#".$ns["name"]); ?>' name='slot' id='<?php echo e($ns["id"]); ?>' disabled/>
                                       <label class="custom-radio-disabled" for='radio4'><?php echo e($ns["name"]); ?></label>
                                       <?php endif; ?>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php break; ?>;
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                 <?php else: ?>
                                    <p style="color: red;margin-left: 10px;"><?php echo e(__("message.Doctor isnot Avilable")); ?></p>
                                 <?php endif; ?>
                              </ul>
                           </div>
                        </div>
                        <div class="choose-service">
                           <h4><?php echo e(__('message.Enter Information')); ?></h4>
                           <div class="form-group">
                              <label><?php echo e(__('message.Phone no')); ?></label>
                              <input type="text" name="phone_no" id="phone_no" placeholder="<?php echo e(__('message.Enter Your Phone number')); ?>" required="">
                           </div>
                           <div class="form-group">
                              <label><?php echo e(__('message.Message')); ?></label>
                              <textarea id="message" rows="15"  name="message" placeholder="<?php echo e(__('message.Enter Your Message')); ?>"></textarea>
                           </div>
                            <div class="row">
                                <div class="col-md-6">
                                   <div class="custom-check-box">
                                      <div class="custom-controls-stacked">
                                         <label class="custom-control material-checkbox">
                                         <input type="radio" class="material-control-input" name="payment_type" id="payment_type_cod" value="3" onchange="changeform(this.value)">
                                         <span class="material-control-indicator"></span>
                                         <span class="description">COD</span>
                                         </label>
                                      </div>
                                   </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="custom-check-box">
                                        <div class="custom-controls-stacked">
                                             <label class="custom-control material-checkbox">
                                             <input type="radio" class="material-control-input"  name="payment_type" id="payment_type_stripe" value="2" onchange="changeform(this.value)">
                                             <span class="material-control-indicator"></span>
                                             <span class="description">Stripe</span>
                                             </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-check-box">
                                      <div class="custom-controls-stacked">
                                         <label class="custom-control material-checkbox">
                                         <input type="radio" class="material-control-input"  name="payment_type" id="payment_type_rave" value="4" onchange="changeform(this.value)">
                                         <span class="material-control-indicator"></span>
                                         <span class="description">Rave</span>
                                         </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="custom-check-box">
                                      <div class="custom-controls-stacked">
                                         <label class="custom-control material-checkbox">
                                         <input type="radio" class="material-control-input"  name="payment_type" id="payment_type_paytm" value="5" onchange="changeform(this.value)">
                                         <span class="material-control-indicator"></span>
                                         <span class="description">Paytm</span>
                                         </label>
                                      </div>
                                   </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-check-box">
                                        <div class="custom-controls-stacked">
                                             <label class="custom-control material-checkbox">
                                             <input type="radio" class="material-control-input" name="payment_type" id="payment_type_braintree" value="1" onchange="changeform(this.value)">
                                             <span class="material-control-indicator"></span>
                                             <span class="description">Braintree</span>
                                             </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="custom-check-box">
                                        <div class="custom-controls-stacked">
                                             <label class="custom-control material-checkbox">
                                             <input type="radio" class="material-control-input"  name="payment_type" id="payment_type_razorpay" value="6" onchange="changeform(this.value)">
                                             <span class="material-control-indicator"></span>
                                             <span class="description">Razorpay</span>
                                             </label>
                                        </div>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-check-box">
                                        <div class="custom-controls-stacked">
                                             <label class="custom-control material-checkbox">
                                             <input type="radio" class="material-control-input" name="payment_type" id="payment_type_paystack" value="7" onchange="changeform(this.value)">
                                             <span class="material-control-indicator"></span>
                                             <span class="description">Paystack</span>
                                             </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            
                            <div class="text-center">
                            <?php if(Session::has("user_id")): ?>
                                  <button class="theme-btn-one centred" type="button" id="show_book" onclick="bookshow()" ><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                            <?php else: ?>
                                  <button type="button" class="theme-btn-one" onclick="pleaselogin()"  id="show_book"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                            <?php endif; ?>
                            </div>
                            <div id="braintree_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="payment-form">
                                   <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <input type="hidden" name="phone_no" id="phone_no_1">
                                    <input type="hidden" name="date" id="date_1">
                                    <input type="hidden" name="slot" id="slot_1">
                                    <input type="hidden" name="message" id="message_1">
                                    <input type="hidden" name="payment_type" value="braintree">
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <div class="btn-box" id="btnappointment">
                                        <?php if(Session::has("user_id")): ?>
                                              <button class="theme-btn-one" type="submit"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php else: ?>
                                              <button type="button" class="theme-btn-one" onclick="pleaselogin()"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php endif; ?>
                                    </div>
                                </form> 
                            </div>

                            <div id="stripe_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="stripe-form">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="phone_no" id="phone_no_2">
                                    <input type="hidden" name="date" id="date_2">
                                    <input type="hidden" name="slot" id="slot_2">
                                    <input type="hidden" name="message" id="message_2">
                                    <input type="hidden" name="payment_type" value="stripe">
                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <script
                                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                      data-key="<?php echo e(env('STRIPE_KEY')); ?>"
                                      data-amount=""
                                      data-id="stripid"
                                      data-name="<?php echo e(__('message.System Name')); ?>"
                                      data-label="<?php echo e(__('message.Book Appointment')); ?>"
                                      data-description=""
                                      data-image="<?php echo e(asset('public/image_web/').'/'.$setting->logo); ?>"
                                      data-locale="auto">
                                    </script>
                                </form> 
                            </div>  
                            
                            <div id="cod_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="payment-form">
                                   <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <input type="hidden" name="phone_no" id="phone_no_3">
                                    <input type="hidden" name="date" id="date_3">
                                    <input type="hidden" name="slot" id="slot_3">
                                    <input type="hidden" name="message" id="message_3">
                                    <input type="hidden" name="payment_type" value="cod">
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <div class="btn-box" id="btnappointment">
                                        <?php if(Session::has("user_id")): ?>
                                              <button class="theme-btn-one" type="submit"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php else: ?>
                                              <button type="button" class="theme-btn-one" onclick="pleaselogin()"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php endif; ?>
                                    </div>
                                </form> 
                            </div>
                            
                            <div id="rave_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="payment-form">
                                   <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <input type="hidden" name="phone_no" id="phone_no_4">
                                    <input type="hidden" name="date" id="date_4">
                                    <input type="hidden" name="slot" id="slot_4">
                                    <input type="hidden" name="message" id="message_4">
                                    <input type="hidden" name="payment_type" value="Flutterwave">
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <div class="btn-box" id="btnappointment">
                                        <?php if(Session::has("user_id")): ?>
                                              <button class="theme-btn-one" type="submit"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php else: ?>
                                              <button type="button" class="theme-btn-one" onclick="pleaselogin()"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php endif; ?>
                                    </div>
                                </form> 
                            </div>
                            
                            <div id="paytm_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="payment-form">
                                   <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <input type="hidden" name="phone_no" id="phone_no_5">
                                    <input type="hidden" name="date" id="date_5">
                                    <input type="hidden" name="slot" id="slot_5">
                                    <input type="hidden" name="message" id="message_5">
                                    <input type="hidden" name="payment_type" value="Paytm">
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <div class="btn-box" id="btnappointment">
                                        <?php if(Session::has("user_id")): ?>
                                              <button class="theme-btn-one" type="submit"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php else: ?>
                                              <button type="button" class="theme-btn-one" onclick="pleaselogin()"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php endif; ?>
                                    </div>
                                </form> 
                            </div>
                            
                            <div id="razorpay_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="payment-form">
                                   <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <input type="hidden" name="phone_no" id="phone_no_6">
                                    <input type="hidden" name="date" id="date_6">
                                    <input type="hidden" name="slot" id="slot_6">
                                    <input type="hidden" name="message" id="message_6">
                                    <input type="hidden" name="type"  value="1">
                                    
                                    <input type="hidden" name="payment_type" value="Razorpay">
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <?php if(Session::has("user_id")): ?>
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="<?php echo e($paymentdetail['razorpay_razorpay_key']); ?>"
                                            data-amount="<?php echo e((int)$data->consultation_fees*100); ?>"
                                            data-buttontext='<?php echo e(__("message.Pay")); ?>'
                                            data-name="<?php echo e(env('APP_NAME')); ?>"
                                            data-description="Payment"
                                            data-image="<?php echo e(asset('public/image_web/896814.png')); ?>"
                                            data-prefill.name="name"
                                            data-prefill.email="email"
                                            data-theme.color="#d18217">
                                        </script>
                                    <?php else: ?>
                                          <button type="button" class="theme-btn-one" onclick="pleaselogin()"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                    <?php endif; ?>
                                </form> 
                            </div>
                            
                            <div id="paystack_div" style="display:none;">
                                <form action="<?php echo e(url('makeappointment')); ?>" method="post" id="payment-form">
                                   <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
                                    <input type="hidden" name="phone_no" id="phone_no_7">
                                    <input type="hidden" name="date" id="date_7">
                                    <input type="hidden" name="slot" id="slot_7">
                                    <input type="hidden" name="message" id="message_7">
                                    <input type="hidden" name="payment_type" value="Paystack">
                                    <div class="bt-drop-in-wrapper">
                                        <div id="bt-dropin"></div>
                                    </div>
                                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                                    <div class="btn-box" id="btnappointment">
                                        <?php if(Session::has("user_id")): ?>
                                              <button class="theme-btn-one" type="submit"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
                                        <?php else: ?>
                                              <button type="button" class="theme-btn-one" onclick="pleaselogin()"><?php echo e(__('message.Book Appointment')); ?><i class="icon-Arrow-Right"></i></button>
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
   </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

<script src="https://js.braintreegateway.com/web/dropin/1.23.0/js/dropin.min.js"></script>
<script type="text/javascript">
   document.querySelector('.show-btn').addEventListener('click', function() {
     document.querySelector('.sm-menu').classList.toggle('active');
   });
</script>
<script>

   function changeform(val){
     
      var phone_no = $("#phone_no").val();
      var date = $("#date").val();
      var message = $("#message").val();
      var slot = $('input[name="slot"]:checked').val();
      if(phone_no!=""&&date!=""&&message!=""&&slot!=""){
            if($("#payment_type_braintree").prop("checked")==true){
                 $("#braintree_div").css("display","block");
                 $("#cod_div").css("display","none");
                 $("#stripe_div").css("display","none");
                 $("#razorpay_div").css("display","none");
                 $("#paytm_div").css("display","none");
                 $("#rave_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","none");
                 $("#phone_no_1").val(phone_no);
                 $("#date_1").val(date);
                 $("#message_1").val(message);
                 $("#slot_1").val(slot);
            }
            if($("#payment_type_stripe").prop("checked")==true){
                 $("#stripe_div").css("display","block");
                 $("#braintree_div").css("display","none");
                 $("#cod_div").css("display","none");
                 $("#razorpay_div").css("display","none");
                 $("#paytm_div").css("display","none");
                 $("#rave_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","none");
                 $("#phone_no_2").val(phone_no);
                 $("#date_2").val(date);
                 $("#message_2").val(message);
                 $("#slot_2").val(slot);
            }
            if($("#payment_type_cod").prop("checked")==true){
                 $("#cod_div").css("display","block");
                 $("#braintree_div").css("display","none");
                 $("#stripe_div").css("display","none");
                 $("#razorpay_div").css("display","none");
                 $("#paytm_div").css("display","none");
                 $("#rave_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","none");
                 $("#phone_no_3").val(phone_no);
                 $("#date_3").val(date);
                 $("#message_3").val(message);
                 $("#slot_3").val(slot);
            }
            if($("#payment_type_rave").prop("checked")==true){
                 $("#rave_div").css("display","block");
                 $("#braintree_div").css("display","none");
                 $("#stripe_div").css("display","none");
                 $("#cod_div").css("display","none");
                 $("#razorpay_div").css("display","none");
                 $("#paytm_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","none");
                 $("#phone_no_4").val(phone_no);
                 $("#date_4").val(date);
                 $("#message_4").val(message);
                 $("#slot_4").val(slot);
            }
            if($("#payment_type_paytm").prop("checked")==true){
                 $("#paytm_div").css("display","block");
                 $("#braintree_div").css("display","none");
                 $("#stripe_div").css("display","none");
                 $("#cod_div").css("display","none");
                 $("#razorpay_div").css("display","none");
                 $("#rave_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","none");
                 $("#phone_no_5").val(phone_no);
                 $("#date_5").val(date);
                 $("#message_5").val(message);
                 $("#slot_5").val(slot);
            }
            if($("#payment_type_razorpay").prop("checked")==true){
                 $("#razorpay_div").css("display","block");
                 $("#braintree_div").css("display","none");
                 $("#stripe_div").css("display","none");
                 $("#cod_div").css("display","none");
                 $("#paytm_div").css("display","none");
                 $("#rave_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","none");
                 $("#phone_no_6").val(phone_no);
                 $("#date_6").val(date);
                 $("#message_6").val(message);
                 $("#slot_6").val(slot);
            }
            if($("#payment_type_paystack").prop("checked")==true){
                 $("#razorpay_div").css("display","none");
                 $("#braintree_div").css("display","none");
                 $("#stripe_div").css("display","none");
                 $("#cod_div").css("display","none");
                 $("#paytm_div").css("display","none");
                 $("#rave_div").css("display","none");
                 $("#show_book").css("display","none");
                 $("#paystack_div").css("display","block");
                 $("#phone_no_7").val(phone_no);
                 $("#date_7").val(date);
                 $("#message_7").val(message);
                 $("#slot_7").val(slot);
            }
            
            
      }else{
            alert("Please Fillup All Field");
      }
      

    }
   
    function bookshow(){
        var phone_no = $("#phone_no").val();
        var date = $("#date").val();
        var message = $("#message").val();
        var slot = $('input[name="slot"]:checked').val();
        if(phone_no!=""&&date!=""&&message!=""&&slot!=""){
            alert("please choose payment type");
        }
        else{
            alert("Please Fillup All Field");
        }
    }
    


   var form = document.querySelector('#payment-form');
   var client_token = "<?php echo e($token); ?>";
   
   braintree.dropin.create({
     authorization: client_token,
     selector: '#bt-dropin',
     paypal: {
       flow: 'vault'
     }
   }, function (createErr, instance) {
     if (createErr) {
       console.log('Create Error', createErr);
       return;
     }
     form.addEventListener('submit', function (event) {
       event.preventDefault();
   
       instance.requestPaymentMethod(function (err, payload) {
         if (err) {
           console.log('Request Payment Method Error', err);
           return;
         }
        
        
         document.querySelector('#nonce').value = payload.nonce;
         form.submit();
       });
     });
   });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/viewdoctor.blade.php ENDPATH**/ ?>