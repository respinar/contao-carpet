<?php

/**
 * Add palettes to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['carpet_list']      = '{title_legend},name,headline,type;
                                                                   {category_legend},carpet_categories;
                                                                   {template_legend:hide},customTpl,carpet_detailModule;
                                                                   {meta_legend},carpet_metaFields;
                                                                   {config_legend},carpet_status,carpet_sortBy,numberOfItems,perPage,skipFirst;
                                                                   {carpet_legend},carpet_template,carpet_perRow,carpet_Class,imgSize;
                                                                   {protected_legend:hide},protected;
                                                                   {expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['carpet_reader']    = '{title_legend},name,headline,type;
                                                                   {category_legend},carpet_categories;
                                                                   {detail_legend},carpet_price;
                                                                   {template_legend},customTpl;
                                                                   {carpet_legend},carpet_template,imgSize,fullsize;
                                                                   {related_legend},related_show,related_template,related_perRow,related_Class,related_imgSize;
                                                                   {protected_legend:hide},protected;
                                                                   {expert_legend:hide},guests,cssID,space';



/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_categories'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['carpet_category'],
	'exclude'              => true,
	'inputType'            => 'checkbox',
	'options_callback'     => array('tl_module_carpet', 'getCategories'),
	'eval'                 => array('multiple'=>true, 'mandatory'=>true),
    'sql'                  => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_detailModule'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_detailModule'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_carpet', 'getDetailModules'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_metaFields'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_metaFields'],
	'default'                 => array('date'),
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('date','price','rating'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('multiple'=>true),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_template'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['carpet_template'],
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => array('tl_module_carpet', 'getCarpetsTemplates'),
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_Class'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_Class'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_status'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_status'],
	'default'                 => 'all',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('all','preparing', 'stock'),
	'reference'               => &$GLOBALS['TL_LANG']['carpet_status'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(16) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_sortBy'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_sortBy'],
	'default'                 => 'custom',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('custom','title_asc', 'title_desc','alias_asc', 'alias_desc', 'date_asc', 'date_desc'),
	'reference'               => &$GLOBALS['TL_LANG']['carpet_sortBy'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(16) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_perRow'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['carpet_perRow'],
	'default'              => '4',
	'exclude'              => true,
	'inputType'            => 'select',
	'options'              => array('1','2','3','4','6','12'),
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['related_show'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['related_show'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(),
	'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_template'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['related_template'],
	'default'              => 'product_related',
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => array('tl_module_catalog', 'getProductTemplates'),
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['related_Class'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['related_Class'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_perRow'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['related_perRow'],
	'default'              => '4',
	'exclude'              => true,
	'inputType'            => 'select',
	'options'              => array('1','2','3','4','6','12'),
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_imgSize'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['related_imgSize'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => System::getImageSizes(),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);


/**
 * Class tl_module_cds
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Hamid Abbaszadeh 2010
 * @author     Hamid Abbaszadeh <http://respinar.com>
 * @package    Carpets Collection
 */
class tl_module_carpet extends Backend
{

	/**
	 * Return all prices templates as array
	 * @param object
	 * @return array
	 */
	public function getCarpetsTemplates(DataContainer $dc)
	{
		return $this->getTemplateGroup('carpet_', $dc->activeRecord->pid);
	}

	/**
	 * Get all product detail modules and return them as array
	 * @return array
	 */
	public function getDetailModules()
	{
		$arrModules = array();
		$objModules = $this->Database->execute("SELECT m.id, m.name, t.name AS theme FROM tl_module m LEFT JOIN tl_theme t ON m.pid=t.id WHERE m.type='carpet_reader' ORDER BY t.name, m.name");

		while ($objModules->next())
		{
			$arrModules[$objModules->theme][$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')';
		}

		return $arrModules;
	}

	/**
	 * Get all news archives and return them as array
	 * @return array
	 */
	public function getCategories()
	{
		//if (!$this->User->isAdmin && !is_array($this->User->news))
		//{
		//	return array();
		//}

		$arrCategories = array();
		$objCategories = $this->Database->execute("SELECT id, title FROM tl_carpet_category ORDER BY title");

		while ($objCategories->next())
		{
			//if ($this->User->hasAccess($objArchives->id, 'news'))
			//{
				$arrCategories[$objCategories->id] = $objCategories->title;
			//}
		}

		return $arrCategories;
	}
}
