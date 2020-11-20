<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Industries</h4>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#IndustryModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Industry</a>
        </div>
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed" id="userTable">
            <thead>
                <tr>
                    <th><span>ID</span></th>
                    <th><span>Industry Name</span></th>
                    <th><span>Industry Icon</span></th>
                    <th><span>Created at</span></th>
                    <th class="text-center" style="width:110px">Action</th>
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
                       <td><img src="<?php echo asset('storage/'.$industry->industry_icon); ?>" width="50px" height="50px"/></td>
                       <td><?php echo date('d M Y',strtotime($industry->created_at)); ?></td>
                       <td class="px-2 text-nowrap">
                         <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $industry->id }}" data-industry_name="{{ $industry->industry_name }}" data-industry_icon="{{ $industry->industry_icon }}" data-toggle="modal" data-target="#EditIndustryModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a>
                         <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $industry->id }}" data-industry_name="{{ $industry->industry_name }}" data-industry_icon="{{ $industry->industry_icon }}" data-toggle="modal" data-target="#DeleteIndustryModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
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
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-industries justify-content-center">
     {{ $industries->links() }}
   </ul>
</div>
