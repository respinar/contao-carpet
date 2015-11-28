<?php

/**
 * Table tl_carpet
 */
$GLOBALS['TL_DCA']['tl_carpet'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		//'ptable'                      => 'tl_carpet_category',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(		
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('date DESC'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('singleSRC','title','pid', 'code', 'price','stock'),
			'showColumns'             => true,
			'label_callback'          => array('tl_carpet', 'addImage')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'feature' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['feature'],
				'icon'                => 'system/modules/carpet/assets/feature.png',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleFeature(this,%s)"',
				'button_callback'     => array('tl_carpet', 'toggleIconFeature')
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_carpet', 'toggleIcon')
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpet']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('published'),
		'default'                     => '{category_legend},pid;{image_legend},singleSRC;{name_legend},title,alias,code,date;{properties_legend},knots,colors,silk,width,height,orientation;{price_legend},price,discount;{status_legend},stock,status;{description_legend:hide},description;{publish_legend},published'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'published'                   => 'start,stop'
	),

		// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
        
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'visit' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'pid' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['pid'],
			'foreignKey'              => 'tl_carpet_category.title',
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager'),
			'inputType'               => 'select',
			'filter'                  => true,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['date'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alias','unique'=>true,'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'code' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['code'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'price' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['price'],
			'exclude'                 => true,
			'filter'                  => flase,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'digit', 'maxlength'=>12, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'discount' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['discount'],
			'exclude'                 => true,
			'filter'                  => flase,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'prcnt', 'maxlength'=>3, 'tl_class'=>'w50'),
			'sql'                     => "int(3) NOT NULL default '0'"
		),
		'stock' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['stock'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "int(3) NOT NULL default '1'"
		),
		'status' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['status'],
			'exclude'                 => true,
			'filter'                  => true,
			'options'                 => array('Stock','Preparing','New'),
			'flag'                    => 1,
			'inputType'               => 'select',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'width' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['width'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit','maxlength'=>4, 'tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'height' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['height'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>4, 'tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'orientation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['orientation'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => 'landscape',
			'options'                 => array('landscape','portrate'),
			'flag'                    => 1,
			'inputType'               => 'select',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'colors' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['colors'],
			'exclude'                 => true,
			'filter'                  => flase,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>3, 'tl_class'=>'w50'),
			'sql'                     => "varchar(3) NOT NULL default ''"
		),
		'knots' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['knots'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>4,'tl_class'=>'w50'),
			'sql'                     => "varchar(4) NOT NULL default '50'"
		),
		'silk' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['silk'],
			'exclude'                 => true,
			'filter'                  => flase,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>3, 'tl_class'=>'w50'),
			'sql'                     => "varchar(3) NOT NULL default ''"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']),
			'sql'                     => "binary(16) NULL"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['description'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE'),
			'sql'                     => "text NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true,'submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpet']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);


/**
 * Provide miscellaneous methods that are used by the data configuration array
 */
class tl_carpet extends Backend
{

	/**
	 * Generate a song row and return it as HTML string
	 * @param array
	 * @return string
	 */
	public function generateItemRow($arrRow)
	{
		$objImage = \FilesModel::findByPk($arrRow['singleSRC']);

		if ($objImage !== null)
		{
			$strImage = \Image::getHtml(\Image::get($objImage->path, '80', '60', 'important'));
		}

		return '<div><div style="float:left; margin-right:10px;">'.$strImage.'</div>'. $arrRow['title'] . '</span><br><span style="padding-left:3px;color:#b3b3b3;">کد: ' . $arrRow['alias'] .'<br><span>بازدید: '.$arrRow['visit'].'<br>قیمت: '. number_format($arrRow[price]) .' ریال</span></div>';
	}
	
	/**
	 * Add an image to each record
	 * @param array         $row
	 * @param string        $label
	 * @param DataContainer $dc
	 * @param array         $args
	 *
	 * @return array
	 */
	public function addImage($row, $label, DataContainer $dc, $args)
	{
		
		$objImage = \FilesModel::findByPk($row['singleSRC']);

		if ($objImage !== null)
		{
			$strImage = \Image::getHtml(\Image::get($objImage->path, '80', '60', 'center_center'));
		}
				
		$args[0] = $strImage;

		return $args;
	}

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'toggle');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_carpet', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_carpet']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_carpet']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpet SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_carpet', $intId);

	}

	public function toggleIconStock($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('fid')))
		{
			$this->toggleFeature($this->Input->get('fid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;fid='.$row['id'].'&amp;state='.($row['feature'] ? '' : 1);

		if (!$row['feature'])
		{
			$icon = 'feature.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function toggleFeature($intId, $blnFeature)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'feature');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_carpet', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_carpet']['fields']['feature']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_carpet']['fields']['feature']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnFeature = $this->$callback[0]->$callback[1]($blnFeature, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpet SET tstamp=". time() .", feature='" . ($blnFeature ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_carpet', $intId);

	}

	public function toggleIconPreparing($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('pid')))
		{
			$this->togglePreparing($this->Input->get('pid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;pid='.$row['id'].'&amp;state='.($row['preparing'] ? '' : 1);

		if (!$row['preparing'])
		{
			$icon = 'feature_.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function togglePreparing($intId, $blnPreparing)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'preparing');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_carpet', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_carpet']['fields']['preparing']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_carpet']['fields']['preparing']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnPreparing = $this->$callback[0]->$callback[1]($blnPreparing, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpet SET tstamp=". time() .", preparing='" . ($blnPreparing ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_carpet', $intId);

	}

}
