<div class="container mt-4">
    <h2 class="text-primary">Customers<a class="btn btn-success float-right" href="customers_add.php" role="button">Add Customer</a></h2>
    <?php if($onCustomerDeletedMessage != "") : ?>
        <div class="alert alert-success" role="alert">
            <?= $onCustomerDeletedMessage ?>
        </div>    
    <?php endif ?>

    <div class="mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Company</th>
                <th>Phone No.</th>
                <th>Is Administrator</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($customers as $customer): ?>
                <tr>
                    <td><?= $customer->id ?></td>
                    <td><?= $customer->getFullName() ?></td>
                    <td><?= $customer->emailAddress ?></td>
                    <td><?= $customer->companyName ?></td>
                    <td><?= $customer->phoneNo ?></td>
                    <td><?= $customer->isAdministrator ? "Yes" : "No" ?></td>
                    <td width="180px">
                        <button type="button" class="deleteCustomerShowModalButtonSelector btn btn-danger" data-id="<?= $customer->id ?>" data-name="<?= $customer->getFullName() ?>">Delete</button>
                        <a class="btn btn-success" href="customers_edit.php?id=<?= $customer->id ?>" role="button">Edit</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="deleteCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCustomerModalTitle">Delete Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="deleteCustomerModalBody" class="modal-body">
                    <form id="deleteCustomerForm" action="customers.php" method="POST">
                        <input type="hidden" id="deleteCustomerAttempt" name="deleteCustomerAttempt" value="1">
                        <input type="hidden" id="deleteCustomerId" name="deleteCustomerId" value="1">
                    </form> 
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <i class="fas fa-minus-circle fa-4x"></i>
                            </div>
                            <div class="col-md-10 pt-3">
                                <span id="deleteCustomerModalMessage"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="deleteCustomerButton" type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#deleteCustomerButton').on('click', function(e){
                $('#deleteCustomerForm').submit();
            });
            
            $('.deleteCustomerShowModalButtonSelector').each(function(index) {
                $(this).on('click', function(e){
                    var deleteCustomerId = $(this).attr('data-id');
                    var deleteCustomerName = $(this).attr('data-name');
                    $('#deleteCustomerId').val(deleteCustomerId);
                    $('#deleteCustomerModalMessage').html('Delete customer "' + deleteCustomerName + '"?');
                    $('#deleteCustomerModal').modal('show');                
                });
            });
        });    
    </script>