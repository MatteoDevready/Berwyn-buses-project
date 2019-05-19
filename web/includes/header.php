<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>
    <script src="https://cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js" type="text/javascript"></script>    
    <link rel="stylesheet" href="assets/css/style.v2.css" />
    <title>Berwyn Buses Hire Ltd</title>
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  </head>
  <body>
    <?php if(((basename($_SERVER['PHP_SELF']) != "signin.php") && (basename($_SERVER['PHP_SELF']) != "signup.php")) && ($authUser->isSignedIn == 0)) : ?>
    <div class="modal" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signinModalTitle">Sign In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="signinModalBody" class="modal-body">
                    <p><strong>Existing Customer</strong></p>
                    <form id="signinForm" action="<?= basename($_SERVER['PHP_SELF']) ?>" method="POST">
                        <input type="hidden" id="signinAttempt" name="signinAttempt" value="1">
                        <div class="form-group">
                            <label for="emailAddress">Email address</label>
                            <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </form> 
                    <p><strong>New Customer</strong></p>
                    <span><a href="signup.php">Sign up</a> for an account.</span> 
                </div>
                <div class="modal-footer">
                    <button id="signinButton" type="submit" class="btn btn-success">Sign In</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#signinButton').on('click', function(e){
                $('#signinForm').submit();
            });
        });    
    </script>
    <?php endif ?>

    <header>
        <nav class="navbar navbar-expand-xl navbar-light">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/coach.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Berwyn Buses Hire Ltd           
            </a>        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link <?= (basename($_SERVER['PHP_SELF']) == "browse.php") ? "active" : "" ?>" href="browse.php"><i class="fas fa-search"></i>&nbsp;Find a Vehicle</a>
                    <a class="nav-item nav-link <?= (basename($_SERVER['PHP_SELF']) == "services.php") ? "active" : "" ?>" href="services.php"><i class="fas fa-poll-h"></i>&nbsp;Services</a>
                    <a class="nav-item nav-link <?= (basename($_SERVER['PHP_SELF']) == "fleet.php") ? "active" : "" ?>" href="fleet.php"><i class="fas fa-bus"></i>&nbsp;Our Fleet</a>
                    <a class="nav-item nav-link <?= (basename($_SERVER['PHP_SELF']) == "whyus.php") ? "active" : "" ?>" href="whyus.php"><i class="fas fa-users"></i>&nbsp;Why Us</a>
                    <a class="nav-item nav-link <?= (basename($_SERVER['PHP_SELF']) == "contact.php") ? "active" : "" ?>" href="contact.php"><i class="fas fa-phone"></i>&nbsp;Contact Us</a>
                </div>
                <div class="navbar-nav">
                    <?php if($authUser->isSignedIn == 1) : ?>
                    <a class="nav-item nav-link <?= (basename($_SERVER['PHP_SELF']) == "bookings.php") ? "active" : "" ?>" href="bookings.php"><i class="fas fa-tasks"></i>&nbsp;My Bookings</a>                
                    <?php endif ?>
                    
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-hover" href="basket.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-shopping-basket"></i>
                    View Basket
                    <?php if(getBasketSize() > 0 && basename($_SERVER['PHP_SELF']) != "checkout.php") : ?>
                        <span class="badge badge-pill badge-success"><?= getBasketSize() ?></span>
                    <?php endif ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?php foreach (getBasketItems() as $basketItem):?>
                    <span class="dropdown-item" ><img src="assets/images/vehicleModels/<?= $basketItem->model ?>.jpg" width="50px" class="align-self-start mr-1" alt="Vehicle Image"><?=$basketItem->model?></span>
                    <?php endforeach?>
                    <div class="dropdown-divider"></div>
                    <?php if (getBasketSize() > 0):?>
                    <a class="dropdown-item" href="basket.php">View Basket</a>
                    <?php endif ?>
                    <?php if (getBasketsize() == 0):?>
                    <a class="dropdown-item">Basket Empty</a>
                    <?php endif ?>
                    </div>
                    </li>              
                    <?php if($authUser->isSignedIn == 1) : ?>
                    <a class="nav-item nav-link" href="signout.php"><i class="fas fa-user"></i>&nbsp;Sign Out</a>
                    <?php else : ?>                
                    <?php if((basename($_SERVER['PHP_SELF']) != "signin.php") && (basename($_SERVER['PHP_SELF']) != "signup.php")) : ?>
                    <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#signinModal"><i class="fas fa-user"></i>&nbsp;Sign In</a>
                    <?php endif ?>
                    <?php endif ?>
                    <?php if($authUser->isAdministrator == 1) : ?>
                    <a class="nav-item nav-link" href="admin/index.php"><i class="fas fa-cog"></i>&nbsp;Admin</a>
                    <?php endif ?>
                </div>                
            </div>
        </nav>
    </header>

    <main role="main">
    <div id="contentWrapper" class="container-fluid">
    <?php if($authUser->isSignedIn == 1) : ?>
        <h5>Welcome <?= $authUser->firstName ?></h5>
    <?php endif ?>
    