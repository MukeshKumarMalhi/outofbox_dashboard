<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Part Exchanges</h4>
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
                    <th><span>Condition</span></th>
                    <th><span>Name</span></th>
                    <th><span>Phone #</span></th>
                    <th><span>Email</span></th>
                    <th><span>Best time to call</span></th>
                    <th><span>Date</span></th>
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
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-part-exchanges justify-content-center">
     {{ $part_exchanges->links() }}
   </ul>
</div>
