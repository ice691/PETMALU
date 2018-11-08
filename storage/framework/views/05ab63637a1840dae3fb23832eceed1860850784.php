<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="login-modal-label">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo Form::open(['url' => url('login'), 'method' => 'POST', 'class' => 'ajax']); ?>

        <div class="modal-body">
          <?php echo Form::inputGroup('email', 'Email Address', 'email'); ?>

          <?php echo Form::passwordGroup('Password', 'password'); ?>

          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        <?php echo Form::close(); ?>

      </div>

    </div>
  </div>
