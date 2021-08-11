<?php
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "room";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    // echo gettype('delete') . "<br>";
    $sql = "DELETE FROM `room` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $delete = true;
    } else {
        echo "we could not delete the data, may be due to some network issue.";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $roomnoEdit = $_POST["roomnoEdit"];
        $bedsEdit = $_POST["bedsEdit"];
        $patientidEdit = $_POST["patientidEdit"];

        $s1 = str_replace(",","",$patientidEdit);
        $occupiedEdit = strlen($patientidEdit) - strlen($s1) + 1;
        $vacantEdit = $bedsEdit - $occupiedEdit;

        // Sql query to be executed
        $sql = "UPDATE `room` SET `roomno` = '$roomnoEdit' , `beds` = '$bedsEdit' , `occupied` = '$occupiedEdit' , `vacant` = '$vacantEdit' , `patientid` = '$patientidEdit' WHERE `room`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "Could not update the record successfully make sure the room number is not repeated";
        }
    } else {
        $roomno = $_POST["roomno"];
        $beds = $_POST["beds"];
        $patientid = $_POST["patientid"];

        // updating value of occcupied and vacant
        $s1 = str_replace(",","",$patientid);
        $occupied = strlen($patientid) - strlen($s1) + 1;
        $vacant = $beds - $occupied;

        $sql = "INSERT INTO `room` (`roomno`, `beds`, `occupied`, `vacant`, `patientid`) VALUES ('$roomno', '$beds', '$occupied', '$vacant', '$patientid')";
        $result = mysqli_query($conn, $sql);
        // checking for result
        if ($result) {
            $insert = true;
        } else {
            echo "The record could not be inserted, make sure the room nmuber is unique";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Room</title>
</head>

<body>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/rdbms/room/room.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="roomno">roomno</label>
                            <input type="text" class="form-control" id="roomnoEdit" name="roomnoEdit" aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <label for="beds">beds</label>
                            <input type="text" class="form-control" id="bedsEdit" name="bedsEdit" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="patientid">patientid</label>
                            <input type="text" class="form-control" id="patientidEdit" name="patientidEdit" aria-describedby="emailHelp" required>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="https://img.collegepravesh.com/2016/05/IIIT_Bhubaneswar_Logo.png" height="38px" width="40px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/rdbms/index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/rdbms/room/room.php">Refresh <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/rdbms/department/department.php">Department</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/rdbms/doctor/doctor.php">Doctor</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/rdbms/patient/patient.php">Patient</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/rdbms/salary/salary.php">Salary</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <h2 style="color:azure">Room</h2>
            </form>
        </div>
    </nav>
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Your data has been inserted successfully!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Your data has been deleted successfully!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Your data has been updated successfully!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <div class="container my-4">
        <form action="/rdbms/room/room.php" method="POST">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <!--width is set by this div -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">ROOM NO</span>
                            <input type="text" class="form-control" placeholder="ID" name="roomno" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="col-sm-4 col-sm-offset-4">
                        <!--width is set by this div -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">BEDS</span>
                            <input type="text" class="form-control" placeholder="beds" name="beds" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="col-sm-4 col-sm-offset-4">
                        <!--width is set by this div -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">PATIENT ID</span>
                            <input type="text" class="form-control" placeholder="Patient ID" name="patientid" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    <div class="container my-4">


        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th scope="col">ROOM NO</th>
                    <th scope="col">BEDS</th>
                    <th scope="col">OCCUPIED</th>
                    <th scope="col">VACANT</th>
                    <th scope="col">PATIENT ID</th>
                    <th scope="col">OPERATIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `room`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
                <th>" . $sno . "</th>
                <td>" . $row['roomno'] . "</td>
                <td>" . $row['beds'] . "</td>
                <td>" . $row['occupied'] . "</td>
                <td>" . $row['vacant'] . "</td>
                <td>" . $row['patientid'] . "</td>
                <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . " onclick='myFunction(event)'>Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button>  </td>
              </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>
    <script>
        function myFunction(event) {
            console.log("edit");
            tr = event.target.parentNode.parentNode;
            roomno = tr.getElementsByTagName("td")[0].innerText;
            beds = tr.getElementsByTagName("td")[1].innerText;
            patientid = tr.getElementsByTagName("td")[4].innerText;
            console.log(roomno, beds);
            roomnoEdit.value = roomno;
            bedsEdit.value = beds;
            patientidEdit.value = patientid;
            snoEdit.value = event.target.id;
            console.log(event.target.id)
            $('#editModal').modal('toggle');
        }
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this record!")) {
                    console.log("yes");
                    window.location = `/rdbms/room/room.php?delete=${sno}`;
                    // TODO: Create a form and use post request to submit a form
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>