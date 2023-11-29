
<?php $__env->startSection('title'); ?>
<?php echo e(__('message.Search Doctors')); ?>

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
                        <h1><?php echo e(__('message.Search Doctors')); ?></h1>
                    </div>
                </div>
            </div>
            <div class="lower-content">
                <div class="auto-container">
                    <ul class="bread-crumb clearfix">
                        <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><?php echo e(__('message.Search Doctors')); ?></li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="select-field bg-color-3">
            <div class="auto-container">
                <div class="content-box">
                    <div class="form-inner clearfix">
                        <form action="<?php echo e(url('searchdoctor')); ?>" method="get">
                            <div class="form-group clearfix">
                              
                                <input type="text" name="term" value="<?php echo e($term); ?>" id="term" placeholder="<?php echo e(__('message.Ex. Name')); ?>" required="">
                                <?php if(!empty($type)): ?>
                                 <input type="hidden" name="type" value="<?php echo e($type); ?>">
                                <?php endif; ?>
                                <button type="submit"><i class="icon-Arrow-Right"></i></button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <section class="clinic-section doctors-page-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left">
                                <h3><?php echo e(__('message.Showing')); ?> <?php echo e(count($doctorlist)); ?> <?php echo e(__('message.Results')); ?></h3>
                            </div>
                            <div class="right-column pull-right clearfix">
                               <div class="short-box clearfix">
                                    <div class="select-box">
                                        <select class="wide" onchange="serachsep(this.value)">
                                           <option value=""><?php echo e(__('message.Specialist by')); ?></option>
                                          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ser->id); ?>" <?= isset($type)&&$type==$ser->id?'selected="selected"':""?> ><?php echo e($ser->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="menu-box">
                                    <button class="list-view"><i class="icon-List"></i></button>
                                    <button class="grid-view on"><i class="icon-Grid"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper grid">
                            <div class="clinic-list-content list-item">
                                <?php $__currentLoopData = $doctorlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="clinic-block-one">
                                        <div class="inner-box">
                                            <div class="pattern">
                                                <div class="pattern-1" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-24.png')); ?>');"></div>
                                                <div class="pattern-2" style="background-image: url('<?php echo e(asset('public/front_pro/assets/images/shape/shape-25.png')); ?>');"></div>
                                            </div>
                                            <figure class="image-box">
                                                <?php if($dl->image!=""): ?>
                                                <img src="<?php echo e(asset('public/upload/doctors').'/'.$dl->image); ?>" alt="" style="height: 245px;">
                                                <?php else: ?>
                                                  <img src="<?php echo e(asset('public/upload/doctors/default.png')); ?>" alt="" style="height: 245px;">
                                                <?php endif; ?>
                                                
                                                </figure>
                                            <div class="content-box">
                                                <div class="like-box">
                                                    <?php if($dl->is_fav=='0'): ?>
                                                       <?php if(empty(Session::has("user_id"))): ?>
                                                       <a href="<?php echo e(url('patientlogin')); ?>" id="favdoc<?php echo e($dl->id); ?>">
                                                       <?php else: ?>
                                                       <a href="javascript:userfavorite('<?php echo e($dl->id); ?>')" id="favdoc<?php echo e($dl->id); ?>">
                                                       <?php endif; ?>
                                                       <?php else: ?>
                                                       <a href="javascript:userfavorite('<?php echo e($dl->id); ?>')" class="activefav" id="favdoc<?php echo e($dl->id); ?>">
                                                       <?php endif; ?>
                                                         <i class="far fa-heart"></i></a>
                                                </div>
                                                <ul class="name-box clearfix">
                                                    <li class="name"><h3><a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>"><?php echo e($dl->name); ?></a></h3></li>
                                                    <!-- <li><i class="icon-Trust-1"></i></li>
                                                    <li><i class="icon-Trust-2"></i></li> -->
                                                </ul>
                                                <span class="designation"><?php echo e(isset($dl->departmentls)?$dl->departmentls->name:""); ?></span>
                                                <div class="text">
                                                    <p><?php echo e(substr($dl->aboutus,0,200)); ?></p>
                                                </div>
                                                <div class="rating-box clearfix">
                                                    <ul class="rating clearfix">
                                                        <?php
                                                                      $arr = $dl->avgratting;
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
                                                        <li><a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>">(<?php echo e($dl->totalreview); ?>)</a></li>
                                                    </ul>
                                                    <div class="link"><a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>"><?php echo e($dl->working_time); ?></a></div>
                                                </div>
                                                <div class="location-box">
                                                    <p><i class="fas fa-map-marker-alt"></i><?php echo e(substr($dl->address,0,38)); ?></p>
                                                </div>
                                                <div class="btn-box"><a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>"><?php echo e(__('message.Visit Now')); ?></a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                  <?php if(isset($type)&&$type!=""&&isset($term)&&$term!=""): ?>
                                     <?php echo e($doctorlist->appends(['term' => $term,'type'=>$type])->links()); ?>

                                  <?php elseif(isset($type)&&$type!=""&&empty($term)): ?>
                                     <?php echo e($doctorlist->appends(['type'=>$type])->links()); ?>

                                  <?php elseif(isset($type)&&$type!=""&&empty($term)): ?>
                                     <?php echo e($doctorlist->appends(['term' => $term])->links()); ?>

                                  <?php else: ?>
                                     <?php echo e($doctorlist->links()); ?>

                                  <?php endif; ?>                            
                            </div>
                          
                            
                            <div class="clinic-grid-content">
                                <div class="row clearfix">
                                    <?php $__currentLoopData = $doctorlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-6 col-md-6 col-sm-12 team-block">
                                            <div class="team-block-three">
                                                <div class="inner-box">
                                                    <figure class="image-box">
                                                        <img src="<?php echo e(asset('public/upload/doctors').'/'.$dl->image); ?>" alt="" style="height: 245px;">
                                                          <?php if($dl->is_fav=='0'): ?>
                                                       <?php if(empty(Session::has("user_id"))): ?>
                                                       <a href="<?php echo e(url('patientlogin')); ?>" id="favdoc<?php echo e($dl->id); ?>">
                                                       <?php else: ?>
                                                       <a href="javascript:userfavorite('<?php echo e($dl->id); ?>')" id="favdoc<?php echo e($dl->id); ?>">
                                                       <?php endif; ?>
                                                       <?php else: ?>
                                                       <a href="javascript:userfavorite('<?php echo e($dl->id); ?>')" class="activefav" id="favdoc<?php echo e($dl->id); ?>">
                                                       <?php endif; ?>
                                                         <i class="far fa-heart"></i></a>
                                                    </figure>
                                                    <div class="lower-content">
                                                        <ul class="name-box clearfix">
                                                            <li class="name"><h3><a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>"><?php echo e($dl->name); ?></a></h3></li>
                                                            <!-- <li><i class="icon-Trust-1"></i></li>
                                                            <li><i class="icon-Trust-2"></i></li> -->
                                                        </ul>
                                                        <span class="designation"><?php echo e(isset($dl->departmentls)?$dl->departmentls->name:""); ?></span>
                                                        <div class="rating-box clearfix">
                                                            <ul class="rating clearfix">
                                                                <?php
                                                                      $arr = $dl->avgratting;
                                                                      
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
                                                                <li><a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>">(<?php echo e($dl->totalreview); ?>)</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="location-box">
                                                            <p><i class="fas fa-map-marker-alt"></i><?php echo e(substr($dl->address,0,38)); ?></p>
                                                        </div>
                                                        <div class="lower-box clearfix">
                                                            <span class="text"><?php echo e($dl->working_time); ?></span>
                                                            <a href="<?php echo e(url('viewdoctor').'/'.$dl->id); ?>"><?php echo e(__('message.Visit Now')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                  <?php if(isset($type)&&$type!=""&&isset($term)&&$term!=""): ?>
                                     <?php echo e($doctorlist->appends(['term' => $term,'type'=>$type])->links()); ?>

                                  <?php elseif(isset($type)&&$type!=""&&empty($term)): ?>
                                     <?php echo e($doctorlist->appends(['type'=>$type])->links()); ?>

                                  <?php elseif(isset($type)&&$type!=""&&empty($term)): ?>
                                     <?php echo e($doctorlist->appends(['term' => $term])->links()); ?>

                                  <?php else: ?>
                                     <?php echo e($doctorlist->links()); ?>

                                  <?php endif; ?> 
                            </div>
                        </div>
                       
                        
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="map-inner ml-10">
                         
                            <div id="map" style="height: 400px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script type="text/javascript">
    function serachsep(val){
         var term=$("#term").val();
         if(term==""){
                if(val!=""){
                    window.location.href='<?php echo e(url("searchdoctor")); ?>'+'?type='+val;
                }
         }else{
            window.location.href='<?php echo e(url("searchdoctor")); ?>'+'?type='+val+"&term="+term;
         }
         
    }
</script>
   <script>
     
        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
            var infoWindow = new google.maps.InfoWindow;
            var markerBounds = new google.maps.LatLngBounds();
            var markers =<?=json_encode($doctorslistmap);?>;
            Array.prototype.forEach.call(markers, function(markerElem) {
               
              if(markerElem.lat!=null&&markerElem.lon!=null){
                  var id = markerElem.id;
              var name = markerElem.name;
              var address = markerElem.address;
              var type = "D";
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.lat),
                  parseFloat(markerElem.lon));
              markerBounds.extend(point);
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = {
                                            url: "<?php echo e(asset('public/front_pro/assets/images/icons/map-marker.png')); ?>", // url
                                            scaledSize: new google.maps.Size(40, 40), // scaled size
                                            origin: new google.maps.Point(0,0), // origin
                                            anchor: new google.maps.Point(0, 0) // anchor
                                        };
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });

              map.fitBounds(markerBounds);
              map.panToBounds(markerBounds); 
              }
              
            });
          
        }

initMap();

         </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/user/searchdoctor.blade.php ENDPATH**/ ?>