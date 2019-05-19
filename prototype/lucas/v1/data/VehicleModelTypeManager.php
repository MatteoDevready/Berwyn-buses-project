<?php

require_once("config/settings.php");
require_once("config/error_handling.php");
require_once("model/VehicleModelType.php");

class VehicleModelTypeManager
{
    public function getDummyData() {

        $first = new VehicleModelType();
        $first->model = "Standard 6 Seat MPV";
        $first->maxNoOfPassengers = "6";
        $first->hourlyRate = "55";

        $second = new VehicleModelType();
        $second->model = "Executive 8 Seat MPV";
        $second->maxNoOfPassengers = "8";
        $second->hourlyRate = "65";

        $third = new VehicleModelType();
        $third->model = "10 Seat VIP Coach";
        $third->maxNoOfPassengers = "10";
        $third->hourlyRate = "55";

        $fourth = new VehicleModelType();
        $fourth->model = "10-14 Seat Standard Minibus";
        $fourth->maxNoOfPassengers = "14";
        $fourth->hourlyRate = "65";

        $fifth = new VehicleModelType();
        $fifth->model = "15-16 Seat Standard Minibus";
        $fifth->maxNoOfPassengers = "16";
        $fifth->hourlyRate = "85";

        $sixth = new VehicleModelType();
        $sixth->model = "10-16 Seat Standard Coach";
        $sixth->maxNoOfPassengers = "16";
        $sixth->hourlyRate = "70";

        $seventh = new VehicleModelType();
        $seventh->model = "17-24 Seat Standard Coach";
        $seventh->maxNoOfPassengers = "24";
        $seventh->hourlyRate = "80";
        
        $eigth = new VehicleModelType();
        $eigth->model = "25-33 Seat Standard Coach";
        $eigth->maxNoOfPassengers = "33";
        $eigth->hourlyRate = "120";
        
        $ninth = new VehicleModelType();
        $ninth->model = "34-49 Seat Standard Coach";
        $ninth->maxNoOfPassengers = "49";
        $ninth->hourlyRate = "130";
        
        $tenth = new VehicleModelType();
        $tenth->model = "70-73 Seat Double Deck Coach";
        $tenth->maxNoOfPassengers = "73";
        $tenth->hourlyRate = "150";
        
        $eleventh = new VehicleModelType();
        $eleventh->model = "72 Seat Bus";
        $eleventh->maxNoOfPassengers = "72";
        $eleventh->hourlyRate = "140";
        
        $twelth = new VehicleModelType();
        $twelth->model = "14-16 Seat Executive Mini Coach";
        $twelth->maxNoOfPassengers = "16";
        $twelth->hourlyRate = "90";
        
        $thirteenth = new VehicleModelType();
        $thirteenth->model = "17-24 Seat Executive Mini Coach";
        $thirteenth->maxNoOfPassengers = "24";
        $thirteenth->hourlyRate = "100";
        
        $fourteenth = new VehicleModelType();
        $fourteenth->model = "34-49 Seat VIP Coach";
        $fourteenth->maxNoOfPassengers = "49";
        $fourteenth->hourlyRate = "140";
        
        $vehicleModelTypes = [ $first, $second, $third, $fourth, $fifth, $sixth, $seventh, $eigth, $ninth, $tenth, $eleventh, $twelth, $thirteenth, $fourteenth ];

        return $vehicleModelTypes;
    }

    function getAll()
    {
        if(!USE_DUMMY_DATA) {
            die("Data access not implemented");
        }
        return $this->getDummyData();
    }

    function getAllByModel($model)
    {
        if(!USE_DUMMY_DATA) {
            die("Data access not implemented");
        }        

        if ($model == "")
        {
            return $this->getAll();
        }

        $vehicleModelTypes = $this->getAll();

        $result = [];
        foreach ($vehicleModelTypes as $vehicleModelType)
        {
            if (strpos($vehicleModelType->model, $model) !== false)
            {
                $result[] = $vehicleModelType;
            }
        }
        return $result;
    }
}



?>