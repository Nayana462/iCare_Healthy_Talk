@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Page')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Qualification Doctors List</h6>
            <button style="float: right" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal">
                Add More Qualification
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('savequalification')}}" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                <div class="form-group">
                                    <input name="user_id" type="hidden" value="{{$qualification->first()->user_id}}">
                                    <label for="inputName" class="col-form-label">Degre Name <span class="text-danger">*</span></label>
                                    <input id="inputName" type="text" name="title" placeholder="Enter Degree Name" class="form-control">
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>


                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" class="form-control" >
                                </div>


                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input type="file" name="document" class="form-control" >
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($qualification)>0)
                    <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Qualification</th>
                            <th>From date</th>
                            <th>To date</th>
                            <th>Degree photos</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>Qualification</th>
                            <th>form date</th>
                            <th>To Date</th>
                            <th>Degree photo</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($qualification as $qualifications)
                            <tr>
                                <td>{{$qualifications->id}}</td>
                                <td>{{$qualifications->title}}</td>
                                <td>
                                    {{$qualifications->from_date}}
                                </td>
                                <td>
                                    {{$qualifications->to_date}}
                                </td>

                                <td>
                                    @if($qualifications->document_file_name)
                                        <img src="{{$qualifications->document->url()}}" class="img-fluid"
                                             style="max-width:80px" alt="{{$qualifications->document_file_name}}">
                                    @else
                                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid"
                                             style="max-width:80px" alt="avatar.png">
                                    @endif
                                </td>
                                </td>


                                <td>
                                    <a href="{{url('qualificationedit')}}/{{$qualifications->id}}"
                                       class="btn btn-primary btn-sm float-left mr-1"
                                       style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                       title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{url('deletequalification')}}/{{$qualifications->id}}">
                                        @csrf

                                        <button class="btn btn-danger btn-sm dltBtn"
                                                data-id={{$qualifications->id}} style="height:30px;
                                                width:30px;border-radius:50%
                                        " data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                            class="fas  fa-trash"></i></button>
                                    </form>


                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{$qualification->links('pagination::bootstrap-4')
}}</span>
                @else
                    <h6 class="text-center">No doctors found!!! Please create banner</h6>
                @endif
            </div>
        </div>
    </div>
    <form id="">

    </form>
@endsection

@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

        .zoom {
            transition: transform .2s; /* Animation */
        }

        .zoom:hover {
            transform: scale(3.2);
        }
    </style>
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>

        $('#banner-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [1]
                }
            ]
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function (e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
    <script>
        function showForm() {
            alert();
        }
    </script>
@endpush
