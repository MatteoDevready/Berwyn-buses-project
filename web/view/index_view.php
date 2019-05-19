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

<div class="container mainContentContainer shadow">
    <div class="row">
        <div id="searchFormContainer" class="col-md-12 p-4 bg-success text-white border border-bginfo rounded shadow shadow-lg">
            <form id="searchForm" action="browse.php" method="GET">
                <div class="form-row">
                    <div class="form-group col-lg-2 col-md-4 col-sm-6">
                        <label for="dateFrom">Date From</label>
                        <span data-container="body" 
                            data-toggle="popover" 
                            data-placement="top" 
                            data-content="Enter the date from when you want to book a vehicle."
                            style="color: #ffffff;"><i class="fas fa-xs fa-info-circle"></i></span>                        
                        <input id="dateFrom" name="dateFrom" class="controls form-control" type="text" placeholder="Date From" readonly value="<?= getDateInUKFormat($vehicleModelQuery->dateFrom) ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-4 col-sm-6">
                        <label for="dateTo">Date To</label>
                        <span data-container="body" 
                            data-toggle="popover" 
                            data-placement="top" 
                            data-content="Enter the date until when you want to book a vehicle."
                            style="color: #ffffff;"><i class="fas fa-xs fa-info-circle"></i></span>                                                
                        <input id="dateTo" name="dateTo" class="controls form-control" type="text" placeholder="Date To" readonly value="<?= getDateInUKFormat($vehicleModelQuery->dateTo) ?>">
                    </div>                  
                    <div class="form-group col-lg-2 col-md-4 col-sm-6">
                        <label for="passengerNo">Passengers</label>
                        <span data-container="body" 
                            data-toggle="popover" 
                            data-placement="top" 
                            data-content="Enter the number of passengers the vehicle will carry."
                            style="color: #ffffff;"><i class="fas fa-xs fa-info-circle"></i></span>                                                
                        <input type="text" id="passengerNo" name="passengerNo" class="controls form-control" placeholder="No of Passengers" value="<?= $vehicleModelQuery->passengerNo == 0 ? "" : $vehicleModelQuery->passengerNo ?>">
                    </div>                                       
                    <div class="form-group col-lg-2 col-md-4 col-sm-6">
                        <label for="vehicleStandardId">Vehicle Standard</label>
                        <span data-container="body" 
                            data-toggle="popover" 
                            data-placement="top" 
                            data-content="Enter the standard of vehicle you want to book."
                            style="color: #ffffff;"><i class="fas fa-xs fa-info-circle"></i></span>                                                
                        <select class="form-control" id="vehicleStandardId" name="vehicleStandardId">
                            <option value="0" <?= $vehicleModelQuery->vehicleStandardId == 0 ? "selected" : "" ?>>All</option>
                            <option value="1" <?= $vehicleModelQuery->vehicleStandardId == 1 ? "selected" : "" ?>>Standard</option>
                            <option value="2" <?= $vehicleModelQuery->vehicleStandardId == 2 ? "selected" : "" ?>>Executive</option>
                            <option value="3" <?= $vehicleModelQuery->vehicleStandardId == 3 ? "selected" : "" ?>>VIP</option>
                        </select>
                    </div>                    
                    <div class="form-group col-lg-2 col-md-4 col-sm-6">
                        <label for="licenceCategoryId">Driving License</label>
                        <span data-container="body" 
                            data-toggle="popover" 
                            data-placement="top" 
                            data-content="If you want to self-drive enter the license category you hold otherwise select Driver Required."
                            style="color: #ffffff;"><i class="fas fa-xs fa-info-circle"></i></span>                                                
                        <select class="form-control" id="licenceCategoryId" name="licenceCategoryId">
                            <option value="0" <?= $vehicleModelQuery->licenceCategoryId == 0 ? "selected" : "" ?>>Driver Required</option>
                            <option value="1" <?= $vehicleModelQuery->licenceCategoryId == 1 ? "selected" : "" ?>>Minibus (D1)</option>
                            <option value="2" <?= $vehicleModelQuery->licenceCategoryId == 2 ? "selected" : "" ?>>Bus (D)</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-1 col-md-2 col-sm-6">
                        <label for="minDailyRate">£ Min</label>
                        <select class="form-control" id="minDailyRate" name="minDailyRate">
                        <option value="0" <?= $vehicleModelQuery->minDailyRate == 0 ? "selected" : "" ?>>All</option>
                            <option value="40" <?= $vehicleModelQuery->minDailyRate == 40 ? "selected" : "" ?>>40</option>
                            <option value="50" <?= $vehicleModelQuery->minDailyRate == 50 ? "selected" : "" ?>>50</option>
                            <option value="60" <?= $vehicleModelQuery->minDailyRate == 60 ? "selected" : "" ?>>60</option>
                            <option value="70" <?= $vehicleModelQuery->minDailyRate == 70 ? "selected" : "" ?>>70</option>
                            <option value="80" <?= $vehicleModelQuery->minDailyRate == 80 ? "selected" : "" ?>>80</option>
                            <option value="90" <?= $vehicleModelQuery->minDailyRate == 90 ? "selected" : "" ?>>90</option>
                            <option value="100" <?= $vehicleModelQuery->minDailyRate == 100 ? "selected" : "" ?>>100</option>
                            <option value="110" <?= $vehicleModelQuery->minDailyRate == 110 ? "selected" : "" ?>>110</option>
                            <option value="120" <?= $vehicleModelQuery->minDailyRate == 120 ? "selected" : "" ?>>120</option>
                            <option value="130" <?= $vehicleModelQuery->minDailyRate == 130 ? "selected" : "" ?>>130</option>
                            <option value="140" <?= $vehicleModelQuery->minDailyRate == 140 ? "selected" : "" ?>>140</option>
                            <option value="150" <?= $vehicleModelQuery->minDailyRate == 150 ? "selected" : "" ?>>150</option>
                            <option value="160" <?= $vehicleModelQuery->minDailyRate == 160 ? "selected" : "" ?>>160</option>
                            <option value="170" <?= $vehicleModelQuery->minDailyRate == 170 ? "selected" : "" ?>>170</option>
                            <option value="180" <?= $vehicleModelQuery->minDailyRate == 180 ? "selected" : "" ?>>180</option>
                            <option value="190" <?= $vehicleModelQuery->minDailyRate == 190 ? "selected" : "" ?>>190</option>
                            <option value="200" <?= $vehicleModelQuery->minDailyRate == 200 ? "selected" : "" ?>>200</option>
                        </select>
                    </div>   
                    <div class="form-group col-lg-1 col-md-2 col-sm-6">
                        <label for="maxDailyRate">£ Max</label>
                        <select class="form-control" id="maxDailyRate" name="maxDailyRate">
                        <option value="0" <?= $vehicleModelQuery->maxDailyRate == 0 ? "selected" : "" ?>>All</option>
                            <option value="40" <?= $vehicleModelQuery->maxDailyRate == 40 ? "selected" : "" ?>>40</option>
                            <option value="50" <?= $vehicleModelQuery->maxDailyRate == 50 ? "selected" : "" ?>>50</option>
                            <option value="60" <?= $vehicleModelQuery->maxDailyRate == 60 ? "selected" : "" ?>>60</option>
                            <option value="70" <?= $vehicleModelQuery->maxDailyRate == 70 ? "selected" : "" ?>>70</option>
                            <option value="80" <?= $vehicleModelQuery->maxDailyRate == 80 ? "selected" : "" ?>>80</option>
                            <option value="90" <?= $vehicleModelQuery->maxDailyRate == 90 ? "selected" : "" ?>>90</option>
                            <option value="100" <?= $vehicleModelQuery->maxDailyRate == 100 ? "selected" : "" ?>>100</option>
                            <option value="110" <?= $vehicleModelQuery->maxDailyRate == 110 ? "selected" : "" ?>>110</option>
                            <option value="120" <?= $vehicleModelQuery->maxDailyRate == 120 ? "selected" : "" ?>>120</option>
                            <option value="130" <?= $vehicleModelQuery->maxDailyRate == 130 ? "selected" : "" ?>>130</option>
                            <option value="140" <?= $vehicleModelQuery->maxDailyRate == 140 ? "selected" : "" ?>>140</option>
                            <option value="150" <?= $vehicleModelQuery->maxDailyRate == 150 ? "selected" : "" ?>>150</option>
                            <option value="160" <?= $vehicleModelQuery->maxDailyRate == 160 ? "selected" : "" ?>>160</option>
                            <option value="170" <?= $vehicleModelQuery->maxDailyRate == 170 ? "selected" : "" ?>>170</option>
                            <option value="180" <?= $vehicleModelQuery->maxDailyRate == 180 ? "selected" : "" ?>>180</option>
                            <option value="190" <?= $vehicleModelQuery->maxDailyRate == 190 ? "selected" : "" ?>>190</option>
                            <option value="200" <?= $vehicleModelQuery->maxDailyRate == 200 ? "selected" : "" ?>>200</option>                            
                        </select>
                    </div>                                                                                                                                   
                </div>
                <button type="submit" class="btn btn-primary float-right">Find a Vehicle</button>
            </form>
            <script>
                $(function () {
                    $('[data-toggle="popover"]').popover()
                })  

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

                $(document).ready(function(){
                    $('#searchForm').on('submit', function(e){
                        e.preventDefault();
                        var minPrice = parseInt($('#minDailyRate').val());
                        var maxPrice = parseInt($('#maxDailyRate').val());
                        var dateFrom = $('#dateFrom').val();
                        var dateTo = $('#dateTo').val();
                        var passengerNo = $('#passengerNo').val();

                        if (dateFrom == "" || dateTo == "") {
                            $('#messageModalTitle').html('Search for Vehicle');
                            $('#messageModalBody').html('Please select a Date From and Date To.');
                            $('#messageModal').modal('show');
                            return;
                        }

                        if (passengerNo != "" && isNaN(passengerNo)) {
                            $('#messageModalTitle').html('Search for Vehicle');
                            $('#messageModalBody').html('Please enter No of Passengers.');
                            $('#messageModal').modal('show');
                            return;
                        }

                        if (minPrice > maxPrice) {
                            $('#messageModalTitle').html('Search for Vehicle');
                            $('#messageModalBody').html('Price (Min) must be less than Price (Max).');
                            $('#messageModal').modal('show');
                            return;
                        }

                        this.submit();
                    });
                });
            </script>                      
        </div>
    </div>        
