<?php
namespace Hotel;

use Hotel\BaseService;

class RoomType extends BaseService
{     
    public function getAllTypes()
    {
        return $this->fetchAll('SELECT * FROM room_type');
    }

    public function getTypeTitle($typeId)
    {   
        $parameters=[
        ':typeId'=> $typeId
        ];

        return $this->fetch('SELECT title FROM room_type WHERE type_id = :typeId',$parameters);
    }
}
?>