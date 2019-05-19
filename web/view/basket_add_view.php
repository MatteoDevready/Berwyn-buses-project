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

<!-- Modal -->
<div class="modal" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="messageModalBody"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container mainContentContainer" >
    <div class="row justify-content-center">
        <div class="col-md-6 border bg-white rounded shadow">
            <div class="modal-header">
                <h5 class="modal-title display-4" id="signinModalTitle">Add To Basket</h5>
            </div>
            <div class="modal-body">
                <img src="assets/images/vehicleModels/<?= $vehicleModel->model ?>.jpg" alt="<?= $vehicleModel->model ?>" width="100%">
                <h5><?= $vehicleModel->model ?></h5>
                <p>Please use the form below to add a '<?= $vehicleModel->model ?>' for <?= $promotion == null ? '' : 'a special promotional rate of ' ?>£<?= $vehicleModel->dailyRate ?> per day to your basket.</p>
                <?php if($processingMessage != "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $processingMessage ?>   
                    </div>    
                <?php endif ?>
                <div id="selfDrivingAlertOff" class="col-12 alert alert-warning" role="alert" style="display:none;">
                    You have opted for a driver.
                </div>                
                <div id="selfDrivingAlert" class="col-12 alert alert-warning" role="alert" style="display:none;">
                    You have opted for self drive. Your own driver must provide a '<?= $vehicleModel->category ?>' license.
                </div>                  
                <form id="addBasketItemForm" action="basket_add.php" method="POST">
                    <input type="hidden" id="addBookingItemAttempt" name="addBookingItemAttempt" value="1">
                    <input type="hidden" id="url" name="url" value="<?= $url ?>">
                    <input type="hidden" id="direct" name="direct" value="<?= $isDirect ?>">
                    <input type="hidden" id="dailyRate" name="dailyRate" value="<?= $vehicleModel->dailyRate ?>">
                    <input type="hidden" id="vehicleModelId" name="vehicleModelId" value="<?= $vehicleModel->id ?>">
                    <input type="hidden" id="licenceCategoryId" name="licenceCategoryId" value="<?= $vehicleModelQuery->licenceCategoryId ?>">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Yes" id="isSelfDriving" name="isSelfDriving" <?= $basketAddForm->isSelfDriving ? "checked" : "" ?>>
                            <label class="form-check-label" for="isSelfDriving">
                                Self Drive
                            </label>
                        </div>                    
                    </div>
                    <div id="placeFromRow" class="form-group">
                        <label for="placeFrom">Place From</label>
                        <input type="text" class="form-control" id="placeFrom" name="placeFrom" placeholder="Place From" value="<?= $basketAddForm->placeFrom ?>">
                    </div>
                    <div  id="placeToRow"class="form-group">
                        <label for="placeTo">Place To</label>
                        <input type="text" class="form-control" id="placeTo" name="placeTo" placeholder="Place To" value="<?= $basketAddForm->placeTo ?>">
                    </div>
                    <div class="form-group">
                        <label for="dateFrom">Date From</label>
                        <input type="text" class="form-control" id="dateFrom" name="dateFrom" placeholder="Date From" value="<?= getDateInUKFormat($basketAddForm->dateFrom) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="dateTo">Date To</label>
                        <input type="text" class="form-control" id="dateTo" name="dateTo" placeholder="Date To" value="<?= getDateInUKFormat($basketAddForm->dateTo) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="passengerNo">No of Passengers</label>
                        <input type="text" class="form-control" id="passengerNo" name="passengerNo" placeholder="No of Passengers" value="<?= $basketAddForm->passengerNo == 0 ? "" : $basketAddForm->passengerNo ?>">
                    </div>
                    <?php if($vehicleModelQuery->licenceCategoryId == 0) : ?>
                    <div id="preferredDriverRow" class="form-group">
                        <label for="preferredDriver">Preferred Driver</label>
                        <input type="text" class="form-control" id="preferredDriver" name="preferredDriver" placeholder="Preferred Driver" value="<?= $basketAddForm->preferredDriver ?>">
                    </div>
                    <?php endif ?>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add to Basket</button>
                        <a class="btn btn-primary" href="<?= $url == '' ? 'browse.php?revisit=1' : $url ?>" role="button">Cancel</a>                                        
                    </div>    
                </form> 
            </div>        
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#addBasketItemForm').on('submit', function(e){

            e.preventDefault();

            var isSelfDriving = $('#isSelfDriving').prop('checked');          
            var dateFrom = $('#dateFrom').val();
            var dateTo = $('#dateTo').val();
            var passengerNo = $('#passengerNo').val();

            if(!isSelfDriving) {
                var placeFrom = $('#placeFrom').val();
                var placeTo = $('#placeTo').val();
                if (placeFrom == "" || placeTo == "") {
                    $('#messageModalTitle').html('Add To Basket');
                    $('#messageModalBody').html('Please select a Place From and Place To.');
                    $('#messageModal').modal('show');
                    return;
                }
            }

            if (dateFrom == "" || dateTo == "") {
                $('#messageModalTitle').html('Add To Basket');
                $('#messageModalBody').html('Please select a Date From and Date To.');
                $('#messageModal').modal('show');
                return;
            }

            if (passengerNo == "" || isNaN(passengerNo) || parseInt(passengerNo) < 1) {
                $('#messageModalTitle').html('Search for Vehicle');
                $('#messageModalBody').html('Please enter No of Passengers.');
                $('#messageModal').modal('show');
                return;
            }                        

            this.submit();
        });
    });

    $('#isSelfDriving').click(function(){
        if($(this).prop("checked") == true) {
            $('#selfDrivingAlertOff').hide();
            $('#selfDrivingAlert').show();
            $('#placeFromRow').hide();
            $('#placeToRow').hide();
            $('#preferredDriverRow').hide();
        }
        else {
            $('#selfDrivingAlertOff').show();
            $('#selfDrivingAlert').hide();
            $('#placeFromRow').show();
            $('#placeToRow').show();
            $('#preferredDriverRow').show();
        }
    });

    if($('#isSelfDriving').prop('checked')) {
        $('#selfDrivingAlertOff').hide();
        $('#selfDrivingAlert').show();
        $('#placeFromRow').hide();
        $('#placeToRow').hide();
        $('#preferredDriverRow').hide();
    }
    else {
        $('#selfDrivingAlertOff').show();
        $('#selfDrivingAlert').hide();
        $('#placeFromRow').show();
        $('#placeToRow').show();
        $('#preferredDriverRow').show();
    }        


    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());

    $('#dateFrom').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'dd/mm/yyyy',
        minDate: today,
        maxDate: function () {
            return $('#dateTo').val();
        }
    });

    $('#dateTo').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'dd/mm/yyyy',
        minDate: function () {
            return $('#dateFrom').val();
        }
    });

    function initAutocompleteForFromAndTo() {   
        initAutocompleteForInput('placeFrom');
        initAutocompleteForInput('placeTo');
    }

    function initAutocompleteForInput(inputId) {   
        // Create the search box and link it to the UI element.
        var input = document.getElementById(inputId);
        var searchBox = new google.maps.places.SearchBox(input);

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
        });          
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdciYim1wV5Xly1NwQWNdlYKzT8g3V6_w&libraries=places&callback=initAutocompleteForFromAndTo" async defer></script>