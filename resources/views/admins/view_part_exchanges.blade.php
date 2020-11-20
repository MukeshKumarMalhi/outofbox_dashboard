@extends('layouts.a_app')
@section('title','Part Exchanges')

@section('content')

    <!-- Page Content -->
        <div class="container-fluid py-3" id="part_exchanges">
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
                          <th>Condition</th>
                          <th>Name</th>
                          <th>Phone #</th>
                          <th>Email</th>
                          <th>Best time to call</th>
                          <th>Date</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        {{ csrf_field() }}
                       <?php if(isset($part_exchanges) && count($part_exchanges) > 0){ ?>
                         @foreach($part_exchanges as $part_exchange)
                           <tr class="PartExchange{{$part_exchange->id}}">
                             <td>{{ $part_exchange->vehicle_type }}</td>
                             <td>{{ $part_exchange->company }}</td>
                             <td>{{ $part_exchange->model }}</td>
                             <td>{{ $part_exchange->vehicle_reg }}</td>
                             <td>{{ $part_exchange->mileage }}</td>
                             <td>{{ $part_exchange->condition }}</td>
                             <td>{{ $part_exchange->full_name }}</td>
                             <td>{{ $part_exchange->phone_number }}</td>
                             <td>{{ $part_exchange->email_address }}</td>
                             <td>{{ $part_exchange->best_time_to_call }}</td>
                             <td><?php echo date('d M Y',strtotime($part_exchange->created_at)); ?></td>
                           </tr>
                         @endforeach
                      <?php }else { ?>
                        <tr>
                          <th id="yet">
                            <h2>Part Exchanges are not added yet</h2>
                          </th>
                        </tr>
                      <?php } ?>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
             <ul class="pagination-for-sell-your-vehicles justify-content-center">
               {{ $part_exchanges->links() }}
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
