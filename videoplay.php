<?php
session_start();
?>
<?php
include('config/db.php');

$sql = "SELECT * FROM media WHERE type = 'video'";
$result = $conn->query($sql);

$mediaItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mediaItems[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Music Player | Video Song</title>
    <link rel="icon" href="logo.jpg" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .video-container {
            position: relative;
            cursor: pointer;
            margin-top: 24px;
        }

        .video-container video {
            height: 250px;
            width: 100%;
        }

        .video-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #000;
        }

        .video-info {
            text-align: center;
            margin-top: 10px;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php
    include('webassets/topbar.php');
    include('webassets/header.php');
    include('webassets/sidebar2.php');
    ?>

    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="video-container">
                        <video style="margin-top: 24px; height: 95%;" id="mainVideo" src="" class="card-img-top" controls></video>
                    </div>
                    <div id="mainVideoInfo" class="video-info">
                        <p id="mainVideoTitle"></p>
                        <p id="mainVideoDuration"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php foreach ($mediaItems as $media) : ?>
                        <div class="video-thumbnail mb-3">
                            <div class="video-container">
                                <video src="<?php echo htmlspecialchars($media['file_path']); ?>" class="clickable-video" data-title="<?php echo "Title : ";
                                                                                                                                        echo htmlspecialchars($media['title']);
                                                                                                                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                                                                                                                        echo "Duration : ";
                                                                                                                                        echo htmlspecialchars($media['duration']); ?>">
                                </video>
                                <div class="video-text"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="video-info">

                                <p><?php echo htmlspecialchars($media['title']);
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                    echo htmlspecialchars($media['duration']); ?>
                                </p>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php include('webassets/footer.php'); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainVideo = document.getElementById('mainVideo');
            const mainVideoTitle = document.getElementById('mainVideoTitle');
            const mainVideoDuration = document.getElementById('mainVideoDuration');
            const clickableVideos = document.querySelectorAll('.clickable-video');

            clickableVideos.forEach(video => {
                video.addEventListener('click', function() {
                    mainVideo.src = this.src;
                    mainVideoTitle.textContent = this.getAttribute('data-title');
                    mainVideo.play();
                });
            });

            if (clickableVideos.length > 0) {
                const firstVideo = clickableVideos[0];
                mainVideo.src = firstVideo.src;
                mainVideoTitle.textContent = firstVideo.getAttribute('data-title');
                mainVideo.play();
            }
        });
    </script>

    <?php include('webassets/script.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>