</div>

<?php if($addedToBasketMessage != "") : ?>
    <div id="messageContainer" class="container">
        <div class="row">
            <div class="col-12 alert alert-info" role="alert">
                <?= $addedToBasketMessage ?>
            </div>                    
        </div>
    </div>
<?php endif ?>

<div id="promotionsContainer" class="container border rounded p-4 mb-2">
    <div class="row">
        <div class="col-md-12">
            <h3>Promotions</h3>
        </div>
    </div>
    <div id="promotionsLoader" style="display:none;height:450px">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <div id="promotions" class="row card-deck">
     </div>
</div>

<script>

    $(document).ready(function () {

        $('#promotionsLoader').show();

        // Slow the AJAX request to make it more obvious lol :)
        setTimeout(function() {
            $.getJSON('../web/api.php?cmd=getCurrentPromotions', function (data) {

            var promotions = data.data;

            if(promotions.length == 0) {
                $('#promotionsLoader').hide();
                $('#promotionsContainer').hide();
                return;
            }

            for(var i = 0; i < promotions.length; i++) {
                var promotion = promotions[i];
                var html = '<div class="col-lg-4 col-md-6 col-sm-12">';
                html += '       <div class="card" style="min-height:450px;width: 18rem;margin:3px;">';
                html += '           <img class="card-img-top" src="assets/images/vehicleModels/' + promotion.model + '.jpg" alt="' + promotion.model + '">';
                html += '           <div class="card-body">';
                html += '               <h5 class="card-title">' + promotion.title + '</h5>';
                html += '               <p class="card-text">' + promotion.info + '</p>';
                html += '               <p class="card-text">Price:  £' + promotion.dailyRate + '</p>';
                html += '               <p class="card-text">Expiring on: ' + promotion.expiringDate + '</p>';
                html += '               <a href="basket_add.php?direct=1&url=index.php&vehicleModelId=' + promotion.vehicleModelId + '&promotionId=' + promotion.id + '" class="btn btn-success">Add to Basket</a>';
                html += '           </div>';
                html += '       </div>';
                html += '   </div>';
                $('#promotions').append(html);
            }

            $('#promotionsLoader').hide();           
            });
        }, 250);
        
    });    
