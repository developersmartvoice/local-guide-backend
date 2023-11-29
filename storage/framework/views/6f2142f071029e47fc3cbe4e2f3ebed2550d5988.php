<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <title><?php echo $__env->yieldContent('title'); ?></title>
      <?php echo $__env->yieldContent('meta-data'); ?>
      <link rel="icon" href="<?php echo e(asset('public/front_pro/assets/images/favicon.ico')); ?>" type="image/x-icon">
      <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/font-awesome-all.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/flaticon.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/owl.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/bootstrap.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/jquery.fancybox.min.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/animate.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/color.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/jquery-ui.css')); ?>" rel="stylesheet">


      <link href="<?php echo e(asset('public/front_pro/assets/css/timePicker.css')); ?>" rel="stylesheet">
     
      <?php if($setting->is_rtl=='1'): ?>
          <link href="<?php echo e(asset('public/front_pro/assets/css/rtl.css?v=232')); ?>" rel="stylesheet">
          <style>
              .fr{
                float: right;
            }
            .fl{
                float: left;
            }
          </style>
      <?php else: ?>

      <?php endif; ?>
       <link href="<?php echo e(asset('public/front_pro/assets/css/style.css?v=2324')); ?>" rel="stylesheet">


       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.css">
       
      <link href="<?php echo e(asset('public/front_pro/assets/css/responsive.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('public/front_pro/assets/css/monthly.css')); ?>" rel="stylesheet">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=<?php echo e(Config::get("mapdetail.key")); ?>&sensor=false&libraries=places'></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <style>
          .light{
                color:gray;
            }
            
      </style>
      
   </head>
   <body>
      <?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php if($setting->is_rtl=='1'): ?>
      <div class="boxed_wrapper rtl">
         <?php else: ?>
            <div class="boxed_wrapper">
         <?php endif; ?>
         <div class="preloader"></div>
         <header class="main-header style-two">
            <div class="header-top">
               <div class="auto-container">
                  <div class="top-inner clearfix">
                     <div class="top-left pull-left">
                        <ul class="info clearfix">
                           <li><i class="fas fa-map-marker-alt"></i><?php echo e($setting->address); ?></li>
                           <li><i class="fas fa-phone"></i><a href="tel:<?php echo e($setting->phone); ?>"><?php echo e($setting->phone); ?></a></li>
                        </ul>
                     </div>
                     <div class="top-right pull-right">
                        <ul class="info clearfix">
                           <?php if(Session::has("user_id")): ?>
                           <li><a href="<?php echo e(url('logout')); ?>"><?php echo e(__('message.Logout')); ?></a></li>
                           <?php else: ?>
                           <li><a href="<?php echo e(url('patientlogin')); ?>"><?php echo e(__('message.Sign in')); ?></a></li>
                           <li></li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header-lower">
               <div class="auto-container">
                  <div class="outer-box">
                     <div class="logo-box">
                        <figure class="logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('public/image_web/').'/'.$setting->logo); ?>" alt=""></a></figure>
                     </div>
                     <div class="menu-area">
                        <div class="mobile-nav-toggler">
                           <i class="icon-bar"></i>
                           <i class="icon-bar"></i>
                           <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                           <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                              <ul class="navigation clearfix">
                                 <li class="" id="home"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Home')); ?></a></li>
                                 <li class="" id="home"><a href="<?php echo e(url('aboutus')); ?>"><?php echo e(__('message.About Us')); ?></a></li>
                                 <li class="" id="home"><a href="<?php echo e(url('viewspecialist')); ?>"><?php echo e(__('message.Specialist')); ?></a></li>
                                 <li class="" id="home"><a href="<?php echo e(url('searchdoctor')); ?>"><?php echo e(__('message.Doctors')); ?></a></li>
                                 <li class="" id="home"><a href="<?php echo e(url('contactus')); ?>"><?php echo e(__('message.Contact Us')); ?></a></li>
                                 <li class="my-account-button" id="home">
                                    <?php if(empty(Session::get("user_id"))): ?>
                                    <a href="<?php echo e(url('doctorlogin')); ?>"><?php echo e(__('message.Join As Doctor')); ?></a>
                                    <?php else: ?>
                                    <?php if(Session::get("user_id")!=""&&Session::get("role_id")==1): ?>
                                    <a href="<?php echo e(url('userdashboard')); ?>"><?php echo e(__('message.My Dashboard')); ?></a>
                                    <?php else: ?>
                                    <a href="<?php echo e(url('doctorlogin')); ?>"><?php echo e(__('message.My Dashboard')); ?></a>
                                    <?php endif; ?>                                 
                                    <?php endif; ?>
                                 </li>
                              </ul>
                           </div>
                        </nav>
                     </div>
                     <div class="btn-box">
                        <?php if(empty(Session::get("user_id"))): ?>
                        <a href="<?php echo e(url('doctorlogin')); ?>" class="theme-btn-one"><i class="icon-image"></i><?php echo e(__('message.Join As Doctor')); ?></a>
                        <?php else: ?>
                        <?php if(Session::get("user_id")!=""&&Session::get("role_id")==1): ?>
                        <a href="<?php echo e(url('userdashboard')); ?>" class="theme-btn-one"><?php echo e(__('message.My Dashboard')); ?></a>
                        <?php else: ?>
                        <a href="<?php echo e(url('doctorlogin')); ?>" class="theme-btn-one"><?php echo e(__('message.My Dashboard')); ?></a>
                        <?php endif; ?>                                 
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sticky-header">
               <div class="auto-container">
                  <div class="outer-box">
                     <div class="logo-box">
                        <figure class="logo"><a href="<?php echo e(url('/')); ?>">
                           <img src="<?php echo e(asset('public/image_web/').'/'.$setting->logo); ?>" alt=""></a></figure>
                     </div>
                     <div class="menu-area">
                        <nav class="main-menu clearfix">
                        </nav>
                     </div>
                     <div class="btn-box">
                        <?php if(empty(Session::get("user_id"))): ?>
                        <a href="<?php echo e(url('doctorlogin')); ?>" class="theme-btn-one"><i class="icon-image"></i><?php echo e(__('message.Join As Doctor')); ?></a>
                        <?php else: ?>
                        <?php if(Session::get("user_id")!=""&&Session::get("role_id")==1): ?>
                        <a href="<?php echo e(url('userdashboard')); ?>" class="theme-btn-one"><?php echo e(__('message.My Dashboard')); ?></a>
                        <?php else: ?>
                        <a href="<?php echo e(url('doctorlogin')); ?>" class="theme-btn-one"><?php echo e(__('message.My Dashboard')); ?></a>
                        <?php endif; ?>                                 
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>
            <nav class="menu-box">
               <div class="nav-logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('public/image_web/').'/'.$setting->logo); ?>" alt="" title=""></a></div>
               <div class="menu-outer"></div>
               <div class="contact-info">
                  <h4><?php echo e(__('message.Contact Info')); ?></h4>
                  <ul>
                     <li><?php echo e($setting->address); ?></li>
                     <li><a href="tel:<?php echo e($setting->phone); ?>"><?php echo e($setting->phone); ?></a></li>
                     <li><a href="mailto:<?php echo e($setting->email); ?>"><?php echo e($setting->email); ?></a></li>
                  </ul>
               </div>
               <div class="social-links">
                  <ul class="clearfix">
                     <li><a href="<?php echo e(url('/')); ?>"><span class="fab fa-twitter"></span></a></li>
                     <li><a href="<?php echo e(url('/')); ?>"><span class="fab fa-facebook-square"></span></a></li>
                     <li><a href="<?php echo e(url('/')); ?>"><span class="fab fa-pinterest-p"></span></a></li>
                     <li><a href="<?php echo e(url('/')); ?>"><span class="fab fa-instagram"></span></a></li>
                     <li><a href="<?php echo e(url('/')); ?>"><span class="fab fa-youtube"></span></a></li>
                  </ul>
               </div>
            </nav>
         </div>
         <?php echo $__env->yieldContent('content'); ?>
         <footer class="main-footer">
            <div class="footer-top">
               <div class="pattern-layer">
                  <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-30.png')); ?>');"></div>
                  <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-31.png')); ?>');"></div>
               </div>
               <div class="auto-container">
                  <div class="widget-section">
                     <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                           <div class="footer-widget logo-widget">
                              <figure class="footer-logo"><a href="<?php echo e(url('/')); ?>">
                                 <img src="<?php echo e(asset('public/image_web/').'/'.$setting->logo); ?>" alt=""></a></figure>
                              <div class="text">
                                 <p><?php echo e(__('message.Footer Content')); ?></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                           <div class="footer-widget links-widget">
                              <div class="widget-title">
                                 <h3><?php echo e(__('message.About')); ?></h3>
                              </div>
                              <div class="widget-content">
                                 <ul class="links clearfix">
                                    <li><a href="<?php echo e(url('aboutus')); ?>"><?php echo e(__('message.About Us')); ?></a></li>
                                    <li><a href="<?php echo e(url('contactus')); ?>"><?php echo e(__('message.Contact Us')); ?></a></li>
                                    <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Download apps')); ?></a></li>
                                     <li><a href="<?php echo e(url('Privacy-Policy')); ?>"><?php echo e(__('message.Privecy')); ?></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                           <div class="footer-widget links-widget">
                              <div class="widget-title">
                                 <h3><?php echo e(__('message.Useful Links')); ?></h3>
                              </div>
                              <div class="widget-content">
                                 <ul class="links clearfix">
                                    <li><a href="<?php echo e(url('viewspecialist')); ?>"><?php echo e(__('message.Specialist')); ?></a></li>
                                    <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Doctors')); ?></a></li>
                                    <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.Join As Doctor')); ?></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                           <div class="footer-widget contact-widget">
                              <div class="widget-title">
                                 <h3><?php echo e(__('message.Contact Info')); ?></h3>
                              </div>
                              <div class="widget-content">
                                 <ul class="info-list clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i>
                                       <?php echo e($setting->address); ?>

                                    </li>
                                    <li><i class="fas fa-microphone"></i>
                                       <a href="tel:<?php echo e($setting->phone); ?>"><?php echo e($setting->phone); ?></a>
                                    </li>
                                    <li><i class="fas fa-envelope"></i>
                                       <a href="mailto:<?php echo e($setting->email); ?>"><?php echo e($setting->email); ?></a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


            



            <div class="footer-bottom">
               <div class="auto-container">
                  <div class="inner-box clearfix">
                     <div class="copyright pull-left">
                        <p><a href="<?php echo e(url('/')); ?>"><?php echo e(__('message.System Name')); ?></a> &copy; <?php echo e(date('Y')); ?> <?php echo e(__('message.All Right Reserved')); ?></p>
                     </div>
                     <ul class="footer-nav pull-right clearfix">
                     </ul>
                  </div>
               </div>
            </div>
         </footer>
         <button class="scroll-top scroll-to-target" data-target="html">
         <span class="fa fa-arrow-up"></span>
         </button>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <input type="hidden" id="currentuserlat">
      <input type="hidden" id="currentuserlong">
      <input type="hidden" id="doctornotavilable" value='<?php echo e(__("message.Doctor isnot Avilable")); ?>'>
      <input type="hidden" id="contactsuccssmsg" value="<?php echo e(__('message.Thank you for getting in touch!')); ?>">
      <input type="hidden" id="successlabel" value="<?php echo e(__('message.Success')); ?>">
      <input type="hidden" id="Errorlabel" value="<?php echo e(__('message.Error')); ?>">
      <input type="hidden" id="emailinvaildlabel" value="<?php echo e(__('message.You have entered an invalid email address')); ?>">
      <input type="hidden" id="siteurl" value="<?php echo e(url('/')); ?>">
      <input type="hidden" id="pwdmatch" value="<?php echo e(__('message.Password And Confirm Password Must Be Same')); ?>">
      <input type="hidden" id="currentpwdwrong" value="<?php echo e(__('message.Current Password is Wrong')); ?>">
      <input type="hidden" id="start1val" value='<?php echo e(__("message.Please Select Start Time First")); ?>'>
      <input type="hidden" id="loginmsg" value="<?php echo e(__('message.To book appointment you must login first, please proceed with login now.')); ?>">
