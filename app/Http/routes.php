<?php

use App\Task;
use App\TaskList;
use Illuminate\Http\Request;

/**
 * Show Task Dashboard
 */


Route::get('/', 'ListController@Index');


Route::resource('TaskList', 'ListController');

Route::resource('Task', 'TaskController');


Route::any('Filter', ['as' => 'TaskList.Filter',
						'uses' => 'ListController@Filter']);

Route::auth();

Route::get('/home', 'HomeController@index');

