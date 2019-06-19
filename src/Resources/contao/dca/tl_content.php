<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['flexibleelement'] = '{type_legend},type;{Inhalte1},elementTemplate,flexibleTitle,flexibleText,flexibleImage;{template_legend:hide},customTpl;';

$GLOBALS['TL_DCA']['tl_content']['fields']['flexibleTitle'] = array(
	'label'                   => array('Titel'),
	'inputType'               => 'textarea',
	'eval'                    => array('mandatory' => false, 'tl_class'=>'w100 clr', 'rows' => 10, 'cols' => 100),
	'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['flexibleText'] = array(
	'label'                   => array('Gesamter Text (ohne Spalten)'),
	'inputType'               => 'textarea',
	'eval'                    => array('mandatory' => false, 'tl_class'=>'w100 clr', 'rows' => 10, 'cols' => 100, 'rte'=>'tinyMCE'),
	'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['flexibleImage'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['multiSRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('multiple'=>true, 'fieldType'=>'checkbox', 'orderField'=>'orderSRC', 'files'=>true, 'mandatory'=>false),
	'sql'                     => "blob NULL",
	'load_callback' => array
	(
		array('tl_content', 'setMultiSrcFlags')
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['elementTemplate'] = array(
	'label'                   => array('Layouts'),
	'default'                 => 'above',
	'options'                 => array_column($GLOBALS['TL_FLEXIBLEELEMENT']['templates'], "id"),
	'inputType'               => 'visualradio',
	'eval'                    => array(
		'mandatory' => false,
		'tl_class'=>'w100 clr',
		'imagepath' => $GLOBALS['TL_FLEXIBLEELEMENT']['iconpath'],
		'imageext' => $GLOBALS['TL_FLEXIBLEELEMENT']['iconext']
	),
	'sql' => "varchar(255) NOT NULL default ''",
);