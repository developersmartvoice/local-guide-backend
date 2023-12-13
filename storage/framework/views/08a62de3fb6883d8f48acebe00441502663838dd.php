
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.save")); ?> <?php echo e(__("message.Doctors")); ?> | <?php echo e(__("message.Admin")); ?> <?php echo e(__("message.Doctors")); ?>

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
                  <h4 class="mb-0"><?php echo e(__("message.save")); ?> <?php echo e(__("message.Doctors")); ?></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('admin/doctors')); ?>"><?php echo e(__("message.Doctors")); ?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo e(__("message.save")); ?> <?php echo e(__("message.Doctors")); ?></li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-9">
               <div class="card">
                  <div class="card-body">
                     <form action="<?php echo e(url('admin/updatedoctor')); ?>" class="needs-validation" method="post"
                        enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" id="doctor_id" value="<?php echo e($id); ?>">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <div class="mar20">
                                    <div id="uploaded_image">
                                       <div class="upload-btn-wrapper">
                                          <button type="button" class="btn imgcatlog">
                                             <input type="hidden" name="real_basic_img" id="real_basic_img"
                                                value="<?= isset($data->image)?$data->image:""?>" />
                                             <?php 
                                             if(isset($data->image)){
                                                 $path=asset('public/upload/doctors')."/".$data->image;
                                             }
                                             else{
                                                 $path=asset('public/upload/profile/profile.png');
                                             }
                                             ?>
                                             <img src="<?php echo e($path); ?>" alt="..." class="img-thumbnail imgsize"
                                                id="basic_img">
                                          </button>
                                          <input type="hidden" name="basic_img" id="basic_img1" />
                                          <input type="file" name="upload_image" id="upload_image" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <div class="mar20">
                                    <div id="uploaded_images">
                                       <?php if(isset($data->images)): ?>
                                       <?php $__currentLoopData = json_decode($data->images, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <div class="upload-btn-wrapper">
                                          <button type="button" class="btn imgcatlog">
                                             <input type="hidden" name="real_images[]" value="<?php echo e($image); ?>" />
                                             <img src="<?php echo e(asset('public/upload/doctors/' . $image)); ?>" alt="..."
                                                class="img-thumbnail imgsize" id="preview-image-<?php echo e($index); ?>" />
                                          </button>
                                          <input type="file" name="upload_images[]"
                                             onchange="previewImage(this, <?php echo e($index); ?>)" />
                                       </div>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <?php endif; ?>

                                       <?php for($i = count(json_decode($data->images, true) ?? []); $i < 4; $i++): ?> <div
                                          class="upload-btn-wrapper">
                                          <button type="button" class="btn imgcatlog">
                                             <input type="hidden" name="real_images[]" value="" />
                                             <img src="<?php echo e(asset('public/upload/profile/profile.png')); ?>" alt="..."
                                                class="img-thumbnail imgsize" id="preview-image-<?php echo e($i); ?>" />
                                          </button>
                                          <input type="file" name="upload_images[]"
                                             onchange="previewImage(this, <?php echo e($i); ?>)" />
                                    </div>
                                    <?php endfor; ?>
                                 </div>
                              </div>
                           </div>

                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label for="name"><?php echo e(__("message.Name")); ?><span class="reqfield">*</span></label>
                              <input type="text" class="form-control" placeholder='<?php echo e(__("message.Enter Doctor Name")); ?>'
                                 id="name" name="name" required="" value="<?php echo e(isset($data->name)?$data->name:''); ?>">
                           </div>
                           <div class="form-group">
                              <label for="department_id"><?php echo e(__("message.specialities")); ?><span
                                    class="reqfield">*</span></label>
                              <select class="form-control" name="department_id" id="department_id" required="">
                                 <option value="">
                                    <?php echo e(__("message.select")); ?> <?php echo e(__("message.specialities")); ?>

                                 </option>
                                 <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($d->id); ?>" <?=isset($data->
                                    department_id)&&$data->department_id==$d->id?'selected="selected"':""?>
                                    ><?php echo e($d->name); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="password"><?php echo e(__("message.Password")); ?><span class="reqfield">*</span></label>
                              <input type="password" class="form-control" id="password"
                                 placeholder='<?php echo e(__("message.Enter password")); ?>' name="password" required=""
                                 value="<?php echo e(isset($data->password)?$data->password:''); ?>">
                           </div>
                        </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4">
                  <div class="form-group">
                     <label for="phoneno"><?php echo e(__("message.Phone")); ?><span class="reqfield">*</span></label>
                     <input type="text" class="form-control" id="phoneno" placeholder='<?php echo e(__("message.Enter Phone")); ?>'
                        name="phoneno" required="" value="<?php echo e(isset($data->phoneno)?$data->phoneno:''); ?>">
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group">
                     <label for="email"><?php echo e(__("message.Email")); ?><span class="reqfield">*</span></label>
                     <input type="email" class="form-control" id="email"
                        placeholder='<?php echo e(__("message.Enter Email Address")); ?>' name="email" required=""
                        <?=isset($id)&&$id!=0?'readonly':""?>
                     value="<?php echo e(isset($data->email)?$data->email:''); ?>">
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="form-group">
                     <label for="email"><?php echo e(__("message.Working Time")); ?><span class="reqfield">*</span></label>
                     <input type="text" class="form-control" id="working_time"
                        placeholder='<?php echo e(__("message.Enter Working Time")); ?>' name="working_time" required=""
                        value="<?php echo e(isset($data->working_time)?$data->working_time:''); ?>">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-3">
                  <div class="form-group">
                     <label for="aboutus"><?php echo e(__("message.consultation_fees")); ?><span class="reqfield">*</span></label>
                     <input type="number" required name="consultation_fees"
                        value="<?php echo e(isset($data->consultation_fees)?$data->consultation_fees:''); ?>" class="form-control"
                        id="consultation_fees" min="1" step="0.01">
                  </div>
               </div>
               <div class="col-lg-3">
                  <div class="form-group">
                     <label for="city"><?php echo e(__("City")); ?><span class="reqfield">*</span></label>
                     <input type="text" required name="city" value="<?php echo e(isset($data->city)?$data->city:''); ?>"
                        class="form-control">
                  </div>
               </div>
               <div class="col-lg-3">
                  <div class="form-group">
                     <label><?php echo e(__("Gender")); ?><span class="reqfield">*</span></label>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderNone" value="none" <?php echo e(isset($data->gender) && $data->gender == 'none' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="genderNone">
                           None
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" <?php echo e(isset($data->gender) && $data->gender == 'male' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="genderMale">
                           Male
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" <?php echo e(isset($data->gender) && $data->gender == 'female' ? 'checked' :
                        ''); ?>>
                        <label class="form-check-label" for="genderFemale">
                           Female
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="aboutus"><?php echo e(__("message.About Us")); ?><span class="reqfield">*</span></label>
                     <textarea id="aboutus" class="form-control" rows="5" name="aboutus"
                        placeholder='<?php echo e(__("message.Enter About Doctor")); ?>'
                        required=""><?php echo e(isset($data->aboutus)?$data->aboutus:''); ?></textarea>
                  </div>
               </div>
               <div class="col-lg-6">
                  <!-- <div class="form-group">
                                 <label for="services"><?php echo e(__("message.Services")); ?><span class="reqfield">*</span></label>
                                 <textarea id="services" class="form-control" rows="5"
                                    placeholder='<?php echo e(__("message.Enter Description about Services")); ?>' name="services"
                                    required=""><?php echo e(isset($data->services)?$data->services:''); ?></textarea>
                              </div> -->
                  <div class="form-group">
                     <label><?php echo e(__("message.Services")); ?><span class="reqfield">*</span></label>
                     <div>
                        <!-- Add options dynamically from your database or use a predefined list -->
                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="translation" name="services[]"
                              value="translation" <?php echo e(isset($data->services) &&
                           in_array('translation',
                           explode(',', $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="translation">Translation &
                              Interpretation</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="shopping" name="services[]"
                              value="shopping" <?php echo e(isset($data->services) && in_array('shopping',
                           explode(',', $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="shopping">Shopping</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="food" name="services[]" value="food" <?php echo e(isset($data->services) && in_array('food', explode(',',
                           $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="food">Food & Restaurants</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="art" name="services[]" value="art" <?php echo e(isset($data->services) && in_array('art',
                           explode(',', $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="art">Art & Museums</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="history" name="services[]"
                              value="history" <?php echo e(isset($data->services) && in_array('history', explode(',',
                           $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="history">History & Culture</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="exploration" name="services[]"
                              value="exploration" <?php echo e(isset($data->services)
                           && in_array('exploration', explode(',', $data->services)) ?
                           'checked' : ''); ?>>
                           <label class="form-check-label" for="exploration">Exploration &
                              Sightseeing</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="tours" name="services[]" value="pick" <?php echo e(isset($data->services) && in_array('pick', explode(',',
                           $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="tours">Pick up & Driving Tours</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="nightlife" name="services[]"
                              value="nightlife" <?php echo e(isset($data->services) && in_array('nightlife',
                           explode(',', $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="nightlife">Nightlife & Bars</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="sports" name="services[]" value="sports"
                              <?php echo e(isset($data->services) && in_array('sports', explode(',',
                           $data->services)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="sports">Sports & Recreation</label>
                        </div>
                        <!-- Add more services as needed -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <!-- <div class="form-group">
                                 <label for="languages"><?php echo e(__("message.Languages")); ?><span
                                       class="reqfield">*</span></label>
                                 <select id="languages" class="form-control" name="languages[]" multiple required="">
                                    Add options dynamically from your database or use a predefined list
                                    <option value="english" <?php echo e(isset($data->languages) && in_array('english',
                                       explode(',', $data->languages)) ? 'selected' : ''); ?>>English</option>
                                    <option value="bengali" <?php echo e(isset($data->languages) && in_array('bengali',
                                       explode(',', $data->languages)) ? 'selected' : ''); ?>>Bengali</option>
                                    <option value="hindi" <?php echo e(isset($data->languages) && in_array('hindi',
                                       explode(',', $data->languages)) ? 'selected' : ''); ?>>Hindi</option>
                                    <option value="urdu" <?php echo e(isset($data->languages) && in_array('urdu',
                                       explode(',', $data->languages)) ? 'selected' : ''); ?>>Urdu</option>
                                    <option value="french" <?php echo e(isset($data->languages) && in_array('french',
                                       explode(',', $data->languages)) ? 'selected' : ''); ?>>French</option>
                                    <option value="spanish" <?php echo e(isset($data->languages) && in_array('spanish',
                                       explode(',', $data->languages)) ? 'selected' : ''); ?>>Spanish</option>
                                    Add more languages as needed
                                 </select>
                              </div> -->
                  <div class="form-group">
                     <label><?php echo e(__("message.Languages")); ?><span class="reqfield">*</span></label>
                     <div>
                        <!-- Add options dynamically from your database or use a predefined list -->
                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="english" name="languages[]"
                              value="english" <?php echo e(isset($data->languages) && in_array('english', explode(',',
                           $data->languages)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="english">English</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="bengali" name="languages[]"
                              value="bengali" <?php echo e(isset($data->languages) && in_array('bengali', explode(',',
                           $data->languages)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="bengali">Bengali</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="hindi" name="languages[]" value="hindi"
                              <?php echo e(isset($data->languages) && in_array('hindi', explode(',',
                           $data->languages)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="hindi">Hindi</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="urdu" name="languages[]" value="urdu" <?php echo e(isset($data->languages) && in_array('urdu', explode(',',
                           $data->languages)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="urdu">Urdu</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="french" name="languages[]" value="french"
                              <?php echo e(isset($data->languages) && in_array('french', explode(',',
                           $data->languages)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="french">French</label>
                        </div>

                        <div class="form-check">
                           <input type="checkbox" class="form-check-input" id="spanish" name="languages[]"
                              value="spanish" <?php echo e(isset($data->languages) && in_array('spanish', explode(',',
                           $data->languages)) ? 'checked' : ''); ?>>
                           <label class="form-check-label" for="spanish">Spanish</label>
                        </div>
                        <!-- Add more languages as needed -->
                     </div>
                  </div>

               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="facebook_url"><?php echo e(__("message.Facebook Url")); ?><span class="reqfield">*</span></label>
                     <input type="text" class="form-control" id="facebook_url" name="facebook_url"
                        placeholder='<?php echo e(__("message.Enter Facebook Url")); ?>'
                        value="<?php echo e(isset($data->facebook_url)?$data->facebook_url:''); ?>" required="">
                  </div>
                  <div class="form-group">
                     <label for="twitter_url"><?php echo e(__("message.Twitter Url")); ?><span class="reqfield">*</span></label>
                     <input type="text" class="form-control" id="twitter_url" name="twitter_url"
                        placeholder='<?php echo e(__("message.Enter Twitter Url")); ?>'
                        value="<?php echo e(isset($data->twitter_url)?$data->twitter_url:''); ?>" required="">
                  </div>
               </div>
            </div>
            <div class="col-md-12 p-0" id="addressorder">
               <label><?php echo e(__("message.Address")); ?><span class="reqfield">*</span></label>
               <input type="text" id="us2-address" name="address" placeholder='<?php echo e(__("message.Search Location")); ?>'
                  required data-parsley-required="true" required="" />
            </div>
            <div class="map" id="maporder">
               <div class="form-group">
                  <div class="col-md-12 p-0">
                     <div id="us2"></div>
                  </div>
               </div>
            </div>
            <input type="hidden" name="lat" id="us2-lat"
               value="<?php echo e(isset($data->lat)?$data->lat:Config::get('mapdetail.lat')); ?>" />
            <input type="hidden" name="lon" id="us2-lon"
               value="<?php echo e(isset($data->lon)?$data->lon:Config::get('mapdetail.long')); ?>" />
            <div class="row">
               <div class="form-group">
                  <?php if(Session::get("is_demo")=='0'): ?>
                  <button type="button" onclick="disablebtn()" class="btn btn-primary"><?php echo e(__('message.Submit')); ?></button>
                  <?php else: ?>
                  <button class="btn btn-primary" type="submit" value="Submit"><?php echo e(__("message.Submit")); ?></button>
                  <?php endif; ?>

               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   function previewImage(input, previewId) {
      var preview = $('#preview-image-' + previewId);
      var file = input.files[0];

      if (file) {
         var reader = new FileReader();

         reader.onload = function (e) {
            preview.attr('src', e.target.result);
         };

         reader.readAsDataURL(file);
      } else {
         preview.attr('src', '<?php echo e(asset('public / upload / profile / profile.png')); ?>');
      }
   }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\local-guide-backend\resources\views/admin/doctor/savedoctor.blade.php ENDPATH**/ ?>