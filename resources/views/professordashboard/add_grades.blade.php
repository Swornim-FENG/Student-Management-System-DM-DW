<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Professor-students</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

      :root {
        --color-primary: #6c9bcf;
        --color-danger: #ff0060;
        --color-success: #1b9c85;
        --color-warning: #f7d060;
        --color-white: #fff;
        --color-info-dark: #7d8da1;
        --color-dark: #363949;
        --color-light: rgba(132, 139, 200, 0.18);
        --color-dark-variant: #677483;
        --color-background: #f6f6f9;

        --card-border-radius: 2rem;
        --border-radius-1: 0.4rem;
        --border-radius-2: 1.2rem;

        --card-padding: 1.8rem;
        --padding-1: 1.2rem;

        --box-shadow: 0 2rem 3rem var(--color-light);
      }

      .dark-mode-variables {
        --color-background: #181a1e;
        --color-white: #202528;
        --color-dark: #edeffd;
        --color-dark-variant: #a3bdcc;
        --color-light: rgba(0, 0, 0, 0.4);
        --box-shadow: 0 2rem 3rem var(--color-light);
      }

      * {
        margin: 0;
        padding: 0;
        outline: 0;
        appearance: 0;
        border: 0;
        text-decoration: none;
        box-sizing: border-box;
      }

      html {
        font-size: 14px;
      }

      body {
        width: 100vw;
        height: 100vh;
        font-family: "Poppins", sans-serif;
        font-size: 0.88rem;
        user-select: none;
        overflow-x: hidden;
        color: var(--color-dark);
        background-color: var(--color-background);
      }

      a {
        color: var(--color-dark);
      }

      img {
        display: block;
        width: 100%;
        object-fit: cover;
      }

      h1 {
        font-weight: 800;
        font-size: 1.8rem;
      }

      h2 {
        font-weight: 600;
        font-size: 1.4rem;
      }

      h3 {
        font-weight: 500;
        font-size: 0.87rem;
      }

      small {
        font-size: 0.76rem;
      }

      p {
        color: var(--color-dark-variant);
      }

      b {
        color: var(--color-dark);
      }

      .text-muted {
        color: var(--color-info-dark);
      }

      .primary {
        color: var(--color-primary);
      }

      .danger {
        color: var(--color-danger);
      }

      .success {
        color: var(--color-success);
      }

      .warning {
        color: var(--color-warning);
      }

      .container {
        display: grid;
        width: 96%;
        margin: 0 auto;
        gap: 1.8rem;
        grid-template-columns: 12rem auto 23rem;
      }

      aside {
        height: 100vh;
      }

      aside .toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1.4rem;
      }

      aside .toggle .logo {
        display: flex;
        gap: 0.5rem;
      }

      aside .toggle .logo img {
        width: 2rem;
        height: 2rem;
      }

      aside .toggle .close {
        padding-right: 1rem;
        display: none;
      }

      aside .sidebar {
        display: flex;
        flex-direction: column;
        background-color: var(--color-white);
        box-shadow: var(--box-shadow);
        border-radius: 15px;
        height: 88vh;
        position: relative;
        top: 1.5rem;
        transition: all 0.3s ease;
      }

      aside .sidebar:hover {
        box-shadow: none;
      }

      aside .sidebar a {
        display: flex;
        align-items: center;
        color: var(--color-info-dark);
        height: 3.7rem;
        gap: 1rem;
        position: relative;
        margin-left: 2rem;
        transition: all 0.3s ease;
      }

      aside .sidebar a span {
        font-size: 1.6rem;
        transition: all 0.3s ease;
      }

      aside .sidebar a:last-child {
        position: absolute;
        bottom: 2rem;
        width: 100%;
      }

      aside .sidebar a.active {
        width: 100%;
        color: var(--color-primary);
        background-color: var(--color-light);
        margin-left: 0;
      }

      aside .sidebar a.active::before {
        content: "";
        width: 6px;
        height: 18px;
        background-color: var(--color-primary);
      }

      aside .sidebar a.active span {
        color: var(--color-primary);
        margin-left: calc(1rem - 3px);
      }

      aside .sidebar a:hover {
        color: var(--color-primary);
      }

      aside .sidebar a:hover span {
        margin-left: 0.6rem;
      }

      aside .sidebar .message-count {
        background-color: var(--color-danger);
        padding: 2px 6px;
        color: var(--color-white);
        font-size: 11px;
        border-radius: var(--border-radius-1);
      }

      main {
        margin-top: 1.4rem;
      }

      main .analyse {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.6rem;
      }

      main .analyse > div {
        background-color: var(--color-white);
        padding: var(--card-padding);
        border-radius: var(--card-border-radius);
        margin-top: 1rem;
        box-shadow: var(--box-shadow);
        cursor: pointer;
        transition: all 0.3s ease;
      }

      main .analyse > div:hover {
        box-shadow: none;
      }

      main .analyse > div .status {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      main .analyse h3 {
        margin-left: 0.6rem;
        font-size: 1rem;
      }

      main .analyse .progresss {
        position: relative;
        width: 92px;
        height: 92px;
        border-radius: 50%;
      }

      main .analyse svg {
        width: 7rem;
        height: 7rem;
      }

      main .analyse svg circle {
        fill: none;
        stroke-width: 10;
        stroke-linecap: round;
        transform: translate(5px, 5px);
      }

      main .analyse .sales svg circle {
        stroke: var(--color-success);
        stroke-dashoffset: -30;
        stroke-dasharray: 200;
      }

      main .analyse .visits svg circle {
        stroke: var(--color-danger);
        stroke-dashoffset: -30;
        stroke-dasharray: 200;
      }

      main .analyse .searches svg circle {
        stroke: var(--color-primary);
        stroke-dashoffset: -30;
        stroke-dasharray: 200;
      }

      main .analyse .progresss .percentage {
        position: absolute;
        top: -3px;
        left: -1px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
      }

      main .new-users {
        margin-top: 1.3rem;
      }

      main .new-users .user-list {
        background-color: var(--color-white);
        padding: var(--card-padding);
        border-radius: var(--card-border-radius);
        margin-top: 1rem;
        box-shadow: var(--box-shadow);
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 1.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      main .new-users .user-list:hover {
        box-shadow: none;
      }

      main .new-users .user-list .user {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      main .new-users .user-list .user img {
        width: 5rem;
        height: 5rem;
        margin-bottom: 0.4rem;
        border-radius: 50%;
      }

      main .recent-orders {
        margin-top: 1.3rem;
      }

      main .recent-orders h2 {
        margin-bottom: 0.8rem;
      }

      main .recent-orders table {
        background-color: var(--color-white);
        width: 100%;
        padding: var(--card-padding);
        text-align: center;
        box-shadow: var(--box-shadow);
        border-radius: var(--card-border-radius);
        transition: all 0.3s ease;
      }

      main .recent-orders table:hover {
        box-shadow: none;
      }

      main table tbody td {
        height: 2.8rem;
        border-bottom: 1px solid var(--color-light);
        color: var(--color-dark-variant);
      }

      main table tbody tr:last-child td {
        border: none;
      }

      main .recent-orders a {
        text-align: center;
        display: block;
        margin: 1rem auto;
        color: var(--color-primary);
      }

      .right-section {
        margin-top: 1.4rem;
      }

      .right-section .nav {
        display: flex;
        justify-content: end;
        gap: 2rem;
      }

      .right-section .nav button {
        display: none;
      }

      .right-section .dark-mode {
        background-color: var(--color-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 1.6rem;
        width: 4.2rem;
        cursor: pointer;
        border-radius: var(--border-radius-1);
      }

      .right-section .dark-mode span {
        font-size: 1.2rem;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .right-section .dark-mode span.active {
        background-color: var(--color-primary);
        color: white;
        border-radius: var(--border-radius-1);
      }

      .right-section .nav .profile {
        display: flex;
        gap: 2rem;
        text-align: right;
      }

      .right-section .nav .profile .profile-photo {
        width: 2.8rem;
        height: 2.8rem;
        border-radius: 50%;
        overflow: hidden;
      }

      .right-section .user-profile {
        display: flex;
        justify-content: center;
        text-align: center;
        margin-top: 1rem;
        background-color: var(--color-white);
        padding: var(--card-padding);
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow);
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .right-section .user-profile:hover {
        box-shadow: none;
      }

      .right-section .user-profile img {
        width: 11rem;
        height: auto;
        margin-bottom: 0.8rem;
        border-radius: 50%;
      }

      .right-section .user-profile h2 {
        margin-bottom: 0.2rem;
      }

      .container main .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        grid-gap: 16px;
        flex-wrap: wrap;
      }

      .container main .header .left {
        display: flex;
      }

      .container main .header .left h1 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark);
      }
      .container main .header .left h2 {
        font-size: 26px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark);
        margin-top: 10px;
      }
      .table-container {
        max-width: 800px;
        margin: 0 auto;
      }

      h2 {
        text-align: center;
        color: #333;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th,
      td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
      #GradeForm {
        max-width: 350px;
        margin-top: 80px;
        margin-left: 500px;
        padding: 20px;
        border: 2px solid rgb(235, 225, 225);
        border-radius: 5px;
        color: var(--dark);
        display: flex;
        flex-direction: column;
      }
      label {
        display: block;
        margin-bottom: 8px;
        background: var(--grey);
        color: var(--dark);
        margin-left: 5px;
      }
      input {
        width: 300px;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        color: var(--dark);
      }
      select {
        width: 300px;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
        color: var(--dark);
      }
      .s-button {
        background-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 0px;
        height: 40px;
        max-width: 300px;
      }
      .s-button:hover {
        background-color: #2980b9;
      }

      @media screen and (max-width: 1200px) {
        .container {
          width: 95%;
          grid-template-columns: 7rem auto 23rem;
        }

        aside .logo h2 {
          display: none;
        }

        aside .sidebar h3 {
          display: none;
        }

        aside .sidebar a {
          width: 5.6rem;
        }

        aside .sidebar a:last-child {
          position: relative;
          margin-top: 1.8rem;
        }

        main .analyse {
          grid-template-columns: 1fr;
          gap: 0;
        }

        main .new-users .user-list .user {
          flex-basis: 40%;
        }

        main .recent-orders {
          width: 94%;
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          margin: 2rem 0 0 0.8rem;
        }

        main .recent-orders table {
          width: 83vw;
        }

        main table thead tr th:last-child,
        main table thead tr th:first-child {
          display: none;
        }

        main table tbody tr td:last-child,
        main table tbody tr td:first-child {
          display: none;
        }
      }

      @media screen and (max-width: 768px) {
        .container {
          width: 100%;
          grid-template-columns: 1fr;
          padding: 0 var(--padding-1);
        }

        aside {
          position: fixed;
          background-color: var(--color-white);
          width: 15rem;
          z-index: 3;
          box-shadow: 1rem 3rem 4rem var(--color-light);
          height: 100vh;
          left: -100%;
          display: none;
          animation: showMenu 0.4s ease forwards;
        }

        @keyframes showMenu {
          to {
            left: 0;
          }
        }

        aside .logo {
          margin-left: 1rem;
        }

        aside .logo h2 {
          display: inline;
        }

        aside .sidebar h3 {
          display: inline;
        }

        aside .sidebar a {
          width: 100%;
          height: 3.4rem;
        }

        aside .sidebar a:last-child {
          position: absolute;
          bottom: 5rem;
        }

        aside .toggle .close {
          display: inline-block;
          cursor: pointer;
        }

        main {
          margin-top: 8rem;
          padding: 0 1rem;
        }

        main .new-users .user-list .user {
          flex-basis: 35%;
        }

        main .recent-orders {
          position: relative;
          margin: 3rem 0 0 0;
          width: 100%;
        }

        main .recent-orders table {
          width: 100%;
          margin: 0;
        }

        .right-section {
          width: 94%;
          margin: 0 auto 4rem;
        }

        .right-section .nav {
          position: fixed;
          top: 0;
          left: 0;
          align-items: center;
          background-color: var(--color-white);
          padding: 0 var(--padding-1);
          height: 4.6rem;
          width: 100%;
          z-index: 2;
          box-shadow: 0 1rem 1rem var(--color-light);
          margin: 0;
        }

        .right-section .nav .dark-mode {
          width: 4.4rem;
          position: absolute;
          left: 66%;
        }

        .right-section .profile .info {
          display: none;
        }

        .right-section .nav button {
          display: inline-block;
          background-color: transparent;
          cursor: pointer;
          color: var(--color-dark);
          position: absolute;
          left: 1rem;
        }

        .right-section .nav button span {
          font-size: 2rem;
        }
        #GradeForm {
          margin-left: 15px;
        }
      }
    </style>
  </head>

  <body>
    <div class="container">
      <!-- Sidebar Section -->
      <aside>
        <div class="toggle">
          <div class="logo">
            <img src="{{ asset('images/ku logo.png') }}" />
            <h2><span class="danger">Professor</span></h2>
          </div>
          <div class="close" id="close-btn">
            <span class="material-icons-sharp"> close </span>
          </div>
        </div>

        <div class="sidebar">
                <a href="/professor" >
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="/professor/students"  >
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Students</h3>
                </a>
                <a href="/professor/grades" class="active">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Grades</h3>
                </a>
                <a href="/professor/analytics" >
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="/professor/courses">
                <span class='material-icons-sharp'>menu_book</span>
                    <h3>Courses</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Messages</h3>
                    <span class="message-count">18</span>
                </a>
                <a href="/professor/todolist">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>To do List</h3>
                </a>
                
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        add
                    </span>
                    <h3>New Login</h3>
                </a>
                <a href="{{url('/')}}/logout">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
      <!-- End of Sidebar Section -->

      <!-- Main Content -->
      <main>
        <div class="header">
          <div class="left">
            <a href="/professor/grades"><h1>Grades</h1></a>
            
          </div>
        </div>
        <form id="GradeForm">
          <label>Student Name</label>
          <select>
            <option>John</option>
            <option>Felix</option>
            <option>Anthony</option>
            <option>Cena</option>
          </select>
          <label for="first">First Internal</label>
          <input type="text" name="FirstInternal" id="first" required />
          <label for="second">Second Internal</label>
          <input type="text" name="SecondInternal" id="second" required />
          <label for="pre">Presentation</label>
          <input type="text" name="Presentation" id="pre" required />
          <label for="assign">Assignments</label>
          <input type="text" name="Assignments" id="assign" required />
          <label for="mcq">MCQ</label>
          <input type="text" name="MCQ" id="mcq" required />
          <label for="extra">Extra Credit</label>
          <input type="text" name="ExtraCredits" id="extra" required />
          <button class="s-button">Submit</button>
        </form>
      </main>
      <!-- End of Main Content -->

      <!-- Right Section -->
      <div class="right-section">
        <div class="nav">
          <button id="menu-btn">
            <span class="material-icons-sharp"> menu </span>
          </button>
          <div class="dark-mode">
            <span class="material-icons-sharp active"> light_mode </span>
            <span class="material-icons-sharp"> dark_mode </span>
          </div>

          <div class="profile">
            <div class="info">
              <p>Hey, <b>{{$professor->Firstname}}</b></p>
            </div>
            <div class="profile-photo">
              <img src="{{ asset('images/ku logo.png') }}" />
            </div>
          </div>
        </div>
        <!-- End of Nav -->
      </div>
    </div>

    <script>
      const sideMenu = document.querySelector("aside");
      const menuBtn = document.getElementById("menu-btn");
      const closeBtn = document.getElementById("close-btn");

      const darkMode = document.querySelector(".dark-mode");

      menuBtn.addEventListener("click", () => {
        sideMenu.style.display = "block";
      });

      closeBtn.addEventListener("click", () => {
        sideMenu.style.display = "none";
      });

      darkMode.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode-variables");
        darkMode.querySelector("span:nth-child(1)").classList.toggle("active");
        darkMode.querySelector("span:nth-child(2)").classList.toggle("active");
      });

      Orders.forEach((order) => {
        const tr = document.createElement("tr");
        const trContent = `
        <td>${order.productName}</td>
        <td>${order.productNumber}</td>
        <td>${order.paymentStatus}</td>
        <td class="${
          order.status === "Declined"
            ? "danger"
            : order.status === "Pending"
            ? "warning"
            : "primary"
        }">${order.status}</td>
        <td class="primary">Details</td>
    `;
        tr.innerHTML = trContent;
        document.querySelector("table tbody").appendChild(tr);
      });
      const Orders = [
        {
          productName: "JavaScript Tutorial",
          productNumber: "85743",
          paymentStatus: "Due",
          status: "Pending",
        },
        {
          productName: "CSS Full Course",
          productNumber: "97245",
          paymentStatus: "Refunded",
          status: "Declined",
        },
        {
          productName: "Flex-Box Tutorial",
          productNumber: "36452",
          paymentStatus: "Paid",
          status: "Active",
        },
      ];
      function openStudentPopup(name, department, remarks, pastReports) {
        const popupTitle = document.getElementById("popupTitle");
        const popupContent = document.getElementById("popupContent");
        const popupRemarks = document.getElementById("popupRemarks");
        const popupReports = document.getElementById("popupReports");

        // Set popup title and content
        popupTitle.textContent = name;
        popupContent.textContent = `Department: ${department}`;

        // Set remarks and past reports
        popupRemarks.textContent = remarks || "N/A";
        popupReports.textContent = pastReports || "N/A";

        // Display the popup
        document.getElementById("studentPopup").style.display = "block";
      }

      function closeStudentPopup() {
        document.getElementById("studentPopup").style.display = "none";
      }
    </script>
  </body>
</html>
