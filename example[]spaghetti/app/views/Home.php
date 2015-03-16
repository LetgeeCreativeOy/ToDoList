<!doctype html>
<html>
<head>
    
    <meta charset="utf-8">
    <title>Twotter</title>
    
    <link rel="icon" type="image/png" href="imgs/logo.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    
    <script src="js/jquery.js"></script>
    <script src="js/System.js"></script>
    
</head>
<body>
    
    <div id="topbar">
        
        <a href="index.php" id="logo">Twotter</a>
        
        <nav>
            <a href="profile.php">You</a>
            <a href="#">Settings</a>
            <a href="logout.php">Log out</a>
        </nav>
        
    </div>
    
    <div id="content">
                
        <div id="entry">
            <div class="title">Create new Twoot<span id="charsLeft" style="font-size: 12px;"></span><img id="banButton" src="imgs/reload.png" onclick="Refresh();"></img></div>
            <div class="text">
                <div id="twootForm">
                    <textarea id="newTwoot" placeholder="Write something..."></textarea><br>
                    <input type="submit" name="submit" value="Post" id="postBtn" onclick="PostTwoot()" />
                </div>
            </div>
        </div>
        
        <div id="twoots">
            
        </div>
        
    </div>
    
    <script>GetTwoots();</script>
    <script>CheckLenght();</script>
</body>
</html>