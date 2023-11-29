
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Payment Gateway Setting")); ?>

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
                  <h4 class="mb-0"><?php echo e(__("message.Payment Gateway Setting")); ?> </h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?php echo e(__("message.Payment Gateway Setting")); ?> </li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
          <div class="col-12 col-sm-9">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link <?= Session::get("payment_next")=='1'?'active':''?>" id="custom-tabs-one-home-tab" data-toggle="pill" href="#pay1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">BrainTree</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= Session::get("payment_next")=='2'?'active':''?>" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#pay2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Razor Pay</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= Session::get("payment_next")=='3'?'active':''?>" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#pay3" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">PayStack</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= Session::get("payment_next")=='4'?'active':''?>" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#pay4" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Paytm</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link <?= Session::get("payment_next")=='5'?'active':''?>" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#pay5" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Flutter Wave</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade <?= Session::get("payment_next")=='1'?'active show':''?>" id="pay1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                      <form action="<?php echo e(route('updategateway')); ?>" method="post">
                        <input type="hidden" name="payment_gateway" value="braintree">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                               <label for="environment"><?php echo e(__("message.environment")); ?><span class="reqfield">*</span></label>
                               <select name="environment" id="environment" class="form-control" required="">
                                   <option value="sandbox" <?= isset($arr['braintree_environment'])&&$arr['braintree_environment']=='local'?"selected='selected'":''?> ><?php echo e(__("message.sandbox")); ?></option>
                                   <option value="production" <?= isset($arr['braintree_environment'])&&$arr['braintree_environment']=='production'?"selected='selected'":''?>><?php echo e(__("message.Production")); ?></option>
                               </select>
                            </div>
                            <div class="form-group col-md-6">
                               <label for="merchant_id"><?php echo e(__("message.Merchant ID")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="merchant_id" name="merchant_id" class="form-control" required="" placeholder="<?php echo e(__('message.Enter BrainTree Merchant ID')); ?>" value="<?php echo e(isset($arr['braintree_merchant_id'])?$arr['braintree_merchant_id']:''); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                               <label for="public_key"><?php echo e(__("message.Public Key")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="public_key" name="public_key" class="form-control" required="" placeholder="<?php echo e(__('message.Enter BrainTree Public Key')); ?>" value="<?php echo e(isset($arr['braintree_public_key'])?$arr['braintree_public_key']:''); ?>">
                            </div>
                            <div class="form-group col-md-6">
                               <label for="private_key"><?php echo e(__("message.Private Key")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="private_key" name="private_key" class="form-control" required="" placeholder="<?php echo e(__('message.Enter BrainTree Private Key')); ?>" value="<?php echo e(isset($arr['braintree_private_key'])?$arr['braintree_private_key']:''); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                               <label for="tokenization_key"><?php echo e(__("message.tokenization key")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="tokenization_key" name="tokenization_key" class="form-control" required="" placeholder="<?php echo e(__('message.Enter BrainTree Tokenization Key')); ?>" value="<?php echo e(isset($arr['braintree_tokenization_key'])?$arr['braintree_tokenization_key']:''); ?>">
                            </div>
                              <div class="form-group col-md-6">
                                  <label for="name"><?php echo e(__("message.Is Payment Gateway Is Active")); ?><span class="reqfield">*</span></label>
                                  <select name="is_active" id="is_active" class="form-control" required="">
                                   <option value="1" <?= isset($arr['braintree_is_active'])&&$arr['braintree_is_active']=='1'?"selected='selected'":''?>><?php echo e(__("message.Yes")); ?></option>
                                   <option value="0" <?= isset($arr['braintree_is_active'])&&$arr['braintree_is_active']=='0'?"selected='selected'":''?>><?php echo e(__("message.No")); ?></option>
                                  </select>
                              </div>
                        </div>                       
                        <div class="row">
                           <div class="col-12">      
                              <input type="submit" value='<?php echo e(__("message.submit")); ?>' class="btn btn-success float-right">
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade <?= Session::get("payment_next")=='2'?'active show':''?>" id="pay2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                      <form action="<?php echo e(route('updategateway')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                       <input type="hidden" name="payment_gateway" value="razorpay">
                        <div class="row">
                            <div class="form-group col-md-6">
                               <label for="name"><?php echo e(__("message.Key")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="razorpay_key" name="razorpay_key" class="form-control" required="" placeholder="<?php echo e(__('message.Enter Razorpay Key')); ?>" value="<?php echo e(isset($arr['razorpay_razorpay_key'])?$arr['razorpay_razorpay_key']:''); ?>">
                            </div>
                            <div class="form-group col-md-6">
                               <label for="name"><?php echo e(__("message.Secert")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="razorpay_secert" name="razorpay_secert" class="form-control" required="" placeholder="<?php echo e(__('message.Enter Razorpay Secert')); ?>" value="<?php echo e(isset($arr['razorpay_razorpay_secert'])?$arr['razorpay_razorpay_secert']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                                  <label for="name"><?php echo e(__("message.Is Payment Gateway Is Active")); ?><span class="reqfield">*</span></label>
                                  <select name="is_active" id="is_active" class="form-control" required="">
                                   <option value="1" <?= isset($arr['razorpay_is_active'])&&$arr['razorpay_is_active']=='1'?"selected='selected'":''?>><?php echo e(__("message.Yes")); ?></option>
                                   <option value="0" <?= isset($arr['razorpay_is_active'])&&$arr['razorpay_is_active']=='0'?"selected='selected'":''?> ><?php echo e(__("message.No")); ?></option>
                                  </select>
                        </div>
                        <div class="row">
                           <div class="col-12">      
                              <input type="submit" value='<?php echo e(__("message.submit")); ?>' class="btn btn-success float-right">
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade <?= Session::get("payment_next")=='3'?'active show':''?>" id="pay3" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                     <form action="<?php echo e(route('updategateway')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>  
                        <input type="hidden" name="payment_gateway" value="paystack"> 
                        <input type="hidden" name="paystack_payment_url" value="https://api.paystack.co">  
                        <input type="hidden" name="MERCHANT_EMAIL" value="<?php echo e(Sentinel::getUser()->email); ?>">                  
                        <div class="row">
                            <div class="form-group col-md-6">
                               <label for="name"><?php echo e(__("message.Public Key")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="public_key" name="public_key" class="form-control" required="" placeholder="<?php echo e(__('message.Enter PAYSTACK PUBLIC KEY')); ?>" value="<?php echo e(isset($arr['paystack_public_key'])?$arr['paystack_public_key']:''); ?>">
                            </div>
                            <div class="form-group col-md-6">
                               <label for="name"><?php echo e(__("message.Secert Key")); ?><span class="reqfield">*</span></label>
                               <input type="text" id="secert_key" name="secert_key" class="form-control" required="" placeholder="<?php echo e(__('message.Enter PAYSTACK_SECRET_KEY')); ?>" value="<?php echo e(isset($arr['paystack_secert_key'])?$arr['paystack_secert_key']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                                  <label for="name"><?php echo e(__("message.Is Payment Gateway Is Active")); ?><span class="reqfield">*</span></label>
                                  <select name="is_active" id="is_active" class="form-control" required="">
                                   <option value="1" <?= isset($arr['paystack_is_active'])&&$arr['paystack_is_active']=='1'?"selected='selected'":''?>><?php echo e(__("message.Yes")); ?></option>
                                   <option value="0" <?= isset($arr['paystack_is_active'])&&$arr['paystack_is_active']=='0'?"selected='selected'":''?>><?php echo e(__("message.No")); ?></option>
                                  </select>
                        </div>
                        <div class="row">
                           <div class="col-12">      
                              <input type="submit" value='<?php echo e(__("message.submit")); ?>' class="btn btn-success float-right">
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade <?= Session::get("payment_next")=='4'?'active show':''?>" id="pay4" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     <form action="<?php echo e(route('updategateway')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>  
                        <input type="hidden" name="payment_gateway" value="paytm">
                   <div class="row">
                     <div class="col-md-6">
                        <label for="merchant_id"><?php echo e(__("message.PAYTM MERCHANT ID")); ?> :</label>
                        <input type="text" class="form-control" id="merchant_id" placeholder='<?php echo e(__("message.Enter PAYTM MERCHANT ID")); ?>' name="merchant_id" value="<?php echo e(isset($arr['paytm_merchant_id'])?$arr['paytm_merchant_id']:''); ?>">
                     </div>
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.PAYTM MERCHANT KEY")); ?>:</label>
                        <input type="text" class="form-control" id="merchant_key" placeholder='<?php echo e(__("message.Enter PAYTM MERCHANT KEY")); ?>' name="merchant_key" value="<?php echo e(isset($arr['paytm_merchant_key'])?$arr['paytm_merchant_key']:''); ?>">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.PAYTM MERCHANT WEBSITE")); ?> :</label>
                        <input type="text" class="form-control" id="merchant_website" placeholder="<?php echo e(__('message.Enter PAYTM MERCHANT WEBSITE')); ?>" name="merchant_website" value="<?php echo e(isset($arr['paytm_merchant_website'])?$arr['paytm_merchant_website']:''); ?>">
                     </div>
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.PAYTM ENVIRONMENT")); ?>:</label>
                        <select name="environment" id="environment" class="form-control" required="">
                           <?php $class1 = isset($arr['paytm_is_active'])&&$arr['paytm_is_active'] =="local"?'selected':'';
                                 $class2= isset($arr['paytm_is_active'])&&$arr['paytm_is_active'] =="production"?'selected':'';
                            ?>
                           <option value="local" <?php echo e($class1); ?>><?php echo e(__("message.Local")); ?></option>
                           <option value="production" <?php echo e($class2); ?>><?php echo e(__("message.Production")); ?></option>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.PAYTM CHANNEL")); ?> :</label>
                        <input type="text" class="form-control" id="channel" placeholder='<?php echo e(__("message.Enter PAYTM CHANNEL")); ?>' name="channel"  value="<?php echo e(isset($arr['paytm_channel'])?$arr['paytm_channel']:''); ?>">
                     </div>
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.PAYTM INDUSTRY TYPE")); ?>:</label>
                        <input type="text" class="form-control" id="industry_type" placeholder='<?php echo e(__("message.Enter PAYTM INDUSTRY TYPE")); ?>' name="industry_type" value="<?php echo e(isset($arr['paytm_industry_type'])?$arr['paytm_industry_type']:''); ?>">
                     </div>
                   </div>
                   <div class="col-md-6">
                      <label for="name"><?php echo e(__("message.Is Payment Gateway Is Active")); ?><span class="reqfield">*</span></label>
                        <select name="is_active" id="is_active" class="form-control" required="">
                          <option value="1" <?= isset($arr['paytm_is_active'])&&$arr['paytm_is_active']=='1'?"selected='selected'":''?>><?php echo e(__("message.Yes")); ?></option>
                          <option value="0" <?= isset($arr['paytm_is_active'])&&$arr['paytm_is_active']=='0'?"selected='selected'":''?>><?php echo e(__("message.No")); ?></option>
                        </select>
                    </div>
                     <div class="row">
                           <div class="col-12">      
                              <input type="submit" value='<?php echo e(__("message.submit")); ?>' class="btn btn-success float-right">
                           </div>
                        </div>
                     </form>
                  </div>
                  
                  <div class="tab-pane fade <?= Session::get("payment_next")=='5'?'active show':''?>" id="pay5" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     <form action="<?php echo e(route('updategateway')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>  
                        <input type="hidden" name="payment_gateway" value="rave">
                     <div class="row">
                     <div class="col-md-6">
                        <label for="email"><?php echo e(__("message.RAVE PUBLIC KEY")); ?> :</label>
                        <input type="text" class="form-control" id="public_key" placeholder='<?php echo e(__("message.Enter RAVE PUBLIC KEY")); ?>' name="public_key" value="<?php echo e(isset($arr['rave_public_key'])?$arr['rave_public_key']:''); ?>">
                     </div>
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.RAVE SECRET KEY")); ?>:</label>
                        <input type="text" class="form-control" id="secert_key" placeholder='<?php echo e(__("message.Enter RAVE SECRET KEY")); ?>' name="secert_key"  value="<?php echo e(isset($arr['rave_secert_key'])?$arr['rave_secert_key']:''); ?>">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label for="email"><?php echo e(__("message.RAVE TITLE")); ?> :</label>
                        <input type="text" class="form-control" id="title" placeholder='<?php echo e(__("message.Enter RAVE TITLE")); ?>' name="title" value="<?php echo e(isset($arr['rave_title'])?$arr['rave_title']:''); ?>">
                     </div>
                     <div class="col-md-6">
                        <label for="pwd"><?php echo e(__("message.RAVE_ENVIRONMENT")); ?>:</label>
                        <select name="environment" id="environment" class="form-control" required="">
                           
                           <option <?= isset($arr['rave_environment'])&&$arr['rave_environment']=='staging'?"selected='selected'":''?> value="staging"><?php echo e(__("message.staging")); ?></option>
                           <option <?= isset($arr['rave_environment'])&&$arr['rave_environment']=='live'?"selected='selected'":''?> value="live"><?php echo e(__("message.live")); ?></option>
                        </select>
                     </div>
                     
                   </div>
                   <div class="row">
                        <div class="col-md-6">
                            <label for="email"><?php echo e(__("message.RAVE LOGO URL")); ?> :</label>
                            <input type="text" class="form-control" id="logo" placeholder='<?php echo e(__("message.Enter RAVE LOGO URL")); ?>' name="logo" value="<?php echo e(isset($arr['rave_logo'])?$arr['rave_logo']:''); ?>">
                         </div>
                         <div class="form-group col-md-6">
                                      <label for="name"><?php echo e(__("message.Is Payment Gateway Is Active")); ?><span class="reqfield">*</span></label>
                                      <select name="is_active" id="is_active" class="form-control" required="">
                                       <option value="1" <?= isset($arr['rave_is_active'])&&$arr['rave_is_active']=='1'?"selected='selected'":''?> ><?php echo e(__("message.Yes")); ?></option>
                                       <option value="0" <?= isset($arr['rave_is_active'])&&$arr['rave_is_active']=='0'?"selected='selected'":''?>><?php echo e(__("message.No")); ?></option>
                                      </select>
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                            <label for="email"><?php echo e(__("message.Country")); ?> :</label>
                            <input type="text" class="form-control" id="country" placeholder='<?php echo e(__("message.Country")); ?>' name="country" value="<?php echo e(isset($arr['rave_country'])?$arr['rave_country']:''); ?>">
                          </div>
                          <div class="col-md-6">
                            <label for="email"><?php echo e(__("message.Currency")); ?> :</label>
                            <input type="text" class="form-control" id="currency" placeholder='<?php echo e(__("message.Currency")); ?>' name="currency" value="<?php echo e(isset($arr['rave_currency'])?$arr['rave_currency']:''); ?>">
                          </div>
                      </div>
                         <div class="col-md-6">
                            <label for="email"><?php echo e(__("message.RAVE Encryption Key")); ?> :</label>
                            <input type="text" class="form-control" id="encryption_key" placeholder='<?php echo e(__("message.Enter RAVE Encryption Key")); ?>' name="encryption_key" value="<?php echo e(isset($arr['rave_encryption_key'])?$arr['rave_encryption_key']:''); ?>">
                         </div>
                     
                      <div class="row">
                           <div class="col-12">      
                              <input type="submit" value='<?php echo e(__("message.submit")); ?>' class="btn btn-success float-right">
                           </div>
                        </div>
                     </form>
                  </div>
                  </div>
              
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/paymentsetting.blade.php ENDPATH**/ ?>