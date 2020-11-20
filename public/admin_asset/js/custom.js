$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  $(".menu-press").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("opened");
  });

  $(document).on('click', '.pagination-for-categories a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#categories').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-cars a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#cars').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-contacts a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#contacts').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-finances a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#finances').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-enquiries a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#enquiries').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-reviews a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#reviews').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-sell-your-vehicles a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#sell_your_vehicles').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-part-exchanges a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#part_exchanges').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-car-part-exchanges-enquiries a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#car_part_exchange_enquiries').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });
});
