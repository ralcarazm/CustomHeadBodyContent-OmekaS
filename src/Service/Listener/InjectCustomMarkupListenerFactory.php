<?php

declare(strict_types=1);

namespace CustomHeadBodyContent\Service\Listener;

use CustomHeadBodyContent\Listener\InjectCustomMarkupListener;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class InjectCustomMarkupListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null): InjectCustomMarkupListener
    {
        return new InjectCustomMarkupListener($services->get('Omeka\Settings'));
    }
}
