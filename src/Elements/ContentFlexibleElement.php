<?php

namespace Guave\Flexibleelement\Elements;

use Contao\ContentElement;
use FilesModel;
use Image;

class ContentFlexibleElement extends ContentElement {
    
	public static function getIconPath() {
		global $GLOBALS;
		return $GLOBALS['TL_FLEXIBLEELEMENT']['iconpath'];
	}
	
	public static function getBackendMap() {
		$base = static::getIconPath();
		$arr = array();
		$templates = &$GLOBALS['TL_FLEXIBLEELEMENT']['templates'];
		foreach($templates as $tmpl) {
			$arr[] = $base.$tmpl["id"];
		}
		return $arr;
	}
	
	public static function getTemplateByLayout($layout) {
		$templates = &$GLOBALS['TL_FLEXIBLEELEMENT']['templates'];
		foreach ($templates as $tmpl)
			if ($tmpl['id'] == $layout)
				return $tmpl;

		return null;
	}

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_flexibleelement';

	public function generate()
	{
		if ($this->customTpl) {
			$tmplStr = str_replace(".html5","",$this->customTpl);
		} else {
			$tmpl = static::getTemplateByLayout($this->elementTemplate);
			$tmplStr = $tmpl['template'];

		}

		$this->strTemplate = $tmplStr;

		if(TL_MODE == 'FE') {
			return parent::generate();
		}
		if(TL_MODE == 'BE') {
			if ($tmpl != null) {
				return '<div><span>FlexibleElement</span><br><br>'.Image::getHtml(static::getIconPath().'/'.$tmpl['id'].$GLOBALS['TL_FLEXIBLEELEMENT']['iconext'], $label, 'title="'.specialchars($label).'"').'</div>';
			} else {
				return '<div><span>FlexibleElement</span><br><br>'.$tmplStr.'</div>';
			}
		}

	}

	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		global $objPage;

		$this->Template->multiSRC = self::prepareImages($this, "orderSRC");
	}

	public static function prepareImages(&$obj, $attr) {
		if (is_string($obj->$attr)) {
			$images = array();
			$imagesArr = unserialize($obj->$attr);
			foreach($imagesArr as $image)
				$images[] = static::getImageData(FilesModel::findByUuid($image));;

			$obj->$attr = $images;
		} else if (is_array($obj->$attr)) {
			return $obj->$attr;
		}
		return $images;
	}

	public static function getImageData(&$objModel) {
		if(!$objModel) {
			return;
		}

		if(!$objModel instanceof \Contao\FilesModel) {
			return;
		}

		if ($objModel) {
			if (!is_file(TL_ROOT.'/'.$objModel->path)) {
				//try to load from s3
				//S3::loadFileFromS3($objModel->path);
			}
		}
		if (is_file(TL_ROOT.'/'.$objModel->path)) {

			$meta = unserialize($objModel->meta);
			$meta = $meta[$GLOBALS['TL_LANGUAGE']];

			return array(
				'src' => $objModel->path,
				'name' => $objModel->name,
				'title' => $meta['title'] ? $meta['title'] : $objModel->name,
			);
		} else {
			return  null;
		}



	}
}
