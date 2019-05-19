
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 mb-4 mr-1">
        <form>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="pac-input-from">From</label>
                    <input id="pac-input-from" class="controls form-control" type="text" placeholder="Search Box">
                </div>
                <div class="form-group col-md-3">
                    <label for="pac-input-to">To</label>
                    <input id="pac-input-to" class="controls form-control" type="text" placeholder="Search Box">
                </div>            
            </div>
            <button type="submit" class="btn btn-success">Make Booking</button>
        </form>
    </div>
</div>

<div class="row">
    <?php foreach ($vehicleModelTypeList as $vehicleModelType): ?>
        <div class="col-3 col-md-3 col-lg-3 mb-4 mr-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="http://www.parkhurst.biz/images/rental/HK.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$vehicleModelType->model?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-success">Add to Basket</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script>
      function initAutocompleteForFromAndTo() {   
        initAutocompleteForInput('pac-input-from');
        initAutocompleteForInput('pac-input-to');
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
