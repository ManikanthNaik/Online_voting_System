<?php 

?>

<div class="container-fluid">
    
    <div class="row">
    <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
    </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'db_connect.php';
                    $users = $conn->query("SELECT * FROM users order by name asc");
                    $i = 1;
                    while($row= $users->fetch_assoc()):
                 ?>
                 <tr>
                    <td>
                        <?php echo $i++ ?>
                    </td>
                    <td>
                        <?php echo $row['name'] ?>
                    </td>
                    <td>
                        <?php echo $row['username'] ?>
                    </td>
                    <td>
                        <center>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary">Action</button>
                                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
                                  </div>
                                </div>
                                </center>
                    </td>
                 </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>

</div>
<script>
    
$('#new_user').click(function(){
    uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
    uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})

$('.delete_user').click(function(){
    var user_id = $(this).attr('data-id');
    // You can replace the following confirmation with your preferred confirmation method
    var confirm_delete = confirm("Are you sure you want to delete this user?");
    if (confirm_delete) {
        // Perform AJAX request to delete the user
        $.ajax({
            url: 'delete_user.php',
            method: 'POST',
            data: { user_id: user_id },
            success: function(response) {
                // Handle success response
                alert('User deleted successfully!');
                // You may want to reload the page or update the user list after deletion
                // For example, you can use location.reload() to refresh the page
                // Or update the table row to remove the deleted user
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
                alert('Error deleting user. Please try again.');
            }
        });
    }
});

</script>
