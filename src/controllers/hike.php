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
        require('../src/views/hikeDetails.php');
    }










    public function addHike($id)
    {
    }

    public function deleteHike()
    {
    }
}
