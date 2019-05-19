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
        <div id="searchFormContainer" class="col-md-12 p-4 bg-success text-white border border-bginfo rounded">
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

<style>
    .alert {
        margin-bottom: 0rem;
    }
</style>

<div id="searchResultsContainer" class="container rounded border">
<div class="row card-deck">
    <?php if($addedToBasketMessage != "") : ?>
        <div class="col-12 alert alert-info" role="alert">
            <?= $addedToBasketMessage ?>
        </div>    
    <?php endif ?>
    <?php if($vehicleModelQuery->licenceCategoryId > 0) : ?>
        <div class="col-12 alert alert-warning" role="alert">
            You have opted for self drive. You own driver must provide a valid <?= $vehicleModelQuery->licenceCategoryId == 1 ? 'Minibus (D1)' : 'Bus (D)' ?> license.
        </div>
    <?php else : ?>
        <div class="col-12 alert alert-warning" role="alert">
            You have opted for a driver ('Driver Required').
        </div>
    <?php endif ?>
    <?php if(sizeof($vehicleModels) == 0) : ?>
        <div class="col-12 alert alert-success" role="alert">
            No vehicle categories are currently available matching your search criteria. Please try again.
        </div>
    <?php elseif(sizeof($vehicleModels) == 1) : ?>
        <div class="col-12 alert alert-success" role="alert">
            One vehicle category is available which matches your search criteria.
        </div>        
    <?php else : ?>
        <div class="col-12 alert alert-success" role="alert">
            <?= sizeof($vehicleModels) ?> vehicle categories are available which match your search criteria.
        </div>    
    <?php endif ?>
    <?php foreach ($vehicleModels as $vehicleModel): ?>
        <?php if($vehicleModel->total > 0) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12 p-3">
            <div class="card" style="min-height:450px;width: 18rem;margin:3px;">
                <img class="card-img-top" src="assets/images/vehicleModels/<?=$vehicleModel->model?>.jpg" alt="<?=$vehicleModel->model?>">
                <div class="card-body">
                    <h5 class="card-title"><?=$vehicleModel->model?></h5>
                    <span class="card-text">No Available: <?=$vehicleModel->total ?></span><br/>
                    <span class="card-text">Daily rate: £<?=$vehicleModel->dailyRate?></span><br/>
                    <span class="card-text">Min: <?=$vehicleModel->minNoOfPassengers?> Max: <?=$vehicleModel->maxNoOfPassengers?></span><br/>
                    <span class="card-text">Standard: <?=$vehicleModel->standard?></span><br/>
                    <span class="card-text">Licence: <?=$vehicleModel->category?></span><br/>
                    <p class="card-text"><br/><a href="basket_add.php?vehicleModelId=<?= $vehicleModel->id ?>" class="btn btn-success">Add to Basket</a></p>
                </div>
            </div>
        </div>
        <?php endif ?>
    <?php endforeach ?>
</div>
</div>
