<?php 
include('db_connect.php');

if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">
    <form action="" id="manage-user">
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
