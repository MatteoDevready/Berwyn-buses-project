<div id="jumbotron" class="jumbotron jumbotron text-white">
    <div class="container">
        <h1 class="display-4">Discover Places</h1>
        <p class="lead">The safe and reliable way to hire great value transport across London and the South East.</p>
    </div>
    <style>
        #jumbotron{
            background-image: url("assets/images/travel.png");
            background-position: center;
        }
    </style>    
</div>

<div class="container mainContentContainer">
    <div class="row justify-content-center">
        <div class="col-md-6 border shadow-lg bg-white rounded">
            <div class="modal-header">
                    <h5 class="modal-title display-4" id="signinModalTitle">Sign In</h5>
                </div>
                <div id="signinModalBody" class="modal-body">
                <p>Please use the form below to sign in or <a href="signup.php?url=<?= $url ?>&from=<?= $urlFrom ?>">Sign up</a> for an account with Berwyn Buses Hire Ltd.</p>
                    <?php if($failedAuthenticationMessage != "") : ?>
                        <div class="text-danger pb-4 w-100"><?= $failedAuthenticationMessage ?></div>
                    <?php endif ?>
                    <form id="signinForm" action="signin.php" method="POST">
                        <input type="hidden" id="signinAttempt" name="signinAttempt" value="2">
                        <input type="hidden" id="url" name="url" value="<?= $url ?>">
                        <div class="form-group">
                            <label for="emailAddress">Email address</label>
                            <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </form> 
                    <span><a href="signup.php?url=<?= $url ?>&from=<?= $urlFrom ?>">Sign up</a> for an account.</span> 
                </div>
                <div class="modal-footer">
                    <button id="signinButton" type="submit" class="btn btn-success">Sign In</button>
                    <?php if($urlFrom == "") : ?>
                    <a class="btn btn-primary" href="index.php" role="button">Cancel</a>
                    <?php else : ?>
                    <a class="btn btn-primary" href="<?= $urlFrom ?>" role="button">Cancel</a>
                    <?php endif ?>
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

