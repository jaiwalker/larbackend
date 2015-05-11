<?php

	namespace Jai\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Jai\Backend\Link;
use Illuminate\Support\Facades\Config;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
class MainController extends Controller{
	use \Illuminate\Console\AppNamespaceDetectorTrait;

	public function entityUrl($entity, $methods,$params=NULL){

		$urls = Link::getMainUrls();

		// Check if  its  main url or not
		if ( in_array($entity, $urls)){
			$controller_path = 'Jai\\Backend\\Http\\Controllers\\'.$entity.'Controller';
		} else
		{
		   //  make  sure  you store the package Name
		    $value  = Link::getPackageName($entity);
		    if($value)
			{
				$controller_path = 'Jai\\'. $value->packageName.'\\Http\\Controllers\\' . $entity . 'Controller';
			}
		}

		try{
			$controller = \App::make($controller_path);
		}catch(\Exception $ex){
			 var_dump($ex->getMessage());
			throw new \Exception('No Controller Has Been Set for This Model ');
		}
		if (!method_exists($controller, $methods)){
			throw new \Exception('Controller does not implement the CrudController methods!');
		} else {
			return $controller->callAction($methods, array('entity' => $entity,'params'=>$params));
		}

	}


	public function apientityUrl($entity, $methods,$params=NULL)
	{
		$urls = Link::getMainUrls();
		// Check if  its  main url or not
		if ( in_array($entity, $urls)){
			$controller_path = 'Jai\\Backend\\Http\\Controllers\\'.$entity.'Controller';
		} else
		{
			//  make  sure  you store the package Name
			$value  = Link::getPackageName($entity);
			if($value)
			{
				$controller_path = 'Jai\\'. $value->packageName.'\\Http\\Controllers\\' . $entity . 'Controller';
			}
		}

		try{
			$controller = \App::make($controller_path);
		}catch(\Exception $ex){
		 echo $ex->getMessage();
			throw new \Exception('No Controller Has Been Set for This Model ');
		}
		if (!method_exists($controller, $methods)){
			throw new \Exception('Controller does not implement the CrudController methods!');
		} else {
			//if(!empty($params))$methods .=$methods.'/'.$params;
			return $controller->callAction($methods, array('entity' => $entity,'param'=>$params));
		}

	}

	public function getNameSpace(){

		return $this->getAppNamespace();
	}


}