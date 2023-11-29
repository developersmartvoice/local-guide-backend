<?php $__env->startSection('title'); ?>
Doctor Subscription Report
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
                   <h4 class="mb-0">Doctor Subscription Report</h4>
                   <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item active">Doctor Subscription Report</li>
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

                            <form action="do_sub_report" method="get" >
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
                            doctor subscribe not found
                                <?php else: ?>
                                Total doctor subscribe are <?php echo e($total); ?>

                            <?php endif; ?>
                            <?php else: ?>
                            Doctor Subscribe List
                        <?php endif; ?>
                        </h4>

                            <input type="hidden" name="count_data" value="<?php echo e($total); ?>" id="count_data">

                      <table id="myTable" class="table table-bordered dt-responsive tablels">
                         <thead>
                            <tr>
                               <th>Id</th>
                               <th>Doctor Name</th>
                               <th>payment Type</th>
                               <th>Amount</th>
                               <th>Status</th>
                               
                            </tr>
                         </thead>
                         <tbody>
                            <?php $__currentLoopData = $doctorsubscription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($doc->id); ?></td>
                                <td>
                                    <?php if($doc->doctors): ?>
                                        <?php echo e($doc->doctors->name); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($doc->payment_type == 1): ?>
                                    Braintree
                                    <?php elseif($doc->payment_type == 2): ?>
                                    Bank Deposit
                                    <?php elseif($doc->payment_type == 3): ?>
                                    Razorpay
                                    <?php elseif($doc->payment_type == 4): ?>
                                    Paystack
                                    <?php endif; ?>
                                </td>
                                <td>$<?php echo e($doc->amount); ?></td>
                                <td>
                                    <?php if($doc->status == 1): ?>
                                    not active
                                    <?php elseif($doc->status == 2): ?>
                                    active
                                    <?php elseif($doc->status == 3): ?>
                                    expiry
                                    <?php elseif($doc->status == 4): ?>
                                    reject
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


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/freakd1c/public_html/demo/bookappointment/resources/views/admin/report/doctorsubscription.blade.php ENDPATH**/ ?>