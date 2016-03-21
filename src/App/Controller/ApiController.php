<?php
namespace App\Controller;

use App\ApiScheduler;
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
		/** @var ApiScheduler $scheduler */
		$scheduler = $this->container->get('api_scheduler');

		$template = $this->renderView('api/index.json.twig', array(
			'isOpened' => $scheduler->isOpened()
		));

		return new Response($template, 200, array('Content-Type'=>'application/json'));
	}
}