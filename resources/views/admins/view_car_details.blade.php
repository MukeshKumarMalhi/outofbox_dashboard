@extends('layouts.a_app')
@section('title','Car Details')
@section('content')

<!-- Page Content -->
<!-- edit car modal -->
  <div class="modal fade" id="EditCarDetailsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Car</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edit_append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div id="edit_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="edit_car_details_form" enctype="multipart/form-data">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="category_id" class="text-pink font-weight-bold">Category (Comapny):</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php if(isset($categories) && count($categories) > 0){ ?>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" <?php if($cat->id == $car_details->category_id) echo "selected"; ?>>{{ $cat->category_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="model" class="text-pink font-weight-bold">Model :</label>
                <input type="text" name="model" id="model" class="form-control" placeholder="e.g. Civic" value="{{ $car_details->model }}" required>
                <input type="hidden" name="edit_fid" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name" class="text-pink font-weight-bold">Version :</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. i-CTDi, TDI Sport Sportback, TFSI.." value="{{ $car_details->name }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="model_year" class="text-pink font-weight-bold">Model year :</label>
                <input type="text" name="model_year" id="model_year" onkeypress="return isNumber(event)" maxlength="4" class="form-control" placeholder="e.g. 2016" value="{{ $car_details->model_year }}" required >
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="colour" class="text-pink font-weight-bold">Colour :</label>
                <input type="text" name="colour" id="colour" class="form-control" placeholder="e.g. Blue" value="{{ $car_details->colour }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="price" class="text-pink font-weight-bold">Price :</label>
                <input type="text" name="price" id="price" onkeypress="return isNumber(event)" onkeyup="FormatCurrency(this)" class="form-control" placeholder="e.g. £2,290" value="{{ number_format($car_details->price) }}" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="mileage" class="text-pink font-weight-bold">Mileage :</label>
                <input type="text" name="mileage" id="mileage" onkeypress="return isNumber(event)" onkeyup="FormatCurrency(this)" class="form-control" placeholder="e.g. 48,000" value="{{ number_format($car_details->mileage) }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="number_of_doors" class="text-pink font-weight-bold">No. of doors :</label>
                <input type="text" name="number_of_doors" id="number_of_doors" onkeypress="return isNumber(event)" class="form-control" placeholder="e.g. 4" value="{{ $car_details->number_of_doors }}" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="number_of_seats" class="text-pink font-weight-bold">No. of seats :</label>
                <input type="text" name="number_of_seats" id="number_of_seats" onkeypress="return isNumber(event)" class="form-control" placeholder="e.g. 4" value="{{ $car_details->number_of_seats }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="engine_size" class="text-pink font-weight-bold">Engine size :</label>
                <input type="text" name="engine_size" id="engine_size" class="form-control" placeholder="e.g. 2.0" value="{{ $car_details->engine_size }}" required>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="body_style" class="text-pink font-weight-bold">Body style :</label>
                <input type="text" name="body_style" id="body_style" class="form-control" placeholder="e.g. Hatchback, Estate or Saloon" value="{{ $car_details->body_style }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fuel_type" class="text-pink font-weight-bold">Fuel type:</label>
                <select class="form-control" id="fuel_type" name="fuel_type" required>
                  <option value="">Select fuel type</option>
                  <option value="Petrol" <?php if($car_details->fuel_type == "Petrol") echo "selected"; ?>>Petrol</option>
                  <option value="Diesel" <?php if($car_details->fuel_type == "Diesel") echo "selected"; ?>>Diesel</option>
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
                  <option value="Automatic" <?php if($car_details->gearbox_type == "Automatic") echo "selected"; ?>>Automatic</option>
                  <option value="Manual" <?php if($car_details->gearbox_type == "Manual") echo "selected"; ?>>Manual</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="car_type" class="text-pink font-weight-bold">Car type:</label>
                <select class="form-control" id="car_type" name="car_type">
                  <option value="">Select car type</option>
                  <option value="used" <?php if($car_details->car_type == "used") echo "selected"; ?>>Used</option>
                  <option value="new" <?php if($car_details->car_type == "new") echo "selected"; ?>>New</option>
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
                  <option value="on_sale" <?php if($car_details->sale_status == "on_sale") echo "selected"; ?>>On sale</option>
                  <option value="sold" <?php if($car_details->sale_status == "sold") echo "selected"; ?>>Sold</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="status" class="text-pink font-weight-bold">Status:</label>
                <select class="form-control" id="status" name="status">
                  <option value="">Select car type</option>
                  <option value="activated" <?php if($car_details->status == "activated") echo "selected"; ?>>Activated</option>
                  <option value="deactivated" <?php if($car_details->status == "deactivated") echo "selected"; ?>>Deactivated</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="form-group">
                <label for="featured_image" class="text-pink font-weight-bold">Featured image:</label>
                <input type="file" name="featured_image" accept="image/*" onchange="readURL(this);" id="featured_image" class="form-control"/>
              </div>
            </div>
            <div class="col-md-3">
              <img class="blah_image" src="<?php echo asset('storage/'.$car_details->featured_image); ?>" style="width: 200px; height: 150px;" class="img-fluid rounded-circle">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-10">
              <div class="form-group">
                <label for="description" class="text-pink font-weight-bold">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter car description" rows="4" cols="30">{{ $car_details->description }}</textarea>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-10">
              <div class="form-group">
                <label for="car_history" class="text-pink font-weight-bold">Car History:</label>
                <textarea name="car_history" id="car_history" class="form-control" placeholder="Enter car history" rows="4" cols="30">{{ $car_details->car_history }}</textarea>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
<!-- edit car modal end -->
<!-- add vehicle summary modal -->
  <div class="modal fade" id="AddVehicleSummaryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Vehicle Summary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_vehicle_summary_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="engine_size_cc" class="text-pink font-weight-bold">Engine size (cc):</label>
                <input type="text" name="engine_size_cc" id="engine_size_cc" class="form-control" onkeypress="return isNumber(event)" placeholder="e.g. 1900 cc">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="co2_emissions" class="text-pink font-weight-bold">CO2 Emissions :</label>
                <input type="text" name="co2_emissions" id="co2_emissions" class="form-control" placeholder="e.g. 135 g/km" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="insurance_group" class="text-pink font-weight-bold">Insurance Group :</label>
                <input type="text" name="insurance_group" id="insurance_group" class="form-control" placeholder="e.g. 23E">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="standard_manufacturers_warranty_miles" class="text-pink font-weight-bold">Standard manufacturer's warranty (miles) :</label>
                <input type="text" name="standard_manufacturers_warranty_miles" id="standard_manufacturers_warranty_miles" class="form-control" placeholder="e.g. 90,000 miles">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="standard_manufacturers_warranty_years" class="text-pink font-weight-bold">Standard manufacturer's warranty (years) :</label>
                <input type="text" name="standard_manufacturers_warranty_years" id="standard_manufacturers_warranty_years" class="form-control" placeholder="e.g. 3 years">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="standard_paintwork_guarantee" class="text-pink font-weight-bold">Standard paintwork guarantee (years):</label>
                <input type="text" name="standard_paintwork_guarantee" id="standard_paintwork_guarantee" class="form-control" placeholder="e.g. 3 years">
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
<!-- add vehicle summary modal end -->

<!-- edit vehicle summary modal -->
  <div class="modal fade" id="EditVehicleSummaryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle Summary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        @if($vehicle_summary)
        <form method="post" role="form" class="form-horizontal" id="car_vehicle_summary_update_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_insurance_group" class="text-pink font-weight-bold">Engine size (cc) :</label>
                <input type="text" name="edit_engine_size_cc" id="edit_engine_size_cc" onkeypress="return isNumber(event)" class="form-control" placeholder="e.g. 1900 cc" value="{{ $vehicle_summary->engine_size_cc }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_co2_emissions" class="text-pink font-weight-bold">CO2 Emissions :</label>
                <input type="text" name="edit_co2_emissions" id="edit_co2_emissions" class="form-control" placeholder="e.g. 135 g/km" value="{{ $vehicle_summary->co2_emissions }}" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
                <input type="hidden" name="edit_fid" value="{{ $vehicle_summary->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_insurance_group" class="text-pink font-weight-bold">Insurance Group :</label>
                <input type="text" name="edit_insurance_group" id="edit_insurance_group" class="form-control" placeholder="e.g. 23E" value="{{ $vehicle_summary->insurance_group }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_standard_manufacturers_warranty_miles" class="text-pink font-weight-bold">Standard manufacturer's warranty (miles) :</label>
                <input type="text" name="edit_standard_manufacturers_warranty_miles" id="edit_standard_manufacturers_warranty_miles" class="form-control" placeholder="e.g. 90,000 miles" value="{{ $vehicle_summary->standard_manufacturers_warranty_miles }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_standard_manufacturers_warranty_years" class="text-pink font-weight-bold">Standard manufacturer's warranty (years) :</label>
                <input type="text" name="edit_standard_manufacturers_warranty_years" id="edit_standard_manufacturers_warranty_years" class="form-control" placeholder="e.g. 3 years" value="{{ $vehicle_summary->standard_manufacturers_warranty_years }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_standard_paintwork_guarantee" class="text-pink font-weight-bold">Standard paintwork guarantee (years):</label>
                <input type="text" name="edit_standard_paintwork_guarantee" id="edit_standard_paintwork_guarantee" class="form-control" placeholder="e.g. 3 years" value="{{ $vehicle_summary->standard_paintwork_guarantee }}">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      @endif
    </div>
  </div>
  </div>
  </div>
<!-- edit vehicle summary modal end -->

<!-- add performance economy modal -->
  <div class="modal fade" id="AddPerformanceEconomyModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Performance Economy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_vehicle_performance_economy_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fuel_consumption_urban" class="text-pink font-weight-bold">Fuel consumption (urban):</label>
                <input type="text" name="fuel_consumption_urban" id="fuel_consumption_urban" class="form-control" placeholder="e.g. 42.8 mpg" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fuel_consumption_extra_urban" class="text-pink font-weight-bold">Fuel consumption (extra urban):</label>
                <input type="text" name="fuel_consumption_extra_urban" id="fuel_consumption_extra_urban" class="form-control" placeholder="e.g. 65.7 mpg">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fuel_consumption_combined" class="text-pink font-weight-bold">Fuel consumption (combined):</label>
                <input type="text" name="fuel_consumption_combined" id="fuel_consumption_combined" class="form-control" placeholder="e.g. 55.4 mpg">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="zero_sixty_mph" class="text-pink font-weight-bold">0 - 60 mph :</label>
                <input type="text" name="zero_sixty_mph" id="zero_sixty_mph" class="form-control" placeholder="e.g. 8.4 seconds">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="top_speed" class="text-pink font-weight-bold">Top speed:</label>
                <input type="text" name="top_speed" id="top_speed" class="form-control" placeholder="e.g. 128 mph">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cylinders" class="text-pink font-weight-bold">Cylinders:</label>
                <input type="text" name="cylinders" id="cylinders" class="form-control" placeholder="e.g. 4">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="valves" class="text-pink font-weight-bold">Valves:</label>
                <input type="text" name="valves" id="valves" class="form-control" placeholder="e.g. 16">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="engine_power" class="text-pink font-weight-bold">Engine power:</label>
                <input type="text" name="engine_power" id="engine_power" class="form-control" placeholder="e.g. 138 bhp">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="engine_torque" class="text-pink font-weight-bold">Engine torque:</label>
                <input type="text" name="engine_torque" id="engine_torque" class="form-control" placeholder="e.g. 250.78 lbs/ft">
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
<!-- add performance economy modal end -->

<!-- edit performance economy modal -->
  <div class="modal fade" id="EditPerformanceEconomyModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Performance Economy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        @if($performance_economy)
        <form method="post" role="form" class="form-horizontal" id="car_vehicle_performance_economy_update_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_fuel_consumption_urban" class="text-pink font-weight-bold">Fuel consumption (urban):</label>
                <input type="text" name="edit_fuel_consumption_urban" id="edit_fuel_consumption_urban" class="form-control" placeholder="e.g. 42.8 mpg" value="{{ $performance_economy->fuel_consumption_urban }}" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
                <input type="hidden" name="edit_fid" value="{{ $performance_economy->id }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_fuel_consumption_extra_urban" class="text-pink font-weight-bold">Fuel consumption (extra urban):</label>
                <input type="text" name="edit_fuel_consumption_extra_urban" id="edit_fuel_consumption_extra_urban" class="form-control" placeholder="e.g. 65.7 mpg" value="{{ $performance_economy->fuel_consumption_extra_urban }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_fuel_consumption_combined" class="text-pink font-weight-bold">Fuel consumption (combined):</label>
                <input type="text" name="edit_fuel_consumption_combined" id="edit_fuel_consumption_combined" class="form-control" placeholder="e.g. 55.4 mpg" value="{{ $performance_economy->fuel_consumption_combined }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_zero_sixty_mph" class="text-pink font-weight-bold">0 - 60 mph :</label>
                <input type="text" name="edit_zero_sixty_mph" id="edit_zero_sixty_mph" class="form-control" placeholder="e.g. 8.4 seconds" value="{{ $performance_economy->zero_sixty_mph }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_top_speed" class="text-pink font-weight-bold">Top speed:</label>
                <input type="text" name="edit_top_speed" id="edit_top_speed" class="form-control" placeholder="e.g. 128 mph" value="{{ $performance_economy->top_speed }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_cylinders" class="text-pink font-weight-bold">Cylinders:</label>
                <input type="text" name="edit_cylinders" id="edit_cylinders" class="form-control" placeholder="e.g. 4" value="{{ $performance_economy->cylinders }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_valves" class="text-pink font-weight-bold">Valves:</label>
                <input type="text" name="edit_valves" id="edit_valves" class="form-control" placeholder="e.g. 16" value="{{ $performance_economy->valves }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_engine_power" class="text-pink font-weight-bold">Engine power:</label>
                <input type="text" name="edit_engine_power" id="edit_engine_power" class="form-control" placeholder="e.g. 138 bhp" value="{{ $performance_economy->engine_power }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_engine_torque" class="text-pink font-weight-bold">Engine torque:</label>
                <input type="text" name="edit_engine_torque" id="edit_engine_torque" class="form-control" placeholder="e.g. 250.78 lbs/ft" value="{{ $performance_economy->engine_torque }}">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      @endif
    </div>
  </div>
  </div>
  </div>
<!-- add performance economy modal end -->

<!-- add dimensions modal -->
  <div class="modal fade" id="AddDimensionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Dimensions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_dimensions_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="height" class="text-pink font-weight-bold">Height:</label>
                <input type="text" name="height" id="height" class="form-control" placeholder="e.g. 1460 mm" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="height_inclusive_of_roof_rails" class="text-pink font-weight-bold">Height inclusive of roof rails:</label>
                <input type="text" name="height_inclusive_of_roof_rails" id="height_inclusive_of_roof_rails" class="form-control" placeholder="e.g. 1460 mm">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="length" class="text-pink font-weight-bold">Length:</label>
                <input type="text" name="length" id="length" class="form-control" placeholder="e.g. 4245 mm">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="wheelbase" class="text-pink font-weight-bold">Wheelbase :</label>
                <input type="text" name="wheelbase" id="wheelbase" class="form-control" placeholder="e.g. 2635 mm">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="width" class="text-pink font-weight-bold">Width:</label>
                <input type="text" name="width" id="width" class="form-control" placeholder="e.g. 2046 mm">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="width_including_mirrors" class="text-pink font-weight-bold">Width including mirrors:</label>
                <input type="text" name="width_including_mirrors" id="width_including_mirrors" class="form-control" placeholder="e.g. 2046 mm">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fuel_tank_capacity" class="text-pink font-weight-bold">Fuel tank capacity:</label>
                <input type="text" name="fuel_tank_capacity" id="fuel_tank_capacity" class="form-control" placeholder="e.g. 50 litres">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="minimum_kerb_weight" class="text-pink font-weight-bold">Minimum kerb weight:</label>
                <input type="text" name="minimum_kerb_weight" id="minimum_kerb_weight" class="form-control" placeholder="e.g. 1350 kg">
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
<!-- add dimensions modal end -->

<!-- add interior features modal -->
  <div class="modal fade" id="AddInteriorFeatureModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Interior Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_interior_features_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="interior_feature_list" class="text-pink font-weight-bold">Add multiple interior features:</label>
                <input type="text" name="interior_feature_list" id="interior_feature_list" class="form-control" placeholder="e.g. Adjustable Steering Column/Wheel" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6" id="append_interior_features">
              <div class="form-group">
                <label for="height" class="text-pink font-weight-bold">Interior features list:</label>
              </div>
              <ul>
                <?php foreach ($interior_feature as $key => $value): ?>
                  <li>{{ $value->interior_feature_list }}</li>
                <?php endforeach; ?>
              </ul>
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
<!-- add interior features end -->

<!-- edit interior features modal -->
  <div class="modal fade" id="EditInteriorFeatureModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Interior Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="edit_append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="edit_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_interior_features_update_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="edit_interior_feature_list" class="text-pink font-weight-bold">Edit interior features:</label>
                <input type="text" name="edit_interior_feature_list" id="edit_interior_feature_list" class="form-control" required>
                <input type="hidden" name="edit_interior_car_id" id="edit_interior_car_id">
                <input type="hidden" name="edit_interior_fid" id="edit_interior_fid">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
<!-- edit interior features end -->

<!-- add exterior features modal -->
  <div class="modal fade" id="AddExteriorFeatureModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exterior Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_exterior_features_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="exterior_feature_list" class="text-pink font-weight-bold">Add multiple exterior features:</label>
                <input type="text" name="exterior_feature_list" id="exterior_feature_list" class="form-control" placeholder="e.g. Alloy Wheels (15in)" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6" id="append_exterior_features">
              <div class="form-group">
                <label for="" class="text-pink font-weight-bold">Exterior features list:</label>
              </div>
              <ul>
                <?php foreach ($exterior_feature as $key => $value): ?>
                  <li>{{ $value->exterior_feature_list }}</li>
                <?php endforeach; ?>
              </ul>
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
<!-- add exterior features modal end -->

<!-- edit exterior features modal -->
  <div class="modal fade" id="EditExteriorFeatureModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Exterior Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="edit_append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="edit_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_exterior_features_update_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="edit_exterior_feature_list" class="text-pink font-weight-bold">Edit exterior features:</label>
                <input type="text" name="edit_exterior_feature_list" id="edit_exterior_feature_list" class="form-control" required>
                <input type="hidden" name="edit_exterior_car_id" id="edit_exterior_car_id">
                <input type="hidden" name="edit_exterior_fid" id="edit_exterior_fid">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
<!-- edit exterior features end -->

<!-- add safety features modal -->
  <div class="modal fade" id="AddSafetyModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Safety features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_safety_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="safety_list" class="text-pink font-weight-bold">Add multiple safety features:</label>
                <input type="text" name="safety_list" id="safety_list" class="form-control" placeholder="e.g. Air Bag Driver" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6" id="append_safety_features">
              <div class="form-group">
                <label for="" class="text-pink font-weight-bold">Safety features list:</label>
              </div>
              <ul>
                <?php foreach ($safety_list as $key => $value): ?>
                  <li>{{ $value->safety_list }}</li>
                <?php endforeach; ?>
              </ul>
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
<!-- add safety features modal end -->

<!-- edit safety features modal -->
  <div class="modal fade" id="EditSafetyFeatureModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Safety Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="edit_append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="edit_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal" id="car_safety_features_update_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="edit_safety_list" class="text-pink font-weight-bold">Edit safety features:</label>
                <input type="text" name="edit_safety_list" id="edit_safety_list" class="form-control" required>
                <input type="hidden" name="edit_safety_car_id" id="edit_safety_car_id">
                <input type="hidden" name="edit_safety_fid" id="edit_safety_fid">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
<!-- edit safety features end -->

<!-- edit dimensions modal -->
  <div class="modal fade" id="EditDimensionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Dimensions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        @if($dimension)
        <form method="post" role="form" class="form-horizontal" id="car_dimensions_update_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_height" class="text-pink font-weight-bold">Height:</label>
                <input type="text" name="edit_height" id="edit_height" class="form-control" placeholder="e.g. 1460 mm" value="{{ $dimension->height }}" required>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
                <input type="hidden" name="edit_fid" value="{{ $dimension->id }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_height_inclusive_of_roof_rails" class="text-pink font-weight-bold">Height inclusive of roof rails:</label>
                <input type="text" name="edit_height_inclusive_of_roof_rails" id="edit_height_inclusive_of_roof_rails" class="form-control" value="{{ $dimension->height_inclusive_of_roof_rails }}" placeholder="e.g. 1460 mm">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_length" class="text-pink font-weight-bold">Length:</label>
                <input type="text" name="edit_length" id="edit_length" class="form-control" placeholder="e.g. 4245 mm" value="{{ $dimension->length }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_wheelbase" class="text-pink font-weight-bold">Wheelbase :</label>
                <input type="text" name="edit_wheelbase" id="edit_wheelbase" class="form-control" placeholder="e.g. 2635 mm" value="{{ $dimension->wheelbase }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_width" class="text-pink font-weight-bold">Width:</label>
                <input type="text" name="edit_width" id="edit_width" class="form-control" placeholder="e.g. 2046 mm" value="{{ $dimension->width }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_width_including_mirrors" class="text-pink font-weight-bold">Width including mirrors:</label>
                <input type="text" name="edit_width_including_mirrors" id="edit_width_including_mirrors" class="form-control" placeholder="e.g. 2046 mm" value="{{ $dimension->width_including_mirrors }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_fuel_tank_capacity" class="text-pink font-weight-bold">Fuel tank capacity:</label>
                <input type="text" name="edit_fuel_tank_capacity" id="edit_fuel_tank_capacity" class="form-control" placeholder="e.g. 50 litres" value="{{ $dimension->fuel_tank_capacity }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_minimum_kerb_weight" class="text-pink font-weight-bold">Minimum kerb weight:</label>
                <input type="text" name="edit_minimum_kerb_weight" id="edit_minimum_kerb_weight" class="form-control" placeholder="e.g. 1350 kg" value="{{ $dimension->minimum_kerb_weight }}">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      @endif
    </div>
  </div>
  </div>
  </div>
<!-- add performance economy modal end -->
<!-- add car video modal -->
<div class="modal fade" id="AddCarVideoModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:800px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload video clip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal car_video_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="featured_image" class="text-pink font-weight-bold">Attach file:</label>
                <input type="file" name="images" accept="video/mp4" class="form-control file_multi_video"/>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12 video_preview" style="display: none;">
              <video width="100%" controls>
                <source src="" class="video_here">
                  Your browser does not support HTML5 video.
              </video>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- add car video end -->

<!-- view car video modal -->
<div class="modal fade" id="ViewCarVideoModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:800px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View video clip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <form method="post" role="form" class="form-horizontal car_video_store_form">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="featured_image" class="text-pink font-weight-bold">Attach new file:</label>
                <input type="file" name="images" accept="video/mp4" class="form-control new_file_multi_video"/>
                <input type="hidden" name="car_id" value="{{ $car_details->id }}">
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      <div class="row mb-2">
        <div class="col-md-12 new_video_preview">
          <video width="100%" controls>
            @if($car_video != null)
            <source src="<?php echo asset('storage/'.$car_video->image_url); ?>" class="new_video_here">
            @endif
              Your browser does not support HTML5 video.
          </video>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- view car video end -->

    <div class="container-fluid py-3" id="businesses">
      <!-- table-->
      <div class="card mb-4">
          <div class="card-header bg-danger text-light">
            <div class="row">
              <div class="col-sm-6">
                <h4 class="mb-0">{{ $car_details->category_name }} {{ $car_details->model }} {{ $car_details->name }} {{ $car_details->model_year }}</h4>
              </div>
              <div class="col-sm-6" style="text-align: right;">
                <a class="btn btn-dark mb-2" href="#" data-toggle="modal" data-target="#EditCarDetailsModal" data-whatever="@mdo"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Car Details</a>
                @if($car_video == null)
                <a class="btn btn-dark mb-2" href="#" data-toggle="modal" data-target="#AddCarVideoModal" data-whatever="@mdo"><i class="far fa-play-circle" aria-hidden="true" style="font-size: 18px;"></i> Upload Car Video</a>
                @else
                <a class="btn btn-dark mb-2" href="#" data-toggle="modal" data-target="#ViewCarVideoModal" data-whatever="@mdo"><i class="far fa-play-circle" aria-hidden="true" style="font-size: 18px;"></i> View Car Video</a>
                @endif
                <a class="btn btn-dark mb-2" href="{{ url('admin/upload_car_images') }}/{{ $car_details->id }}" ><i class="far fa-image" aria-hidden="true" style="font-size: 18px;"></i> Upload Car Images</a>
              </div>
            </div>
          </div>
          <div class="table-responsive" style="overflow-x: hidden;">
            <div class="row">
              <div class="col-md-3">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <th><span>Company</span></th>
                      <td>{{ $car_details->category_name }}</td>
                    </tr>
                    <tr>
                      <th><span>Model</span></th>
                      <td>{{ $car_details->model }}</td>
                    </tr>
                    <tr>
                      <th><span>Model Year</span></th>
                      <td>{{ $car_details->model_year }}</td>
                    </tr>
                    <tr>
                      <th><span>Version</span></th>
                      <td>{{ $car_details->name }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-3">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <th><span>Price</span></th>
                      <td>£{{ number_format($car_details->price) }}</td>
                    </tr>
                    <tr>
                      <th><span>Mileage</span></th>
                      <td>{{ number_format($car_details->mileage) }} miles</td>
                    </tr>
                    <tr>
                      <th><span>N0 # doors</span></th>
                      <td>{{ $car_details->number_of_doors }} Doors</td>
                    </tr>
                    <tr>
                      <th><span>N0 # seats</span></th>
                      <td>{{ $car_details->number_of_seats }} Seats</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-3">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <th><span>Engine size</span></th>
                      <td>{{ $car_details->engine_size }}L</td>
                    </tr>
                    <tr>
                      <th><span>Body syle</span></th>
                      <td>{{ $car_details->body_style }}</td>
                    </tr>
                    <tr>
                      <th><span>Fuel type</span></th>
                      <td>{{ $car_details->fuel_type }}</td>
                    </tr>
                    <tr>
                      <th><span>Gearbox type</span></th>
                      <td>{{ $car_details->gearbox_type }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-3">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <th><span>Car type</span></th>
                      <td>{{ $car_details->car_type }}</td>
                    </tr>
                    <tr>
                      <th><span>Status</span></th>
                      <td>{{ $car_details->status }}</td>
                    </tr>
                    <tr>
                      <th><span>Sell Status</span></th>
                      <td>{{ $car_details->sale_status }}</td>
                    </tr>
                    <tr>
                      <th><span>Created date</span></th>
                      <td><?php echo date('d M Y',strtotime($car_details->created_at)); ?></td>
                    </tr>
                    <tr>
                      <th><span>Featured Image</span></th>
                      <td><img src="<?php echo asset('storage/'.$car_details->featured_image); ?>" width="100px" height="80px"/></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <th  style="width: 113px;"><span>Description</span></th>
                      <td>{{ $car_details->description }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-condensed">
                  <tbody>
                    <tr>
                      <th style="width: 113px;"><span>Car History</span></th>
                      <td>{{ $car_details->car_history }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                  <div class="row">
                    <div class="col-sm-6">
                      <h5>Vehicle summary</h5>
                    </div>
                    @if($vehicle_summary != null)
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger " href="#" data-toggle="modal" data-target="#EditVehicleSummaryModal" data-whatever="@mdo"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Vehicle Summary</a>
                    </div>
                    @else
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#AddVehicleSummaryModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Vehicle Summary</a>
                    </div>
                    @endif
                  </div>
                </div>
                @if($vehicle_summary != null)
                  <div class="table-responsive">
                    <table class="table table-condensed" id="userTable">
                      <tbody>
                        <tr>
                          <th><span>CO2 Emissions</span></th>
                          <td><span>{{ $vehicle_summary->engine_size_cc }}</span></td>
                        </tr>
                        <tr>
                          <th><span>CO2 Emissions</span></th>
                          <td><span>{{ $vehicle_summary->co2_emissions }}</span></td>
                        </tr>
                        <tr>
                          <th><span>Insurance Group</span></th>
                          <td><span>{{ $vehicle_summary->insurance_group }}</span></td>
                        </tr>
                        <tr>
                          <th><span>Standard manufacturer's warranty (miles)</span></th>
                          <td><span>{{ $vehicle_summary->standard_manufacturers_warranty_miles }}</span></td>
                        </tr>
                        <tr>
                          <th><span>Standard manufacturer's warranty (years)</span></th>
                          <td><span>{{ $vehicle_summary->standard_manufacturers_warranty_years }}</span></td>
                        </tr>
                        <tr>
                          <th><span>Standard paintwork guarantee (years)</span></th>
                          <td><span>{{ $vehicle_summary->standard_paintwork_guarantee }}</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                @endif
            </div>
            <!-- end card -->
          </div>
          <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                  <div class="row">
                    <div class="col-sm-6">
                      <h5>Performance & economy</h5>
                    </div>
                    @if($performance_economy != null)
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#EditPerformanceEconomyModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Performance Economy</a>
                    </div>
                    @else
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn  btn-danger" href="#" data-toggle="modal" data-target="#AddPerformanceEconomyModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Performance Economy</a>
                    </div>
                    @endif
                  </div>
                </div>
                @if($performance_economy != null)
                <div class="table-responsive">
                  <table class="table table-condensed" id="userTable">
                    <tbody>
                      <tr>
                        <th><span>Fuel consumption (urban)</span></th>
                        <td><span>{{ $performance_economy->fuel_consumption_urban }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Fuel consumption (extra urban)</span></th>
                        <td><span>{{ $performance_economy->fuel_consumption_extra_urban }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Fuel consumption (combined)</span></th>
                        <td><span>{{ $performance_economy->fuel_consumption_combined }}</span></td>
                      </tr>
                      <tr>
                        <th><span>0 - 60 mph</span></th>
                        <td><span>{{ $performance_economy->zero_sixty_mph }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Top speed</span></th>
                        <td><span>{{ $performance_economy->top_speed }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Cylinders</span></th>
                        <td><span>{{ $performance_economy->cylinders }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Valves</span></th>
                        <td><span>{{ $performance_economy->valves }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Engine power</span></th>
                        <td><span>{{ $performance_economy->engine_power }}</span></td>
                      </tr>
                      <tr>
                        <th><span>Engine torque</span></th>
                        <td><span>{{ $performance_economy->engine_torque }}</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                @endif
            </div>
            <!-- end card -->
          </div>
          <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                  <div class="row">
                    <div class="col-sm-6">
                      <h5>Dimensions</h5>
                    </div>
                    @if($dimension != null)
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#EditDimensionModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Dimensions</a>
                    </div>
                    @else
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#AddDimensionModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Dimensions</a>
                    </div>
                    @endif
                  </div>
                </div>
                @if($dimension != null)
                <div class="table-responsive">
                    <table class="table table-condensed" id="userTable">
                        <tbody>
                            <tr>
                              <th><span>Height</span></th>
                              <td><span>{{ $dimension->height }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Height inclusive of roof rails</span></th>
                              <td><span>{{ $dimension->height_inclusive_of_roof_rails }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Length</span></th>
                              <td><span>{{ $dimension->length }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Wheelbase</span></th>
                              <td><span>{{ $dimension->wheelbase }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Width</span></th>
                              <td><span>{{ $dimension->width }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Width including mirrors</span></th>
                              <td><span>{{ $dimension->width_including_mirrors }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Fuel tank capacity</span></th>
                              <td><span>{{ $dimension->fuel_tank_capacity }}</span></td>
                            </tr>
                            <tr>
                              <th><span>Minimum kerb weight</span></th>
                              <td><span>{{ $dimension->minimum_kerb_weight }}</span></td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <!-- end card -->
          </div>
          <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                  <div class="row">
                    <div class="col-sm-6">
                      <h5>Interior Features</h5>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#AddInteriorFeatureModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Interior Features</a>
                    </div>
                  </div>
                </div>
                @if($interior_feature != null)
                <div class="row">
                  <div class="col-md-12 mx-3 mt-3" id="edit_append_interior_features">
                    <h4>Interior features list:</h4>
                    <ul>
                      <?php foreach ($interior_feature as $key => $value): ?>
                        <li style="cursor: pointer;">
                          <span id="appned_interior_feature_list_<?php echo $value->id; ?>">{{ $value->interior_feature_list }}</span>
                          <a href="#" class="edit_interior_modal" data-toggle="modal" data-target="#EditInteriorFeatureModal" data-whatever="@mdo" data-id="{{ $value->id }}" data-car_id="{{ $value->car_id }}" data-interior_feature_list="{{ $value->interior_feature_list }}" style="color: #0087CB;"><i class="fa fa-pencil"></i> Edit</a>
                          <!-- <a href="#" class="delete_interior_modal" data-toggle="modal" data-target="#DeleteInteriorFeatureModal" data-whatever="@mdo" data-id="{{ $value->id }}" data-car_id="{{ $value->car_id }}" data-interior_feature_list="{{ $value->interior_feature_list }}" style="color: red;"><i class="fa fa-times"></i> Delete</a> -->
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
                @endif
            </div>
            <!-- end card -->
          </div>
          <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                  <div class="row">
                    <div class="col-sm-6">
                      <h5>Safety List: </h5>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#AddSafetyModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Safety Features</a>
                    </div>
                  </div>
                </div>
                @if($safety_list != null)
                <div class="row">
                  <div class="col-md-12 mx-3 mt-3" id="edit_append_safety_features">
                    <h4>Safety list:</h4>
                    <ul>
                      <?php foreach ($safety_list as $key => $value): ?>
                        <li style="cursor: pointer;">
                          <span id="appned_safety_feature_list_<?php echo $value->id; ?>">{{ $value->safety_list }}</span>
                          <a href="#" class="edit_safety_modal" data-toggle="modal" data-target="#EditSafetyFeatureModal" data-whatever="@mdo" data-id="{{ $value->id }}" data-car_id="{{ $value->car_id }}" data-safety_list="{{ $value->safety_list }}" style="color: #0087CB;"><i class="fa fa-pencil"></i> Edit</a>
                          <!-- <a href="#" class="delete_safety_modal" data-toggle="modal" data-target="#DeleteSafetyFeatureModal" data-whatever="@mdo" data-id="{{ $value->id }}" data-car_id="{{ $value->car_id }}" data-safety_list="{{ $value->safety_list }}" style="color: red;"><i class="fa fa-times"></i> Delete</a> -->
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
                @endif
            </div>
            <!-- end card -->
          </div>
          <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                  <div class="row">
                    <div class="col-sm-6">
                      <h5>Exterior Features</h5>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#AddExteriorFeatureModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Exterior Features</a>
                    </div>
                  </div>
                </div>
                @if($exterior_feature != null)
                <div class="row">
                  <div class="col-md-12 mx-3 mt-3" id="edit_append_exterior_features">
                    <h4>Exterior features list:</h4>
                    <ul>
                      <?php foreach ($exterior_feature as $key => $value): ?>
                        <li style="cursor: pointer;">
                          <span id="appned_exterior_feature_list_<?php echo $value->id; ?>">{{ $value->exterior_feature_list }}</span>
                          <a href="#" class="edit_exterior_modal" data-toggle="modal" data-target="#EditExteriorFeatureModal" data-whatever="@mdo" data-id="{{ $value->id }}" data-car_id="{{ $value->car_id }}" data-exterior_feature_list="{{ $value->exterior_feature_list }}" style="color: #0087CB;"><i class="fa fa-pencil"></i> Edit</a>
                          <!-- <a href="#" class="delete_exterior_modal" data-toggle="modal" data-target="#DeleteExteriorFeatureModal" data-whatever="@mdo" data-id="{{ $value->id }}" data-car_id="{{ $value->car_id }}" data-exterior_feature_list="{{ $value->exterior_feature_list }}" style="color: red;"><i class="fa fa-times"></i> Delete</a> -->
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
                @endif
            </div>
            <!-- end card -->
          </div>
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

// function safety_data(id) {
//   var safety_value = $('#edit_safety_list_'+id).val();
//
//   var fo_d = new FormData();
//   fo_d.append( 'safety_id', id );
//   fo_d.append( 'safety_list', safety_value );
//   $.ajax({
//     url:"{{ url('admin/update_car_safety_features_details') }}",
//     method:"POST",
//     data:fo_d,
//     dataType:"JSON",
//     contentType:false,
//     cache:false,
//     processData:false,
//     success:function(data){
//       $('.append_errors ul').text('');
//       $('.append_success ul').text('');
//       if(data.errors)
//       {
//         $.each(data.errors, function(i, error){
//           $('.append_errors').show();
//           $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
//         });
//       }else {
//         $('#appned_safety_list_value_'+id).text('');
//         $('#appned_safety_list_value_'+id).append(data.safety_list+' <span class="btn-edit"><i class="fa fa-pencil"></i></span>');
//         $('#appned_safety_list_form_'+id).hide();
//         $('#edit_safety_list_'+id).val(data.safety_list);
//         console.log(data);
//         // $('.append_errors').hide();
//         // $('.append_success').show();
//         // $('.append_success ul').append("<li>Performance economy data updated successfully.</li>");
//         // setTimeout(function(){ $('.append_success').hide(); },2000);
//         // location.reload();
//       }
//     },
//   });
// }

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

$('#EditCarDetailsModal').on('shown.bs.modal', function () {
  $('#model').focus();
});

  $('#edit_car_details_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('#edit_append_errors ul').text('');
        $('#edit_append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('#edit_append_errors').show();
            $('#edit_append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('#edit_append_errors').hide();
          $('#edit_append_success').show();
          $('#edit_append_success ul').append("<li>Car data updated successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('#car_vehicle_summary_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_vehicle_summary_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Vehicle summary data uploaded successfully.</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('#car_vehicle_summary_update_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_vehicle_summary_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Vehicle summary data updated successfully.</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('#car_vehicle_performance_economy_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_performance_economy_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Performance economy data uploaded successfully.</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('#car_vehicle_performance_economy_update_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_performance_economy_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Performance economy data updated successfully.</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('#car_dimensions_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_dimensions_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Dimensions data uploaded successfully.</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('#car_interior_features_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_interior_features_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Interior feature data uploaded successfully.</li>");
          $('#append_interior_features ul').prepend("<li>" + data.interior_feature_list + "</li>");
          $('#edit_append_interior_features ul').prepend("<li>"+"<span id='appned_interior_feature_list_"+data.id+"'>"+data.interior_feature_list+"</span><a href='#' class='edit_interior_modal' data-toggle='modal' data-target='#EditInteriorFeatureModal' data-whatever='@mdo' data-id='"+data.id+"' data-car_id='"+data.car_id+"' data-interior_feature_list='"+data.interior_feature_list+"' style='color: #0087CB;'> <i class='fa fa-pencil'></i> Edit</a>"+"</li>");
          $('#interior_feature_list').val('');
          setTimeout(function(){ $('.append_success').hide(); },2000);
        }
      },
    });
  });

  $(document).on('click', '.edit_interior_modal', function(){
		$('#edit_interior_fid').val($(this).data('id'));
		$('#edit_interior_car_id').val($(this).data('car_id'));
		$('#edit_interior_feature_list').val($(this).data('interior_feature_list'));
		$('.edit_append_errors').hide();
		$('.edit_append_success').hide();
	});

  $('#EditInteriorFeatureModal').on('shown.bs.modal', function () {
    $('#edit_interior_feature_list').focus();
  });

  $(document).on('click', '.edit_exterior_modal', function(){
		$('#edit_exterior_fid').val($(this).data('id'));
		$('#edit_exterior_car_id').val($(this).data('car_id'));
		$('#edit_exterior_feature_list').val($(this).data('exterior_feature_list'));
		$('.edit_append_errors').hide();
		$('.edit_append_success').hide();
	});

  $('#EditExteriorFeatureModal').on('shown.bs.modal', function () {
    $('#edit_exterior_feature_list').focus();
  });

  $(document).on('click', '.edit_safety_modal', function(){
		$('#edit_safety_fid').val($(this).data('id'));
		$('#edit_safety_car_id').val($(this).data('car_id'));
		$('#edit_safety_list').val($(this).data('safety_list'));
		$('.edit_append_errors').hide();
		$('.edit_append_success').hide();
	});

  $('#EditSafetyFeatureModal').on('shown.bs.modal', function () {
    $('#edit_safety_list').focus();
  });

  $('#car_interior_features_update_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_interior_features_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.edit_append_errors ul').text('');
        $('.edit_append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.edit_append_errors').show();
            $('.edit_append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.edit_append_errors').hide();
          $('.edit_append_success').show();
          $('.edit_append_success ul').append("<li>Interior feature data updated successfully.</li>");
          $('#edit_append_interior_features ul').prepend("<li>" + data.interior_feature_list + "</li>");
          setTimeout(function(){ $('.edit_append_success').hide(); },2000);
          setTimeout(function(){ $('#EditInteriorFeatureModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
          location.reload();
        }
      },
    });
  });

  $('#car_exterior_features_update_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_exterior_features_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.edit_append_errors ul').text('');
        $('.edit_append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.edit_append_errors').show();
            $('.edit_append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.edit_append_errors').hide();
          $('.edit_append_success').show();
          $('.edit_append_success ul').append("<li>Exterior feature data updated successfully.</li>");
          $('#edit_append_exterior_features ul').prepend("<li>" + data.exterior_feature_list + "</li>");
          setTimeout(function(){ $('.edit_append_success').hide(); },2000);
          setTimeout(function(){ $('#EditExteriorFeatureModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
          location.reload();
        }
      },
    });
  });

  $('#car_safety_features_update_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_safety_features_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.edit_append_errors ul').text('');
        $('.edit_append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.edit_append_errors').show();
            $('.edit_append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.edit_append_errors').hide();
          $('.edit_append_success').show();
          $('.edit_append_success ul').append("<li>Safety feature data updated successfully.</li>");
          $('#edit_append_safety_features ul').prepend("<li>" + data.safety_list + "</li>");
          setTimeout(function(){ $('.edit_append_success').hide(); },2000);
          setTimeout(function(){ $('#EditSafetyFeatureModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
          location.reload();
        }
      },
    });
  });

  $('#car_exterior_features_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_exterior_features_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Exterior feature data uploaded successfully.</li>");
          $('#append_exterior_features ul').prepend("<li>" + data.exterior_feature_list + "</li>");
          $('#edit_append_exterior_features ul').prepend("<li>"+"<span id='appned_exterior_feature_list_"+data.id+"'>"+data.exterior_feature_list+"</span><a href='#' class='edit_exterior_modal' data-toggle='modal' data-target='#EditExteriorFeatureModal' data-whatever='@mdo' data-id='"+data.id+"' data-car_id='"+data.car_id+"' data-exterior_feature_list='"+data.exterior_feature_list+"' style='color: #0087CB;'> <i class='fa fa-pencil'></i> Edit</a>"+"</li>");
          $('#exterior_feature_list').val('');
          setTimeout(function(){ $('.append_success').hide(); },2000);
        }
      },
    });
  });

  $('#car_safety_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_safety_features_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Safety feature data uploaded successfully.</li>");
          $('#append_safety_features ul').prepend("<li>" + data.safety_list + "</li>");
          $('#edit_append_safety_features ul').prepend("<li>"+"<span id='appned_safety_feature_list_"+data.id+"'>"+data.safety_list+"</span><a href='#' class='edit_safety_modal' data-toggle='modal' data-target='#EditSafetyFeatureModal' data-whatever='@mdo' data-id='"+data.id+"' data-car_id='"+data.car_id+"' data-safety_list='"+data.safety_list+"' style='color: #0087CB;'> <i class='fa fa-pencil'></i> Edit</a>"+"</li>");
          $('#safety_list').val('');
          setTimeout(function(){ $('.append_success').hide(); },2000);
        }
      },
    });
  });

  $('#car_dimensions_update_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_car_dimensions_details') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>Dimensions data updated successfully.</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $('.car_video_store_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_car_video_file') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_errors ul').text('');
        $('.append_success ul').text('');
        if(data.errors)
        {
          $.each(data.errors, function(i, error){
            $('.append_errors').show();
            if(data.errors[i] == "The images must be a file of type: mp4."){
              $('.append_errors ul').append("<li>The video must be a file of type: mp4.</li>");
            }else {
              $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
            }
          });
        }else {
          $('.append_errors').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li>"+data.success+"</li>");
          setTimeout(function(){ $('.append_success').hide(); },2000);
          location.reload();
        }
      },
    });
  });

  $(document).on("change", ".file_multi_video", function(evt) {
    $('.video_preview').show();
    var $source = $('.video_here');
    $source[0].src = URL.createObjectURL(this.files[0]);
    console.log($source.parent()[0].load());
  });

  $(document).on("change", ".new_file_multi_video", function(evt) {
    $('.new_video_preview').show();
    var $source = $('.new_video_here');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });

  // $('.btn-edit').on('click', function() {
  //   $(this).parent().parent().find('.safety-show').show();
  // });
});
</script>
<style media="screen">
.close{
font-size: 1.4rem;
}

