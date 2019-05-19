<div class="container mt-4">
    <h2 class="text-primary">Promotions<a class="btn btn-success float-right" href="promotions_add.php" role="button">Add Promotion</a></h2>
    <?php if($onPromotionDeletedMessage != "") : ?>
        <div class="alert alert-success" role="alert">
            <?= $onPromotionDeletedMessage ?>
        </div>    
    <?php endif ?>

    <div class="mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Vehicle Model</th>
                <th>Title</th>
                <th>Info</th>
                <th>Daily Rate</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($promotions as $promotion): ?>
                <tr>
                    <td><?= $promotion->id ?></td>
                    <td><?= $promotion->model ?></td>
                    <td><?= $promotion->title ?></td>
                    <td><?= $promotion->info ?></td>
                    <td><?= $promotion->dailyRate ?></td>
                    <td><?= getDateInUKFormat($promotion->expiringDate) ?></td>
                    <td width="180px">
                        <button type="button" class="deletePromotionShowModalButtonSelector btn btn-danger" data-id="<?= $promotion->id ?>" data-name="<?= $promotion->title ?>">Delete</button>
                        <a class="btn btn-success" href="promotions_edit.php?id=<?= $promotion->id ?>" role="button">Edit</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="deletePromotionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePromotionModalTitle">Delete Promotion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="deletePromotionModalBody" class="modal-body">
                    <form id="deletePromotionForm" action="promotions.php" method="POST">
                        <input type="hidden" id="deletePromotionAttempt" name="deletePromotionAttempt" value="1">
                        <input type="hidden" id="deletePromotionId" name="deletePromotionId" value="1">
                    </form> 
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <i class="fas fa-minus-circle fa-4x"></i>
                            </div>
                            <div class="col-md-10 pt-3">
                                <span id="deletePromotionModalMessage"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="deletePromotionButton" type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#deletePromotionButton').on('click', function(e){
                $('#deletePromotionForm').submit();
            });
            
            $('.deletePromotionShowModalButtonSelector').each(function(index) {
                $(this).on('click', function(e){
                    var deletePromotionId = $(this).attr('data-id');
                    var deletePromotionName = $(this).attr('data-name');
                    $('#deletePromotionId').val(deletePromotionId);
                    $('#deletePromotionModalMessage').html('Delete promotion "' + deletePromotionName + '"?');
                    $('#deletePromotionModal').modal('show');                
                });
            });
        });    
    </script>