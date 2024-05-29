<?php

declare(strict_types=1);

namespace Models;

use Exception;

date_default_timezone_set('Europe/Berlin'); // Set the timezone to Coordinated Universal Time

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
        $stmt = $this->query("SELECT id_hike, name, distance, duration, elevation_gain FROM hikes");

        // Initialize an empty array to hold the hikes
        $hikes = [];

        // Fetch each row as an associative array
        while ($result = $stmt->fetch()) {
            $hikes[] = [
                'id' => $result['id_hike'], // Correctly access the 'id_hike' column
                'name' => $result['name'], // Correctly access the 'name' column
                'duration' => $result['duration'], // Correctly access the 'name' column
                'distance' => $result['distance'], // Correctly access the 'name' column
                'elevation_gain' => $result['elevation_gain'] // Correctly access the 'name' column
            ];
        }

        // Return the array of hikes
        return $hikes;
    }

    public function getListHikesByUser($id)
    {
        try {

            $param = ['id_user' => $id];
            $stmt = $this->query(
                "SELECT id_hike, name FROM hikes WHERE id_user = :id_user",
                $param
            );
            $hikesByUser = [];

            while ($result = $stmt->fetch()) {
                $hikesByUser[] = [
                    'id' => $result['id_hike'],
                    'name' => $result['name']
                ];
            }
            return $hikesByUser;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
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
            $paramsHike = [
                ':name' => $name,
                ':distance' => $distance,
                ':duration' => $duration,
                ':elevation_gain' => $elevationGain,
                ':description' => $description,
                ':created_at' => date('Y-m-d H:i:s'),
                ':id_user' => $_SESSION["user"]["id"]
            ];
            $this->query(
                "INSERT INTO hikes (name, distance, duration, elevation_gain, description, created_at, id_user) 
                VALUES (:name, :distance, :duration, :elevation_gain, :description, :created_at, :id_user)",
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
            $_SESSION['message'] = 'New hike added!';
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            error_log($e->getMessage());
        }
    }




    public function getHikesByTag(string $tag): array
    {
        $stmt = $this->query("
            SELECT h.id_hike, h.name, h.duration, h.distance, h.elevation_gain 
            FROM hikes h
            JOIN tags t ON h.id_hike = t.id_hike
            WHERE t.tag =?
        ", [$tag]);

        $hikes = [];
        while ($result = $stmt->fetch()) {
            $hikes[] = [
                'id' => $result['id_hike'],
                'name' => $result['name'],
                'duration' => $result['duration'],
                'distance' => $result['distance'],
                'elevation_gain' => $result['elevation_gain']
            ];
        }

        return $hikes;
    }

    public function editHike($id, $name, $distance, $duration, $elevationGain, $description, $tag)
    {
        try {
            $params = [
                ":id_hike" => $id,
                ":name" => $name,
                ":distance" => $distance,
                ":duration" => $duration,
                ":elevationGain" => $elevationGain,
                ":description" => $description,
                ":updated_at" => date('Y-m-d H:i:s')
            ];
            $stmt = $this->query(
                "UPDATE hikes
                SET 
                    name = :name, 
                    distance = :distance, 
                    duration = :duration,  
                    elevation_gain = :elevationGain, 
                    description = :description,
                    updated_at = :updated_at
                WHERE id_hike = :id_hike",
                $params
            );

            $params2 = [
                ":id_hike" => $id,
                ":tag" => $tag,
            ];
            $stmt2 = $this->query(
                "UPDATE tags SET tag = :tag WHERE id_hike = :id_hike",
                $params2
            );

            $_SESSION['message'] = 'Hike edited!';
            // TODO TO TEST + add updated_at + tags
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getTagOfHike($id)
    {
        $stmt = $this->query(
            "SELECT id_tag, tag FROM tags WHERE id_hike = :id_hike",
            ['id_hike' => $id]
        );
        $result = $stmt->fetch();
        $tag = [
            'id_tag' => $result['id_tag'],
            'tag' => $result['tag']
        ];
        return $tag;
    }

    public function deleteHike($id)
    {
        try {
            $param = [':id_hike' => $id];
            $stmt = $this->query(
                "DELETE FROM tags WHERE id_hike = :id_hike",
                $param
            );

            $stmt = $this->query(
                "DELETE FROM hikes WHERE id_hike = :id_hike",
                $param
            );

            $_SESSION['message'] = 'Hike deleted';
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
