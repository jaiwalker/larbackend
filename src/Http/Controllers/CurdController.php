<?php
namespace Jai\Backend\Http\Controllers;

/*
* jaikora <kora.jayaram@gmail.com>
*/

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Jai\Backend\Link;
use Illuminate\Routing\Controller;

class CrudController extends ApiController
{
	public $grid;
	public $entity;
	public $set;
	public $edit;
	public $filter;
	protected $lang;



	public function __construct(\Lang $lang)
	{
		// $this->entity = $params['entity'];
		$route          = \App::make('route');
		$this->lang     = $lang;
		$this->route    = $route;
		$routeParamters = $route::current()->parameters();
		$this->setEntity($routeParamters['entity']);
		//$this->curdTransformer = $curdTransformer;

		$this->beforeFilter('auth.basic',['on' =>'post']);
	}

	/**
	 * @param string $entity name of the entity
	 */
	public function edit($entity)
	{

	}

	/**
	 * @param string $entity name of the entity
	 */
	public function all($entity)
	{
		//$this->addStylesToGrid();
	}

	public function getEntity(){
		return $this->entity;
	}

	public function setEntity($entity){
		$this->entity = $entity;
	}

	/**
	 * These Can  be Separated based on roles
	 *  also separate order by  -  and pagination
	 *
	 * @return void
	 */
	public function addStylesToGrid()
	{

		$this->grid->edit('edit', 'Edit', 'modify|delete');

		$this->grid->orderBy('id', 'desc');
		$this->grid->paginate(10);

	}

	public function returnView()
	{
		$configs = Link::returnUrls();

		// Add  Most Common Btn -  roles  has to be implemented
		$this->grid->link('/backend/' . $this->entity . '/edit', "Add New", "TR");  // this not added int ot the repo

		if (!isset($configs) || $configs == null) {
			throw new \Exception('NO URL is set for yet');
		} else if (!in_array($this->entity, $configs)) {
			throw new \Exception('This url is not set yet!');
		} else {
			return \View::make('BackendViews::all', array('grid'           => $this->grid,
														  'filter'         => $this->filter,
														  'current_entity' => $this->entity,
														  'import_message' => (\Session::has('import_message')) ? \Session::get('import_message') : ''));
		}
	}

	public function returnEditView()
	{
		$configs = Link::returnUrls();

		if (!isset($configs) || $configs == null) {
			throw new \Exception('NO URL is set for yet');
		} else {
			if (!in_array($this->entity, $configs)) {
				throw new \Exception('This url is set yet !');
			} else {
				return \View::make('BackendViews::edit', array('edit' => $this->edit));
			}
		}
	}

	public function finalizeFilter(){
		$lang = \App::make('lang');
		$this->filter->submit($this->lang->get('panel::fields.search'));
		$this->filter->reset($this->lang->get('panel::fields.reset'));
	}

	public function getAll()
	{
		//$model = 'Jai/Backend/'.$this->entity;
		//$model = \App::make();
//		$value  = Link::getPackageName($this->entity);
//
//		if(!$value->packageName){
//			$model = 'Jai\\Backend\\'.$this->entity;
//		}else{
//			$model = 'Jai\\'.$value->packageName.'\\'.$this->entity;
//		}
//
//		//$model = 'Jai\\Backend\\Blog';
//		//$model = App::make();
//		$all = $model::all();
//
//         // setStatusCode
//		return $this->respond([
//				'data' => $this->transformCollection($all->all())
//		]);

	}

	public function getSpecific($package,$id=1)
	{
		$model = 'Jai\\Backend\\' . $this->entity;
		$result  = $model::find($id);

		if(!$result)
		{
			return $this->respondNotFound('Record Not found');
		}

		return Response::json([
				'data' =>$this->curdTransformer->transform($result)
		],200);

	}








}