<?php

namespace DVC\FormLead\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use DVC\FormLead\FormLeadBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(FormLeadBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    'notification_center',
                ])
        ];
    }
}
