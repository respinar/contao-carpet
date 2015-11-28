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
 * Class ModuleCarpetList
 *
 * Front end module "carpet list".
 */

class ModuleCarpetList extends \ModuleCarpet
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_carpet_list';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['carpet_list'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$this->carpet_categories = $this->sortOutProtected(deserialize($this->carpet_categories));

		// No carpaets categries available
		if (!is_array($this->carpet_categories) || empty($this->carpet_categories))
		{
			return '';
		}

		// Show the catalog detail if an item has been selected
		if ($this->carpet_detailModule > 0 && (isset($_GET['items']) || ($GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))))
		{
			return $this->getFrontendModule($this->carpet_detailModule, $this->strColumn);
		}

		if (TL_MODE == 'FE')
		{
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/carpet/assets/jquery.raty.min.js|static';
        }

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$offset = intval($this->skipFirst);
		$limit = null;

		// Maximum number of items
		if ($this->numberOfItems > 0)
		{
			$limit = $this->numberOfItems;
		}

		// Maximum number of items
		if ($this->numberOfItems > 0)
		{
			$limit = $this->numberOfItems;
		}

		$this->Template->carpets = array();
		$this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyCategory'];


		$intTotal = \CarpetModel::countPublishedByPids($this->carpet_categories,$this->carpet_status);

		if ($intTotal < 1)
		{
			return;
		}

		$total = $intTotal - $offset;


		// Split the results
		if ($this->perPage > 0 && (!isset($limit) || $this->numberOfItems > $this->perPage))
		{
			// Adjust the overall limit
			if (isset($limit))
			{
				$total = min($limit, $total);
			}

			// Get the current page
			$id = 'page_n' . $this->id;
			$page = \Input::get($id) ?: 1;

			// Do not index or cache the page if the page number is outside the range
			if ($page < 1 || $page > max(ceil($total/$this->perPage), 1))
			{
				global $objPage;
				$objPage->noSearch = 1;
				$objPage->cache = 0;

				// Send a 404 header
				header('HTTP/1.1 404 Not Found');
				return;
			}

			// Set limit and offset
			$limit = $this->perPage;
			$offset += (max($page, 1) - 1) * $this->perPage;
			$skip = intval($this->skipFirst);

			// Overall limit
			if ($offset + $limit > $total + $skip)
			{
				$limit = $total + $skip - $offset;
			}

			// Add the pagination menu
			$objPagination = new \Pagination($total, $this->perPage, \Config::get('maxPaginationLinks'), $id);
			$this->Template->pagination = $objPagination->generate("\n  ");
		}

		$arrOptions = array();
		if ($this->carpet_sortBy)
		{
			switch ($this->carpet_sortBy)
			{
				case 'title_asc':
					$arrOptions['order'] = "title ASC";
					break;
				case 'title_desc':
					$arrOptions['order'] = "title DESC";
					break;
				case 'alias_asc':
					$arrOptions['order'] = "alias ASC";
					break;
				case 'alias_desc':
					$arrOptions['order'] = "alias DESC";
					break;
				case 'date_asc':
					$arrOptions['order'] = "date ASC";
					break;
				case 'date_desc':
					$arrOptions['order'] = "date DESC";
					break;
				case 'custom':
					$arrOptions['order'] = "sorting ASC";
					break;
			}
		}

		// Get the items
		if (isset($limit))
		{
			$objCarpets = \CarpetModel::findPublishedByPids($this->carpet_categories, $limit, $offset, $this->carpet_status,$arrOptions);
		} else {
			$objCarpets = \CarpetModel::findPublishedByPids($this->carpet_categories, 0, $offset, $this->carpet_status,$arrOptions);
		}


		// Add the Carpets
		if ($objCarpets !== null)
		{
			$this->Template->carpets = $this->parseCarpets($objCarpets);
		}

		$this->Template->gategories = $this->carpet_categories;
	}
}
