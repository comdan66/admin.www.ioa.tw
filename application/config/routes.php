<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Route::root ('main');

Route::get ('/login', 'platform@login');
Route::get ('/logout', 'platform@logout');

Route::get ('admin', 'admin/main@index');

Route::group ('admin', function () {
  Route::resourcePagination (array ('banners'), 'banners');
  Route::resourcePagination (array ('tags'), 'tags');
  Route::resourcePagination (array ('homes'), 'homes');
  Route::resourcePagination (array ('licenses'), 'licenses');
  Route::resourcePagination (array ('devs'), 'devs');
  Route::resourcePagination (array ('blogs'), 'blogs');
  Route::resourcePagination (array ('unboxings'), 'unboxings');
  Route::resourcePagination (array ('albums'), 'albums');
  Route::resourcePagination (array ('stars'), 'stars');
  Route::resourcePagination (array ('deploys'), 'deploys');
});