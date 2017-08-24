<?php
/**
*
* This plugin enabled steam api for the cms
* It will create a user and can be used for login!
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Plugins\SteamAPI;

use Solaria\Plugins\BasePlugin;
use Solaria\Application\Models\User;

class SteamAPI extends BasePlugin {

    public function run() {
        $conf = $this->di->get('mainConf')['login'];
        $response = $this->di->get('Response');
        $request = $this->di->get('Request');
        $session = $this->di->get('Session');
        $_STEAMAPI = $conf['api_key'];
        $openid = new \LightOpenID($conf['url']);

        if(!$openid->mode) {
            if($request->isPost()) {
                $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
                header('Location: ' . $openid->authUrl());
            }
        } else if($openid->mode == 'cancel') {
            $response->redirect('acp/user/sing-up');
        } else {
            if($openid->validate()) {
                    $id = $openid->identity;
                    // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
                    // we only care about the unique account ID at the end of the URL.
                    $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                    preg_match($ptn, $id, $matches);

                    $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
                    $json_object= file_get_contents($url);
                    $json_decoded = json_decode($json_object);
                    $newPlayer = null;
                    foreach ($json_decoded->response->players as $player) {
                        $newPlayer = $player;
                    }
                    $user = User::findBy(array('steam_id' => $newPlayer->steamid));
                    //Check if we have the user allready
                    if(count($user) == 0) {
                        //We dont have the user, so lets create him!
                        $user = new User();
                        $user->setUsername($newPlayer->personaname);
                        $user->setPassword('');
                        $user->setSteamId($newPlayer->steamid);
                        $user->setSteamAvatar($newPlayer->avatarmedium);
                        $user->save($user);
                    }
                    $session->set('user', $user);
                    $this->di->get('Response')->redirect('');

            }
        }
    }

}
