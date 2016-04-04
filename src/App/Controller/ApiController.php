<?php
namespace App\Controller;

use App\Scheduler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
	/**
	 * @Route("/api/")
	 */
	public function indexAction() {
		/** @var Scheduler $scheduler */
		$scheduler = $this->container->get('scheduler');

		$template = $this->renderView('api/index.json.twig', array(
			'isOpened' => $scheduler->isOpened()
		));

		return new Response($template, 200, array(
			'Content-Type'=>'application/json',
			'Access-Control-Allow-Origin' => '*',
			'Cache-Control' => 'no-cache'
		));
	}
}