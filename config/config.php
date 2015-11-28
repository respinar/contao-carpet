<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Carpets
 * @link    https://respinar.com
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
	'carpet' => array 
	(
		'categories' => array
		(
			'tables' => array('tl_carpet_category'),
			'icon'   => 'system/modules/carpet/assets/category.png'
		),
		'carpets' => array
		(
			'tables' => array('tl_carpet'),
			'icon'   => 'system/modules/carpet/assets/carpet.png'
		)
	)
	
	
));


/**
 * Front end modules
 */

array_insert($GLOBALS['FE_MOD'], 2, array
(
	'carpet' => array
	(
		'carpet_list'      => 'ModuleCarpetList',
		'carpet_reader'    => 'ModuleCarpetDetail',
	)
));


/**
 * Register hook to add carpets items to the indexer
 */
$GLOBALS['TL_HOOKS']['getSearchablePages'][] = array('Carpet', 'getSearchablePages');
