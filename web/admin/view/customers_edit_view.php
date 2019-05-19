<div class="container mt-4">
    <h2 class="text-primary">Edit Customer</h2>
    <div class="row">
        <div class="col-md-12">
            <form id="addCustomerForm" action="customers_edit.php" method="POST">
                <input type="hidden" id="editCustomerAttempt" name="editCustomerAttempt" value="1">
                <input type="hidden" id="editCustomerId" name="editCustomerId" value="<?= $editCustomer->id ?>">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="<?= $editCustomer->firstName ?>">
                </div>                
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Lastname" value="<?= $editCustomer->lastName ?>">
                </div>                                
                <div class="form-group">
                    <label for="emailAddress">Email address</label>
                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address" value="<?= $editCustomer->emailAddress ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <small>Leave password field blank to keep the same password</small>
                </div>                                
                <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" value="<?= $editCustomer->companyName ?>">
                </div>
                <div class="form-group">
                    <label for="phoneNo">Phone No</label>
                    <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="Phone No" value="<?= $editCustomer->phoneNo ?>">
                </div>                
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Yes" <?= $editCustomer->isAdministrator ? "checked" : "" ?> id="isAdministrator" name="isAdministrator">
                        <label class="form-check-label" for="isAdministrator">
                            Is Administrator
                        </label>
                    </div>                    
                </div>
                <button type="submit" class="btn btn-success">Update Customer</button>       
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
                    different: {
                        field: 'name',
                        message: 'The password cannot be the same as username. '
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