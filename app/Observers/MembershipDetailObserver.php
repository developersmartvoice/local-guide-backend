<?php
namespace App\Observers;

use App\Models\MembershipDetail;
// use App\Models\Doctors;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class MembershipDetailObserver
{
    public function updated(MembershipDetail $membershipDetail)
    {
        Log::info('Observer triggered for MembershipDetail ID: ' . $membershipDetail->id);
        // Check if the ending_subscription date has passed
        if ($membershipDetail->ending_subscription < Carbon::now()) {
            Log::info('Subscription ended for MembershipDetail ID: ' . $membershipDetail->id);

            // Get the corresponding doctor
            $doctor = $membershipDetail->doctor;

            // Update the is_member field to false
            if ($doctor) {
                $doctor->update(['is_member' => false]);
            }
        }
    }
}
