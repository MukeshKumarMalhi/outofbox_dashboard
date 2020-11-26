@extends('layouts.a_app')
@section('title',"$page->page_name")
@section('content')

    <!-- Block Content -->
    <!-- add Block modal -->
      <div class="modal fade" id="LayoutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Layout</h5>
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
            <form method="post" role="form" class="form-horizontal" id="layout_form">
              @csrf
              <input type="hidden" name="page_id" value="{{ $page->id }}">
              <div class="row mb-2">
                <div class="form-group col-sm-12">
                  <label class="font-gotham-medium">Choose Columns: </label>
                  <br>
                  <div class="bs-custom-radio">
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="radio" name="columns" value="1" id="column1" class="form-check-input" checked><label class="form-check-label" for="column1">1</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="radio" name="columns" value="2" id="column2" class="form-check-input"><label class="form-check-label" for="column2">2</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="radio" name="columns" value="3" id="column3" class="form-check-input"><label class="form-check-label" for="column3">3</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="radio" name="columns" value="4" id="column4" class="form-check-input"> <label class="form-check-label" for="column4">4</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="radio" name="columns" value="5" id="column5" class="form-check-input"> <label class="form-check-label" for="column5">5</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="radio" name="columns" value="6" id="column6" class="form-check-input"> <label class="form-check-label" for="column6">6</label>&nbsp;&nbsp;
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-2 append_columns">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Choose Block: </label>
                    <select class="form-control" name="building_block_id">
                      <option value="">Select Building Block</option>";
                      <?php foreach ($blocks as $key => $value): ?>
                        <option value="{{ $value['id'] }}">{{ $value['building_block_name'] }}</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Block Order: </label>
                    <input type="number" class="form-control" placeholder="Enter number e.g. 1,2,3,4 or 5" name="layout_order">
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
    <!-- add Block modal -->
        <div class="container-fluid" id="layouts">
          <div class="row">
            <div class="col-md-6 text-left">
            </div>
            <div class="col-md-6 text-right">
              <a class="btn bg-dark text-light my-2" data-toggle="modal" data-target="#LayoutModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Layout</a>
            </div>
          </div>
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table" id="layouts">
                  <thead>
                      <tr>
                          <th>Layout ID</th>
                          <th>Building Block</th>
                          <th>Layout Order</th>
                          <th>Created at</th>
                          <th class="text-center" style="width:120px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                    {{ csrf_field() }}
                   <?php if(isset($layouts) && count($layouts) > 0){ ?>
                     @foreach($layouts as $layout)
                       <tr class="Layout{{$layout->id}}">
                         <td>{{ $layout->id }}</td>
                         <td>{{ $layout->building_block_name }}</td>
                         <td>{{ $layout->layout_order }}</td>
                         <td><?php echo date('d M Y',strtotime($layout->created_at)); ?></td>
                         <td>
                         </td>
                       </tr>
                     @endforeach
                  <?php }else { ?>
                    <tr>
                      <th id="yet">
                        <h2>Layouts are not added yet</h2>
                      </th>
                    </tr>
                  <?php } ?>
                  </tr>
                  </tbody>
              </table>
          </div>
          <div>
		         <ul class="pagination-for-layouts justify-content-center">
               {{ $layouts->links() }}
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



    $('#BlockModal').on('shown.bs.modal', function () {
      $('#building_block_name').focus();
    });

    $(".form-check-input").change(function(){
      var selValue = $("input[type='radio']:checked").val();
      $.ajax({
        url:"{{ url('admin/get_blocks') }}",
        method:"GET",
        dataType:"JSON",
  			contentType:false,
  			cache:false,
  			processData:false,
        success:function(data){
          $('.append_columns').text('');
          var finaldata = "";
          var k = 0;
          var selectboxdata = "<div class='col-md col_"+k+"'>"+
            "<div class='form-group'>"+
              "<label class='text-pink font-weight-bold'>Choose Block: </label>"+
              "<select class='form-control' name='building_block_id[]'>"+
                "<option value=''>Select Building Block</option>";
                $.each(data,function(key, value)
                {
                  selectboxdata += "<option value='" + value.id + "'>" + value.building_block_name + "</option>";
                });
                selectboxdata += "</select>"+"</div>"+"</div>";
                for (var i = 0; i < selValue; i++)
                {
                   finaldata += selectboxdata;
                   k += i;
                }
                $('.append_columns').append(finaldata);

        },
      });
    });

  $('#layout_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_layout') }}",
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
					$('#append_success ul').append("<li>Layout Created Successfully.</li>");
          $('#LayoutModal').find('#layout_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#LayoutModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_building_block_name').val($(this).data('building_block_name'));
		$('#edit_building_block_html_code').text($(this).data('building_block_html_code'));
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_block_form').on('submit', function(event){
    var url = "{{ url('admin/update_block') }}/";
		event.preventDefault();
    $.ajax({
      url:url,
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
          var date = moment(data.created_at).format("D MMM YYYY");
					$('.Block' + data.id).replaceWith(" "+
					"<tr class='Block"+data.id+"'>"+
					"<td>" + data.building_block_name + "</td>"+
          "<td>" + data.parent_building_block_name + "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-building_block_name='"+data.building_block_name+"' data-parent_block_id='"+data.parent_block_id+"' data-toggle='modal' data-target='#EditBlockModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-building_block_name='"+data.building_block_name+"' data-toggle='modal' data-target='#DeleteBlockModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Block Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditBlockModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
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
ul.pagination-for-layouts.justify-content-center {text-align: center;}
ul.pagination-for-layouts.justify-content-center svg{width:20px;}
</style>
@endsection
