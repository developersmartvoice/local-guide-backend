
<div id="stripe_div" style="margin-top: 20%; " >
    <form action="<?php echo e(url('stripe-callback')); ?>" method="post" id="stripe-form" class="center" style="margin:auto; width:15%">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="phone_no" id="phone_no_2">
        <input type="hidden" name="date" id="date_2">
        <input type="hidden" name="slot" id="slot_2">
        <input type="hidden" name="message" id="message_2">
        <input type="hidden" name="payment_type" value="Stripe">
         <input type="hidden" name="type" value="1">
        <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
        <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo e($data->doctor_id); ?>">
        <input type="hidden" name="consultation_fees" value="<?php echo e($data->consultation_fees); ?>">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo e(env('STRIPE_KEY')); ?>"
          data-amount="<?php echo e($data->consultation_fees); ?>"
          data-id="stripid"
          data-name="<?php echo e(__('message.System Name')); ?>"
          data-label="<?php echo e(__('message.Book Appointment')); ?>"
          data-description=""
          data-image="<?php echo e(asset('public/image_web/').'/'.$setting->logo); ?>"
          data-locale="auto">
        </script>
    </form> 
</div>  <?php /**PATH /home/ubnzxmjc/localguide/resources/views/stripe.blade.php ENDPATH**/ ?>