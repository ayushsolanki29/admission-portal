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
    $meta_title = "Privacy Policy - How We Protect Your Data | CollegeNew.com";
    $meta_dec = "Read the Privacy Policy of CollegeNew.com to understand how we collect, use, and protect your personal data. Learn about your rights and data security measures.";
    $meta_keywords = "Privacy Policy, data protection, CollegeNew privacy, personal information, user rights, data security, online privacy, CollegeNew.com";
    $meta_img = $domain . "/assets/img/og-image.png";
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
    <link rel="canonical" href="<?= $domain ?>/policy.php">
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>


        <div class="container">
            <h1 class="main-title text-center mb-40" style="font-size: 2.5rem; font-weight: bold; margin-bottom: 30px;">Privacy Policy</h1>
            <p style="font-size: 1.2rem; line-height: 1.6;">Welcome to CollegeNew.com. Your privacy is important to us. This Privacy Policy outlines how we collect, use, and protect your information.</p>

            <h3 style="font-size: 1.8rem; margin-top: 30px;">1. Information We Collect</h3>
            <p style="font-size: 1.2rem; line-height: 1.6;">We collect personal information, including your name, phone number, and email, to process your requests and provide a seamless admission experience.</p>

            <h3 style="font-size: 1.8rem; margin-top: 30px;">2. How We Use Your Information</h3>
            <ul style="font-size: 1.2rem; line-height: 1.6; padding-left: 20px;">
                <li>To assist with college admissions and course recommendations.</li>
                <li>To communicate with you regarding your inquiries and application status.</li>
                <li>To improve our services and provide a better user experience.</li>
            </ul>

            <h3 style="font-size: 1.8rem; margin-top: 30px;">3. Data Security</h3>
            <p style="font-size: 1.2rem; line-height: 1.6;">We implement industry-standard security measures to protect your personal data. Your information is never shared with third parties without your consent.</p>

            <h3 style="font-size: 1.8rem; margin-top: 30px;">4. Your Rights</h3>
            <p style="font-size: 1.2rem; line-height: 1.6;">You have the right to request access, correction, or deletion of your personal data. Contact us at <a href="mailto:contact@collegenew.com" class="theme-color">contact@collegenew.com</a> for any privacy concerns.</p>

            <h3 style="font-size: 1.8rem; margin-top: 30px;">5. Changes to This Policy</h3>
            <p style="font-size: 1.2rem; line-height: 1.6;">We may update our Privacy Policy from time to time. Any changes will be posted on this page.</p>

            <h3 style="font-size: 1.8rem; margin-top: 30px;">6. Contact Us</h3>
            <p style="font-size: 1.2rem; line-height: 1.6;">If you have any questions about this Privacy Policy, please reach out to us at <a href="mailto:contact@collegenew.com" class="theme-color">contact@collegenew.com</a>.</p>



            <div class="text-center mt-40">
                <a href="contact.php" class="theme-color" style="font-size: 1.2rem;">Visit our Contact Page</a>
            </div>
        </div>
        <div class="text-center mt-40" style="margin-top: 40px;">
            <?php include 'php/pages/social-icons.php'; ?>
        </div>



    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>