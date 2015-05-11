<?php

namespace Jai\Backend\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Jai\Page\Http\Controllers\PageDataTransformer;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
class ApiController extends Controller
{

	protected $statusCode = 200;

	/**
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param mixed $statusCode
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	public function respondNotFound($message = 'Not Found')
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}

	public function respondInternalError($message = 'Internal Error')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}

	public function respondAuthenticationError($message = 'Auth Error')
	{
		return $this->setStatusCode(401)->respondWithError($message);
	}

	public function respond($data,$headers=[])
	{
		return Response::json($data,$this->getStatusCode(),$headers);
	}

	public function respondWithError($message)
	{
		return $this->respond([
				'error'=>[
						'message'=>$message,
						'status_code' =>$this->getStatusCode()
				]
		]);
	}

    // all this  to abstract clas
	public function transformCollection(array $data)
	{
		//return array_map([$this,'transform']);

		return array_map([$this, 'apiDatatransform'], $data);
		//dd($shifts_array);
	}

	public function getApiAllData($transform,$data)
	{
		//$transform = new PageDataTransformer();
		return $this->respond(['data' => $transform->transformCollection($data->all())]);

	}

	public function getApiSpecificData($transform,$result)
	{
		if (!$result) {
			return $this->respondNotFound('Record Not found');
		}

		return Response::json(['data' => $transform->transform($result)], 200);
	}




}