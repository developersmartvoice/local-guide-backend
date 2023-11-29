<?php $__env->startSection('title'); ?>
Appointment Book Report
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
                   <h4 class="mb-0">Appointment Book Report</h4>
                   <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item active">Appointment Book Report</li>
                      </ol>
                   </div>
                </div>
             </div>
          </div>
          <div class="row">
             <div class="col-12">
                <div class="card">
                   <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">

                            <form action="app_book_report" method="get" >
                                <div class="row">
                                    <div class="col-3">
                                        <div class="input-group">
                                                 <label for="" class="mt-2">Report : </label>
                                                <select name="data_filter" id="" class="form-control" onchange="showDiv('hidden_div', this)">
                                                    <option value="">All data</option>
                                                    <option value="1" <?php echo e(Request::get('data_filter') == '1' ? 'selected':''); ?>>custom</option>
                                                    <option value="today" <?php echo e(Request::get('data_filter') == 'today' ? 'selected':''); ?>>Today</option>
                                                    <option value="last_week" <?php echo e(Request::get('data_filter') == 'last_week' ? 'selected':''); ?>>Last week</option>
                                                    <option value="this_month" <?php echo e(Request::get('data_filter') == 'this_month' ? 'selected':''); ?>>This month</option>
                                                    <option value="last_month" <?php echo e(Request::get('data_filter') == 'last_month' ? 'selected':''); ?>>Last month</option>
                                                    <option value="this_year" <?php echo e(Request::get('data_filter') == 'this_year' ? 'selected':''); ?>>This year</option>
                                                    <option value="last_year" <?php echo e(Request::get('data_filter') == 'last_year' ? 'selected':''); ?>>Last year</option>
                                                </select>
                                         </div>
                                        </div>
                                        <?php if(Request::get('data_filter') == '1'): ?>
                                        <div class="col-4" id="hidden_div">
                                             <div class="input-group">
                                                 <label for="" class="mt-2">start date :</label>
                                                 <input type="date" name="start_date" value="<?php echo e(Request::get('start_date') ?? date('y-m-d')); ?>" class="form-control">

                                                 <label for="" class="mt-2 ml-3"> end date :</label>
                                                 <input type="date" name="end_date" value="<?php echo e(Request::get('end_date') ?? date('y-m-d')); ?>" class="form-control" >
                                             </div>
                                       </div>
                                       <?php else: ?>
                                       <div class="col-4" id="hidden_div" style="display: none;">
                                             <div class="input-group">
                                                 <label for="" class="mt-2">start date :</label>
                                                 <input type="date" name="start_date"  class="form-control">

                                                 <label for="" class="mt-2 ml-3"> end date :</label>
                                                 <input type="date" name="end_date"  class="form-control" >
                                             </div>
                                       </div>
                                       <?php endif; ?>
                                      <div class="col-2">
                                          <input type="submit" class="btn btn-primary">
                                     </div>
                                </div>
                            </form><br>
                        </div>
                    </div>
                    <h4 class="card-title">
                    <?php if(Request::get('data_filter') ): ?>
                            <?php if($total == null): ?>
                                 appointment booked not found
                                <?php else: ?>
                                Total appointment booked are <?php echo e($total); ?>

                            <?php endif; ?>
                            <?php else: ?>
                            Appointment Book list
                        <?php endif; ?>
                        </h4>
                        <input type="hidden" name="count_data" value="<?php echo e($total); ?>" id="count_data">

                      <table id="myTable" class="table table-bordered dt-responsive tablels">
                         <thead>
                            <tr>
                               <th>Id</th>
                               <th>Doctor Name</th>
                               <th>Patient Name</th>
                               <th>DateTime</th>
                               <th>Phone</th>
                               <th>User Description</th>
                               <th>Status</th>
                            </tr>
                         </thead>
                         <tbody>
                            <?php $__currentLoopData = $appointmentbook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($doc->id); ?></td>
                                <td>
                                    <?php if($doc->doctorls): ?>
                                        <?php echo e($doc->doctorls->name); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($doc->patientls): ?>
                                        <?php echo e($doc->patientls->name); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($doc->date); ?>  <?php echo e($doc->slot_name); ?></td>
                                <td><?php echo e($doc->phone); ?></td>
                                <td><?php echo e($doc->user_description); ?></td>
                                <td>
                                    <?php if($doc->status == 0): ?>
                                    absent
                                    <?php endif; ?>
                                    <?php if($doc->status == 1): ?>
                                    receive
                                    <?php endif; ?>
                                    <?php if($doc->status == 2): ?>
                                    approve
                                    <?php endif; ?>
                                    <?php if($doc->status == 3): ?>
                                    process
                                    <?php endif; ?>
                                    <?php if($doc->status == 4): ?>
                                    completed
                                    <?php endif; ?>
                                    <?php if($doc->status == 5): ?>
                                    reject
                                    <?php endif; ?>
                                    <?php if($doc->status == 6): ?>
                                    cancel
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
 <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />-->
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
 <script>
    function showDiv(divId, element) {
       document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
    }
 </script>
 <script>
    // $(document).ready(function(){
    //     let table = new DataTable('#myTable', {
    //                 order: [[0, 'desc']]
    //                 });
    // });
    
    $(document).ready(function() {

    var test = $("#count_data").val();
    if(test > 0){
        $('#myTable').DataTable( {
        dom: 'Bfrtip',
        order: [[0, 'desc']],
        buttons: [
           { 
      extend: 'excel',
      text: 'Download excel'
   }
        ]
    } );
    }else{
        let table = new DataTable('#myTable', {
            order: [[0, 'desc']]
            });
    }
    
    } );
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubnzxmjc/localguide/resources/views/admin/report/appointmentbook.blade.php ENDPATH**/ ?>