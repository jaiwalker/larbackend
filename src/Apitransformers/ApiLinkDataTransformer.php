<?php

namespace Jai\Backend\Apitransformers;
use Jai\Backend\Contracts\Transformer;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
class ApiLinkDataTransformer extends Transformer
{

	public function transform($item)
	{
		return [
				'id' =>(int)$item['id'],
				'url' =>$item['url'],
				'display' => $item['display'],
				'main'=>(boolean)$item['main'],
		];
	}
}