<?php

namespace Controllers;

use Models\Hike;
use Models\HikeRepository;

class HikeController
{

    private $hikeRepo;

    public function __construct()
    {
        $this->hikeRepo = new HikeRepository();
    }


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

    public function filterHikes()
    {
        $tag = isset($_POST['filter_tag']) ? $_POST['filter_tag'] : '';
        $hikes = $tag ? $this->hikeRepo->getHikesByTag($tag) : $this->hikeRepo->getListHikes();
        require '../src/views/homepage.php';
    }

    public function addHike()
    {
        $name = $_POST['name'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $elevation_gain = $_POST['elevationGain'];
        $description = $_POST['description'];
        // Split the tags string into an array based on commas
        $tags = explode(',', $_POST['tags']);

        // Pass the tags array to the addHike method
        $this->hikeRepo->addHike($name, $distance, $duration, $elevation_gain, $description, $tags);
    }


    public function deleteHike()
    {
    }
}
