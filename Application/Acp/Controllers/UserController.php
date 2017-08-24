<?php
namespace Solaria\Application\Acp\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;

use Solaria\Application\Models\User;

class UserController extends BaseController {

    public function singUpAction() {

        //AS_TODO: Move this in the plugin class! And add some user checks!
        $_STEAMAPI = $this->di->get('mainConf')['login']['api_key'];
        $openid = new \LightOpenID('http://localhost/Solaria-CMS/');
        if(!$openid->mode) {
            if($this->request->isPost()) {
                $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
                header('Location: ' . $openid->authUrl());
            }
        } else if($openid->mode == 'cancel') {
            $this->response->redirect('acp/user/sing-up');
        } else {
            if($openid->validate()) {
                    $id = $openid->identity;
                    // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
                    // we only care about the unique account ID at the end of the URL.
                    $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                    preg_match($ptn, $id, $matches);
                    //echo "User is logged in (steamID: $matches[1])\n";

                    $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
                    $json_object= file_get_contents($url);
                    $json_decoded = json_decode($json_object);
                    $newPlayer;
                    foreach ($json_decoded->response->players as $player) {
                        $newPlayer = $player;
                        //echo $player->steamid  $player->personaname player->profileurl $player->avatarmedium
                    }
                    $user = new User();
                    $user->setUsername($newPlayer->personaname);
                    $user->setPassword('');
                    $user->setSteamId($newPlayer->steamid);
                    $user->setSteamAvatar($newPlayer->avatarmedium);
                    $user->save($user);

            }
        }
    }

}
