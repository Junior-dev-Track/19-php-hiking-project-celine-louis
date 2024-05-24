<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hike Details</title>
    <link rel="stylesheet" href="../../public//assets/css/main.css">

</head>

<body>
    <h1><?= htmlspecialchars($hike->name); ?></h1>
    <p>Distance: <?= htmlspecialchars($hike->distance); ?> km</p>
    <p>Duration: <?= htmlspecialchars($hike->duration); ?> hours</p>
    <p>Elevation Gain: <?= htmlspecialchars($hike->elevationGain); ?> meters</p>
    <p>Description: <?= htmlspecialchars($hike->description); ?></p>
    <p>Created At: <?= htmlspecialchars($hike->createdAt); ?></p>
    <p>Updated At: <?= htmlspecialchars($hike->updatedAt); ?></p>
</body>

</html>