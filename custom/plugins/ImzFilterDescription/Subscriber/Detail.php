<?php

namespace ImzFilterDescription\Subscriber;

use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Detail implements SubscriberInterface
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatch_Frontend_Detail' => 'onFrontendPostDispatchDetail'
        );
    }

    public function onFrontendPostDispatchDetail(\Enlight_Event_EventArgs $args)
    {
        $controller = $args->getSubject();
        $view = $controller->View();
        $sArticle = $view->sArticle;
        $filtergroupid = $sArticle['filtergroupID'];
        if ($filtergroupid) {
            $service = $this->container->get('shopware_attribute.data_loader');
            $propdesc = $service->load('s_filter_attributes', $filtergroupid);
            if ($propdesc['imz_desc']) {
                $view->assign('imzFilterDesc', $propdesc['imz_desc']);
            }
        }
    }
}
