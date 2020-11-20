<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Cars</h4>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#CarModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Car</a>
        </div>
        <!-- <div class="col-sm-6" style="text-align: right;">
        </div> -->
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed" id="userTable">
            <thead>
                <tr>
                    <th><span>ID</span></th>
                    <th><span>Company</span></th>
                    <th><span>Model</span></th>
                    <th><span>Price</span></th>
                    <th><span>Mileage</span></th>
                    <th><span>Fuel type</span></th>
                    <th><span>Gearbox type</span></th>
                    <th><span>Created date</span></th>
                    <th><span>Image</span></th>
                    <th class="text-center" style="width:110px">Action</th>
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
                       <td>{{ $car->model }} {{ $car->model_year }}</td>
                       <td>£{{ number_format($car->price) }}</td>
                       <td>{{ number_format($car->mileage) }} miles</td>
                       <td>{{ $car->fuel_type }}</td>
                       <td>{{ $car->gearbox_type }}</td>
                       <td><?php echo date('d M Y',strtotime($car->created_at)); ?></td>
                       <td><img src="<?php echo asset('storage/'.$car->featured_image); ?>" width="50px" height="50px"/></td>
                       <td class="px-2 text-nowrap">
                         <a href="{{ url('admin/view_details') }}/{{ $car->category_name.'_'.$car->model }}/{{ $car->id }}" class="btn btn-sm btn-warning" ><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>
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
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-cars justify-content-center">
     {{ $cars->links() }}
   </ul>
</div>
