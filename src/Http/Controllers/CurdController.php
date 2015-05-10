<?php
namespace Jai\Backend\Http\Controllers;

/*
* jaikora <kora.jayaram@gmail.com>
*/

use Jai\Backend\Link;
use Illuminate\Routing\Controller;

class CrudController extends Controller
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


}