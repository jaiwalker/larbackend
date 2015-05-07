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

		if ( in_array($entity, $urls)){
			$controller_path = 'Jai\\Backend\\Http\\Controllers\\'.$entity.'Controller';
		} else {
			//  this is if  you  have controllers set
//			$panel_path = \Config::get('panel.controllers');
//			if ( isset($panel_path) ){
//				$controller_path = '\\'.$panel_path.'\\'.$entity.'Controller';
//			} else {

				$controller_path = $this->getNameSpace().'Http\Controllers\\'.$entity.'Controller';
		    // $controller_path ='Jai\\Page\\Http\\Controllers\\' . $entity . 'Controller';
		     $controller_path ='Jai\\Backend\\Http\\Controllers\\' . $entity . 'Controller';
			}
		//}

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