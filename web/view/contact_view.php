<div id="jumbotron" class="jumbotron jumbotron text-white">
    <div class="container">
        <h1 class="display-4">We are excited to have you here</h1>
        <p class="lead">The safe and reliable way to hire great value transport across London and the South East.</p>
    </div>
    <style>
        #jumbotron{
            background-image: url("assets/images/travel.png");
            background-position: center;
        }
    </style>    
</div>
<div class="container mainContentContainer">
    <div class="row justify-content-center">
        <div class="col-md-6 border shadow-lg bg-white rounded">
            <div class="modal-header">
                    <h5 class="modal-title display-4" id="contactModalTitle">Contact Us</h5>
                </div>
                <div id="contactModalBody" class="modal-body">
                <p>Please use the form below to contact us.</p>
                <?php if ($contactUsMessage != ""):?>
                <div class="alert alert-success" role="alert">
                    <?= $contactUsMessage ?>
                </div>
                    <?php endif ?>
                    <form id="contactForm" action="contact.php" method="POST">
                        <input type="hidden" id="contactAttempt" name="contactAttempt" value="1">
                        <?php if ($authUser->isSignedIn == 0) : ?>
                            <div class="form-group">
                                <label for="emailAddress">Email address</label>
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email address">
                            </div>
                        <?php endif ?>
                        <div class="form-group">
                            <label for="message">Message</label>
                            
                            <textarea class="form-control" rows="8" id="message" name="message" placeholder="Write your message here >"></textarea>
                        </div>
                    </form> 
                    <?php if ($authUser->isSignedIn == 0 ):?>
                    <span><p><a href="signup.php?url=contact.php&from=contact.php">Sign Up</a></p>
                    </span> 
                    <span><p><a href="signin.php?url=contact.php&from=contact.php"> or Sign in </a>to receive quicker support</p>
                    </span>
                    <?php endif?>
                </div>
                <div class="modal-footer">
                    <button id="contactButton" type="submit" class="btn btn-success">Contact Us</button>
                </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#contactButton').on('click', function(e){
            $('#contactForm').submit();
        });
    });    
</script>


<div class="container border rounded p-4 shadow-lg">
    <h3>Directions</h3>
    <iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=Penrhyn%20Rd%2C%20Kingston%20upon%20Thames%20KT1%202EE+(Berwyn%20Buses%20Hire%20LTD)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/map-my-route/">Map a route</a></iframe>
</div>



    