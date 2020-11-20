@extends('layouts.a_app')
@section('title','Finances')

@section('content')

    <!-- Page Content -->
        <div class="container-fluid py-3" id="finances">
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Message</th>
                          <th>Date</th>
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
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-finances justify-content-center">
               {{ $finances->links() }}
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
