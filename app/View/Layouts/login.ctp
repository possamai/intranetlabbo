<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$title_page = 'Intranet - Labbo Idéias Digitais';
?><!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_page ?> - <?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
        
		echo $this->fetch('css');
		//echo $this->Html->css(array('twitter-bootstrap/bootstrap.css','social.css','font-awesome.css', 'twitter-bootstrap/bootstrap-responsive.css'));
        echo $this->Html->css(array('style.css','jquery-ui.min.css','cake-generic.css'));
        
		echo $this->fetch('script');
        echo $this->Html->script(array('jquery-1.9.1', 'jquery-ui.min', 'jquery.ui.datepicker-pt-BR', 
                                        'jquery.maskedinput', 'jquery.widgets', 'functions', 'config' )
        );
        
	?>
    
    <!-- Le styles -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="css/icons.css" rel="stylesheet" type="text/css" />
    <link href="plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="css/main.css" rel="stylesheet" type="text/css" /> 

    <!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
      <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script type="text/javascript" src="js/libs/respond.min.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

    <script type="text/javascript" src="js/libs/modernizr.js"></script>
    
    
    
    <noscript><meta http-equiv="refresh" content="0; url=http://<?PHP echo $_SERVER['HTTP_HOST'] . $this->webroot . 'pages/javascript/'; ?>" /></noscript>
    <script>
    var URL_BASE = 'http://<?PHP echo $_SERVER['HTTP_HOST'] . $this->webroot; ?>';
    </script>
    <style>#dialog_system, #dialog_loading{display: none;}</style>
</head>
<body>
asd
    <?PHP
    echo $this->Html->div(null, '', array('id'=>'dialog_system')); 
    echo $this->Html->div(null, $this->Html->image('loading.gif', array('alt' => 'loading', 'border' => '0')) . ' Aguarde...', array('id'=>'dialog_loading'));
    ?>
    
	
    <div class="container">
        
	   <?php echo $this->fetch('content'); ?>

      
      <!-- BEGIN FOOTER -->
      <div class="form-footer-copyright">
        <?PHP date('Y'); ?> © <small>Pedi.do - Seu pedido on-line</small>
      </div>
      <!-- END FOOTER -->
    </div>
            
</body>
</html>