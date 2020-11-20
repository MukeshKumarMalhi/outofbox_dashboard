@extends('layouts.a_app')
@section('title','Reviews')

@section('content')
<!-- Page Content -->
  <div class="container-fluid" id="reviews">
    <!-- table-->
    <div class="table-responsive border-bottom rounded mb-3">
        <table class="table bs-table">
            <thead>
                <tr>
                    <th>Rating</th>
                    <th>Title</th>
                    <th>Review</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  {{ csrf_field() }}
                 <?php if(isset($reviews) && count($reviews) > 0){ ?>
                   @foreach($reviews as $review)
                     <tr class="Review{{$review->id}}">
                       <td>
                         <div class="star-rating text-danger" title="100%" style="display: inline-block;margin:0px;padding:0px">
                           <div class="back-stars">
                             <?php
                               $empty = 5 - $review->rating_number;
                               for ($i=0; $i < $review->rating_number; $i++) { ?>
                               <i class="fas fa-star" aria-hidden="true"></i>
                             <?php
                               }
                               for ($j=0; $j < $empty; $j++) { ?>
                               <i class="far fa-star" aria-hidden="true"></i>
                             <?php
                               }
                             ?>
                           </div>
                         </div>
                       </td>
                       <td>{{ $review->rating_title }}</td>
                       <td>{{ $review->rating_desc }}</td>
                       <td>{{ $review->full_name }}</td>
                       <td>{{ $review->email }}</td>
                       <td><?php echo date('d M Y',strtotime($review->created_at)); ?></td>
                     </tr>
                   @endforeach
                <?php }else { ?>
                  <tr>
                    <th id="yet">
                      <h2>Reviews are not added yet</h2>
                    </th>
                  </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="margin-top: 10px;margin-left: 440px;">
       <ul class="pagination-for-reviews justify-content-center">
         {{ $reviews->links() }}
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
