<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Finances</h4>
        </div>
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th><span>ID</span></th>
                    <th><span>Name</span></th>
                    <th><span>Email</span></th>
                    <th><span>Phone</span></th>
                    <th><span>Message</span></th>
                    <th><span>Date</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  {{ csrf_field() }}
                 <?php if(isset($finances) && count($finances) > 0){ ?>
                   @foreach($finances as $finance)
                     <tr class="Finance{{$finance->id}}">
                       <td>{{ $finance->id }}</td>
                       <td>{{ $finance->name }}</td>
                       <td>{{ $finance->email }}</td>
                       <td>{{ $finance->phone }}</td>
                       <td>{{ $finance->info_message }}</td>
                       <td><?php echo date('d M Y',strtotime($finance->created_at)); ?></td>
                     </tr>
                   @endforeach
                <?php }else { ?>
                  <tr>
                    <th id="yet">
                      <h2>Finances are not added yet</h2>
                    </th>
                  </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-finances justify-content-center">
     {{ $finances->links() }}
   </ul>
</div>
