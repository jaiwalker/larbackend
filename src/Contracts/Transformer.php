<?php

namespace Jai\Backend\Contracts;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
abstract class Transformer
{
	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function transformCollection(array $data)
	{
		//return array_map([$this,'transform']);

		return array_map([$this, 'transform'], $data);
		//dd($shifts_array);
	}

	public abstract function transform($item);


}