<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface MarkdownToHtmlProcessorServiceInterface
{
	public function convertToHtml();
	public function getMarkdownContent(Request $request);
	public function prepareHtmlContentForDelivery();
	public function getResultHtmlContentInJson(): string;
}