<?php
$currentLang = getCurrentLanguage();
$otherLang = $currentLang === 'en' ? 'bn' : 'en';
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo t('hero_title') . ' | ' . SITE_NAME; ?></title>
    <meta name="description" content="<?php echo t('hero_description'); ?>" />
    <meta name="keywords" content="IT training, Spoken English course, devops course, docker course, linux, digital marketing, graphic design, Mirpur IT center" />
    <meta property="og:title" content="<?php echo SITE_NAME; ?>" />
    <meta property="og:description" content="<?php echo t('hero_description'); ?>" />
    <meta property="og:type" content="website" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="/styles.css" />
</head>
<body>
    <a class="skip-link" href="#main-content"><?php echo t('nav_home'); ?></a>

    <header class="site-header" id="top">
      <nav class="navbar container" aria-label="Main navigation">
        <a class="logo" href="/">
          <span>Sombhabona</span> <?php echo t('nav_contact'); ?>
        </a>

        <button class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="site-menu">
          <span></span><span></span><span></span>
        </button>

        <ul class="nav-links" id="site-menu">
          <li><a href="/?page=courses"><?php echo t('nav_courses'); ?></a></li>
          <li><a href="/?page=about"><?php echo t('nav_why_us'); ?></a></li>
          <li><a href="/?page=contact">Contact Us</a></li>
          <li><a href="/?page=contact" class="btn btn-small btn-admission">Admission</a></li>
          <li class="language-switcher">
            <a href="/?lang=<?php echo $otherLang; ?><?php echo isset($_GET['page']) ? '&page=' . htmlspecialchars($_GET['page']) : ''; ?>" class="btn btn-small btn-language">
              <?php echo $currentLang === 'en' ? 'বাংলা' : 'English'; ?>
            </a>
          </li>
        </ul>
      </nav>
    </header>

    <main id="main-content">
