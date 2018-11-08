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
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'Laravel')); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <?php if(auth()->guard()->check()): ?>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Impound Requests
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo e(route('user.pet-registration.index')); ?>">Track Requests</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('user.pet-registration.create')); ?>">New Request</a>
              </div>
            </li>
          <li class="nav-item"><a href="<?php echo e(route('user.adoption-request.index')); ?>" class="nav-link">Adoption Requests</a></li>
          </ul>
          <?php endif; ?>
          <ul class="navbar-nav ml-auto">
            <?php if(auth()->guard()->check()): ?>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello, <?php echo e(auth()->user()->name); ?>!
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#profile-modal"><i class="fa fa-user fa-fw"></i> Profile</a>

                <?php if(auth()->user()->is('admin')): ?>
                <a class="dropdown-item" href="<?php echo e(route('admin.pet-registration.index')); ?>"><i class="fa fa-diamond fa-fw"></i> Admin Page</a>
                <?php endif; ?>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item logout" href="#" class=""><i class="fa fa-sign-out fa-fw"></i> Log me out</a>
                <?php echo Form::open(['url' => url('logout'), 'method' => 'POST', 'id' => 'logout-form']); ?>

                <?php echo Form::close(); ?>

              </div>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#registration-modal" href="javascript:void(0)">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#login-modal" href="javascript:void(0)">Login</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->

    <div class="container pt-3">
      <?php if(!isset($hidePageHeader)): ?>
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col text-right">
                 <?php if(MyHelper::resourceMethodIn(['create', 'edit'])): ?>
                    <a href="<?php echo e(MyHelper::resource('index')); ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back to list</a>
                  <?php elseif(MyHelper::resourceMethodIn(['index'])): ?>
                    <a href="<?php echo e(MyHelper::resource('create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New entry</a>
                  <?php endif; ?>
            </div>
        </div>
      <?php endif; ?>
      <?php if($flash = session('message')): ?>
        <div class="row">
          <div class="col">
            <div class="alert alert-<?php echo e($flash['status']); ?>">
                <?php echo e($flash['message']); ?>

            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php echo $__env->yieldContent('content'); ?>

  </div>
    <!-- Modals -->
    <?php echo $__env->renderWhen(auth::guest(), 'partials.registration-modal', array_except(get_defined_vars(), array('__data', '__path'))); ?>
    <?php echo $__env->renderWhen(auth::guest(), 'partials.login-modal', array_except(get_defined_vars(), array('__data', '__path'))); ?>
    <?php echo $__env->renderWhen(auth::check(), 'partials.profile-modal', array_except(get_defined_vars(), array('__data', '__path'))); ?>
    <?php echo $__env->yieldPushContent('modals'); ?>
<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('js'); ?>


</body>
</html>
