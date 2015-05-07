<?php

namespace Jai\Backend;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
class Blog extends Model{

	protected $table = 'blogs';

//	public static function returnUrls(){
//		$configs = Link::all();
//		$allUrls = array();
//
//		foreach ( $configs as $config ){
//			$allUrls[] = $config['url'];
//		}
//		return $allUrls;
//	}

	public static function getMainUrls(){
		$configs = Link::where('main', '=', true)->get();
		$mainUrls = array();

		foreach ( $configs as $config ){
			$mainUrls[] = $config['url'];
		}
		return $mainUrls;
	}

	//where('url', '=', 'Admin')->take(1)->get()

	public function getAndSave($url, $display){
		$this->url = $url;
		$this->display = $display;
		$this->save();
	}


	protected $fillable = array('name', 'slug','description');

}