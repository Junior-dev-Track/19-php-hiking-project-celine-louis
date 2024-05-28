<?php

declare(strict_types=1);

namespace Models;

use Exception;

class Hike extends Database
{
    public $id;
    public $name;
    public $distance;
    public $duration;
    public $elevationGain;
    public $description;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $name, $distance, $duration, $elevationGain, $description, $createdAt, $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->distance = $distance;
        $this->duration = $duration;
        $this->elevationGain = $elevationGain;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}

class HikeRepository extends Database
{
    public function getListHikes(): array
    {
        // Execute the query to get id_hike and name from the hikes table
        $stmt = $this->query("SELECT id_hike, name FROM hikes");

        // Initialize an empty array to hold the hikes
        $hikes = [];

        // Fetch each row as an associative array
        while ($result = $stmt->fetch()) {
            $hikes[] = [
                'id' => $result['id_hike'], // Correctly access the 'id_hike' column
                'name' => $result['name'] // Correctly access the 'name' column
            ];
        }

        // Return the array of hikes
        return $hikes;
    }

    public function getHike($id)
    {
        try {
            $param = [$id];
            $stmt = $this->query(
                "SELECT * FROM hikes WHERE id_hike =?",
                $param
            );
            $results = $stmt->fetch();

            $hike = new Hike(
                $results['id_hike'],
                $results['name'],
                $results['distance'],
                $results['duration'],
                $results['elevation_gain'],
                $results['description'],
                $results['created_at'],
                $results['updated_at']
            );
            return $hike;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addHike(string $name, float $distance, int $duration, int $elevationGain, string $description, array $tags)
    {
        try {
            $paramsHike = [$name, $distance, $duration, $elevationGain, $description];
            $this->query(
                "INSERT INTO hikes (name, distance, duration, elevation_gain, description, created_at) VALUES (?,?,?,?,?, NOW())",
                $paramsHike
            );
            $hikeID = $this->lastInsertId();

            // Assuming tags are stored in a separate table and linked via id_hike
            foreach ($tags as $tag) {
                $this->query(
                    "INSERT INTO tags (tag, id_hike) VALUES (?,?)",
                    [$tag, $hikeID]
                );
            }
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            error_log($e->getMessage());
        }
    }


    public function getHikesByTag(string $tag): array
    {
        $stmt = $this->query("
            SELECT h.id_hike, h.name 
            FROM hikes h
            JOIN tags t ON h.id_hike = t.id_hike
            WHERE t.tag =?
        ", [$tag]);

        $hikes = [];
        while ($result = $stmt->fetch()) {
            $hikes[] = [
                'id' => $result['id_hike'],
                'name' => $result['name']
            ];
        }

        return $hikes;
    }
}
