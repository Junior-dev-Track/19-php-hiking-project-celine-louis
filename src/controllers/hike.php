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
        $hike = (new Hike())->getHike($id);

        if ($hike instanceof Hike) {
            // Variables are populated inside the getHike method
            require('../views/hikeDetails.php'); // Load the view to display hike details
        } else {
            // Handle case where hike not found
            header("Location: index.php"); // Redirect back to homepage
        }
    }





    public function addHike($id)
    {
    }

    public function deleteHike()
    {
    }
}
