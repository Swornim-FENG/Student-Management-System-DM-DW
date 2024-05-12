<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Super Admin</title>
  </head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

    :root {
      --light: #f6f6f9;
      --primary: #1976d2;
      --light-primary: #cfe8ff;
      --grey: #eee;
      --dark-grey: #aaaaaa;
      --dark: #363949;
      --danger: #d32f2f;
      --light-danger: #fecdd3;
      --warning: #fbc02d;
      --light-warning: #fff2c6;
      --success: #388e3c;
      --light-success: #bbf7d0;
    }
    .logo {
      margin: 2rem 0 1rem 0;
      padding-bottom: 3rem;
      display: flex;
      align-items: center;
    }
    .logo img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-left: 0.4rem;
    }
    .logo h4 {
      margin-left: 1rem;
      text-transform: uppercase;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    .bx {
      font-size: 1.7rem;
    }

    a {
      text-decoration: none;
    }

    li {
      list-style: none;
    }

    html {
      overflow-x: hidden;
    }

    body.dark {
      --light: #181a1e;
      --grey: #25252c;
      --dark: #fbfbfb;
    }

    body {
      background: var(--grey);
      overflow-x: hidden;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      background: var(--light);
      width: 230px;
      height: 100%;
      z-index: 2000;
      overflow-x: hidden;
      scrollbar-width: none;
      transition: all 0.3s ease;
    }

    .sidebar::-webkit-scrollbar {
      display: none;
    }

    .sidebar.close {
      width: 60px;
    }

    .sidebar .logo {
      font-size: 24px;
      font-weight: 700;
      height: 56px;
      display: flex;
      align-items: center;
      color: var(--primary);
      z-index: 500;
      padding-bottom: 20px;
      box-sizing: content-box;
    }

    .sidebar .logo .logo-name span {
      color: var(--dark);
    }

    .sidebar .logo .bx {
      min-width: 60px;
      display: flex;
      justify-content: center;
      font-size: 2.2rem;
    }

    .sidebar .side-menu {
      width: 100%;
      margin-top: 48px;
    }

    .sidebar .side-menu li {
      height: 48px;
      background: transparent;
      margin-left: 6px;
      border-radius: 48px 0 0 48px;
      padding: 4px;
    }

    .sidebar .side-menu li.active {
      background: var(--grey);
      position: relative;
    }

    .sidebar .side-menu li.active::before {
      content: "";
      position: absolute;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      top: -40px;
      right: 0;
      box-shadow: 20px 20px 0 var(--grey);
      z-index: -1;
    }

    .sidebar .side-menu li.active::after {
      content: "";
      position: absolute;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      bottom: -40px;
      right: 0;
      box-shadow: 20px -20px 0 var(--grey);
      z-index: -1;
    }

    .sidebar .side-menu li a {
      width: 100%;
      height: 100%;
      background: var(--light);
      display: flex;
      align-items: center;
      border-radius: 48px;
      font-size: 16px;
      color: var(--dark);
      white-space: nowrap;
      overflow-x: hidden;
      transition: all 0.3s ease;
    }

    .sidebar .side-menu li.active a {
      color: var(--success);
    }

    .sidebar.close .side-menu li a {
      width: calc(48px - (4px * 2));
      transition: all 0.3s ease;
    }

    .sidebar .side-menu li a .bx {
      min-width: calc(60px - ((4px + 6px) * 2));
      display: flex;
      font-size: 1.6rem;
      justify-content: center;
    }

    .sidebar .side-menu li a.logout {
      color: var(--danger);
    }

    .content {
      position: relative;
      width: calc(100% - 230px);
      left: 230px;
      transition: all 0.3s ease;
    }

    .sidebar.close ~ .content {
      width: calc(100% - 60px);
      left: 60px;
    }
    .add {
      margin-left: 900px;
    }
    .custom-button {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-left: 900px;
    }

    .custom-button:hover {
      background-color: #2980b9;
    }

    .content nav {
      height: 56px;
      background: var(--light);
      padding: 0 24px 0 0;
      display: flex;
      align-items: center;
      grid-gap: 24px;
      position: sticky;
      top: 0;
      left: 0;
      z-index: 1000;
    }

    .content nav::before {
      content: "";
      position: absolute;
      width: 40px;
      height: 40px;
      bottom: -40px;
      left: 0;
      border-radius: 50%;
      box-shadow: -20px -20px 0 var(--light);
    }

    .content nav a {
      color: var(--dark);
    }

    .content nav .bx.bx-menu {
      cursor: pointer;
      color: var(--dark);
    }

    .content nav form {
      max-width: 400px;
      width: 100%;
      margin-right: auto;
    }

    .content nav form .form-input {
      display: flex;
      align-items: center;
      height: 36px;
    }

    .content nav form .form-input input {
      flex-grow: 1;
      padding: 0 16px;
      height: 100%;
      border: none;
      background: var(--grey);
      border-radius: 36px 0 0 36px;
      outline: none;
      width: 100%;
      color: var(--dark);
    }

    .content nav form .form-input button {
      width: 80px;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background: var(--primary);
      color: var(--light);
      font-size: 18px;
      border: none;
      outline: none;
      border-radius: 0 36px 36px 0;
      cursor: pointer;
    }

    .content nav .notif {
      font-size: 20px;
      position: relative;
    }

    .content nav .notif .count {
      position: absolute;
      top: -6px;
      right: -6px;
      width: 20px;
      height: 20px;
      background: var(--danger);
      border-radius: 50%;
      color: var(--light);
      border: 2px solid var(--light);
      font-weight: 700;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .content nav .profile img {
      width: 36px;
      height: 36px;
      object-fit: cover;
      border-radius: 50%;
    }

    .content nav .theme-toggle {
      display: block;
      min-width: 50px;
      height: 25px;
      background: var(--grey);
      cursor: pointer;
      position: relative;
      border-radius: 25px;
    }

    .content nav .theme-toggle::before {
      content: "";
      position: absolute;
      top: 2px;
      left: 2px;
      bottom: 2px;
      width: calc(25px - 4px);
      background: var(--primary);
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .content nav #theme-toggle:checked + .theme-toggle::before {
      left: calc(100% - (25px - 4px) - 2px);
    }

    .content main {
      width: 100%;
      padding: 36px 24px;
      max-height: calc(100vh - 56px);
    }

    .content main .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      grid-gap: 16px;
      flex-wrap: wrap;
    }
    .content main .header .left {
      display: flex;
    }

    .content main .header .left h1 {
      font-size: 36px;
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--dark);
    }
    .content main .header .left h2 {
      font-size: 26px;
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--dark);
      margin-top: 10px;
    }

    .content main .header .left .breadcrumb {
      display: flex;
      align-items: center;
      grid-gap: 16px;
    }

    .content main .header .left .breadcrumb li {
      color: var(--dark);
    }

    .content main .header .left .breadcrumb li a {
      color: var(--dark-grey);
      pointer-events: none;
    }

    .content main .header .left .breadcrumb li a.active {
      color: var(--primary);
      pointer-events: none;
    }

    .content main .header .report {
      height: 36px;
      padding: 0 16px;
      border-radius: 36px;
      background: var(--primary);
      color: var(--light);
      display: flex;
      align-items: center;
      justify-content: center;
      grid-gap: 10px;
      font-weight: 500;
    }

    .content main .insights {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      grid-gap: 24px;
      margin-top: 36px;
    }

    .content main .insights li {
      padding: 24px;
      background: var(--light);
      border-radius: 20px;
      display: flex;
      align-items: center;
      grid-gap: 24px;
      cursor: pointer;
    }

    .content main .insights li .bx {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      font-size: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .content main .insights li:nth-child(1) .bx {
      background: var(--light-primary);
      color: var(--primary);
    }

    .content main .insights li:nth-child(2) .bx {
      background: var(--light-warning);
      color: var(--warning);
    }

    .content main .insights li:nth-child(3) .bx {
      background: var(--light-success);
      color: var(--success);
    }

    .content main .insights li:nth-child(4) .bx {
      background: var(--light-danger);
      color: var(--danger);
    }

    .content main .insights li .info h3 {
      font-size: 24px;
      font-weight: 600;
      color: var(--dark);
    }

    .content main .insights li .info p {
      color: var(--dark);
    }

    .content main .bottom-data {
      display: flex;
      flex-wrap: wrap;
      grid-gap: 24px;
      margin-top: 24px;
      width: 100%;
      color: var(--dark);
    }

    .content main .bottom-data > div {
      border-radius: 20px;
      background: var(--light);
      padding: 24px;
      overflow-x: auto;
    }

    .content main .bottom-data .header {
      display: flex;
      align-items: center;
      grid-gap: 16px;
      margin-bottom: 24px;
    }

    .content main .bottom-data .header h3 {
      margin-right: auto;
      font-size: 24px;
      font-weight: 600;
    }

    .content main .bottom-data .header .bx {
      cursor: pointer;
    }

    .content main .bottom-data .orders {
      flex-grow: 1;
      flex-basis: 500px;
    }

    .content main .bottom-data .orders table {
      width: 100%;
      border-collapse: collapse;
    }

    .content main .bottom-data .orders table th {
      padding-bottom: 12px;
      font-size: 13px;
      text-align: left;
      border-bottom: 1px solid var(--grey);
    }

    .content main .bottom-data .orders table td {
      padding: 16px 0;
    }

    .content main .bottom-data .orders table tr td:first-child {
      display: flex;
      align-items: center;
      grid-gap: 12px;
      padding-left: 6px;
    }

    .content main .bottom-data .orders table td img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
    }

    .content main .bottom-data .orders table tbody tr {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .content main .bottom-data .orders table tbody tr:hover {
      background: var(--grey);
    }

    .content main .bottom-data .orders table tr td .status {
      font-size: 10px;
      padding: 6px 16px;
      color: var(--light);
      border-radius: 20px;
      font-weight: 700;
    }

    .content main .bottom-data .orders table tr td .status.completed {
      background: var(--success);
    }

    .content main .bottom-data .orders table tr td .status.process {
      background: var(--primary);
    }

    .content main .bottom-data .orders table tr td .status.pending {
      background: var(--warning);
    }

    .content main .bottom-data .reminders {
      flex-grow: 1;
      flex-basis: 300px;
    }

    .content main .bottom-data .reminders .task-list {
      width: 100%;
    }

    .content main .bottom-data .reminders .task-list li {
      width: 100%;
      margin-bottom: 16px;
      background: var(--grey);
      padding: 14px 10px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .content main .bottom-data .reminders .task-list li .task-title {
      display: flex;
      align-items: center;
    }

    .content main .bottom-data .reminders .task-list li .task-title p {
      margin-left: 6px;
    }

    .content main .bottom-data .reminders .task-list li .bx {
      cursor: pointer;
    }

    .content main .bottom-data .reminders .task-list li.completed {
      border-left: 10px solid var(--success);
    }

    .content main .bottom-data .reminders .task-list li.not-completed {
      border-left: 10px solid var(--danger);
    }

    .content main .bottom-data .reminders .task-list li:last-child {
      margin-bottom: 0;
    }

    @media screen and (max-width: 768px) {
      .sidebar {
        width: 200px;
      }

      .content {
        width: calc(100% - 60px);
        left: 200px;
      }
      .add {
        margin-left: 200px;
      }
    }

    @media screen and (max-width: 576px) {
      .content nav form .form-input input {
        display: none;
      }

      .content nav form .form-input button {
        width: auto;
        height: auto;
        background: transparent;
        color: var(--dark);
        border-radius: none;
      }

      .content nav form.show .form-input input {
        display: block;
        width: 100%;
      }

      .content nav form.show .form-input button {
        width: 36px;
        height: 100%;
        color: var(--light);
        background: var(--danger);
        border-radius: 0 36px 36px 0;
      }

      .content nav form.show ~ .notif,
      .content nav form.show ~ .profile {
        display: none;
      }

      .content main .insights {
        grid-template-columns: 1fr;
      }

      .content main .bottom-data .header {
        min-width: 340px;
      }

      .content main .bottom-data .orders table {
        min-width: 340px;
      }

      .content main .bottom-data .reminders .task-list {
        min-width: 340px;
      }
      .custom-button {
        margin-left: 10px;
      }
      .content main .header .left h1 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark);
      }
      .content main .header .left h2 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark);
      }
      .add-form {
        max-width: 300px;
      }
      input,
      select {
        max-width: 270px;
      }
      .btn {
        margin-left: 80px;
      }
    }
    .add-form {
      max-width: 550px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: var(--dark);
    }

    input,
    select {
      width: 500px;
      padding: 8px;
      margin-bottom: 15px;
      box-sizing: border-box;
      background: var(--grey);
      color: var(--dark);
    }

    button {
      background-color: rgb(51, 81, 230);
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 200px;
      margin-top: 20px;
    }

    button:hover {
      background-color: #1525a1;
    }
  </style>

  <body>
   <!-- Sidebar -->
   <div class="sidebar">
      <div class="logo">
        <img src="{{ asset('images/ku logo.png') }}" alt="" />
        <h4>Super Admin</h4>
      </div>
      <ul class="side-menu">
        <li >
          <a href="/superadmin"><i class="bx bxs-dashboard"></i>Dashboard</a>
        </li>
        <li>
          <a href="/superadmin/admin"><i class="bx bx-group"></i>Admin</a>
        </li>
        <li>
          <a href="/superadmin/school"
            ><i class="bx bx-building"></i>School</a
          >
        </li>
        <li>
          <a href="/superadmin/department"
            ><i class="bx bx-home-alt"></i>Department</a
          >
        </li>
        <li class="active">
          <a href="/superadmin/program"
            ><i class="bx bx-book-open"></i>Program</a
          >
        </li>
        <li>
          <a href="/superadmin/student"
            ><i class="bx bx-group"></i>Students</a
          >
        </li>
        <li>
          <a href="/superadmin/professor"
            ><i class="bx bx-group"></i>Professors</a
          >
        </li>
        <li>
          <a href="/superadmin/course"
            ><i class="bx bx-book"></i>Courses</a
          >
        </li>
        <li>
          <a href="/superadmin/notice"><i class="bx bx-news"></i>Notice</a>
        </li>
        <li >
          <a href="/superadmin/fee"> <i class="bx bx-dollar"></i> Fee</a>
        </li>

        <!-- <li><a href="#"><i class='bx bx-spreadsheet'></i>Documents</a></li> -->
      </ul>
      <ul class="side-menu">
        <li>
          <a href="{{url('/')}}/logout" class="logout">
            <i class="bx bx-log-out-circle"></i>
            Logout
          </a>
        </li>
      </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
      <!-- Navbar -->
      <nav>
        <i class="bx bx-menu"></i>
        <form action="#">
          <div class="form-input">
            <input type="search" placeholder="Search..." />
            <button class="search-btn" type="submit">
              <i class="bx bx-search"></i>
            </button>
          </div>
        </form>
        <input type="checkbox" id="theme-toggle" hidden />
        <label for="theme-toggle" class="theme-toggle"></label>
        <a href="#" class="notif">
          <i class="bx bx-bell"></i>
          <span class="count">8</span>
        </a>
        <a href="#" class="profile">
          <img src="{{ asset('images/ku logo.png') }}" alt="" />
        </a>
      </nav>

      <!-- End of Navbar -->

      <main>
        <div class="header">
          <div class="left">
            <a href="suAdmin-programpage.html"><h1>programs</h1></a>
            <h2>>add program</h2>
          </div>
        </div>
        <div>
          <form class="add-form" action="{{url('/')}}/add/program" method="post">
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

            <button class="btn" type="submit">Add Program</button>
          </form>
        </div>
      </main>
    </div>

    <script>
      const sideLinks = document.querySelectorAll(
        ".sidebar .side-menu li a:not(.logout)"
      );

      sideLinks.forEach((item) => {
        const li = item.parentElement;
        item.addEventListener("click", () => {
          sideLinks.forEach((i) => {
            i.parentElement.classList.remove("active");
          });
          li.classList.add("active");
        });
      });

      const menuBar = document.querySelector(".content nav .bx.bx-menu");
      const sideBar = document.querySelector(".sidebar");

      menuBar.addEventListener("click", () => {
        sideBar.classList.toggle("close");
      });

      const searchBtn = document.querySelector(
        ".content nav form .form-input button"
      );
      const searchBtnIcon = document.querySelector(
        ".content nav form .form-input button .bx"
      );
      const searchForm = document.querySelector(".content nav form");

      searchBtn.addEventListener("click", function (e) {
        if (window.innerWidth < 576) {
          e.preventDefault;
          searchForm.classList.toggle("show");
          if (searchForm.classList.contains("show")) {
            searchBtnIcon.classList.replace("bx-search", "bx-x");
          } else {
            searchBtnIcon.classList.replace("bx-x", "bx-search");
          }
        }
      });

      window.addEventListener("resize", () => {
        if (window.innerWidth < 768) {
          sideBar.classList.add("close");
        } else {
          sideBar.classList.remove("close");
        }
        if (window.innerWidth > 576) {
          searchBtnIcon.classList.replace("bx-x", "bx-search");
          searchForm.classList.remove("show");
        }
      });

      const toggler = document.getElementById("theme-toggle");

      toggler.addEventListener("change", function () {
        if (this.checked) {
          document.body.classList.add("dark");
        } else {
          document.body.classList.remove("dark");
        }
      });
    </script>
  </body>
</html>



<!-- <!DOCTYPE html>
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
</html> -->