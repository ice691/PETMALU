<?php $__env->startPush('modals'); ?>
<div class="modal fade no-reset" id="profile-peek" tabindex="-1" role="dialog" aria-labelledby="profile-peek-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profile-peek-modal-label"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="profile-form">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" data-column="name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" data-column="email">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Gender</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" data-column="gender">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" data-column="address">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Contact Number</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" data-column="mobile_number" value="-">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $(this).on('click', '.peeks-profile', function () {
      var data = $(this).data('profile')
      $('#profile-peek #profile-form input.form-control-plaintext').val(function () {
        return data[$(this).data('column')]
      })
      $('#profile-peek .modal-title').text([data['name'], '\'s Profile'].join(''))
      $('#profile-peek').modal('show')
    })
  });
</script>
<?php $__env->stopPush(); ?>
