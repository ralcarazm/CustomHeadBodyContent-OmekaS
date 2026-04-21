<?php

declare(strict_types=1);

namespace CustomHeadBodyContent\Listener;

use CustomHeadBodyContent\Module;
use Laminas\Http\PhpEnvironment\Request;
use Laminas\Http\PhpEnvironment\Response;
use Laminas\Mvc\MvcEvent;
use Omeka\Settings\Settings;

class InjectCustomMarkupListener
{
    protected Settings $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(MvcEvent $event): void
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if (!$request instanceof Request || !$response instanceof Response) {
            return;
        }

        if ($request->isXmlHttpRequest()) {
            return;
        }

        $routeMatch = $event->getRouteMatch();
        if (!$routeMatch) {
            return;
        }

        $matchedRouteName = (string) $routeMatch->getMatchedRouteName();
        if (
            $matchedRouteName === 'admin'
            || strpos($matchedRouteName, 'admin/') === 0
            || $matchedRouteName === 'api'
            || strpos($matchedRouteName, 'api/') === 0
        ) {
            return;
        }

        $content = (string) $response->getContent();
        if ($content === '' || stripos($content, '<html') === false) {
            return;
        }

        $contentType = $response->getHeaders()->has('Content-Type')
            ? (string) $response->getHeaders()->get('Content-Type')->getFieldValue()
            : '';

        if (
            $contentType !== ''
            && stripos($contentType, 'text/html') === false
            && stripos($contentType, 'application/xhtml+xml') === false
        ) {
            return;
        }

        $headContent = (string) $this->settings->get(Module::SETTING_HEAD, '');
        $bodyContent = (string) $this->settings->get(Module::SETTING_BODY, '');

        if ($headContent === '' && $bodyContent === '') {
            return;
        }

        if ($headContent !== '') {
            $updated = preg_replace('~</head>~i', rtrim($headContent) . PHP_EOL . '</head>', $content, 1, $count);
            if (is_string($updated) && $count > 0) {
                $content = $updated;
            }
        }

        if ($bodyContent !== '') {
            $updated = preg_replace('~</body>~i', rtrim($bodyContent) . PHP_EOL . '</body>', $content, 1, $count);
            if (is_string($updated) && $count > 0) {
                $content = $updated;
            }
        }

        $response->setContent($content);
    }
}
