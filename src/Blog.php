<?php

namespace Jai\Backend;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
class Blog extends Model{

	protected $table = 'blogs';

	protected $fillable = array('name', 'slug','description');

}