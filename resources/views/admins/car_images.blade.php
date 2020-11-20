@extends('layouts.a_app')
@section('title','Car Images')

@section('content')
  <div class="container-fluid py-3" id="businesses">
    <form method="POST" name="form-example-1" id="form-example-1" enctype="multipart/form-data">
      <input type="hidden" name="car_id" value="{{ $id }}">
      <div class="input-field">
        <label class="active">Upload Images</label>
        <div class="input-images-1" style="padding-top: .5rem;"></div>
      </div>
      <div class="clearfix">
        <button class="btn btn-dark btn-lg float-right mt-2">Submit</button>
      </div>
    </form>

    <div class="modal" id="show-submit-data" style="visibility: hidden;">
      <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
        <div class="modal-content">
          <img src="https://www.professionalservicesllc.com/clients/stoneledge/images/loaders/uploading.gif" class="img-fluid">
          <div id="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
            <ul></ul>
          </div>
          <div id="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
            <ul></ul>
          </div>
        </div>
      </div>
    </div>

    <!-- <div id="show-submit-data" class="modal" style="visibility: hidden;">
        <div class="content">
          <img src="https://www.professionalservicesllc.com/clients/stoneledge/images/loaders/uploading.gif" class="img-fluid" >
          <div class="append_success">
            Succssfully
          </div>
          <div style="display:none;">
            <h4>Submitted data:</h4>
            <p><strong>Uploaded images:</strong></p>
            <ul id="display-new-images"></ul>
            <p><strong>Preloaded images:</strong></p>
            <ul id="display-preloaded-images"></ul>
            <a href="javascript:$('#show-submit-data').css('visibility', 'hidden')" class="close">x</a>
          </div>
        </div>
    </div> -->
  </div>
  <br>
  <div class="container-fluid py-3" id="businesses">
    <div class="row">
      <div class="col-sm-12">
        <div class="input-field">
          <label class="active">Image Gallery</label>
        </div>
        <div class="image-uploader">
          <div class="uploaded">
            <?php foreach ($images as $key => $image): ?>
              <div class="uploaded-image" id="remove_image_<?php echo $image->id; ?>">
                <img src="<?php echo asset('storage/'.$image->image_url); ?>">
                <button title="Delete image" class="delete-image" data-id="{{ $image->id }}"><i class="iui-close"></i></button>
                <!-- <a href="#" class="delete-image" data-id="{{ $image->id }}" data-toggle="modal" data-target="#DeleteImageModal" data-whatever="@mdo"><i class="iui-close"></i></a> -->
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- delete Image modal -->
<!-- <div class="modal fade" id="DeleteImageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-body">
        <div id="delete_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
          <ul></ul>
        </div>
        <div class="deletecontent">
          <span class="title" style="font-size: 18px; font-weight: 500;">Are you sure want to delete this image?</span>?
          <span class="id" style="display: none;"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="delete btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- delete image modal end -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="dist/image-uploader.min.js"></script> -->
<script type="text/javascript" src="{{ asset('admin_asset/js/image-uploader.min.js') }}"></script>

<script>
    $(function () {

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
                url:"{{ url('admin/delete_car_image') }}",
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

        $('form').on('submit', function (event) {

            event.preventDefault();
            event.stopPropagation();

            $.ajax({
              url:"{{ url('admin/store_car_images') }}",
              method:"POST",
              data:new FormData(this),
              dataType:"JSON",
              contentType:false,
              cache:false,
              processData:false,
              success:function(data){
                $('.append_errors ul').text('');
                $('.append_success ul').text('');
                if(data.errors)
                {
                  $.each(data.errors, function(i, error){
                    $('.append_errors').show();
                    $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
                  });
                }else {
                  $('.img-fluid').hide();
                  $('#show-submit-data').hide();
                  alert('Images uploaded successfully');
                  location.reload();
                }
              },
            });

            // Get some vars
            let $form = $(this),
                $modal = $('.modal');

            // Set name and description
            $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]')
            }

            // Get the new files names
            let $fileNames = $('<ul>');
            for (let file of $inputImages.prop('files')) {
                $('<li>', {text: file.name}).appendTo($fileNames);
            }

            // Set the new files names
            $modal.find('#display-new-images').html($fileNames.html());

            // Get the preloaded inputs
            let $inputPreloaded = $form.find('input[name^="old"]');
            if ($inputPreloaded.length) {
                // Get the ids
                let $preloadedIds = $('<ul>');
                for (let iP of $inputPreloaded) {
                    $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
                }

                // Show the preloadede info and set the list of ids
                $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            } else {

                // Hide the preloaded info
                $modal.find('#display-preloaded-images').hide();

            }

            // Show the modal
            $modal.css('visibility', 'visible');
        });

        // Input and label handler
        $('input').on('focus', function () {
            $(this).parent().find('label').addClass('active')
        }).on('blur', function () {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });

        // Sticky menu
        let $nav = $('nav'),
            $header = $('header'),
            offset = 4 * parseFloat($('body').css('font-size')),
            scrollTop = $(this).scrollTop();

        // Initial verification
        setNav();

        // Bind scroll
        $(window).on('scroll', function () {
            scrollTop = $(this).scrollTop();
            // Update nav
            setNav();
        });

        function setNav() {
            if (scrollTop > $header.outerHeight()) {
                $nav.css({position: 'fixed', 'top': offset});
            } else {
                $nav.css({position: '', 'top': ''});
            }
        }
    });
