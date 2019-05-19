<div class="container pb-4 pt-4">
  <div class="row p-4">
    <div id="customersCard" class="col-md-4 p-4 bg-primary shadow border rounded text-white" style="cursor: pointer;">
      <i class="fa fa-users fa-4x"></i>
      <span class="display-4 ml-4 text-right"><?= $numberOfCustomers ?></span>       
    </div>
    <div id="promotionsCard" class="col-md-4 p-4 bg-success shadow border rounded text-white" style="cursor: pointer;">
      <i class="fa fa-calendar-day fa-4x"></i>
      <span class="display-4 ml-4 text-right"><?= $numberOfPromotions ?></span>       
    </div>
    <div id="vehiclesCard" class="col-md-4 p-4 bg-warning shadow border rounded text-white" style="cursor: pointer;">
      <i class="fa fa-bus fa-4x"></i>
      <span class="display-4 ml-4 text-right"><?= $numberOfVehicles ?></span>       
    </div>        
  </div>
</div>

<div class="container pb-4 pt-4">
  <div class="row">
    <div class="col-md-12">
      <canvas id="bookingsChart" style="max-width: 100%;"></canvas>
    </div>
  </div>
</div>

<script>

  $('#customersCard').click(function(){
    document.location.href = "customers.php";
  });

  $('#promotionsCard').click(function(){
    document.location.href = "promotions.php";
  });

  $('#vehiclesCard').click(function(){
    document.location.href = "vehicles.php";
  });

  $(document).ready(function () {
    $.getJSON('../api.php?cmd=getBookingReport', function (data) {

        var models = data.data;

        var labels = [];
        for(var i = 0; i < models.length; i++) {
          labels.push(models[i].month);
        }

        var values = [];
        for(var i = 0; i < models.length; i++) {
          values.push(models[i].noOfBookings);
        }

        var chartContext = document.getElementById("bookingsChart").getContext('2d');

        var bookingChart = new Chart(chartContext, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: 'Number of Bookings',
              data: values,
              backgroundColor: [
                'rgb(94,180,231)'
              ],
              borderColor: [
                'rgb(0,123,255)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });


    });
});

</script>
