@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.update',$banner->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$banner->title}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

          <div class="form-group">
              <label>Banner</label>

              <input class="form-control" type="file" value="{{$banner->banner_file_name}}" id="banner" name="banner" accept=".jpg, .jpeg, .png">
              <a href="{{$banner->banner->url()}}" target="_blank">{{$banner->banner_file_name}}</a>
              @error('banner')
              <span class="text-danger">{{$message}}</span>
              @enderror
          </div>





        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="{{url('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script type="text/javascript">
   var route_prefix = $('#pth').val()+'/filemanager';
    $('#lfm').filemanager('image' , {prefix: route_prefix});
    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
