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


class LinkController extends CrudController {
	use \Illuminate\Console\AppNamespaceDetectorTrait;

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




	/**
	 * GetName Space
	 * @return string
	 */
	public function getNameSpace()
	{
		return $this->getAppNamespace();
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function jai()
	{
		//dd(Config::get("blog.message"));
		return view('BackendViews::master');
	}



}