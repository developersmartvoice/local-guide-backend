<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any("updateSendOffer", [ApiController::class, "updateSendOffer"]);


Route::any("searchdoctor", [ApiController::class, "showsearchdoctor"]);

Route::any("updateMotto", [ApiController::class, "updateMotto"]);
Route::any("updateIWillShowYou", [ApiController::class, "updateIWillShowYou"]);
Route::any("updateConsultationFees", [ApiController::class, "updateConsultationFees"]);
Route::any("updateAboutUs", [ApiController::class, "updateAboutUs"]);
Route::any("updateCity", [ApiController::class, "updateCity"]);
Route::any("updateGender", [ApiController::class, "updateGender"]);
Route::any("updateServices", [ApiController::class, "updateServices"]);
Route::any("updateLanguages", [ApiController::class, "updateLanguages"]);


Route::any("getName", [ApiController::class, "getName"]);
Route::any("get_motto", [ApiController::class, "getMotto"]);
Route::any("getIWillShowYou", [ApiController::class, "getIWillShowYou"]);
Route::any("getConsultationFees", [ApiController::class, "getConsultationFees"]);
Route::any("getAboutUs", [ApiController::class, "getAboutUs"]);
Route::any("getCity", [ApiController::class, "getCity"]);
Route::any("getGender", [ApiController::class, "getGender"]);
Route::any("getServices", [ApiController::class, "getServices"]);
Route::any("getLanguages", [ApiController::class, "getLanguages"]);
Route::any("filterdoctor", [ApiController::class, "filterdoctor"]);
Route::any("deletedoctor", [ApiController::class, "deleteDoctor"]);






Route::any("nearbydoctor", [ApiController::class, "nearbydoctor"]);
Route::any("register", [ApiController::class, "postregisterpatient"]);
Route::any("registernew", [ApiController::class, "postregisterpatient"]);
Route::any("user_reject_appointment", [ApiController::class, "user_reject_appointment"]);
Route::any("savetoken", [ApiController::class, "storetoken"]);
Route::any("login", [ApiController::class, "showlogin"]);
Route::any("doctorregister", [ApiController::class, "doctorregister"]);
Route::any("doctorlogin", [ApiController::class, "doctorlogin"]);
Route::any("getspeciality", [ApiController::class, "getspeciality"]);
Route::any("bookappointment", [ApiController::class, "bookappointment"]);
Route::any("viewdoctor", [ApiController::class, "viewdoctor"]);
Route::any("addreview", [ApiController::class, "addreview"]);
Route::any("getslot", [ApiController::class, "getslotdata"]);
Route::any("getlistofdoctorbyspecialty", [ApiController::class, "getlistofdoctorbyspecialty"]);
Route::any("usersuappointment", [ApiController::class, "usersupcomingappointment"]);
Route::any("userspastappointment", [ApiController::class, "userspastappointment"]);
Route::any("doctoruappointment", [ApiController::class, "doctoruappointment"]);
Route::any("doctorpastappointment", [ApiController::class, "doctorpastappointment"]);
Route::any("reviewlistbydoctor", [ApiController::class, "reviewlistbydoctor"]);
Route::any("doctordetail", [ApiController::class, "doctordetail"]);
Route::any("appointmentdetail", [ApiController::class, "appointmentdetail"]);
Route::any("doctoreditprofile", [ApiController::class, "doctoreditprofile"]);
Route::any("usereditprofile", [ApiController::class, "usereditprofile"]);
Route::any("getdoctorschedule", [ApiController::class, "getdoctorschedule"]);
Route::any("Reportspam", [ApiController::class, "saveReportspam"]);
Route::any("appointmentstatuschange", [ApiController::class, "appointmentstatuschange"]);
Route::any("forgotpassword", [ApiController::class, "forgotpassword"]);
Route::get("getalldoctors", [ApiController::class, "getalldoctors"]);
Route::post('createtrip', [ApiController::class, 'createTripGuide']);
Route::get('gettrip', [ApiController::class, 'getTripGuides']);
Route::get("getholiday", [ApiController::class, "getholiday"]);
Route::any("saveholiday", [ApiController::class, "saveholiday"]);
Route::get("deleteholiday", [ApiController::class, "deleteholiday"]);
Route::get("checkholiday", [ApiController::class, "checkholiday"]);
Route::get("get_all_doctor", [ApiController::class, "get_all_doctor"]);
Route::get("get_subscription_list", [ApiController::class, "get_subscription_list"]);
Route::post("place_subscription", [ApiController::class, "place_subscription"]);
Route::any("subscription_upload", [ApiController::class, "subscription_upload"]);
Route::any("mediaupload", [ApiController::class, "mediaupload"]);
Route::any("doctor_subscription_list", [ApiController::class, "doctor_subscription_list"]);
Route::any("change_password_doctor", [ApiController::class, "change_password_doctor"]);
Route::any("bannerlist", [ApiController::class, "banner_list"]);
Route::any("income_report", [ApiController::class, "income_report"]);
Route::any("data_list", [ApiController::class, "data_list"]);
Route::any("about", [ApiController::class, "about"]);
Route::any("privecy", [ApiController::class, "privecy"]);
