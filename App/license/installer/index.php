<?php
require_once '../includes/lb_helper.php'; // Include LicenseBox external/client api helper file
$api = new LicenseBoxAPI(); // Initialize a new LicenseBoxAPI object
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Laundering - Installer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../../public/admin/css/login.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>

  </head>
  <body>
    <section class="main-area">
        <div class="container-fluid">
            <div class="row h100">
                <div class="col-md-6 p-0 m-none" style="background: url('../../public/images/app/bg_img_static.jpg') center center;background-size: cover;background-repeat: no-repeat;">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                </div>
                <div class="col-md-6">
                    <div class="login">
                        <div class="center-box">
                            <?php
                                $errors = false;
                                $step = isset($_GET['step']) ? $_GET['step'] : '';
                            ?>
                            <div class=""> 
                                <div class="">
                                <div class="column is-8 is-offset-2">
                                    <center>
                                        <h1 class="title login_head">Laundering Installer</h1><br>
                                    </center>
                                    <div class="box">
                                    <?php
                                    switch ($step) {
                                        default: ?>
                                        <div class="tabs is-fullwidth">
                                            <ul>
                                            <li class="is-active">
                                                <a>
                                                <span><b>Requirements</b></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span>Verify</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span>Database</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span>Finish</span>
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                        <?php  
                                            // Add or remove your script's requirements below
                                            if(phpversion() < "5.5"){
                                            $errors = true;
                                            echo "<div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i> Current PHP version is ".phpversion()."! minimum PHP 5.5 or higher required.</div>";
                                            }else{
                                            echo "<div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> You are running PHP version ".phpversion()."</div>";
                                            }
                                            if(!extension_loaded('mysqli')){
                                            $errors = true; 
                                            echo "<div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i> MySQLi PHP extension missing!</div>";
                                            }else{
                                            echo "<div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> MySQLi PHP extension available</div>";
                                            } 
                                        ?>
                                        <div style='text-align: right;'>
                                            <?php if($errors==true){ ?>
                                            <a href="#" class="btn btn-lg btn-primary btn-block btn-salon" disabled>Next</a>
                                            <?php }else{ ?>
                                            <a href="index.php?step=0" class="btn btn-lg btn-primary btn-block btn-salon">Next</a>
                                            <?php } ?>
                                        </div><?php
                                        break;
                                        case "0": ?>
                                        <div class="tabs is-fullwidth">
                                            <ul>
                                            <li>
                                                <a>
                                                <span><i class="fa fa-check-circle"></i> Requirements</span>
                                                </a>
                                            </li>
                                            <li class="is-active">
                                                <a>
                                                <span><b>Verify</b></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span>Database</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span>Finish</span>
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                        <?php
                                            $license_code = null;
                                            $client_name = null;
                                            if(!empty($_POST['license'])&&!empty($_POST['client'])){
                                            $license_code = strip_tags(trim($_POST["license"]));
                                            $client_name = strip_tags(trim($_POST["client"]));
                                            /* Once we have the license code and client's name we can use LicenseBoxAPI's activate_license() function for activating/installing the license, if the third parameter is empty a local license file will be created which can be used for background license checks. */
                    $activate_response = true;

					 file_put_contents(__DIR__ . '/../includes/.lic', 'Nulled', LOCK_EX);
                      $msg= "Nulled By Codecanyom.com";
                    if($activate_response != true){ ?>
                                                <form action="index.php?step=0" method="POST">
                                                    <div class="notification is-danger"><?php echo ucfirst($msg); ?></div>
                                                    <div class="field">
                                                        <input type="hidden" value="<?php echo $license_code ?>" name="license_code">
                                                        <input type="hidden" value="<?php echo $client_name ?>" name="client_name">
                                                      <label class="label">License code</label>
                                                      <div class="control">
                                                        <input class="input" type="text" placeholder="enter your purchase/license code" name="license" required value="Nulled By Codecanyom.com">
                                                      </div>
                                                    </div>
                                                    <div class="field">
                                                      <label class="label">Your name</label>
                                                      <div class="control">
                                                        <input class="input" type="text" placeholder="enter your name/envato username" name="client" required value="Nulled By Codecanyom.com">
                                                      </div>
                                                    </div>
                                                    <div class="mt-5">
                                                      <button type="submit" class="btn btn-lg btn-primary btn-block btn-salon">Verify</button>
                                                    </div>
                                                </form><?php
                                              }else{ ?>
                                                <form action="index.php?step=1" method="POST">
                                                <div class="notification is-success"><?php echo ucfirst($msg); ?></div>
                                                <input type="hidden" name="lcscs" id="lcscs" value="Nulled By Codecanyom.com">
                                            
                                                <input type="hidden" value="<?php echo $license_code ?>" name="license_code">
                                                <input type="hidden" value="<?php echo $client_name ?>" name="client_name">
                                                <div class="mt-5">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-salon">Next</button>
                                                </div>
                                                </form><?php
                                            }
                                        }else{ ?>
                                            <form action="index.php?step=0" method="POST">
                                              <div class="field">
                                                <label class="label">License code</label>
                                                <div class="control">
                                                  <input class="input" type="text" placeholder="enter your purchase/license code" name="license" required value="Nulled By Codecanyom.com">
                                                </div>
                                              </div>
                                              <div class="field">
                                                <label class="label">Your name</label>
                                                <div class="control">
                                                  <input class="input" type="text" placeholder="enter your name/envato username" name="client" required value="Nulled By Codecanyom.com">
                                                </div>
                                              </div>
                                              <div class="mt-5">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block btn-salon">Verify</button>
                                              </div>
                                            </form>
                                          <?php } 
                                        break;
                                        case "1": ?>
                                        <div class="tabs is-fullwidth">
                                            <ul>
                                            <li>
                                                <a>
                                                <span><i class="fa fa-check-circle"></i> Requirements</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span><i class="fa fa-check-circle"></i> Verify</span>
                                                </a>
                                            </li>
                                            <li class="is-active">
                                                <a>
                                                <span><b>Database</b></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                <span>Finish</span>
                                                </a>
                                            </li>
                                            </ul>
                                        </div>
                                        <?php
                                            if($_POST && isset($_POST["lcscs"])){
                                            $valid = strip_tags(trim($_POST["lcscs"]));
                                            $license_code = strip_tags(trim($_POST["license_code"]));
                                            $client_name = strip_tags(trim($_POST["client_name"]));
                                            $db_host = strip_tags(trim($_POST["host"]));
                                            $db_user = strip_tags(trim($_POST["user"]));
                                            $db_pass = strip_tags(trim($_POST["pass"]));
                                            $db_name = strip_tags(trim($_POST["name"]));
                                            // Let's import the sql file into the given database
                                            if(!empty($db_host)){
                                                $con = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                                                if(mysqli_connect_errno()){ ?>
                                                <form action="index.php?step=1" method="POST">
                                                    <div class='notification is-danger'>Failed to connect to MySQL: <?php echo mysqli_connect_error(); ?></div>
                                                    <input type="hidden" name="lcscs" id="lcscs" value="<?php echo $valid; ?>">
                                                    <input type="hidden" name="license_code" id="license_code" value="<?php echo $license_code; ?>">
                                                    <input type="hidden" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                                                    <div class="field">
                                                    <label class="label">Database Host</label>
                                                    <div class="control">
                                                        <input class="input" type="text" id="host" placeholder="enter your database host" name="host" required>
                                                    </div>
                                                    </div>
                                                    <div class="field">
                                                    <label class="label">Database Username</label>
                                                    <div class="control">
                                                        <input class="input" type="text" id="user" placeholder="enter your database username" name="user" required>
                                                    </div>
                                                    </div>
                                                    <div class="field">
                                                    <label class="label">Database Password</label>
                                                    <div class="control">
                                                        <input class="input" type="text" id="pass" placeholder="enter your database password" name="pass">
                                                    </div>
                                                    </div>
                                                    <div class="field">
                                                    <label class="label">Database Name</label>
                                                    <div class="control">
                                                        <input class="input" type="text" id="name" placeholder="enter your database name" name="name" required>
                                                    </div>
                                                    </div>
                                                    <div class="mt-5">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-salon">Import</button>
                                                    </div>
                                                </form><?php
                                                exit;
                                                }
                                                $templine = '';
                                                $lines = file('../includes/laundering.sql');
                                                foreach($lines as $line){
                                                if(substr($line, 0, 2) == '--' || $line == '')
                                                    continue;
                                                $templine .= $line;
                                                $query = false;
                                                if(substr(trim($line), -1, 1) == ';'){
                                                    $query = mysqli_query($con, $templine);
                                                    $templine = '';
                                                }
                                                } ?>
                                            <form action="index.php?step=2" method="POST">
                                                <div class='notification is-success'>Database was successfully imported.</div>
                                                <input type="hidden" name="dbscs" id="dbscs" value="true">
                                                <input type="hidden" name="license_code" id="license_code" value="<?php echo $license_code; ?>">
                                                <input type="hidden" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                                                <input type="hidden" name="db_host" id="db_host" value="<?php echo $db_host; ?>">
                                                <input type="hidden" name="db_user" id="db_user" value="<?php echo $db_user; ?>">
                                                <input type="hidden" name="db_pass" id="db_pass" value="<?php echo $db_pass; ?>">
                                                <input type="hidden" name="db_name" id="db_name" value="<?php echo $db_name; ?>">
                                                <div class="mt-5">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block btn-salon">Next</button>
                                                </div>
                                            </form><?php
                                            }else{ ?>
                                            <form action="index.php?step=1" method="POST">
                                                <input type="hidden" name="lcscs" id="lcscs" value="<?php echo $valid; ?>">
                                                <input type="hidden" name="license_code" id="license_code" value="<?php echo $license_code; ?>">
                                                <input type="hidden" name="client_name" id="client_name" value="<?php echo $client_name; ?>">
                                                <div class="field">
                                                <label class="label">Database Host</label>
                                                <div class="control">
                                                    <input class="input" type="text" id="host" placeholder="enter your database host" name="host" required>
                                                </div>
                                                </div>
                                                <div class="field">
                                                <label class="label">Database Username</label>
                                                <div class="control">
                                                    <input class="input" type="text" id="user" placeholder="enter your database username" name="user" required>
                                                </div>
                                                </div>
                                                <div class="field">
                                                <label class="label">Database Password</label>
                                                <div class="control">
                                                    <input class="input" type="text" id="pass" placeholder="enter your database password" name="pass">
                                                </div>
                                                </div>
                                                <div class="field">
                                                <label class="label">Database Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" id="name" placeholder="enter your database name" name="name" required>
                                                </div>
                                                </div>
                                                <div class="mt-5">
                                                <button type="submit" class="btn btn-lg btn-primary btn-block btn-salon">Import</button>
                                                </div>
                                            </form><?php
                                        } 
                                        }else{ ?>
                                        <div class='notification is-danger'>Sorry, something went wrong.</div><?php
                                        }
                                        break;
                                    case "2": ?>
                                        <div class="tabs is-fullwidth">
                                        <ul>
                                            <li>
                                            <a>
                                                <span><i class="fa fa-check-circle"></i> Requirements</span>
                                            </a>
                                            </li>
                                            <li>
                                            <a>
                                                <span><i class="fa fa-check-circle"></i> Verify</span>
                                            </a>
                                            </li>
                                            <li>
                                            <a>
                                                <span><i class="fa fa-check-circle"></i> Database</span>
                                            </a>
                                            </li>
                                            <li class="is-active">
                                            <a>
                                                <span><b>Finish</b></span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                        <?php
                                        if($_POST && isset($_POST["dbscs"])){
                                        $valid = $_POST["dbscs"];
                                        $client_name = $_POST["client_name"];
                                        $license_code = $_POST["license_code"];
                                        $db_host = strip_tags(trim($_POST["db_host"]));
                                        $db_user = strip_tags(trim($_POST["db_user"]));
                                        $db_pass = strip_tags(trim($_POST["db_pass"]));
                                        $db_name = strip_tags(trim($_POST["db_name"]));
                                        ?>
                                        <center>
                                            <p><strong>Application is successfully installed.</strong></p><br>
                                        </center>
                                        <form action="" id="adminDetailForm" method="post">
                                            <div class="field">
                                                <label class="label">Admin Email</label>
                                                <div class="control">
                                                    <input class="input" value="admin@gmail.com" type="text" id="host" placeholder="Admin Name" name="name" readonly>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Admin Password</label>
                                                <div class="control">
                                                    <input class="input" value="admin123" type="text" id="user" placeholder="Password" name="password" readonly>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?php echo $license_code ?>" name="license_code">
                                            <input type="hidden" value="<?php echo $client_name ?>" name="client_name">
                                            <input type="hidden" name="db_host" id="db_host" value="<?php echo $db_host; ?>">
                                            <input type="hidden" name="db_user" id="db_user" value="<?php echo $db_user; ?>">
                                            <input type="hidden" name="db_pass" id="db_pass" value="<?php echo $db_pass; ?>">
                                            <input type="hidden" name="db_name" id="db_name" value="<?php echo $db_name; ?>">
                                            <div class="mt-5">
                                                <button type="button" id="proccedLogin" class="btn btn-lg btn-primary btn-block btn-salon">Procced to Login</button>
                                            </div>
                                        </form>
                                        <?php
                                        }else{ ?>
                                        <div class='notification is-danger'>Sorry, something went wrong.</div><?php
                                        } 
                                    break;
                                    } ?>
                                </div>
                                </div>
                                </div>
                            </div>
                            
                            <div class="content has-text-centered mt-5">
                                    <p>Copyright <?php echo date('Y'); ?> Company, All rights reserved.</p><br>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <!-- <script src="../../public/includes/js/myjavascript.js"></script> -->

</body>
<script>
    jQuery(document).on("click","#proccedLogin", function () {
    url = window.location.origin + window.location.pathname
    url = url.slice(0, -1)
    var name = url.substring(0, url.lastIndexOf("license"));
    var formData = new FormData($('#adminDetailForm')[0]);
    $.ajax({
        type:"POST",
        url:name+"public/saveEnvData",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(result){
            console.log('result',result)
            if(result.success==true){
                window.location.replace(result.data);
            }
        },
        error: function(err){
            console.log('err',err)
            for (let v1 of Object.keys( err.responseJSON.errors)) {
                $(".field ."+v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
});
</script>
</html>