</script>
<style media="screen">
form > button {
    -webkit-appearance: none;
    cursor: pointer;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    padding: 1rem 2rem;
    border-radius: 5px;
    border: none;
    background-color: #50ce7d;
    color: #fff;
    text-transform: uppercase;
    display: block;
    margin: 2rem 0 2rem auto;
    font-size: 1em;
}

ul {
    margin-left: 2rem;
}

input {
    background-color: transparent;
    border: none;
    border-radius: 0;
    outline: none;
    width: 100%;
    line-height: normal;
    font-size: 1em;
    padding: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    margin: 0;
    color: rgba(0, 0, 0, 0.72);
    background-position: center bottom, center calc(100% - 1px);
    background-repeat: no-repeat;
    background-size: 0 2px, 100% 1px;
    -webkit-transition: background 0s ease-out 0s;
    -o-transition: background 0s ease-out 0s;
    transition: background 0s ease-out 0s;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#2196f3), to(#2196f3)), -webkit-gradient(linear, left top, left bottom, from(#d9d9d9), to(#d9d9d9));
    background-image: -webkit-linear-gradient(#2196f3, #2196f3), -webkit-linear-gradient(#d9d9d9, #d9d9d9);
    background-image: -o-linear-gradient(#2196f3, #2196f3), -o-linear-gradient(#d9d9d9, #d9d9d9);
    background-image: linear-gradient(#2196f3, #2196f3), linear-gradient(#d9d9d9, #d9d9d9);
    height: 2.4em;
}

input:focus {
    background-size: 100% 2px, 100% 1px;
    outline: 0 none;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    border-bottom: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.input-field label {
    width: 100%;
    color: #9e9e9e;
    position: absolute;
    top: auto;
    left: 0;
    bottom: 15px;
    height: 100%;
    font-size: 2em;
    cursor: text;
    -webkit-transition: -webkit-transform .2s ease-out;
    transition: -webkit-transform .2s ease-out;
    -webkit-transform-origin: 0 100%;
    transform-origin: 0 100%;
    text-align: initial;
    -webkit-transform: translateY(7px);
    transform: translateY(7px);
    pointer-events: none;
}

input:focus + label {
    color: #2196f3;
}

.input-field {
    position: relative;
    margin-top: 2.2rem;
}

.input-field label.active {
    -webkit-transform: translateY(-15px) scale(0.8);
    transform: translateY(-15px) scale(0.8);
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
}

.container {
    width: 60%;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
}

.step {
    font-size: 1.6em;
    font-weight: 600;
    margin-right: .5rem;
}

.option {
    margin-top: 2rem;
    border-bottom: 1px solid #d9d9d9;
}

.modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, .5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal .content {
    background: #fff;
    display: inline-block;
    padding: 2rem;
    position: relative;
}

.modal .content h4 {
    margin-top: 0;
}

.modal .content a.close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: inherit;
    font-size: 1.4rem;
    line-height: 1;
    font-family: 'Montserrat', sans-serif;
}

::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: #888;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

@media screen and (max-width: 1366px) {
    body {
        font-size: 15px;
    }

    nav ul li a {
        font-size: 1.1em;

    }
}

@media screen and (max-width: 992px) {
    main {
        margin: 2rem 0;
    }

    nav {
        margin-left: -10em;
    }
}

@media screen and (max-width: 786px) {
    body {
        font-size: 14px;
    }

    nav {
        display: none;
    }

    .container {
        width: 80%;
    }
}

@media screen and (max-width: 450px) {
    .container {
        width: 90%;
    }
}
</style>
@endsection
