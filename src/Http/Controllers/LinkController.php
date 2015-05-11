<?php namespace Jai\Backend\Http\Controllers;

/*
 *
 *   Learning laravel  kora.jayaram@gmail.com
 *   Blog
 *
 */

use App\Http\Controllers\Controller;
//use DataFilter;

use Jai\Backend\Link;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataEdit\DataEdit;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;


class LinkController extends CrudController {
	use \Illuminate\Console\AppNamespaceDetectorTrait;

	protected $dataTransformer;

	public function __construct(ApiLinkDataTransformer $dataTransformer)
	{

		$this->dataTransformer = $dataTransformer;

		//$this->beforeFilter('auth.basic',['on' =>'post']);
	}

	public function all($entity)
	{
		parent::all($entity);
		$this->filter = DataFilter::source(new Link());
		$this->filter->add('id', 'ID', 'text');
		$this->filter->add('display', 'Display', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('id','ID', true)->style("width:100px");
		$this->grid->add('display','Display');
		$this->grid->add('url','Url');
		$this->grid->add('packageName', 'Package Name');
		//$this->grid->link('/'.$entity.'/edit',"Add New", "TR");  // this not added int ot the repo
		$this->addStylesToGrid();
		return $this->returnView();
	}

	public function  edit($entity)
	{
		parent::edit($entity);
		$this->edit = DataEdit::source(new Link());

		Link::creating(function($link)
		{
			//dd(__DIR__);
			//$appHelper = new libs\AppHelper();
			return (true);
			//return ( class_exists( $this->getNameSpace() . $link['url'] ));
			// this Checks if name exists  else  dont
		});

		$this->edit->label('Edit Admin');
		$this->edit->link("dashboard", "Dashboard", "TR")->back();
		$this->edit->add('display', 'Display', 'text');
		$this->edit->add('url', 'link', 'text');
		$this->edit->add('packageName', 'Package Name','text');
		return $this->returnEditView();
	}


	function getAll()
	{
//		parent::getAll();
//		$all = link::all();
//		return $this->respond([
//				'data' => $this->dataTransformer->transformCollection($all->all())
//		]);
	}

	public function getSpecific($package, $id = 1)
	{
		//$model = 'Jai\\Backend\\' . $this->entity;
		$result  = Link::find($id);
		if(!$result)
		{
			return $this->respondNotFound('Record Not found');
		}

		return Response::json([
				'data' =>$this->dataTransformer->transform($result)
		],200);
	}


	/**
	 * GetName Space
	 * @return string
	 */
	public function getNameSpace()
	{
		return $this->getAppNamespace();
	}




}