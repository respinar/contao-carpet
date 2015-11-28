<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Carpet
 * @link    https://respinar.com
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Carpet;

/**
 * Class ModuleCarpetReader
 *
 * Front end module "carpet reader".
 */
class ModuleCarpetDetail extends \ModuleCarpet
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_carpet_detail';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['carpet_reader'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		if (TL_MODE == 'FE')
		{
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/carpet/assets/jquery.raty.min.js|static';
        }

		// Set the item from the auto_item parameter
		if (!isset($_GET['items']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}

		$this->carpet_categories = $this->sortOutProtected(deserialize($this->carpet_categories));

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		global $objPage;

		$this->Template->carpets = '';
		$this->Template->referer = 'javascript:history.go(-1)';
		$this->Template->back = $GLOBALS['TL_LANG']['MSC']['goBack'];

		$objCarpet = \CarpetModel::findPublishedByParentAndIdOrAlias(\Input::get('items'),$this->carpet_categories);

		// Overwrite the page title
		if ($objCarpet->title != '')
		{
			$objPage->pageTitle = strip_tags(strip_insert_tags($objCarpet->title));
		}

		// Overwrite the page description
		if ($objCarpet->description != '')
		{
			$objPage->description = $this->prepareMetaDescription($objCarpet->description);
		}

		$arrCarpet = $this->parseCarpet($objCarpet);

		$this->Template->carpets = $arrCarpet;


	}
}
