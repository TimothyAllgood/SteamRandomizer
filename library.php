<?php 
require 'steamauth/SteamConfig.php';
require ('steamauth/userInfo.php');

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_URL,"https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/?key=".$steamauth['apikey']."&format=json&steamid=".$_SESSION['steam_steamid']."&include_appinfo=1&appids_filter=");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
$data = curl_exec($ch);

$json = json_decode($data, true);

curl_close($ch);


/*$library = file_get_contents("https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/?key=".$steamauth['apikey']."&format=json&steamid=".$_SESSION['steam_steamid']."&include_appinfo=1&appids_filter="); 
$json = json_decode($library, true);*/



$gamename = $json['response']['games'][0]['name'];

$gamename = array_column($json['response']['games'], 'name');
$gameimage = array_column($json['response']['games'], 'img_logo_url');
$gameappid = array_column($json['response']['games'], 'appid');

$nameslength = count($gamename);

/*foreach($names as $value){
    echo "$value <br>";
}*/

function library ($nameslength, $gamename, $gameappid, $gameimage){
for($i=0; $i < $nameslength; $i++){
    echo "<h3 class='gamename'>$gamename[$i]</h3>";
    $image = "http://media.steampowered.com/steamcommunity/public/images/apps/".$gameappid[$i]."/".$gameimage[$i].".jpg";
    echo '<img src='.$image.' alt='.$gamename[$i].'> <br>';
    
} 
}
    $gameinfo = array(
    
            'name' => $gamename,
            'appid' => $gameappid,
            'image' => $gameimage
    
    );

    
    

/*print_r($gameinfo);*/



/*function randomize ($gamename, $gameappid, $gameimage){

    $random = $gamename[array_rand($gamename)];
    $randomkey = array_search($random, $gamename);
    $randomappid = $gameappid[$randomkey];
    $randomimage = $gameimage[$randomkey];
    echo "<h1 class='randomname'>".$random."</h1>";
    $mainimage = "http://media.steampowered.com/steamcommunity/public/images/apps/".$randomappid."/".$randomimage.".jpg";
    echo '<img src='.$mainimage.'> <br>';
    
}*/



?>

