<div class="container mt-4">
    <h2 class="text-primary">Edit Vehicle</h2>
    <div class="row">
        <div class="col-md-12">
            <form id="addVehicleForm" action="vehicles_edit.php" method="POST">
                <input type="hidden" id="editVehicleAttempt" name="editVehicleAttempt" value="1">
                <input type="hidden" id="editVehicleId" name="editVehicleId" value="<?= $editVehicle->id ?>">
                <div class="form-group">
                    <label for="vehicleModelId">Vehicle Model</label>                         
                    <select class="form-control" id="vehicleModelId" name="vehicleModelId">
                    <?php foreach ($vehicleModels as $vehicleModel):?>
                    <option value="<?=$vehicleModel->id?>" <?= $editVehicle->vehicleModelId == $vehicleModel->id ? "selected" : "" ?>><?=$vehicleModel->model?></option>
                    <?php endforeach?>
                    </select>                                
                </div>                
                <div class="form-group">
                    <label for="registrationNo">Registration Number</label>
                    <input type="text" class="form-control" id="registrationNo" name="registrationNo" placeholder="Registration Number" value="<?= $editVehicle->registrationNo ?>">
                </div>                
                <div class="form-group">
                    <label for="registrationDate">Registration Date</label>
                    <input type="text" class="form-control" id="registrationDate" name="registrationDate" placeholder="Registration Date" value="<?= getDateInUKFormat($editVehicle->registrationDate) ?>" readonly>
                </div>                                
                <button type="submit" class="btn btn-success">Update Vehicle</button>       
                <a class="btn btn-primary" href="vehicles.php" role="button">Cancel</a>       
            </form>
        </div>
    </div>
</div>

<script>
    $('#registrationDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'dd/mm/yyyy'
    });

$(document).ready(function() {
    $('#addVehicleForm').bootstrapValidator({
        fields: {
            registrationNo: {
                validators: {
                    notEmpty: {
                        message: 'The registration No is required and cannot be empty. '
                    }
                }
            },
            registrationDate: {
                validators: {
                    notEmpty: {
                        message: 'The registration date is required and cannot be empty. '
                    }
                }
            },            
            vehicleModelId: {
                validators: {
                    notEmpty: {
                        message: 'The model id is required and cannot be empty. '
                    }
                }
            }            
        }
    });
});
</script>