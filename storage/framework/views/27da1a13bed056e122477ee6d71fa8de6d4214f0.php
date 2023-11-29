
<?php $__env->startSection('title'); ?>
<?php echo e(__('message.User Login')); ?>

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
                        <h1><?php echo e(__('message.User Login')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="lower-content">
                <div class="auto-container">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
                        <li><?php echo e(__('message.User Login')); ?></li>
                    </ul>
                </div>
            </div>
</section>
<section class="registration-section bg-color-3">
            <div class="pattern">
                <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-85.png')); ?>');"></div>
                <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-86.png')); ?>');"></div>
            </div>
            <div class="auto-container">
                <div class="inner-box">
                    <div class="content-box">
                        <div class="title-box">
                            <h3><?php echo e(__('message.User Login')); ?></h3>
                            <a href="<?php echo e(url('patientregister')); ?>"><?php echo e(__('message.Register Now')); ?></a>
                        </div>
                        <div class="inner">
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
                            <div id="error"></div>
                            <form action="<?php echo e(url('postloginuser')); ?>" method="post" class="registration-form">
                                 <?php echo e(csrf_field()); ?>

                                <div class="row clearfix">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label><?php echo e(__('message.Email')); ?></label>
                                        <input type="email" name="email" id="email" placeholder="<?php echo e(__('message.Enter Email Address')); ?>" required="" value="<?php echo e(isset($_COOKIE['email'])?$_COOKIE['email']:''); ?>">
                                        <?php if($errors->has('email')): ?>
                                          	<span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                        
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label><?php echo e(__('message.Password')); ?></label>
                                        <input type="password" name="password" id="password" placeholder="<?php echo e(__('message.Enter password')); ?>" required="" value="<?php echo e(isset($_COOKIE['password'])?$_COOKIE['password']:''); ?>">
                                        <?php if($errors->has('password')): ?>
                                          	<span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                        
                                    <!--<div class="col-lg-12 col-md-12 col-sm-12 form-group">-->
                                    <!--    <label><?php echo e(__('message.Confirm Password')); ?></label>-->
                                    <!--    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="<?php echo e(__('message.Enter Confirm Password')); ?>" required="" value="">-->
                                    <!--    <?php if($errors->has('password_confirmation')): ?>-->
                                    <!--      	<span class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></span>-->
                                    <!--    <?php endif; ?>-->
                                    <!--</div>-->
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <div class="custom-check-box">
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control material-checkbox">
                                                    <?php if(isset($_COOKIE['rem_me'])): ?>
                                                      <input type="checkbox" class="material-control-input" value="1" name="rem_me" id="rem_me" checked="">
                                                     <?php else: ?>
                                                      <input type="checkbox" class="material-control-input" value="1" name="rem_me" id="rem_me">
                                                     <?php endif; ?>
                                                   
                                                    <span class="material-control-indicator"></span>
                                                    <span class="description"><?php echo e(__('message.Remember me')); ?></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="submit" class="theme-btn-one"><?php echo e(__('message.Login Now')); ?><i class="icon-Arrow-Right"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="text"><span><?php echo e(__('message.or')); ?></span></div>
                          
                            <div class="login-now"><p><?php echo e(__("message.Don't Remember Password")); ?><a href="<?php echo e(url('forgotpassword')); ?>"><?php echo e(__('message.Forgot Password')); ?></a></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      <section class="agent-section" style="background: aliceblue;">
   <div class="auto-container">
      <div class="inner-container bg-color-2">
         <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 left-column">
               <div class="content_block_3">
                  <div class="content-box">
                     <h3><?php echo e(__('message.Emergency call')); ?></h3>
                     <div class="support-box">
                        <div class="icon-box"><i class="fas fa-phone"></i></div>
                        <span><?php echo e(__('message.Telephone')); ?></span>
                        <h3><a href="tel:<?php echo e($setting->phone); ?>"><?php echo e($setting->phone); ?></a></h3>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 right-column">
               <div class="content_block_4">
                  <div class="content-box">
                     <h3><?php echo e(__('message.Sign up for Newsletter today')); ?></h3>
                     <form action="#" method="post" class="subscribe-form">
                        <div class="form-group">
                           <input type="email" name="email" id="emailnews" placeholder="<?php echo e(__('message.Your email')); ?>" required="">
                           <button type="button" onclick="addnewsletter()" class="theme-btn-one"><?php echo e(__('message.Submit now')); ?><i class="icon-Arrow-Right"></i></button>
                        </div>
                     </form>
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
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/patient/login.blade.php ENDPATH**/ ?>