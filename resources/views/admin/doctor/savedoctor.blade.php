@extends('admin.layout')
@section('title')
{{__("message.save")}} {{__("message.Doctors")}} | {{__("message.Admin")}} {{__("message.Doctors")}}
@stop
@section('meta-data')
@stop
@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0">{{__("message.save")}} {{__("message.Doctors")}}</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/doctors')}}">{{__("message.Doctors")}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__("message.save")}} {{__("message.Doctors")}}</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-8">
               <div class="card">
                  <div class="card-body">
                     <form action="{{url('admin/updatedoctor')}}" class="needs-validation" method="post"
                        enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="doctor_id" value="{{$id}}">
                        <div class="row">
                           <div class="col-lg-6">
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
                                             <img src="{{$path}}" alt="..." class="img-thumbnail imgsize"
                                                id="basic_img">
                                          </button>
                                          <input type="hidden" name="basic_img" id="basic_img1" />
                                          <input type="file" name="upload_image" id="upload_image" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="name">{{__("message.Name")}}<span class="reqfield">*</span></label>
                                 <input type="text" class="form-control"
                                    placeholder='{{__("message.Enter Doctor Name")}}' id="name" name="name" required=""
                                    value="{{isset($data->name)?$data->name:''}}">
                              </div>
                              <div class="form-group">
                                 <label for="department_id">{{__("message.specialities")}}<span
                                       class="reqfield">*</span></label>
                                 <select class="form-control" name="department_id" id="department_id" required="">
                                    <option value="">
                                       {{__("message.select")}} {{__("message.specialities")}}
                                    </option>
                                    @foreach($department as $d)
                                    <option value="{{$d->id}}" <?=isset($data->
                                       department_id)&&$data->department_id==$d->id?'selected="selected"':""?>
                                       >{{$d->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="password">{{__("message.Password")}}<span class="reqfield">*</span></label>
                                 <input type="password" class="form-control" id="password"
                                    placeholder='{{__("message.Enter password")}}' name="password" required=""
                                    value="{{isset($data->password)?$data->password:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="phoneno">{{__("message.Phone")}}<span class="reqfield">*</span></label>
                                 <input type="text" class="form-control" id="phoneno"
                                    placeholder='{{__("message.Enter Phone")}}' name="phoneno" required=""
                                    value="{{isset($data->phoneno)?$data->phoneno:''}}">
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="email">{{__("message.Email")}}<span class="reqfield">*</span></label>
                                 <input type="email" class="form-control" id="email"
                                    placeholder='{{__("message.Enter Email Address")}}' name="email" required=""
                                    <?=isset($id)&&$id!=0?'readonly':""?>
                                 value="{{isset($data->email)?$data->email:''}}">
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="email">{{__("message.Working Time")}}<span
                                       class="reqfield">*</span></label>
                                 <input type="text" class="form-control" id="working_time"
                                    placeholder='{{__("message.Enter Working Time")}}' name="working_time" required=""
                                    value="{{isset($data->working_time)?$data->working_time:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="aboutus">{{__("message.consultation_fees")}}<span
                                       class="reqfield">*</span></label>
                                 <input type="number" required name="consultation_fees"
                                    value="{{isset($data->consultation_fees)?$data->consultation_fees:''}}"
                                    class="form-control" id="consultation_fees" min="1" step="0.01">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label for="aboutus">{{__("City")}}<span class="reqfield">*</span></label>
                                 <input type="text" required name="city" value="{{isset($data->city)?$data->city:''}}"
                                    class="form-control">
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group">
                                 <label>{{__("Gender")}}<span class="reqfield">*</span></label>
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderNone"
                                       value="none" {{ isset($data->gender) && $data->gender == 'none' ? 'checked' : ''
                                    }}>
                                    <label class="form-check-label" for="genderNone">
                                       None
                                    </label>
                                 </div>
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                       value="male" {{ isset($data->gender) && $data->gender == 'male' ? 'checked' : ''
                                    }}>
                                    <label class="form-check-label" for="genderMale">
                                       Male
                                    </label>
                                 </div>
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                       value="female" {{ isset($data->gender) && $data->gender == 'female' ? 'checked' :
                                    '' }}>
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
                                 <label for="aboutus">{{__("message.About Us")}}<span class="reqfield">*</span></label>
                                 <textarea id="aboutus" class="form-control" rows="5" name="aboutus"
                                    placeholder='{{__("message.Enter About Doctor")}}'
                                    required="">{{isset($data->aboutus)?$data->aboutus:''}}</textarea>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <!-- <div class="form-group">
                                 <label for="services">{{__("message.Services")}}<span class="reqfield">*</span></label>
                                 <textarea id="services" class="form-control" rows="5"
                                    placeholder='{{__("message.Enter Description about Services")}}' name="services"
                                    required="">{{isset($data->services)?$data->services:''}}</textarea>
                              </div> -->
                              <div class="form-group">
                                 <label>{{ __("message.Services") }}<span class="reqfield">*</span></label>
                                 <div>
                                    <!-- Add options dynamically from your database or use a predefined list -->
                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="translation"
                                          name="services[]" value="translation" {{ isset($data->services) &&
                                       in_array('translation',
                                       explode(',', $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="translation">Translation &
                                          Interpretation</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="shopping" name="services[]"
                                          value="shopping" {{ isset($data->services) && in_array('shopping',
                                       explode(',', $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="shopping">Shopping</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="food" name="services[]"
                                          value="food" {{ isset($data->services) && in_array('food', explode(',',
                                       $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="food">Food & Restaurants</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="art" name="services[]"
                                          value="art" {{ isset($data->services) && in_array('art',
                                       explode(',', $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="art">Art & Museums</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="history" name="services[]"
                                          value="history" {{ isset($data->services) && in_array('history', explode(',',
                                       $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="history">History & Culture</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="exploration"
                                          name="services[]" value="exploration" {{ isset($data->services)
                                       && in_array('exploration', explode(',', $data->services)) ?
                                       'checked' : '' }}>
                                       <label class="form-check-label" for="exploration">Exploration &
                                          Sightseeing</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="tours" name="services[]"
                                          value="pick" {{ isset($data->services) && in_array('pick', explode(',',
                                       $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="tours">Pick up & Driving Tours</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="nightlife" name="services[]"
                                          value="nightlife" {{ isset($data->services) && in_array('nightlife',
                                       explode(',', $data->services)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="nightlife">Nightlife & Bars</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="sports" name="services[]"
                                          value="sports" {{ isset($data->services) && in_array('sports', explode(',',
                                       $data->services)) ? 'checked' : '' }}>
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
                                 <label for="languages">{{__("message.Languages")}}<span
                                       class="reqfield">*</span></label>
                                 <select id="languages" class="form-control" name="languages[]" multiple required="">
                                    Add options dynamically from your database or use a predefined list
                                    <option value="english" {{ isset($data->languages) && in_array('english',
                                       explode(',', $data->languages)) ? 'selected' : '' }}>English</option>
                                    <option value="bengali" {{ isset($data->languages) && in_array('bengali',
                                       explode(',', $data->languages)) ? 'selected' : '' }}>Bengali</option>
                                    <option value="hindi" {{ isset($data->languages) && in_array('hindi',
                                       explode(',', $data->languages)) ? 'selected' : '' }}>Hindi</option>
                                    <option value="urdu" {{ isset($data->languages) && in_array('urdu',
                                       explode(',', $data->languages)) ? 'selected' : '' }}>Urdu</option>
                                    <option value="french" {{ isset($data->languages) && in_array('french',
                                       explode(',', $data->languages)) ? 'selected' : '' }}>French</option>
                                    <option value="spanish" {{ isset($data->languages) && in_array('spanish',
                                       explode(',', $data->languages)) ? 'selected' : '' }}>Spanish</option>
                                    Add more languages as needed
                                 </select>
                              </div> -->
                              <div class="form-group">
                                 <label>{{ __("message.Languages") }}<span class="reqfield">*</span></label>
                                 <div>
                                    <!-- Add options dynamically from your database or use a predefined list -->
                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="english" name="languages[]"
                                          value="english" {{ isset($data->languages) && in_array('english', explode(',',
                                       $data->languages)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="english">English</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="bengali" name="languages[]"
                                          value="bengali" {{ isset($data->languages) && in_array('bengali', explode(',',
                                       $data->languages)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="bengali">Bengali</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="hindi" name="languages[]"
                                          value="hindi" {{ isset($data->languages) && in_array('hindi', explode(',',
                                       $data->languages)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="hindi">Hindi</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="urdu" name="languages[]"
                                          value="urdu" {{ isset($data->languages) && in_array('urdu', explode(',',
                                       $data->languages)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="urdu">Urdu</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="french" name="languages[]"
                                          value="french" {{ isset($data->languages) && in_array('french', explode(',',
                                       $data->languages)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="french">French</label>
                                    </div>

                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" id="spanish" name="languages[]"
                                          value="spanish" {{ isset($data->languages) && in_array('spanish', explode(',',
                                       $data->languages)) ? 'checked' : '' }}>
                                       <label class="form-check-label" for="spanish">Spanish</label>
                                    </div>
                                    <!-- Add more languages as needed -->
                                 </div>
                              </div>

                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="facebook_url">{{__("message.Facebook Url")}}<span
                                       class="reqfield">*</span></label>
                                 <input type="text" class="form-control" id="facebook_url" name="facebook_url"
                                    placeholder='{{__("message.Enter Facebook Url")}}'
                                    value="{{isset($data->facebook_url)?$data->facebook_url:''}}" required="">
                              </div>
                              <div class="form-group">
                                 <label for="twitter_url">{{__("message.Twitter Url")}}<span
                                       class="reqfield">*</span></label>
                                 <input type="text" class="form-control" id="twitter_url" name="twitter_url"
                                    placeholder='{{__("message.Enter Twitter Url")}}'
                                    value="{{isset($data->twitter_url)?$data->twitter_url:''}}" required="">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 p-0" id="addressorder">
                           <label>{{__("message.Address")}}<span class="reqfield">*</span></label>
                           <input type="text" id="us2-address" name="address"
                              placeholder='{{__("message.Search Location")}}' required data-parsley-required="true"
                              required="" />
                        </div>
                        <div class="map" id="maporder">
                           <div class="form-group">
                              <div class="col-md-12 p-0">
                                 <div id="us2"></div>
                              </div>
                           </div>
                        </div>
                        <input type="hidden" name="lat" id="us2-lat"
                           value="{{isset($data->lat)?$data->lat:Config::get('mapdetail.lat')}}" />
                        <input type="hidden" name="lon" id="us2-lon"
                           value="{{isset($data->lon)?$data->lon:Config::get('mapdetail.long')}}" />
                        <div class="row">
                           <div class="form-group">
                              @if(Session::get("is_demo")=='0')
                              <button type="button" onclick="disablebtn()"
                                 class="btn btn-primary">{{__('message.Submit')}}</button>
                              @else
                              <button class="btn btn-primary" type="submit"
                                 value="Submit">{{__("message.Submit")}}</button>
                              @endif

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
@stop
@section('footer')
@stop