<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <title>Logged In <?php echo $user_profile->email; ?></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Logged In <?php echo $user_profile->email; ?></h1>
<p>
    User Email: <?php echo $user_profile->email; ?><br>
    User Qualifications: <?php echo $user_profile->qualification; ?><br>
    User Skills: <?php echo $user_profile->skills; ?><br>
    <span class="label label-success" style="font-size:18px;">User role : <?php echo $_SESSION['user_role']; ?> (Retrieved from OAuth server)</span>
</p>
 
<a href="?logout=1">Logout</a>.


<h1>Testing the third case</h1>
Sending access token to APi server<br>
Authenticates with the OAuth Sever<br>
Gaining API Access & Displaying API Credentials<br>

 <?php
 echo 'http://192.168.33.20/index.php?access_token='.$_SESSION['access_token'];
echo file_get_contents('http://192.168.33.20/index.php?access_token='.$_SESSION['access_token']);
?>

</body>
</html>