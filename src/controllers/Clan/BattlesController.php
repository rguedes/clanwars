<?php namespace Wot\Clan\Controllers\Clan;

use App\Http\Controllers\Controller;

class BattlesController extends Controller
{
    /**
     * Get list of members
     */
    public function getIndex()
    {
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