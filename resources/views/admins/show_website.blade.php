@extends('layouts.a_app')
@section('title',"Pages")
@section('content')

    <!-- Page Content -->
    <!-- add Page modal -->
      <div class="modal fade" id="PageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Page</h5>
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
            <form method="post" role="form" class="form-horizontal" id="page_form">
              @csrf
              <div class="row mb-4">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Page Name: </label>
                    <input type="text" name="page_name" id="page_name" class="form-control" placeholder="Enter name" autocomplete="off" required>
                    <input type="hidden" name="website_id" value="{{ $website->id }}">
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Parent Page: </label>
                    <select class="form-control" name="parent_page_id">
                      <option value="">Select Parent Page</option>
                      <?php foreach ($pages as $key => $value): ?>
                        <option value="{{ $value->id }}">{{ $value->page_name }}</option>
                      <?php endforeach; ?>
                    </select>
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
    <!-- add Page modal -->
    <!-- edit Page modal -->
      <div class="modal fade" id="EditPageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_page_form" enctype="multipart/form-data">
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
                      <label for="edit_page_name" class="text-pink font-weight-bold">Page Name: </label>
                      <input type="text" id="edit_page_name" name="edit_page_name" class="form-control" placeholder="Enter name" autocomplete="off" autofocus required>
                      <input type="hidden" name="website_id" value="{{ $website->id }}">
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="edit_parent_page_id" class="text-pink font-weight-bold">Parent Page: </label>
                      <select class="form-control" name="edit_parent_page_id">
                        <option value="">Select Parent Page</option>
                        <?php foreach ($pages as $key => $value): ?>
                          <option value="{{ $value->id }}">{{ $value->page_name }}</option>
                        <?php endforeach; ?>
                      </select>
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
      <!-- edit Page modal end -->
      <!-- delete Page modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeletePageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <!-- edit Page modal end -->

        <div class="container-fluid" id="pages">
          <div class="row">
            <div class="col-md-6 text-left">
              <h3><a href="{{ url('admin/view_websites') }}">{{ $website->website_name }}</a> > pages</h3>
            </div>
            <div class="col-md-6 text-right">
              <a class="btn bg-dark text-light my-2" data-toggle="modal" data-target="#PageModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Page</a>
            </div>
          </div>
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table" id="userTable">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Parent Page</th>
                          <th>Created at</th>
                          <th class="text-center" style="width:120px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        {{ csrf_field() }}
                       <?php if(isset($pages) && count($pages) > 0){ ?>
                         @foreach($pages as $page)
                           <tr class="Page{{$page->id}}">
                             <td><a style="color: blue; text-decoration: underline;" href="{{ route('admin.pages.show', $page->id) }}">{{ $page->page_name }}</a></td>
                             <td>{{ $page->parent_page_name }}</td>
                             <td><?php echo date('d M Y',strtotime($page->created_at)); ?></td>
                             <td>
                               <a href="#" class="edit_modal btn btn-outline-danger mb-2" data-id="{{ $page->id }}" data-page_name="{{ $page->page_name }}" data-parent_page_id="{{ $page->parent_page_id }}" data-toggle="modal" data-target="#EditPageModal" data-whatever="@mdo"><i class="fas fa-edit"></i></a>
                               <a href="#" class="delete_modal btn btn-outline-danger mb-2" data-id="{{ $page->id }}" data-page_name="{{ $page->page_name }}" data-toggle="modal" data-target="#DeletePageModal" data-whatever="@mdo"><i class='fas fa-trash'></i></a>
                             </td>
                           </tr>
                         @endforeach
                      <?php }else { ?>
                        <tr>
                          <th id="yet">
                            <h2>Pages are not added yet</h2>
                          </th>
                        </tr>
                      <?php } ?>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-pages justify-content-center">
               {{ $pages->links() }}
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



    $('#PageModal').on('shown.bs.modal', function () {
      $('#page_name').focus();
    });

  $('#page_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ route('admin.pages.store') }}",
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
          var date = moment(data.created_at).format("D MMM YYYY");
					$('tbody').prepend("<tr class='Page"+data.id+"'>"+
					"<td>" + data.page_name + "</td>"+
					"<td>" + data.parent_page_name + "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-page_name='"+data.page_name+"' data-parent_page_id='"+data.parent_page_id+"' data-toggle='modal' data-target='#EditPageModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-page_name='"+data.page_name+"' data-toggle='modal' data-target='#DeletePageModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Page Created Successfully.</li>");
          $('#PageModal').find('#page_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#PageModal').modal('hide'); },2000);
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
		$('#edit_page_name').val($(this).data('page_name'));
    $("#edit_parent_page_id option[value='"+$(this).data('parent_page_id')+"']").prop('selected', true);
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_page_form').on('submit', function(event){
    var idf = $('#edit_fid').val();
    var url = "{{ url('admin/pages') }}/"+idf;
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
					$('.Page' + data.id).replaceWith(" "+
					"<tr class='Page"+data.id+"'>"+
					"<td>" + data.page_name + "</td>"+
          "<td>" + data.parent_page_name + "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-page_name='"+data.page_name+"' data-parent_page_id='"+data.parent_page_id+"' data-toggle='modal' data-target='#EditPageModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-page_name='"+data.page_name+"' data-toggle='modal' data-target='#DeletePageModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Page Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditPageModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('page_name'));
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
    var url = "{{ url('admin/pages') }}/"+idf;

    $.ajax({
        method:'POST',
        url:url,
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Page' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeletePageModal').modal('hide'); },2000);
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
.container-fluid h3{
  text-transform: capitalize;
}
</style>
@endsection
