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
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_page ?> - <?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
        
		echo $this->fetch('css');
		echo $this->Html->css(array('cake.generic','style','jquery-ui.min.css'));
        
		echo $this->fetch('script');
        echo $this->Html->script(array('jquery-1.9.1', 'jquery-ui.min', 'jquery.ui.datepicker-pt-BR', 'jquery.maskedinput', 'jquery.widgets', 'functions', 'config'));
	?>
    <noscript><meta http-equiv="refresh" content="0; url=http://<?PHP echo $_SERVER['HTTP_HOST'] . $this->webroot . 'pages/javascript/'; ?>" /></noscript>
    <script>
    var URL_BASE = 'http://<?PHP echo $_SERVER['HTTP_HOST'] . $this->webroot; ?>';
    </script>
    <style>#dialog_system, #dialog_loading{display: none;}</style>
</head>
<body>
    <?PHP
    echo $this->Html->div(null, '', array('id'=>'dialog_system')); 
    echo $this->Html->div(null, $this->Html->image('loading.gif', array('alt' => 'loading', 'border' => '0')) . ' Aguarde...', array('id'=>'dialog_loading'));
    ?>
    
	<div id="container">
		<div id="content">
            
            
            <h2><?PHP echo $title_page; ?></h2>
            
			<?php echo $this->Session->flash(); ?>
            
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>