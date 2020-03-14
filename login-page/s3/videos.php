<?php session_start();
require 'app/start.php';
$objects = $s3->getIterator('ListObjects',[
    'Bucket'=>$config['s3']['bucket']
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recorded Footage</title>
    <link rel="icon" href="../images/FireStreamLogo.png">
    <link rel="stylesheet" href="../styles.css" />
</head>
<body>
    <div class="topnav">
        <a  href="../pi1.php">Squad 1</a>
        <a  href="../pi2.php">Squad 2</a>
        <a class="active" href="videos.php">Recorded Footage</a>
        <a class="last" href="../index.php">Log Out</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Video</th>
                <th>Date</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($objects as $object): ?>
            <tr>
                <td><?php echo $object['Key']; ?></td>
                <td><?php echo $object['LastModified'];?></td>
                <td><a class= "recvid" href="<?php echo $s3->getObjectUrl($config['s3']['bucket'],$object['Key'], '+10 minutes');?>">View</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>