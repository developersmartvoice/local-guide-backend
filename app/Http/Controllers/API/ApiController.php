<?php

namespace App\Http\Controllers\API;

use Exception;

error_reporting(-1);
ini_set('display_errors', 'On');
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use validate;
use Sentinel;
use Response;
use Validator;
use DB;
use DataTables;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\User;
use App\Models\Services;
use App\Models\Review;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\TokenData;
use App\Models\Resetpassword;
use App\Models\BookAppointment;
use App\Models\SlotTiming;
use App\Models\Doctor_Hoilday;
use App\Models\Schedule;
use App\Models\Reportspam;
use App\Models\Settlement;
use App\Models\Subscription;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\Banner;
use App\Models\About;
use App\Models\Privecy;
use App\Models\TripGuide;
use Illuminate\Support\Facades\Log;
use Hash;
use Mail;
use DateTime;
use DateInterval;

use Carbon\Carbon;

class ApiController extends Controller
{
    public function change_password_doctor(Request $request)
    {
        $response = array("status" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
            'conf_password' => 'required'
        ];
        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'old_password.required' => "old_password is required",
            'new_password.required' => "new_password is required",
            'conf_password.required' => "conf_password is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['msg'] = $message;
        } else {

            $data = Doctors::where('id', $request->get("doctor_id"))->first();

            if ($data) {

                if ($data->password == $request->get("old_password")) {
                    if ($request->get("new_password") == $request->get("new_password")) {
                        $data->password = $request->get("new_password");
                        $data->save();
                        $response = array("status" => 1, "msg" => "Password chenge successfully");
                    } else {
                        $response = array("status" => 0, "msg" => "New password anf confirm password not match");
                    }

                } else {
                    $response = array("status" => 0, "msg" => "Old password not match");
                }


            } else {
                $response = array("status" => 0, "msg" => "Doctor id Not Found");
            }
        }
        return Response::json($response);

    }

    public function doctor_subscription_list(Request $request)
    {
        $response = array("status" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];
        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['msg'] = $message;
        } else {

            $data = Doctors::where('id', $request->get("doctor_id"))->first();

            if ($data) {

                $Subscriber = Subscriber::where('doctor_id', $request->get("doctor_id"))->where('is_complet', "1")->where('status', "2")->join('doctors', 'doctors.id', '=', 'subscriber.doctor_id')->join('subscription', 'subscription.id', '=', 'subscriber.subscription_id')->get(['subscriber.status', 'subscription.month', 'subscription.price', 'subscriber.date']);

                if ($Subscriber) {

                    $ls['doctors_subscription'] = $Subscriber;
                    $response['success'] = "1";
                    $response['register'] = "subscription Detail Get Successfully";
                    $response['data'] = $ls;

                } else {

                    $response = array("status" => 0, "msg" => "Subscription Detail Not Found");

                }


            } else {
                $response = array("status" => 0, "msg" => "Doctor id Not Found");
            }
        }
        return Response::json($response);

    }

    public function get_subscription_list()
    {
        $data = Subscription::all();
        if ($data) {
            $setting = Setting::find(1);
            $currency = explode("-", trim($setting->currency));
            $array = array("data" => $data, "currency" => trim($currency[1]));
            $response = array("status" => 1, "msg" => "Subscription List Get Successfully", "data" => $array);
        } else {
            $response = array("status" => 0, "msg" => "Subscription Result Found");
        }
        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    public function get_all_doctor(Request $request)
    {
        $data = Doctors::take(27)->get();
        $services = Services::all();
        foreach ($data as $d) {
            $d->timing = Schedule::select("start_time", "day_id", "end_time", "duration")->where("doctor_id", $d->id)->get();
        }
        return json_encode(array("services" => $services, "data" => $data));
    }

    public function showsearchdoctor(Request $request)
    {
        $response = array("status" => "0", "register" => "Validation error");
        $rules = [
            'term' => 'required'
        ];
        $messages = array(
            'term.required' => "term is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['msg'] = $message;
        } else {
            $data = Doctors::Where('address', 'like', '%' . $request->get("term") . '%')->select(
                "id",
                "name",
                "address",
                "image",
                "department_id",
                DB::raw("(SELECT AVG(rating) FROM review WHERE doc_id = doctors.id) AS avgratting"),
                DB::raw("(SELECT COUNT(*) FROM review WHERE doc_id = doctors.id) AS total_review")
            )->paginate(10);
            if ($data) {

                foreach ($data as $k) {
                    $dr = Services::find($k->department_id);
                    if ($dr) {
                        $k->department_name = $dr->name;
                    } else {
                        $k->department_name = "";
                    }
                    $k->image = asset('public/upload/doctors') . '/' . $k->image;
                    unset($data->department_id);
                }
                $response = array("status" => 1, "msg" => "Search Result", "data" => $data);
            } else {
                $response = array("status" => 0, "msg" => "No Result Found");
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function filterdoctor(Request $request)
    {
        $response = array("status" => "0", "register" => "Validation error");

        
        // Start building the query
        $query = Doctors::query();

       
        if ($request->has('consultation_fees')) {
            $requestedConsultationFees = (double) $request->get('consultation_fees');

            $query->where(function ($query) use ($requestedConsultationFees) {
                $query->whereRaw('CAST(consultation_fees AS DOUBLE) <= ?', [$requestedConsultationFees]);
            });
        }

        if ($request->has('gender')) {
            $query->where('gender', '=', $request->get('gender'));
        }

        if ($request->has('languages')) {
            // Assuming $data is fetched from the database
            $data = Doctors::all(); // Fetch data from your database
        
            $languages = $request->get('languages');
            $wordsToCount = explode(",", $languages);
            $counts = [];
            
            // Count occurrences of each word in the dataset
            foreach ($data as $row) {
                $words = explode(",", $row->languages); // Assuming 'languages' is the column name
                foreach ($words as $word) {
                    if (in_array($word, $wordsToCount)) {
                        if (!isset($counts[$word])) {
                            $counts[$word] = 1;
                        } else {
                            $counts[$word]++;
                        }
                    }
                }
            }
        
            // Constructing the query condition based on the counts
            $query->where(function ($query) use ($counts) {
                foreach ($counts as $word => $count) {
                    $query->orWhere('languages', 'like', '%' . $word . '%');
                }
            });
        }
        

            
        if ($request->has('services')) {
            // Assuming $data is fetched from the database
            $data = Doctors::all(); // Fetch data from your database
        
            $service = $request->get('services');
            $wordsToCount = explode(",", $service);
            $counts = [];
            
            // Count occurrences of each word in the dataset
            foreach ($data as $row) {
                $words = explode(",", $row->services); // Assuming 'services' is the column name
                foreach ($words as $word) {
                    if (in_array($word, $wordsToCount)) {
                        if (!isset($counts[$word])) {
                            $counts[$word] = 1;
                        } else {
                            $counts[$word]++;
                        }
                    }
                }
            }
        
            // Constructing the query condition based on the counts
            $query->where(function ($query) use ($counts) {
                foreach ($counts as $word => $count) {
                    $query->orWhere('services', 'like', '%' . $word . '%');
                }
            });
        }
          


        // Execute the query
        $data = $query->select(
            "id",
            "name",
            "languages",
            "address",
            "image",
            "services",
            "department_id",
            "consultation_fees",
            DB::raw("(SELECT AVG(rating) FROM review WHERE doc_id = doctors.id) AS avgratting"),
            DB::raw("(SELECT COUNT(*) FROM review WHERE doc_id = doctors.id) AS total_review")
        )->paginate(10);

        if ($data) {
            foreach ($data as $k) {
                $dr = Services::find($k->department_id);
                if ($dr) {
                    $k->department_name = $dr->name;
                } else {
                    $k->department_name = "";
                }
                $k->image = asset('public/upload/doctors') . '/' . $k->image;
                unset($k->department_id);
            }
            $response = array("status" => 1, "msg" => "Search Result", "data" => $data);
        } else {
            $response = array("status" => 0, "msg" => "No Result Found");
        }

        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////

    public function nearbydoctor(Request $request)
    {
        $response = array("status" => "0", "register" => "Validation error");
        $rules = [
            'lat' => 'required',
            'lon' => 'required'
        ];
        $messages = array(
            'lat.required' => "lat is required",
            'lon.required' => 'lon is requied'
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['msg'] = $message;
        } else {
            $lat = $request->get("lat");
            $lon = $request->get("lon");

            $data = DB::table("doctors")
                ->select(
                    "doctors.id",
                    "doctors.name",
                    "doctors.address",
                    "doctors.department_id",
                    "doctors.image",
                    "doctors.consultation_fees",
                    "doctors.aboutus",
                    "doctors.images",
                    DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                           * cos(radians(doctors.lat)) 
                           * cos(radians(doctors.lon) - radians(" . $lon . ")) 
                           + sin(radians(" . $lat . ")) 
                           * sin(radians(doctors.lat))) AS distance"),
                    DB::raw("(SELECT AVG(rating) FROM review WHERE doc_id = doctors.id) AS avgratting"),
                    DB::raw("(SELECT COUNT(*) FROM review WHERE doc_id = doctors.id) AS total_review")
                )
                ->orderby('distance')->WhereNotNull("doctors.lat")->paginate(10);

            if ($data) {

                foreach ($data as $k) {
                    //   $k->load('reviewls');
                    $department = Services::find($k->department_id);
                    $k->department_name = isset($department) ? $department->name : "";
                    $k->image = asset("public/upload/doctors") . '/' . $k->image;

                    // Check if the 'images' property exists
                    if (isset($k->images)) {
                        // Convert the images field value from JSON to an array
                        $k->images = json_decode($k->images, true);

                        // Add the full image URLs to the images array
                        if ($k->images) {
                            $k->images = array_map(function ($image) {
                                return asset("public/upload/doctors") . '/' . $image;
                            }, $k->images);
                        }
                    }

                    unset($k->department_id);
                }
                $response = array("status" => 1, "msg" => "Search Result", "data" => $data);
            } else {
                $response = array("status" => 0, "msg" => "No Result Found");
            }

        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function postregisterpatient(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'phone' => 'required',
            'password' => 'required',
            // 'token' => 'required',
            'email' => 'required',
            'name' => 'required'
        ];

        $messages = array(
            'phone.required' => "Mobile No is required",
            'password.required' => "password is required",
            //   'token.required' => "token is required",
            'phone.unique' => "Mobile Number Already Register",
            'email.required' => 'Email is required',
            'name.required' => 'name is required'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $getuser = Patient::where("phone", $request->get("phone"))->first();
            if (empty($getuser)) { //update token

                $getemail = Patient::where("email", $request->get("email"))->first();
                if ($getemail) {
                    $response['success'] = "0";
                    $response['register'] = "Email Id Already Register";
                } else {

                    $login_field = "";
                    $user_id = "";
                    $connectycube_password = "";

                    $inset = new Patient();
                    $inset->phone = $request->get("phone");
                    $inset->name = $request->get("name");
                    $inset->password = $request->get("password");
                    $inset->email = $request->get("email");

                    if (env('ConnectyCube') == true) {

                        $login_field = $request->get("phone") . rand() . "#1";
                        $user_id = $this->signupconnectycude($request->get("name"), $request->get("password"), $request->get("email"), $request->get("phone"), $login_field);
                        $connectycube_password = $request->get("password");
                    }

                    $inset->connectycube_user_id = $user_id;
                    $inset->login_id = $login_field;
                    $inset->connectycube_password = $connectycube_password;

                    $connrctcube = ($inset->connectycube_user_id);

                    if ($connrctcube == "0-email must be unique") {
                        $response['success'] = "0";
                        $response['register'] = "Email Or Mobile Number Already Register in ConnectCube";

                    } else {
                        $inset->save();
                        $store = TokenData::where("token", $request->get("token"))->update(["user_id" => $inset->id]);
                        $response['success'] = "1";
                        $response['register'] = array("user_id" => $inset->id, "name" => $request->get("name"), "phone" => $inset->phone, "email" => $inset->email, "connectycube_user_id" => $inset->connectycube_user_id, "login_id" => $login_field, "connectycube_password" => $inset->connectycube_password);
                    }
                }

            } else {
                $response['success'] = "0";
                $response['register'] = "Mobile Number Already Register";
            }

        }
        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    public function storetoken(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'type' => 'required',
            'token' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response['register'] = "enter your data perfectly";
        } else {
            $store = new TokenData();
            $store->token = $request->get("token");
            $store->type = $request->get("type");
            $store->save();
            $response['success'] = "1";
            $response['headers'] = array("Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Credentials" => true, "Access-Control-Allow-Headers" => "Origin,Content-Type,X-Amz-Date,Authorization,X-Api-Key,X-Amz-Security-Token", "Access-Control-Allow-Methods" => "POST, OPTIONS,GET");
            $response['register'] = "Registered";

        }
        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    public function getalldoctors()
    {
        $data = Doctors::take(26)->get();
        return Response::json($data);
    }

    public function showlogin(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'email' => 'required',
            // 'token' => 'required',
            "login_type" => 'required'
        ];
        if ($request->input('login_type') == '1') {
            $rules['password'] = 'required';
        }
        if ($request->input('login_type') == '2' || $request->input('login_type') == '3' || $request->input('login_type') == '4') {
            $rules['name'] = 'required';
            $rules['phone'] = 'required';
        }
        $messages = array(
            'email.required' => "Email is required",
            'password.required' => "password is required",
            //   'token.required' => "token is required",
            'login_type.required' => "login type is required",
            'name.required' => "name is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {

            if ($request->input('login_type') == '1') {
                $getuser = Patient::where("email", $request->get("email"))->where("password", $request->get("password"))->first();
                if ($getuser) { //update token
                    $store = TokenData::where("token", $request->get("token"))->first();
                    if ($store) {
                        $store->user_id = $getuser->id;
                        $store->save();
                    }
                    $getuser->login_type = $request->get("login_type");
                    $getuser->save();
                    if ($getuser->profile_pic != "") {
                        $image = asset("public/upload/profile") . '/' . $getuser->profile_pic;
                    } else {
                        $image = asset("public/upload/profile/profile.png");
                    }
                    $response['success'] = "1";
                    $response['headers'] = array('Access-Control-Allow-Origin' => '*');
                    $response['register'] = array("user_id" => $getuser->id, "name" => $getuser->name, "phone" => $getuser->phone, "email" => $getuser->email, "profile_pic" => $image, "connectycube_user_id" => $getuser->connectycube_user_id, "login_id" => $getuser->login_id, "connectycube_password" => $getuser->connectycube_password);
                } else { //in vaild user
                    $data = Patient::where("phone", $request->get("phone"))->first();
                    if ($data) {
                        $response['success'] = "0";
                        $response['register'] = "Invaild Password";
                    } else {
                        $response['success'] = "0";
                        $response['register'] = "Invaild Email";
                    }

                }
            } else if ($request->input('login_type') == '2' || $request->input('login_type') == '3' || $request->input('login_type') == '4') {
                $getuser = Patient::where("email", $request->get("email"))->first();
                if ($getuser) { //update patient
                    $imgdata = $getuser->profile_pic;
                    $png_url = "";
                    if ($request->get("image") != "") {
                        $png_url = "profile-" . mt_rand(100000, 999999) . ".png";
                        $path = public_path() . '/upload/profile/' . $png_url;
                        $content = $this->file_get_contents_curl($request->get("image"));
                        $savefile = fopen($path, 'w');
                        fwrite($savefile, $content);
                        fclose($savefile);
                        $img = public_path() . '/upload/profile/' . $png_url;
                        $getuser->login_type = $request->get("login_type");
                        $getuser->profile_pic = $png_url;
                        $getuser->save();
                    }
                    if ($imgdata != $png_url && $imgdata != "") {
                        $image_path = public_path() . "/upload/profile/" . $imgdata;
                        if (file_exists($image_path) && $imgdata != "") {
                            try {
                                unlink($image_path);
                            } catch (Exception $e) {
                            }
                        }
                    }
                    $store = TokenData::where("token", $request->get("token"))->first();
                    if ($store) {
                        $store->user_id = $getuser->id;
                        $store->save();
                    }
                    if ($getuser->profile_pic != "") {
                        $image = asset("public/upload/profile") . '/' . $getuser->profile_pic;
                    } else {
                        $image = asset("public/upload/profile/profile.png");
                    }
                    $response['success'] = "1";
                    $response['headers'] = array('Access-Control-Allow-Origin' => '*');
                    $response['register'] = array("user_id" => $getuser->id, "name" => $getuser->name, "phone" => $getuser->phone, "email" => $getuser->email, "profile_pic" => $image, "connectycube_user_id" => $getuser->connectycube_user_id, "login_id" => $getuser->login_id, "connectycube_password" => $getuser->connectycube_password);
                } else { //register patient

                    $login_field = "";
                    $user_id = "";
                    $connectycube_password = "";

                    $getuser = new Patient();

                    $getuser->login_type = $request->get("login_type");
                    $png_url = "";
                    if ($request->get("image") != "") {
                        $png_url = "profile-" . mt_rand(100000, 999999) . ".png";
                        $path = public_path() . '/upload/profile/' . $png_url;
                        $content = $this->file_get_contents_curl($request->get("image"));
                        $savefile = fopen($path, 'w');
                        fwrite($savefile, $content);
                        fclose($savefile);
                        $img = public_path() . '/upload/profile/' . $png_url;
                        $getuser->profile_pic = $png_url;
                    }
                    $number = rand();
                    $fix = "@123";
                    $length = 8;
                    $password = substr(str_repeat(0, $length) . $number . $fix, -$length);
                    $getuser->phone = $request->get("phone");
                    $getuser->name = $request->get("name");
                    $getuser->password = $password;
                    $getuser->email = $request->get("email");

                    if (env('ConnectyCube') == true) {

                        $login_field = $request->get("phone") . rand() . "#1";
                        $user_id = $this->signupconnectycude($request->get("name"), $password, $request->get("email"), $request->get("phone"), $login_field);
                        $connectycube_password = $password;
                    }

                    $getuser->connectycube_user_id = $user_id;
                    $getuser->login_id = $login_field;
                    $getuser->connectycube_password = $connectycube_password;


                    if ($user_id == "0-email must be unique") {
                        $response['success'] = "0";
                        $response['register'] = "Email Already Register in ConnectCube";
                    } else {
                        $getuser->save();
                        $store = TokenData::where("token", $request->get("token"))->first();
                        if ($store) {
                            $store->user_id = $getuser->id;
                            $store->save();
                        }
                        if ($getuser->profile_pic != "") {
                            $image = asset("public/upload/profile") . '/' . $getuser->profile_pic;
                        } else {
                            $image = asset("public/upload/profile/profile.png");
                        }

                        $response['success'] = "1";
                        $response['headers'] = array('Access-Control-Allow-Origin' => '*');
                        $response['register'] = array("user_id" => $getuser->id, "name" => $getuser->name, "phone" => $getuser->phone, "email" => $getuser->email, "profile_pic" => $image, "connectycube_user_id" => $getuser->connectycube_user_id, "login_id" => $getuser->login_id, "connectycube_password" => $getuser->connectycube_password);
                    }

                }
            } else {
                $data = Patient::where("phone", $request->get("phone"))->first();
                if ($data) {
                    $response['success'] = "0";
                    $response['register'] = "Invaild Phone Number";
                } else {
                    $response['success'] = "0";
                    $response['register'] = "Invaild Login Type";
                }
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    public function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function doctorregister(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'phone' => 'required',
            'password' => 'required',
            'email' => 'required',
            'name' => 'required',
            // 'token' =>'required'
        ];

        $messages = array(
            'phone.required' => "Mobile No is required",
            'password.required' => "password is required",
            //   'token.required' => "token is required",
            'email.required' => 'Email is required',
            'name.required' => 'name is required'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $getuser = Doctors::where("email", $request->get("email"))->first();
            if (empty($getuser)) { //update token
                $login_field = "";
                $user_id = "";
                $connectycube_password = "";

                $inset = new Doctors();
                $inset->phoneno = $request->get("phone");
                $inset->name = $request->get("name");
                $inset->password = $request->get("password");
                $inset->email = $request->get("email");


                if (env('ConnectyCube') == true) {

                    $login_field = $request->get("phone") . rand() . "#2";
                    $user_id = $this->signupconnectycude($request->get("name"), $request->get("password"), $request->get("email"), $request->get("phone"), $login_field);
                    $connectycube_password = $request->get("password");
                }

                $inset->connectycube_user_id = $user_id;
                $inset->login_id = $login_field;
                $inset->connectycube_password = $connectycube_password;

                if ($user_id == "0-email must be unique") {
                    $response['success'] = "0";
                    $response['register'] = "Email Or Mobile Number Already Register in ConnectCube";

                } else {
                    $inset->save();
                    $store = TokenData::where("token", $request->get("token"))->update(["user_id" => $inset->id]);
                    $response['success'] = "1";
                    $response['register'] = array("user_id" => $inset->id, "name" => $inset->name, "phone" => $inset->phoneno, "email" => $inset->email, "connectycube_user_id" => $inset->connectycube_user_id, "login_id" => $inset->login_id, "connectycube_password" => $inset->connectycube_password, "profile_pic" => "");
                }

            } else {
                $response['success'] = "0";
                $response['register'] = "Email Already Register";
            }

        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function doctorlogin(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'email' => 'required',
            'password' => 'required',
            // 'token' => 'required'
        ];

        $messages = array(
            'email.required' => "Email is required",
            'password.required' => "password is required",
            //   'token.required' => "token is required"
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $getuser = Doctors::where("email", $request->get("email"))->where("password", $request->get("password"))->first();

            if ($getuser) { //update token
                $store = TokenData::where("token", $request->get("token"))->first();
                if ($store) {
                    $store->doctor_id = $getuser->id;
                    $store->save();
                }
                if ($getuser->image != "") {
                    $image = asset("public/upload/doctors") . '/' . $getuser->image;
                } else {
                    $image = asset("public/upload/profile/profile.png");
                }
                $response['success'] = "1";
                $response['register'] = array("doctor_id" => $getuser->id, "name" => $getuser->name, "phone" => $getuser->phone, "email" => $getuser->email, "login_id" => $getuser->login_id, "connectycube_user_id" => $getuser->connectycube_user_id, "profile_pic" => $image, "connectycube_password" => $getuser->connectycube_password);

            } else { //in vaild user
                $data = Doctors::where("email", $request->get("email"))->first();
                if ($data) {
                    $response['success'] = "0";
                    $response['register'] = "Invaild Password";
                } else {
                    $response['success'] = "0";
                    $response['register'] = "Invaild Email";
                }

            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function getspeciality()
    {
        //$data=Services::select('id','name','icon')->paginate(10);
        $data = Services::select('id', 'name', 'icon')->get();
        if (count($data) > 0) {
            foreach ($data as $d) {
                $d->total_doctors = count(Doctors::where("department_id", $d->id)->get());
                $d->icon = asset("public/upload/services") . '/' . $d->icon;
            }
            $response['success'] = "1";
            $response['register'] = "Speciality List";
            $response['data'] = $data;
        } else {
            $response['success'] = "0";
            $response['register'] = "Speciality Not Found";
        }

        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function bookappointment(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'user_id' => 'required',
            'doctor_id' => 'required',
            'date' => 'required',
            'slot_id' => 'required',
            'slot_name' => 'required',
            'phone' => 'required',
            'user_description' => 'required',
            'payment_type' => 'required',
            'consultation_fees' => 'required'
        ];
        $messages = array(
            'user_id.required' => "user_id is required",
            'doctor_id.required' => "doctor_id is required",
            'date.required' => "date is required",
            'slot_id.required' => "slot_id is required",
            'slot_name.required' => "slot_name is required",
            'phone.required' => "phone is required",
            'user_description.required' => "user_description is required",
            'payment_method_nonce.required' => "payment_method_nonce is required",
            'consultation_fees.requierd' => "consultation_fees is required",
            "payment_type.required" => "Payment Type is Required",
            "stripeToken.required" => "stripeToken is required"
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            if (Patient::find($request->get("user_id"))) {

                $getappointment = BookAppointment::where("date", $request->get("date"))->where('is_completed', '1')->where("slot_id", $request->get("slot_id"))->first();
                if ($getappointment) {
                    $response['success'] = "0";
                    $response['register'] = "Slot Already Booked";
                } else {
                    DB::beginTransaction();
                    try {
                        $date = DateTime::createFromFormat('d', 15)->add(new DateInterval('P1M'));
                        $data = new BookAppointment();
                        $data->user_id = $request->get("user_id");
                        $data->doctor_id = $request->get("doctor_id");
                        $data->slot_id = $request->get("slot_id");
                        $data->slot_name = $request->get("slot_name");
                        $data->date = $request->get("date");
                        $data->phone = $request->get("phone");
                        $data->user_description = $request->get("user_description");
                        if ($request->get("payment_type") == "COD") {
                            $data->payment_mode = "COD";
                            $data->is_completed = "1";

                        } else {
                            $data->payment_mode = "";
                            $data->is_completed = "0";

                        }
                        $data->consultation_fees = $request->get("consultation_fees");
                        $data->save();
                        if ($request->get("payment_type") == "COD") {
                            $url = "";
                        } else {
                            $url = route('make-payment', ['id' => $data->id, "type" => '1']);
                        }
                        if ($data->payment_mode == "COD") {
                            $store = new Settlement();
                            $store->book_id = $data->id;
                            $store->status = '0';
                            $store->payment_date = $date->format('Y-m-d');
                            $store->doctor_id = $data->doctor_id;
                            $store->amount = $request->get("consultation_fees");
                            $store->save();
                            $msg = __("apimsg.You have a new upcoming appointment");
                            $user = User::find(1);
                            $android = $this->send_notification_android($user->android_key, $msg, $request->get("doctor_id"), "doctor_id", $data->id);
                            $ios = $this->send_notification_IOS($user->ios_key, $msg, $request->get("doctor_id"), "doctor_id", $data->id);
                            try {
                                $user = Doctors::find($request->get("doctor_id"));
                                $user->msg = $msg;

                                $result = Mail::send('email.Ordermsg', ['user' => $user], function ($message) use ($user) {
                                    $message->to($user->email, $user->name)->subject(__('message.System Name'));
                                });

                            } catch (\Exception $e) {
                            }
                        }
                        $response['success'] = "1";
                        $response['register'] = "Appointment Book Successfully";
                        $response['data'] = $data->id;
                        $response['url'] = $url;
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        $response['success'] = "0";
                        $response['register'] = $e;
                    }

                }
            } else {
                $response['success'] = "3";
                $response['register'] = "user not found";
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function viewdoctor(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $getdetail = Doctors::find($request->get("doctor_id"));
            if (empty($getdetail)) {
                $response['success'] = "0";
                $response['register'] = "Doctor Not Found";
            } else {
                $getdepartment = Services::find($getdetail->department_id);
                if ($getdepartment) {
                    $getdetail->department_name = $getdepartment->name;

                } else {
                    $getdetail->department_name = "";
                }
                $getdetail->avgratting = Review::where('doc_id', $request->get("doctor_id"))->avg('rating');
                $getdetail->total_review = count(Review::where('doc_id', $request->get("doctor_id"))->get());
                $getdetail->image = asset('public/upload/doctors') . '/' . $getdetail->image;
                $response['success'] = "1";
                $response['register'] = "Doctor Get Successfully";
                $response['data'] = $getdetail;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function addreview(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'user_id' => 'required',
            'rating' => 'required',
            'doc_id' => 'required',
            'description' => 'required'
        ];

        $messages = array(
            'user_id.required' => "user_id is required",
            'rating.required' => "rating is required",
            'doc_id.required' => "doc_id is required",
            'description.required' => "description is required"
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {

            $store = new Review();
            $store->user_id = $request->get("user_id");
            $store->doc_id = $request->get("doc_id");
            $store->rating = $request->get("rating");
            $store->description = $request->get("description");
            $store->save();
            $response['success'] = "1";
            $response['register'] = "Review Add Successfully";
            $response['data'] = $store;

        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function getslotdata(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'date' => 'required',

        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'date.required' => "rating is required"
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $day = date('N', strtotime($request->get("date"))) - 1;
            $data = Schedule::with('getslotls')->where("doctor_id", $request->get("doctor_id"))->where("day_id", $day)->get();
            $main = array();
            if (count($data) > 0) {
                foreach ($data as $k) {
                    $slotlist = array();
                    $slotlist['title'] = $k->start_time . " - " . $k->end_time;
                    if (count($k->getslotls) > 0) {
                        foreach ($k->getslotls as $b) {
                            $ka = array();
                            $getappointment = BookAppointment::where("date", $request->get("date"))->where("slot_id", $b->id)->whereNotNull('transaction_id')->where('is_completed', '1')->where('status', "!=", 6)->first();
                            $getcodappointment = BookAppointment::where("date", $request->get("date"))->where("slot_id", $b->id)->where('payment_mode', "COD")->where('is_completed', '1')->where('status', "!=", 6)->first();
                            $cancel_appointment = BookAppointment::where("date", $request->get("date"))->where("slot_id", $b->id)->where('status', 6)->where('is_completed', '1')->first();

                            $ka['id'] = $b->id;
                            $ka['name'] = $b->slot;

                            if ($getappointment || $getcodappointment) {
                                $ka['is_book'] = '1';
                            } elseif ($cancel_appointment) {
                                $ka['is_book'] = '0';
                            } else {
                                $ka['is_book'] = '0';
                            }
                            $slotlist['slottime'][] = $ka;
                        }
                    }
                    $main[] = $slotlist;
                }
            }
            if (empty($slotlist)) {
                $response['success'] = "0";
                $response['register'] = "Slot Not Found";
            } else {
                $response['success'] = "1";
                $response['register'] = "Get Slot Successfully";
                $response['data'] = $main;
            }


        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function getlistofdoctorbyspecialty(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'department_id' => 'required',
            'lat' => 'required',
            'lon' => 'required'
        ];

        $messages = array(
            'department_id.required' => "department_id is required",
            'lat.required' => "lat is required",
            'lon.required' => "lon is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $lat = $request->get('lat');
            $lon = $request->get("lon");
            $data = $data = DB::table("doctors")
                ->where("department_id", $request->get("department_id"))
                ->select(
                    "doctors.id",
                    "doctors.name",
                    "doctors.address",
                    "doctors.email",
                    "doctors.phoneno",
                    "doctors.department_id",
                    "doctors.image"
                    ,
                    DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                              * cos(radians(doctors.lat)) 
                              * cos(radians(doctors.lon) - radians(" . $lon . ")) 
                              + sin(radians(" . $lat . ")) 
                              * sin(radians(doctors.lat))) AS distance")
                )
                ->orderby('distance')->WhereNotNull("doctors.lat")->paginate(10);

            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Doctors Not Found";
            } else {
                foreach ($data as $d) {
                    $dp = Services::find($d->department_id);
                    if ($dp) {
                        $d->department_name = $dp->name;
                    }
                    $d->image = asset('public/upload/doctors') . '/' . $d->image;
                }
                $response['success'] = "1";
                $response['register'] = "Doctors List Successfully";
                $response['data'] = $data;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function userspastappointment(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'user_id' => 'required'
        ];

        $messages = array(
            'user_id.required' => "user_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = BookAppointment::where("user_id", $request->get("user_id"))->select("id", "doctor_id", "date", "slot_name as slot", 'phone')->where('is_completed', '1')->orderby('id', "DESC")->paginate(15);

            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            } else {
                $new = array();
                foreach ($data as $d) {
                    $a = array();

                    $doctors = Doctors::find($d->doctor_id);
                    $department = Services::find($doctors->department_id);
                    if ($doctors) {
                        $d->name = $doctors->name;
                        $d->address = $doctors->address;
                        $d->image = isset($doctors->image) ? asset('public/upload/doctors') . '/' . $doctors->image : "";
                        $d->department_name = isset($department) ? $department->name : "";
                    } else {
                        $d->name = "";
                        $d->address = "";
                        $d->image = "";
                        $d->department_name = "";
                    }

                    unset($d->department_id);
                    unset($d->doctor_id);
                    unset($d->doctorls);
                    if ($d->status == '1') {
                        $d->status = __("message.Received");
                    } else if ($d->status == '2') {
                        $d->status = __("message.Approved");
                    } else if ($d->status == '3') {
                        $d->status = __("message.In Process");
                    } else if ($d->status == '4') {
                        $d->status = __("message.Completed");
                    } else if ($d->status == '5') {
                        $d->status = __("message.Rejected");
                    } else {
                        $d->status = __("message.Absent");
                    }


                }


                $response['success'] = "1";
                $response['register'] = "Appointment List Successfully";
                $response['data'] = $data;

            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function usersupcomingappointment(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'user_id' => 'required'
        ];

        $messages = array(
            'user_id.required' => "user_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = BookAppointment::where("date", ">=", date('Y-m-d'))->select("id", "doctor_id", "date", "slot_name as slot", 'phone')->where('is_completed', '1')->where("user_id", $request->get("user_id"))->paginate(15);
            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            } else {
                foreach ($data as $d) {
                    $a = array();

                    $doctors = Doctors::find($d->doctor_id);
                    $department = Services::find($doctors->department_id);
                    if ($doctors) {
                        $d->name = $doctors->name;
                        $d->address = $doctors->address;
                        $d->image = isset($doctors->image) ? asset('public/upload/doctors') . '/' . $doctors->image : "";
                        $d->department_name = isset($department) ? $department->name : "";
                    } else {
                        $d->name = "";
                        $d->address = "";
                        $d->image = "";
                        $d->department_name = "";
                    }
                    unset($d->department_id);
                    unset($d->doctor_id);
                    unset($d->doctorls);

                    if ($d->status == '1') {
                        $d->status = __("message.Received");
                    } else if ($d->status == '2') {
                        $d->status = __("message.Approved");
                    } else if ($d->status == '3') {
                        $d->status = __("message.In Process");
                    } else if ($d->status == '4') {
                        $d->status = __("message.Completed");
                    } else if ($d->status == '5') {
                        $d->status = __("message.Rejected");
                    } else {
                        $d->status = __("message.Absent");
                    }
                    //$new[]=$a;
                }
                $response['success'] = "1";
                $response['register'] = "Appointment List Successfully";
                $response['data'] = $data;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function reviewlistbydoctor(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];


        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = Review::with('patientls')->where("doc_id", $request->get("doctor_id"))->orderby('id', 'DESC')->select('id', 'user_id', 'rating', 'description')->get();
            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Review Not Found";
            } else {
                $main_array = array();
                foreach ($data as $d) {
                    $ls = array();
                    $ls['name'] = isset($d->patientls->name) ? $d->patientls->name : "";
                    $ls['rating'] = isset($d->rating) ? $d->rating : "";
                    $ls['description'] = isset($d->description) ? $d->description : "";
                    $ls['image'] = isset($d->patientls->profile_pic) ? asset('public/upload/profile') . '/' . $d->patientls->profile_pic : "";
                    $ls['phone'] = isset($d->patientls->phone) ? $d->phone : "";
                    $main_array[] = $ls;
                }

                $response['success'] = "1";
                $response['register'] = "Review List Successfully";
                $response['data'] = $main_array;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function doctorpastappointment(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = BookAppointment::orderby('id', "DESC")->where("doctor_id", $request->get("doctor_id"))->where('is_completed', '1')->select("date", "id", "slot_name as slot", "user_id", "phone", "status")->paginate(10);
            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            } else {
                foreach ($data as $d) {
                    $user = Patient::find($d->user_id);
                    if ($user) {
                        $d->name = $user->name;
                        $d->image = isset($user->profile_pic) ? asset('public/upload/profile') . '/' . $user->profile_pic : "";
                    } else {
                        $d->name = "";
                        $d->image = "";

                    }
                    if ($d->status == '1') {
                        $d->status = __("message.Received");
                    } else if ($d->status == '2') {
                        $d->status = __("message.Approved");
                    } else if ($d->status == '3') {
                        $d->status = __("message.In Process");
                    } else if ($d->status == '4') {
                        $d->status = __("message.Completed");
                    } else if ($d->status == '5') {
                        $d->status = __("message.Rejected");
                    } else {
                        $d->status = __("message.Absent");
                    }
                    unset($d->user_id);
                }
                $response['success'] = "1";
                $response['register'] = "Appointment List Successfully";
                $response['data'] = $data;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function doctoruappointment(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {

            $data = BookAppointment::where("date", ">=", date('Y-m-d'))->where("doctor_id", $request->get("doctor_id"))->where("is_completed", 1)->orderby('id', 'DESC')->select("date", "id", "slot_name as slot", "user_id", "phone", "status")->paginate(10);
            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            } else {

                foreach ($data as $d) {
                    $user = Patient::find($d->user_id);
                    if ($user) {
                        $d->name = $user->name;
                        $d->image = isset($user->profile_pic) ? asset('public/upload/profile') . '/' . $user->profile_pic : "";
                    } else {
                        $d->name = "";
                        $d->image = "";

                    }
                    if ($d->status == '1') {
                        $d->status = __("message.Received");
                    } else if ($d->status == '2') {
                        $d->status = __("message.Approved");
                    } else if ($d->status == '3') {
                        $d->status = __("message.In Process");
                    } else if ($d->status == '4') {
                        $d->status = __("message.Completed");
                    } else if ($d->status == '5') {
                        $d->status = __("message.Rejected");
                    } else {
                        $d->status = __("message.Absent");
                    }
                    unset($d->user_id);
                }
                $response['success'] = "1";
                $response['register'] = "Appointment List Successfully";
                $response['data'] = $data;
            }
        }
        return json_encode($response);

    }

    public function doctordetail(Request $request)
    {

        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = Doctors::where('id', $request->get("doctor_id"))->orderBy('id', 'desc')->first();
            // echo "<pre>";
            // print_r($data);
            // die();
            if (empty($data)) {
                $response['success'] = "0";
                $response['register'] = "Doctor Not Found";
            } else {
                $d = Services::find($data->department_id);
                $data->department_name = isset($d) ? $d->name : "";
                unset($data->department_id);
                // if (isset($data->image) && !empty($data->image))
                // {
                //   $data->image = $data->image;
                // }else{
                //   $data->image = 'user.png';
                // }
                if (isset($data->images)) {
                    // Convert the images field value from JSON to an array
                    $data->images = json_decode($data->images, true);

                    // Add the full image URLs to the images array
                    if ($data->images) {
                        $data->images = array_map(function ($image) {
                            return asset("public/upload/doctors") . '/' . $image;
                        }, $data->images);
                    }
                }
                $data->image = asset('public/upload/doctors') . '/' . $data->image;
                $data->avgratting = round(Review::where("doc_id", $request->get("doctor_id"))->avg('rating'));

                $mysubscriptionlist = Subscriber::where('doctor_id', $request->get("doctor_id"))->where("status", '2')->orderby('id', 'DESC')->first();

                if (isset($mysubscriptionlist)) {
                    $mysubscriptionlist->subscription_data = Subscription::find($mysubscriptionlist->subscription_id);


                    $datetime = new DateTime($mysubscriptionlist->date);
                    if (isset($mysubscriptionlist->subscription_data)) {
                        $month = $mysubscriptionlist->subscription_data->month;
                        $datetime->modify('+' . $month . ' month');
                        $date = $datetime->format('Y-m-d H:i:s');
                        //echo $d=strtotime($date);
                        $current_date = $this->getsitedateall();
                        if ($mysubscriptionlist->is_complet == 1) {
                            $data->is_subscription = "1";
                        } else {
                            $data->is_subscription = "0";
                        }
                        //die
                        if (strtotime($current_date) < strtotime($date)) {

                            if ($mysubscriptionlist->status == 2) {
                                $data->is_approve = 1;
                            } else {
                                $data->is_approve = 0;
                            }

                        } else {
                            $data->is_subscription = "0";
                            $data->is_approve = 0;
                        }
                    } else {

                        $data->is_subscription = "0";
                        $data->is_approve = 0;
                    }
                } else {
                    $data->is_subscription = "0";
                    $data->is_approve = 0;
                }

                $response['success'] = "1";
                $response['register'] = "Doctor Get Successfully";
                $response['data'] = $data;
            }
        }
        // return json_encode($response, JSON_NUMERIC_CHECK);
        return json_encode($response);

    }

    public function place_subscription(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'subscription_id' => 'required',
            'payment_method_nonce' => 'required',
            'amount' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'subscription_id.required' => "subscription_id is required",
            'payment_method_nonce.required' => "payment_method_nonce is required",
            'amount.required' => "amount is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $gateway = new \Braintree\Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY')
            ]);
            $nonce = $request->get("payment_method_nonce");
            $result = $gateway->transaction()->sale([
                'amount' => $request->get("amount"),
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
            if ($result->success) {
                $transaction = $result->transaction;
                DB::beginTransaction();
                try {

                    $data = new Subscriber();
                    $data->doctor_id = $request->get("doctor_id");
                    $data->payment_type = '1';
                    $data->amount = $request->get("amount");
                    $data->date = $this->getsitedateall();
                    $data->subscription_id = $request->get("subscription_id");

                    $data->status = "2";
                    $data->transaction_id = $transaction->id;
                    $data->save();

                    DB::commit();
                    $response['success'] = "1";
                    $response['register'] = "Subscription Book Successfully";

                } catch (\Exception $e) {
                    DB::rollback();
                    $response['success'] = "0";
                    $response['register'] = $e;
                }
            } else {
                $errorString = "";
                foreach ($result->errors->deepAll() as $error) {
                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                }
                $response['success'] = "0";
                $response['register'] = $errorString;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    public function subscription_upload(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'subscription_id' => 'required',
            // 'file' => 'required',
            'amount' => 'required',
            // 'description'=>'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'subscription_id.required' => "subscription_id is required",
            // 'file.required' => "file is required",
            'amount.required' => "amount is required",
            // 'description.required' => "description is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = new Subscriber();
            $data->doctor_id = $request->get("doctor_id");
            $data->subscription_id = $request->get("subscription_id");
            $data->payment_type = $request->get("payment_type");
            $data->amount = $request->get("amount");
            $data->date = $this->getsitedateall();
            $data->description = $request->get("description");
            // $data->status = "1";
            $data->is_complet = '1';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/upload/bank_receipt/';
                $picture = time() . '.' . $extension;
                $destinationPath = public_path() . $folderName;
                $request->file('file')->move($destinationPath, $picture);
                $data->deposit_image = $picture;
                $data->status = "2";
            } else {
                $data->status = "1";
            }

            $data->save();
            if ($request->get("payment_type") == 2) {
                $url = "";
            } else {
                $url = route('make-payment', ['id' => $data->id, "type" => '2']);
            }
            if ($data) {
                $response['success'] = "1";
                $response['msg'] = "Subscription Book Successfully";
                $response['url'] = $url;
                $response['id'] = $data->id;
            } else {
                $response['success'] = "0";
                $response['msg'] = "Something Getting Worng";
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);
    }

    public function appointmentdetail(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'id' => 'required',
            'type' => 'required'
        ];

        $messages = array(
            'id.required' => "id is required",
            'type.required' => "type is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = BookAppointment::with('doctorls', 'patientls')->find($request->get("id"));
            $ls = array();
            if ($data) {
                if ($request->get("type") == 1) { //patients
                    $ls['doctor_image'] = isset($data->doctorls->image) ? asset("public/upload/doctors") . '/' . $data->doctorls->image : "";
                    $ls['doctor_name'] = isset($data->doctorls) ? $data->doctorls->name : "";
                    $ls['user_image'] = isset($data->patientls->profile_pic) ? asset("public/upload/profile") . '/' . $data->patientls->profile_pic : "";
                    $ls['user_name'] = isset($data->patientls) ? $data->patientls->name : "";
                    $ls['status'] = $data->status;
                    $ls['doctor_id'] = $data->doctor_id;
                    $ls['user_id'] = $data->user_id;
                    $ls['date'] = $data->date;
                    $ls['slot'] = $data->slot_name;
                    $ls['phone'] = isset($data->doctorls) ? $data->doctorls->phoneno : "";
                    ;
                    $ls['email'] = isset($data->doctorls) ? $data->doctorls->email : "";
                    ;
                    $ls['description'] = $data->user_description;
                    $ls['connectycube_user_id'] = $data->doctorls->connectycube_user_id;
                    $ls['id'] = $data->id;
                    if ($data->prescription_file != "") {
                        $ls['prescription'] = asset('public/upload/prescription') . '/' . $data->prescription_file;
                    } else {
                        $ls['prescription'] = "";
                    }
                    $ls['device_token'] = TokenData::select('token', 'type')->where("doctor_id", $data->doctor_id)->distinct('token')->get();
                    $date12 = date('Y-m-d H:i:s', strtotime($data->date . ' ' . $data->slot_name));
                    $date22 = $this->getsitedatetime();
                    $date1 = date_create($date12);
                    $date2 = date_create($date22);

                    if ($data->date != $this->getsitedate()) {
                        $ls['remain_time'] = "00:00:00";
                    } else {

                        if (strtotime($date12) < strtotime($date22)) {
                            $ls['remain_time'] = "00:00:00";
                        } else {
                            $diff = $date1->diff($date2);
                            $ls['remain_time'] = $diff->format("%H:%I:%S");
                        }
                    }
                    $sdchule_id = SlotTiming::find($data->slot_id) ? SlotTiming::find($data->slot_id)->schedule_id : '0';
                    $ls['is_appointment_time'] = 0;

                    if ($sdchule_id != 0) {
                        //echo $this->getsitedate();exit;
                        if ($data->date == $this->getsitedate()) {
                            $duration = Schedule::find($sdchule_id) ? Schedule::find($sdchule_id)->duration : 0;
                            $current_time = $this->getsitecurrenttime();
                            $sunrise = SlotTiming::find($data->slot_id) ? date("H:i", strtotime(SlotTiming::find($data->slot_id)->slot)) : 0;
                            $sunset = date("H:i", strtotime("+15 minutes", strtotime($sunrise)));
                            // echo $current_time." sunrise ".$sunrise." sunset".$sunset.' '.$sdchule_id;exit;
                            if (strtotime($current_time) >= strtotime($sunrise) && strtotime($current_time) <= strtotime($sunset)) {
                                $ls['is_appointment_time'] = 1;
                            }
                        }

                    }



                } else { //doctor
                    $ls['user_image'] = isset($data->patientls->profile_pic) ? asset("public/upload/profile") . '/' . $data->patientls->profile_pic : "";
                    $ls['user_name'] = isset($data->patientls) ? $data->patientls->name : "";
                    $ls['doctor_name'] = isset($data->doctorls) ? $data->doctorls->name : "";
                    $ls['doctor_image'] = isset($data->doctorls->image) ? asset("public/upload/doctors") . '/' . $data->doctorls->image : "";

                    $ls['status'] = $data->status;
                    $ls['date'] = $data->date;
                    $ls['doctor_id'] = $data->doctor_id;
                    $ls['user_id'] = $data->user_id;
                    $ls['slot'] = $data->slot_name;
                    $ls['phone'] = $data->phone;
                    $ls['email'] = isset($data->patientls) ? $data->patientls->email : "";
                    $ls['connectycube_user_id'] = $data->patientls->connectycube_user_id;
                    $ls['description'] = $data->user_description;
                    $ls['id'] = $data->id;
                    if ($data->prescription_file != "") {
                        $ls['prescription'] = asset('public/upload/prescription') . '/' . $data->prescription_file;
                    } else {
                        $ls['prescription'] = "";
                    }
                    $ls['device_token'] = TokenData::select('token', 'type')->where("user_id", $data->user_id)->distinct('token')->get();
                    $date12 = date('Y-m-d H:i:s', strtotime($data->date . ' ' . $data->slot_name));
                    $date22 = $this->getsitedatetime();
                    $date1 = date_create($date12);
                    $date2 = date_create($date22);
                    // echo $date12."=>".$date22;exit;
                    if ($data->date != $this->getsitedate()) {
                        $ls['remain_time'] = "00:00:00";
                    } else {

                        if (strtotime($date12) < strtotime($date22)) {
                            $ls['remain_time'] = "00:00:00";
                        } else {
                            $diff = $date1->diff($date2);
                            $ls['remain_time'] = $diff->format("%H:%I:%S");
                        }
                    }
                    $sdchule_id = SlotTiming::find($data->slot) ? SlotTiming::find($data->slot)->schedule_id : '0';
                    $ls['is_appointment_time'] = 0;

                    if ($sdchule_id != 0) {
                        //echo $this->getsitedate();exit;
                        if ($data->date == $this->getsitedate()) {
                            $duration = Schedule::find($sdchule_id) ? Schedule::find($sdchule_id)->duration : 0;
                            $current_time = $this->getsitecurrenttime();
                            $sunrise = SlotTiming::find($data->slot_id) ? date("H:i", strtotime(SlotTiming::find($data->slot_id)->slot)) : 0;
                            $sunset = date("H:i", strtotime("+15 minutes", strtotime($sunrise)));
                            // echo $current_time." sunrise ".$sunrise." sunset".$sunset.' '.$sdchule_id;exit;
                            if (strtotime($current_time) >= strtotime($sunrise) && strtotime($current_time) <= strtotime($sunset)) {
                                $ls['is_appointment_time'] = 1;
                            }
                        }

                    }
                }
                $response['success'] = "1";
                $response['register'] = "Appointment Detail Get Successfully";
                $response['data'] = $ls;
            } else {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            }

        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function doctoreditprofile(Request $request)
    {
        // Log::info('Received request:', $request->all());
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            "doctor_id" => 'required',
            "name" => 'required',
            "email" => "required",
            "aboutus" => "required",
            "working_time" => "required",
            "address" => "required",
            "lat" => "required",
            "lon" => "required",
            "phoneno" => "required",
            "services" => "required",
            "languages" => "required",
            "department_id" => "required",
            "facebook_url" => "required",
            "twitter_url" => "required",
            "consultation_fees" => "required"
            //"time_json"=>"required"
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'name.required' => "name is required",
            'email.required' => "email is required",
            'aboutus.required' => "aboutus is required",
            'working_time.required' => "working_time is required",
            'address.required' => "address is required",
            'lat.required' => "lat is required",
            'lon.required' => "lon is required",
            'phoneno.required' => "phoneno is required",
            'services.required' => "services is required",
            'languages.required' => "languages is required",
            'department_id.required' => "department_id is required",
            'facebook_url.required' => "facebook_url is required",
            'twitter_url.required' => "twitter_url is required",
            'consultation_fees.required' => "consultation_fees is required"
            //'time_json.required' => "time_json is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        // Log::info('Raw services:', $request->input('services'));
        // Log::info('Raw languages:', $request->input('languages'));
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $store = Doctors::find($request->get("doctor_id"));
            if ($store) {
                DB::beginTransaction();
                try {
                    $img_url = $store->image;
                    $rel_url = $store->image;
                    if ($request->file('image')) {

                        $file = $request->file('image');
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension() ?: 'png';
                        $folderName = '/upload/doctors/';
                        $picture = time() . '.' . $extension;
                        $destinationPath = public_path() . $folderName;
                        $request->file('image')->move($destinationPath, $picture);
                        $img_url = $picture;
                        $image_path = public_path() . "/upload/doctors/" . $rel_url;
                        if (file_exists($image_path) && $rel_url != "") {
                            try {
                                unlink($image_path);
                            } catch (Exception $e) {

                            }
                        }
                    }

                    $uploadedImagePaths = [];
                    if ($request->hasFile('images')) {
                        foreach ($request->file('images') as $file) {
                            $extension = $file->getClientOriginalExtension() ?: 'png';
                            $folderName = '/upload/doctors/';
                            $picture = time() . '_' . uniqid() . '.' . $extension;
                            $destinationPath = public_path() . $folderName;
                            $file->move($destinationPath, $picture);
                            $uploadedImagePaths[] = $folderName . $picture; // Save the complete path
                        }
                    }

                    // Concatenate image filenames with existing ones (if any)
                    $existingImagePaths = json_decode($store->images, true) ?: [];
                    $uploadedImagePaths = array_merge($existingImagePaths, $uploadedImagePaths);

                    // Update 'images' field in the database
                    $store->images = json_encode($uploadedImagePaths);

                    $store->name = $request->get("name");
                    $store->department_id = $request->get("department_id");
                    $store->password = $request->get("password");
                    $store->phoneno = $request->get("phoneno");
                    $store->aboutus = $request->get("aboutus");
                    // $selectedServices = is_array($request->input('services')) ? implode(',', $request->input('services')) : '';
                    // $selectedLanguages = is_array($request->input('languages')) ? implode(',', $request->input('languages')) : '';

                    // $selectedServices = explode(',', $request->input('services'));
                    // $selectedLanguages = explode(',', $request->input('languages'));
                    // $selectedServices = implode(',', $request->input('services', []));
                    // $selectedLanguages = implode(',', $request->input('languages', []));
                    // $store->services = $request->get("services");
                    $selectedServices = implode(',', explode(',', $request->input('services')));
                    $selectedLanguages = implode(',', explode(',', $request->input('languages')));
                    $store->services = $selectedServices;
                    // $store->languages = $request->get("languages");
                    $store->languages = $selectedLanguages;
                    $store->address = $request->get("address");
                    $store->lat = $request->get("lat");
                    $store->lon = $request->get("lon");
                    $store->facebook_url = $request->get("facebook_url");
                    $store->twitter_url = $request->get("twitter_url");
                    $store->email = $request->get("email");
                    $store->working_time = $request->get("working_time");
                    $store->consultation_fees = $request->get("consultation_fees");
                    $store->image = $img_url;
                    $store->save();
                    if ($request->get("time_json") != "") {
                        $datadesc = json_decode($request->get("time_json"), true);
                        $arr = $datadesc['timing'];
                        $i = 0;
                        $removedata = Schedule::where("doctor_id", $request->get("doctor_id"))->get();
                        if (count($removedata) > 0) {
                            foreach ($removedata as $k) {
                                $findslot = SlotTiming::where("schedule_id", $k->id)->delete();
                                $k->delete();
                            }
                        }
                        foreach ($arr as $k) {
                            foreach ($k as $l) {
                                $getslot = $this->getslotvalue($l['start_time'], $l['end_time'], $l['duration']);
                                $store = new Schedule();
                                $store->doctor_id = $request->get("doctor_id");
                                $store->day_id = $i;
                                $store->start_time = $l['start_time'];
                                $store->end_time = $l['end_time'];
                                $store->duration = $l['duration'];
                                $store->save();
                                foreach ($getslot as $g) {
                                    $aslot = new SlotTiming();
                                    $aslot->schedule_id = $store->id;
                                    $aslot->slot = $g;
                                    $aslot->save();
                                }
                            }
                            $i++;
                        }
                    }
                    DB::commit();
                    $response['success'] = "1";
                    $response['register'] = "Profile Update Successfully";
                    return json_encode($response, JSON_NUMERIC_CHECK);
                } catch (Exception $e) {
                    DB::rollback();
                    Log::error("Exception occurred: " . $e->getMessage());
                    $response['success'] = "0";
                    $response['register'] = "Something Wrong";
                    return json_encode($response, JSON_NUMERIC_CHECK);
                }
            } else {
                $response['success'] = "0";
                $response['register'] = "Doctor Not Found";
                return json_encode($response, JSON_NUMERIC_CHECK);
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function getslotvalue($start_time, $end_time, $duration)
    {
        $datetime1 = strtotime($start_time);
        $datetime2 = strtotime($end_time);
        $interval = abs($datetime2 - $datetime1);
        $minutes = round($interval / 60);
        $noofslot = $minutes / $duration;
        $slot = array();
        if ($noofslot > 0) {
            for ($i = 0; $i < $noofslot; $i++) {
                $a = $duration * $i;
                $slot[] = date("h:i A", strtotime("+" . $a . " minutes", strtotime($start_time)));
            }
        }
        return $slot;
    }

    public function getdoctorschedule(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = Doctors::find($request->get("doctor_id"));

            if (empty($data)) {
                $response['success'] = "0";
                $response['register'] = "Doctor Not Found";
            } else {
                $data = Schedule::with('getslotls')->where("doctor_id", $request->get("doctor_id"))->get();
                $response['success'] = "1";
                $response['register'] = "Doctor Get Successfully";
                $response['data'] = $data;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function usereditprofile(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ];

        $messages = array(
            'id.required' => "id is required",
            'name.required' => "name is required",
            'email.required' => "email is required",
            'phone.required' => "phone is required",
            'password.required' => "password is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data1 = Patient::find($request->get("id"));

            if (empty($data1)) {
                $response['success'] = "0";
                $response['register'] = "Patient Not Found";
            } else {

                $checkemail = Patient::where("email", $request->get("email"))->where("id", '!=', $request->get("id"))->first();
                if ($checkemail) {
                    $response['success'] = "0";
                    $response['register'] = "Email Already Use By Other User";
                } else {
                    $img_url = $data1->profile_pic;
                    $rel_url = $data1->profile_pic;
                    if ($request->file('image')) {

                        $file = $request->file('image');
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension() ?: 'png';
                        $folderName = '/upload/profile/';
                        $picture = time() . '.' . $extension;
                        $destinationPath = public_path() . $folderName;
                        $request->file('image')->move($destinationPath, $picture);
                        $img_url = $picture;
                        $image_path = public_path() . "/upload/profile/" . $rel_url;
                        if (file_exists($image_path) && $rel_url != "") {
                            try {
                                unlink($image_path);
                            } catch (Exception $e) {

                            }
                        }
                    }
                    $data1->name = $request->get("name");
                    $data1->email = $request->get("email");
                    $data1->password = $request->get("password");
                    $data1->phone = $request->get("phone");
                    $data1->profile_pic = $img_url;
                    $data1->save();
                    $response['success'] = "1";
                    $response['register'] = "User Get Successfully";
                    $response['data'] = $data1;
                }

            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function saveReportspam(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ];

        $messages = array(
            'user_id.required' => "user_id is required",
            'title.required' => "title is required",
            'description.required' => "description is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {

            $store = new Reportspam();
            $store->user_id = $request->get("user_id");
            $store->title = $request->get("title");
            $store->description = $request->get("description");
            $store->save();
            $response['success'] = "1";
            $response['register'] = "Report Send Successfully";
            $response['data'] = $store;



        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function user_reject_appointment(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'user_id' => 'required',
            'id' => 'required'
        ];

        $messages = array(
            'user_id.required' => "user_id is required",
            'id.required' => "id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {

            $data = BookAppointment::where("id", $request->get("id"))->where("user_id", $request->get("user_id"))->first();
            if ($data) {
                $data->status = 5;
                $data->save();
                $response['success'] = "1";
                $response['register'] = "Appointment Reject Successfully";
            } else {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            }

        }
        return json_encode($response, JSON_NUMERIC_CHECK);


    }

    public function appointmentstatuschange(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'app_id' => 'required',
            'status' => 'required'
        ];
        if ($request->input('status') == 4) {
            $rules['prescription'] = 'required';
        }

        $messages = array(
            'app_id.required' => "app_id is required",
            'status.required' => "status is required",
            "prescription" => "prescription is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {

            $getapp = BookAppointment::with('doctorls', 'patientls')->find($request->get("app_id"));
            if ($getapp) {
                $getapp->status = $request->get("status");
                if ($request->hasFile('prescription')) {
                    $file = $request->file('prescription');
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension() ?: 'png';
                    $folderName = '/upload/prescription/';
                    $picture = time() . '.' . $extension;
                    $destinationPath = public_path() . $folderName;
                    $request->file('prescription')->move($destinationPath, $picture);
                    $getapp->prescription_file = $picture;
                }
                $getapp->save();
                if ($request->get("status") == '3') { // in process
                    $msg = __("apimsg.Your Appointment  has been accept by") . " " . $getapp->doctorls->name . " " . __("apimsg.for time") . "" . $getapp->date . ' ' . $getapp->slot_name;
                } else if ($request->get("status") == '5') { //reject
                    $msg = __("apimsg.Your Appointment  has been reject By") . " " . $getapp->doctorls->name;
                    Settlement::where("book_id", $request->get("app_id"))->delete();
                } else if ($request->get("status") == '4') { //complete
                    $msg = __("apimsg.Your Appointment  with") . " " . $getapp->doctorls->name . " is completed";
                } else if ($request->get("status") == '0') { //absent
                    $msg = __("apimsg.You were absent on your appointment with") . " " . $getapp->doctorls->name;
                } else if ($request->get("status") == '6') { //absent
                    $msg = __("apimsg.Your appointment cancel with") . " " . $getapp->doctorls->name;
                } else {
                    $msg = "";
                }
                $user = User::find(1);

                $android = $this->send_notification_android($user->android_key, $msg, $getapp->user_id, "user_id", $getapp->id);
                $ios = $this->send_notification_IOS($user->ios_key, $msg, $getapp->user_id, "user_id", $getapp->id);
                $response['success'] = "1";
                $response['msg'] = $msg;
                try {
                    if ($getapp->prescription_file != "") {
                        $user = Patient::find($getapp->user_id);
                        $user->msg = $msg;
                        $user->prescription = $getapp->prescription_file;
                        $user->email = "redixbit.jalpa@gmail.com";
                        $result = Mail::send('email.Ordermsg', ['user' => $user], function ($message) use ($user) {
                            $message->to($user->email, $user->name)->subject(__('message.System Name'));
                            $message->attach(asset('public/upload/prescription') . '/' . $user->prescription);

                        });
                    } else {
                        $user = Patient::find($getapp->user_id);
                        $user->msg = $msg;
                        //$user->email="redixbit.jalpa@gmail.com";
                        $result = Mail::send('email.Ordermsg', ['user' => $user], function ($message) use ($user) {
                            $message->to($user->email, $user->name)->subject(__('message.System Name'));

                        });
                    }


                } catch (\Exception $e) {
                }
            } else {
                $response['success'] = "0";
                $response['msg'] = "Appointment Not Found";
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function send_notification_android($key, $msg, $id, $field, $order_id)
    {
        $getuser = TokenData::where("type", 1)->where($field, $id)->get();

        $i = 0;
        if (count($getuser) != 0) {

            $reg_id = array();
            foreach ($getuser as $gt) {
                $reg_id[] = $gt->token;
            }
            $regIdChunk = array_chunk($reg_id, 1000);
            foreach ($regIdChunk as $k) {
                $registrationIds = $k;
                $message = array(
                    'message' => $msg,
                    'title' => __('message.notification')
                );
                $message1 = array(
                    'body' => $msg,
                    'title' => __('message.notification'),
                    'type' => $field,
                    'order_id' => $order_id,
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
                );
                //echo "<pre>";print_r($message1);exit;
                $fields = array(
                    'registration_ids' => $registrationIds,
                    'data' => $message1,
                    'notification' => $message1
                );

                // echo "<pre>";print_r($fields);exit;
                $url = 'https://fcm.googleapis.com/fcm/send';
                $headers = array(
                    'Authorization: key=' . $key, // . $api_key,
                    'Content-Type: application/json'
                );
                $json = json_encode($fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                $result = curl_exec($ch);
                //echo "<pre>";print_r($result);exit;
                if ($result === FALSE) {
                    die('Curl failed: ' . curl_error($ch));
                }
                curl_close($ch);
                $response[] = json_decode($result, true);
            }
            $succ = 0;
            foreach ($response as $k) {
                $succ = $succ + $k['success'];
            }
            if ($succ > 0) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public function send_notification_IOS($key, $msg, $id, $field, $order_id)
    {
        $getuser = TokenData::where("type", 2)->where($field, $id)->get();
        if (count($getuser) != 0) {
            $reg_id = array();
            foreach ($getuser as $gt) {
                $reg_id[] = $gt->token;
            }

            $regIdChunk = array_chunk($reg_id, 1000);
            foreach ($regIdChunk as $k) {
                $registrationIds = $k;
                $message = array(
                    'message' => $msg,
                    'title' => __('message.notification')
                );
                $message1 = array(
                    'body' => $msg,
                    'title' => __('message.notification'),
                    'type' => $field,
                    'order_id' => $order_id,
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
                );
                $fields = array(
                    'registration_ids' => $registrationIds,
                    'data' => $message1,
                    'notification' => $message1
                );
                $url = 'https://fcm.googleapis.com/fcm/send';
                $headers = array(
                    'Authorization: key=' . $key, // . $api_key,
                    'Content-Type: application/json'
                );
                $json = json_encode($fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    die('Curl failed: ' . curl_error($ch));
                }
                curl_close($ch);
                $response[] = json_decode($result, true);
            }
            $succ = 0;
            foreach ($response as $k) {
                $succ = $succ + $k['success'];
            }
            if ($succ > 0) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public function forgotpassword(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'type' => 'required',
            'email' => 'required'
        ];

        $messages = array(
            'type.required' => "type is required",
            'email.required' => "email is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            if ($request->get("type") == 1) { //patient
                $checkmobile = Patient::where("email", $request->get("email"))->first();
            } else { // doctor
                $checkmobile = Doctors::where("email", $request->get("email"))->first();
            }
            if ($checkmobile) {
                $code = mt_rand(100000, 999999);
                $store = array();
                $store['email'] = $checkmobile->email;
                $store['name'] = $checkmobile->name;
                $store['code'] = $code;
                $add = new ResetPassword();
                $add->user_id = $checkmobile->id;
                $add->code = $code;
                $add->type = $request->get("type");
                $add->save();

                Mail::send('email.reset_password', ['user' => $store], function ($message) use ($store) {
                    $message->to($store['email'], $store['name'])->subject(__("message.System Name"));
                });

                exit();
                try {
                    $result = Mail::send('email.reset_password', ['user' => $store], function ($message) use ($store) {
                        $message->to($store['email'], $store['name'])->subject(__("message.System Name"));
                    });

                } catch (\Exception $e) {
                }

                $response['success'] = "1";
                $response['msg'] = "Mail Send Successfully";

            } else {
                $response['success'] = "0";
                $response['msg'] = "Email Not Found";

            }

        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function getholiday(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'doctor_id' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $data = Doctor_Hoilday::where("doctor_id", $request->get("doctor_id"))->orderby('id', 'DESC')->get();
            if (count($data) > 0) {
                $response['success'] = "1";
                $response['msg'] = "Get Hoilday List";
                $response['data'] = $data;
            } else {
                $response['success'] = "0";
                $response['msg'] = "No Holiday Found";
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function saveholiday(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required'

        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'id.required' => "id is required",
            'start_date.required' => "start_date is required",
            'end_date.required' => "end_date is required",
            'description.required' => "description is required",
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            if ($request->get('id') == 0) {
                $store = new Doctor_Hoilday();
                $store->doctor_id = $request->get("doctor_id");
                $store->start_date = $request->get("start_date");
                $store->end_date = $request->get("end_date");
                $store->description = $request->get("description");
                $store->save();
                $response['success'] = "1";
                $response['msg'] = "Hoilday Add Successfully";
                $response['data'] = $store;
            } else {
                $store = Doctor_Hoilday::find($request->get('id'));
                if ($store) {
                    $store->doctor_id = $request->get("doctor_id");
                    $store->start_date = $request->get("start_date");
                    $store->end_date = $request->get("end_date");
                    $store->description = $request->get("description");
                    $store->save();
                    $response['success'] = "1";
                    $response['msg'] = "Hoilday Update Successfully";
                    $response['data'] = $store;
                } else {
                    $response['success'] = "0";
                    $response['msg'] = "Data Not Update";
                }
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function deleteholiday(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'id' => 'required'
        ];

        $messages = array(
            'id.required' => "id is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $date = $request->get("date");
            $data = Doctor_Hoilday::find($request->get("id"));
            if (!empty($data)) {
                $data->delete();
                $response['success'] = "1";
                $response['msg'] = "Holiday Delete Successfully";
            } else {
                $response['success'] = "0";
                $response['msg'] = "Hoilday Not Found";
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function checkholiday(Request $request)
    {
        $response = array("success" => "0", "msg" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'date' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'date.required' => "date is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $date = $request->get("date");
            $data = Doctor_Hoilday::where("start_date", "<=", $date)->where("end_date", ">=", $date)->where("doctor_id", $request->get("doctor_id"))->first();
            // echo "<pre>";print_r($data);exit;
            if (empty($data)) {
                $response['success'] = "1";
                $response['msg'] = "Working Day";
            } else {
                $response['success'] = "0";
                $response['msg'] = "Hoilday";
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function mediaupload(Request $request)
    {
        // dd($request->all());
        $response = array("status" => 0, "msg" => "Validation error");
        $rules = [
            'file' => 'required'
        ];
        $messages = array(
            'file.required' => "file is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['msg'] = $message;
        } else {

            $img_url = "";
            $type = "";
            // echo "<pre>";print_r($_FILES);exit;
            if ($request->file("file")) {

                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension() ?: 'mp4';
                $folderName = '/upload/chat';
                $picture = time() . '.' . $extension;
                $destinationPath = public_path() . $folderName;
                $request->file('file')->move($destinationPath, $picture);
                $img_url = $picture;

                $response = array("status" => 1, "msg" => "Media Upload Successfully", "data" => $img_url);
                return Response::json($response);
            } else {
                $response = array("status" => 0, "msg" => "Media Not Upload", "data" => array());
                return Response::json($response);
            }
        }
        return Response::json($response);
    }

    public function banner_list(Request $request)
    {
        $data = Banner::select('id', 'image')->orderby('id', 'DESC')->get();
        if (count($data) > 0) {
            $response['status'] = 1;
            $response['msg'] = "Banner List";
            $response['data'] = $data;

        } else {
            $data3 = array();
            $response['status'] = 0;
            $response['message'] = "Data Not Found";
            $response['data'] = $data3;
        }
        return Response::json($response);
    }

    public function income_report(Request $request)
    {
        $response = array("success" => "0", "register" => "Validation error");
        $rules = [
            'doctor_id' => 'required',
            'duration' => 'required'
        ];

        $messages = array(
            'doctor_id.required' => "doctor_id is required",
            'duration.required' => "duration is required"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $message = '';
            $messages_l = json_decode(json_encode($validator->messages()), true);
            foreach ($messages_l as $msg) {
                $message .= $msg[0] . ", ";
            }
            $response['register'] = $message;
        } else {
            $date = Carbon::now();

            if ($request->get("duration") == "today") {

                $data = BookAppointment::orderby('id', "DESC")->where("doctor_id", $request->get("doctor_id"))->where('is_completed', '1')->whereDate('created_at', '=', $date)->select("date", "id", "consultation_fees", "created_at")->paginate(10);

            } else if ($request->get("duration") == "last 7 days") {

                $date = Carbon::now()->subDays(7);
                $data = BookAppointment::orderby('id', "DESC")->where("doctor_id", $request->get("doctor_id"))->where('is_completed', '1')->whereDate('created_at', '>=', $date)->select("date", "id", "consultation_fees", "created_at")->paginate(10);

            } else if ($request->get("duration") == "last 30 days") {

                $date = Carbon::now()->subDays(30);
                $data = BookAppointment::orderby('id', "DESC")->where("doctor_id", $request->get("doctor_id"))->where('is_completed', '1')->whereDate('created_at', '>=', $date)->select("date", "id", "consultation_fees", "created_at")->paginate(10);

            } else {

                $date = explode(',', $request->get("duration"));
                $start = $date[0];
                $end = $date[1];
                $data = BookAppointment::orderby('id', "DESC")->where("doctor_id", $request->get("doctor_id"))->where('is_completed', '1')->whereBetween(DB::raw('DATE(created_at)'), [$start, $end])->select("date", "id", "consultation_fees", "created_at")->paginate(10);

            }

            if (count($data) == 0) {
                $response['success'] = "0";
                $response['register'] = "Appointment Not Found";
            } else {
                $report = array();

                foreach ($data as $d) {
                    $created_at = date('Y-m-d', strtotime($d->created_at));

                    $visitors = BookAppointment::select(DB::raw("(DATE_FORMAT(created_at, '%Y-%m-%d'))"))->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                        ->where("doctor_id", $request->get("doctor_id"))->where('is_completed', '1')->whereDate('created_at', $created_at)->sum('consultation_fees');

                    $report[] = array(
                        "date" => $created_at,
                        "amount" => $visitors
                    );
                }
                //  echo "<pre>";
                //  print_r($datess);
                //  exit();
                //  $date_data = array_unique($datess);

                $myArray = array_map("unserialize", array_unique(array_map("serialize", $report)));
                $total = 0;
                foreach ($myArray as $my) {
                    $totals = $total + $my['amount'];
                    $total = $totals;
                }

                $temp_array = array("income_record" => $myArray, "total_income" => $total);
                $response['success'] = "1";
                $response['register'] = "Appointment List Successfully";
                $response['data'] = $temp_array;
            }
        }
        return json_encode($response, JSON_NUMERIC_CHECK);

    }

    public function data_list(Request $request)
    {
        $banner = Banner::select('id', 'image')->orderby('id', 'DESC')->get();

        $speciality = Services::select('id', 'name', 'icon')->get();

        if (!empty($request->get("user_id"))) {
            $user_id = $request->get("user_id");
        } else {
            $user_id = 0;
        }

        $data = BookAppointment::with('doctorls')->where("date", ">=", date('Y-m-d'))->select("id", "doctor_id", "date", "slot_name as slot", 'phone')->where('is_completed', '1')->where("user_id", $user_id)->get();

        foreach ($data as $d) {
            $dr = Services::find($d->doctorls->department_id);
            if ($dr) {
                $d->department_name = $dr->name;
            }
            unset($d->doctorls->id);
            unset($d->doctorls->department_id);
            unset($d->doctorls->aboutus);
            unset($d->doctorls->services);
            unset($d->doctorls->healthcare);
            unset($d->doctorls->facebook_url);
            unset($d->doctorls->twitter_url);
            unset($d->doctorls->created_at);
            unset($d->doctorls->updated_at);
            unset($d->doctorls->is_approve);
            unset($d->doctorls->login_id);
            unset($d->doctorls->connectycube_user_id);
            unset($d->doctorls->connectycube_password);
            unset($d->doctorls->unique_id);
            unset($d->doctorls->gender);
            unset($d->doctorls->title);
            unset($d->doctorls->institution_name);
            unset($d->doctorls->birth_name);
            unset($d->doctorls->spouse_name);
            unset($d->doctorls->state);
            unset($d->doctorls->city);
        }
        $temp_array = array("banner" => $banner, "speciality" => $speciality, "appointment" => $data);

        $response['status'] = 1;
        $response['msg'] = "List";
        $response['data'] = $temp_array;


        return Response::json($response);
    }

    public function about()
    {
        $data = About::find(1);
        if ($data) {
            $response['status'] = 1;
            $response['msg'] = "About List";
            $response['data'] = $data;

        } else {
            $data3 = array();
            $response['status'] = 0;
            $response['message'] = "Data Not Found";
            $response['data'] = $data;
        }
        return Response::json($response);
    }

    public function privecy()
    {
        $data = Privecy::find(1);
        if ($data) {
            $response['status'] = 1;
            $response['msg'] = "Privecy List";
            $response['data'] = $data;

        } else {
            $data3 = array();
            $response['status'] = 0;
            $response['message'] = "Data Not Found";
            $response['data'] = $data;
        }
        return Response::json($response);
    }

    public function createTripGuide(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'guide_id' => 'required|numeric', // Assuming guide_id is a numeric field
            'location' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'duration' => 'required|numeric',
            'numberOfPeople' => 'required|numeric',
            'gender' => 'required|string',
        ]);

        // Create a new trip guide entry with the provided guide_id
        $tripGuide = TripGuide::create([
            'guide_id' => $request->input('guide_id'),
            'destination' => $request->input('location'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
            'duration' => $request->input('duration'),
            'people_quantity' => $request->input('numberOfPeople'),
            'type' => $request->input('gender'),
        ]);

        // You can return a response, such as the created trip guide
        return response()->json($tripGuide, 201);
    }

    public function getTripGuides(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'guide_id' => 'required|numeric',
        ]);

        // Retrieve trips based on the guide_id
        $guideId = $request->input('guide_id');
        $tripGuides = TripGuide::where('guide_id', $guideId)->get();


        if ($tripGuides) {
            $response['status'] = 1;
            $response['msg'] = "Trips List are";
            $response['data'] = $tripGuides;

        } else {
            $data3 = array();
            $response['status'] = 0;
            $response['message'] = "Data Not Found";
            $response['data'] = $data3;
        }
        return Response::json($response);

        // return response()->json($tripGuides, 200);
    }
}

