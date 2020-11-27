@extends('layouts.a_app')
@section('title',"Building Blocks")
@section('content')

    <!-- Block Content -->
    <!-- add Block modal -->
      <div class="modal fade" id="BlockModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Block</h5>
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
            <form method="post" role="form" class="form-horizontal" id="block_form">
              @csrf
              <div class="row mb-4">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Block Name: </label>
                    <input type="text" name="building_block_name" id="building_block_name" class="form-control" placeholder="Enter name" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="form-group col-sm-12">
                  <label class="text-pink font-weight-bold">Choose Block Items: </label>
                  <br>
                  <div class="bs-custom-checkbox">
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="checkbox" name="building_block_items[]" value="text" id="block_items1" class="form-check-input"><label class="form-check-label" style="vertical-align: middle;" for="block_items1">Text</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="checkbox" name="building_block_items[]" value="url" id="block_items5" class="form-check-input"> <label class="form-check-label" style="vertical-align: middle;" for="block_items5">URL</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="checkbox" name="building_block_items[]" value="textarea" id="block_items2" class="form-check-input"><label class="form-check-label" style="vertical-align: middle;" for="block_items2">Textarea</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="checkbox" name="building_block_items[]" value="image" id="block_items3" class="form-check-input"><label class="form-check-label" style="vertical-align: middle;" for="block_items3">Image</label>&nbsp;&nbsp;
                    </div>
                    <div class="form-check d-inline-block mb-2 mr-2">
                      <input type="checkbox" name="building_block_items[]" value="multiple_images" id="block_items4" class="form-check-input"> <label class="form-check-label" style="vertical-align: middle;" for="block_items4">Multiple Images</label>&nbsp;&nbsp;
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Block Html Code: </label>
                    <textarea name="building_block_html_code" class="form-control" rows="8" cols="80"></textarea>
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
    <!-- edit Block modal -->
      <div class="modal fade" id="EditBlockModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Block</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_block_form" enctype="multipart/form-data">
                @method('PATCH')
      					@csrf
                <div class="row mb-4">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="fid" class="text-pink font-weight-bold">ID : </label>
                      <input type="text" id="fid" name="fid" class="form-control" disabled>
                      <input type="hidden" id="edit_fid" name="edit_fid">
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="edit_building_block_name" class="text-pink font-weight-bold">Block Name: </label>
                      <input type="text" name="edit_building_block_name" id="edit_building_block_name" class="form-control" placeholder="Enter name" autocomplete="off" required>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="form-group col-sm-12">
                    <label class="text-pink font-weight-bold">Choose Block Items: </label>
                    <br>
                    <div class="bs-custom-checkbox all_checks">
                      <div class="form-check d-inline-block mb-2 mr-2">
                        <input type="checkbox" name="edit_building_block_items[]" value="text" id="edit_block_items1" class="form-check-input"><label class="form-check-label" style="vertical-align: middle;" for="block_items1">Text</label>&nbsp;&nbsp;
                      </div>
                      <div class="form-check d-inline-block mb-2 mr-2">
                        <input type="checkbox" name="edit_building_block_items[]" value="url" id="edit_block_items5" class="form-check-input"> <label class="form-check-label" style="vertical-align: middle;" for="block_items5">URL</label>&nbsp;&nbsp;
                      </div>
                      <div class="form-check d-inline-block mb-2 mr-2">
                        <input type="checkbox" name="edit_building_block_items[]" value="textarea" id="edit_block_items2" class="form-check-input"><label class="form-check-label" style="vertical-align: middle;" for="block_items2">Textarea</label>&nbsp;&nbsp;
                      </div>
                      <div class="form-check d-inline-block mb-2 mr-2">
                        <input type="checkbox" name="edit_building_block_items[]" value="image" id="edit_block_items3" class="form-check-input"><label class="form-check-label" style="vertical-align: middle;" for="block_items3">Image</label>&nbsp;&nbsp;
                      </div>
                      <div class="form-check d-inline-block mb-2 mr-2">
                        <input type="checkbox" name="edit_building_block_items[]" value="multiple_images" id="edit_block_items4" class="form-check-input"> <label class="form-check-label" style="vertical-align: middle;" for="block_items4">Multiple Images</label>&nbsp;&nbsp;
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="edit_building_block_html_code" class="text-pink font-weight-bold">Block Html Code: </label>
                      <textarea name="edit_building_block_html_code" id="edit_building_block_html_code" class="form-control" rows="8" cols="80"></textarea>
                    </div>
                  </div>
                </div>
      				</div>
      				<div class="modal-footer">
      					<button type="submit" class="edit btn btn-dark">Update</button>
      					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
      <!-- edit Block modal end -->
      <!-- delete Block modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteBlockModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      				<button type="button" class="delete btn btn-dark">Delete</button>
      				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      			</div>
      		</div>
      	</div>
      </div>
      <!-- edit Block modal end -->

        <div class="container-fluid" id="blocks">
          <div class="row">
            <div class="col-md-6 text-left">
            </div>
            <div class="col-md-6 text-right">
              <a class="btn bg-dark text-light my-2" data-toggle="modal" data-target="#BlockModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Block</a>
            </div>
          </div>
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table" id="blocks">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Items</th>
                          <th>Code</th>
                          <th>Created at</th>
                          <th class="text-center" style="width:120px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    {{ csrf_field() }}
                   <?php if(isset($building_blocks) && count($building_blocks) > 0){ ?>
                     @foreach($building_blocks as $block)
                       <tr class="Block{{$block->id}}">
                         <td>{{ $block->building_block_name }}</td>
                         <td>{{ $block->building_block_items }}</td>

                         <td>{{ $block->building_block_html_code }} <a style="color: blue;" href="{{ url('admin/view_block_code') }}/{{ $block->id }}">[View]</a> </td>
                         <td><?php echo date('d M Y',strtotime($block->created_at)); ?></td>
                         <?php
                            $items = explode(',', $block->building_block_items);
                           ?>
                         <td>
                           <a href="#" class="edit_modal btn btn-outline-danger mb-2" data-id="{{ $block->id }}" data-building_block_name="{{ $block->building_block_name }}" data-building_block_items="<?php echo htmlspecialchars(json_encode($items), ENT_QUOTES, 'UTF-8'); ?>" data-building_block_html_code="{{ $block->building_block_html_code }}" data-toggle="modal" data-target="#EditBlockModal" data-whatever="@mdo"><i class="fas fa-edit"></i></a>
                           <a href="#" class="delete_modal btn btn-outline-danger mb-2" data-id="{{ $block->id }}" data-building_block_name="{{ $block->building_block_name }}" data-toggle="modal" data-target="#DeleteBlockModal" data-whatever="@mdo"><i class='fas fa-trash'></i></a>
                         </td>
                       </tr>
                     @endforeach
                  <?php }else { ?>
                    <tr>
                      <th id="yet">
                        <h2>Blocks are not added yet</h2>
                      </th>
                    </tr>
                  <?php } ?>
                  </tbody>
              </table>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-blocks justify-content-center">
               {{ $building_blocks->links() }}
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

  $('#block_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ route('admin.building_blocks.store') }}",
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
          // var date = moment(data.created_at).format("D MMM YYYY");
					// $('tbody').prepend("<tr class='Block"+data.id+"'>"+
					// "<td>" + data.building_block_name + "</td>"+
					// "<td>" + data.building_block_html_code + "</td>"+
					// "<td>" + date + "</td>"+
					// "<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-building_block_name='"+data.building_block_name+"' data-building_block_html_code='"+data.building_block_html_code+"' data-toggle='modal' data-target='#EditBlockModal' data-whatever='@mdo'>"+
					// "<i class='fas fa-edit'></i></a> "+
					// "<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-building_block_name='"+data.building_block_name+"' data-toggle='modal' data-target='#DeleteBlockModal' data-whatever='@mdo'>"+
					// "<i class='fas fa-trash'></i></a>"+
					// "</td>"+
					// "</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Block Created Successfully.</li>");
          $('#BlockModal').find('#block_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#BlockModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
    $('#EditBlockModal').find('#edit_block_form')[0].reset();
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_building_block_name').val($(this).data('building_block_name'));
    var values = $(this).data('building_block_items');
    $(".all_checks").find('[value=' + values.join('], [value=') + ']').prop("checked", true);
		$('#edit_building_block_html_code').text($(this).data('building_block_html_code'));
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_block_form').on('submit', function(event){
    var idf = $('#edit_fid').val();
    var url = "{{ url('admin/building_blocks') }}/"+idf;
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
          // var date = moment(data.created_at).format("D MMM YYYY");
					// $('.Block' + data.id).replaceWith(" "+
					// "<tr class='Block"+data.id+"'>"+
					// "<td>" + data.building_block_name + "</td>"+
          // "<td>" + data.building_block_html_code + "</td>"+
					// "<td>" + date + "</td>"+
					// "<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-building_block_name='"+data.building_block_name+"' data-building_block_html_code='"+data.building_block_html_code+"' data-toggle='modal' data-target='#EditBlockModal' data-whatever='@mdo'>"+
					// "<i class='fas fa-edit'></i></a> "+
					// "<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-building_block_name='"+data.building_block_name+"' data-toggle='modal' data-target='#DeleteBlockModal' data-whatever='@mdo'>"+
					// "<i class='fas fa-trash'></i></a>"+
					// "</td>"+
					// "</tr>");
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

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('building_block_name'));
		$('.id').text($(this).data('id'));
	});

  $('.delete').on('click',function(event){
		event.preventDefault();
		var data = {
      '_method': 'DELETE',
			'_token' : $('input[name=_token]').val(),
			'id' : $('.id').text()
		};
    var idf = $('.id').text();
    var url = "{{ url('admin/building_blocks') }}/"+idf;

    $.ajax({
        method:'POST',
        url:url,
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Block' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteBlockModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
        }
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
