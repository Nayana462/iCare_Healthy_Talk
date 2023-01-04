@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Doctor</h5>
    <div class="card-body">
      <form method="post" action="{{route('doctor.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row" id="appendQualification">

      <div class="col-md-4">
        <div class="form-group">
          <label for="inputName" class="col-form-label">Fullname <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter Full Name"  value="{{old('name')}}"
           class="form-control">
          @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

        <div class="col-md-4">
        <div class="form-group">
          <label for="inputEmail" class="col-form-label">email <span class="text-danger">*</span></label>
          <input id="inputEmail" type="email" name="email" placeholder="Enter Email"  value="{{old('email')}}" class="form-control" required>
          @error('email')
            <span class="text-danger">{{$errors->first('email')}}</span>
          @enderror
        </div>
      </div>

        <div class="col-md-4">
        <div class="form-group">
          <label for="inputEmail" class="col-form-label">Password <span class="text-danger">*</span></label>
          <input id="inputEmail" type="password" name="password" placeholder="Enter Password"  value="{{old('password')}}" class="form-control" required>
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="inputPhone" class="col-form-label">Phone <span class="text-danger">*</span></label>
          <input id="inputPhone" type="number" name="phone" placeholder="Enter Phone"  value="{{old('number')}}" class="form-control" required>
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="inputCountry" class="col-form-label">Country <span class="text-danger">*</span></label>
          <input id="inputCountry" type="text" name="country" placeholder="Enter Country"  value="{{old('country')}}" class="form-control" required>
          @error('country')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

       <div class="col-md-4">
        <div class="form-group">
          <label for="inputState" class="col-form-label">State <span class="text-danger">*</span></label>
          <input id="inputState" type="text" name="state" placeholder="Enter State"  value="{{old('state')}}" class="form-control" required>
          @error('state')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

         <div class="col-md-4">
        <div class="form-group">
          <label for="inputCity" class="col-form-label">City <span class="text-danger">*</span></label>
          <input id="inputCity" type="text" name="city" placeholder="Enter City"  value="{{old('city')}}" class="form-control" required>
          @error('city')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

         <div class="col-md-4">
         <div class="form-group">
                  <label for="inputAddress" class="col-form-label">Address <span class="text-danger">*</span></label>
                  <input id="inputAddress" type="text" name="address" placeholder="Enter Address"  value="{{old('address')}}" class="form-control" required>
                  @error('address')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
          </div>
        </div>


           <div class="col-md-4">
          <div class="form-group">
                  <label for="inputDob" class="col-form-label">DOB <span class="text-danger">*</span></label>
                  <input id="inputDob" type="date" name="dob" placeholder="Enter DOB"  value="{{old('address')}}" class="form-control" required>
                  @error('dob')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
          </div>
        </div>

         <div class="col-md-4">

          <div class="form-group">
                  <label for="inputDob" class="col-form-label">gender <span class="text-danger">*</span></label>
                 <select class="form-control" name="gender">
                   <option value="male" selected>Male</option>
                   <option value="female">FeMale</option>
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
          <select name="category" id="category" class="form-control" required>
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-4">
          <div class="form-group">
                              <label>Image</label>
                    <input class="form-control" type="file" onChange="getoutput()" id="getfileext" name="image"
                    value="{{old('image')}}" required>
            </div>
        </div>

         <div class="col-md-4">
            <div class="form-group">
              <label for="inputCountry" class="col-form-label">Qualification name <span class="text-danger">*</span></label>
              <input id="inputCountry" type="text" name="qualification[]" placeholder="Enter Qualification"  value="{{old('qualification')}}" class="form-control" required>
              @error('qualification')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
      </div>
        <div class="col-md-4">
          <div class="form-group">
                              <label>upload document</label>
                    <input class="form-control" type="file" id="document[]"
                    name="document[]" value="{{old('document')}}" required>
            </div>
        </div>

         <div class="col-md-2">
          <div class="form-group">
            <label>From Date</label>
                <input type="date" name="from_date[]" class="form-control" required>
            </div>
        </div>

            <div class="col-md-2">
          <div class="form-group">
            <label>To Date</label>
            <input type="date" name="to_date[]" class="form-control" required>
            </div>
        </div>

          </div>
          <button type="button" onclick="addMore();" class="btn btn-primary">Add More Documents</button>
        <div class="form-group mb-3">

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
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>
<script type="text/javascript">
  var i = 1;
  function addMore(){
    var i2 = i++;
    var html = '';

    html +='<div class="col-md-3 '+i2+'">';
    html +='<div class="form-group">';
    html +='<label for="inputCountry" class="col-form-label">Qualification name <span class="text-danger">*</span></label>';
    html +='<input id="inputCountry" required type="text" name="qualification[]" placeholder="Enter Qualification"  value="" class="form-control">';
    html +='</div>';
    html +='</div>';
    html +='</div>';

      //image section
     html +='<div class="col-md-3 '+i2+'">';
    html +='<div class="form-group">';
    html +='<label for="inputCountry" class="col-form-label">Upload Documents <span class="text-danger">*</span></label>';
    html +='<input class="form-control" type="file" required id="document[]" name="document[]" value="{{old('document')}}">';
    html +='</div>';
    html +='</div>';
    html +='</div>';

    //form date
    html +='<div class="col-md-2 '+i2+'">';
    html +='<div class="form-group">';
    html +='<label for="inputCountry" class="col-form-label">From Date<span class="text-danger">*</span></label>';
    html +='<input class="form-control" type="date" required id="from_date[]" name="from_date[]" value="{{old('from_date')}}">';
    html +='</div>';
    html +='</div>';
    html +='</div>';

    //to date
    html +='<div class="col-md-2 '+i2+'">';
    html +='<div class="form-group">';
    html +='<label for="inputCountry" class="col-form-label">To Date<span class="text-danger">*</span></label>';
    html +='<input class="form-control" type="date" required id="to_date[]" name="to_date[]" value="{{old('from_date')}}">';
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
    <script>
        function getFile(filePath) {
            return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
        }

        function getoutput() {
              var c=  document.getElementById('getfileext');
            var  x = getFile(c.value);
            var t = c.value.split('.')[1];
            if(t !=='.jpg'){

            }
        }
    </script>
@endpush
