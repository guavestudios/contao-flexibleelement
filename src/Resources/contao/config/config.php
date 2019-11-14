<?php

$GLOBALS['TL_CTE']['text']['flexibleelement'] = Guave\Flexibleelement\Elements\ContentFlexibleElement::class;

$GLOBALS['TL_FLEXIBLEELEMENT']['templates'] = [
    [
        'id'       => 'flexible-title-title-text-text',
        'template' => 'ce_2column-text',
    ],
    [
        'id'       => 'flexible-right-image-text',
        'template' => 'ce_2col-txt-img',
    ],
    [
        'id'       => 'flexible-left-image-text',
        'template' => 'ce_2col-img-txt',
    ],
];

$GLOBALS['TL_FLEXIBLEELEMENT']['iconpath'] = 'web/bundles/guaveflexibleelement/assets';
$GLOBALS['TL_FLEXIBLEELEMENT']['iconext'] = '.jpg';
