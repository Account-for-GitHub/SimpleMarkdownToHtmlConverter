<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class MarkdownToHtmlProcessorService implements MarkdownToHtmlProcessorServiceInterface
{
	
	public $markdownContent;
	public $resultHtmlContent;
	public $resultHtmlContentInJson;
	const PATTERNS_ARRAY = [
			//Italic
			'#([^\*]|^)\*(\w(\w|\s|<|>|/)*\w)\*([^\*]|$)#',				// *text text*
			'#([^\*]|^)\*(\w|<|>|/)+\*([^\*]|$)#',						// *text*
			'#([^_]|^)_([^_\s](\w|\s|<|>|/)*[^_\s])_([^_]|$)#',			// _text text_
			'#([^_]|^)_([^_\s]|<|>|/)+_([^_]|$)#',						// _text_
			//Strong
			'#([^\*]|^)\*\*(\w(\w|\s|<|>|/)*\w)\*\*([^\*]|$)#',			// **text text**
			'#([^\*]|^)\*\*(\w|<|>|/)+\*\*([^\*]|$)#',					// **text**
			'#([^_]|^)__([^_\s](\w|\s|<|>|/)*[^_\s])__([^_]|$)#',			// __text text__
			'#([^_]|^)__([^_\s]|<|>|/)+__([^_]|$)#',						// __text__
			//Strong Italic
			'#([^\*]|^)\*{3}(\w(\w|\s|<|>|/)*\w)\*{3}([^\*]|$)#',			// ***text text***
			'#([^\*]|^)\*{3}(\w|<|>|/)+\*{3}([^\*]|$)#',					// ***text***
			'#([^_]|^)_{3}([^_\s](\w|\s|<|>|/)*[^_\s])_{3}([^_]|$)#',		// ___text text___
			'#([^_]|^)_{3}([^_\s]+)_{3}([^_]|$)#',					// ___text___
			//Safety
			'#<script.*>|</script.*>|<style.*>|</style.*>|<iframe.*>|</iframe.*>#',
		];
	const REPLACEMENTS_ARRAY = [
			'\1<i>\2</i>\4',
			'\1<i>\2</i>\4',
			'\1<i>\2</i>\4',
			'\1<i>\2</i>\4',
			'\1<strong>\2</strong>\4',
			'\1<strong>\2</strong>\4',
			'\1<strong>\2</strong>\4',
			'\1<strong>\2</strong>\4',
			'\1<strong><i>\2</i></strong>\4',
			'\1<strong><i>\2</i></strong>\4',
			'\1<strong><i>\2</i></strong>\4',
			'\1<strong><i>\2</i></strong>\4',
			'',
		];
	
	public function getMarkdownContent(Request $request){
		$markdownContentArray = json_decode($request->getContent(), true);
		$this->markdownContent = $markdownContentArray['markdown_text'];
	}
	
	public function convertToHtml()
	{
		$sum_number_of_replacements = 0;
		$need_converting = true;
		while($need_converting){
			$this->markdownContent = preg_replace(
				self::PATTERNS_ARRAY,
				self::REPLACEMENTS_ARRAY,
				$this->markdownContent,
				-1,
				$number_of_replacements_done);
			$need_converting = $number_of_replacements_done ? true : false;
			$sum_number_of_replacements += $number_of_replacements_done;
		}
		$this->resultHtmlContent = $this->markdownContent;
		return $sum_number_of_replacements;
	}
	
	public function prepareHtmlContentForDelivery()
	{
		$this->resultHtmlContentInJson = json_encode(["html_content" => $this->resultHtmlContent]);
	}
	
	public function getResultHtmlContentInJson(): string
	{
		return $this->resultHtmlContentInJson;
	}
}