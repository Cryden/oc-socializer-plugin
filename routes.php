<?php
use Illuminate\Http\Request;

Route::get('/vk_auth', '\CRYDEsigN\Socializer\Controllers\VkAuth@index');
Route::post('/vk_auth', '\CRYDEsigN\Socializer\Controllers\VkAuth@getToken');
