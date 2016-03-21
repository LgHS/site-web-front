<?php
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

// require Composer's autoloader
require __DIR__.'/vendor/autoload.php';

class AppKernel extends Kernel
{
	use MicroKernelTrait;

	public function registerBundles()
	{
		return array(
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle()
		);
	}

	protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
	{
		// PHP equivalent of config.yml
		$c->loadFromExtension('framework', array(
			'secret' => 'S0ME_SECRET'
		));
	}

	protected function configureRoutes(RouteCollectionBuilder $routes)
	{
		// kernel is a service that points to this class
		// optional 3rd argument is the route name
		$routes->add('/random/{limit}', 'kernel:randomAction');
	}

	public function randomAction($limit)
	{
		return new JsonResponse(array(
			'number' => rand(0, $limit)
		));
	}
}

$kernel = new AppKernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);