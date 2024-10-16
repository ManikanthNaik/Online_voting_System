<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Voting System</title>
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
      width: 50%; /* Adjust as needed */
      height: calc(100%);
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo {
      position: absolute;
      left: 0;
      width: 50%; /* Adjust as needed */
      height: calc(100%);
      background: #6855e0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo img {
		margin: auto;
      font-size: 8rem;
      background: white;
      padding: .5em 0.5em;
      border-radius:50% 50%;
      color: #000000b3;
    }

    button {
      cursor: pointer;
      border: 0;
      border-radius: 4px;
      font-weight: 600;
      margin: 0 10px;
      width: 200px;
      padding: 10px 0;
      box-shadow: 0 0 20px rgba(104, 85, 224, 0.2);
      transition: 0.4s;
    }

    .login-btn {
      color: rgb(104, 85, 224);
      background-color: rgba(255, 255, 255, 1);
      border: 1px solid rgba(104, 85, 224, 1);
    }

    .signup-btn {
      color: white;
      background-color: rgba(104, 85, 224, 1);
    }

    button:hover {
      color: white;
      width:;
      box-shadow: 0 0 20px rgba(104, 85, 224, 0.6);
      background-color: rgba(104, 85, 224, 1);
    }
  </style>
</head>

<body>

  <main id="main" class=" alert-info">
    <div class="logo">
      <img src="Screenshot 2024-03-15 193304.png" alt="Online Voting Logo">
    </div>
    <div id="login-right">
      <button class="login-btn" onclick="location.href='login1.php'">Login</button>
      <button class="signup-btn" onclick="location.href='signup.php'">Signup</button>
    </div>
  </main>

</body>

</html>
