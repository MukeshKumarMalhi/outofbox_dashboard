@extends('layouts.a_app')
@section('title','Cars')
@section('content')

<!-- Page Content -->
<!-- add business modal -->
  <div class="modal fade" id="CarModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Car</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div id="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="cars_store_form" enctype="multipart/form-data">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="category_id" class="text-pink font-weight-bold">Category (Comapny):</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php if(isset($categories) && count($categories) > 0){ ?>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="model" class="text-pink font-weight-bold">Model :</label>
                <input type="text" name="model" id="model" class="form-control" placeholder="e.g. Civic" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-pink font-weight-bold">Version :</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. i-CTDi, TDI Sport Sportback, TFSI.." required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="model_year" class="text-pink font-weight-bold">Model year :</label>
                <input type="text" name="model_year" id="model_year" onkeypress="return isNumber(event)" maxlength="4" class="form-control" placeholder="e.g. 2016" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="colour" class="text-pink font-weight-bold">Colour :</label>
                <input type="text" name="colour" id="colour" class="form-control" placeholder="e.g. Blue" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="price" class="text-pink font-weight-bold">Price :</label>
                <input type="text" name="price" id="price" onkeypress="return isNumber(event)" onkeyup="FormatCurrency(this)" class="form-control" placeholder="e.g. £2,290" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="mileage" class="text-pink font-weight-bold">Mileage :</label>
                <input type="text" name="mileage" id="mileage" onkeypress="return isNumber(event)" onkeyup="FormatCurrency(this)" class="form-control" placeholder="e.g. 48,000" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="number_of_doors" class="text-pink font-weight-bold">No. of doors :</label>
                <input type="text" name="number_of_doors" id="number_of_doors" onkeypress="return isNumber(event)" class="form-control" placeholder="e.g. 4" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="number_of_seats" class="text-pink font-weight-bold">No. of seats :</label>
                <input type="text" name="number_of_seats" id="number_of_seats" onkeypress="return isNumber(event)" class="form-control" placeholder="e.g. 4" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="engine_size" class="text-pink font-weight-bold">Engine size :</label>
                <input type="text" name="engine_size" id="engine_size" class="form-control" placeholder="e.g. 2.0" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="body_style" class="text-pink font-weight-bold">Body style :</label>
                <input type="text" name="body_style" id="body_style" class="form-control" placeholder="e.g. Hatchback, Estate or Saloon" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fuel_type" class="text-pink font-weight-bold">Fuel type:</label>
                <select class="form-control" id="fuel_type" name="fuel_type" required>
                  <option value="">Select fuel type</option>
                  <option value="Petrol">Petrol</option>
                  <option value="Diesel">Diesel</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="gearbox_type" class="text-pink font-weight-bold">Gearbox type:</label>
                <select class="form-control" id="gearbox_type" name="gearbox_type" required>
                  <option value="">Select gearbox type</option>
                  <option value="Automatic">Automatic</option>
                  <option value="Manual">Manual</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="car_type" class="text-pink font-weight-bold">Car type:</label>
                <select class="form-control" id="car_type" name="car_type">
                  <option value="">Select car type</option>
                  <option value="used">Used</option>
                  <option value="new">New</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="sale_status" class="text-pink font-weight-bold">Sale status:</label>
                <select class="form-control" id="sale_status" name="sale_status">
                  <option value="">Select sale status</option>
                  <option value="on_sale">On sale</option>
                  <option value="sold">Sold</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="form-group">
                <label for="featured_image" class="text-pink font-weight-bold">Featured image:</label>
                <input type="file" name="featured_image" accept="image/*" onchange="readURL(this);" id="featured_image" class="form-control" required/>
              </div>
            </div>
            <div class="col-md-3">
              <img class="blah_image" style="width: 200px; height: 150px; display: none;" class="img-fluid rounded-circle">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-10">
              <div class="form-group">
                <label for="description" class="text-pink font-weight-bold">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter car description" rows="4" cols="30"></textarea>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-10">
              <div class="form-group">
                <label for="car_history" class="text-pink font-weight-bold">History:</label>
                <textarea name="car_history" id="car_history" class="form-control" placeholder="Enter car history" rows="4" cols="30"></textarea>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
<!-- add business modal -->
  <!-- delete location modal -->
  <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteCarModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:200%;">
        <div class="modal-body">
          <div id="delete_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
            <ul></ul>
          </div>
          <div class="deletecontent">
            Are you sure want to delete <span class="title" style="font-size: 18px; font-weight: 500;"></span>?
            <span class="id" style="display: none;"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="delete btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- edit location modal end -->

<div class="container-fluid" id="cars">
  <div class="text-right">
    <a class="btn bg-dark text-light my-2" href="#" data-toggle="modal" data-target="#CarModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Car</a>
  </div>
  <!-- table-->
  <div class="table-responsive border-bottom rounded mb-3">
          <table class="table bs-table" id="userTable">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Company</th>
                      <th>Model</th>
                      <th>Price</th>
                      <th>Mileage</th>
                      <th>Fuel type</th>
                      <th>Gearbox type</th>
                      <th>Created date</th>
                      <th>Image</th>
                      <th class="text-center" style="width:120px">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    {{ csrf_field() }}
                   <?php if(isset($cars) && count($cars) > 0){ ?>
                     @foreach($cars as $car)
                       <tr class="Car{{$car->id}}">
                         <td>{{ $car->id }}</td>
                         <td>{{ $car->category_name }}</td>
                         <td>{{ $car->model }} {{ $car->name }} {{ $car->model_year }}</td>
                         <td>£{{ number_format($car->price) }}</td>
                         <td>{{ number_format($car->mileage) }} miles</td>
                         <td>{{ $car->fuel_type }}</td>
                         <td>{{ $car->gearbox_type }}</td>
                         <td><?php echo date('d M Y',strtotime($car->created_at)); ?></td>
                         <td>
                           <div class="bs-photo bg-center-url" style="background-image: url('<?php echo asset('storage/'.$car->featured_image); ?>');"></div>
                         </td>
                         <td>
                           <a href="{{ url('admin/view_details') }}/{{ $car->category_name.'_'.$car->model }}/{{ $car->id }}" class="btn btn-outline-danger mb-2" ><i class="far fa-eye" aria-hidden="true"></i> View</a>
                         </td>
                       </tr>
                     @endforeach
                  <?php }else { ?>
                    <tr>
                      <th id="yet">
                        <h2>Cars are not added yet</h2>
                      </th>
                    </tr>
                  <?php } ?>
                  </tr>
              </tbody>
          </table>
      </div>
  <div style="margin-top: 10px;margin-left: 440px;">
     <ul class="pagination-for-cars justify-content-center">
       {{ $cars->links() }}
     </ul>
  </div>
</div>

<script type="text/javascript">
function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function FormatCurrency(ctrl) {
  //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
  if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
      return;
  }

  var val = ctrl.value;

  val = val.replace(/,/g, "")
  ctrl.value = "";
  val += '';
  x = val.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';

  var rgx = /(\d+)(\d{3})/;

  while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }

  ctrl.value = x1 + x2;
}

function isNumber(evt){
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('.blah_image').show();
      $('.blah_image').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#engine_size').keypress(function(event) {
      if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
              $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
          event.preventDefault();
      }
  }).on('paste', function(event) {
      event.preventDefault();
  });

  $('#CarModal').on('shown.bs.modal', function () {
    $('#model').focus();
  });

  $('#cars_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_data') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('#append_errors ul').text('');
        $('#append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('#append_errors').show();
            $('#append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('#yet').hide();
          $('#append_errors').hide();
          $('#append_success').show();
          $('#append_success ul').append("<li>Car data uploaded successfully.</li>");
          $('#CarModal').find('#cars_store_form')[0].reset();
          setTimeout(function(){ $('#append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });
});
</script>
<style media="screen">
.close{
font-size: 1.4rem;
}
</style>

@endsection
