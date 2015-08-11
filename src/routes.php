<?php
Route::group(['prefix' => '{clan}'], function() {

    Route::group(['prefix' => 'members'], function() {
        Route::get('/', array('as' => 'clan.members.index',  'uses' => 'Wot\Clan\Controllers\Clan\MembersController@getIndex'));
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
    Route::group(['prefix' => 'sync'], function() {
        Route::get('members', function(){
            dd(Route::current()->parameters());
        });
    });
});

Route::group(['prefix' => 'sync'], function() {
    Route::get('tanks', function(){
        dd(Route::current()->parameters());
    });
});