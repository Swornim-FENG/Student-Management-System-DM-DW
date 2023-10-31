<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Professors</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }

      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
      }

      label {
        display: block;
        margin-bottom: 8px;
      }

      input {
        width: calc(100% - 24px);
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        display: inline-block;
      }

      .password-container {
        position: relative;
      }

      .password-container i {
        position: absolute;
        top: 20px;
        right: 30px;
        transform: translateY(-10px);
        cursor: pointer;
      }

      input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }
    </style>
  </head>
  <body>
    <div>
      <h3>Add a Professor</h3>
      <form action="{{url('/')}}/admin/addprofessors" method="post">
      @csrf
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="first_name" value="{{old('first_name')}}" />
        <span class="text-danger"style="color:red">
            @error('first_name')
               {{$message}}
               @enderror
               </span>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="last_name" value="{{old('last_name')}}"  />
        <span class="text-danger"style="color:red">
            @error('last_name')
               {{$message}}
               @enderror
               </span>

        <label for="per_address">Permanent Address:</label>
        <input type="text" id="per_address" name="permanent_address" value="{{old('permanent_address')}}" />
        <span class="text-danger"style="color:red">
            @error('permanent_address')
               {{$message}}
               @enderror
               </span>

        <label for="tem_address">Temporary Address:</label>
        <input type="text" id="tem_address" name="temporary_address" value="{{old('temporary_address')}}" />
        <span class="text-danger"style="color:red">
            @error('temporary_address')
               {{$message}}
               @enderror
               </span>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{old('email')}}"  />
        <span class="text-danger"style="color:red">
            @error('email')
               {{$message}}
               @enderror
               </span>
               
              

        <label for="password">Password:</label>
        <div class="password-container">
          <input type="password" id="password" name="password"  />
          <i class="fas fa-eye" id="togglePassword"></i>
          <span class="text-danger"style="color:red">
            @error('password')
               {{$message}}
               @enderror
               </span>
        </div>
        
        @if(session('error'))
               <span class="alert alert-danger"style="color:red">
               {{ session('error') }}
                </span>
                @endif
                
    
        <input type="submit" value="Enroll" />
      </form>
    </div>

    <script>
      
    </script>
  </body>
</html>