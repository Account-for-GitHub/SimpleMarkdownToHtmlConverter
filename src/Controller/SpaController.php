<?php

namespace App\Controller;

use App\Service\MarkdownToHtmlProcessorService;
use App\Service\MarkdownToHtmlProcessorServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SpaController extends AbstractController
{
	/**
	 * @Route("/")
	 */
	public function index(Environment $twig): Response
	{
		return new Response($twig->render('base.html.twig'));
	}
	
	/**
	 * @Route("/spa_api")
	 * @param Request $request
	 * @param MarkdownToHtmlProcessorService $service
	 * @return JsonResponse
	 */
    public function spa_api(Request $request, MarkdownToHtmlProcessorServiceInterface $service): JsonResponse
    {
		$service->getMarkdownContent($request);
		$service->convertToHtml();
		$service->prepareHtmlContentForDelivery();
		return $this->json($service->getResultHtmlContentInJson());
    }
}
