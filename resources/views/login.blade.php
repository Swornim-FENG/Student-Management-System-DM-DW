<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <title>Login</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        background-color: #ede7e7;
      }

      .signup-container {
        width: 300px;
        padding: 20px;
        border: 1px solid#2e2c2c;
        border-radius: 8px;
        background-color: #eae7e7f4;
      }

      label {
        display: block;
        margin-bottom: 8px;
        margin-bottom: 15px;
      }

      input {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
      }

      .password-container {
        position: relative;
        margin-right: 15px;
      }

      .toggle-password {
        position: absolute;
        top: 35%;
        right: -5%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px;
        color: #747373;
      }
      .username-input {
        margin-right: 15px;
      }
      button {
        background-color: #2596be;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      button:hover {
        background-color: #43cdf0;
      }
      .logo {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 50px;
      }
    </style>
  </head>
  <body>
    <img
      class="logo"
      src="https://kusoa.edu.np/wp-content/uploads/2018/08/kathmandu_university_logo_nepal.png"
      alt="Logo"
    />

    <div class="signup-container">
      <h2>Login</h2>
      <form id="signup-form" action="{{url('/')}}/login"method="post">
      @csrf
        <label for="email">Email:</label>
        <div class="username-input">
          <input type="Email" id="email" name="email" required />
        </div>
        <label for="password">Password:</label>
        <div class="password-container">
          <input type="password" id="password" name="password" required />
          <i
            class="fas fa-eye toggle-password"
            onclick="togglePasswordVisibility()"
          ></i>
        </div>
        @if(session('error'))
          <span class="alert alert-danger"style="color:red">
           {{ session('error') }}
          </span>
         @endif
        <button type="submit">Sign-In</button>
      </form>
    </div>

    <script>
      function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.querySelector(".toggle-password");

        if (passwordField.type === "password") {
          passwordField.type = "text";
          toggleIcon.classList.remove("fa-eye");
          toggleIcon.classList.add("fa-eye-slash");
        } else {
          passwordField.type = "password";
          toggleIcon.classList.remove("fa-eye-slash");
          toggleIcon.classList.add("fa-eye");
        }
      }
    </script>
  </body>
</html>