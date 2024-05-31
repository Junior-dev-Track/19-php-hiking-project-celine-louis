<?php

namespace Controllers;

use Models\Hike;
use Models\HikeRepository;
use Models\User;

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
        if ($hike->id_user != null)
            $creator = (new User())->findUserByID($hike->id_user);
        else 
            $creator = null;
        $tags = $this->hikeRepo->getTagOfHike($hike->id);
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
        $newTag = $_POST['newTag'];

        $this->hikeRepo->editHike($id, $name, $distance, $duration, $elevationGain, $description, $tag, $newTag);

        header('Location: /19-php-hiking-project-celine-louis/profile');
    }

    public function tagsAddHike() {
        $tags = $this->hikeRepo->getListOfTag();
        require('../src/views/addHike.php');
    }

    public function addHike()
    {
        $name = $_POST['name'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $elevation_gain = $_POST['elevationGain'];
        $description = $_POST['description'];
        $tags = $_POST['tags'];
        // $tags = explode(',', $_POST['tags']);
        $newTag[] = $_POST['newTag'];
        if (isset($_POST['newTag']))
            foreach($_POST['newTag'] as $tag)
                $newTag[] = $tag;

        $this->hikeRepo->addHike($name, $distance, $duration, $elevation_gain, $description, $tags, $newTag);
    }

    public function deleteHike($id)
    {
        $this->hikeRepo->deleteHike($id);
        header('Location: /19-php-hiking-project-celine-louis/profile');
    }

    public function deleteTag($tag) {
        $this->hikeRepo->tagToNull($tag);
    }
}