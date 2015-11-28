<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Carpets
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Carpet;


/**
 * Class Carpet
 *
 * Provide methods regarding news archives.
 * @copyright  Hamid Abbaszadeh 2013-2014
 * @author     Hamid Abbaszadeh <http://respinar.com>
 * @package    Carpet
 */
class Carpet extends \Frontend
{

	/**
	 * Add product items to the indexer
	 * @param array
	 * @param integer
	 * @param boolean
	 * @return array
	 */
	public function getSearchablePages($arrPages, $intRoot=0, $blnIsSitemap=false)
	{
		$arrRoot = array();

		if ($intRoot > 0)
		{
			$arrRoot = $this->Database->getChildRecords($intRoot, 'tl_page');
		}

		$time = time();
		$arrProcessed = array();

		// Get all catalog categories
		$objCategory = \CarpetCategoryModel::findByProtected('');

		// Walk through each archive
		if ($objCategory !== null)
		{
			while ($objCategory->next())
			{
				// Skip catalog categories without target page
				if (!$objCategory->jumpTo)
				{
					continue;
				}

				// Skip catalog categories outside the root nodes
				if (!empty($arrRoot) && !in_array($objCategory->jumpTo, $arrRoot))
				{
					continue;
				}

				// Get the URL of the jumpTo page
				if (!isset($arrProcessed[$objCategory->jumpTo]))
				{
					$objParent = \PageModel::findWithDetails($objCategory->jumpTo);

					// The target page does not exist
					if ($objParent === null)
					{
						continue;
					}

					// The target page has not been published (see #5520)
					if (!$objParent->published || ($objParent->start != '' && $objParent->start > $time) || ($objParent->stop != '' && $objParent->stop < $time))
					{
						continue;
					}

					// The target page is exempt from the sitemap (see #6418)
					if ($blnIsSitemap && $objParent->sitemap == 'map_never')
					{
						continue;
					}

					// Set the domain (see #6421)
					$domain = ($objParent->rootUseSSL ? 'https://' : 'http://') . ($objParent->domain ?: \Environment::get('host')) . TL_PATH . '/';

					// Generate the URL
					$arrProcessed[$objCategory->jumpTo] = $domain . $this->generateFrontendUrl($objParent->row(), ((\Config::get('useAutoItem') && !\Config::get('disableAlias')) ?  '/%s' : '/items/%s'), $objParent->language);
				}

				$strUrl = $arrProcessed[$objCategory->jumpTo];

				// Get the items
				$objCarpet = \CarpetModel::findPublishedByPid($objCategory->id);

				if ($objCarpet !== null)
				{
					while ($objCarpet->next())
					{
						$arrPages[] = $this->getLink($objCarpet, $strUrl);
					}
				}
			}
		}

		return $arrPages;
	}


	/**
	 * Return the link of a product
	 * @param object
	 * @param string
	 * @param string
	 * @return string
	 */
	protected function getLink($objItem, $strUrl)
	{
		// Link to the default page
		return sprintf($strUrl, (($objItem->alias != '' && !\Config::get('disableAlias')) ? $objItem->alias : $objItem->id));
	}

}
