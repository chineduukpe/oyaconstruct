@extends('adminlayout') @section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="list-group col-md-12 size-table">
            <li class="list-group-item text-center col-sm-12">
                <a href="#newSizeModal" data-toggle="modal">
                    <h1 class="btn btn-primary">+</h1>
                </a>
            </li>
            @foreach($sizes as $size)
            <li class="list-group-item col-sm-8" size-id="{{$size->id}}">
                <span id="{{$size->size}}" class="size-name">{{$size->size}}</span>
                <a href="#colorDetail" style="background-color: {{$size->size}}; color: #fff" size-id="{{$size->id}}" data-toggle='modal'
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    
                </a>
                <a href="#editSizeModal" size-id="{{$size->id}}" data-toggle="modal"> <span class="fas fa-edit"></span></a>
                <a href="#deleteSizeModal" size-id="{{$size->id}}" data-toggle="modal"><span class="fas fa-trash"></span></a>
            </li>

            @endforeach
            <li class="links mt-3">
                {{$sizes->links()}}
            </li>
        </ul>
    </div>
</div>

<!--START DELETE size MODAL  -->
<div class="modal fade" id="deleteSizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <p class="text-danger">DELETE SIZE?</p> (This operation cannot be undone)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">Are you sure you want to delete the size? </div>
            <div class="modal-footer">
                {{csrf_field()}}
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id='confirmDeleteSize' size-id='' href="{{route('admin.sizes.delete','')}}" data-dismiss="modal">Delete</a>
            </div>
        </div>
    </div>
</div>
<!--END DELETE size MODAL  -->

<!--START ADD size MODAL  -->
<div class="modal fade" id="newSizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD NEW SIZE</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                <form id="addSizeForm" action="{{route('admin.sizes.add')}}" method="POST">
                    <input type="text" name="size" required class="form-control mb-2">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-check fa-success"></i>ADD</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--EMD ADD size MODAL  -->

<!--EDIT size MODAL  -->
<div class="modal fade" id="editSizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT SIZE</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                <form id="editSizeForm" size-id='' action="{{route('admin.sizes.edit')}}" method="POST">
                    <input type="text" name="size" required class="form-control mb-2">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-check fa-success"></i>Update</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--EDIT size MODAL  -->
@endsection @section('style')
<link rel="stylesheet" href="{{asset('css/aurjn/izitoast.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aurjn/native-circle-loader.css')}}">
<link rel="stylesheet" href="{{asset('css/aurjn/devc.css')}}"> @endsection