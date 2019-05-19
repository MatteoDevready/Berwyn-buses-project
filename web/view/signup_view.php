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
                <h5 class="modal-title display-4" id="signinModalTitle">Sign Up</h5>
            </div>
            <div class="modal-body">
                <p>Please use the form below to sign up for an account with Berwyn Buses Hire Ltd.</p>
                <?php if($signUpMessage != "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $signUpMessage ?>
                    </div>    
                <?php endif ?>                 
                <form id="registerCustomerForm" action="signup.php" method="POST">
                    <input type="hidden" id="registerCustomerAttempt" name="registerCustomerAttempt" value="1">
                    <input type="hidden" id="url" name="url" value="<?= $url ?>">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                    </div>  
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                    </div>                        
                    <div class="form-group">
                        <label for="emailAddress">Email address</label>
                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email address">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                    </div>        
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                        <label for="phoneNo">Phone No</label>
                        <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="Phone No">
                    </div>                                          
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Sign Up</button>
                        <a class="btn btn-primary" href="<?= $urlFrom == '' ? 'index.php' : $urlFrom ?>" role="button">Cancel</a>                                        
                    </div>    
                </form> 
            </div>        
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#registerCustomerForm').bootstrapValidator({
            fields: {
                firstName: {
                    validators: {
                        notEmpty: {
                            message: 'First name is required and cannot be empty. '
                        }
                    }
                },
                lastName: {
                    validators: {
                        notEmpty: {
                            message: 'Last name is required and cannot be empty. '
                        }
                    }
                },                
                emailAddress: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and cannot be empty. '
                        },
                        emailAddress: {
                            message: 'The email address is not valid. '
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty. '
                        },
                        stringLength: {
                            min: 8,
                            message: 'The password must have at least 8 characters. '
                        }
                    }
                },
                confirmPassword: {
                    validators: {                       
                        notEmpty: {
                            message: 'The password confirmation is required and cannot be empty. '
                        },
                        stringLength: {
                            min: 8,
                            message: 'The password confirmation must have at least 8 characters. '
                        }
                    }
                },
                companyName: {
                    validators: {
                        notEmpty: {
                            message: 'Company name is required and cannot be empty. '
                        }
                    }
                }                                
            }
        });
    });
</script>