</script>

<div id="vehiclesContainer" class="container border rounded p-4">
    <div class="row">
        <div class="col-md-12">
            <h3>Recently Added Vehicles</h3>
        </div>
    </div>
    <div id="vehiclesLoader" style="display:none;height:450px">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>    
    <div id="vehicles" class="row card-deck">
    </div>
</div>


<script>

    $(document).ready(function () {

        $('#vehiclesLoader').show();

        // Slow the AJAX request to make it more obvious lol :)
        setTimeout(function() {
            $.getJSON('../web/api.php?cmd=getCurrentVehicles', function (data) {

                var vehicles = data.data;

                if(vehicles.length == 0) {
                    $('#vehiclesLoader').hide();
                    $('#vehiclesContainer').hide();
                    return;
                }

                for(var i = 0; i < vehicles.length; i++) {
                    var vehicle = vehicles[i];
                    var html = '<div class="col-lg-4 col-md-6 col-sm-12">';
                    html +=         '<div class="card" style="min-height:400px;width: 18rem;margin:3px;">';
                    html += '           <img class="card-img-top" src="assets/images/vehicleModels/' + vehicle.model + '.jpg" alt="' + vehicle.model +'">';
                    html += '           <div class="card-body">';
                    html += '               <h5 class="card-title">' + vehicle.model + '</h5>';
                    html += '               <p class="card-text">Price: £'+vehicle.dailyRate+'</p>';
                    html += '                <p class="card-text">No of Passengers:  '+vehicle.minNoOfPassengers+'-'+vehicle.maxNoOfPassengers+'</p>';
                    html += '               <a href="basket_add.php?direct=1&url=index.php&vehicleModelId=' + vehicle.vehicleModelId + '" class="btn btn-success">Add to Basket</a>';
                    html += '           </div>';
                    html += '       </div>';
                    html += '   </div>';
                    $('#vehicles').append(html);
                }

                $('#vehiclesLoader').hide();

            });
        }, 250);
    });    
</script>
