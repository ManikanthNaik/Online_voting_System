<?php
// Check if user_id is set and not empty
if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    // Include database connection
    include 'db_connect.php';
    
    // Sanitize user_id to prevent SQL injection
    $user_id = $conn->real_escape_string($_POST['user_id']);
    
    // Query to delete user from the database
    $delete_query = "DELETE FROM users WHERE id = '$user_id'";
    
    if($conn->query($delete_query) === TRUE) {
        // User deleted successfully
        echo "User deleted successfully!";
    } else {
        // Error deleting user
        echo "Error deleting user: " . $conn->error;
    }
    
    // Close database connection
    $conn->close();
} else {
    // If user_id is not set or empty, return error message
    echo "Invalid user ID.";
}
?>
