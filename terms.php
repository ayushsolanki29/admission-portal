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
    <link rel="canonical" href="<?= $domain ?>/terms.php">
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>
    <div class="container">
        <h1 class="main-title text-center mb-40" style="font-size: 2.5rem; font-weight: bold; margin-bottom: 30px;">Terms and Conditions</h1>
        <p style="font-size: 1.2rem; line-height: 1.6;">Welcome to CollegeNew.com. By accessing our website, you agree to comply with and be bound by the following terms and conditions.</p>
        
        <h3 style="font-size: 1.8rem; margin-top: 30px;">1. Use of the Website</h3>
        <p style="font-size: 1.2rem; line-height: 1.6;">You agree to use CollegeNew.com only for lawful purposes and in a manner that does not infringe the rights of others.</p>
        
        <h3 style="font-size: 1.8rem; margin-top: 30px;">2. Intellectual Property</h3>
        <p style="font-size: 1.2rem; line-height: 1.6;">All content on CollegeNew.com, including text, graphics, and logos, is the property of CollegeNew and is protected by copyright laws.</p>
        
        <h3 style="font-size: 1.8rem; margin-top: 30px;">3. User Responsibilities</h3>
        <p style="font-size: 1.2rem; line-height: 1.6;">Users must provide accurate information and avoid any fraudulent activities when using our services.</p>
        
        <h3 style="font-size: 1.8rem; margin-top: 30px;">4. Limitation of Liability</h3>
        <p style="font-size: 1.2rem; line-height: 1.6;">CollegeNew is not responsible for any direct or indirect damages arising from the use of our website.</p>
        
        <h3 style="font-size: 1.8rem; margin-top: 30px;">5. Changes to Terms</h3>
        <p style="font-size: 1.2rem; line-height: 1.6;">We reserve the right to modify these terms at any time. Updates will be posted on this page.</p>
        
        <h3 style="font-size: 1.8rem; margin-top: 30px;">6. Contact Us</h3>
        <p style="font-size: 1.2rem; line-height: 1.6;">For any inquiries about these Terms and Conditions, contact us at <a href="mailto:contact@collegenew.com" class="theme-color">contact@collegenew.com</a>.</p>
        
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