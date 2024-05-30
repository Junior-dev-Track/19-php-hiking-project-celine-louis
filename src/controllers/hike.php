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

    public function homepage() {
        $hikes = $this->hikeRepo->getListHikes();
        $tags = $this->hikeRepo->getListOfTag();
        require('../src/views/homepage.php');
    }

    public function listHikesByUser()
    {
        $hikesByUser = $this->hikeRepo->getListHikesByUser($_SESSION['user']['id']);
        require('../src/views/userProfile.php');
    }

    public function infoHike($id)
    {
        $hike = $this->hikeRepo->getHike($id);
        require('../src/views/hikeDetails.php');
    }

    public function filterHikes()
    {
        $tag = isset($_POST['filter_tag']) ? $_POST['filter_tag'] : '';
        if ($tag == '')
            header('Location: /19-php-hiking-project-celine-louis/');
        $hikes = $tag ? $this->hikeRepo->getHikesByTag($tag) : $this->hikeRepo->getListHikes();
        $tags = $this->hikeRepo->getListOfTag();
        require '../src/views/homepage.php';
        // header('Location: /19-php-hiking-project-celine-louis/');
    }

    public function editInfoHikeForm($id)
    {
        $hikesByUser = $this->hikeRepo->getHike($id);
        $tagOfHike = $this->hikeRepo->getTagOfHike($id);
        require('../src/views/editHike.php');
    }

    public function editInfoHike($id)
    {
        $name = $_POST['name'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $elevationGain = $_POST['elevationGain'];
        $description = $_POST['description'];
        $tag = $_POST['tag'];

        $this->hikeRepo->editHike($id, $name, $distance, $duration, $elevationGain, $description, $tag);

        header('Location: /19-php-hiking-project-celine-louis/profile');
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

    public function deleteHike($id)
    {
        $this->hikeRepo->deleteHike($id);
        header('Location: /19-php-hiking-project-celine-louis/profile');
    }
}