<input type="hidden" id="sge" value='<?php echo e(__("message.Start Time is greater than end time")); ?>'>
<input type="hidden" id="sequale" value='<?php echo e(__("message.Start Time equals end time")); ?>'>
<input type="hidden" id="selduration" value='<?php echo e(__("message.Please Select Any Duration")); ?>'>
<input type="hidden" id="startvaltext" value='<?php echo e(__("message.Start Time")); ?>'>
<input type="hidden" id="endvaltext" value='<?php echo e(__("message.End Time")); ?>'>
<input type="hidden" id="durationval" value='<?php echo e(__("message.Duration")); ?>'>
<input type="hidden" id="delete_record" value="<?php echo e(__('message.delete_record')); ?>"/>
<input type="hidden" id="seldurationval" value='<?php echo e(__("message.Select Duration")); ?>'>
<input type="hidden" id="deletetext" value='<?php echo e(__("message.delete")); ?>'>
      <script src="<?php echo e(asset('public/front_pro/assets/js/jquery.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/popper.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/popper.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/owl.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/wow.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/validation.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/jquery.fancybox.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/appear.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/scrollbar.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/tilt.jquery.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/jquery.paroller.min.js')); ?>"></script>
      <script src="<?php echo e(asset('public/js/locationpicker.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/script.js')); ?>"></script>
 
      <script src="<?php echo e(asset('public/front_pro/assets/js/product-filter.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/jquery-ui.js')); ?>"></script>


      <script src="<?php echo e(asset('public/front_pro/assets/js/timePicker.js')); ?>"></script>


      <script src="<?php echo e(asset('public/front_pro/assets/js/gmaps.js')); ?>"></script>
      <script src="<?php echo e(asset('public/front_pro/assets/js/map-helper.js')); ?>"></script>
      <!-- <script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>


      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.js"></script>
     <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css"> 
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
         <script type="text/javascript" src="<?php echo e(asset('public/js/code.js?v=1.2312')); ?>"></script>

      </script>
      <?php echo $__env->yieldContent('footer'); ?>
      <script>
         if (navigator.geolocation) {
             navigator.geolocation.getCurrentPosition(showPosition);
         } else { 
             x.innerHTML = "Geolocation is not supported by this browser.";
         }    
         function showPosition(position) {
             console.log(position);
             $("#currentuserlat").val(position.coords.latitude);
             $("#currentuserlong").val(position.coords.longitude);
           
         }

         window.laravelCookieConsent = (function () {

            const COOKIE_VALUE = 1;
            const COOKIE_DOMAIN = 'https://demo.freaktemplate.com/';

            function consentWithCookies() {
                setCookie('laravel_cookie_consent', COOKIE_VALUE, 7300);
                hideCookieDialog();
            }

            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    // + ';domain=' + COOKIE_DOMAIN
                    + ';path=/'
                    + '';
            }

            if (cookieExists('laravel_cookie_consent')) {
                hideCookieDialog();
            }

            const buttons = document.getElementsByClassName('js-cookie-consent-agree');

            for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
      </script>
   </body>
</html><?php /**PATH /home/ubnzxmjc/localguide/resources/views/user/layout.blade.php ENDPATH**/ ?>