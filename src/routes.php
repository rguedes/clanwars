<?php
Route::group(['prefix' => '{clan}'], function() {

    Route::group(['prefix' => 'members'], function() {
        Route::get('/', array('as' => 'clan.members.index',  'uses' => 'Wot\Clan\Controllers\Clan\MembersController@getIndex'));
        Route::get('sync', array('as' => 'clan.members.view.post',  'uses' => 'Wot\Clan\Controllers\Clan\MembersController@postMember'));
        Route::get('{id}', array('as' => 'clan.members.view',  'uses' => 'Wot\Clan\Controllers\Clan\MembersController@getMember'));
        Route::post('{id}', array('as' => 'clan.members.view.post',  'uses' => 'Wot\Clan\Controllers\Clan\MembersController@postMember'));

    });

    Route::group(['prefix' => 'battles'], function() {
        Route::get('/', array('as' => 'clan.battles.index',  'uses' => 'Wot\Clan\Controllers\Clan\BattlesController@getIndex'));
        Route::get('{id}', array('as' => 'clan.battles.view',  'uses' => 'Wot\Clan\Controllers\Clan\BattlesController@getMember'));
        Route::post('{id}', array('as' => 'clan.battles.view.post',  'uses' => 'Wot\Clan\Controllers\Clan\BattlesController@postMember'));
    });

    Route::get('payout', function(){
        dd(Route::current()->parameters());
    });
});

Route::group(['prefix' => 'sync'], function() {
    Route::get('tanks', function(){
        dd(Route::current()->parameters());
    });
});

Route::group(['prefix' => 'battles'], function() {
    Route::get('list', array('as' => 'battles.list',  'uses' => 'Wot\Clan\Controllers\Clan\BattlesController@getList'));
    Route::get('parse/{name}', array('as' => 'battles.parse',  'uses' => 'Wot\Clan\Controllers\Clan\BattlesController@parseBattle'));
});


Route::group(['prefix' => 'oauth'], function() {
    Route::get('/', array('as' => 'site.auth.oauth', 'uses' => 'Wot\Clan\Controllers\Site\OauthController@getOpenId'));
    Route::get('check', array('as' => 'site.auth.oauth.check', 'uses' => 'Wot\Clan\Controllers\Site\OauthController@checkOpenId'));
    Route::get('logout', function(){
        Auth::logout();
        Flash::success('Logout');
        return Redirect::to("/");
    });
});
