<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Carpet
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Carpet',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Carpet\ModuleCarpetList'    => 'system/modules/carpet/modules/ModuleCarpetList.php',
	'Carpet\ModuleCarpet'        => 'system/modules/carpet/modules/ModuleCarpet.php',
	'Carpet\ModuleCarpetDetail'  => 'system/modules/carpet/modules/ModuleCarpetDetail.php',

	// Classes
	'Carpet\Carpet'              => 'system/modules/carpet/classes/Carpet.php',

	// Models
	'Carpet\CarpetModel'         => 'system/modules/carpet/models/CarpetModel.php',
	'Carpet\CarpetCategoryModel' => 'system/modules/carpet/models/CarpetCategoryModel.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_carpet_list'   => 'system/modules/carpet/templates/modules',
	'mod_carpet_detail' => 'system/modules/carpet/templates/modules',
	'carpet_full'       => 'system/modules/carpet/templates/carpet',
	'carpet_short'      => 'system/modules/carpet/templates/carpet',
));
