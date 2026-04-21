<?php

declare(strict_types=1);

namespace CustomHeadBodyContent;

use CustomHeadBodyContent\Form\ConfigForm;
use CustomHeadBodyContent\Listener\InjectCustomMarkupListener;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\View\Renderer\PhpRenderer;
use Omeka\Module\AbstractModule;

class Module extends AbstractModule
{
    public const SETTING_HEAD = 'customheadbodycontent_head_content';
    public const SETTING_BODY = 'customheadbodycontent_body_content';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);

        $application = $event->getApplication();
        $services = $application->getServiceManager();
        $listener = $services->get(InjectCustomMarkupListener::class);

        $application->getEventManager()->attach(MvcEvent::EVENT_FINISH, $listener, -1000);
    }

    public function install(ServiceLocatorInterface $services)
    {
        $settings = $services->get('Omeka\Settings');
        $settings->set(self::SETTING_HEAD, '');
        $settings->set(self::SETTING_BODY, '');
    }

    public function uninstall(ServiceLocatorInterface $services)
    {
        $settings = $services->get('Omeka\Settings');
        $settings->delete(self::SETTING_HEAD);
        $settings->delete(self::SETTING_BODY);
    }

    public function getConfigForm(PhpRenderer $renderer)
    {
        $services = $this->getServiceLocator();
        $settings = $services->get('Omeka\Settings');
        $form = $services->get('FormElementManager')->get(ConfigForm::class);
        $form->init();
        $form->setData([
            'custom_head_content' => (string) $settings->get(self::SETTING_HEAD, ''),
            'custom_body_content' => (string) $settings->get(self::SETTING_BODY, ''),
        ]);

        return $renderer->partial('common/custom-head-body-content-config-form', [
            'form' => $form,
        ]);
    }

    public function handleConfigForm(AbstractController $controller)
    {
        $services = $this->getServiceLocator();
        $settings = $services->get('Omeka\Settings');
        $form = $services->get('FormElementManager')->get(ConfigForm::class);
        $form->init();
        $form->setData($controller->params()->fromPost());

        if (!$form->isValid()) {
            return false;
        }

        $data = $form->getData();
        $settings->set(self::SETTING_HEAD, (string) ($data['custom_head_content'] ?? ''));
        $settings->set(self::SETTING_BODY, (string) ($data['custom_body_content'] ?? ''));

        return true;
    }
}
