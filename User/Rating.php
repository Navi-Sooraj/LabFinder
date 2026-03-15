<?php
include("../Assets/Connection/Connection.php"); 
session_start();
ob_start();
// include("Header.php"); // Header is not used here as this page has its own structure
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Rating & Review</title>
    <link href="../Assets/Templates/Main/assets/img/L-mini.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" xintegrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" xintegrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" xintegrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" xintegrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h3 align="center"><u><b>Rating & Review</b></u></h3>
        <div class="card">
            <div class="card-header">
                Rating
                <a href="Homepage.php" class="home-button">Home</a>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                        </div>
                        <h4 class="h"><span id="total_review">0</span> Reviews</h4>
                    </div>
                    <div class="col-sm-4">
                        <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
                        <p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>
                        </p>
                        <p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>
                        </p>
                        <p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>
                        </p>
                        <p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <br>
                        <h4 class="h">Write Your Review</h4>
                        <br>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary theme-btn">Review</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" id="review_content"></div>
    </div>
</body>
</html>

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h4>
                <div class="form-group">
                    <input type="hidden" name="txt_tid" id="txt_tid" required="required" value="<?php echo $_GET["rid"];?>" />
                </div>
                <div class="form-group">
                    <textarea name="user_review" id="user_review" required="required" class="form-control" placeholder="Type Review Here"></textarea>
                </div>
                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-primary theme-btn" id="save_review">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* --- General Styles --- */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-image: url('../Assets/Templates/Main/assets/img/w1.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Keep background fixed */
    min-height: 100vh;
    margin: 0;
    padding: 50px 20px;
    box-sizing: border-box;
}

.h{
    color: #ffffffff;
}

/* --- Heading Styles --- */
h3 {
    color: #ffffffff;
    margin-bottom: 30px;
    font-size: 2.2em;
    font-weight: 300;
    text-align: center;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 15px;
}

h3 u {
    text-decoration: none;
}

h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background-color: #ffffff;
    border-radius: 2px;
}

/* --- Card Styles --- */
.card {
    background-color: #30444bc8;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border: none;
    max-width: 1200px;
    margin: auto;
}

.card-header {
    background-color: transparent;
    border-bottom: 2px solid #5A827E;
    font-size: 1.5em;
    font-weight: 600;
    color: #ffffffff;
    padding: 0 0 15px 0;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* --- Button Styles --- */
.theme-btn {
    padding: 10px 25px;
    min-width: 120px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    font-size: 1em;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    background-color: #638780;
    color: white;
}

.theme-btn:hover {
    background-color: #4B6F6A;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.home-button {
    display: inline-block;
    padding: 8px 16px;
    background-color: #638780;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    font-size: 0.9em;
    transition: all 0.3s;
}
.home-button:hover {
    background-color: #4B6F6A;
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
}

/* --- Review List Styles --- */
#review_content .card {
    background-color: #30444bc8;
    /* border: 1px solid #e9ecef; */
    padding: 20px;
    margin-bottom: 15px;
    color: #ffffffff;
}
#review_content .card-header {
    font-size: 1.1em;
    font-weight: 600;
    color: #ffffffff;
    padding: 0 0 10px 0;
    margin-bottom: 15px;
    border-bottom: 2px solid #5A827E;
}
#review_content .card-body {
    padding: 0;
}
#review_content .card-footer {
    background-color: transparent;
    padding: 10px 0 0 0;
    border-top: 2px solid #5A827E;
    font-size: 0.9em;
    color: #e1dfdfe6;
}

/* --- Rating Progress Bar --- */
.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
    color: #ffffffff;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
    color: #ffffffff;
}
.star-light
{
    color:#e9ecef;
}
</style>

<script>
$(document).ready(function(){

    var rating_data = 0;

    $('#add_review').click(function(){
        $('#review_modal').modal('show');
    });

    $(document).on('mouseenter', '.submit_star', function(){
        var rating = $(this).data('rating');
        reset_background();
        for(var count = 1; count <= rating; count++)
        {
            $('#submit_star_'+count).addClass('text-warning');
        }
    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {
            $('#submit_star_'+count).addClass('star-light');
            $('#submit_star_'+count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function(){
        reset_background();
        for(var count = 1; count <= rating_data; count++)
        {
            $('#submit_star_'+count).removeClass('star-light');
            $('#submit_star_'+count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function(){
        rating_data = $(this).data('rating');
    });

    $('#save_review').click(function(){
        
        var user_review = $('#user_review').val();
        var lab_id = $('#txt_tid').val();

        // Check for rating and review
        if(rating_data == 0)
        {
            alert("Please select a star rating");
            return false;
        }
        if(user_review == '')
        {
            alert("Please write a review");
            return false;
        }
        else
        {
            $.ajax({
                url:"../Assets/AjaxPages/AjaxRating.php",
                method:"POST",
                // Removed user_name, as it should be handled by the session on the server
                data:{rating_data:rating_data, user_review:user_review, lab_id:lab_id},
                success:function(data)
                {
                    $('#review_modal').modal('hide');
                    load_rating_data();
                    alert(data); // Show success/error message from server
                }
            })
        }
    }); 

    load_rating_data();

    function load_rating_data()
    {
        var lab_id = $('#txt_tid').val();
        
        $.ajax({
            url:"../Assets/AjaxPages/AjaxRating.php",
            method:"POST",
            data:{action:'load_data',rid:lab_id},
            dataType:"JSON",
            success:function(data)
            {
                // This line was incorrect and removed: $("#review_content").html(data);
                
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    // Reset stars first
                    $(this).removeClass('text-warning');
                    $(this).addClass('star-light');
                    
                    // Fill stars
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).removeClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);
                $('#total_four_star_review').text(data.four_star_review);
                $('#total_three_star_review').text(data.three_star_review);
                $('#total_two_star_review').text(data.two_star_review);
                $('#total_one_star_review').text(data.one_star_review);

                // Prevent division by zero if total_review is 0
                if(data.total_review > 0)
                {
                    $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
                    $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
                    $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
                    $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
                    $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
                } else {
                    // Reset progress bars if no reviews
                    $('#five_star_progress').css('width', '0%');
                    $('#four_star_progress').css('width', '0%');
                    $('#three_star_progress').css('width', '0%');
                    $('#two_star_progress').css('width', '0%');
                    $('#one_star_progress').css('width', '0%');
                }

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';
                        
                        // User avatar column
                        html += '<div class="col-sm-1" align="center">';
                        html += '<img src="../Assets/Files/User/Photo/' + data.review_data[count].user_photo + '" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" onerror="this.onerror=null; this.src=\'https://placehold.co/50x50/EFEFEF/AAAAAA?text=User\';">';
                        html += '</div>';

                        // Review content column
                        html += '<div class="col-sm-11">';
                        html += '<div class="card">';
                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';
                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';
                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }
                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';
                        html += data.review_data[count].user_review;
                        html += '</div>';
                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }

});
</script>
<?php
// Note: Foot.php is not included as this is a standalone page
ob_flush();
?> 
