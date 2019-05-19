<div class="container mt-4">
    <h2 class="text-primary">Add Customer</h2>
    <?php if($addCustomerErrorMessage != "") : ?>
        <div class="alert alert-danger" role="alert">
            <?= $addCustomerErrorMessage ?>
        </div>    
    <?php endif ?>    
    <div class="row">
        <div class="col-md-12">
            <form id="addCustomerForm" action="customers_add.php" method="POST">
                <input type="hidden" id="addCustomerAttempt" name="addCustomerAttempt" value="1">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Firstname">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Lastname">
                </div>                                
                <div class="form-group">
                    <label for="emailAddress">Email address</label>
                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>                                
                <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name">
                </div>
                <div class="form-group">
                    <label for="phoneNo">Phone No</label>
                    <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="Phone No">
                </div>                
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Yes" id="isAdministrator" name="isAdministrator">
                        <label class="form-check-label" for="isAdministrator">
                            Is Administrator
                        </label>
                    </div>                    
                </div>
                <button type="submit" class="btn btn-success">Add Customer</button>       
                <a class="btn btn-primary" href="customers.php" role="button">Cancel</a>       
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#addCustomerForm').bootstrapValidator({
        fields: {
            firstName: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty. '
                    }
                }
            },
            lastName: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty. '
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
            companyName: {
                validators: {
                    notEmpty: {
                        message: 'The company name is required and cannot be empty. '
                    }
                }
            }           
        }
    });
});
</script>