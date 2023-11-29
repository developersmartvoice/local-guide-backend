
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Setting")); ?> | <?php echo e(__("message.Admin")); ?>  
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
               <h4 class="mb-0"><?php echo e(__("message.Setting")); ?></h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item active"><?php echo e(__("message.Setting")); ?></li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
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
                  <h4 class="card-title mb-4"><?php echo e(__("message.Setting")); ?></h4>
                  <div id="vertical-nav-wizard" class="twitter-bs-wizard verti-nav-wizard">
                     <div class="row">
                        <div class="col-xl-3 col-sm-4">
                           <ul class="twitter-bs-wizard-nav nav nav-pills flex-column">
                              <li class="nav-item">
                                 <a href="#verti-nav-admin-details" class="nav-link" data-toggle="tab">
                                 <span class="step-number mr-2">01</span>
                                  Admin <?php echo e(__("message.Basic Details")); ?>

                                 </a>
                              </li>
                               <?php if(env('IS_FORNT')=="1")
                              {
                                 ?>
                                 <li class="nav-item">
                                    <a href="#verti-nav-seller-details" class="nav-link active" data-toggle="tab">
                                    <span class="step-number mr-2">02</span>
                                    Fornt <?php echo e(__("message.Basic Details")); ?>

                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="#verti-nav-company-document" class="nav-link" data-toggle="tab">
                                    <span class="step-number mr-2">03</span>
                                    <span><?php echo e(__("message.Upload Section")); ?></span>
                                    </a>
                                 </li>
                              <?php
                           }?>
                              <!--<li class="nav-item">
                                 <a href="#verti-nav-payment-keys" class="nav-link" data-toggle="tab">
                                 <span class="step-number mr-2">03</span>
                                 <span><?php echo e(__("message.Payments Keys")); ?></span>
                                 </a>
                              </li>-->
                              
                           </ul>
                        </div>
                        <div class="col-xl-9 col-sm-8">
                           <div class="tab-content twitter-bs-wizard-tab-content px-sm-3 pt-sm-0">
                              <div class="tab-pane active" id="verti-nav-seller-details">
                                 <form action="<?php echo e(url('admin/updatesettingone')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>  
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="verti-nav-phoneno-input"><?php echo e(__("message.Phone")); ?></label>
                                             <input type="text" required name="phone" value="<?php echo e(isset($data->phone)?$data->phone:''); ?>" class="form-control" id="verti-nav-phoneno-input">
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="verti-nav-email-input">Email</label>
                                             <input type="email" required="" name="email" value="<?php echo e(isset($data->email)?$data->email:''); ?>" class="form-control" id="verti-nav-email-input">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="form-group">
                                             <label for="verti-nav-address-input"><?php echo e(__("message.Address")); ?></label>
                                             <textarea id="verti-nav-address-input" required name="address" id="address"  class="form-control" rows="2"> <?php echo e(isset($data->address)?$data->address:''); ?></textarea>
                                          </div>
                                       </div>
                                    </div>
                                   
                                    <div class="form-group">
                                       <label for="verti-nav-phoneno-input"><?php echo e(__("message.App Store URL")); ?></label>
                                       <input type="text" required name="app_url" value="<?php echo e(isset($data->app_url)?$data->app_url:''); ?>" class="form-control" id="verti-nav-phoneno-input">
                                    </div>
                                    <div class="form-group">
                                       <label for="verti-nav-phoneno-input"><?php echo e(__("message.Play Store URL")); ?></label>
                                       <input type="text" required name="playstore_url" value="<?php echo e(isset($data->playstore_url)?$data->playstore_url:''); ?>" class="form-control" id="verti-nav-phoneno-input">
                                    </div>
                                    
                                    <div class="mt-4">
                                       <button type="submit" class="btn btn-primary w-md"><?php echo e(__("message.Submit")); ?></button>
                                    </div>
                                 </form>
                              </div>
                              <div class="tab-pane" id="verti-nav-company-document">
                                 <div>
                                    <form action="<?php echo e(url('admin/updatesettingtwo')); ?>" method="post" enctype="multipart/form-data">
                                       <?php echo e(csrf_field()); ?>  
                                       <div class="form-group">
                                          <label for="verti-nav-pancard-input"><?php echo e(__("message.Main Banner")); ?></label>
                                          <?php if(isset($data->main_banner)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->main_banner); ?>" style="width: 150px;height: 150px">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="main_banner">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="main_banner" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>    
                                       </div>
                                       <div class="form-group">
                                          <label for="verti-nav-vatno-input"><?php echo e(__("message.Favicon")); ?></label>
                                          <?php if(isset($data->favicon)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->favicon); ?>">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="favicon">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="favicon" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>   
                                       </div>
                                       <div class="form-group">
                                          <label for="verti-nav-cstno-input"><?php echo e(__("message.LOGO")); ?></label>
                                          <?php if(isset($data->logo)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->logo); ?>" style="width: 250px;">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="logo">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="logo" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>   
                                       </div>
                                       <div class="form-group">
                                          <label for="verti-nav-servicetax-input"><?php echo e(__("message.App Banner")); ?></label>
                                          <?php if(isset($data->app_banner)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->app_banner); ?>" style="width: 250px;">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="app_banner">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="app_banner" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>   
                                       </div>
                                       <div class="form-group">
                                          <label for="verti-nav-companyuin-input"><?php echo e(__("message.Appointment Process Icon 1")); ?></label>
                                          <?php if(isset($data->icon1)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->icon1); ?>" style="width: 250px;">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="icon1">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="icon1" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>
                                       </div>
                                       <div class="form-group">
                                          <label for="verti-nav-declaration-input"><?php echo e(__("message.Appointment Process Icon 2")); ?></label>
                                          <?php if(isset($data->icon2)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->icon2); ?>" style="width: 250px;">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="icon2">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="icon2" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>
                                       </div>
                                       <div class="form-group">
                                          <label for="verti-nav-declaration-input"><?php echo e(__("message.Appointment Process Icon 3")); ?></label>
                                          <?php if(isset($data->icon3)): ?>
                                          <img src="<?php echo e(asset('public/image_web').'/'.$data->icon3); ?>" style="width: 250px;">
                                          <input type="file" class="form-control" id="verti-nav-pancard-input"  name="icon3">
                                          <?php else: ?>
                                          <input type="file" class="form-control" name="icon3" id="verti-nav-pancard-input" required="">
                                          <?php endif; ?>
                                       </div>
                                       <div class="mt-4">
                                          <?php if(Session::get("is_demo")=='0'): ?>
                                          <button type="button" onclick="disablebtn()" class="btn btn-primary"><?php echo e(__('message.Submit')); ?></button>
                                          <?php else: ?>
                                          <button  class="btn btn-primary" type="submit" value="Submit"><?php echo e(__("message.Submit")); ?></button>
                                          <?php endif; ?> 
                                    </form>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane" id="verti-nav-payment-keys">
                                 <div>
                                    <form action="<?php echo e(url('admin/updatesettingtwo')); ?>" method="post" enctype="multipart/form-data">
                                       <?php echo e(csrf_field()); ?>  
                                       <?php if(Session::has('message')): ?>
                                       <div class="col-sm-12">
                                          <div class="alert  <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show" role="alert"><?php echo e(Session::get('message')); ?>

                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                       </div>
                                       <?php endif; ?>
                                       <div id="pay-invoice">
                                          <div class="card-body">
                                    <form action="<?php echo e(route('store_keys')); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="cmr1"> 
                                          dfds
                                    </div>
                                    </form>
                                    </div>
                                    </div>
                                    <div class="mt-4">
                                       <?php if(Session::get("is_demo")=='0'): ?>
                                       <button type="button" onclick="disablebtn()" class="btn btn-primary"><?php echo e(__('message.Submit')); ?></button>
                                       <?php else: ?>
                                       <button  class="btn btn-primary" type="submit" value="Submit"><?php echo e(__("message.Submit")); ?></button>
                                       <?php endif; ?> 
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane active" id="verti-nav-admin-details">
                                 <form action="<?php echo e(url('admin/updatesettingfour')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>  
                                    
                                    <div class="form-group">
                                       <label for="verti-nav-phoneno-input"><?php echo e(__("message.Commission")); ?></label>
                                       <input type="number" required name="commission" value="<?php echo e(isset($data->commission)?$data->commission:''); ?>" class="form-control" id="verti-nav-phoneno-input" min="1" step="0.01" max="100">
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="name" class=" form-control-label">
                                       <?php echo e(__('message.timezone')); ?>

                                       <span class="reqfield">*</span>
                                       </label>
                                       <select class="form-control" name="timezone" id="timezone" required="">
                                          <option value=""><?php echo e(__('messages.select_timezone')); ?></option>
                                          <?php $__currentLoopData = $timezone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tz=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($tz); ?>" <?=$data->timezone ==$tz ? ' selected="selected"' : '';?>><?php echo e($value); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="name" class=" form-control-label">
                                       <?php echo e(__('message.currency')); ?>

                                       <span class="reqfield">*</span>
                                       </label>
                                       <select class="form-control" name="currency" id="currency" required="">
                                          <option value="<?php echo e($data->currency); ?>" selected><?php echo e($data->currency); ?></option>
                                          <?php echo $__env->make('admin.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="formrow-customCheck" name="doctor_approved" value="1" <?=isset($data->doctor_approved)&&$data->doctor_approved=='1'?'checked="checked"':""?> >
                                          <label class="custom-control-label" for="formrow-customCheck"><?php echo e(__("message.You Need To Approve Doctors Profile")); ?></label>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="formrow-customCheck11" <?=isset($data->is_rtl)&&$data->is_rtl=='1'?'checked="checked"':""?> name="is_rtl" value="2">
                                          <label class="custom-control-label" for="formrow-customCheck11"><?php echo e(__("message.Is RTL")); ?></label>
                                       </div>
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
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/setting.blade.php ENDPATH**/ ?>