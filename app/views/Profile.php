<?php
    $user = $GLOBALS['user'];
?>

<!doctype html>
<html>
<head>
    
    <meta charset="utf-8">
    <title>Twotter - <?= $user['username']; ?></title>
    
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
            <div class="title"><?= $user['username']; ?></div>
            <div class="text">
                <?= $user['bio']; ?>
            </div>
        </div>

        <div style="width: 100%; margin-top: 64px;"></div>
        <?php
            idMessager::getTwootsById( idSecurity::StringToUnharmful( $user['id'] ), idModeratorTools::isModerator( $_SESSION['id'], $GLOBALS['db'] ), $GLOBALS['db'] );
        ?>
        
    </div>

</body>
</html>