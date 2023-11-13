<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Program</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }

      div {
        text-align: center;
        margin-top: 50px;
      }

      form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h2 {
        color: #333;
      }

      label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
      }

      input,select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
      }


      button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      button:hover {
        background-color: #45a049;
      }
    </style>
  </head>
  <body>
    <div>
      <h2>Add a Program</h2>
      <form action="{{url('/')}}/add/program" method="post">
      @csrf
        <label for="name">Program Name:</label>
        <input type="text" id="name" name="name"  value="{{old('name')}}" />
        <span class="text-danger"style="color:red">
            @error('name')
               {{$message}}
               @enderror
               </span>

        <label for="department">Choose Department:</label>
        <select name="department" id="department">
        @foreach($departments as $department)
            <option >{{ $department->name }}</option>
        @endforeach
    </select>
        <span class="text-danger"style="color:red">
            @error('department')
               {{$message}}
               @enderror
               </span>

               @if(session('error'))
               <span class="alert alert-danger"style="color:red">
               {{ session('error') }}
                </span>
                @endif 
        <br>
        <button type="submit">Add Program</button>
      </form>
    </div>
  </body>
</html>