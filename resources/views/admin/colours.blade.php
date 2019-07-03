@extends('adminlayout') @section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="list-group col-md-12 colour-table">
            <li class="list-group-item text-center col-sm-12">
                <a href="#newColourModal" data-toggle="modal">
                    <h1 class="btn btn-primary">+</h1>
                </a>
            </li>
            @foreach($colours as $colour)
            <li class="list-group-item col-sm-8" colour-id="{{$colour->id}}">
                <span id="{{$colour->colour}}" class="colour-name">{{$colour->colour}}</span>
                <a href="#colorDetail" style="background-color: {{$colour->colour}}; color: #fff" colour-id="{{$colour->id}}" data-toggle='modal'
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    
                </a>
                <a href="#editColourModal" colour-id="{{$colour->id}}" data-toggle="modal"> <span class="fas fa-edit"></span></a>
                <a href="#deleteColourModal" colour-id="{{$colour->id}}" data-toggle="modal"><span class="fas fa-trash"></span></a>
            </li>

            @endforeach
            <li class="links mt-3">
                {{$colours->links()}}
            </li>
        </ul>
    </div>
</div>

<!--START DELETE COLOUR MODAL  -->
<div class="modal fade" id="deleteColourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <p class="text-danger">DELETE COLOR?</p> (This operation cannot be undone)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">Are you sure you want to delete the colour? </div>
            <div class="modal-footer">
                {{csrf_field()}}
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id='confirmDeleteColour' colour-id='' href="{{route('admin.colours.delete','')}}" data-dismiss="modal">Delete</a>
            </div>
        </div>
    </div>
</div>
<!--END DELETE COLOUR MODAL  -->

<!--START ADD COLOUR MODAL  -->
<div class="modal fade" id="newColourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD NEW COLOUR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                <form id="addColourForm" action="{{route('admin.colours.add')}}" method="POST">
                    <input type="text" name="colour" required class="form-control mb-2">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-check fa-success"></i>ADD</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--EMD ADD COLOUR MODAL  -->

<!--EDIT COLOUR MODAL  -->
<div class="modal fade" id="editColourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT COLOUR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                <form id="editColourForm" colour-id='' action="{{route('admin.colours.edit')}}" method="POST">
                    <input type="text" name="colour" required class="form-control mb-2">
                    <button class="btn btn-danger" type="submit"><i class="fas fa-check fa-success"></i>Update</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--EDIT COLOUR MODAL  -->
@endsection @section('style')
<link rel="stylesheet" href="{{asset('css/aurjn/izitoast.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aurjn/native-circle-loader.css')}}">
<link rel="stylesheet" href="{{asset('css/aurjn/devc.css')}}"> @endsection