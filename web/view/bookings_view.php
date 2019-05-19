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

<div class="container mainContentContainer bg-white border rounded p-4 shadow">

    <div class="row">
        <div class="col-12">
            <h3 class="display-4">My Bookings</h3>
            <hr/>
        </div>
    </div>
    <?php if($bookingItemMessage != "") : ?>
        <div class="alert alert-success" role="alert">
            <?= $bookingItemMessage ?>
        </div>     
    <?php endif ?>
    <?php if(sizeof($bookingItemDetails) == 0) : ?>
        <div class="alert alert-success" role="alert">
            You currently have no bookings.
        </div>     
    <?php endif ?>
    <?php foreach($bookingItemDetails as $bookingItemDetail) : ?>
        <div class="media my-2 p-2 border rounded">
            <img src="assets/images/vehicleModels/<?= $bookingItemDetail->vehicleModel ?>.jpg" width="100px" class="align-self-start mr-3" alt="">
            <div class="media-body">
                <h5 class="mt-0 d-flex justify-content-between"><span><?= '<em>Booking No '.$bookingItemDetail->id.'</em> - '.$bookingItemDetail->vehicleModel ?> (<?= $bookingItemDetail->vehicleRegistrationNo ?>)</span><span class="pr-2">£<?= number_format($bookingItemDetail->totalRate, 2) ?></span></h5>
                <p><?= getDateInUKFormat($bookingItemDetail->dateFrom) ?> - <?= getDateInUKFormat($bookingItemDetail->dateTo) ?><br/>
                £<?= $bookingItemDetail->dailyRate ?> per day<br/>
                <?php if($bookingItemDetail->isSelfDriving == 0) : ?>
                    From:&nbsp;<?= $bookingItemDetail->placeFrom?><br/>To:&nbsp;<?=$bookingItemDetail->placeTo?>
                <?php else : ?>
                    Self Driving
                <?php endif ?>
                </p>
                <?php if(new DateTime($bookingItemDetail->dateFrom) > new DateTime()) : ?>
                <button class="deleteBookingItemShowModalButtonSelector btn btn-outline-danger"
                    data-id="<?= $bookingItemDetail->id ?>" data-name="<?= $bookingItemDetail->id ?>" 
                    href="bookings.php?cmd=remove&id=<?= $bookingItemDetail->id ?>" role="button">Cancel</button>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>    
    
    <div class="row text-right">
        <div class="col-12">
            <a class="btn btn-outline-primary" href="browse.php?revisit=1" role="button">Search for Vehicles</a>
        </div>
    </div>    
</div>

<div class="modal" id="deleteBookingItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelBookingModalTitle">Cancel Booking Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="cancelBookingModalBody" class="modal-body">
                <form id="deleteBookingItemForm" action="bookings.php" method="POST">
                    <input type="hidden" id="deleteBookingItemAttempt" name="deleteBookingItemAttempt" value="1">
                    <input type="hidden" id="deleteBookingItemId" name="deleteBookingItemId" value="1">
                </form> 
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <i class="fas fa-minus-circle fa-4x"></i>
                        </div>
                        <div class="col-md-10 pt-3">
                            <span id="deleteBookingItemModalMessage"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="deleteBookingItemButton" type="submit" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#deleteBookingItemButton').on('click', function(e){
            $('#deleteBookingItemForm').submit();
        });
        
        $('.deleteBookingItemShowModalButtonSelector').each(function(index) {
            $(this).on('click', function(e){
                var deleteBookingItemId = $(this).attr('data-id');
                var deleteBookingItemName = $(this).attr('data-name');
                $('#deleteBookingItemId').val(deleteBookingItemId);
                $('#deleteBookingItemModalMessage').html('Cancel Booking No. ' + deleteBookingItemName + '?');
                $('#deleteBookingItemModal').modal('show');                
            });
        });
    });    
</script>