<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>">
    <script src="https://kit.fontawesome.com/96606bc35b.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to our blog </h2>
        </div>        
        <div >
        <h3><?php
         echo $title ?></h3>        
        <p><?php
         echo $description ?></p> 
       
        <a href="update.php?id=<?php echo $id; ?>">
        <button  style="background-color: blueviolet;
    color: white;
    width: 50%;
    font-size: 16px;
    font-family: inherit;   
    border-radius: 5px;
    display: block;
    padding: 5px;
    margin:10px;">
                Update
            </button>
            </a>
            <a href="delete.php?id=<?php echo $id; ?>">
            <button  style="background-color: blueviolet;
    color: white;
    width: 50%;
    font-size: 16px;
    font-family: inherit;   
    border-radius: 5px;
    display: block;
    padding: 5px;
    margin:10px;"  
    >Delete </button>
    </a>
        </div>         
    </div>    
</body>
</html>