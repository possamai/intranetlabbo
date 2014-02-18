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

$title_page = 'Intranet - Soléflex';
?><!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_page ?> - <?php echo $title_for_layout; ?></title>
    
    <base href="<?PHP echo Router::url('/', true); ?>" />
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' /> <!-- Headings -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> <!-- Text -->
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->
    
        
	<?php
	echo $this->Html->meta('icon', $this->Html->url('/favicon.png'));
	echo $this->fetch('meta');
    
    echo $this->Html->css(
        array( 
                'jquery-ui.min.css',
                'bootstrap/bootstrap.css',
                'bootstrap/bootstrap-responsive.css',
                'supr-theme/jquery.ui.supr.css',
                'icons.css',
                
                Router::url('/', true) . 'js/plugins/forms/uniform/uniform.default.css',
                Router::url('/', true) . 'js/plugins/misc/qtip/jquery.qtip.css',
                
                'main.css',
                'style.css'
        )
    );
	echo $this->fetch('css');
    
    
    echo $this->Html->script(
        array( 
                'libs/modernizr.js',
                'jquery-1.9.1.js',
                'jquery-ui.min.js',
                'jquery-migrate-1.2.1.min.js',
                'bootstrap/bootstrap.js',
                'plugins/forms/uniform/jquery.uniform.min.js',
                'libs/jRespond.min.js',
                'jquery.ui.datepicker-pt-BR.js',
                'jquery.maskedinput.js',
                'plugins/forms/placeholder/jquery.placeholder.min.js',
                'plugins/misc/totop/jquery.ui.totop.min.js',
                'plugins/misc/qtip/jquery.qtip.min.js',
                
                'functions.js',
                'jquery.widgets.js',
                'main.js',
                'config.js'
        )
    );
	echo $this->fetch('script');    
	?>  
    
    

    <!--[if IE 8]>
        <?PHP echo $this->Html->css(array('ie8')); ?>
    <![endif]-->
    <!--[if lt IE 9]>
        <?PHP echo $this->Html->script(array('libs/excanvas.min.js', 'libs/respond.min.js', 'libs/html5.js')); ?>
    <![endif]-->
    
    
    
    <noscript><meta http-equiv="refresh" content="0; url=http://<?PHP echo $_SERVER['HTTP_HOST'] . $this->webroot . 'pages/javascript/'; ?>" /></noscript>
    <script>
    var URL_BASE = 'http://<?PHP echo $_SERVER['HTTP_HOST'] . $this->webroot; ?>';
    </script>
    <style>#dialog_system, #dialog_loading, #dialog_system_confirm{display: none;} .wraper #main{margin-top: 40px; }</style>
</head>

<body>
    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>
    <?PHP
    echo $this->Html->div(null, '', array('id'=>'dialog_system', 'class'=>'dialog')); 
    echo $this->Html->div(null, '', array('id'=>'dialog_system_confirm', 'class'=>'dialog')); 
    echo $this->Html->div(null, $this->Html->image('loading.gif', array('alt' => 'loading')) . ' Aguarde...', array('id'=>'dialog_loading', 'class'=>'dialog'));
    ?>
         
    <?PHP if ($userLogado) :  // Intranet ?>
        <?PHP echo $this->element('top'); ?>
        
        <div id="wrapper">
    
            <?PHP echo $this->element('sidebar'); ?>
            
            <!--Body content-->
            <div id="content" class="clearfix">
                <div class="contentwrapper"><!--Content wrapper-->
                
                    <?PHP echo $this->element('breadcrumb'); ?>
                    
                    <?php echo $this->fetch('content'); ?>
                    
                    <?php echo $this->element('sql_dump'); ?>
                    
                </div><!-- End contentwrapper -->
            </div><!-- End #content -->
        
        </div><!-- End #wrapper -->
        
    <?PHP else: // Login ?>

        <?php echo $this->fetch('content'); ?>
        
    <?PHP endif; ?>
    
    </body>
</html>
