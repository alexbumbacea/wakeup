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

    <script type="text/javascript">
        baseUri = <? echo json_encode(url_for('@homepage')); ?>;
        Ext.Loader.setPath({
            'Ext.ux.desktop': 'http://cdn.sencha.com/ext/beta/4.2.0.265/examples/desktop/js',
            'Ext': 'http://cdn.sencha.com/ext/beta/4.2.0.265/src',
            'MyDesktop': 'http://cdn.sencha.com/ext/beta/4.2.0.265/examples/desktop',
            'wakeup': 'js/ext'
        });

        Ext.require('wakeup.App');

        var myDesktopApp;
        Ext.onReady(function () {
            myDesktopApp = new wakeup.App();
        });
    </script>
</head>
<body>
<?php echo $sf_content ?>
</body>
</html>
