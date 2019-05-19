<?php
    require_once("../web/imports.php");

    function getDummyData() {

        $first = new VehicleModel();
        $first->model = "Standard 6 Seat MPV";
        $first->maxNoOfPassengers = "6";
        $first->hourlyRate = "55";

        $second = new VehicleModel();
        $second->model = "Executive 8 Seat MPV";
        $second->maxNoOfPassengers = "8";
        $second->hourlyRate = "65";

        $third = new VehicleModel();
        $third->model = "10 Seat VIP Coach";
        $third->maxNoOfPassengers = "10";
        $third->hourlyRate = "55";

        $fourth = new VehicleModel();
        $fourth->model = "10-14 Seat Standard Minibus";
        $fourth->maxNoOfPassengers = "14";
        $fourth->hourlyRate = "65";

        $fifth = new VehicleModel();
        $fifth->model = "15-16 Seat Standard Minibus";
        $fifth->maxNoOfPassengers = "16";
        $fifth->hourlyRate = "85";

        $sixth = new VehicleModel();
        $sixth->model = "10-16 Seat Standard Coach";
        $sixth->maxNoOfPassengers = "16";
        $sixth->hourlyRate = "70";

        $seventh = new VehicleModel();
        $seventh->model = "17-24 Seat Standard Coach";
        $seventh->maxNoOfPassengers = "24";
        $seventh->hourlyRate = "80";
        
        $eigth = new VehicleModel();
        $eigth->model = "25-33 Seat Standard Coach";
        $eigth->maxNoOfPassengers = "33";
        $eigth->hourlyRate = "120";
        
        $ninth = new VehicleModel();
        $ninth->model = "34-49 Seat Standard Coach";
        $ninth->maxNoOfPassengers = "49";
        $ninth->hourlyRate = "130";
        
        $tenth = new VehicleModel();
        $tenth->model = "70-73 Seat Double Deck Coach";
        $tenth->maxNoOfPassengers = "73";
        $tenth->hourlyRate = "150";
        
        $eleventh = new VehicleModel();
        $eleventh->model = "72 Seat Bus";
        $eleventh->maxNoOfPassengers = "72";
        $eleventh->hourlyRate = "140";
        
        $twelth = new VehicleModel();
        $twelth->model = "14-16 Seat Executive Mini Coach";
        $twelth->maxNoOfPassengers = "16";
        $twelth->hourlyRate = "90";
        
        $thirteenth = new VehicleModel();
        $thirteenth->model = "17-24 Seat Executive Mini Coach";
        $thirteenth->maxNoOfPassengers = "24";
        $thirteenth->hourlyRate = "100";
        
        $fourteenth = new VehicleModel();
        $fourteenth->model = "34-49 Seat VIP Coach";
        $fourteenth->maxNoOfPassengers = "49";
        $fourteenth->hourlyRate = "140";
        
        $vehicleModelTypes = [ $first, $second, $third, $fourth, $fifth, $sixth, $seventh, $eigth, $ninth, $tenth, $eleventh, $twelth, $thirteenth, $fourteenth ];

        return $vehicleModelTypes;
    }    

    $vehicleModels = getDummyData();

    foreach ($vehicleModels as $vehicleModel) {
        $pdo = BookingDatabase::getInstance()->getPDO();
        $statement = $pdo->prepare("INSERT INTO VehicleModel(model, maxNoOfPassengers, hourlyRate)
                                        VALUES(:model, :maxNoOfPassengers, :hourlyRate)");
        $statement->bindValue(":model", $vehicleModel->model);
        $statement->bindValue(":maxNoOfPassengers", $vehicleModel->maxNoOfPassengers, PDO::PARAM_INT);
        $statement->bindValue(":hourlyRate", $vehicleModel->hourlyRate, PDO::PARAM_INT);
        //$statement->execute();
    }

    

?>