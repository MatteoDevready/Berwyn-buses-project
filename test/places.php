<?php
    require_once("../web/includes/header.php")
?>

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

<?php
    require_once("../web/includes/footer.php")
?>