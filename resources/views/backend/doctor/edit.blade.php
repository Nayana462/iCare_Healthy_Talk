@extends('backend.layouts.master')

@section('main-content')

    <div class="card">
        <h5 class="card-header">Edit Doctor</h5>
        <div class="card-body">
            <form method="post" action="{{route('doctor.update',$doctor->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row" id="appendQualification">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputName" class="col-form-label">Fullname <span class="text-danger">*</span></label>
                            <input id="inputName" type="text" name="name" placeholder="Enter Full Name"  value="{{$doctor->name}}"
                                   class="form-control">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">email <span class="text-danger">*</span></label>
                            <input id="inputEmail" type="email" name="email" placeholder="Enter Email"  value="{{$doctor->email}}" class="form-control">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">Password <span class="text-danger">*</span></label>
                            <input id="inputEmail" type="password" name="password" placeholder="Enter Password"  value="{{$doctor->password}}" class="form-control">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputPhone" class="col-form-label">Phone <span class="text-danger">*</span></label>
                            <input id="inputPhone" type="text" name="phone" placeholder="Enter Phone"  value="{{$doctor->userprofile->phone}}" class="form-control">
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputCountry" class="col-form-label">Country <span class="text-danger">*</span></label>
                            <input id="inputCountry" type="text" name="country" placeholder="Enter Country"  value="{{$doctor->userprofile->country}}" class="form-control">
                            @error('country')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputState" class="col-form-label">State <span class="text-danger">*</span></label>
                            <input id="inputState" type="text" name="state" placeholder="Enter State"  value="{{$doctor->userprofile->state}}" class="form-control">
                            @error('state')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputCity" class="col-form-label">City <span class="text-danger">*</span></label>
                            <input id="inputCity" type="text" name="city" placeholder="Enter City"  value="{{$doctor->userprofile->city}}" class="form-control">
                            @error('city')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputAddress" class="col-form-label">Address <span class="text-danger">*</span></label>
                            <input id="inputAddress" type="text" name="address" placeholder="Enter Address"  value="{{$doctor->userprofile->address}}" class="form-control">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputDob" class="col-form-label">DOB <span class="text-danger">*</span></label>
                            <input id="inputDob" type="date" name="dob" placeholder="Enter DOB"  value="{{$doctor->userprofile->dob}}" class="form-control">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="inputDob" class="col-form-label">gender <span class="text-danger">*</span></label>
                            <select class="form-control" name="gender">
                                <option value="male" {{(($doctor->userprofile->gender=='male') ? 'selected' : '')}}>Male</option>
                                <option value="female" {{(($doctor->userprofile->gender=='female') ? 'selected' : '')}}>FeMale</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- {{$categories}} --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category" class="col-form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">--Select any category--</option>
                                @foreach($categories as $key=>$cat_data)
                                    <option value='{{$cat_data->id}}' <?php if($cat_id==$cat_data->id){
                                        echo 'selected';
                                    }else{
                                        echo '';
                                    }?> >{{$cat_data->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" id="image" name="image"
                                   value="{{old('image')}}">
                        </div>
                    </div>


                    <br>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail Description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>



<script type="text/javascript">
    var i = 1;
    function addMore(){
        var i2 = i++;
        var html = '';
        html +='<div class="col-md-4 '+i2+'">';
        html +='<div class="form-group">';
        html +='<label for="inputCountry" class="col-form-label">Qualification name <span class="text-danger">*</span></label>';
        html +='<input id="inputCountry" type="text" name="qualification[]" placeholder="Enter Qualification"  value="" class="form-control">';
        html +='</div>';
        html +='</div>';
        html +='</div>';

        //image section
        html +='<div class="col-md-4 '+i2+'">';
        html +='<div class="form-group">';
        html +='<label for="inputCountry" class="col-form-label">Upload Documents <span class="text-danger">*</span></label>';
        html +='<input class="form-control" type="file" id="document[]" name="document[]" value="{{old('document')}}">';
        html +='</div>';
        html +='</div>';
        html +='</div>';

        //form date
        html +='<div class="col-md-2 '+i2+'">';
        html +='<div class="form-group">';
        html +='<label for="inputCountry" class="col-form-label">From Date<span class="text-danger">*</span></label>';
        html +='<input class="form-control" type="date" id="from_date[]" name="from_date[]" value="{{old('from_date')}}">';
        html +='</div>';
        html +='</div>';
        html +='</div>';

        //to date
        html +='<div class="col-md-2 '+i2+'">';
        html +='<div class="form-group">';
        html +='<label for="inputCountry" class="col-form-label">To Date<span class="text-danger">*</span></label>';
        html +='<input class="form-control" type="date" id="to_date[]" name="to_date[]" value="{{old('from_date')}}">';
        html +='</div>';
        html +='</div>';
        html +='</div>';

        html +='<div class="col-md-2 '+i2+'">';
        html +='<div class="form-group">';
        html +='<label for="inputCountry" class="col-form-label">Remove<span class="text-danger">*</span></label>';
        html +='<input type="button" class="form-control btn-primary" onClick="removeColumn('+i2+');" value="remove">';
        html +='</div>';
        html +='</div>';


        $('#appendQualification').append(html);
    }

    function removeColumn(id){
        $('.'+id).remove();
    }
</script>
@endpush
