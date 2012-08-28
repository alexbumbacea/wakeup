<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-31243257-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>
  </head>
  <body>
    <div class="container header">
      <h1>PJ Interactive Power Management</h1>
    </div>
    <div class="container">
      <?php if ($sf_user->hasFlash('info')): ?>
          <div class="info"><?php echo $sf_user->getFlash('info') ?></div>
      <?php endif; ?>
      <?php if ($sf_user->hasFlash('error')): ?>
          <div class="error"><?php echo $sf_user->getFlash('error') ?></div>
      <?php endif; ?>
      <?php echo $sf_content ?>
    </div>
  </body>
</html>
