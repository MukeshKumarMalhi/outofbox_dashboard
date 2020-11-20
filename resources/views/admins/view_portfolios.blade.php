@extends('layouts.a_app')
@section('title','Portfolios')
@section('content')

    <!-- Page Content -->
    <!-- add Portfolio modal -->
      <div class="modal fade" id="PortfolioModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Portfolio</h5>
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
            <form method="post" role="form" class="form-horizontal" id="portfolio_form" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Category: </label>
                    <select class="form-control" name="category_id" id="category_id">
                      <option value="">Add category</option>
                      <?php foreach ($categories as $key => $value): ?>
                        <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Industry: </label>
                    <select class="form-control" name="industry_id" id="industry_id">
                      <option value="">Add industry</option>
                      <?php foreach ($industries as $key => $indsutry): ?>
                        <option value="{{ $indsutry->id }}">{{ $indsutry->industry_name }}</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Title: </label>
                    <input type="text" name="title" id="title"  class="form-control" placeholder="Enter title" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Sub title: </label>
                    <input type="text" name="sub_title" id="sub_title"  class="form-control" placeholder="Enter sub title" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Body text: </label>
                    <textarea name="body_text" class="form-control" placeholder="Enter body text" rows="8" cols="80"></textarea>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md">
                  <div class="form-group">
                    <label class="text-pink font-weight-bold">Upload Images</label>
                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
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
    <!-- add Portfolio modal -->
    <!-- edit Portfolio modal -->
      <div class="modal fade" id="EditPortfolioModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog modal-lg" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Portfolio</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_portfolio_form" enctype="multipart/form-data">
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
                      <label for="edit_portfolio_name" class="text-pink font-weight-bold">Portfolio Name: </label>
                      <input type="text" id="edit_portfolio_name" name="edit_portfolio_name"  class="form-control" placeholder="e.g. Web Development, Graphics Design" autocomplete="off" autofocus required>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="edit_portfolio_icon" class="text-pink font-weight-bold">Attach Icon: </label>
                      <input type="file" id="edit_portfolio_icon" name="edit_portfolio_icon" class="form-control image">
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
      <!-- edit Portfolio modal end -->
      <!-- delete Portfolio modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeletePortfolioModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <!-- edit Portfolio modal end -->

        <div class="container-fluid" id="portfolios">
          <div class="text-right">
            <a class="btn bg-dark text-light my-2" data-toggle="modal" data-target="#PortfolioModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Portfolio</a>
          </div>
          <!-- table-->
          <div class="table-responsive border-bottom rounded mb-3">
              <table class="table bs-table" id="userTable">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Portfolio Name</th>
                          <th>Portfolio Icon</th>
                          <th>Created at</th>
                          <th class="text-center" style="width:120px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        {{ csrf_field() }}
                       <?php if(isset($portfolios) && count($portfolios) > 0){ ?>
                         @foreach($portfolios as $portfolio)
                           <tr class="Portfolio{{$portfolio->id}}">
                             <td>{{ $portfolio->id }}</td>
                             <td>{{ $portfolio->portfolio_name }}</td>
                             <td>
                               <div class="bs-photo bg-center-url" style="background-image: url('<?php echo asset('storage/'.$portfolio->portfolio_icon); ?>');">
                                 <img src="<?php echo asset('storage/'.$portfolio->portfolio_icon); ?>" width="50px" height="50px"/></td>
                               </div>
                             <td><?php echo date('d M Y',strtotime($portfolio->created_at)); ?></td>
                             <td>
                               <a href="#" class="edit_modal btn btn-outline-danger mb-2" data-id="{{ $portfolio->id }}" data-portfolio_name="{{ $portfolio->portfolio_name }}" data-portfolio_icon="{{ $portfolio->portfolio_icon }}" data-toggle="modal" data-target="#EditPortfolioModal" data-whatever="@mdo"><i class="fas fa-edit"></i></a>
                               <a href="#" class="delete_modal btn btn-outline-danger mb-2" data-id="{{ $portfolio->id }}" data-portfolio_name="{{ $portfolio->portfolio_name }}" data-portfolio_icon="{{ $portfolio->portfolio_icon }}" data-toggle="modal" data-target="#DeletePortfolioModal" data-whatever="@mdo"><i class='fas fa-trash'></i></a>
                             </td>
                           </tr>
                         @endforeach
                      <?php }else { ?>
                        <tr>
                          <th id="yet">
                            <h2>Portfolios are not added yet</h2>
                          </th>
                        </tr>
                      <?php } ?>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-portfolios justify-content-center">
               {{ $portfolios->links() }}
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



    $('#PortfolioModal').on('shown.bs.modal', function () {
      $('#portfolio_name').focus();
    });

  $('#portfolio_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ route('portfolios.store') }}",
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
					// $('tbody').prepend("<tr class='Portfolio"+data.id+"'>"+
					// "<td>" + data.id + "</td>"+
					// "<td>" + data.portfolio_name + "</td>"+
					// "<td>" + '<img src={{ asset("/storage") }}/'+data.portfolio_icon+' width="50px" height="50px">'+ "</td>"+
					// "<td>" + date + "</td>"+
					// "<td><a href='#' class='edit_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-portfolio_name='"+data.portfolio_name+"' data-portfolio_icon='"+data.portfolio_icon+"' data-toggle='modal' data-target='#EditPortfolioModal' data-whatever='@mdo'>"+
					// "<i class='fas fa-edit'></i></a> "+
					// "<a href='#' class='delete_modal btn btn-outline-danger mb-2' data-id='"+data.id+"' data-portfolio_name='"+data.portfolio_name+"' data-portfolio_icon='"+data.portfolio_icon+"' data-toggle='modal' data-target='#DeletePortfolioModal' data-whatever='@mdo'>"+
					// "<i class='fas fa-trash'></i></a>"+
					// "</td>"+
					// "</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Portfolio Created Successfully.</li>");
          $('#PortfolioModal').find('#portfolio_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#PortfolioModal').modal('hide'); },2000);
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
		$('#edit_portfolio_name').val($(this).data('portfolio_name'));
    $('#show_image').html('<img src={{ asset("storage") }}/'+$(this).data('portfolio_icon')+' width="155px" height="150px">');
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_portfolio_form').on('submit', function(event){
    var idf = $('#edit_fid').val();
    var url = "{{ url('portfolios') }}/"+idf;
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
					$('.Portfolio' + data.id).replaceWith(" "+
					"<tr class='Portfolio"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.portfolio_name + "</td>"+
					"<td>" + '<img src={{ asset("/storage") }}/'+data.portfolio_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td><a href='#' class='edit_modal btn btn-outline-danger  mb-2' data-id='"+data.id+"' data-portfolio_name='"+data.portfolio_name+"' data-portfolio_icon='"+data.portfolio_icon+"' data-toggle='modal' data-target='#EditPortfolioModal' data-whatever='@mdo'>"+
					"<i class='fas fa-edit'></i></a> "+
					"<a href='#' class='delete_modal btn btn-outline-danger  mb-2' data-id='"+data.id+"' data-portfolio_name='"+data.portfolio_name+"' data-portfolio_icon='"+data.portfolio_icon+"' data-toggle='modal' data-target='#DeletePortfolioModal' data-whatever='@mdo'>"+
					"<i class='fas fa-trash'></i></a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Portfolio Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditPortfolioModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('portfolio_name'));
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
    var url = "{{ url('portfolios') }}/"+idf;

    $.ajax({
        method:'POST',
        url:url,
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Portfolio' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeletePortfolioModal').modal('hide'); },2000);
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
