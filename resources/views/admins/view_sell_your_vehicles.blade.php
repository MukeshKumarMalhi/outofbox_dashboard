@extends('layouts.a_app')
@section('title','Sell Your Vehicle')
@section('content')

    <!-- Page Content -->
        <div class="container-fluid py-3" id="sell_your_vehicles">
          <!-- table-->
              <div class="table-responsive border-bottom rounded mb-3">
                  <table class="table bs-table">
                      <thead>
                          <tr>
                              <th>Vehicle Type</th>
                              <th>Company</th>
                              <th>Model</th>
                              <th>Vehicle Reg</th>
                              <th>Mileage</th>
                              <th>Service History</th>
                              <th>Vehicle desc</th>
                              <th>Condition</th>
                              <th>Condition desc</th>
                              <th>Name</th>
                              <th>Phone #</th>
                              <th>Email</th>
                              <th>Date</th>
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
          <div style="margin-top: 10px;margin-left: 440px;">
             <ul class="pagination-for-sell-your-vehicles justify-content-center">
               {{ $sell_your_vehicles->links() }}
             </ul>
          </div>
        </div>

<script type="text/javascript">
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
</style>
@endsection
