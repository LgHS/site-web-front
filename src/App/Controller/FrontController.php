<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
	/**
	 * @Route("/")
	 */
	public function homeAction() {
		$scheduler = $this->get('api_scheduler');
		$scheduler->isOpened();

		return $this->render('front/pages/index.html.twig');
	}

	/**
	 * @Route("/contact")
	 */
	public function contactAction() {
		return $this->render('front/pages/contact.html.twig');
	}
}