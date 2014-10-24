<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Login using Email &amp; password<br><small>AHQ Webapp, Gung-ho Webapp, AHQ desktop app etc can OAuth this way</small></h1>
        
	<div class="col-md-3">
            <form action="" method="post">
                    <div class="form-group">
                        <label>Email</label><br>
                        <input type="text" name="username" class="form-input" placeholder="Enter Email" />
                    </div>
                
                    <div class="form-group">
                        <label>Password</label><br>
                        <input type="password" name="password" class="form-input" placeholder="Enter username" />
                    </div>
                    <?php
                    $err=$this->session->flashdata('login_error');
                    if($err)
                    {
                        ?>
                <div class="alert alert-danger">
                    <?php echo lang('messages.userlogin.invalid.credentials'); ?>
                </div>
                <?php
                    }
                    ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" >Login</button>
                    </div>
                
            </form>
	</div>	
</div>

</body>
</html>