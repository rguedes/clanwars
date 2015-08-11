<?php namespace Wot\Clan\Controllers\Clan;

use App\Http\Controllers\Controller;
use Wot\Clan\Helpers\Api;
use Session;
use Route;

class MembersController extends Controller
{

    public function __construct(){
        Api::setRegion("eu");
        Api::setApplicationId('cba9bfbfc93ed03d2ee25efe54a6aec6');
    }
    /**
     * Get list of members
     */
    public function getIndex()
    {
        $params = Route::current()->parameters();
        $clanTag = strtoupper($params['clan']);
        $clanId = null;

        if($clanTag != ""){
            $_clan = Api::wgn()->clans->list(array("search"=>$clanTag, "fields"=>"tag,clan_id"));
            foreach ($_clan as $clan) {
                if($clan->tag == $clanTag){
                    $clanId = $clan->clan_id;
                    break;
                }
            }
            if($clanId){
                dd(Api::wgn()->clans->info(array("clan_id"=>$clanId))); // Получает список техники
            }
        }
        return "getIndex";
    }

    /**
     * Get member
     */
    public function getMember()
    {
        return "getMember";
    }

    /**
     * Post data from member
     */
    public function postMember()
    {
        return "postMember";
    }
}