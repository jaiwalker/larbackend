<?php


    // Normal backend

	Route::group(array('prefix'=>'api/v1/backend'),function()
	{
		Route::any('/{entity}/{methods}/{num}', array('uses' => 'MainController@apientityUrl'));
		Route::any('/{entity}/{methods}', array('uses' => 'MainController@apientityUrl'));

	});



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
		Route::any('/{entity}/{methods}/{params}', array('uses' => 'MainController@entityUrl'));
		Route::any('/{entity}/{methods}', array('uses' => 'MainController@entityUrl'));
		//Route::post('/edit', array('uses' => 'Serverfireteam\Panel\ProfileController@postEdit'));
		//Route::get('/edit', array('uses' => 'Serverfireteam\Panel\ProfileController@getEdit'));

	});
	Route::post('oauth/access_token', function () {
		return Response::json(Authorizer::issueAccessToken());
	});


	Route::controllers([
		'backendAuth' => 'BackendAuthController',
	 	]);
