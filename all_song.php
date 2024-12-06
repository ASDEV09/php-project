<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/png">
    <title>Music Player - Artist Songs</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/slicknav.min.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            background-color: #000;
            color: #fff;
        }

        hr {
            color: #333;
        }

        h1,
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #bfbfbf;
        }

        .card {
            background-color: #000;
            color: #bfbfbf;
            border: 1px solid #18181d;
            margin-bottom: 20px;
        }

        .card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.2s ease;
        }

        .card-body {
            padding: 10px;
        }

        .card-title {
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .card-text {
            font-size: smaller;
            margin-bottom: -16px;
        }


        .card:hover img {
            transform: scale(1.1);
        }


        #nowPlaying {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px 0;
            text-align: center;
            margin: 0;
            background-color: #000;
            color: #fff;
        }

        #audioPlayer {
            width: 100%;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 1000;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background-color: #ccc;
            position: relative;
            cursor: pointer;
        }

        .progress {
            height: 100%;
            background-color: #4CAF50;
            width: 0;
        }

        .control-buttons {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 10px;
        }

        .control-buttons i {
            cursor: pointer;
        }

        .volume-control {
            display: flex;
            align-items: center;
        }

        .volume-control .fas {
            margin-right: 10px;
        }

        .volume-slider {
            width: 100%;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            background-color: #ccc;
            outline: none;
            border-radius: 5px;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            background-color: #4CAF50;
            border-radius: 50%;
            cursor: pointer;
        }

        .time-display {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            color: #fff;
        }


        .hr:hover {
            background-color: wheat;
        }

        #currentTime,
        #duration {
            background-color: #000;
            color: #fff;
        }

        form {
            display: contents;
        }
    </style>
</head>

