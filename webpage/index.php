Азам, [11.04.21 20:23]
<?php
include('connection.php');
session_start();

$get_info_stmt = $database->prepare('SELECT * FROM users u WHERE u.username = ?');

$no_such_user = false;
$wrong_pwd = false;
$rows = '';
$pwd = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_REQUEST['username'];
    $pwd = $_REQUEST['pwd'];
    $get_info_stmt->execute(array($username));
    $rows = $get_info_stmt->fetchAll();
    if ($rows == '')
        $no_such_user = true;
}
if (!$no_such_user && is_array($rows)) {
    foreach ($rows as $row){
        $ch_pwd = $row['password'];
        if ($pwd != $ch_pwd) {
            $wrong_pwd = true;
            unset($_SESSION['user']);
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>My Personal Page</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php include('header.php');
if (!isset($_SESSION['user'])) { ?>
    <!-- Show this part if user is not signed in yet -->
    <div class="twocols">
        <form action="index.php" method="post" class="twocols_col">
            <ul class="form">
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" />
                </li>
                <li>
                    <label for="pwd">Password</label>
                    <input type="password" name="pwd" id="pwd" />
                </li>
                <?php if ($no_such_user) { ?>
                    <li>
                        <h6 style="color: red;">No such account found</h6>
                    </li>
                <?php } ?>
                <?php if ($wrong_pwd) { ?>
                    <li>
                        <h6 style="color: red;">Wrong password or username</h6>
                    </li>
                <?php } ?>
                <li>
                    <label for="remember">Remember Me</label>
                    <input type="checkbox" name="remember" id="remember" checked />
                </li>
                <li>
                    <input type="submit" value="Submit" /> &nbsp; Not registered? <a href="register.php">Register</a>
                </li>
            </ul>
        </form>
        <div class="twocols_col">
            <h2>About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
        </div>
    </div>
<?php } else { ?>
    <!-- Show this part after user signed in successfully -->
    <div class="logout_panel"><a href="register.php">My Profile</a>&nbsp;|&nbsp;<a href="index.php?logout=1">Log Out</a></div>
    <h2>New Post</h2>
    <form action="index.php" method="post">
        <ul class="form">
            <li>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" />
            </li>
            <li>
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10"></textarea>
            </li>
            <li>
                <input type="submit" value="Post" />
            </li>
        </ul>
    </form>
    <div class="onecol">
        <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Author, Sep 2, 2017</h5>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
        <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Author, Sep 2, 2017</h5>

            Азам, [11.04.21 20:23]
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
    </div>
<?php } ?>
</body>
</html>