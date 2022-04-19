<?php 
    
    class Cart
    {
        public function pointsToEuro($points) 
        {
            include_once "../models/carteModel.php" ;
            
            $euros = $points * 0.2 ; 

            return $euros ; 
        }

        public function getPoints($id)
        {
            include_once "../models/carteModel.php" ; 

            $points = CarteModel::pointsCount($id) ;
            
            return $points ; 
        }

        public function updateClientPoints($points , $client) 
        {
            include_once "../models/carteModel.php" ; 

            CarteModel::updatePoints($points , $client) ; 

        }
        
        public function updateClientPointsAdd($amount , $client) 
        {
          
            include_once "../models/carteModel.php" ; 

            if ($amount > 100) 
            {
                $bonus = (int)$amount / 100 ;
                $pointsValue = $amount * 0.3 ;  
            }
            else
            {
                $bonus = 0 ; 
                $pointsValue = $amount * 0.3 ; 
            }

            $total = $bonus + $pointsValue ; 

            CarteModel::updatePointsAdd($total , $client) ; 
            
        }
    }
