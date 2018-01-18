<?php

namespace Kptec\LmBundle\ContaoManager;

use Kptec\LmBundle\KptecLmBundle;

use Contao\CoreBundle\ContaoCoreBundle;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;

class Plugin implements BundlePluginInterface, RoutingPluginInterface {
	
	public function getBundles(ParserInterface $parser) {
		return [
			BundleConfig::create(KptecLmBundle::class)
				->setLoadAfter([ContaoCoreBundle::class])
				->setReplace(['kptec'])
		];
	}

	public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__.'/../Resources/config/routing.yml')
            ->load(__DIR__.'/../Resources/config/routing.yml')
        ;
    }

}