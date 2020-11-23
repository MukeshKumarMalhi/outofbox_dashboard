@extends('layouts.a_app')
@section('title','Edit Portfolio')
@section('content')

    <!-- Page Content -->
        <style>.uppy-Dashboard-inner {width:100% !important; height:320px !important;}</style>
        <link href="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.css" type="text/css" rel="stylesheet">
        <div class="container-fluid mb-4" id="portfolios">
          <div id="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
            <ul></ul>
          </div>
          <div id="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
            <ul></ul>
          </div>
          <form method="post" role="form" class="form-horizontal" id="edit_portfolio_form" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Category: </label>
                  <select class="form-control" name="category_id" id="category_id">
                    <option value="">Add category</option>
                    <?php
                      $selected_category = "";
                      foreach($categories as $key => $value){
                        if($value->id == $portfolio->category_id){
                          $selected_category = "selected";
                        }
                    ?>
                    <option value="{{ $value->id }}" <?php echo $selected_category; ?>>{{ $value->category_name }}</option>
                    <?php } ?>
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
                    <?php
                      $selected_industry = "";
                      foreach($industries as $key => $value){
                        if($value->id == $portfolio->industry_id){
                          $selected_industry = "selected";
                        }
                    ?>
                      <option value="{{ $value->id }}" <?php echo $selected_industry; ?>>{{ $value->industry_name }}</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Title: </label>
                  <input type="text" name="title" id="title" value="{{ $portfolio->title }}" class="form-control" placeholder="Enter title" autocomplete="off" autofocus>
                  <input type="hidden" id="edit_fid" value="{{ $portfolio->id }}" name="edit_fid">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Sub title: </label>
                  <input type="text" name="sub_title" id="sub_title" value="{{ $portfolio->sub_title }}" class="form-control" placeholder="Enter sub title" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Body text: </label>
                  <textarea name="body_text" class="form-control" placeholder="Enter body text" rows="8" cols="80">{{ $portfolio->body_text }}</textarea>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md">
                <div class="input-field">
                  <label class="text-pink font-weight-bold">Upload Images</label>
                  <div class="input-images-1" style="padding-top: .5rem;"></div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md">
                <div class="input-field">
                  <label class="text-pink font-weight-bold">Uploaded Images</label>
                </div>
                <div class="image-uploader">
                  <div class="uploaded">
                    <?php
                    if(isset($portfolio->images)){
                      foreach ($portfolio->images as $key => $image){
                    ?>
                        <div class="uploaded-image" id="remove_image_<?php echo $image['image_url']; ?>">
                          <img src="<?php echo asset('storage/'.$image['image_url']); ?>">
                          <button title="Delete image" class="delete-image" data-id="{{ $image['id'] }}"><i class="iui-close"></i></button>
                        </div>
                    <?php
                      }
                    }
                     ?>
                  </div>
                </div>
              </div>
            </div>
          <button type="submit" class="btn btn-dark" id="add">Update</button>
          </form>
        </div>

<!-- <script type="text/javascript" src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
<script type="text/javascript">
  var uppy = Uppy.Core()
    .use(Uppy.Dashboard, {
      inline: true,
      target: '#drag-drop-area'
    })
    .use(Uppy.Tus, {endpoint: 'https://master.tus.io/files/'}) //you can put upload URL here, where you want to upload images

  uppy.on('complete', (result) => {
    console.log('Upload complete! We’ve uploaded these files:', result.successful)
  })
</script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="dist/image-uploader.min.js"></script> -->
<script type="text/javascript" src="{{ asset('admin_asset/js/image-uploader.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.input-images-1').imageUploader();
        // let preloaded = [
        //     {id: 1, src: 'https://picsum.photos/500/500?random=1'},
        //     {id: 2, src: 'https://picsum.photos/500/500?random=2'},
        //     {id: 3, src: 'https://picsum.photos/500/500?random=3'},
        //     {id: 4, src: 'https://picsum.photos/500/500?random=4'},
        //     {id: 5, src: 'https://picsum.photos/500/500?random=5'},
        //     {id: 6, src: 'https://picsum.photos/500/500?random=6'},
        // ];
        // $('.input-images-2').imageUploader({
        //     preloaded: preloaded,
        //     imagesInputName: 'photos',
        //     preloadedInputName: 'old'
        // });
        $('.delete-image').on('click',function(event){
          var r = confirm("Are you sure want to delete this image?");
          if (r == true) {
            event.preventDefault();
        		var data = {
        			'_token' : $('input[name=_token]').val(),
        			'id' : $(this).data('id')
        		};
            var id = $(this).data('id');
            $.ajax({
                type:'POST',
                url:"{{ url('admin/delete_portfolio_image') }}",
        				data:data,
        				dataType:"json",
                success:function(data){
                  $('#remove_image_'+id).hide();
                  alert(data);
                }
            });
          } else {
            return false;
          }
        });

  $('#edit_portfolio_form').on('submit', function(event){
		event.preventDefault();
    var idf = $('#edit_fid').val();
    $.ajax({
      url:"{{ url('admin/portfolios') }}/"+idf,
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
					$('#append_success ul').append("<li>Portfolio Updated Successfully.</li>");
          var url = "{{ url('admin/view_portfolios') }}";
          window.location = url;
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
</style>
@endsection
