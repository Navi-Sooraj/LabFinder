<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

// --- Fetch Main Lab Data ---
// We fetch this first to use in the header
$data = array(); // Initialize
if(isset($_GET['viewid'])) {
    $selQry="Select * from tbl_lab l 
             inner join tbl_place p on l.place_id=p.place_id 
             inner join tbl_district d on p.district_id=d.district_id 
             where lab_id='".$_GET['viewid']."'";
    $res=$Conn->query($selQry);
    $data=$res->fetch_assoc();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab Details</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        /* padding: 50px 20px; Add padding to body */
        box-sizing: border-box;
        /* display: flex; */
        justify-content: center;
        align-items: flex-start; /* Align container to top */
    }

    /* --- Container Styles --- */
    #page-container {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 1200px; /* Increased max-width for new layout */
        margin: auto;
    }
    
    /* --- Section Heading Styles --- */
    h2, h3 {
        color: #333;
        margin-top: 0;
        margin-bottom: 25px;
        font-weight: 600;
        position: relative;
        padding-bottom: 15px;
    }

    h2::after, h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: #5A827E;
        border-radius: 2px;
    }
    
    h3 {
        font-size: 1.4em;
    }
    h2 {
        font-size: 1.8em;
    }

    /* --- 1. Lab Profile Header --- */
    .lab-profile-header {
        display: flex;
        align-items: center;
        gap: 30px;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 30px;
        margin-bottom: 30px;
        flex-wrap: wrap; /* For responsiveness */
    }

    .lab-photo img {
        width: 150px;
        height: 150px;
        border-radius: 50%; /* Modern circular photo */
        object-fit: cover;
        border: 4px solid #f8f9fa;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .lab-details {
        flex: 1;
    }

    .lab-details h1 {
        margin: 0 0 10px;
        font-size: 2.5em;
        font-weight: 700;
        color: #222;
    }

    .lab-location {
        font-size: 1.1em;
        color: #555;
        margin-bottom: 15px;
    }
    
    .lab-location i {
        color: #5A827E;
        margin-right: 8px;
    }

    .lab-contact-info {
        display: flex;
        gap: 25px;
        flex-wrap: wrap;
    }

    .lab-contact-info p {
        margin: 0;
        font-size: 1em;
        color: #444;
        display: flex;
        align-items: center;
    }
    
    .lab-contact-info i {
        color: #5A827E;
        margin-right: 8px;
        font-size: 1.1em;
    }

    /* --- 2. Main Content Wrapper (Two-Column Layout) --- */
    .main-content-wrapper {
        display: flex;
        gap: 30px;
    }
    
    /* 2a. Main (Left) Column */
    .main-column {
        flex: 3; /* Takes ~70% width */
        min-width: 0; /* Prevents flex overflow */
    }

    /* 2b. Sidebar (Right) Column */
    .sidebar-column {
        flex: 1; /* Takes ~30% width */
        min-width: 280px; /* Min width for sidebar */
    }
    
    .content-section {
        margin-bottom: 30px;
    }

    /* --- 3. Services Section (in Main Column) --- */
    .service-grid {
        display: grid;
        /* Responsive grid: 2 columns, falls to 1 */
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
    
    .service-card {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .service-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }
    
    .service-card-content {
        padding: 15px;
    }
    
    .service-card-content h4 {
        margin: 0 0 5px;
        font-size: 1.2em;
        color: #333;
    }
    
    .service-card-content p {
        margin: 0;
        font-size: 0.9em;
        color: #666;
        line-height: 1.5;
    }

    /* --- 4. Working Hours (in Sidebar) --- */
    .sidebar-widget {
        background-color: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }
    
    .hours-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .hours-table td {
        padding: 12px 5px;
        border-bottom: 1px solid #e9ecef;
        color: #555;
        text-align: left;
    }
    
    .hours-table tr:last-child td {
        border-bottom: none;
    }
    
    .hours-table td:first-child {
        font-weight: 600;
        color: #333;
    }
    
    .hours-table td:last-child {
        text-align: right;
        font-weight: 500;
    }

    /* --- 5. Reviews Section (in Main Column) --- */
    /* MODIFICATION: Center the 'Ratings & Reviews' H2 */
    #reviews-section h2 {
        text-align: center;
    }

    #reviews-section h2::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .average-rating-display {
        text-align: center;
        font-size: 24px;
        margin-bottom: 25px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
    }
    
    .average-rating-display .stars i {
        color: #ffc107;
    }
    
    .average-rating-display .stars .faded {
        color: #ccc;
    }

    .average-rating-display strong {
        display: block;
        margin-top: 10px;
        font-size: 1.2rem;
        color: #444;
    }

    .review-list {
        margin-top: 20px;
    }

    .review-card {
        display: flex; /* Use flexbox for layout */
        gap: 15px; /* Space between avatar and content */
        align-items: flex-start; /* Align avatar to the top */
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .review-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .review-main {
        flex: 1; /* Take up remaining space */
    }
    /* --- End of New CSS --- */

    .review-card:last-child {
        margin-bottom: 0;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-user {
        font-weight: 600;
        font-size: 1.1em;
        color: #333;
    }

    .review-stars {
        font-size: 1em;
        color: #ffc107; /* Gold color for filled stars */
    }
    
    .review-stars .far { /* Faded color for empty stars */
        color: #ccc;
    }

    .review-content {
        color: #555;
        line-height: 1.6;
        margin: 0;
        text-align: left;
    }
    
    /* --- Responsive Adjustments --- */
    @media (max-width: 992px) {
        .main-content-wrapper {
            flex-direction: column; /* Stack columns on smaller screens */
        }
        .sidebar-column {
            min-width: 0;
            width: 100%;
        }
    }
    
    @media (max-width: 768px) {
        body {
            padding: 20px 10px;
        }
        #page-container {
            padding: 20px;
        }
        .lab-profile-header {
            flex-direction: column;
            text-align: center;
        }
        .lab-contact-info {
            justify-content: center;
        }
        .lab-details h1 {
            font-size: 2em;
        }
    }

</style>
</head>

<body>

<form id="page-container" name="form1" method="post" action="">
    
    <div class="lab-profile-header">
        <div class="lab-photo">
            <img src="../Assets/Files/Lab/Photo/<?php echo $data['lab_photo']; ?>" alt="<?php echo $data['lab_name']; ?> Photo" />
        </div>
        <div class="lab-details">
            <h1><?php echo $data['lab_name']; ?></h1>
            <p class="lab-location">
                <i class="fas fa-map-marker-alt"></i>
                <?php echo $data['lab_address'],"<br>"; ?> &nbsp;&nbsp; &nbsp; 
                <?php echo  $data['place_name'],"<br>"; ?> &nbsp;&nbsp; &nbsp;
                <?php echo $data['district_name']; ?>
            </p>
            <div class="lab-contact-info">
                <p><i class="fas fa-envelope"></i> <?php echo $data['lab_email']; ?></p>
                <p><i class="fas fa-phone"></i> <?php echo $data['lab_contact']; ?></p>
            </div>
        </div>
    </div>
    
    <div class="main-content-wrapper">
    
        <div class="main-column">
        
            <section class="content-section" id="services-section">
                <h2>Our Services</h2>
                <div class="service-grid">
                    <?php 
                    $selQry="SELECT * from tbl_service where lab_id='".$_GET['viewid']."'";
                    $res=$Conn->query($selQry);
                    while($data_service=$res->fetch_assoc())
                    {
                    ?>
                    <div class="service-card">
                        <img src="../Assets/Files/Lab/service/<?php echo $data_service['service_photo'] ?>" alt="<?php echo $data_service['service_name'] ?>" />
                        <div class="service-card-content">
                            <h4><?php echo $data_service['service_name'] ?></h4>
                            <p><?php echo $data_service['service_description'] ?></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
            
            <section class="content-section" id="reviews-section">
                <h2>Ratings & Reviews</h2>
                
                <div class="average-rating-display">
                    <?php
                    $average_rating = 0;
                    $total_review = 0;
                    $total_user_rating = 0;
                    $query = "SELECT * FROM tbl_rating where lab_id = '".$_GET['viewid']."'";
                    $result = $Conn->query($query);
                    while($row = $result->fetch_assoc()) {
                        $total_review++;
                        $total_user_rating += $row["rating_data"];
                    }
                    if($total_review > 0) {
                        $average_rating = $total_user_rating / $total_review;
                    }
                    ?>
                    <span class="stars">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= round($average_rating)) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>'; // Use a different style for empty
                        }
                    }
                    ?>
                    </span>
                    <strong><?php echo number_format($average_rating, 1); ?> / 5 (based on <?php echo $total_review; ?> reviews)</strong>
                </div>
                
                <div class="review-list">
                    <?php
                    $review_query = "SELECT * FROM tbl_rating t INNER JOIN tbl_user u ON t.user_id=u.user_id WHERE lab_id = '".$_GET['viewid']."' ORDER BY rating_id DESC";
                    $review_result = $Conn->query($review_query);
                    if($review_result->num_rows > 0) {
                        while($review_row = $review_result->fetch_assoc()) {
                    ?>
                    <div class="review-card">
                      <div class="review-avatar">
                          <img src="../Assets/Files/User/Photo/<?php echo $review_row['user_photo']; ?>" alt="User" onerror="this.onerror=null; this.src='https://placehold.co/50x50/EFEFEF/AAAAAA?text=User';">
                      </div>
                      <div class="review-main">
                        <div class="review-header">
                            <span class="review-user"><?php echo $review_row['user_name']; ?></span>
                            <span class="review-stars">
                                <?php
                                for($i = 1; $i <= 5; $i++) {
                                    if($i <= $review_row['rating_data']) {
                                        echo '<i class="fas fa-star"></i>'; // Filled
                                    } else {
                                        echo '<i class="far fa-star"></i>'; // Border (requires Font Awesome 'far')
                                    }
                                }
                                ?>
                            </span>
                        </div>
                        <?php 
                        if(!empty($review_row['rating_content'])) { 
                        ?>
                        <p class="review-content"><?php echo $review_row['rating_content']; ?></p>
                        <?php } ?>
                      </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo '<p align="center">No reviews yet.</p>';
                    }
                    ?>
                </div>
            </section>
        
        </div> 
        <div class="sidebar-column">
        
            <section class="content-section sidebar-widget" id="hours-section">
                <h3><i class="far fa-clock"></i> Working Hours</h3>
                <table class="hours-table">
                    <?php 
                    $selQry="SELECT * from tbl_timing t inner join tbl_days d on t.days_id=d.days_id where lab_id='".$_GET['viewid']."'";
                    $res=$Conn->query($selQry);
                    while($data_timing=$res->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?php echo $data_timing['days_name'] ?></td>
                        <td><?php echo $data_timing['timing_time'] ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </section>
            
            </div> </div> </form>
</body>
</html>

<?php
include("Foot.php");
?>