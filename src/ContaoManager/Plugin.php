<?php

namespace Guave\Flexibleelement\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerBundle\ContaoManagerBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Guave\Flexibleelement\FlexibleelementBundle;
use Guave\Visualradio\GuaveVisualradioBundle;

class Plugin implements BundlePluginInterface
{

    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(FlexibleelementBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoManagerBundle::class, GuaveVisualradioBundle::class])
                ->setReplace(['flexibleelement', 'visualradio'])
        ];
    }
}
