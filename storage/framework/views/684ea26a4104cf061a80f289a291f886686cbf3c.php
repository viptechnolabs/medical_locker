<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset('images/hospital.ico')); ?>" type="image/ico"/>
    <title>VIP TechnoLabs</title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo e(asset('vendors/animate.css/animate.min.css')); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('build/css/custom.min.css')); ?>" rel="stylesheet">
</head>

<body class="login">
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form action="<?php echo e(route('do_login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <h1>Login Form</h1>
                <div>
                    <select id="user_type" name="user_type" class="form-control">
                        <option value="0">Select User Type</option>
                        <option value="hospital">Hospital</option>
                        <option value="doctor">Doctor</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <br>
                <div>
                    <input type="text" name="email" class="form-control" placeholder="Username"/>
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div>
                <div>
                    <a href="<?php echo e(route('index')); ?>">
                        <button type="submit" class="btn btn-secondary">Login</button>
                    </a>
                </div>
                <div class="separator">
                    <br>
                    <div>
                        <h1><i class="fa fa-hospital-o"></i> VIP TechnoLabs</h1>
                        <p>©2021 All Rights Reserved. VIP TechnoLabs. Privacy and Terms</p>
                    </div>
                </div>
                <?php if($errors->has('email')): ?>
                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                <?php endif; ?>
                <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <?php if(session('status')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('status')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </form>
        </section>
    </div>
</div>

</body>
</html>
<?php /**PATH /var/www/html/medical_locker/resources/views/login.blade.php ENDPATH**/ ?>