<?php

declare(strict_types=1);

namespace CustomHeadBodyContent\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class ConfigForm extends Form
{
    public function init(): void
    {
        if ($this->has('custom_head_content')) {
            return;
        }

        $this->setAttribute('id', 'custom-head-body-content-config-form');

        $this->add([
            'name' => 'custom_head_content',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Custom <head> content', // @translate
                'info' => 'Raw HTML, CSS, JavaScript, meta tags, verification snippets, or similar markup to inject before the closing </head> tag on public HTML pages.', // @translate
            ],
            'attributes' => [
                'id' => 'custom-head-content',
                'rows' => 12,
                'spellcheck' => 'false',
            ],
        ]);

        $this->add([
            'name' => 'custom_body_content',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Custom body content', // @translate
                'info' => 'Raw HTML, CSS, JavaScript, tracking code, or similar markup to inject immediately before the closing </body> tag on public HTML pages.', // @translate
            ],
            'attributes' => [
                'id' => 'custom-body-content',
                'rows' => 12,
                'spellcheck' => 'false',
            ],
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => Element\Csrf::class,
        ]);
    }
}
