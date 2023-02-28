<?php
namespace Hotel;

use DateTime;
use Hotel\BaseService;
use Exception;

class Room extends BaseService
{   
    
    public function get($roomId)
    {
        $parameters= [":room_id"=> $roomId];

        return $this->fetch('SELECT * FROM room WHERE room_id = :room_id', $parameters);

    }

    public function getCities()
    {
        //Get all cities
        $cities = [];
        try {
            $rows = $this->fetchAll('SELECT DISTINCT city FROM room');
            foreach($rows as  $row)
            {
                $cities[] = $row['city'];
            }
        } catch (Exception $ex) {

        }
        
        return $cities;
    }

    public function getCountOfGuests()
    {
        //Get all guests
        $countOfGuests = [];
        $rows = $this->fetchAll('SELECT DISTINCT count_of_guests FROM room');

        foreach($rows as  $row)
        {
            $countOfGuests[] = $row['count_of_guests'];
        }
        return $countOfGuests;
    }

    public function search($checkInDate, $checkOutDate, $city, $offset="", $limit="", $typeId="", $countOfGuests="", $minPrice="", $maxPrice="", $sortByChoise="")
    {
        //Setup parameters
        $parameters= [
            ":check_in_date"=> $checkInDate->format(DateTime::ATOM),
            ":check_out_date"=> $checkOutDate->format(DateTime::ATOM),
            ":city"=> $city,
        ];
            
        
        if (!empty($typeId)) {
            $parameters[':type_id'] = $typeId;
        }
        if (!empty($countOfGuests)) {
            $parameters[':count_of_guests'] = $countOfGuests;
        }
        
        if (!empty($minPrice)) {
            $parameters[':min_price'] = $minPrice;
        }
        
        if (!empty($maxPrice)) {
            $parameters[':max_price'] = $maxPrice;
        }

        
        // Bind Column
        if (!empty($sortByChoise)) {
            $parameters['sort_by'] = $sortByChoise;
        }

        // Build query
        $sql = 'SELECT room_id FROM room WHERE city = :city AND ';
        
        $paginationRulesSet = $offset!=="" && $limit!=="";
        
        if ($paginationRulesSet) {
            $parameters[':offset'] = $offset;
            $parameters[':limit'] = $limit;
            $sql = 'SELECT * FROM room WHERE city = :city AND ';
        }
        
        
        if (!empty($typeId)) {
            $sql.='type_id = :type_id AND ';
        }
        
        if (!empty($countOfGuests)) {
            $sql.='count_of_guests = :count_of_guests AND ';
        }
        
        if (!empty($minPrice)) {
            $sql.='price >= :min_price AND ';
        }
        
        if (!empty($maxPrice)) {
            $sql.='price <= :max_price AND ';
        }

        $sql.='room_id NOT IN (
            SELECT room_id
            FROM booking
            WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date)';

        if (!empty($sortByChoise)) {
            $sql.=' ORDER BY '.$sortByChoise;
        }

        if ($paginationRulesSet) {
            $sql.=' LIMIT :offset, :limit';
        }

        // Get results   
        return $this->fetchAll($sql, $parameters);

    }

    public function getMaxPrice()
    {
        $maxPrice = $this->fetch("SELECT MAX(price) as price FROM room");
        return $maxPrice['price'];
    }

    public function getMinPrice()
    {
        $minPrice = $this->fetch("SELECT MIN(price) as price FROM room");
        return $minPrice['price'];
    }

    
    
    public function checkPriceDifference($minPrice,$maxPrice)
    {
        $priceDiff= $maxPrice-$minPrice;
        return $priceDiff>=50;
    }
    
}
?>

