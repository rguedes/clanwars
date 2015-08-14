<?php namespace Wot\Clan\Controllers\Clan;

use App\Http\Controllers\Controller;
use File;
use Wot\Clan\Helpers\Replay;

class BattlesController extends Controller
{
    /**
     * Get list of members
     */
    public function getIndex()
    {
        return "getIndex";
    }

    public function getList(){
        foreach(File::files(storage_path("clanwars")) as $file){
            echo '<a href="parse/'.basename($file).'">'.basename($file).'</a><br />';
        }
    }

    public function parseBattle($name){
        $replay = new Replay(storage_path("clanwars/".$name));
        $json = $replay->parse();


        dd($json);
    }
}