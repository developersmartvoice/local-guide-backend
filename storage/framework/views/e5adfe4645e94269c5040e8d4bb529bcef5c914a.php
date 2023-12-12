
<?php $__env->startSection('title'); ?>
<?php echo e(__("message.Dashboard")); ?> | <?php echo e(__("message.Admin")); ?> <?php echo e(__("message.Dashboard")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-data'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    td.dataTables_empty {
    font-size: medium;
    font-weight: 600;
}
</style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0"><?php echo e(__("message.Dashboard")); ?></h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">                                   
                                    <li class="breadcrumb-item active"><?php echo e(__("message.Dashboard")); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right mt-2" style="position: relative;">
                                    <div id="orders-chart" style="min-height: 45px;"> <div id="apexcharts636a2b" class="apexcharts-canvas apexcharts636a2b apexcharts-theme-light" style="width: 45px; height: 45px;"><i class="uil-shutter-alt" style="font-size: xx-large;"></i><div class="apexcharts-legend"></div></div></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo e($totalappointment); ?></span></h4>
                                    <p class="text-muted mb-0"><?php echo e(__("message.New Appointment")); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                         <div class="card">
                            <div class="card-body">
                                <div class="float-right mt-2" style="position: relative;">
                                    <div id="orders-chart" style="min-height: 45px;"> <div id="apexcharts636a2b" class="apexcharts-canvas apexcharts636a2b apexcharts-theme-light" style="width: 45px; height: 45px;"><i class="uil-flask" style="font-size: xx-large;"></i><div class="apexcharts-legend"></div></div></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo e($totaldoctor); ?></span></h4>
                                    <p class="text-muted mb-0"><?php echo e(__("message.Total Doctors")); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                         <div class="card">
                            <div class="card-body">
                                <div class="float-right mt-2" style="position: relative;">
                                    <div id="orders-chart" style="min-height: 45px;"> <div id="apexcharts636a2b" class="apexcharts-canvas apexcharts636a2b apexcharts-theme-light" style="width: 45px; height: 45px;"><i class="uil-file-alt" style="font-size: xx-large;"></i><div class="apexcharts-legend"></div></div></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo e($totalpatient); ?></span></h4>
                                    <p class="text-muted mb-0"><?php echo e(__("message.Total Patients")); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                         <div class="card">
                            <div class="card-body">
                                <div class="float-right mt-2" style="position: relative;">
                                    <div id="orders-chart" style="min-height: 45px;"> <div id="apexcharts636a2b" class="apexcharts-canvas apexcharts636a2b apexcharts-theme-light" style="width: 45px; height: 45px;"><i class="uil-star" style="font-size: xx-large;"></i><div class="apexcharts-legend"></div></div></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo e($totalreview); ?></span></h4>
                                    <p class="text-muted mb-0"><?php echo e(__("message.Total Review")); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
               <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       <h4><?php echo e(__("message.Today Appointment")); ?></h4>
                                        
                                        <table id="latsrappointmenttable" class="table table-bordered dt-responsive tablels">
                                            <thead>
                                              <tr>
                              <th><?php echo e(__("message.Id")); ?></th>
                              <th><?php echo e(__("message.Doctor Name")); ?></th>
                              <th><?php echo e(__("message.Patient Name")); ?></th>
                              <th><?php echo e(__("message.DateTime")); ?></th>
                              <th><?php echo e(__("message.Phone")); ?></th>
                              <th><?php echo e(__("message.User Description")); ?></th>
                              <th><?php echo e(__("message.Status")); ?></th>
                           </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                        </div> 
            </div> 
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\local-guide-backend\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>