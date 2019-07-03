<?php $i=0; 
if(count($products)>0){
?>
<!-- alt pictures modal-->
<div class="modal fade" id="altpicmodal" tabindex="-1" role="dialog" aria-labelledby="altpicmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 id="mySignupModalLabel">Change alt <strong>picture</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="form2" name="form" method="post" action="{{URL::to('editproductaltpic')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Picture Number </label>
            <input type="number" id="picno" class="form-control" name="picno" required="required" readonly="readonly">
            <input type="hidden" id="productid" name="productid">
          </div>
          <div class="form-group">
            <label>Picture </label>

            <input type="file" id="pic" name="pic" class=" form-control" placeholder="Upload image" required="required">

          </div>

          <button type="submit" class="btn btn-danger">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- alt pictures modal-->
<!-- picture modal-->
<div class="modal fade" id="picmodal" tabindex="-1" role="dialog" aria-labelledby="picmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 id="mySignupModalLabel">Change <strong>picture</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="form3" name="form" method="post" action="{{URL::to('editproductpic')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <p>Product name: <span id="prodname1"></span></p>
            <input type="hidden" id="productid2" name="productid2">
          </div>
          <div class="form-group">
            <label>Picture </label>

            <input type="file" id="pic" name="pic" class=" form-control" placeholder="Upload image" required="required">

          </div>

          <button type="submit" class="btn btn-danger">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- picture modal-->
<!-- manage stock modal-->
<div class="modal fade" id="stockmodal" tabindex="-1" role="dialog" aria-labelledby="stockmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 id="mySignupModalLabel">Manage <strong>Stock</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="form3" name="form" method="post" action="{{URL::to('managestock')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <p><strong>Product name: <span id="prodname3"></span></strong></p>
            <input type="hidden" id="productid3" name="productid3">
          </div>
          <div class="form-group">
            <label>Price(Unit price) </label>
            <input type="number" id="price1" name="price1" class=" form-control" required="required">
          </div>
          <div class="form-group">
            <label>Quantity </label>
            <input type="number" id="qty1" name="qty1" class=" form-control" required="required">

          </div>

          <button type="submit" class="btn btn-danger">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- manage stock modal-->
<!-- priviledges modal-->
<div class="modal fade" id="privmodal" tabindex="-1" role="dialog" aria-labelledby="privmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 id="mySignupModalLabel">Manage <strong>Priviledges</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="form3" name="form" method="post" action="{{URL::to('manageprodpriv')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <p><strong> Product name: <span id="prodname4"></span></strong></p>
            <input type="hidden" id="productid4" name="productid4">
          </div>
          <div class="form-group">
            <label> Discount (Percentage) </label>
            <input type="number" id="discount" name="discount" class="form-control">

          </div>
          <div class="form-group">
            <label> Featured (these appear first on the home page) </label>
            <select id="featured" name="featured" class="form-control">
                <option value="">--select--</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>

          </div>

          <button type="submit" class="btn btn-danger">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- priviledges modal-->
<!-- Add Price Modal-->
<div class="modal fade" id="addPriceModal" tabindex="-1" role="dialog" aria-labelledby="privmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 id="mySignupModalLabel">Manage <strong>Price and Sizes</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addProductPriceForm" name="form" method="post" action="{{route('admin.product.price.add')}}" >
          {{ csrf_field() }}
          <div class="form-group">
            <p><strong> Product name: <span id="prodname4"></span></strong></p>
            <input type="hidden" name="productid">
          </div>
          <div class="form-group">
            <label> Select Size </label>
            <select name="size" id="" class="form-control">
              @if(!empty($sizes))
                @foreach($sizes as $size)
                  <option value="{{$size->id}}">{{$size->size}}</option>
                  @endforeach
                @endif
            </select>

          </div>
          <div class="form-group">
            <label> Price </label>
            <input type="number" id="" name="price" class="form-control">

          </div>

          <button type="submit" class="btn btn-danger">Add Price</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END Add Price Modal-->
<!--START DELETE PRODUCT MODAL-->
<div class="modal fade" id="deleteProductModal" action="{{route('admin.product.delete','')}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">DELETE <span></span> (This operation cannot be undone)</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Are you sure you want to delete the product? </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger" id='confirmDeleteProduct' href="#" data-dismiss="modal" >Delete</a>
      </div>
    </div>
  </div>
</div>
<!--END DELETE PRODUCT MODAL-->
<!-- details modal-->
<div class="modal fade" id="detailsmodal" tabindex="-1" role="dialog" aria-labelledby="detailsmodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 id="mySignupModalLabel">Edit <strong>Details</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form id="form3" name="form" method="post" action="{{URL::to('editproddet')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label><strong>Product name</strong></label>
            <input type="text" id="prodname5" name="prodname5" required="required" autocomplete="off" class="form-control">
            <input type="hidden" id="productid5" name="productid5">
          </div>
          <div class="form-group">
            <label class="control-label" for="inputservice">Category</label>
            <select id="category5" name="category5" required="required" class="form-control">
                    
              </select>
          </div>
          <div class="form-group">
            <label class="control-label" for="catname">Sub Category</label>
            <select id="subcategory5" name="subcategory5" required="required" class="form-control">
                    
              </select>
          </div>
          <div class="form-group">
            <label class="control-label" for="shortdesc">About product</label>
            <textarea name="shortdesc5" required="required" class="form-control" id="shortdesc5"></textarea>
          </div>
          <button type="submit" class="btn btn-danger">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- details modal-->
@foreach($products as $product)
  <div id="product-parent{{$product->id}}">
<?php $pic=$product->productpic;
$pic1=$product->pic1;
$pic2=$product->pic2;
$pic3=$product->pic3;
$pic4=$product->pic4;
?>
<div class="card-body text-muted">
 <div class="row">
   <div class="col-md-6">
     <h4 class="pb-3 mb-0"><i id="{{$product->id}}" class="fa fa-trash text-danger delete-product" onclick="opendeletemodal('{{$product->id}}','{{$product->productname}}')" style="cursor: pointer;"></i><span>{{ $product->productname }} </span></h4>
     <img class="cardimg" src='{{URL::to("product/storage/$pic")}}' alt="Picture of {{ stripslashes($product->shortdesc) }}">
     <p>{{ stripslashes($product->shortdesc) }}
       <br>Cost: &#8358;{{ number_format($product->price) }}
       <br>Quantity in stock: {{ number_format($product->quantity) }}
       <br>Discount: {{ $product->discount }}%
       <br>Featured: {{ ucfirst($product->featured) }}
     </p>
   </div>
   <div class="col-md-6">
     <div class="row">
       <div class="col-md-6">
         <h5>Prices</h5>
         @if(!empty($product->sizes))
           @foreach($product->productPrices as $price)
             <small style="display: block" class="mt"><del>N</del>{{$price->price}} : {{$price->size->size}}</small>
             <small style="display: block" class="mt"></small>
           @endforeach
         @endif

       </div>
       <div class="col-md-6">
         <h5>Available Colours</h5>
         @if(!empty($product->colours))
           @foreach($product->colours as $colour)
             <small style="display: block" class="mt">{{$colour->colour}}</small>
             @endforeach
           @endif
       </div>
     </div>
   </div>
 </div>
</div>
<div class="card-deck">
  <!-- <div class="card">
 		<div class="card-body">
 			<img class="cardimg2" src='{{URL::to("product/storage/$pic1")}}' alt="Alt Picture 1">
 			<p><button class="btn btn-danger btn-sm" onclick="openeditpicmodal(1,'{{$product->id}}')">Edit</button></p>  
 		</div>
 	</div>
 	<div class="card">
 		<div class="card-body">
 			<img class="cardimg2" src='{{URL::to("product/storage/$pic2")}}' alt="Alt Picture 2">
 			<p><button class="btn btn-danger btn-sm" onclick="openeditpicmodal(2,'{{$product->id}}')">Edit</button></p> 
 		</div>
 	</div>
 	<div class="card">
 		<div class="card-body">
 			<img class="cardimg2" src='{{URL::to("product/storage/$pic3")}}' alt="Alt Picture 3">
 			<p><button class="btn btn-danger btn-sm" onclick="openeditpicmodal(3,'{{$product->id}}')">Edit</button></p>  
 		</div>
 	</div>
 	<div class="card">
 		<div class="card-body">
 			<img class="cardimg2" src='{{URL::to("product/storage/$pic4")}}' alt="Alt Picture 4">
 			<p><button class="btn btn-danger btn-sm" onclick="openeditpicmodal(4,'{{$product->id}}')">Edit</button></p>  
 		</div>
 	</div> -->
  <div class="row">
    @if(!empty($product->pictures))
      @foreach($product->pictures as $picture)
    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
          <img class="cardimg2" src='{{URL::to("product/storage/$picture->picturename")}}' alt="Alt Picture 4">
          <p><button class="btn btn-danger btn-sm" onclick="openeditpicmodal({{$picture->id}},'{{$picture->id}}')">Edit</button></p>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</div>
<br>
<p class="pb-3 small mb-0 border-danger border-bottom">
  <a class="btn btn-link text-danger" onclick="openpicmodal('{{$product->productname}}','{{$product->id}}')">Edit picture</a>
  <a class="btn btn-link text-danger" onclick="openstockmodal('{{$product->productname}}','{{$product->id}}','{{$product->price}}','{{$product->quantity}}')">Manage Stock</a>
  <a class="btn btn-link text-danger" onclick="openprivmodal('{{$product->productname}}','{{$product->id}}','{{$product->discount}}','{{$product->featured}}')">Priviledges</a>
  <a class="btn btn-link text-danger" onclick="opendetailsmodal('{{$product->productname}}','{{$product->id}}','{{$product->shortdesc}}','{{$product->category}}','{{$product->subcategory}}')">Edit Details</a>
  <a class="btn btn-link text-danger" onclick="openaddpricemodal('{{$product->id}}','{{$product->productname}}')">Add price</a>
</p>
  </div>
@endforeach
<script type="text/javascript">
  function openeditpicmodal(picnumber, productid) {
    document.getElementById('picno').value = picnumber;
    document.getElementById('productid').value = productid;
    $('#altpicmodal').modal('show');
  }

  function openpicmodal(productname, productid) {
    document.getElementById('prodname1').innerHTML = productname;
    document.getElementById('productid2').value = productid;
    $('#picmodal').modal('show');
  }

  function openstockmodal(productname, productid, price, qty) {
    document.getElementById('prodname3').innerHTML = productname;
    document.getElementById('productid3').value = productid;
    document.getElementById('price1').value = price;
    document.getElementById('qty1').value = qty;
    $('#stockmodal').modal('show');
  }
  function openprivmodal(productname, productid, discount, featured) {
    document.getElementById('prodname4').innerHTML = productname;
    document.getElementById('productid4').value = productid;
    document.getElementById('discount').value = discount;
    document.getElementById('featured').value = featured;
    $('#privmodal').modal('show');
  }

  function opendetailsmodal(productname, productid, shortdesc, catid, subcat) {
    document.getElementById('prodname5').value = productname;
    document.getElementById('productid5').value = productid;
    document.getElementById('shortdesc5').value = shortdesc;
    alleditcat('shop', catid);
    vieweditsubcategory(catid, subcat);
    $('#detailsmodal').modal('show');
  }

  function openaddpricemodal( productid, productname ) {
      console.log(productname)
      document.getElementById('prodname4').innerHTML = productname;
      $('#addPriceModal').modal('show');
      $('#addPriceModal').find('#prodname4').html(productname);
      $('#addProductPriceForm').find('input[name="productid"]').val(productid);
  }

  function opendeletemodal(productid, productname){
      $('#confirmDeleteProduct').attr('product-id',productid);
      $('#deleteModalLabel > span').html(productname);
      $('#deleteModalLabel > span').html(productname);
      $('#deleteProductModal').modal('show');
  }


  function alleditcat(service, did) {
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
        if (mydata.length > 0) {
          var displaylist = '<option value="">..Select..</option>';
          for (var i = 0; i < mydata.length; i++) {
            var sel = (mydata[i]['id'] == did) ? "selected" : "";
            //alert(sel);
            displaylist += '<option value="' + mydata[i]['id'] + '" ' + sel + '>' + mydata[i]['catname'] + '</option>';
          }

          document.getElementById('category5').innerHTML = displaylist;
        }
      }
    });
  }
  function vieweditsubcategory(catid, subcat) {
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
            var sel = (mydata[i]['id'] == subcat) ? "selected" : "";
            displaylist += '<option value="' + mydata[i]['id'] + '" ' + sel + '>' + mydata[i]['subcat'] + '</option>';
          }
          document.getElementById('subcategory5').innerHTML = displaylist;
        }
      }
    });
  }

  $(document).ready(function () {
    $('#category5').change(function () {
      var selectedServe = document.getElementById('category5').value;
      vieweditsubcategory(selectedServe, 0);
    });
  });

</script>
<?php } ?>