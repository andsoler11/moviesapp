<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Signup</title>
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Movie List</header>



            <form action="<?php echo constant('URL'); ?>/signup/newUser" enctype="multipart/form-data" method="POST">
                    <?php if ($this->showMessages()) {?>
                        <div class="error-txt"><?php $this->showMessages(); ?></div>
                    <?php  } ?>
                   

                    <div class="field input">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Enter your username"  value="<?php // if(isset($fname)){ echo $fname;} ?>">
                    </div>
     

                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Enter your email"  value="<?php // if(isset($email)){ echo $email;} ?>">
                    </div>
            
                    <div class="field input">
                        <label>Phone number</label>
                        <input type="text" name="phone" placeholder="Enter your phone number" >
                    </div>

                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter new password" >
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" name="accion" value="Submit">
                    </div>
                
            </form>
            <div class="link">Already Signed up? <a href="<?php echo constant('URL'); ?>/login">Login now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>



</html>