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
    <title>Professor-to-do</title>
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
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      .to-do-list {
        background-color: #f6f6f9;
        padding: 2rem;
        border-radius: 1.8rem;
        box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18);
        width: 40rem;
      }

      h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #363949;
      }

      .task-input {
        display: flex;
        flex-direction: column;
        margin-bottom: 1rem;
      }

      input {
        padding: 0.8rem;
        margin-bottom: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.4rem;
        font-size: 1rem;
      }

      .datetime-input {
        display: flex;
        gap: 0.5rem;
      }

      label {
        font-size: 0.9rem;
        color: #677483;
      }

      button {
        padding: 0.8rem;
        background-color: #6c9bcf;
        color: #fff;
        border: none;
        border-radius: 0.4rem;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
      }

      button:hover {
        background-color: #1b9c85;
      }

      #taskList li {
        list-style: none;
        padding: 1rem;
        border-radius: 0.4rem;
        margin-bottom: 0.5rem;
        box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18);
        position: relative;
      }

      #taskList li::before {
        content: "\e909"; /* Unicode for the "inventory" icon */
        font-family: "Material Icons Sharp";
        color: #1b9c85; /* Change the color as per your preference */
        font-size: 1.2rem; /* Adjust the size as needed */
        margin-right: 0.5rem; /* Add some spacing to the right of the marker */
        position: absolute;
        left: -1.5rem; /* Adjust the position as needed */
        top: 50%;
        transform: translateY(-50%);
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

      .right-section .reminders {
        margin-top: 2rem;
      }

      .right-section .reminders .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.8rem;
      }

      .right-section .reminders .header span {
        padding: 10px;
        box-shadow: var(--box-shadow);
        background-color: var(--color-white);
        border-radius: 50%;
      }

      .right-section .reminders .notification {
        background-color: var(--color-white);
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.7rem;
        padding: 1.4rem var(--card-padding);
        border-radius: var(--border-radius-2);
        box-shadow: var(--box-shadow);
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .right-section .reminders .notification:hover {
        box-shadow: none;
      }

      .right-section .reminders .notification .content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0;
        width: 100%;
      }

      .right-section .reminders .notification .icon {
        padding: 0.6rem;
        color: var(--color-white);
        background-color: var(--color-success);
        border-radius: 20%;
        display: flex;
      }

      .right-section .reminders .notification.deactive .icon {
        background-color: var(--color-danger);
      }

      .right-section .reminders .add-reminder {
        background-color: var(--color-white);
        border: 2px dashed var(--color-primary);
        color: var(--color-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
      }

      .right-section .reminders .add-reminder:hover {
        background-color: var(--color-primary);
        color: white;
      }

      .right-section .reminders .add-reminder div {
        display: flex;
        align-items: center;
        gap: 0.6rem;
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
      }
    </style>
  </head>

  <body>
    <div class="container">
      <!-- Sidebar Section -->
      <aside>
        <div class="toggle">
          <div class="logo">
            <img src="kathmandu_university_logo_nepal .png" />
            <h2><span class="danger">Professor</span></h2>
          </div>
          <div class="close" id="close-btn">
            <span class="material-icons-sharp"> close </span>
          </div>
        </div>

        <div class="sidebar">
          <a href="prof-main.html">
            <span class="material-icons-sharp"> dashboard </span>
            <h3>Dashboard</h3>
          </a>
          <a href="prof-students.html">
            <span class="material-icons-sharp"> person_outline </span>
            <h3>Students</h3>
          </a>
          <a href="#">
            <span class="material-icons-sharp"> receipt_long </span>
            <h3>Grades</h3>
          </a>
          <a href="#">
            <span class="material-icons-sharp"> insights </span>
            <h3>Analytics</h3>
          </a>
          <a href="#">
            <span class="material-icons-sharp">menu_book</span>
            <h3>Courses</h3>
          </a>
          <a href="#">
            <span class="material-icons-sharp"> mail_outline </span>
            <h3>Messages</h3>
            <span class="message-count">18</span>
          </a>
          <a href="prof-to-do.html" class="active">
            <span class="material-icons-sharp"> inventory </span>
            <h3>To do List</h3>
          </a>

          <a href="#">
            <span class="material-icons-sharp"> settings </span>
            <h3>Settings</h3>
          </a>
          <a href="#">
            <span class="material-icons-sharp"> add </span>
            <h3>New Login</h3>
          </a>
          <a href="#">
            <span class="material-icons-sharp"> logout </span>
            <h3>Logout</h3>
          </a>
        </div>
      </aside>
      <!-- End of Sidebar Section -->

      <!-- Main Content -->

      <main>
        <div class="to-do-list">
          <h2>To-Do List</h2>

          <div class="task-input">
            <input type="text" id="taskInput" placeholder="Enter your task" />
            <div class="datetime-input">
              <label for="dateInput">Date:</label>
              <input type="date" id="dateInput" />

              <label for="timeInput">Time:</label>
              <input type="time" id="timeInput" />
            </div>
            <button onclick="addTask()">Add Task</button>
          </div>
        </div>
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
              <p>Hey, <b>Feng</b></p>
            </div>
            <div class="profile-photo">
              <img src="kathmandu_university_logo_nepal .png" />
            </div>
          </div>
        </div>
        <!-- End of Nav -->

        <div class="reminders">
          <div class="header">
            <h2>Reminders</h2>
            <span class="material-icons-sharp"> notifications_none </span>
          </div>
          <ul id="taskList">
            <!-- Tasks will be dynamically added here using JavaScript -->
          </ul>
        </div>
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
      function addTask() {
        const taskInput = document.getElementById("taskInput");
        const dateInput = document.getElementById("dateInput");
        const timeInput = document.getElementById("timeInput");
        const taskList = document.getElementById("taskList");

        // Check if the task input is not empty
        if (taskInput.value.trim() === "") {
          alert("Please enter a task.");
          return;
        }

        // Create a list item element
        const listItem = document.createElement("li");
        listItem.style.listStyle = "none";
        listItem.style.padding = "1rem";
        listItem.style.borderRadius = "0.4rem";
        listItem.style.marginBottom = "0.5rem";
        listItem.style.boxShadow = "0 2rem 3rem rgba(132, 139, 200, 0.18)";
        listItem.style.position = "relative";

        // Create and style the Material Icons "inventory" icon
        const marker = document.createElement("span");
        marker.classList.add("material-icons-sharp");
        marker.textContent = "inventory";
        marker.style.color = "#1b9c85"; // Change the color as per your preference
        marker.style.fontSize = "1.2rem"; // Adjust the size as needed
        marker.style.marginRight = "0.5rem"; // Add some spacing to the right of the marker
        marker.style.position = "absolute";
        marker.style.left = "-1.5rem"; // Adjust the position as needed
        marker.style.top = "50%";
        marker.style.transform = "translateY(-50%)";

        // Create and style the task content
        const taskContent = document.createElement("span");
        taskContent.textContent = `${taskInput.value} - Date: ${dateInput.value}, Time: ${timeInput.value}`;
        taskContent.style.fontSize = "1rem";

        // Append the marker and task content to the list item
        listItem.appendChild(marker);
        listItem.appendChild(taskContent);

        // Add the list item to the task list
        taskList.appendChild(listItem);

        // Clear the input fields
        taskInput.value = "";
        dateInput.value = "";
        timeInput.value = "";
      }
    </script>
  </body>
</html>