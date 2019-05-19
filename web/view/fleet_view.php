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
        <h3 class="display-4">Our Fleet</h3>
    </div>
    <div class="col-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Model</th>
            <th scope="col">Standard</th>
            <th scope="col">Category</th>
            <th scope="col">Min.</th>
            <th scope="col">Max.</th>
            <th scope="col">Daily Rate</th>
          </tr>
        </thead>
        <tbody id="ourFleetContainer">

        </tbody>
      </table>
      <div id="ourFleetLoader" style="display:none;height:450px">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        $('#ourFleetLoader').show();

        // Slow the AJAX request to make it more obvious lol :)
        setTimeout(function() {
            $.getJSON('../web/api.php?cmd=getOurFleet', function (data) {

                var vehicles = data.data;

                if(vehicles.length == 0) {
                    $('#ourFleetLoader').hide();
                    $('#ourFleetContainer').hide();
                    return;
                }

                for(var i = 0; i < vehicles.length; i++) {
                    var vehicle = vehicles[i];
                    var html = '<tr>';
                    html +=      '<th scope="row">';
                    html +=       '<img width="100px" alt ="'+ vehicle.model+'" src="assets/images/vehicleModels/' + vehicle.model + '.jpg">';
                    html +=         vehicle.model;
                    html +=      '</th>';
                    html +=      '<td>' + vehicle.standard + '</td>';
                    html +=      '<td>' + vehicle.category + '</td>';
                    html +=      '<td>' + vehicle.minNoOfPassengers + '</td>';
                    html +=      '<td>' + vehicle.maxNoOfPassengers + '</td>';
                    html +=      '<td>' + vehicle.dailyRate + '</td>';
                    html +=    '</tr>';

                    $('#ourFleetContainer').append(html);
                }

                $('#ourFleetLoader').hide();

            });
        }, 250);
    });    
</script>
