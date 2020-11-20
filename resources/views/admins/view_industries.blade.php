@extends('layouts.a_app')
@section('title','Industries')
@section('content')

    <!-- Page Content -->
    <!-- add Industry modal -->
      <div class="modal fade" id="IndustryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Industry</h5>
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
            <form method="post" role="form" class="form-horizontal" id="industry_form">
              @csrf
              <div class="row mb-4">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Industry Name: </label>
                    <input type="text" name="industry_name" id="industry_name"  class="form-control" placeholder="e.g. Restaurant, School or Hospital" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Attach Icon: </label>
                    <input type="file" name="industry_icon" id="industry_icon" class="form-control image">
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
    <!-- add Industry modal -->
    <!-- edit Industry modal -->
      <div class="modal fade" id="EditIndustryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Industry</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_industry_form" enctype="multipart/form-data">
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
                      <label class="text-pink font-weight-bold" for="edit_industry_name">Industry Name: </label>
                      <input type="text" id="edit_industry_name" name="edit_industry_name"  class="form-control" placeholder="e.g. Restaurant, School or Hospital" autocomplete="off" autofocus required>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="edit_industry_icon" class="text-pink font-weight-bold">Attach Icon: </label>
                      <input type="file" id="edit_industry_icon" name="edit_industry_icon" class="form-control image">
                    </div>
                  </div>
                  <div class="col-md-3" id="show_image"></div>
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
      <!-- edit Industry modal end -->
      <!-- delete Industry modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteIndustryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <!-- edit Industry modal end -->

        <div class="container-fluid" id="industries">
          <div class="text-right">
            <a class="btn bg-dark text-light my-2" data-toggle="modal" data-target="#IndustryModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Industry</a>
          </div>
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table" id="userTable">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Industry Name</th>
                          <th>Industry Icon</th>
                          <th>Created at</th>
                          <th class="text-center" style="width:120px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        {{ csrf_field() }}
                       <?php if(isset($industries) && count($industries) > 0){ ?>
                         @foreach($industries as $industry)
                           <tr class="Industry{{$industry->id}}">
                             <td>{{ $industry->id }}</td>
                             <td>{{ $industry->industry_name }}</td>
                             <td>
                               <div class="bs-photo bg-center-url" style="background-image: url('<?php echo asset('storage/'.$industry->industry_icon); ?>');">
                                 <img src="<?php echo asset('storage/'.$industry->industry_icon); ?>" width="50px" height="50px"/></td>
                               </div>
                             <td><?php echo date('d M Y',strtotime($industry->created_at)); ?></td>
                             <td>
                               <a href="#" class="edit_modal btn btn-outline-danger mb-2" data-id="{{ $industry->id }}" data-industry_name="{{ $industry->industry_name }}" data-industry_icon="{{ $industry->industry_icon }}" data-toggle="modal" data-target="#EditIndustryModal" data-whatever="@mdo"><i class="fas fa-edit"></i></a>
                               <a href="#" class="delete_modal btn btn-outline-danger mb-2" data-id="{{ $industry->id }}" data-industry_name="{{ $industry->industry_name }}" data-industry_icon="{{ $industry->industry_icon }}" data-toggle="modal" data-target="#DeleteIndustryModal" data-whatever="@mdo"><i class='fas fa-trash'></i></a>
                             </td>
                           </tr>
                         @endforeach
                      <?php }else { ?>
                        <tr>
                          <th id="yet">
                            <h2>Industries are not added yet</h2>
                          </th>
                        </tr>
                      <?php } ?>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-industries justify-content-center">
               {{ $industries->links() }}
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



    $('#IndustryModal').on('shown.bs.modal', function () {
      $('#industry_name').focus();
    });

  $('#industry_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ route('industries.store') }}",
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
					$('tbody').prepend("<tr class='Industry"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.industry_name + "</td>"+
					"<td>" + '<img src={{ asset("/storage") }}/'+data.industry_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-industry_name='"+data.industry_name+"' data-industry_icon='"+data.industry_icon+"' data-toggle='modal' data-target='#EditIndustryModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-industry_name='"+data.industry_name+"' data-industry_icon='"+data.industry_icon+"' data-toggle='modal' data-target='#DeleteIndustryModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Industry Created Successfully.</li>");
          $('#IndustryModal').find('#industry_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#IndustryModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);

	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_industry_name').val($(this).data('industry_name'));
    $('#show_image').html('<img src={{ asset("storage") }}/'+$(this).data('industry_icon')+' width="155px" height="150px">');
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_industry_form').on('submit', function(event){
    var idf = $('#edit_fid').val();
    var url = "{{ url('industries') }}/"+idf;
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
					$('.Industry' + data.id).replaceWith(" "+
					"<tr class='Industry"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.industry_name + "</td>"+
					"<td>" + '<img src={{ asset("/storage") }}/'+data.industry_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger  mb-2' data-id='"+data.id+"' data-industry_name='"+data.industry_name+"' data-industry_icon='"+data.industry_icon+"' data-toggle='modal' data-target='#EditIndustryModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger  mb-2' data-id='"+data.id+"' data-industry_name='"+data.industry_name+"' data-industry_icon='"+data.industry_icon+"' data-toggle='modal' data-target='#DeleteIndustryModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Industry Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditIndustryModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('industry_name'));
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
    var url = "{{ url('industries') }}/"+idf;

    $.ajax({
        method:'POST',
        url:url,
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Industry' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteIndustryModal').modal('hide'); },2000);
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
