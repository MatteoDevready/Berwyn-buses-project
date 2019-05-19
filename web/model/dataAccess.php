<?php
    
    class BookingDatabase {
        
        private static $instance = null;
        private $pdo;

        private function __construct()
        {
            if(DEBUG_MODE) {
                $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } else {
                $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            }            
            
        }
        
        public static function getInstance()
        {
            if(!self::$instance)
            {
                self::$instance = new BookingDatabase();
            }
            
            return self::$instance;
        }
        
        public function getPDO()
        {
            return $this->pdo;
        }        
    
        function addLog($authUser, $url) {
            $pdo = $this->getPDO();
            
            $statement = $pdo->prepare("INSERT INTO Log(fullName, url)
                                            VALUES (:fullName, :url)");

            $fullName = trim($authUser->firstName." ".$authUser->lastName);

            $statement->bindParam(":fullName", $fullName);
            $statement->bindParam(":url", $url);

            return $statement->execute();
        }

        function getAllVehicleModels() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM VehicleModel");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleModel");
            return $results;
        }  

        function getAllVehicleModelDetails() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM vw_vehiclemodel ORDER BY minNoOfPassengers");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleModel");
            return $results;
        }  
        
        function getVehicleModel($vehicleModelId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            vm.*
                                        FROM 
                                            vw_vehiclemodel vm 
                                        WHERE 
                                            vm.id = :vehicleModelId");
            $statement->bindParam(":vehicleModelId", $vehicleModelId, PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleModel");
            return $results[0];
        }

        function getNumberOfCustomers() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT COUNT(*) as NumberOfCustomers FROM Customer");
            $statement->execute();
            $result = $statement->fetch();
            return intval($result[0]);
        }

        function getUsers($emailAddress, $password) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM Customer 
                            WHERE emailAddress=:emailAddress AND password=:password");
            $statement->bindParam(":emailAddress", $emailAddress);
            $statement->bindParam(":password", $password);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "User");
            return $result;
        }

        function getAllCustomers() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM Customer ORDER BY id ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Customer");
            return $result;
        } 
        
        function addCustomer($customer) {
            $pdo = $this->getPDO();
            $query = $pdo->prepare("SELECT id FROM Customer WHERE emailAddress = :emailAddress");
            $query->bindParam(":emailAddress", $customer->emailAddress);
            $query->execute();
            $existingCustomers = $query->fetchAll(PDO::FETCH_CLASS, "Customer");

            if(sizeof($existingCustomers) > 0) {
                throw new AppException("Email address already in use.");
            }

            $statement = $pdo->prepare("INSERT INTO Customer(firstName, lastName, emailAddress, password, companyName, phoneNo, isAdministrator)
                                            VALUES (:firstName, :lastName, :emailAddress, :password, :companyName, :phoneNo, :isAdministrator)");
            $statement->bindParam(":firstName", $customer->firstName);
            $statement->bindParam(":lastName", $customer->lastName);
            $statement->bindParam(":emailAddress", $customer->emailAddress);
            $statement->bindParam(":password", $customer->password);
            $statement->bindParam(":companyName", $customer->companyName);
            $statement->bindParam(":phoneNo", $customer->phoneNo);
            $statement->bindParam(":isAdministrator", $customer->isAdministrator, PDO::PARAM_INT);

            return $statement->execute();
        }

        function updateCustomer($customer) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("UPDATE Customer 
                                            SET id = :id, 
                                                firstName = :firstName,
                                                lastName = :lastName,
                                                emailAddress = :emailAddress, 
                                                password = :password, 
                                                companyName = :companyName,
                                                phoneNo = :phoneNo,
                                                isAdministrator = :isAdministrator
                                            WHERE id = :id");
            $statement->bindParam(":id", $customer->id, PDO::PARAM_INT);
            $statement->bindParam(":firstName", $customer->firstName);
            $statement->bindParam(":lastName", $customer->lastName);
            $statement->bindParam(":emailAddress", $customer->emailAddress);
            $statement->bindParam(":password", $customer->password);
            $statement->bindParam(":companyName", $customer->companyName);
            $statement->bindParam(":phoneNo", $customer->phoneNo);
            $statement->bindParam(":isAdministrator", $customer->isAdministrator);

            return $statement->execute();          
        }

        function deleteCustomer($customerId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("DELETE FROM Customer WHERE id = :customerId");
            $statement->bindParam(":customerId", $customerId, PDO::PARAM_INT);
            return $statement->execute();
        }

        function getCustomerById($customerId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM Customer WHERE id = :customerId LIMIT 1");
            $statement->bindParam(":customerId", $customerId, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Customer");
            return sizeof($result) == 0 ? null : $result[0];
        }   

        function getCurrentPromotions() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            p.*,
                                            vm.model 
                                        FROM 
                                            Promotion p
                                        JOIN
                                            VehicleModel vm
                                        ON
                                            p.vehicleModelId = vm.id
                                        WHERE expiringDate > CURDATE()  
                                        ORDER BY expiringDate ASC LIMIT 3");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Promotion");
            return $result;
        }     
        
        function getCurrentVehicles() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            v.*,
                                            vm.* 
                                        FROM 
                                            Vehicle v
                                        JOIN
                                            VehicleModel vm
                                        ON
                                            v.vehicleModelId = vm.id  
                                        ORDER BY registrationDate DESC LIMIT 3");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleDetail");
            return $result;
        }     
        function getAllPromotions() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT p.*, vm.model 
                                        FROM Promotion p 
                                        JOIN VehicleModel vm 
                                        ON p.vehicleModelId = vm.id 
                                        ORDER BY p.id ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Promotion");
            return $result;
        } 
        
        function getAllVehicles() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT v.*, vm.model
                                    
                                     FROM Vehicle v 
                                     JOIN VehicleModel vm
                                     ON v.vehicleModelId = vm.id
                                     ORDER BY v.registrationDate DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
            return $result;
        }  

        function getVehicleById($vehicleId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM Vehicle WHERE id = :vehicleId LIMIT 1");
            $statement->bindParam(":vehicleId", $vehicleId, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
            return sizeof($result) == 0 ? null : $result[0];
        } 

        function updateVehicle($vehicle) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("UPDATE Vehicle 
                                            SET id = :id, 
                                                registrationNo = :registrationNo,
                                                registrationDate = :registrationDate,
                                                vehicleModelId = :vehicleModelId
                                            WHERE id = :id");
            $statement->bindParam(":id", $vehicle->id, PDO::PARAM_INT);
            $statement->bindParam(":registrationNo", $vehicle->registrationNo);
            $statement->bindParam(":registrationDate", $vehicle->registrationDate);
            $statement->bindParam(":vehicleModelId", $vehicle->vehicleModelId, PDO::PARAM_INT);

            return $statement->execute();          
        }

        function addVehicle($vehicle) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("INSERT INTO Vehicle(registrationNo, registrationDate, vehicleModelId)
                                            VALUES (:registrationNo, :registrationDate, :vehicleModelId)");
            $statement->bindParam(":registrationNo", $vehicle->registrationNo);
            $statement->bindParam(":registrationDate", $vehicle->registrationDate);
            $statement->bindParam(":vehicleModelId", $vehicle->vehicleModelId, PDO::PARAM_INT);

            return $statement->execute();
        }

        function addPromotion($promotion) {
            $pdo = $this->getPDO();
            
            $statement = $pdo->prepare("INSERT INTO Promotion(vehicleModelId, title, info, dailyRate, expiringDate)
                                            VALUES (:vehicleModelId, :title, :info, :dailyRate, :expiringDate)");
            $statement->bindParam(":vehicleModelId", $promotion->vehicleModelId, PDO::PARAM_INT);
            $statement->bindParam(":title", $promotion->title);
            $statement->bindParam(":info", $promotion->info);
            $statement->bindParam(":dailyRate", $promotion->dailyRate);
            $statement->bindParam(":expiringDate", $promotion->expiringDate);

            return $statement->execute();
        }

        function updatePromotion($promotion) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("UPDATE Promotion 
                                            SET id = :id, 
                                                title = :title,
                                                info = :info,
                                                vehicleModelId = :vehicleModelId, 
                                                dailyRate = :dailyRate,
                                                expiringDate = :expiringDate
                                            WHERE id = :id");
            $statement->bindParam(":id", $promotion->id, PDO::PARAM_INT);
            $statement->bindParam(":title", $promotion->title);
            $statement->bindParam(":info", $promotion->info);
            $statement->bindParam(":vehicleModelId", $promotion->vehicleModelId);
            $statement->bindParam(":dailyRate", $promotion->dailyRate);
            $statement->bindParam(":expiringDate", $promotion->expiringDate);

            return $statement->execute();          
        }

        function deleteVehicle($vehicleId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("DELETE FROM Vehicle WHERE id = :vehicleId");
            $statement->bindParam(":vehicleId", $vehicleId, PDO::PARAM_INT);
            return $statement->execute();
        }

        function deletePromotion($promotionId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("DELETE FROM Promotion WHERE id = :promotionId");
            $statement->bindParam(":promotionId", $promotionId, PDO::PARAM_INT);
            return $statement->execute();
        }
        
        function getNumberOfPromotions() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT COUNT(*) as NumberOfPromotions FROM Promotion");
            $statement->execute();
            $result = $statement->fetch();
            return intval($result[0]);
        }

        function getPromotionById($promotionId) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM Promotion WHERE id = :promotionId LIMIT 1");
            $statement->bindParam(":promotionId", $promotionId, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Promotion");
            return sizeof($result) == 0 ? null : $result[0];
        }   
        
        function getNumberOfVehicles() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT COUNT(*) as NumberOfVehicles FROM Vehicle");
            $statement->execute();
            $result = $statement->fetch();
            return intval($result[0]);
        }
        
        function addBooking($booking) {
            $pdo = $this->getPDO();
            
            $statement = $pdo->prepare("INSERT INTO Booking(customerId, dateCreated, bookingStatusId)
                                            VALUES (:customerId, :dateCreated, :bookingStatusId)");
            $statement->bindParam(":customerId", $booking->customerId, PDO::PARAM_INT);
            $statement->bindParam(":dateCreated", $booking->dateCreated);
            $statement->bindParam(":bookingStatusId", $booking->bookingStatusId);

            return $statement->execute();
        }        

        function addBookingItem($bookingItem) {
            $pdo = $this->getPDO();
            
            $statement = $pdo->prepare("INSERT INTO BookingItem(bookingId, dateCreated, placeFrom, placeTo, dateFrom, dateTo, passengerNo, isSelfDriving, preferredDriver, dailyRate, totalRate)
                                            VALUES (:bookingId, :dateCreated, :placeFrom, :placeTo, :dateFrom, :dateTo, :passengerNo, :isSelfDriving, :preferredDriver, :dailyRate, :totalRate)");

            $statement->bindParam(":bookingId", $bookingItem->bookingId, PDO::PARAM_INT);
            $statement->bindParam(":dateCreated", $bookingItem->dateCreated);
            $statement->bindParam(":placeFrom", $bookingItem->placeFrom);
            $statement->bindParam(":placeTo", $bookingItem->placeTo);
            $statement->bindParam(":dateFrom", $bookingItem->dateFrom);
            $statement->bindParam(":dateTo", $bookingItem->dateTo);
            $statement->bindParam(":passengerNo", $bookingItem->passengerNo);
            $statement->bindParam(":isSelfDriving", $bookingItem->isSelfDriving);
            $statement->bindParam(":preferredDriver", $bookingItem->preferredDriver);
            $statement->bindParam(":dailyRate", $bookingItem->dailyRate);
            $statement->bindParam(":totalRate", $bookingItem->totalRate);

            $statement->execute();

            return $pdo->lastInsertId();
        }
        
        function deleteBookingItem($bookingItem) {
            $pdo = $this->getPDO();

            $statement = $pdo->prepare("DELETE FROM BookingItemSchedule WHERE bookingItemId = :id");
            $statement->bindParam(":id", $bookingItem->id, PDO::PARAM_INT);          
            $statement->execute();            

            $statement = $pdo->prepare("DELETE FROM BookingItem WHERE id = :id");
            $statement->bindParam(":id", $bookingItem->id, PDO::PARAM_INT);
            return $statement->execute();
        }        

        function deleteBookingItemById($bookingItemId) {
            $pdo = $this->getPDO();

            $statement = $pdo->prepare("DELETE FROM BookingItemSchedule WHERE bookingItemId = :id");
            $statement->bindParam(":id", $bookingItemId, PDO::PARAM_INT);          
            $statement->execute();            

            $statement = $pdo->prepare("DELETE FROM BookingItem WHERE id = :id");
            $statement->bindParam(":id", $bookingItemId, PDO::PARAM_INT);
            return $statement->execute();
        } 

        function getAllBookings() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM Booking ORDER BY id ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Booking");
            return $result;
        }         
        
        function deleteBooking($booking) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("DELETE FROM Booking WHERE id = :id");
            $statement->bindParam(":id", $booking->id, PDO::PARAM_INT);
            return $statement->execute();
        }

        function getAllBookingItems() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT * FROM BookingItem ORDER BY id ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "BookingItem");
            return $result;
        }
        
        function getBookingItemDetails($authUser) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            bi.*,
                                            b.dateCreated as bookingDateCreated,
                                            bs.status as bookingStatus,
                                            v.registrationNo as vehicleRegistrationNo,
                                            vm.model as vehicleModel
                                        FROM 
                                            BookingItem bi
                                        JOIN
                                            Booking b
                                        ON
                                            bi.bookingId = b.id
                                        JOIN
                                            BookingStatus bs
                                        ON
                                            b.bookingStatusId = bs.id
                                        JOIN
                                            Vehicle v
                                        ON
                                            bi.vehicleId = v.id
                                        JOIN
                                            VehicleModel vm
                                        ON
                                            v.vehicleModelId = vm.id
                                        WHERE
                                            b.customerId = :customerId
                                        ORDER BY b.dateCreated DESC");
            $statement->bindParam(":customerId", $authUser->id, PDO::PARAM_INT);                                        
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "BookingItemDetail");
            return $result;
        }

        function updateBookingItem($bookingItem) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("UPDATE BookingItem 
                                            SET bookingId = :bookingId, 
                                                placeFrom = :placeFrom,
                                                placeTo = :placeTo,
                                                dateFrom = :dateFrom,
                                                dateTo = :dateTo,
                                                dateCreated = :dateCreated,
                                                passengerNo = :passengerNo,
                                                isSelfDriving = :isSelfDriving,
                                                preferredDriver = :preferredDriver,
                                                vehicleId = :vehicleId
                                            WHERE id = :id");
            $statement->bindParam(":id", $bookingItem->id, PDO::PARAM_INT);
            $statement->bindParam(":bookingId", $bookingItem->bookingId, PDO::PARAM_INT);
            $statement->bindParam(":placeFrom", $bookingItem->placeFrom);
            $statement->bindParam(":placeTo", $bookingItem->placeTo);
            $statement->bindParam(":dateFrom", $bookingItem->dateFrom);
            $statement->bindParam(":dateTo", $bookingItem->dateTo);
            $statement->bindParam(":dateCreated", $bookingItem->dateCreated);
            $statement->bindParam(":passengerNo", $bookingItem->passengerNo);
            $statement->bindParam(":isSelfDriving", $bookingItem->isSelfDriving);
            $statement->bindParam(":preferredDriver", $bookingItem->preferredDriver);
            $statement->bindParam(":vehicleId", $bookingItem->vehicleId);

            return $statement->execute();          
        } 
        
        function addBookingItemSchedule($bookingItemSchedule) {
            $pdo = $this->getPDO();
            
            $statement = $pdo->prepare("INSERT INTO BookingItemSchedule(bookingItemId, dateBooked)
                                            VALUES (:bookingItemId, :dateBooked)");
            $statement->bindParam(":bookingItemId", $bookingItemSchedule->bookingItemId, PDO::PARAM_INT);
            $statement->bindParam(":dateBooked", $bookingItemSchedule->dateBooked);

            $statement->execute();

            return $pdo->lastInsertId();
        }      
        
        function getVehicleModelsByPassengerNo($passengerNo) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT
                                            vm.*
                                        FROM
                                            VehicleModel vm
                                        WHERE
                                            vm.minNoOfPassengers >= :passengerNo
                                        ORDER BY
                                            vm.minNoOfPassengers ASC");
            $statement->bindParam(":passengerNo", $passengerNo, PDO::PARAM_INT);                                            
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleModel");
            return $result;
        }

        function getAvailableVehicles($vehicleModelId, $dateFrom, $dateTo) {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            v.* 
                                        FROM 
                                            Vehicle v 
                                        WHERE v.id 
                                            NOT IN (SELECT DISTINCT vehicleid FROM vw_bookingitemschedule WHERE (datebooked BETWEEN :dateFrom AND :dateTo))
                                        AND 
                                            v.vehiclemodelid = :vehicleModelId
                                        LIMIT 1");
            $statement->bindParam(":vehicleModelId", $vehicleModelId, PDO::PARAM_INT);                                            
            $statement->bindParam(":dateFrom", $dateFrom);                                            
            $statement->bindParam(":dateTo", $dateTo);                                            
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
            return $result;            
        }

        function getBookingReport() {
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT
                                            MONTHNAME(bi.dateFrom) as month,
                                            COUNT(bi.id) as noOfBookings
                                        FROM
                                            BookingItem bi
                                        GROUP BY
                                            MONTH(bi.dateFrom)");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "BookingReport");
            return $result;
        }
        
        function getVehicleModelsByQuery($vehicleModelQuery) {
            $pdo = $this->getPDO();

            $sql = "SELECT DISTINCT
                        vm.*
                    FROM
                        Vehicle v
                    JOIN
                        vw_vehiclemodel vm
                    ON
                        v.vehicleModelId = vm.id
                    WHERE
                        v.id NOT IN (
                            SELECT DISTINCT
                                vehicleid 
                            FROM 
                                vw_bookingitemschedule 
                            WHERE (datebooked BETWEEN :dateFrom AND :dateTo)) ";

            if($vehicleModelQuery->passengerNo > 0) {
                $sql = $sql." AND (vm.minNoOfPassengers <= $vehicleModelQuery->passengerNo AND vm.maxNoOfPassengers >= $vehicleModelQuery->passengerNo)";
            }

            if($vehicleModelQuery->vehicleStandardId > 0) {
                $sql = $sql." AND vm.vehicleStandardId = $vehicleModelQuery->vehicleStandardId";
            }

            if($vehicleModelQuery->licenceCategoryId > 0) {
                $sql = $sql." AND vm.licenceCategoryId = $vehicleModelQuery->licenceCategoryId";
            }

            if($vehicleModelQuery->minDailyRate > 0 && $vehicleModelQuery->maxDailyRate > 0) {
                $sql = $sql." AND vm.dailyRate >= $vehicleModelQuery->minDailyRate AND vm.dailyRate <= $vehicleModelQuery->maxDailyRate";
            }
            else if($vehicleModelQuery->minDailyRate > 0) {
                $sql = $sql." AND vm.dailyRate >= $vehicleModelQuery->minDailyRate";
            }
            else if($vehicleModelQuery->maxDailyRate > 0) {
                $sql = $sql." AND vm.dailyRate <= $vehicleModelQuery->maxDailyRate";
            }

            $statement = $pdo->prepare($sql);
            $statement->bindParam(":dateFrom", $vehicleModelQuery->dateFrom);                                            
            $statement->bindParam(":dateTo", $vehicleModelQuery->dateTo);                                            
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleModel");
            return $result;            
        }

        function getVehicleModelTotal($vehicleModelQuery, $vehicleModel) {
            
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            COUNT(id) 
                                        FROM 
                                            Vehicle 
                                        WHERE 
                                            id NOT IN (SELECT DISTINCT 
                                                            vehicleid 
                                                        FROM 
                                                            vw_bookingitemschedule
                                                        WHERE 
                                                            (datebooked BETWEEN :dateFrom AND :dateTo))
                                        AND
                                            vehicleModelId = :vehicleModelId
            ");
            $id = $vehicleModel->id;
            $statement->bindParam(":vehicleModelId", $id, PDO::PARAM_INT);
            $statement->bindParam(":dateFrom", $vehicleModelQuery->dateFrom);                                            
            $statement->bindParam(":dateTo", $vehicleModelQuery->dateTo);            
            $statement->execute();
            $result = $statement->fetch();
            return intval($result[0]);              
        }

        function getVehicleModelTotal2($vehicleModel, $dateFrom, $dateTo) {
            
            $pdo = $this->getPDO();
            $statement = $pdo->prepare("SELECT 
                                            COUNT(id) 
                                        FROM 
                                            Vehicle 
                                        WHERE 
                                            id NOT IN (SELECT DISTINCT 
                                                            vehicleid 
                                                        FROM 
                                                            vw_bookingitemschedule
                                                        WHERE 
                                                            (datebooked BETWEEN :dateFrom AND :dateTo))
                                        AND
                                            vehicleModelId = :vehicleModelId
            ");
            $statement->bindParam(":vehicleModelId", $vehicleModel->id, PDO::PARAM_INT);
            $statement->bindParam(":dateFrom", $dateFrom);                                            
            $statement->bindParam(":dateTo", $dateTo);            
            $statement->execute();
            $result = $statement->fetch();
            return intval($result[0]);              
        }

        function checkout($authUser, $basketItems) {

            // Ensure the customer is signed in
            if(!$authUser->isSignedIn) {
                throw new AppException("You must be signed in to checkout.");
            }

            // Ensure the basket item array in not empty
            if(sizeof($basketItems) == 0) {
                throw new AppException("You have nothing in your basket");
            }

            // Get the connection object
            $pdo = $this->getPDO();

            // Create a new booking
            $booking = new Booking();
            $booking->customerId = $authUser->id;

            $currentDate = new DateTime();
            $booking->dateCreated = $currentDate->format("Y-m-d");

            $booking->bookingStatusId = 1;

            // Add the booking to the db using addBooking function above
            $this->addBooking($booking);

            // Get the id for this newly inserted booking
            $booking->id = $pdo->lastInsertId();

            // Now go through the basket items
            // and add a booking item for each basket item
            $unallocatedVehicleCount = 0;
            foreach($basketItems as $basketItem) {

                // Create a new booking item
                $bookingItem = new BookingItem();
                $bookingItem->bookingId = $booking->id;
                $bookingItem->placeFrom = $basketItem->placeFrom;
                $bookingItem->placeTo = $basketItem->placeTo;
                $bookingItem->dateFrom = $basketItem->dateFrom;
                $bookingItem->dateTo = $basketItem->dateTo;
                $bookingItem->dateCreated = $currentDate->format("Y-m-d");
                $bookingItem->passengerNo = $basketItem->passengerNo;
                $bookingItem->isSelfDriving = $basketItem->isSelfDriving;
                $bookingItem->preferredDriver = $basketItem->preferredDriver;
                $bookingItem->dailyRate = $basketItem->dailyRate;
                $bookingItem->totalRate = $basketItem->totalRate;

                // Add the booking item to the db using addBookingItem function above
                $this->addBookingItem($bookingItem);
                
                // Get the id for this newly inserted booking item
                $bookingItem->id = $pdo->lastInsertId();

                $basketItem->bookingItemId = $bookingItem->id;

                // Prepare date to fill in the booking item schedule
                $dateFrom = new DateTime($bookingItem->dateFrom);
                $dateTo = new DateTime($bookingItem->dateTo);           
                $dateBooked = $dateFrom;

                // Create a bookingitemschedule record for each date
                // between dateFrom and dateTo
                do
                {
                    $bookingItemSchedule = new BookingItemSchedule();
                    $bookingItemSchedule->bookingItemId = $bookingItem->id;
                    $bookingItemSchedule->dateBooked = $dateBooked->format("Y-m-d");
                    $this->addBookingItemSchedule($bookingItemSchedule);
                    $dateBooked->add(new DateInterval("P1D"));
                } while($dateBooked <= $dateTo);

                // Get a list of possible vehicles to assign to this booking item
                $possibleVehicles = $this->getAvailableVehicles($basketItem->vehicleModelId, $bookingItem->dateFrom, $bookingItem->dateTo);
                
                // Find a possible vehicle to assign
                $basketItem->vehicleId = 0;
                if($possibleVehicles != null && sizeof($possibleVehicles) > 0) {
                    $possibleVehicle = $possibleVehicles[0];
                    $bookingItem->vehicleId = $possibleVehicle->id;
                    // Update the booking item with the vehicle id using updateBookingItem function above
                    $this->updateBookingItem($bookingItem);
                    // Update the basket item with the allocated vehicle id
                    $basketItem->vehicleId = $bookingItem->vehicleId;
                } 

                // If the basket item has no allocated vehicle, cancel the booking item
                // by deleting it from the db
                if($basketItem->vehicleId == 0) {
                    $unallocatedVehicleCount++;
                    // Delete the booking item from the db using the deleteBookingItem function above
                    // Note: This will delete records inserted into the bookingitemschedule as well.
                    $this->deleteBookingItem($bookingItem);
                }
            }

            // Sort out any vehicle allocation issues
            if(sizeof($basketItems) == $unallocatedVehicleCount) {
                $this->deleteBooking($booking);
                if(sizeof($basketItems) == 1) {
                    throw new AppException("The booking could not be completed. No vehicle was available for allocation.");
                }
                else {
                    throw new AppException("The booking could not be completed. No vehicles were available for allocation.");
                }
                
            }
            else if($unallocatedVehicleCount == 1) {
                throw new AppException("The booking could not be completed in full. A vehicle could not be allocated.");
            }
            else if($unallocatedVehicleCount > 1) {
                throw new AppException("The booking could not be completed in full. $unallocatedVehicleCount vehicles could not be allocated.");
            }
        }
        
        function addContactUs($contactUs) {
            $pdo = $this->getPDO();
            
            $statement = $pdo->prepare("INSERT INTO ContactUs(emailAddress, message)
                                            VALUES (:emailAddress, :message)");

            $statement->bindParam(":emailAddress", $contactUs->emailAddress);
            $statement->bindParam(":message", $contactUs->message);

            return $statement->execute();
        }
    }
?>