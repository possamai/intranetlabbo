<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    function afterFind($results, $primary = false) {
    	foreach ($results as $key => $val) {
    		if (isset($val[$this->name]['created'])) {
                $results[$key][$this->name]['created'] = (($val[$this->name]['created']<>'0000-00-00 00:00:00')?$this->datetimeFormatAfterFind($val[$this->name]['created']):'');
    		}
    		if (isset($val[$this->name]['modified'])) {
                $results[$key][$this->name]['modified'] = (($val[$this->name]['modified']<>'0000-00-00 00:00:00')?$this->datetimeFormatAfterFind($val[$this->name]['modified']):'');
    		}
    	}
    	return $results;
    }
     
    function datetimeFormatAfterFind($datetimeString) {
    	return date('d/m/Y - H:i:s', strtotime($datetimeString));
    }
}