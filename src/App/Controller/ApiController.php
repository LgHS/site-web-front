<?php
namespace App\Controller;

use App\Scheduler;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

	/**
	 * @Route("/api/facebook")
	 * @Method({"GET","POST"})
	 */
	public function fbWebhookAction(Request $request) {
		// If Facebook is asking for challenge, return it
		if($request->getMethod() == 'GET' && $request->query->get('hub_challenge')) {
			return new Response($request->query->get('hub_challenge'));
		}

		try {
			$data = json_decode($request->getContent(), true);
			$this->get('logger')->addNotice('data: ', $data['entry'][0]);
		} catch(\Exception $e) {
			$this->get('logger')->error('Could not get data from Facebook Webhook');
		}

		return new Response('');
	}
}