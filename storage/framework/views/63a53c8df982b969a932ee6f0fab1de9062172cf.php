<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title><?php echo e(__("message.Log In")); ?> | <?php echo e(__("message.System Name")); ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta content='<?php echo e(__("message.System Name")); ?>' name="description" />
      <meta content='<?php echo e(__("message.System Name")); ?>' name="author" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="<?php echo e(url('/')); ?>" />
      <meta property="og:title" content='<?php echo e(__("message.System Name")); ?>' />
      <meta property="og:image" content="<?php echo e(Session::get('favicon')); ?>" />
      <meta property="og:image:width" content="250px" />
      <meta property="og:image:height" content="250px" />
      <meta property="og:site_name" content='<?php echo e(__("message.System Name")); ?>' />
      <meta property="og:description" content='<?php echo e(__("message.meta_description")); ?>' />
      <meta property="og:keyword" content='<?php echo e(__("message.Meta Keyword")); ?>' />
      <link rel="shortcut icon" href="<?php echo e(Session::get('favicon')); ?>" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
      <?php if(__("message.RTL")==0): ?>
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/app-rtl.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
      <?php else: ?>
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
      <?php endif; ?>
   </head>
   <body class="authentication-bg">
      <div class="home-btn d-none d-sm-block"></div>
      <div class="account-pages my-5 pt-sm-5">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="text-center">
                     <a href="index.html" class="mb-5 d-block auth-logo">
                     <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="22" class="logo logo-dark" />
                     <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="22" class="logo logo-light" />
                     </a>
                  </div>
               </div>
            </div>
            <div class="row align-items-center justify-content-center">
               <div class="col-md-8 col-lg-6 col-xl-5">
                  <div class="card">
                     <div class="card-body p-4">
                        <div class="text-center mt-2">
                           <h5 class="text-primary"><?php echo e(__("message.Welcome Back")); ?></h5>
                           <p class="text-muted"><?php echo e(__("message.Sign in to continue to Admin")); ?></p>
                        </div>
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
                        <div class="p-2 mt-4">
                           <form action="<?php echo e(url('admin/postlogin')); ?>" class="custom-validation" method="post">
                              <?php echo e(csrf_field()); ?>

                              <div class="form-group">
                                 <label for="username"><?php echo e(__("message.Email")); ?></label>
                                 <input
                                    type="email"
                                    required
                                    class="form-control"
                                    id="email"
                                    placeholder='<?php echo e(__("message.Enter Email Address")); ?>'
                                    parsley-type="email"
                                    value="<?php echo e(isset($_COOKIE['email'])?$_COOKIE['email']:'admin@gmail.com'); ?>"
                                    name="email"
                                    />
                              </div>
                              <div class="form-group">
                                 <label for="password"><?php echo e(__("message.Password")); ?></label>
                                 <input type="password" required class="form-control" id="password" name="password" placeholder='<?php echo e(__("message.Enter password")); ?>' value="<?php echo e(isset($_COOKIE['password'])?$_COOKIE['password']:'123'); ?>" />
                              </div>
                              <div class="custom-control custom-checkbox">
                                 <?php if(isset($_COOKIE['rem_me'])): ?>
                                 <input type="checkbox" class="custom-control-input" id="auth-remember-check" value="1" name="remember_me" checked />
                                 <?php else: ?>
                                 <input type="checkbox" class="custom-control-input" id="auth-remember-check" value="1" name="remember_me" />
                                 <?php endif; ?>
                                 <label class="custom-control-label" for="auth-remember-check"><?php echo e(__('message.Remember me')); ?></label>
                              </div>
                              <div class="mt-3 text-right">
                                 <button class="btn btn-primary w-sm waves-effect waves-light" type="submit"><?php echo e(__('message.Log In')); ?></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="mt-5 text-center">
                     <p>© <?php echo e(date('Y')); ?> <?php echo e(__("message.System Name")); ?> <i class="mdi mdi-heart text-danger"></i> <?php echo e(__("message.by Admin Panel")); ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/jquery/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/node-waves/waves.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/waypoints/lib/jquery.waypoints.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/js/app.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/parsleyjs/parsley.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/js/pages/form-validation.init.js')); ?>"></script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\doctor\resources\views/admin/login.blade.php ENDPATH**/ ?>