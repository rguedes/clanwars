<?php namespace Wot\Clan\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Wot\Clan\Helpers\LightOpenID;
use Redirect;
use Request;
use Config;
use Wot\Clan\Models\User;
use Auth;
use Flash;

class OauthController extends Controller {

    public function getOpenId(){
        $openid = new LightOpenID(Config::get('app.domain'));
        $openid->identity = 'http://eu.wargaming.net/id/';
        $openid->returnUrl = Config::get('app.url').'/oauth/check';
        return Redirect::to($openid->authUrl());
    }

    public function checkOpenId(){
        //dd(Request::all());
        if (Request::has('openid_mode')) {
            $openid = new LightOpenID(Config::get('app.domain'));
            if ($openid->mode) {
                    if($openid->validate() ){
                        $identify = Request::input('openid_identity');
                        $user = User::where("oauth_identity",$identify)->first();
                        if($user){
                            Auth::login($user);
                            Flash::success('Login successfully');
                        }else{
                            Flash::error('Invalid user');
                        }
                    }else{
                        Flash::success('Invalid auth');
                    }
            }else{
                Flash::warning('Authentication canceled');
            }
            return Redirect::to('/');
            /*
            if ($_GET['openid_mode'] == 'cancel') {
                $err = Yii::t('core', 'Authorization cancelled');
            } else {
                try {
                    if( $loid->validate() )
                    {
                        $identity=new UserIdentity($_GET['openid_identity']);
                        $identity->authenticate();
                        switch($identity->errorCode)
                        {
                            case UserIdentity::ERROR_NONE:
                                $duration=0; // 30 days
                                Yii::app()->user->login($identity,$duration);
                                $this->redirect(Yii::app()->homeUrl);
                                break;
                            case UserIdentity::ERROR_USERNAME_INVALID:
                                EUserFlash::setErrorMessage('Not exist user.');
                                $this->redirect(Yii::app()->homeUrl);
                                break;
                            default: // UserIdentity::ERROR_PASSWORD_INVALID
                                EUserFlash::setErrorMessage('Ocorreu um erro.');
                                $this->redirect(Yii::app()->homeUrl);
                                break;
                        }
                    }
                    else
                    {
                        EUserFlash::setErrorMessage('Falhou autenticação.');
                        $this->redirect(Yii::app()->homeUrl);
                    }
                } catch (Exception $e) {
                    $err = Yii::t('core', $e->getMessage());
                }
            }
            if(!empty($err)) echo $err;*/
        }
    }
}