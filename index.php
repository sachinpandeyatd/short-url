<?php
    include "php/config.php";

    if(isset($_GET['u'])){
        $u = mysqli_real_escape_string($conn, $_GET['u']);

        $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$u}'");
        if(mysqli_num_rows($sql) > 0){
            $full_url = mysqli_fetch_assoc($sql);
            header("Location:".$full_url['full_url']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
</head>
<body>
    <div class="wrapper">
        <form action="">
            <input type="text" name="full-url" placeholder="Enter URL" required>
            <i class="url-icon uil uil-link"></i>
            <button type="submit">Shorten</button>
        </form>
        <?php
            $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
            if(mysqli_num_rows($sql2) > 0){
            ?>
            <div class="count">
                <span>Total Links: <span>10</span> & Total Clicks: <span>140</span></span>
                <a href="#">Clear All</a>
            </div>
        <div class="urls-area">
            <div class="title">
                <li>Shorten URL</li>
                <li>Original URL</li>
                <li>Clicks</li>
                <li>Action</li>
            </div>
            <?php
            while($row = mysqli_fetch_assoc($sql2)){
                ?>
                    <div class="data">
                        <li><a target="_blank" href="<?php echo '?u='.$row['shorten_url']; ?>"><?php echo 'localhost/url-shortener?u='.$row['shorten_url']; ?></a></li>
                        <li>
                            <a target="_blank" href="<?php echo $row['full_url']; ?>">
                            <?php 
                                if(strlen($row['full_url']) > 100){
                                    echo substr($row['full_url'], 0, 65).'...';
                                }else{
                                    echo $row['full_url'];
                                }
                            ?>
                            </a>
                        </li>
                        <li><?php echo $row['clicks']; ?></li>
                        <li><a href="#">Delete</a></li>
                    </div>
                <?php
            }
        }
        ?>
        </div>
    </div>

    <div class="blur-effect"></div>
    <div class="popup-box">
        <div class="info-box">Please edit carefully, once you save it, you won't be able to edit it again!!</div>
        <form action="#">
            <label for="">Edit your shortened URL</label>
            <input type="text" spellcheck="false" value="">
            <i class="copy-icon uil uil-copy-alt"></i>
            <button>Save</button>
        </form>
    </div>

    <script src="script.js"></script>

</body>
</html>