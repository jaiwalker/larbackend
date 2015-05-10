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

	public function entityUrl($entity, $methods){

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
			throw new \Exception('No Controller Has Been Set for This Model ');
		}
		if (!method_exists($controller, $methods)){
			throw new \Exception('Controller does not implement the CrudController methods!');
		} else {
			return $controller->callAction($methods, array('entity' => $entity));
		}

	}

	public function getNameSpace(){

		return $this->getAppNamespace();
	}


}