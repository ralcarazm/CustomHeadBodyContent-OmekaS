<?php

declare(strict_types=1);

use CustomHeadBodyContent\Form\ConfigForm;
use CustomHeadBodyContent\Listener\InjectCustomMarkupListener;
use CustomHeadBodyContent\Service\Listener\InjectCustomMarkupListenerFactory;

return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'form_elements' => [
        'invokables' => [
            ConfigForm::class => ConfigForm::class,
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => dirname(__DIR__) . '/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            InjectCustomMarkupListener::class => InjectCustomMarkupListenerFactory::class,
        ],
    ],
];
