<?php

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__.'/../vendor/autoload.php';
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

class AppKernel extends Kernel
{
	use MicroKernelTrait;

	public function registerBundles()
	{
		$bundles = array(
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new Symfony\Bundle\TwigBundle\TwigBundle(),
			new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
			new \Symfony\Bundle\MonologBundle\MonologBundle(),
		);

		if ($this->getEnvironment() == 'dev') {
//			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
		}

		return $bundles;
	}

	protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
	{
		$loader->load(__DIR__.'/config/config.yml');
		$loader->load(__DIR__.'/config/services.yml');

		// configure WebProfilerBundle only if the bundle is enabled
		if (isset($this->bundles['WebProfilerBundle'])) {
			$c->loadFromExtension('web_profiler', array(
				'toolbar' => true,
				'intercept_redirects' => false,
			));
		}
	}

	protected function configureRoutes(RouteCollectionBuilder $routes)
	{
		// import the WebProfilerRoutes, only if the bundle is enabled
		if (isset($this->bundles['WebProfilerBundle'])) {
			$routes->mount('/_wdt', $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml'));
			$routes->mount('/_profiler', $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml'));
		}

		// load the annotation routes
		$routes->mount(
			'/',
			$routes->import(__DIR__.'/../src/App/Controller/', 'annotation')
		);
	}
}