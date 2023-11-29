
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Save Doctors Schedule")); ?> | <?php echo e(__("message.admin")); ?> <?php echo e(__("message.Save Doctors Schedule")); ?>

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
               <h4 class="mb-0"><?php echo e(__("message.Save Doctors Schedule")); ?></h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                    
                     <li class="breadcrumb-item"><a href="<?php echo e(url('admin/doctors')); ?>"><?php echo e(__("message.Doctors")); ?></a></li>
                     <li class="breadcrumb-item active"><?php echo e(__("message.Save Doctors Schedule")); ?></li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row" style="display: flex;justify-content: center;">
         <div class="col-8">
            <div class="card">
               <div class="card-body">
                  <form action="<?php echo e(url('admin/savescheduledata')); ?>" method="post">
                       <?php echo e(csrf_field()); ?>  
                     <input type="hidden" name="doc_id" id="doc_id" value="<?php echo e($id); ?>"> 
                     <div id="accordion" class="custom-accordion">
                       <?php $arr=array(0=>__("message.Monday"),1=>__("message.Tuesday"),2=>__("message.Wednesday"),3=>__("message.Thursday"),4=>__("message.Friday"),5=>__("message.Saturday"),6=>__("message.Sunday"));?>
                        <?php for($i=0;$i<7;$i++): ?>
                        <div class="card mb-1 shadow-none">
                           <input type="hidden" name="arr[]" id="day_id_<?php echo e($i); ?>" value="<?php echo e($i); ?>"> 
                           <a href="#day<?php echo e($i); ?>" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="day<?php echo e($i); ?>">
                                 <div class="card-header" id="head<?php echo e($i); ?>">
                                       <h6 class="m-0"><?php echo e($arr[$i]); ?><i class="mdi mdi-chevron-up float-right accor-down-icon"></i></h6>
                                 </div>
                           </a>
                           <div id="day<?php echo e($i); ?>" class="collapse" aria-labelledby="head<?php echo e($i); ?>" data-parent="#accordion" style="">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="form-group">
                                       <button type="button" class="btn btn-primary" onclick="addnewslot('<?php echo e($i); ?>')"><?php echo e(__("message.Add Time")); ?></button>
                                    </div>                          
                                 </div>
                                    <div id="day_<?php echo e($i); ?>">
                                 <?php $j=0;$temp=0;?>
                                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(isset($d)&&$d->day_id==$i): ?>
                                         
                                          <?php if($j==0): ?>
                                                 <div class="slotdiv" id="slotdiv<?php echo e($i); ?><?php echo e($j); ?>">
                                             <?php else: ?>
                                                 <div class="slotdiv slotsecond" id="slotdiv<?php echo e($i); ?><?php echo e($j); ?>">
                                             <?php endif; ?>
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <label for="formrow-firstname-input"><?php echo e(__("message.Start Time")); ?></label>
                                                   <input type="time" class="form-control" id="start_time_<?php echo e($i); ?>_<?php echo e($j); ?>" name="arr[<?php echo e($i); ?>][start_time][<?php echo e($j); ?>]" value="<?php echo e(isset($d->start_time)?$d->start_time:''); ?>" onchange="checkduration('<?php echo e($i); ?>','<?php echo e($j); ?>')">
                                                </div> 
                                                <div class="col-md-3">
                                                   <label for="formrow-firstname-input"><?php echo e(__("message.End Time")); ?></label>
                                                   <input type="time" class="form-control" id="end_time_<?php echo e($i); ?>_<?php echo e($j); ?>" name="arr[<?php echo e($i); ?>][end_time][]" onchange="checkduration('<?php echo e($i); ?>','<?php echo e($j); ?>')" value="<?php echo e(isset($d->end_time)?$d->end_time:''); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                   <label for="formrow-firstname-input"><?php echo e(__("message.Duration")); ?></label>
                                                   <select class="form-control" name="arr[<?php echo e($i); ?>][duration][<?php echo e($j); ?>]" id="duration_<?php echo e($i); ?>_<?php echo e($j); ?>" onchange="getslot(this.value,'<?php echo e($i); ?>','<?php echo e($j); ?>')">
                                                      <option value=""><?php echo e(__("message.Select Duration")); ?></option>
                                                      <?php echo html_entity_decode($d->options);?>
                                                   </select>
                                                </div> 
                                                <div class="col-md-3" style="margin-top: 28px;">
                                                    <?php if($j!=0): ?>
                                                     <button type="button" class="btn btn-danger" onclick="removescdehule('<?php echo e($i); ?>','<?php echo e($j); ?>')"><?php echo e(__("message.delete")); ?></button>
                                                   <?php endif; ?>
                                                </div>
                                             </div>
                                             <div class="row boxmargin" id="slot_<?php echo e($i); ?>_<?php echo e($j); ?>">
                                                <?php for($k=0;$k<count($d->getslotls);$k++){
                                                         echo '<div class="col-md-12 md25">';
                                                           
                                                             if(isset($d->getslotls[$k])){
                                                               echo '<span class="slotshow">'.$d->getslotls[$k]->slot.'</span>';
                                                                $k++;
                                                             }
                                                              if(isset($d->getslotls[$k])){
                                                               echo '<span class="slotshow">'.$d->getslotls[$k]->slot.'</span>';
                                                                $k++;
                                                             }
                                                              

                                                              if(isset($d->getslotls[$k])){
                                                               echo '<span class="slotshow">'.$d->getslotls[$k]->slot.'</span>';
                                                                $k++;
                                                             }
                                                              if(isset($d->getslotls[$k])){
                                                               echo '<span class="slotshow">'.$d->getslotls[$k]->slot.'</span>';
                                                                $k++;
                                                             }
                                                              if(isset($d->getslotls[$k])){
                                                               echo '<span class="slotshow">'.$d->getslotls[$k]->slot.'</span>';
                                                                
                                                             }
                                                                             
                                                         echo '</div>';
                                                      } ?>
                                             </div>
                                           </div>
                                       
                                      
                                        <?php $j++;$temp=1;?>
                                    <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php if($temp==0): ?>
                                             <div id="day_<?php echo e($i); ?>">
                                                <div class="slotdiv" id="slotdiv<?php echo e($i); ?>0">
                                                   <div class="row">
                                                      <div class="col-md-3">
                                                         <label for="formrow-firstname-input"><?php echo e(__("message.Start Time")); ?></label>
                                                         <input type="time" class="form-control" id="start_time_<?php echo e($i); ?>_0" name="arr[<?php echo e($i); ?>][start_time][0]"  onchange="checkduration('<?php echo e($i); ?>','0')">
                                                      </div> 
                                                      <div class="col-md-3">
                                                         <label for="formrow-firstname-input"><?php echo e(__("message.End Time")); ?></label>
                                                         <input type="time" class="form-control" id="end_time_<?php echo e($i); ?>_0" name="arr[<?php echo e($i); ?>][end_time][]" onchange="checkduration('<?php echo e($i); ?>','0')" >
                                                      </div>
                                                      <div class="col-md-3">
                                                         <label for="formrow-firstname-input"><?php echo e(__("message.Duration")); ?></label>
                                                         <select class="form-control" name="arr[<?php echo e($i); ?>][duration][0]" id="duration_<?php echo e($i); ?>_0" onchange="getslot(this.value,'<?php echo e($i); ?>',0)" >
                                                            <option value=""><?php echo e(__("message.Select Duration")); ?></option>
                                                         </select>
                                                      </div> 
                                                      <div class="col-md-3" style="margin-top: 28px;"></div>
                                                   </div>
                                                   <div class="row boxmargin" id="slot_<?php echo e($i); ?>_0"></div>
                                                 </div>
                                             </div>
                                             
                                         <?php endif; ?>
                                          </div>
                                  <input type="hidden" id="total_slot_day_<?php echo e($i); ?>" value="<?php echo e($j+1); ?>">
                              </div>
                           </div>
                        </div> 
                        <?php endfor; ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<input type="hidden" id="start1val" value='<?php echo e(__("message.Please Select Start Time First")); ?>'>
<input type="hidden" id="sge" value='<?php echo e(__("message.Start Time is greater than end time")); ?>'>
<input type="hidden" id="sequale" value='<?php echo e(__("message.Start Time equals end time")); ?>'>
<input type="hidden" id="selduration" value='<?php echo e(__("message.Please Select Any Duration")); ?>'>
<input type="hidden" id="startvaltext" value='<?php echo e(__("message.Start Time")); ?>'>
<input type="hidden" id="endvaltext" value='<?php echo e(__("message.End Time")); ?>'>
<input type="hidden" id="durationval" value='<?php echo e(__("message.Duration")); ?>'>
<input type="hidden" id="seldurationval" value='<?php echo e(__("message.Select Duration")); ?>'>
<input type="hidden" id="deletetext" value='<?php echo e(__("message.delete")); ?>'>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/doctor/schedule.blade.php ENDPATH**/ ?>