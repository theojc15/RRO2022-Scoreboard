<?php
    session_start();
    if ($_SESSION['name'] != 'admin') {
		header("location:../index.php");
	}
    $connection = new mysqli('localhost','root','','rro2022');
	if ($connection -> connect_errno) {
		echo "Failed to connect to MySQL: " . $connection -> connect_error;
		exit();
	}

    if(isset($_POST['submit'])) {
        $tim = $_POST['team'];
        $take = $_POST['take'];
        $mo_tidak_sempurna = $_POST['mo_tidak_sempurna'];
        $mo_sempurna = $_POST['mo_sempurna'];
        $md_tidak_sempurna = $_POST['md_tidak_sempurna'];
        $md_sempurna = $_POST['md_sempurna'];
        $ok_tidak_keluar = $_POST['ok_tidak_keluar'];
        $p_tidak_keluar = $_POST['p_tidak_keluar'];
        if ($_POST['disinfek'] == 'yes') {
            $disinfek = 10;
        }
        else {
            $disinfek = 0;
        }
        if ($_POST['finish'] == 'yes') {
            $finish = 10;
        }
        else {
            $finish = 0;
        }
        if ($_POST['surprise'] == 'yes') {
            $surprise = 20;
        }
        else {
            $surprise = 0;
        }
        $time = (float)$_POST['time'];
        $total = ((int)$mo_tidak_sempurna * 10) + ((int)$mo_sempurna * 20) + ((int)$md_tidak_sempurna * 15) + ((int)$md_sempurna * 30) + ((int)$ok_tidak_keluar * 10) + ((int)$p_tidak_keluar * 10) + $disinfek + $finish + $surprise;
        if($take == '1') {
            $query = "UPDATE scoreboard SET tag1 = $total, totaltag = (tag1 + tag2), time1 = $time, totaltime = (time1 + time2) WHERE kode = $tim";
            $update = mysqli_query($connection, $query);
            if (!$update) {
                die ("gagal");
            }
        }
        else if ($take == '2') {
            $query = "UPDATE scoreboard SET tag2 = $total, totaltag = (tag1 + tag2), time2 = $time, totaltime = (time1 + time2) WHERE kode = $tim";
            $update = mysqli_query($connection, $query);
            if (!$update) {
                die ("gagal");
            }
        }
        else if ($take == 'Final') {
            $query = "UPDATE final SET tag = $total, time = $time WHERE kode = $tim";
            $update = mysqli_query($connection, $query);
            if (!$update) {
                die ("gagal");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>INPUT NILAI</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link rel="stylesheet" media="all" href="css/main.css?v=<?php echo time();?>" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../scoreboard/scoreboard.php">RRO2022</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <?php if ($_SESSION['name'] == 'admin') { ?>
            <li class="nav-item active">
                <a class="nav-link" href="input.php">Input Score</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="../scoreboard/scoreboard.php">Scoreboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../final/final.php">Final</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
            </ul>
        </div>
	</nav>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">SCORING FORM</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Team</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="team">
                                            <?php
                                                $pilihan = mysqli_query($connection, "SELECT * FROM peserta");
                                                while($team = mysqli_fetch_array($pilihan)) {
                                                    if ($team['kode'] != 'admin') {
                                            ?>
                                            <option><?=$team['kode']?></option>
                                            <?php } } ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Take Point</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="take">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>Final</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- pindah orang -->
                        <h4>Memindahkan orang</h4>
                        <div class="form-row">
                            <div class="name">Tidak sempurna</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="mo_tidak_sempurna">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Sempurna</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="mo_sempurna">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- pindah disinfektan -->
                        <h4>Memindahkan disinfektan</h4>
                        <div class="form-row">
                            <div class="name">Tidak sempurna</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="md_tidak_sempurna">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Sempurna</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="md_sempurna">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- BONUS -->
                        <h4>Bonus</h4>
                        <div class="form-row">
                            <div class="name">Orang kuning tidak keluar</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="ok_tidak_keluar">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Pilar tidak keluar</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="p_tidak_keluar">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="label label--block">Disinfektan tidak keluar</label>
                                <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" value="yes" checked="checked" name="disinfek">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" value="no" name="disinfek">
                                    <span class="checkmark"></span>
                              </label>
                            </div>
                        </div>
                        <div class="form-row p-t-20">
                            <label class="label label--block">Finish</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" value="yes" checked="checked" name="finish">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" value="no" name="finish">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row p-t-20">
                            <label class="label label--block">Suprise rule</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" value="yes" checked="checked" name="surprise">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" value="no" name="surprise">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Time</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="time" Required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->