<!DOCTYPE html>
<?php require'steamauth/steamauth.php' ?>


<html>
   <head>
       <title>Random Steam</title>
       <!-- Insert Meta Data -->
       <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
       <link rel="stylesheet" href="css/styles.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>
<body>
   <?php if(!isset($_SESSION['steamid'])) { ?>
        <div class="login-container">
        <h1>Welcome to Random Steam</h1>
        <h3>Login to your Steam Account and we will randomly pick a game for you to play from your library</h3>
        <?php loginbutton("rectangle"); //login button ?>
       </div>

<?php }  else { ?>
    
    <?php include ('steamauth/userInfo.php'); //To access the $steamprofile array
    //Protected content?>
    <div class="user-info">
        <h3 class="name">Welcome <?php echo $steamprofile['personaname'] ?></h3>
        <?php $profileimage = $steamprofile['avatar'] ?>
        <img class ="avatar" src="<?php echo $profileimage ?>" alt="">
        <div class="logout"> 
            <?php logoutbutton(); //Logout Button ?> 
        </div>
    </div>
        <p id="demo"></p>

    <?php include 'library.php';
    $final = $gameinfo; ?>
    <div class="library">
        <?php library($nameslength, $gamename, $gameappid, $gameimage) ?>
    </div>
    <div class="random" onload="randomize()">
        <div class="randomname">
        <h3>You Should Play...</h3>
        <p  class="randomWidth" id="randomnamep"></p> <!-- Game Name -->
        <img src="" alt="" class="randomWidth"  id="randomImage"> <!-- Game Image -->
        <br>
        <br>
        <div class="btn-container">
        <button onclick="randomize" id="randombtn" class="main-btn">Randomize</button> 
        <br>
            <button class="main-btn launch"><a href="" id="launcher">Launch</a></button>
        </div>
        </div>
        
    </div>
    <div class="sidebar">
        <div class="desktop" style="width: 100%; height: 85%; max-height: 560px; background: #428bca; color: #fff; line-height: 600px; text-align: center; ">SKYSCRAPER</div>
        <div class="social-media">
        <ul>
            <li><a class="facebook social-media" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fsteam%2Findex.php&amp;src=sdkpreparse" target="_blank"><img src="assets/facebook.png"></a></li>
            <li><a class="twitter social-media" href="/twitter.com/intent/tweet/?text=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.&amp;url=http%3A%2F%2Fsharingbuttons.io" target="_blank"
><img src="assets/twitter.png"></a></li>   
            <li><a class="facebook social-media" href="#"><img src="assets/facebook.png"></a></li>   
        </ul>
        </div>
        <div class = "mobile" style="width: 100%; height: 50px; background: #428bca; color: #fff; line-height: 50px; text-align: center;  margin-top: 10px; margin-bottom: 10px; ">MOBILE BANNER</div>

    </div>
<?php }    ?>


<script type="text/javascript">
            var gameInfo = JSON.parse( '<?php echo json_encode($final) ?>' );
            var gameInfoString = JSON.stringify(gameInfo);
            var btn = document.getElementById('randombtn');
            var loadDiv = document.getElementsByTagName("BODY")[0];
            var launcher = document.getElementById('launcher');
    
            //Generate Random Steam Game on Load
            loadDiv.onload = function randomize(){
                var randomName = gameInfo.name[Math.floor(Math.random()*gameInfo.name.length)];
                var randomNameIndex = jQuery.inArray(randomName, gameInfo.name);
                var appid = gameInfo.appid[randomNameIndex];
                var imageSrc= gameInfo.image[randomNameIndex];
                $("#randomnamep").text(randomName);
                document.getElementById('randomImage').src = "http://media.steampowered.com/steamcommunity/public/images/apps/" + appid + "/" + imageSrc + ".jpg";
                $('#randomImage').attr('alt', randomName);
                $('#launcher').attr('href', 'steam://run/' + appid);
                
            }
    
            //Generate Random Steam Game on Button Click
            btn.onclick = function randomize(){
                var randomName = gameInfo.name[Math.floor(Math.random()*gameInfo.name.length)];
                var randomNameIndex = jQuery.inArray(randomName, gameInfo.name);
                var appid = gameInfo.appid[randomNameIndex];
                var imageSrc= gameInfo.image[randomNameIndex];
                $("#randomnamep").text(randomName);
                document.getElementById('randomImage').src = "http://media.steampowered.com/steamcommunity/public/images/apps/" + appid + "/" + imageSrc + ".jpg";
                $('#randomImage').attr('alt', randomName);
                $('#launcher').attr('href', 'steam://run/' + appid);
            }
</script>

</body>
</html>