<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_form']['fields']['leadNotification'] = [
    'exclude' => true,
    'inputType' => 'select',
    'eval' => [
        'includeBlankOption' => true,
        'chosen' => true,
        'tl_class' => 'w50'
    ],
    'options_callback' => ['NotificationCenter\tl_form', 'getNotificationChoices'],
    'sql' => [
        'type' => 'integer',
        'length' => '10',
        'default' => 0,
        'notnull' => true,
    ],
];

PaletteManipulator::create()
    ->addField('leadNotification', 'nc_notification')
    ->applyToPalette('default', 'tl_form')
;
