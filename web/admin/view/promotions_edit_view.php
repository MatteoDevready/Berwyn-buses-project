<div class="container mt-4">
    <h2 class="text-primary">Edit Promotion</h2>
    <div class="row">
        <div class="col-md-12">
            <form id="addPromotionForm" action="promotions_edit.php" method="POST">
                <input type="hidden" id="editPromotionAttempt" name="editPromotionAttempt" value="1">
                <input type="hidden" id="editPromotionId" name="editPromotionId" value="<?= $editPromotion->id ?>">
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= $editPromotion->title ?>">
                </div>

                <div class="form-group">
                    <label for="info">Info</label>
                    <input type="text" class="form-control" id="info" name="info" placeholder="Info" value="<?= $editPromotion->info ?>">
                </div>  

                <div class="form-group">
                    <label for="vehicleModelId">Vehicle Model</label>                                             
                    <select class="form-control" id="vehicleModelId" name="vehicleModelId">
                        <?php foreach($vehicleModels as $vehicleModel) : ?>
                            <option value="<?= $vehicleModel->id ?>" <?= $vehicleModel->id == $editPromotion->vehicleModelId ? "selected" : "" ?>><?= $vehicleModel->model ?></option>
                        <?php endforeach ?>
                    </select>
                </div>   

                <div class="form-group">
                    <label for="dailyRate">Discounted Daily Rate</label>
                    <input type="text" class="form-control" id="dailyRate" name="dailyRate" placeholder="Daily Rate" value="<?= $editPromotion->dailyRate ?>">
                </div>

                <div class="form-group">
                    <label for="expiringDate">Expiry Date</label>
                    <input type="text" class="form-control" id="expiringDate" name="expiringDate" placeholder="Expiry Date" value="<?= getDateInUKFormat($editPromotion->expiringDate) ?>">
                </div>
                
                <button type="submit" class="btn btn-success">Update Promotion</button>       
                <a class="btn btn-primary" href="promotions.php" role="button">Cancel</a>       
            </form>
        </div>
    </div>
</div>

<script>

    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                    
    $('#expiringDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'dd/mm/yyyy',
        minDate: today
    });

    $(document).ready(function() {
        $('#editPromotionForm').bootstrapValidator({
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The Title is required and cannot be empty. '
                        }
                    }
                },
                info: {
                    validators: {
                        notEmpty: {
                            message: 'The Info field is required and cannot be empty. '
                        }
                    }
                },            
                vehicleModelId: {
                    validators: {
                        notEmpty: {
                            message: 'The Vehicle Model is required and cannot be empty. '
                        }
                    }
                },
                dailyRate: {
                    validators: {
                        notEmpty: {
                            message: 'The Daily Rate field is required and cannot be empty. '
                        }
                    }
                },     
                expiringDate: {
                    validators: {
                        notEmpty: {
                            message: 'The Expiry Date is required and cannot be empty. '
                        }
                    }
                }            
            }
        });
    });
</script>