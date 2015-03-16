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
        
        <div id="loginForm">
            
            <form action="login.php" method="post">
                
                <table>
                    
                    <td>
                        <input type="text" name="username" placeholder="Username" />
                    </td>
                    
                    <td>
                        <input type="password" name="password" placeholder="Password" />
                    </td>
                    
                    <td>
                        <input type="submit" name="submit" value="Log in" />
                    </td>
                    
                </table>
                
            </form>
            
        </div>
        
    </div>
    
    <div id="content">
        
        <div id="entry">
            <div class="title">Twotter</div>
            <div class="text">
                {{Add some text here}}
            </div>
        </div>
        
        <div id="entry">
            <div class="title">Join to Twotter</div>
            <div class="text">
                <div id="registerForm">
            
                    <form action="register.php" method="post">
                        
                        <table>
                            
                            <td>
                                <input type="text" name="username" placeholder="Username" />
                            </td>
                            <tr/>
                            
                            <td>
                                <input type="password" name="password" placeholder="Password" />
                            </td>
                            <tr/>
                            
                            <td>
                                <input type="password" name="repassword" placeholder="Re-Password" />
                            </td>
                            <tr/>
                            
                            <td>
                                <input type="submit" name="submit" value="Register" />
                            </td>
                            
                        </table>
                        
                    </form>
            
                </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>