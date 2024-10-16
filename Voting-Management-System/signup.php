<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Voting System</title>
  <?php include('./header.php'); ?>
  <?php
  session_start();
  if (isset($_SESSION['login_id'])) {
    header("location:index.php?page=home");
  }
  ?>
  <style>
    body {
      width: 100%;
      height: calc(100%);
      background: #007bff;
    }

    main#main {
      width: 100%;
      height: calc(100%);
      background: white;
    }

    #login-right {
      position: absolute;
      right: 0;
      width: 50%;
      height: calc(100%);
      background: white;
      display: flex;
      align-items: center;
    }


    #login-left {
      position: absolute;
      left: 0;
      width: 50%;
      height: calc(100%);
      background: #00000061;
      display: flex;
      align-items: center;
    }

    #login-right .card {
      margin: 100px;
    }

  

    .logo {
      margin: 100px;
      font-size: 8rem;
      background: white;
      padding: .5em 0.5em;
      border-radius:50% 50%;
      color: #000000b3;
    }
  </style>
</head>

<body>

  <main id="main" class=" alert-info">
    <div id="login-left">
	<div class="logo">
  <img src="Screenshot 2024-03-15 193304.png" alt="Online Voting Logo">
</div>

      </div>
    </div>
   <!--<div id="login-right">
      <div class="card col-md-8">
        <div class="card-body">
          <form id="login-form">
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input type="password" id="password" name="password" class="form-control">
            </div>
            <center>
              <button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button>
            </center>
          </form>
        </div>
      </div>-->
      <!-- New user form -->
      <div id="login-right">
        <div class="card col-md-8">
          <div class="card-body">
            <form id="manage-user">
            <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
            <div id="name-error" class="text-danger"></div> <!-- Error message container -->
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['id']: '' ?>" required>
            <div id="password-error" class="text-danger"></div> <!-- Error message container -->
        </div>  
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="<?php echo isset($meta['age']) ? $meta['age']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="type">User Type</label>
            <select name="type" id="type" class="custom-select">
                <option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
                <option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#manage-user').submit(function(e){
            e.preventDefault();
            var age = $('#age').val();
            if (age < 18) {
                alert('You should be 18+ to vote.');
                return;
            }
            var name = $('#name').val();
            if (!/^[a-zA-Z]+$/.test(name)) {
                $('#name-error').text('Name should only contain characters').show();
                return;
            } else {
                $('#name-error').hide(); // Hide error message if validation passes
            }
            var password = $('#password').val();
            if (password.length < 8) {
                $('#password-error').text('Password should be at least 8 characters long').show();
                return;
            } else {
                $('#password-error').hide(); // Hide error message if validation passes
            }
            if (!/[a-z]/.test(password)) {
                $('#password-error').text('Password should contain at least one lowercase letter').show();
                return;
            } else {
                $('#password-error').hide(); // Hide error message if validation passes
            }
            if (!/[A-Z]/.test(password)) {
                $('#password-error').text('Password should contain at least one uppercase letter').show();
                return;
            } else {
                $('#password-error').hide(); // Hide error message if validation passes
            }
            if (!/\d/.test(password)) {
                $('#password-error').text('Password should contain at least one number').show();
                return;
            } else {
                $('#password-error').hide(); // Hide error message if validation passes
            }
            if (!/[@$!%*?&]/.test(password)) {
                $('#password-error').text('Password should contain at least one special character').show();
                return;
            } else {
                $('#password-error').hide(); // Hide error message if validation passes
            }
            start_load();
            $.ajax({
                url:'ajax.php?action=save_user',
                method:'POST',
                data:$(this).serialize(),
                success:function(resp){
                    if(resp ==1){
                        alert_toast("Data successfully saved",'success');
                        setTimeout(function(){
                            location.reload();
                        },1500);
                    }
                }
            });
        });
    });

    function start_load(){
        // Your loading indicator code goes here
    }

    function alert_toast($msg,$bg = 'success'){
        // Your toast alert code goes here
    }
</script>

  <script>
    $('#login-form').submit(function(e) {
      e.preventDefault();
      $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
      if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
          console.log(err)
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        },
        success: function(resp) {
          if (resp == 1) {
            location.href = 'index.php?page=home';
          } else if (resp == 2) {
            location.href = 'voting.php';
          } else {
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
            $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
          }
        }
      })
    })
  </script>
</body>

</html>