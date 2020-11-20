<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Sell Your Vehicles</h4>
        </div>
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th><span>Vehicle Type</span></th>
                    <th><span>Company</span></th>
                    <th><span>Model</span></th>
                    <th><span>Vehicle Reg</span></th>
                    <th><span>Mileage</span></th>
                    <th><span>Service History</span></th>
                    <th><span>Vehicle desc</span></th>
                    <th><span>Condition</span></th>
                    <th><span>Condition desc</span></th>
                    <th><span>Name</span></th>
                    <th><span>Phone #</span></th>
                    <th><span>Email</span></th>
                    <th><span>Date</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  {{ csrf_field() }}
                 <?php if(isset($sell_your_vehicles) && count($sell_your_vehicles) > 0){ ?>
                   @foreach($sell_your_vehicles as $vehicles)
                     <tr class="SellYourVehicle{{$vehicles->id}}">
                       <td>{{ $vehicles->vehicle_type }}</td>
                       <td>{{ $vehicles->company }}</td>
                       <td>{{ $vehicles->model }}</td>
                       <td>{{ $vehicles->vehicle_reg }}</td>
                       <td>{{ $vehicles->mileage }}</td>
                       <td>{{ $vehicles->service_history }}</td>
                       <td>{{ $vehicles->vehicle_come_with_specify }}</td>
                       <td>{{ $vehicles->vehicle_condition }}</td>
                       <td>{{ $vehicles->vehicle_damage_condition_description }}</td>
                       <td>{{ $vehicles->full_name }}</td>
                       <td>{{ $vehicles->phone_number }}</td>
                       <td>{{ $vehicles->email_address }}</td>
                       <td><?php echo date('d M Y',strtotime($vehicles->created_at)); ?></td>
                     </tr>
                   @endforeach
                <?php }else { ?>
                  <tr>
                    <th id="yet">
                      <h2>Sell your vehicles are not added yet</h2>
                    </th>
                  </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-sell-your-vehicles justify-content-center">
     {{ $sell_your_vehicles->links() }}
   </ul>
</div>
