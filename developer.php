<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <?php
    $meta_title = "Meet the Developer - Ayush Solanki | CollegeNew.com";
    $meta_dec = "Learn about Ayush Solanki, the developer behind CollegeNew.com. Explore his expertise in web development, technologies used, and contributions to the platform.";
    $meta_keywords = "Ayush Solanki, web developer, CollegeNew developer, PHP expert, Next.js, UI/UX, full-stack development, website creator, software engineer";
    $meta_img = $domain . "assets/img/og-img.png";
    ?>

    <title><?= $meta_title ?></title>
    <meta name="title" content="<?= $meta_title ?>">
    <meta name="description" content=<?= $meta_dec ?>>
    <meta name="keywords" content=<?= $meta_keywords ?>>

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $domain ?>">
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_dec ?>">
    <meta property="og:image" content="<?= $meta_img ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $domain ?>">
    <meta property="twitter:title" content="<?= $meta_title ?>">
    <meta property="twitter:description" content=<?= $meta_dec ?>>
    <meta property="twitter:image" content="<?= $meta_img ?>">
    <link rel="canonical" href="<?= $domain ?>/developer.php">
    <style>
        /* Apple SF Pro Font */
        @import url('https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;600;700&display=swap');

        body {
            font-family: 'SF Pro Display', sans-serif;
        }

        /* iOS Glassmorphism Card */
        .ios-card {
            max-width: 420px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: all 0.3s ease-in-out;
        }

        .ios-card:hover {
            transform: scale(1.02);
        }

        /* Social Icons */
        .social-link {
            font-size: 22px;
            color: #555;
            transition: all 0.3s ease-in-out;
        }

        .social-link:hover {
            color: #007aff;
            /* Apple Blue */
            transform: scale(1.1);
        }

        /* iOS Style Button */
        .ios-btn {
            display: inline-block;
            background: linear-gradient(135deg, #007aff, #0051a8);
            color: white;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .ios-btn:hover {
            background: linear-gradient(135deg, #0051a8, #003e80);
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>

<body>


    <?php include 'php/pages/header.php' ?>
    <main>



        <!-- iOS Style Developer Card -->
        <div class="container d-flex justify-content-center align-items-center vh-100" style="background-color:  #f5f5f7;">
            <div class="ios-card text-center p-4">
                <img src="https://avatars.githubusercontent.com/u/103575160?s=400&u=b9661fd0f5d2c6d8be185df91855a54157bff325&v=4"
                    alt="Ayush Solanki"
                    class="rounded-circle mx-auto mb-3" width="120">
                <h3 class="fw-bold">Ayush Solanki</h3>

                <p class="text-muted mt-3">Full Stack Developer | PHP | MERN Stack | Next.js</p>
                <br>

                <!-- Social Media Links -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://github.com/ayushsolanki29" class="social-link"><i class="fab fa-github"></i></a>
                    <a href="https://instagram.com/ayushsolanki.exe" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="mailto:ayushsolanki2901@gmail.com" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>

                <a href="https://ayushsolanki.site" class="btn ios-btn mt-4">Visit My Website</a>
            </div>
        </div>
    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>