<?php

namespace Controllers;

use Models\Hike;
use Models\HikeRepository;

class HikeController
{
    public function listHikes()
    {
        $hikes = (new HikeRepository())->getListHikes();

        require('../src/views/homepage.php');
    }

    public function infoHike()
    {
        
    }

    public function addHike()
    {
    }

    public function deleteHike()
    {
    }
}
