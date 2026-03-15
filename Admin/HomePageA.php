<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

// --- Data Fetching for Dashboard Cards ---

// Total Users
$selUser = "SELECT count(*) as user_count FROM tbl_user";
$resUser = $Conn->query($selUser);
$dataUser = $resUser->fetch_assoc();
$userCount = $dataUser['user_count'];

// Total Labs
$selLab = "SELECT count(*) as lab_count FROM tbl_lab";
$resLab = $Conn->query($selLab);
$dataLab = $resLab->fetch_assoc();
$labCount = $dataLab['lab_count'];

// Pending Lab Verifications
$selPendingLab = "SELECT count(*) as pending_lab_count FROM tbl_lab WHERE (lab_status = 0 OR lab_status = 2)";
$resPendingLab = $Conn->query($selPendingLab);
$dataPendingLab = $resPendingLab->fetch_assoc();
$pendingLabCount = $dataPendingLab['pending_lab_count'];

// Pending Complaints
$selPendingComplaint = "SELECT count(*) as pending_complaint_count FROM tbl_complaint WHERE complaint_status = 0";
$resPendingComplaint = $Conn->query($selPendingComplaint);
$dataPendingComplaint = $resPendingComplaint->fetch_assoc();
$pendingComplaintCount = $dataPendingComplaint['pending_complaint_count'];

?>

<style>
    .a {
        color: #ffffffff;
    }

    a:hover {
        color: #b7b5b5ff;
    }
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Complaint View</title>
    <style>
        /* Added styles for table column widths */
        .table-responsive .table {
            table-layout: fixed;
            /* Prevents content from expanding columns */
            width: 1600px;
        }

        .table-responsive .table th,
        .table-responsive .table td {
            word-wrap: break-word;
            /* Allows long text to wrap */
        }

        /* SlNo */
        .table-responsive .table th:nth-child(1),
        .table-responsive .table td:nth-child(1) {
            width: 5%;
        }

        /* Recipient */
        .table-responsive .table th:nth-child(2),
        .table-responsive .table td:nth-child(2) {
            width: 10%;
            white-space: normal; /* Allow wrapping */
        }
 
        /* Customer Name */
        .table-responsive .table th:nth-child(3),
        .table-responsive .table td:nth-child(3) {
            width: 10%;
        }

        /* Title */
        .table-responsive .table th:nth-child(4),
        .table-responsive .table td:nth-child(4) {
            width: 15%;
            white-space: normal; /* Allow wrapping */
        }
 
        /* Content */
        .table-responsive .table th:nth-child(5),
        .table-responsive .table td:nth-child(5) {
            width: 25%;
            /* max-width: 400px; */
            /* This was inline, moved to CSS, but width % is better */
            white-space: normal;
            /* Ensures content wraps */
        }

        /* Date */
        .table-responsive .table th:nth-child(6),
        .table-responsive .table td:nth-child(6) {
            width: 10%;
        }

        /* Reply */
        .table-responsive .table th:nth-child(7),
        .table-responsive .table td:nth-child(7) {
            width: 25%;
            white-space: normal; /* Allow wrapping */
        }

        /* Table Body Rows */
        tr:hover {
            background-color: #111621ff;
            transition: background-color 0.3s;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><?php echo $userCount; ?></h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-account-multiple icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a class="a" href="UserList.php">Total Users</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><?php echo $labCount; ?></h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-hospital-building icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a class="a" href="LabList.php">Total Labs</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><?php echo $pendingLabCount; ?></h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-warning">
                                    <span class="mdi mdi-timer-sand"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a class="a" href="LabVList.php">Pending Lab Verifications</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><?php echo $pendingComplaintCount; ?></h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-danger">
                                    <span class="mdi mdi-comment-alert icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal"><a class="a" href="ComplaintViewA.php">Pending Complaints</a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Complaints</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SlNo</th>
                                        <th>Recipient</th>
                                        <th>Customer Name</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Date</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $selQry = "select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id left join tbl_lab l on c.lab_id=l.lab_id ORDER BY complaint_date DESC";
                                    $res = $Conn->query($selQry);
                                    while ($data = $res->fetch_assoc()) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td>
                                                <?php
                                                if ($data['lab_id'] != "" && $data['lab_id'] != 0) {
                                                    echo $data['lab_name'] . "<br/><small class='text-muted'>" . $data['lab_email'] . "</small>";
                                                } else {
                                                    echo "Admin";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $data['user_name'] ?></td>
                                            <td><?php echo $data['complaint_title'] ?></td>
                                            <td><?php echo $data['complaint_content'] ?></td>
                                            <td><?php echo $data['complaint_date'] ?></td>
                                            <td>
                                                <?php
                                                if ($data['complaint_status'] == 0) {
                                                ?>
                                                    <a href="Reply.php?rid=<?php echo $data['complaint_id'] ?>" class="badge badge-outline-primary">Reply</a>
                                                <?php
                                                } else {
                                                    echo $data['complaint_reply'];
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('Foot.php');
    ?>
</body>

</html>


