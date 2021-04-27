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
            <h2>Update Course</h2>
        </div>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post" class="form" id="form">
            <!--Title-->
            <div class="form-control ">
                <label for="title">Course Title</label>
                <input type="text" placeholder="title" id="title" name="title" value="<?php echo $course->title; ?>">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>                
                    <span>                    
                        <?php echo $err["title"]; ?>
                    </span>                                                
            </div>
            <!--Description-->
            <div class="form-control ">
                <label for="description">Description</label>
                <textarea type="text" placeholder="description" id="description" name="description" value="<?php echo $user->email; ?>">
                </textarea>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>                
                    <span>                    
                        <?php echo $err["description"]?>
                </span>               
               
            
            <!--Submit-->
            <button>Update</button>
           
        </form>
    </div>
    
</body>
</html>