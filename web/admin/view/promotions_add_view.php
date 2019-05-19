<div class="container mt-4">
    <h2 class="text-primary">Add Promotion</h2>   
    <div class="row">
        <div class="col-md-12">
            <form id="addPromotionForm" action="promotions_add.php" method="POST">
                <input type="hidden" id="addPromotionAttempt" name="addPromotionAttempt" value="1">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Deal Title">
                </div>

                <div class="form-group">
                    <label for="info">Info</label>
                    <input type="text" class="form-control" id="info" name="info" placeholder="Deal Information">
                </div>   

                <div class="form-group">
                    <label for="vehicleModelId">Vehicle Model</label>                                             
                    <select class="form-control" id="vehicleModelId" name="vehicleModelId">
                        <?php foreach($vehicleModels as $vehicleModel) : ?>
                            <option value="<?= $vehicleModel->id ?>"><?= $vehicleModel->model ?></option>
                        <?php endforeach ?>
                    </select>
                </div>                 

                <div class="form-group">
                    <label for="dailyRate">Discounted Daily Rate</label>
                    <input type="text" class="form-control" id="dailyRate" name="dailyRate" placeholder="Daily Rate">
                </div>                                
                <div class="form-group">
                    <label for="expiringDate">Expiry Date</label>
                    <input type="text" class="form-control" id="expiringDate" name="expiringDate" placeholder="Expiry Date">
                </div>              

                <button type="submit" class="btn btn-success">Add Promotion</button>       
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
        $('#addPromotionForm').bootstrapValidator({
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
                            message: 'The Deal Info is required and cannot be empty. '
                        }
                    }
                },            
                dailyRate: {
                    validators: {
                        notEmpty: {
                            message: 'The Daily Rate is required and cannot be empty. '
                        },
                        numeric: {
                            message: 'The Daily Rate must be a number'
                        }                    
                    }
                },
                expiringDate: {
                    validators: {
                        notEmpty: {
                            message: 'The expiry date is required and cannot be empty. '
                        }
                    }
                }                 
            }
        });
    });
</script>