<?php

declare(strict_types=1);

namespace Models;

use Exception;
use PDO;

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
    public $id_user;

    public function __construct($id, $name, $distance, $duration, $elevationGain, $description, $createdAt, $updatedAt = '', $id_user = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->distance = $distance;
        $this->duration = $duration;
        $this->elevationGain = $elevationGain;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->id_user = $id_user;
    }
}

class HikeRepository extends Database
{
    public function getListHikes(): array
    {
        try {
            $stmt = $this->query("SELECT id_hike, name, distance, duration, elevation_gain, id_user FROM hikes");

            $hikes = [];

            while ($result = $stmt->fetch()) {
                $tag = $this->getTagsOfHike($result['id_hike']);
                // var_dump($tag[0]['tag']);
                $hikes[] = [
                    'id' => $result['id_hike'], // Correctly access the 'id_hike' column
                    'name' => $result['name'], // Correctly access the 'name' column
                    'duration' => $result['duration'], // Correctly access the 'duration' column
                    'distance' => $result['distance'], // Correctly access the 'distance' column
                    'elevation_gain' => $result['elevation_gain'], // Correctly access the 'elevation_gain' column
                    // 'tag' => $tag['tag'],
                    'id_user' => $result['id_user']
                ];
                $tagsHikes = [];
                foreach($tag as $elem) {
                    if ($elem == null)
                        $elem['tag'] = '';
                    $tagsHikes[] = $elem['tag'];
                }
            }
            return [$hikes, $tagsHikes];
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
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
                $results['updated_at'],
                $results['id_user'],
            );
            return $hike;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addHike(string $name, float $distance, int $duration, int $elevationGain, string $description, array $tags, array $newTag)
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
                if ($tag == '' && !empty($newTag)) {
                    foreach ($newTag as $elem) {
                        $this->query(
                            "INSERT INTO tags (tag, id_hike) VALUES (?,?)",
                            [$elem, $hikeID]
                        );
                    }
                } else {
                    $this->query(
                        "INSERT INTO tags (tag, id_hike) VALUES (?,?)",
                        [$tag, $hikeID]
                    );
                }
            }
            $_SESSION['message'] = 'New hike added!';
        } catch (Exception $e) {
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

    public function editHike($id, $name, $distance, $duration, $elevationGain, $description, $tags, $newTag)
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

            // handle tags in selector            
            foreach ($tags as $tag) {
                if ($tag['tag'] != '') {
                    $params2 = [
                        ":id_hike" => $id,
                        ":tag" => $tag['tag'],
                        ":id" => $tag['id_tag']
                    ];
                    $stmt2 = $this->query(
                        "UPDATE tags SET tag = :tag WHERE id_hike = :id_hike AND id_tag = :id",
                        $params2
                    );
                }
            }

            // handle tags added by user
            if (!empty($newTag)) {
                foreach ($newTag as $tag) {
                    if ($tag !== '') {
                        $params2 = [
                            ":id_hike" => $id,
                            ":tag" => $tag,
                        ];
                        $this->query(
                            "INSERT INTO tags (tag, id_hike) VALUES (:tag,:id_hike)",
                            $params2
                        );
                    }
                }
            }

            $_SESSION['message'] = 'Hike edited!';
        } catch (Exception $e) {
            error_log($e->getMessage());
            $_SESSION['message'] = 'Problem during edit';
        }
    }

    public function getListOfTag(): array
    {
        try {
            $stmt = $this->query(
                "SELECT tag FROM `tags` GROUP BY tag"
            );
            $tags = [];
            while ($result = $stmt->fetch()) {
                if ($result['tag'] != null)
                    $tags[] = $result['tag'];
            }
            return $tags;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function tagToNull($tag)
    {
        try {
            $param = [':tag' => $tag];

            $this->query(
                "UPDATE tags
                SET tag = NULL
                WHERE tag = :tag",
                $param
            );
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getTagsOfHike($id): array
    {
        try {
            $stmt = $this->query(
                "SELECT id_tag, tag FROM tags WHERE id_hike = :id_hike",
                ['id_hike' => $id]
            );
            $tags = [];
            while ($result = $stmt->fetch()) {
                $tags[] = [
                    'id_tag' => $result['id_tag'],
                    'tag' => $result['tag']
                ];
            }
            return $tags;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
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
