<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Reviews</h4>
        </div>
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th><span>Rating</span></th>
                    <th><span>Title</span></th>
                    <th><span>Review</span></th>
                    <th><span>Name</span></th>
                    <th><span>Email</span></th>
                    <th><span>Date</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  {{ csrf_field() }}
                 <?php if(isset($reviews) && count($reviews) > 0){ ?>
                   @foreach($reviews as $review)
                     <tr class="Review{{$review->id}}">
                       <td>{{ $review->rating_number }}</td>
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
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-reviews justify-content-center">
     {{ $reviews->links() }}
   </ul>
</div>