#media-list li img {
    width: 100px;
    height: 100px
}

#media-list li {
    height: 102px
}

#media-list li video {
    width: 100px;
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%)
}

div#hint_brand .modal-dialog {
    top: 110px;
    width: 567px;
    max-width: 100%
}

li.myupload span {
    position: relative;
    width: 100px;
    height: 100px;
    display: block;
    background: #fff
}

li.myupload span input {
    opacity: 0;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0
}

li.myupload span i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #ccc;
    font-size: 54px
}

#media-list li {
    float: left;
    border: 1px solid #ccc;
    background: #ccc;
    position: relative;
    margin: 0 5px 5px 0;
    width: 102px
}

#media-list li:last-child {
    margin-right: 0
}

.post-thumb {
    position: absolute;
    background: rgba(0, 0, 0, 0.4);
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    display: none
}

#media-list li:hover .post-thumb {
    display: block
}

a.remove-pic {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 12px;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 50%;
    display: block;
    height: 25px;
    width: 25px;
    text-align: center;
    padding: 3px 0
}

.inner-post-thumb {
    position: relative
}

.user-post-text-wrap {
    position: relative
}

.user-pic-post {
    position: absolute;
    width: 50px;
    height: 50px;
    top: 0;
    left: 0
}

.user-pic-post img {
    width: 100%
}

.user-txt-post {
    padding: 0 0 0 65px
}

textarea.form-control.upostTextarea {
    border: 0;
    box-shadow: none;
    height: 85px;
    resize: none
}

.user-post-text-wrap {
    border-bottom: 1px solid #ccc;
    margin: 0 0 15px
}

.user-post-btn-wrap {
    margin: 25px 0 0
}

ul.btn-nav {
    list-style: none;
    padding: 0;
    margin: 0
}

ul.btn-nav li {
    position: relative;
    float: left;
    margin: 0 10px 0 0
}

ul.btn-nav li span input {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    z-index: 9;
    opacity: 0;
    filter: alpha(opacity=100)
}

ul#media-list {
    list-style: none;
    padding: 0;
    margin: 0
}
</style>

@endsection
