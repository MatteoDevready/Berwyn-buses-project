<div class="container mt-4">
    <h2 class="text-primary">Vehicles<a class="btn btn-success float-right" href="vehicles_add.php" role="button">Add Vehicle</a></h2>
    <?php if($onVehicleDeletedMessage != "") : ?>
        <div class="alert alert-success" role="alert">
            <?= $onVehicleDeletedMessage ?>
        </div>    
    <?php endif ?>

    <div class="mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Registration NO</th>
                <th>Registration Date</th>
                <th>Vehicle Model</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($vehicles as $vehicle): ?>
                <tr>
                    <td><?= $vehicle->id ?></td>
                    <td><?= $vehicle->registrationNo ?></td>
                    <td><?= getDateInUKFormat($vehicle->registrationDate) ?></td>
                    <td><?= $vehicle->model ?></td>
                    <td width="180px">
                        <button type="button" class="deleteVehicleShowModalButtonSelector btn btn-danger" data-id="<?= $vehicle->id ?>" data-name="<?= $vehicle->registrationNo ?>">Delete</button>
                        <a class="btn btn-success" href="vehicles_edit.php?id=<?= $vehicle->id ?>" role="button">Edit</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="deleteVehicleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVehicleModalTitle">Delete Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="deleteVehicleModalBody" class="modal-body">
                    <form id="deleteVehicleForm" action="vehicles.php" method="POST">
                        <input type="hidden" id="deleteVehicleAttempt" name="deleteVehicleAttempt" value="1">
                        <input type="hidden" id="deleteVehicleId" name="deleteVehicleId" value="1">
                    </form> 
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <i class="fas fa-minus-circle fa-4x"></i>
                            </div>
                            <div class="col-md-10 pt-3">
                                <span id="deleteVehicleModalMessage"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="deleteVehicleButton" type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#deleteVehicleButton').on('click', function(e){
                $('#deleteVehicleForm').submit();
            });
            
            $('.deleteVehicleShowModalButtonSelector').each(function(index) {
                $(this).on('click', function(e){
                    var deleteVehicleId = $(this).attr('data-id');
                    var deleteVehicleName = $(this).attr('data-name');
                    $('#deleteVehicleId').val(deleteVehicleId);
                    $('#deleteVehicleModalMessage').html('Delete vehicle "' + deleteVehicleName + '"?');
                    $('#deleteVehicleModal').modal('show');                
                });
            });
        });    
    </script>