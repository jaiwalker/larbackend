<?php

namespace Jai\Backend\Http\Controllers;

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