@extends('layouts.a_app')
@section('title','Websites')
@section('content')

    <!-- Page Content -->
    <!-- add Website modal -->
      <div class="modal fade" id="WebsiteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Website</h5>
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
            <form method="post" role="form" class="form-horizontal" id="website_form">
              @csrf
              <div class="row mb-4">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Website Name: </label>
                    <input type="text" name="website_name" id="website_name"  class="form-control" placeholder="Enter name" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Website Slug: </label>
                    <input type="text" name="website_slug" id="website_slug"  class="form-control" placeholder="Enter slug" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Website URL: </label>
                    <input type="text" name="website_url" id="website_url"  class="form-control" placeholder="Enter URL" autocomplete="off" required>
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
    <!-- add Website modal -->
    <!-- edit Website modal -->
      <div class="modal fade" id="EditWebsiteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Website</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_website_form" enctype="multipart/form-data">
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
                      <label for="edit_website_name" class="text-pink font-weight-bold">Website Name: </label>
                      <input type="text" id="edit_website_name" name="edit_website_name" class="form-control" placeholder="Enter name" autocomplete="off" autofocus required>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="edit_website_slug" class="text-pink font-weight-bold">Website Slug: </label>
                      <input type="text" id="edit_website_slug" name="edit_website_slug" class="form-control" placeholder="Enter slug" autocomplete="off" autofocus required>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="edit_website_url" class="text-pink font-weight-bold">Website URL: </label>
                      <input type="text" id="edit_website_url" name="edit_website_url" class="form-control" placeholder="Enter URL" autocomplete="off" autofocus required>
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
      <!-- edit Website modal end -->
      <!-- delete Website modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteWebsiteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <!-- edit Website modal end -->

        <div class="container-fluid" id="websites">
          <div class="text-right">
            <a class="btn bg-dark text-light my-2" data-toggle="modal" data-target="#WebsiteModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Website</a>
          </div>
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table" id="userTable">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>URL</th>
                          <th>Created at</th>
                          <th class="text-center" style="width:120px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        {{ csrf_field() }}
                       <?php if(isset($websites) && count($websites) > 0){ ?>
                         @foreach($websites as $website)
                           <tr class="Website{{$website->id}}">
                             <td>{{ $website->id }}</td>
                             <td>{{ $website->website_name }}</td>
                             <td>{{ $website->website_slug }}</td>
                             <td>{{ $website->website_url }}</td>
                             <td><?php echo date('d M Y',strtotime($website->created_at)); ?></td>
                             <td>
                               <a href="#" class="edit_modal btn btn-outline-danger mb-2" data-id="{{ $website->id }}" data-website_name="{{ $website->website_name }}" data-website_slug="{{ $website->website_slug }}" data-website_url="{{ $website->website_url }}" data-toggle="modal" data-target="#EditWebsiteModal" data-whatever="@mdo"><i class="fas fa-edit"></i></a>
                               <a href="#" class="delete_modal btn btn-outline-danger mb-2" data-id="{{ $website->id }}" data-website_name="{{ $website->website_name }}" data-toggle="modal" data-target="#DeleteWebsiteModal" data-whatever="@mdo"><i class='fas fa-trash'></i></a>
                             </td>
                           </tr>
                         @endforeach
                      <?php }else { ?>
                        <tr>
                          <th id="yet">
                            <h2>Websites are not added yet</h2>
                          </th>
                        </tr>
                      <?php } ?>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-websites justify-content-center">
               {{ $websites->links() }}
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



    $('#WebsiteModal').on('shown.bs.modal', function () {
      $('#website_name').focus();
    });

  $('#website_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ route('websites.store') }}",
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
					$('tbody').prepend("<tr class='Website"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.website_name + "</td>"+
					"<td>" + data.website_slug + "</td>"+
					"<td>" + data.website_url + "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-website_name='"+data.website_name+"' data-website_slug='"+data.website_slug+"' data-website_url='"+data.website_url+"' data-toggle='modal' data-target='#EditWebsiteModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-website_name='"+data.website_name+"' data-toggle='modal' data-target='#DeleteWebsiteModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Website Created Successfully.</li>");
          $('#WebsiteModal').find('#website_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#WebsiteModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);

	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_website_name').val($(this).data('website_name'));
		$('#edit_website_slug').val($(this).data('website_slug'));
		$('#edit_website_url').val($(this).data('website_url'));
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_website_form').on('submit', function(event){
    var idf = $('#edit_fid').val();
    var url = "{{ url('websites') }}/"+idf;
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
					$('.Website' + data.id).replaceWith(" "+
					"<tr class='Website"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.website_name + "</td>"+
          "<td>" + data.website_slug + "</td>"+
					"<td>" + data.website_url + "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger  mb-2' data-id='"+data.id+"' data-website_name='"+data.website_name+"' data-website_slug='"+data.website_slug+"' data-website_url='"+data.website_url+"' data-toggle='modal' data-target='#EditWebsiteModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger  mb-2' data-id='"+data.id+"' data-website_name='"+data.website_name+"' data-toggle='modal' data-target='#DeleteWebsiteModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Website Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditWebsiteModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('website_name'));
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
    var url = "{{ url('websites') }}/"+idf;

    $.ajax({
        method:'POST',
        url:url,
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Website' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteWebsiteModal').modal('hide'); },2000);
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
