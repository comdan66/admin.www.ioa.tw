<?php if (!defined ('BASEPATH')) exit ('No direct script access allowed');

Route::root ('main');

Route::get ('/login', 'platform@login');
Route::get ('/logout', 'platform@logout');
