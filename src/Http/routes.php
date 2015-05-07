<?php



//'middleware' => 'Jai\\Http\\Middleware\\BackendAuthenticate'
	Route::group(array('prefix' => 'backend', 'middleware' => 'Jai\\Http\\Middleware\\BackendAuthenticate' ), function()
	{
		// main page for the admin section (app/views/admin/dashboard.blade.php)
		Route::get('/', function()
		{
			return View::make('BackendViews::dashboard');
		});

		//Route::get('/createUser', array('uses' => 'Serverfireteam\Panel\UsersController@getCreateUser'));
		//Route::post('/createUser', array('uses' => 'Serverfireteam\Panel\UsersController@postCreateUser'));
		//Route::any('/{entity}/export/{type}', array('uses' => 'Serverfireteam\Panel\ExportImportController@export'));
//		Route::post('/{entity}/import', array('uses' => 'Serverfireteam\Panel\ExportImportController@import'));
		Route::any('/{entity}/{methods}', array('uses' => 'MainController@entityUrl'));
		//Route::post('/edit', array('uses' => 'Serverfireteam\Panel\ProfileController@postEdit'));
		//Route::get('/edit', array('uses' => 'Serverfireteam\Panel\ProfileController@getEdit'));

	});


	Route::controllers([
		'backendAuth' => 'BackendAuthController',
	 	]);


	//Route::get('backend/login', 'BackendAuthController@getlogin');
	//Route::post('backend/login', 'BackendAuthController@getlogin');
