
    <div class="container">
        <div class="row justify-content-lg-center justify-content-start">
            <div class="col-xl-3 col-lg-8">
                <div class="deal-box mt-10 text-center text-xl-start">
                    <h2 class="">Choose Your <b>Department</b></h2>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="deal-active owl-carousel mb-30">
                    <?php
                    // Fetch all departments
                    $sql = "SELECT * FROM department";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $departmentName = htmlspecialchars($row['department_name'], ENT_QUOTES, 'UTF-8');
                            $departmentId = urlencode($row['id']); // Ensure URL safety
                    ?>
                            <div class="single-item">
                                <div class="single-box mb-30 text-center p-3 shadow-sm rounded">
                                    <a href="courses.php?d=<?= $departmentName ?>" class="d-block text-decoration-none">
                                        <h4 class="sub-title mb-2 font-weight-bold" style="color: #FF723A;"><?= $departmentName ?></h4>
                                        <p class="text-muted">Explore all courses in <?= $departmentName ?></p>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-center">
                            <p class="text-danger">No departments found.</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
