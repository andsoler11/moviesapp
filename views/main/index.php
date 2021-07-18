<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Login</title>
</head>
<body>

<div class="body-wraper-finapp">
    <div class="wrapper-finapp">
        <header class="chat-header">
            <div class="header-container">
            
                <div class="header-elem-left">
                    <form action="<?php echo constant('URL'); ?>/main/logout" method="POST">
                        <input type="submit" name="action" value="Logout" class="logout">
                    </form>
                </div>

                <div class="header-elem-right">
                    <form action="<?php echo constant('URL'); ?>/main/updateMovies" method="POST">
                        <input type="submit" name="action" value="Update movie list" class="update-movie">
                    </form>
                </div>
               
            </div>
        </header>
            
        
        <section class="body-chat">
            <div class="nav-container-search">
                <form action="" method="POST">
                    <input type="text" name="search" placeholder="Search..." class="input-search" value="<?php   if(isset($search)){ echo $search;} ?>">
                    <label >From</label>
                    <input type="number" name="fromYear" placeholder="YYYY" class="input-year" value="<?php   if(isset($fromYear)){ echo $fromYear;} ?>"> 
                    <label >To</label>
                    <input type="number" name="toYear" placeholder="YYYY" class="input-year" value="<?php  if(isset($toYear)){ echo $toYear;} ?>"> 

                    <input type="submit" name="action" value="Submit" class="submit-button">
                </form>
            </div>
            <div class="movies-container">
                <div class="movie-list">
                    <div class="table-header">
                        <div class="movie-title">Title</div>
                        <div class="movie-year">Year</div>
                        <div class="movie-type">Type</div>
                        <div class="movie-poster">Poster</div>
                    </div>
                    <div class="table-body">
                        <p><?php  $this->showData();  ?></p>
                        
                        <?php // if(isset($message)) : ?>
                            <div class="message-container">
                                <div class="no-match-message">
                                    <?php // echo $message ?>
                                </div>
                            </div>
                        <?php // endif ?>

                    </div>                          
                </div>
            </div>
        </section>
    </div>
</div>



</body>
</html>