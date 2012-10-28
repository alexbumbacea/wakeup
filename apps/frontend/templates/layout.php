<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo url_for('@homepage')?>">Power Management</a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="<?php echo url_for('@homepage');?>">Home</a></li>
                    <?php if ($sf_user->hasCredential('admin')): ?>
                    <li><a href="<?php echo url_for('computer/new');?>">Add computer</a></li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            User Management
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <a href="<?php echo url_for('sfGuardUser/index')?>">Users</a>
                            <a href="<?php echo url_for('sfGuardGroup/index')?>">Groups</a>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if ($sf_user->isAuthenticated()): ?>
                    <li><a href="<?php echo url_for('sf_guard_signout');?>">Logout</a></li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <?php if ($sf_user->hasFlash('info')): ?>
            <div class="span12 alert alert-info"><?php echo $sf_user->getFlash('info') ?></div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php if ($sf_user->hasFlash('error')): ?>
            <div class="span12 alert alert-error"><?php echo $sf_user->getFlash('error') ?></div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="span12">
                <?php echo $sf_content ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>
