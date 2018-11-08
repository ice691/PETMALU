<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>

  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="#"><?php echo e(config('app.name', 'Laravel')); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.pet-registration.index')); ?>">Impound Requests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.adoption-request.index')); ?>">Adoption Requests </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo e(route('admin.adopted-pets.index')); ?>">
                <i class="fa fa-chevron-right"></i> Adopted Pets
              </a>
              <a class="dropdown-item" href="<?php echo e(route('admin.impounded-pets.index')); ?>">
                <i class="fa fa-chevron-right"></i> Impounded Pets
              </a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="<?php echo e(route('admin.users.index')); ?>" class="nav-link"><i class="fa fa-users"></i> Manage Users</a></li>
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i> Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php if(auth()->user()->is('admin')): ?>
                <a class="dropdown-item" href="<?php echo e(url('/')); ?>"><i class="fa fa-diamond fa-fw"></i> Homepage</a>
              <?php endif; ?>
              <a class="dropdown-item logout" href="#" class=""><i class="fa fa-sign-out fa-fw"></i> Log me out</a>
                <?php echo Form::open(['url' => url('logout'), 'method' => 'POST', 'id' => 'logout-form']); ?>

                <?php echo Form::close(); ?>

            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <main class="container pt-3">
    <div class="row align-items-center mb-3">
      <div class="col">
        <h4 class="mb-0"><?php echo $__env->yieldContent('title', 'Section Title'); ?></h4>
      </div>
      <div class="col text-right">
         <?php if(MyHelper::resourceMethodIn(['create', 'edit', 'show'])): ?>
          <a href="<?php echo e(MyHelper::resource('index')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Back to list</a>
        <?php elseif(MyHelper::resourceMethodIn(['index'])): ?>
          <?php if(!isset($hideNewEntryLink)): ?>
            <a href="<?php echo e(MyHelper::resource('create')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New entry</a>
          <?php else: ?>
            <?php echo $__env->yieldContent('new-entry-link'); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>

    <?php echo $__env->yieldContent('content'); ?>

  </main>

<!-- Scripts -->
<?php echo $__env->yieldPushContent('modals'); ?>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>
