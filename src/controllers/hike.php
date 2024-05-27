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


















    public function addHike($id)
    {
    }

    public function deleteHike()
    {
    }
}