<body>
    <?php
    include('webassets/topbar.php');
    include('webassets/header.php');
    include('webassets/sidebar.php');
    include('config/db.php');



    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];

    include "dbb.php";

    $sql = "SELECT username FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $username = $user['username'];
    } else {
        echo "User not found.";
        exit();
    }
    $reviewmassagee = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $media_id = $_POST['media_id'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];

        $check_sql = "SELECT * FROM reviews WHERE user_id = :user_id AND media_id = :media_id";
        $check_stmt = $pdo->prepare($check_sql);
        $check_stmt->bindParam(':user_id', $user_id);
        $check_stmt->bindParam(':media_id', $media_id);
        $check_stmt->execute();
        $existing_review = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_review) {
            $reviewmassagee = "You have already reviewed this song.";
            unset($_SESSION['review_message']);
        } else {
            $sql = "INSERT INTO reviews (user_id, media_id, rating, review_text, review_date)
VALUES (:user_id, :media_id, :rating, :review_text, current_timestamp())";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':media_id', $media_id);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':review_text', $review_text);

            try {
                $stmt->execute();
                $reviewmassagee = "Review added successfully by $username.";
                unset($_SESSION['review_message']);
            } catch (PDOException $e) {
                $reviewmassagee = "Error: " . $e->getMessage();
                unset($_SESSION['review_message']);
            }
        }
    }



    ?>

    <div class="content-wrapper">
        <h4 id="reviewMessage" style="position: fixed; z-index: 1000; left: 43%; margin-top: 0%" class="text-center text-white">
            <?php echo $reviewmassagee; ?>
        </h4>
        <h4 class="text-center text-white" id="success"></h4>

        <div class="container">

            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    margin: 0;
                    background-color: #000;
                    color: #fff;
                }

                hr {
                    color: #333;
                }

                h1,
                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                    color: #bfbfbf;
                }

                .card {
                    background-color: #000;
                    color: #bfbfbf;
                    border: 1px solid #18181d;
                    margin-bottom: 20px;
                    border: none;
                }

                .card img {
                    height: 200px;
                    transition: transform 0.2s ease;
                    object-fit: cover;
                }

                .card-body {
                    padding: 10px;
                }

                .card-title {
                    margin-bottom: 10px;
                    font-size: 1.2em;
                }

                .card-text {
                    font-size: smaller;
                    margin-bottom: -16px;
                }

                .card:hover img {
                    transform: scale(1.1);
                }


                #nowPlaying {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    padding: 15px 0;
                    text-align: center;
                    margin: 0;
                    background-color: #000;
                    color: #fff;
                }

                #audioPlayer {
                    width: 100%;
                    padding: 10px 20px;
                    background-color: #000;
                    color: #fff;
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    z-index: 1000;
                }

                .progress-bar {
                    width: 100%;
                    height: 4px;
                    background-color: #ccc;
                    position: relative;
                    cursor: pointer;
                }

                .progress {
                    height: 100%;
                    background-color: #4CAF50;
                    width: 0;
                }

                .control-buttons {
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                    margin-top: 10px;
                }

                .control-buttons i {
                    cursor: pointer;
                }

                .volume-control {
                    display: flex;
                    align-items: center;
                }

                .volume-control .fas {
                    margin-right: 10px;
                }

                .volume-slider {
                    width: 100%;
                    cursor: pointer;
                    -webkit-appearance: none;
                    appearance: none;
                    height: 4px;
                    background-color: #ccc;
                    outline: none;
                    border-radius: 5px;
                }

                .volume-slider::-webkit-slider-thumb {
                    -webkit-appearance: none;
                    appearance: none;
                    width: 16px;
                    height: 16px;
                    background-color: #4CAF50;
                    border-radius: 50%;
                    cursor: pointer;
                }

                .time-display {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 10px;
                    color: #fff;
                }




                .hr:hover {
                    background-color: wheat;
                }

                #currentTime,
                #duration {
                    background-color: #000;
                    color: #fff;
                }

                .ff {
                    color: #fff;
                }
            </style>

            <?php
            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }
            $user_id = $_SESSION['user_id'];

            include "dbb.php";

            $sql = "SELECT username FROM users WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $username = $user['username'];
            } else {
                echo "User not found.";
                exit();
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['media_id'])) {
                $user_id = $_SESSION['user_id'];
                $media_id = $_POST['media_id'];

                $check_sql = "SELECT * FROM playlists WHERE user_id = ? AND media_id = ?";
                $check_stmt = $conn->prepare($check_sql);
                $check_stmt->bind_param("ii", $user_id, $media_id);
                $check_stmt->execute();
                $existing_song = $check_stmt->fetch();

                if ($existing_song) {
                    echo "Song is already in your playlist.";
                } else {
                    $insert_sql = "INSERT INTO playlists (user_id, media_id) VALUES (?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bind_param("ii", $user_id, $media_id);

                    if ($insert_stmt->execute()) {
                        echo "Song added to playlist successfully.";
                    } else {
                        echo "Failed to add song to playlist.";
                    }
                }
            }
            $reviewmassagee = '';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $media_id = $_POST['media_id'];
                $rating = $_POST['rating'];
                $review_text = $_POST['review_text'];

                $check_sql = "SELECT * FROM reviews WHERE user_id = :user_id AND media_id = :media_id";
                $check_stmt = $pdo->prepare($check_sql);
                $check_stmt->bindParam(':user_id', $user_id);
                $check_stmt->bindParam(':media_id', $media_id);
                $check_stmt->execute();
                $existing_review = $check_stmt->fetch(PDO::FETCH_ASSOC);

                if ($existing_review) {
                    $reviewmassagee = "You have already reviewed this song.";
                    unset($_SESSION['review_message']);
                } else {
                    $sql = "INSERT INTO reviews (user_id, media_id, rating, review_text, review_date)
VALUES (:user_id, :media_id, :rating, :review_text, current_timestamp())";

                    $stmt = $pdo->prepare($sql);

                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':media_id', $media_id);
                    $stmt->bindParam(':rating', $rating);
                    $stmt->bindParam(':review_text', $review_text);

                    try {
                        $stmt->execute();
                        $reviewmassagee = "Review added successfully by $username.";
                        unset($_SESSION['review_message']);
                    } catch (PDOException $e) {
                        $reviewmassagee = "Error: " . $e->getMessage();
                        unset($_SESSION['review_message']);
                    }
                }
            }


            $searchTerm = $_GET['search'] ?? '';

            if (!empty($searchTerm)) {
                $sql = "SELECT m.media_id, m.title AS song_title, m.duration, a.artist_name, a.picture_url, m.file_path, m.pic_url ,m.year
            FROM Media m 
            left JOIN Artists a ON m.artist_id = a.artist_id 
            WHERE m.type = 'Music' AND (a.artist_name LIKE ? OR m.title LIKE ? OR m.year LIKE ?)";

                $stmt = $conn->prepare($sql);
                $searchWildcard = "%{$searchTerm}%";
                $stmt->bind_param("sss", $searchWildcard, $searchWildcard, $searchWildcard);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<h2>Search Results for: " . htmlspecialchars($searchTerm) . "</h2>";

                    echo '<div class="row">';

                    while ($row = $result->fetch_assoc()) {
                        $artist_name = $row['artist_name'];
                        $song_title = $row['song_title'];
                        $duration = $row['duration'];
                        $pic_url = $row['pic_url'];
                        $file_path = $row['file_path'];
                        $year = $row['year'];
            ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card">
                                <img src="<?php echo $pic_url; ?>" class="card-img-top" alt="<?php echo $artist_name; ?>">
                                <div class="card-body text-white bg-black">
                                    <h5 class="card-title"><?php echo $artist_name . "<br>" . $song_title; ?></h5>
                                    <h5 class="card-text " style="color: #bfbfbf;">Duration : <?php echo $duration ?></h5>
                                    <br>
                                    <button class="play-button btn hr" style="width: 100px; background-color:#FEA506;color:#fff" data-file-path="<?php echo $file_path; ?>" data-artist="<?php echo $artist_name; ?>" data-song="<?php echo $song_title; ?>">Play</button>
                                    <a style=" background-color:#FEA506;color:#fff" href="<?php echo $file_path; ?>" class="btn hr btn-download" download><i style=" background-color:#FEA506;color:#fff" class="fas fa-download"></i></a>
                                    <button style=" background-color:#FEA506;color:#fff" class="btn hr btn-add-to-playlist" data-media-id="<?php echo $row['media_id']; ?>">
                                        <i style=" background-color:#FEA506;color:#fff" class="fas fa-plus"></i>
                                    </button>
                                    <br> <button style="margin-top: 10px; background-color: black; color: #fff; border: none;" class="btn btn-review" data-media-id="<?php echo $row['media_id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setMediaId(this)">Add
                                        Review</button>


                                    <button style="margin-top: 10px; background-color: black; color: #fff; border: none;" class="btn btn-seereview" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-media-id="<?php echo $row['media_id']; ?>">
                                        See Review
                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div style="background-color: #000;color:#fff" class="modal-header">
                                                    <h1 style="background-color: #000;color:#fff" class="modal-title fs-5" id="exampleModalLabel">Add Review</h1>
                                                    <button style="background-color: #000;color:#fff;border:none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-xmark"></i></button>
                                                </div>
                                                <div style="background-color: #000;color:#fff" class="modal-body">

                                                    <form action="all_song.php?search=<?php echo $searchTerm ?>" method="post">
                                                        <input type="hidden" id="media_id" name="media_id" required>
                                                        <label for="rating">Rating (1-5):</label>
                                                        <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

                                                        <label for="review_text">Review:</label><br>
                                                        <textarea style="resize: none;" id="review_text" name="review_text" rows="4" cols="50" required></textarea><br><br>
                                                        <input style="background-color: #FEA506;color:#fff;" class="btn" type="submit" value="Submit Review">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #FEA506;color:#fff;">Cancel</button>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #000;color:#fff">
                                        <h5 class="modal-title" id="exampleModalLabel2">All Reviews</h5>
                                        <button style="background-color: #000;color:#fff;border:none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    </div>
                                    <div class="modal-body" style="background-color: #000;color:#fff">
                                        <?php if (!empty($reviews)) : ?>
                                            <ul>
                                                <?php foreach ($reviews as $review) : ?>
                                                    <li>
                                                        <strong>User: <?php echo htmlspecialchars($review['username']); ?></strong><br>
                                                        <strong>Artist: <?php echo htmlspecialchars($review['artist_name']); ?></strong><br>
                                                        <strong>Rating: <?php echo htmlspecialchars($review['rating']); ?></strong><br>
                                                        <em>Review: <?php echo htmlspecialchars($review['review_text']); ?></em><br>
                                                        <small>Date: <?php echo htmlspecialchars($review['review_date']); ?></small>
                                                        <hr>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <p>No reviews found.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }

                    echo '</div>';
                } else {
                    echo "<h2>No results found for: " . htmlspecialchars($searchTerm) . "</h2>";
                }
            }

            $conn->close();
            ?>


            <h1 class="text-white mb-3"><?php echo "All Song"; ?></h1>
            <div class="row">
                <?php
                include('config/db.php');
                $sql = "SELECT m.media_id, m.title AS song_title, m.duration, m.file_path, m.pic_url FROM Media m WHERE m.type = 'Music'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $media_id = htmlspecialchars($row['media_id']);
                        $song_title = htmlspecialchars($row['song_title']);
                        $duration = $row['duration'];
                        $pic_url = $row['pic_url'];
                        $file_path = $row['file_path'];
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card">
                                <img src="<?php echo $pic_url; ?>" class="card-img-top" alt="<?php echo $song_title; ?>">
                                <div class="card-body text-white bg-black">
                                    <h5 class="card-title"><?php echo  $song_title; ?></h5>
                                    <h5 class="card-text " style="color: #bfbfbf;">Duration : <?php echo $duration ?></h5>
                                    <br>
                                    <button class="play-button btn hr" style="width: 80px; background-color:#FEA506;color:#fff" data-file-path="<?php echo $file_path; ?>" data-artist="<?php echo $song_title; ?>" data-song="<?php echo $song_title; ?>">Play</button>
                                    <a style=" background-color:#FEA506;color:#fff" href="<?php echo $file_path; ?>" class="btn hr btn-download" download><i style=" background-color:#FEA506;color:#fff" class="fas fa-download"></i></a>


                                    <button style=" background-color:#FEA506;color:#fff" class="btn hr btn-add-to-playlist" data-media-id="<?php echo $row['media_id']; ?>"><i style=" background-color:#FEA506;color:#fff" class="fas fa-plus"></i></button>
                                    <br>
                                    <button style="margin-top: 10px; background-color: black; color: #fff; border: none;" class="btn  btn-review" data-media-id="<?php echo $row['media_id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Review</button>

                                    <button class="btn btn-seereview" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-media-id="<?php echo $row['media_id']; ?>" style="margin-top: 10px; background-color: black; color: #fff; border: none;">
                                        See Review
                                    </button>


                                </div>
                            </div>
                        </div>




                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #000;color:#fff">
                                        <h5 class="modal-title" id="exampleModalLabel2">All Reviews</h5>
                                        <button style="background-color: #000;color:#fff;border:none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    </div>
                                    <div class="modal-body" style="background-color: #000;color:#fff">
                                        <?php if (!empty($reviews)) : ?>
                                            <ul>
                                                <?php foreach ($reviews as $review) : ?>
                                                    <li>
                                                        <strong>User: <?php echo htmlspecialchars($review['username']); ?></strong><br>
                                                        <strong>Artist:
                                                            <?php echo htmlspecialchars($review['artist_name']); ?></strong><br>
                                                        <strong>Rating: <?php echo htmlspecialchars($review['rating']); ?></strong><br>
                                                        <em>Review: <?php echo htmlspecialchars($review['review_text']); ?></em><br>
                                                        <small>Date: <?php echo htmlspecialchars($review['review_date']); ?></small>
                                                        <hr>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <p>No reviews found.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div style="background-color: #000;color:#fff" class="modal-header">
                                        <h1 style="background-color: #000;color:#fff" class="modal-title fs-5" id="exampleModalLabel">Add Review</h1>
                                        <button style="background-color: #000;color:#fff;border:none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-xmark"></i></button>
                                    </div>
                                    <div style="background-color: #000;color:#fff" class="modal-body">

                                        <form action="all_song.php" method="post">
                                            <input type="hidden" id="media_id" name="media_id" required>
                                            <label for="rating">Rating (1-5):</label>
                                            <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

                                            <label for="review_text">Review:</label><br>
                                            <textarea style="resize: none;" id="review_text" name="review_text" rows="4" cols="50" required></textarea><br><br>
                                            <input style="background-color: #FEA506;color:#fff;" class="btn" type="submit" value="Submit Review">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #FEA506;color:#fff;">Cancel</button>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>



                <?php
                    }
                } else {
                    echo "<div class='col-12'><p>No songs found for this artist.</p></div>";
                }

                $conn->close();
                ?>
            </div>
        </div>
        <br><br><br><br>

    </div>

    <div id="nowPlaying" class="now-playing">Now Playing:</div>

    <div id="audioPlayer">
        <div style="background-color:#fff" class="progress-bar">
            <div style="background-color:#FEA506" class="progress"></div>
        </div>
        <div class="control-buttons">
            <i class="fas fa-step-backward fa-lg" id="prevButton"></i>
            <i id="playPauseButton"></i>
            <i class="fas fa-step-forward fa-lg" id="nextButton"></i>
            <i class="fas fa-random fa-lg" id="shuffleButton"></i>
            <i class="fas fa-undo-alt fa-lg" id="undoButton"></i>
            <a id="downloadCurrentSong" href="#" class="download-button" download><i class="text-white fas fa-download"></i></a>
            <div class="volume-control">
                <i class="fas fa-volume-up fa-lg"></i>
                <input type="range" id="volumeSlider" class="volume-slider" min="0" max="100" step="1" value="50">
            </div>
        </div>
        <div class="time-display">
            <span id="currentTime">0:00</span>
            <span id="duration">0:00</span>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>
    <?php include('webassets/script.php') ?>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.btn-review').on('click', function() {
                var mediaId = $(this).data('media-id');
                $('#exampleModal #media_id').val(mediaId);
            });
        });

        $('.btn-add-to-playlist').on('click', function() {
            var media_id = $(this).data('media-id');

            $(this).prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: 'all_song.php',
                data: {
                    media_id: media_id
                },
                success: function(response) {
                    $('#success').html('Song added to playlist successfully.');
                    setTimeout(function() {
                        $('#success').html('');
                    }, 2000);
                    $('.btn-add-to-playlist').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    alert('Failed to add song to playlist: ' + error);

                    $('.btn-add-to-playlist').prop('disabled', false);
                }
            });
        });
        setTimeout(function() {
            var reviewMessage = document.getElementById('reviewMessage');
            if (reviewMessage) {
                reviewMessage.style.display = 'none';
            }
        }, 8000);

        $(document).ready(function() {
            $('.btn-seereview').on('click', function() {
                var mediaId = $(this).data('media-id');
                $.ajax({
                    type: 'POST',
                    url: 'fetch_reviews.php',
                    data: {
                        media_id: mediaId
                    },
                    success: function(response) {
                        $('#exampleModal2 .modal-body').html(response);
                    },
                    error: function() {
                        alert('Failed to fetch reviews.');
                    }
                });
            });
        });
    </script>


</body>

</html>