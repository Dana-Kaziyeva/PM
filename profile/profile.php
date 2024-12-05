<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ggg";

// Устанавливаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, нужно ли вывести изображение
if (isset($_GET['image']) && isset($_GET['id'])) {
    $student_id = intval($_GET['id']);
    $sql = "SELECT student_photo FROM student WHERE id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Content-Type: image/jpeg");
        echo $row['student_photo'];
    } else {
        http_response_code(404);
        echo "Image not found";
    }
    $conn->close();
    exit; // Завершаем выполнение, так как изображение уже выведено
}

// Получаем данные студента
if (isset($_GET['id'])) {
    $student_id = intval($_GET['id']);
    $sql = "SELECT * FROM student WHERE id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Student not found!");
    }
} else {
    die("No student ID provided!");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;400;700;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
<!--  TOP BAR-->
<div class="top-bar">
    <div class="left-section">
            <img src="logo_sdu_general.png" alt="Logo" class="logo-img">
    </div>
   <ul class="nav" style="width: 20%; padding-left: 4%;">
      <li class="nav-item dropdown" style="margin-left: 10%;">
          <a class="nav-link" href="#" id="dropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell-o icon"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown1">
              <li><a class="dropdown-item" href="#">Notification 1</a></li>
              <li><a class="dropdown-item" href="#">Notification 2</a></li>
              <li><a class="dropdown-item" href="#">Notification 3</a></li>
          </ul>
      </li>
      <li class="nav-item dropdown" style="margin-left: -14%;">
          <a class="nav-link" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-comment-o icon"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown2">
              <li><a class="dropdown-item" href="#">Message 1</a></li>
              <li><a class="dropdown-item" href="#">Message 2</a></li>
              <li><a class="dropdown-item" href="#">Message 3</a></li>
          </ul>
      </li>
      <li class="nav-item dropdown" style="margin-left: -14%;">
          <a class="nav-link" href="#" id="dropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user-o icon"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown3">
            <li><a class="dropdown-item" href="C:\Users\User\Downloads\PM-main (1)\PM-main\profile\profile.html">My Profile</a></li>
            <li><a class="dropdown-item" href=" C:\Users\User\Downloads\PM-main (1)\PM-main\dashboard\page.html">My Dashboard</a></li>
            <li><a class="dropdown-item" href="C:\Users\User\Downloads\PM-main (1)\PM-main\login page\login.html">Log Out</a></li>
          </ul>
      </li>
   </ul>
  </div>


<!--MAIN PART-->
<div class="profile-container">
    <h1>My Profile</h1>
    <div class="profile-card">
        <div class="profile-left">
        <div class="profile-photo-wrapper">
    <img src="?image=true&id=<?= $row['id'] ?>" alt="Student Photo">
</div>
            <div class="program-info">
                <p><?= $row['program_class'] ?></p>
                <p>ID number: <strong><?= $row['id'] ?></strong></p>
            </div>
        </div>
        <div class="profile-right">
            <table>
                <tr>
                    <td><strong>Full Name:</strong></td>
                    <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                </tr>
                <tr>
                    <td><strong>Native Name:</strong></td>
                    <td><?= $row['native_name'] ?></td>
                </tr>
                <tr>
                    <td><strong>Birth Date:</strong></td>
                    <td><?= $row['birth_day'] ?></td>
                </tr>
                <tr>
                    <td><strong>Advisor:</strong></td>
                    <td><?= $row['advisor'] ?></td>
                </tr>
                <tr>
                    <td><strong>Status:</strong></td>
                    <td><?= $row['status'] ?></td>
                </tr>
                <tr>
                    <td><strong>Balance:</strong></td>
                    <td><?= $row['balance'] ?> KZT</td>
                </tr>
                <tr>
                    <td><strong>ENT Exam Score:</strong></td>
                    <td><?= $row['ENT_score'] ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?= $row['email'] ?></td>
                </tr>
                <tr>
                    <td><strong>Last login date:</strong></td>
                    <td>6th December 2024</td>
                </tr>
                <tr>
                    <td><strong>Registration date:</strong></td>
                    <td><?= $row['registration_date'] ?></td>
                </tr>
            </table>
        </div>
    </div>

    <section class="operations">
        <h2>Information</h2>
        <div class="info-carousel">
            <div class="info-section">
                <a href="C:\Users\User\Downloads\PM-main (1)\PM-main\course-schedule\index.html">
                    <img src="schedule-icon.jpeg" alt="Schedule Icon" class="icon">
                </a>
                <a href="C:\Users\User\Downloads\PM-main (1)\PM-main\grades-list\index.html">
                    <img src="grades-icon.jpeg" alt="Grades Icon" class="icon">
                </a>
                <a href="C:\Users\User\Downloads\PM-main (1)\PM-main\Transcript\index.html">
                    <img src="transcript-icon.jpeg" alt="Transcripts Icon" class="icon">
                </a>
                <a href="C:\Users\User\Downloads\PM-main (1)\PM-main\accounting\accounting.html">
                    <img src="accounting-icon.jpeg" alt="Accounting Icon" class="icon">
                </a>
            </div>
            <button class="carousel-button prev" onclick="moveCarousel('info', -1)">&#10094;</button>
            <button class="carousel-button next" onclick="moveCarousel('info', 1)">&#10095;</button>
        </div>

        <h2>Academic Operations</h2>
        <div class="academic-carousel">
            <div class="academic-section">
                <a href="\C:\Users\User\Downloads\PM-main (1)\PM-main\course registration\registration.php">
                    <img src="registration-icon.jpeg" alt="Registration Icon" class="icon">
                </a>
                <a href="C:\Users\User\Downloads\PM-main (1)\PM-main\calendar\calendar.html">
                    <img src="calendar-icon.jpeg" alt="Calendar Icon" class="icon">
                </a>
                <a href="C:\Users\User\Downloads\PM-main (1)\PM-main\online-services\index.html">
                    <img src="onlineservices-icon.png" alt="Online Service Icon" class="icon">
                </a>
            </div>
            <button class="carousel-button prev" onclick="moveCarousel('academic', -1)">&#10094;</button>
            <button class="carousel-button next" onclick="moveCarousel('academic', 1)">&#10095;</button>
        </div>
    </section>
</div>





<!--      FOOTER -->
<div class="rectangle-14">
    <div class="line-15"></div>
    <div class="flex-container">
      <div class="flex-columns">
        <span class="titles">SDU UNIVERSITY</span>
        <a href="https://sdu.edu.kz/language/en/about-us-3/">
            <span class="nodes">About us</span>
        </a>
        <a href="https://sdukzlinks.tilda.ws/">
            <span class="nodes">Connect to us</span>
        </a>
      </div>

      <div class="flex-columns">
        <span class="titles">FACULTIES</span>
        <a href="https://sdu.edu.kz/language/en/business-school/">
            <span class="nodes">SDU BUSINESS SCHOOL</span>
        </a>
        <a href="https://sdu.edu.kz/language/en/engineering-and-natural-sciences/">
            <span class="nodes">FACULTY OF ENGINEERING <br />AND NATURAL SCIENCES</span>
        </a>
        <a href="https://sdu.edu.kz/language/en/education-and-humanities/">
            <span class="nodes">FACULTY OF EDUCATION <br />AND HUMANITIES</span>
        </a>
        <a href="https://sdu.edu.kz/language/en/law-social-science/">
            <span class="nodes">FACULTY OF LAW AND <br />SOCIAL SCIENCES</span>
        </a>
      </div>

      <div class="flex-columns">
        <span class="titles">RULES</span>
        <a href="https://sdu.edu.kz/language/en/rules/">
            <span class="nodes">Charter</span>
        </a>
        <a href="https://sdu.edu.kz/language/en/rules/">
            <span class="nodes">Safety rules</span>
        </a>
      </div>

      <div class="flex-columns">
        <span class="titles">ADDRESS</span>
        <span class="nodes">Almaty region, Karasai district.</span>
        <span class="nodes">040900, city of Kaskelen, st. <br />Abylai Khan 1/1</span>
      </div>
    </div>
    <div class="line-17"></div>
    <div class="flex-row-daab">
      <div>
        <i class="material-icons" >language</i>
        <span class="nodes">SDU UNIVERSITY</span>
      </div>
      <div>
         <i class="material-icons" >phone</i>
         <span class="nodes">Mobile: + 7 727 307 9565</span>
      </div>
      <div>
        <i class="material-icons" >mail_outline</i>
        <span class="nodes">cdl@sdu.edu.kz</span>
      </div>
    </div>
    <span class="copyright-reserved">Copyright © All right reserved SDU University</span>
  </div>
  
<script>
function moveCarousel(type, direction) {
const section = document.querySelector(`.${type}-section`);
const items = Array.from(section.querySelectorAll('a'));
const visibleItems = 3; 
const totalItems = items.length;
let startIndex = items.findIndex(item => item.style.display !== 'none');

if (direction === 1) {
    startIndex = Math.min(startIndex + visibleItems, totalItems - visibleItems);
} else {
    startIndex = Math.max(startIndex - visibleItems, 0);
}

items.forEach((item, index) => {
    if (index >= startIndex && index < startIndex + visibleItems) {
        item.style.display = 'flex';
    } else {
        item.style.display = 'none';
    }
});
}

function initializeCarousel(sectionClass, visibleItems) {
const items = document.querySelectorAll(`.${sectionClass} a`);
items.forEach((item, index) => {
    item.style.display = (index < visibleItems) ? 'flex' : 'none';
});
}

window.onload = function() {
initializeCarousel('info-section', 3);     
initializeCarousel('academic-section', 3); 
};

</script>

</body>
</html>
