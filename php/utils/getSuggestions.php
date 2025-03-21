<?php
include 'db.php';

if (isset($_POST['searchIn'])) {
    $searchIn = '%' . mysqli_real_escape_string($con, $_POST['searchIn']) . '%';

    // Query to search in colleges
    $sqlColleges = "SELECT DISTINCT college_name, city_name, university_name, college_logo ,tag_id
                    FROM colleges 
                    WHERE college_name LIKE ? 
                    OR city_name LIKE ? 
                    OR university_name LIKE ? 
                    LIMIT 3";

    // Query to search in courses
    $sqlCourses = "SELECT DISTINCT id, course_name, short_form 
                   FROM courses 
                   WHERE course_name LIKE ? 
                   OR short_form LIKE ? 
                   LIMIT 3";

    // Prepare and execute the college query
    $stmtColleges = $con->prepare($sqlColleges);
    if ($stmtColleges) {
        $stmtColleges->bind_param("sss", $searchIn, $searchIn, $searchIn);
        $stmtColleges->execute();
        $resultColleges = $stmtColleges->get_result();

        if ($resultColleges->num_rows > 0) {
            echo "<h4>Colleges</h4>";
            while ($row = $resultColleges->fetch_assoc()) {
                echo "<div class='suggestion' onclick='selectSuggestion(\"" . htmlspecialchars($row["college_name"]) . "\")'>
                        <a href='college-details.php?u=" . urlencode($row["tag_id"]) . "'>
                            <img class='searchIMG' src='./assets/img/college/" . htmlspecialchars($row["college_logo"]) . "' alt='" . htmlspecialchars($row["college_name"]) . "'>
                            " . htmlspecialchars($row["college_name"]) . " - " . htmlspecialchars($row["city_name"]) . "
                        </a>
                    </div>";
            }
        }
        $stmtColleges->close();
    }

    // Prepare and execute the course query
    $stmtCourses = $con->prepare($sqlCourses);
    if ($stmtCourses) {
        $stmtCourses->bind_param("ss", $searchIn, $searchIn);
        $stmtCourses->execute();
        $resultCourses = $stmtCourses->get_result();

        if ($resultCourses->num_rows > 0) {
            echo "<h4>Courses</h4>";
            while ($row = $resultCourses->fetch_assoc()) {
                echo "<div class='suggestion' onclick='selectSuggestion(\"" . htmlspecialchars($row["course_name"]) . "\")'>
                        <a href='course-details.php?cid=" . urlencode($row["id"]) . "'>

                            " . htmlspecialchars($row["course_name"]) . " (" . htmlspecialchars($row["short_form"]) . ")
                        </a>
                    </div>";
            }
        }
        $stmtCourses->close();
    }

    // If no results are found
    if ($resultColleges->num_rows === 0 && $resultCourses->num_rows === 0) {
        echo "<div class='suggestion'>
                <a href='colleges.php'>No suggestions found.</a>
              </div>
              <div class='suggestion'>
                <a href='contact.php'>Want to request \"" . str_replace("%", "", htmlspecialchars($_POST['searchIn'])) . "\"?</a>
              </div>";
    }
}

$con->close();
