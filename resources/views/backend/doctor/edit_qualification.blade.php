@extends('backend.layouts.master')

@section('main-content')

    <div class="card">
        <h5 class="card-header">Edit Qualification</h5>
        <div class="card-body">
            @include('backend.layouts.notification')
            <form method="post" action="{{url('updatequalification')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$qualification->id}}" name="id">
                <div class="row" id="appendQualification">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputName" class="col-form-label">Degre Name <span class="text-danger">*</span></label>
                            <input id="inputName" type="text" name="title" placeholder="Enter Degree Name"  value="{{$qualification->title}}"
                                   class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" name="from_date" value="{{$qualification->from_date}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{$qualification->to_date}}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="file" name="document" class="form-control" value="{{$qualification->document->url()}}">
                            <a target="_blank" href="{{$qualification->document->url()}}">{{$qualification->document_file_name}}</a>
                        </div>
                    </div>

                </div>
                <div class="form-group mb-3">

                    <br>
                    <button class="btn btn-success" type="submit">Update</button>
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
@endpush
