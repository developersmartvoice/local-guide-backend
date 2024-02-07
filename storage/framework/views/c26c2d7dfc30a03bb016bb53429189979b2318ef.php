<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title><?php echo $__env->yieldContent('title'); ?></title>
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
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/dropzone/min/dropzone.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="shortcut icon" href="<?php echo e(Session::get('favicon')); ?>" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/twitter-bootstrap-wizard/prettify.css')); ?>" />
      <?php if(__("message.RTL")==0): ?>
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/app-rtl.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
      <?php else: ?>
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
      <?php endif; ?>
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" />
      <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=<?php echo e(Config::get("mapdetail.key")); ?>&sensor=false&libraries=places'></script>
   </head>
   <body>
      <div id="layout-wrapper">
         <header id="page-topbar">
            <div class="navbar-header">
               <div class="d-flex">
                  <div class="navbar-brand-box">
                     <a href="<?php echo e(url('admin/dashboard')); ?>" class="logo logo-dark">
                     <span class="logo-sm">
                     <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="22" />
                     </span>
                     <span class="logo-lg">
                     <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="20" />
                     </span>
                     </a>
                     <a href="<?php echo e(url('admin/dashboard')); ?>" class="logo logo-light">
                     <span class="logo-sm">
                     <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="22" />
                     </span>
                     <span class="logo-lg">
                     <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="20" />
                     </span>
                     </a>
                  </div>
                  <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                  <i class="fa fa-fw fa-bars"></i>
                  </button>
                 
               </div>
               <div class="d-flex">
                  <div class="dropdown d-none d-lg-inline-block ml-1">
                     <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                     <i class="uil-minus-path"></i>
                     </button>
                  </div>
                  <div class="dropdown d-inline-block">
                     <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" id="bell-button" aria-haspopup="true" aria-expanded="false">
                     <i class="uil-bell"></i>
                     <span class="badge badge-danger badge-pill" id="ordercount">0</span>
                     </button>
                     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown" id="notificationshow">
                        <div class="p-3">
                           <div class="row align-items-center">
                              <div class="col">
                                 <p class="red" id="notificationmsg"></p>
                              </div>
                           </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;"></div>
                        <div class="p-2 border-top"></div>
                     </div>
                  </div>
                  <div class="dropdown d-inline-block">
                     <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="rounded-circle header-profile-user" src="<?php echo e(asset('public/upload/profile/').'/'.Sentinel::getUser()->profile_pic); ?>" alt="Header Avatar" />
                     <span class="d-none d-xl-inline-block ml-1 font-weight-medium font-size-15"><?php echo e(Session::get("username")); ?></span>
                     <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo e(url('admin/editprofile')); ?>"><i class="uil uil-user-circle font-size-18 align-middle text-muted mr-1"></i> <span class="align-middle"><?php echo e(__("message.View Profile")); ?></span></a>
                        <a class="dropdown-item" href="<?php echo e(url('admin/changepassword')); ?>"><i class="mdi mdi-key font-size-18 align-middle text-muted mr-1"></i> <span class="align-middle"><?php echo e(__("message.Change Password")); ?></span></a>
                        <a class="dropdown-item" href="<?php echo e(url('admin/setting')); ?>"><i class="uil uil-sliders-v-alt font-size-18 align-middle text-muted mr-1"></i> <span class="align-middle"><?php echo e(__("message.Setting")); ?></span></a>
                        <a class="dropdown-item" href="<?php echo e(url('admin/logout')); ?>"><i class="uil uil-sign-out-alt font-size-18 align-middle mr-1 text-muted"></i> <span class="align-middle"><?php echo e(__("message.Sign out")); ?></span></a>
                     </div>
                  </div>
                  <div class="dropdown d-inline-block"></div>
               </div>
            </div>
         </header>
         <div class="vertical-menu">
            <div class="navbar-brand-box">
               <a href="<?php echo e(url('admin/dashboard')); ?>" class="logo logo-dark">
               <span class="logo-sm">
               <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="22" />
               </span>
               <span class="logo-lg">
               <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="20" />
               </span>
               </a>
               <a href="<?php echo e(url('admin/dashboard')); ?>" class="logo logo-light">
               <span class="logo-sm">
               <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="22" />
               </span>
               <span class="logo-lg">
               <img src="<?php echo e(Session::get('logo')); ?>" alt="" height="20" />
               </span>
               </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
            </button>
            <div data-simplebar class="sidebar-menu-scroll">
               <div id="sidebar-menu">
                  <ul class="metismenu list-unstyled" id="side-menu">
                     <li class="menu-title"><?php echo e(__("message.Menu")); ?></li>
                     <li>
                        <a href="<?php echo e(url('admin/dashboard')); ?>">
                        <i class="uil-home-alt"></i><span class="badge badge-pill badge-primary float-right"></span>
                        <span><?php echo e(__("message.Dashboard")); ?></span>
                        </a>
                     </li>
                     <li class="menu-title"><?php echo e(__("message.Appointment")); ?></li>
                     <li>
                        <a href="<?php echo e(url('admin/appointment')); ?>" class="waves-effect">
                        <i class="uil-shutter-alt"></i>
                        <span><?php echo e(__("message.Appointment")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/doctors')); ?>" class="waves-effect">
                        <i class="uil-flask"></i>
                        <span><?php echo e(__("message.Doctors")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/patients')); ?>" class="waves-effect">
                        <i class="uil-file-alt"></i>
                        <span><?php echo e(__('message.Patients')); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/services')); ?>" class="waves-effect">
                        <i class="uil-adjust-alt"></i>
                        <span><?php echo e(__("message.Department")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/banner')); ?>" class="waves-effect">
                        <i class="uil-image"></i>
                        <span><?php echo e(__("message.banner")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/reviews')); ?>" class="waves-effect">
                        <i class="uil-star"></i>
                        <span><?php echo e(__("message.Review")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/complain')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.complain")); ?></span>
                        </a>
                     </li>
                      <?php if(env('IS_FORNT')=="1")
                     {
                        ?>
                      <li>
                        <a href="<?php echo e(url('admin/contact_list')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Contact")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/news')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.News")); ?></span>
                        </a>
                     </li>
                      <?php
                     }?>
                     <li class="menu-title"><?php echo e(__("message.Privecy")); ?></li>
                     <li>
                        <a href="<?php echo e(url('admin/about')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.About")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/Terms_condition')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.term")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/app_privacy')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Privecy")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/data_deletion')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Data-Deletion")); ?></span>
                        </a>
                     </li>
                     
                     <li class="menu-title">Reports</li>
                     <li>
                        <a href="<?php echo e(route('doctor_report')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span>Doctors </span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(route('user_report')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span>User </span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(route('do_sub_report')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span>Doctor Subscription </span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(route('app_book_report')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span>Appointment booked </span>
                        </a>
                     </li>
                     
                     <li class="menu-title"><?php echo e(__("message.Payment")); ?></li>
                     <li>
                        <a href="<?php echo e(url('admin/pending_payment')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Pending Payment")); ?></span>
                        </a>
                     </li>
                      <?php if(env('IS_FORNT')=="1")
                     {
                        ?>
                       <li>
                        <a href="<?php echo e(route('Subscription')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Subscription")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/subscriber_doc')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Subscriber")); ?></span>
                        </a>
                     </li>
                      <?php
                     }?>
                      <li>
                        <a href="<?php echo e(url('admin/complete_payment')); ?>" class="waves-effect">
                        <i class="uil-invoice"></i>
                        <span><?php echo e(__("message.Complete Payment")); ?></span>
                        </a>
                     </li>
                     <li class="menu-title"><?php echo e(__("message.Notification")); ?></li>
                     <li>
                        <a href="<?php echo e(url('admin/sendnotification')); ?>" class="waves-effect">
                        <i class="uil-snapchat-ghost"></i>
                        <span><?php echo e(__("message.Send Notification")); ?></span>
                        </a>
                     </li>
                     <li>
                        <a href="<?php echo e(url('admin/notificationkey')); ?>" class="waves-effect">
                        <i class="uil-key-skeleton-alt"></i>
                        <span><?php echo e(__("message.Notification Key")); ?></span>
                        </a>
                     </li>
                      <?php if(env('IS_FORNT')=="1")
                     {
                        ?>
                     <li>
                        <a href="<?php echo e(route('payment-setting')); ?>" class="waves-effect">
                        <i class="uil-key-skeleton-alt"></i>
                        <span><?php echo e(__("message.Payment Gateway")); ?></span>
                        </a>
                     </li>
                      <?php
                     }?>
                     
                  </ul>
               </div>
            </div>
         </div>
         <?php echo $__env->yieldContent('content'); ?>
         <footer class="footer">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-6">
                     <?php echo e(date('Y')); ?>

                     © <?php echo e(__("message.System Name")); ?>

                  </div>
                  <div class="col-sm-6">
                     <div class="text-sm-right d-none d-sm-block">
                        <i class="mdi mdi-heart text-danger"></i> <?php echo e(__("message.by")); ?> <a href="https://themesbrand.com/" target="_blank" class="text-reset"><?php echo e(__("message.System Name")); ?></a>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
      </div>
   </div>
      <div class="rightbar-overlay"></div>
      <input type="hidden" id="siteurl" value="<?php echo e(url('admin')); ?>" />
      <input type="hidden" id="delete_record" value="<?php echo e(__('message.delete_record')); ?>">
      <input type="hidden" id="today_no_appointment_msg" value='<?php echo e(__("message.You dont have any  appointments for today")); ?>'/>
      <input type="hidden" id="demo" value="<?php echo e(Session::get('is_demo')); ?>"/>
      <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
      <input type="hidden" id="soundnotify" value="<?php echo e(asset('public/sound/notification/notification.mp3')); ?>" />
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/jquery/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/node-waves/waves.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/waypoints/lib/jquery.waypoints.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/dropzone/min/dropzone.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/js/app.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
      <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/jszip/jszip.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/pdfmake/build/pdfmake.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/pdfmake/build/vfs_fonts.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/js/pages/datatables.init.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/select2/js/select2.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/js/pages/ecommerce-add-product.init.js')); ?>"></script>
      <script src="<?php echo e(url('public/js/locationpicker.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('public/js/admin.js?v=rgtrygr')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/libs/twitter-bootstrap-wizard/prettify.js')); ?>"></script>
      <script src="<?php echo e(asset('public/admin_design/layouts/vertical/assets/js/pages/form-wizard.init.js')); ?>"></script>
      <script>
          function disablebtn(){
                alert("This Action Disable In Demo");
            }
      </script>
      <?php echo $__env->yieldContent('footer'); ?>
   </body>
</html><?php /**PATH C:\xampp\htdocs\doctor\resources\views/admin/layout.blade.php ENDPATH**/ ?>