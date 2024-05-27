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

    public function infoHike($id)
    {
        $hike = (new HikeRepository())->getHike($id);
        // Make $hike globally accessible
        global $hike;
        require('../src/views/hikeDetails.php');
    }










    public function addHike($id)
    {
    }

    public function deleteHike()
    {
    }
}
