@extends('../adminlayout') @section('title') {{Session::get('name')}} -Product @endsection @section('style')
<style type="text/css">
  .cardimg {
    height: 12rem;
    width: auto;
    overflow: hidden;
  }

  .cardimg2 {
    height: 12rem;
    width: 100%;
    overflow: hidden;
  }
</style>

@endsection @section('content')
<section id="content">
  <div class="alert">
    <h4>
      <strong>
                  {{$store->ownername}} Store
                </strong>
    </h4>
  </div>
  <div class="card">
    @if(session('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button><strong>
           
            <p>{{ session('success') }}</p>
          </strong>
    </div>
    @endif @if(session('error'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button><strong>
            <p>{{ session('error') }}</p>
          </strong></div>
    @endif @if($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
              </strong>
    </div>
    @endif
    <div class="card-body">
      @if($storestatus==1)
      <h6><strong>Add Product</strong></h6>

      <form class="form-horizontal" method="post" action="{{URL::to('admin/addproduct')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="control-label" for="inputservice">Category</label>
          <select id="category" name="category" required="required" class="form-control">
                    
              </select>
        </div>
        <div class="form-group">
          <label class="control-label" for="catname">Sub Category</label>
          <select id="subcategory" name="subcategory" required="required" class="form-control">
                    
              </select>
        </div>
        <div class="form-group">
          <label class="control-label" for="catname">Colours</label>
          <select name="colours[]" title="Select product colours" data-live-search="false" multiple required="required" class=" form-control">
                    @foreach($colours as $colour)
                      <option value="{{$colour->id}}">{{$colour->colour}}</option>
                    @endforeach
              </select>
        </div>
        <div class="form-group">
          <label class="control-label" for="catname">Sizes</label>
          <select name="size"  title="Select product sizes" required="required" data-live-search="false" class=" form-control">
                    @foreach($sizes as $size)
                      <option value="{{$size->id}}">{{$size->size}}</option>
                    @endforeach
              </select>
        </div>
        <div class="form-group">
          <label class="control-label" for="name">Product Name</label>
          <input type="text" id="name" name="name" placeholder="name" required="required" class="form-control">
          <input type="hidden" id="storeid" name="storeid" required="required" value="{{$store->id}}">

        </div>
        <div class="form-group">
          <p><strong><small class="text-info">Write a short description about this product</small></strong></p>
          <label class="control-label" for="shortdesc">About product</label>
          <textarea name="shortdesc" required="required" class="form-control"></textarea>
        </div>
        <div class="contformrol-group">
          <label class="control-label" for="name">Cost (of a single item)</label>
          <input type="number" id="cost" name="cost" placeholder="cost" required="required" class="form-control">
        </div>
        <div class="form-group">
          <label class="control-label" for="name">Quantity (Number of products in stock)</label>
          <input type="number" id="quantity" name="quantity" placeholder="qty" required="required" class="form-control">
        </div>
        <div class="form-group">
          <p><strong><small class="text-info">This is the picture that appears first. It is compulsory</small></strong></p>
          <label class="control-label" for="name">Default Picture</label>
          <input type="file" id="pic" name="pic" placeholder="pic" required="required" class="form-control">
        </div>
        <!--Alternate Photos  -->
        <div class="alternate-photos-container">
          <div class="alternate-photos">
            <div class="form-group">
              <p><strong><small class="text-info">These are other photos that will appear for this product</small></strong></p>
              <label class="control-label" for="name">Alternate Photos</label>
              <input type="file" id="pic" name="altpic[]" placeholder="pic" class="form-control">
            </div>
          </div>
          <div class=" col-sm-12 text-center center-block">
            <button type="button" class="btn btn-large btn-primary text-center mt-2 mb-2" id='moreAltPhoto'>+</button>
          </div>
        </div>
        <!--End alternate photos  -->
        <div class="form-group">
          <button type="submit" class="btn btn-danger">Add</button>

        </div>
      </form>
    </div>
    @endif @if($storestatus==0)
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>
          
          <p>This store is yet to be approved. Only approved and active stores can add products.</p>
          </strong>
    </div>
    @endif @if($storestatus==2)
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>
          
          <p>This store is inactive. Only approved and active stores can add products. Contact Oyaconstruct admin for more details.</p>
          </strong>
    </div>
    @endif
  </div>
  <div class="card mt-4">
    <div class="card-body">

      <h6 class="text-center">Products under {{$store->ownername}}</h6>
      <br/>
      <div id="post-data">
        @include('admin/productdata')
      </div>
      <div class="ajax-load text-center" style="display:none">
        <p><img src="{{URL::asset('img/lightbox/preloader.gif')}}">Loading More products</p>
      </div>

    </div>
  </div>
</section>
@endsection @section('script')
<script type="text/javascript">
  var page = 1;
  $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
      page++;
      loadMoreData(page);
    }
  });


  function loadMoreData(page) {
    $.ajax(
      {
        url: '?page=' + page,
        type: "get",
        beforeSend: function () {
          $('.ajax-load').show();
        }
      })
      .done(function (data) {
        if (data.html == "") {
          $('.ajax-load').html("No more records found");
          return;
        }
        $('.ajax-load').hide();
        $("#post-data").append(data.html);
      })
      .fail(function (jqXHR, ajaxOptions, thrownError) {
        alert('server not responding...');
      });
  }

</script>
<script type="text/javascript">
  function allcat(service) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "GET",
      url: "{{URL::to('admin/allcategories')}}",
      data: {
        'service': service,
      },
      success: function (data) {
        var mydata = JSON.parse(data);
        //alert(service);
        if (mydata.length > 0) {
          var displaylist = '<option value="">..Select..</option>';
          for (var i = 0; i < mydata.length; i++) {
            displaylist += '<option value="' + mydata[i]['id'] + '">' + mydata[i]['catname'] + '</option>';
          }

          document.getElementById('category').innerHTML = displaylist;
        }
      }
    });
  }
  function viewsubcategory(catid) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "GET",
      url: "{{URL::to('admin/viewsubcat')}}",
      data: {
        'catid': catid,
      },
      success: function (data) {
        var mydata = JSON.parse(data);
        if (mydata.length > 0) {
          var displaylist = '<option value="">..Select..</option>';
          for (var i = 0; i < mydata.length; i++) {
            displaylist += '<option value="' + mydata[i]['id'] + '">' + mydata[i]['subcat'] + '</option>';
          }
          document.getElementById('subcategory').innerHTML = displaylist;
        }
      }
    });
  }

  $(document).ready(function () {
    allcat('shop');
    $('#category').change(function () {
      var selectedServe = document.getElementById('category').value;
      viewsubcategory(selectedServe);
    });

    $('#category5').change(function () {
      var selectedServe = document.getElementById('category5').value;
      vieweditsubcategory(selectedServe, 0);
    });
  });

</script>


@endsection