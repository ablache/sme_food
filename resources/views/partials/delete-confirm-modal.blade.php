<div class="modal fade bs-example-modal-lg" id="confirmModalPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-left" id="myModalLabel">Confirm Delete</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the selected item</p>
        {!! Form::open(['id' => 'confirm-form']) !!}
        {!! Form::hidden('confirmed', 'confirmed') !!}
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delete-post">Delete</button>
      </div>
    </div>
  </div>
</div>