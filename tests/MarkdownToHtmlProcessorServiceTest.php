<?php

namespace App\Tests;

use App\Service\MarkdownToHtmlProcessorService;
use App\Service\MarkdownToHtmlProcessorServiceInterface;
use PHPUnit\Framework\TestCase;

class MarkdownToHtmlProcessorServiceTest extends TestCase
{
	
	const TEST_MARKDOWN_TEXT = '*text text text
								 text text text*
								 
								_text text text 
								 text text text_
								
								**text text text 
								text text text**
								
								__text text text 
								text text text__
								
								***text text text
								 text text text***
								 
								___text text text
								text text text___
								
								 *a*
								 **a**
								 ***a***
								 _a_
								 __a__
								 ___a___
								
								* text *
								\*text\*
								_ text _
								
								*text
								**text
								***text
								*
								**
								***
								
								_text
								__text
								___text
								_
								__
								___
								
								*text text **text
								 text** text text*
								 
								**text text *text
								 text* text text**
								 
								*text text ***text
								 text*** text text*
								 
								 <script ></script>
								 <style ></style>
								 <iframe ></iframe>';
	
    public function testMarkdownReplacementPatterns(): void
    {
		$service = new MarkdownToHtmlProcessorService();
		$service->markdownContent = self::TEST_MARKDOWN_TEXT;
		$number_of_replacements_done = $service->convertToHtml();
        $this->assertTrue($number_of_replacements_done == 20, 
			'Failure, patterns do not work as expected, '
			.$number_of_replacements_done.' replacements done, and should be 20');
    }
}
