<?php

namespace Jai\Backend\Http\Controllers;
use Jai\Backend\Blog;

use DataFilter;
use Illuminate\Support\Facades\Config;
use Jai\Backend\Contracts\BackendInterface;


/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
class BlogcategoryController extends CrudController implements BackendInterface {


	public function all($entity)
	{
		parent::all($entity);
		$this->filter = DataFilter::source(new Blog());
		$this->filter->add('id', 'ID', 'text');
		$this->filter->add('name', 'Name', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('id','ID', true)->style("width:100px");
		$this->grid->add('name','name');
		$this->grid->add('slug','slug');

		$this->addStylesToGrid();
		return $this->returnView();
	}

	public function  edit($entity)
	{
		parent::edit($entity);
		$this->edit = \DataEdit::source(new Blog());

		Blog::creating(function($blog)
		{
			//dd(__DIR__);
			//$appHelper = new libs\AppHelper();
			return (true);
			//return ( class_exists( $this->getNameSpace() . $link['url'] ));
			// this Checks if name exists  else  dont
		});

		$this->edit->label('Edit Blog Category');
		$this->edit->link("dashboard", "Dashboard", "TR")->back();
		$this->edit->add('name', 'Name', 'text');
		$this->edit->add('description', 'Description', 'textarea');
		$this->edit->add('slug', 'Slug', 'text');
		$this->edit->add('publication_date', 'Date', 'date')->format('d/m/Y', 'it');
		$this->edit->add('photo', 'Photo', 'image')->move('uploads/demo/')->fit(240, 160)->preview(120, 80);
		$this->edit->add('public', 'Public', 'checkbox');
		$this->edit->add('categories.name', 'Categories', 'tags');
		$this->edit->add('detail.note', 'Note', 'textarea')->attributes(array('rows' => 2));
		$this->edit->add('body', 'Body', 'redactor');
		return $this->returnEditView();
	}






}