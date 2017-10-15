<?php

namespace ImzFilterDescription;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;

/**
 * A simple plugin that shows the usage of attributes in the frontend.
 *
 * @package SwagShoeSize
 */
class ImzFilterDescription extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Front_DispatchLoopStartup' => 'preparePlugin',
        ];
    }

    public function preparePlugin()
    {
        $this->container->get('Template')->addTemplateDir(
            $this->getPath() . '/Views/'
        );
    }

    public function install(InstallContext $context)
    {
        $crudService = $this->container->get('shopware_attribute.crud_service');

        $crudService->update('s_filter_attributes', 'imz_desc', 'html', [
            'label' => 'Beschreibung',
            'supportText' => 'Text der auf der Artikeldetailseite angezeigt wird',
            'displayInBackend' => true,
            'translatable' => true,
        ]);
        Shopware()->Models()->generateAttributeModels(['s_filter_attributes']);
        return true;
    }

    public function uninstall(UninstallContext $context)
    {
        $crudService = $this->container->get('shopware_attribute.crud_service');
        $crudService->delete('s_filter_attributes', 'imz_desc');
        Shopware()->Models()->generateAttributeModels(['s_filter_attributes']);
        return true;
    }
}