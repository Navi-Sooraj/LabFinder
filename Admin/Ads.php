<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

$sql = "SELECT * FROM tbl_advertisement ORDER BY advertisement_id DESC";
$result = $Conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement Collage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #2c2c2c;
        }

        .ad-collage-container {
            column-count: 5;
            column-gap: 0;
            width: 100%;
            box-sizing: border-box;
        }

        h3 {
            color: #ffffff; 
        }

        .ad-item {
            display: inline-block;
            width: 100%;
            position: relative;
            overflow: hidden;
            break-inside: avoid-column;
            transition: transform 0.25s ease-in-out;
        }
        
        .ad-item-link {
            display: block;
            line-height: 0;
        }

        .ad-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .ad-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 80%);
            color: white;
            padding: 30px 20px 20px 20px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
            line-height: 1.4;
            transition: all 0.3s ease-in-out;
        }
        
        .ad-item-link:hover .ad-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 50%, transparent 100%);
            padding: 50px 20px 20px 20px;
        }

        .ad-item-link:hover .ad-item {
            transform: scale(1.04);
            z-index: 10;
        }

        .ad-overlay h3 {
            margin: 0 0 5px 0;
            font-size: 1.4em;
            font-weight: 700;
        }

        .ad-overlay p {
            margin: 0;
            font-size: 0.95em;
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.3s ease-in-out, max-height 0.4s ease, margin-top 0.3s ease;
        }

        .ad-item-link:hover .ad-overlay p {
            opacity: 1;
            max-height: 150px;
            margin-top: 8px;
        }
        
        .no-ads {
            text-align: center;
            width: 100%;
            padding: 50px;
            font-size: 1.2em;
            color: #ccc;
        }

        @media (max-width: 1400px) {
            .ad-collage-container { column-count: 4; }
        }
        @media (max-width: 1000px) {
            .ad-collage-container { column-count: 3; }
        }
        @media (max-width: 700px) {
            .ad-collage-container { column-count: 2; }
        }
        @media (max-width: 400px) {
            .ad-collage-container { column-count: 1; }
        }
    </style>
</head>
<body>

    <div class="ad-collage-container">
        <?php
        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                generateAdHTML($row);
            }
        } 
        elseif (!empty($ads)) {
            foreach ($ads as $row) {
                generateAdHTML($row);
            }
        }
        else {
            echo "<p class='no-ads'>No advertisements found.</p>";
        }

        function generateAdHTML($adData) {
            $adId = htmlspecialchars($adData["advertisement_id"]);
            $title = htmlspecialchars($adData["advertisement_title"]);
            $description = htmlspecialchars($adData["advertisement_description"]);
            $imageFile = htmlspecialchars($adData["advertisement_image"]);

            $imagePath = "/miniProject/Project/Assets/Files/Ads/" . $imageFile;
            $defaultImage = "https://placehold.co/600x400/444444/FFFFFF?text=No+Image";
            // $detailsPageUrl = "Ads.php";
            // href="' . $detailsPageUrl . '"
            
            echo '<a  class="ad-item-link">';
            echo '  <div class="ad-item">';
            echo '    <img src="' . $imagePath . '" alt="' . $title . '" onerror="this.src=\'' . $defaultImage . '\';">';
            echo '    <div class="ad-overlay">';
            echo '      <h3 >' . $title . '</h3>';
            echo '      <p>' . $description . '</p>';
            echo '    </div>'; 
            echo '  </div>';
            echo '</a>';
        }
        ?>
    </div> 

</body>
</html>

<?php
include("Foot.php");
?>