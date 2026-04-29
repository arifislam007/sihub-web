<?php
// Home Page
?>

<section class="hero section">
    <div class="orb orb-a"></div>
    <div class="orb orb-b"></div>
    <div class="container hero-content reveal">
        <p class="eyebrow"><?php echo t('hero_slogan'); ?></p>
        <h1><?php echo t('hero_title'); ?></h1>
        <p class="hero-rotator" aria-live="polite">
            <span class="rotating-text" id="heroRotatingText"><?php echo t('hero_subtitle'); ?></span>
        </p>
        <p class="hero-text">
            <?php echo t('hero_description'); ?>
        </p>

        <div class="hero-actions">
            <a href="/?page=courses" class="btn btn-enroll"><?php echo t('hero_cta'); ?></a>
            <a href="/sombhabona_courses.pdf" class="btn btn-ghost" target="_blank"><i class="fa-solid fa-download"></i> Download Brochure</a>
            <a href="tel:<?php echo SITE_PHONE; ?>" class="btn btn-ghost"><i class="fa-solid fa-phone"></i> <?php echo SITE_PHONE; ?></a>
        </div>

        <div class="hero-icons" aria-hidden="true">
            <i class="fa-solid fa-language" title="<?php echo t('course_english_title'); ?>"></i>
            <i class="fa-brands fa-python"></i>
            <i class="fa-brands fa-docker"></i>
            <i class="fa-brands fa-linux"></i>
        </div>
    </div>
</section>

<section id="spoken-english" class="section section-alt">
    <div class="container reveal">
        <h2 class="section-title"><?php echo t('course_english_title'); ?></h2>
        <p class="section-subtitle"><?php echo t('course_english_subtitle'); ?></p>
        
        <div class="course-grid">
            <div class="course-column premium" style="grid-column: span 2;">
                <article class="course-card">
                    <h4><?php echo t('course_english_title'); ?></h4>
                    <div class="meta" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <span><i class="fa-solid fa-comments"></i> <?php echo t('english_highlight_1'); ?></span>
                        <span><i class="fa-solid fa-book"></i> <?php echo t('english_highlight_2'); ?></span>
                        <span><i class="fa-solid fa-microphone"></i> <?php echo t('english_highlight_3'); ?></span>
                        <span><i class="fa-solid fa-video"></i> <?php echo t('english_highlight_4'); ?></span>
                        <span><i class="fa-solid fa-user-group"></i> <?php echo t('english_highlight_5'); ?></span>
                        <span><i class="fa-solid fa-chalkboard-user"></i> <?php echo t('english_highlight_6'); ?></span>
                    </div>
                </article>
            </div>
        </div>

        <div class="table-container" style="overflow-x:auto; margin-top: 2rem;">
            <table style="width:100%; border-collapse: collapse; background: white; border-radius: 8px;">
                <thead style="background: var(--primary-color, #0056b3); color: white;">
                    <tr>
                        <th style="padding: 15px;"><?php echo t('level_beginner'); ?></th>
                        <th style="padding: 15px;"><?php echo t('course_duration'); ?></th>
                        <th style="padding: 15px;">Contact Us</th>
                        <th style="padding: 15px;"><?php echo t('form_course_label'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">1. <?php echo t('level_beginner'); ?></td>
                        <td style="padding: 15px;"><?php echo t('duration_3_months'); ?></td>
                        <td style="padding: 15px;"><?php echo t('schedule'); ?></td>
                        <td style="padding: 15px;"><?php echo t('admission_fee'); ?>: 2,000 / <?php echo t('monthly_fee'); ?>: 1,500 <?php echo t('tk'); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">2. <?php echo t('level_intermediate'); ?></td>
                        <td style="padding: 15px;"><?php echo t('duration_3_months'); ?></td>
                        <td style="padding: 15px;"><?php echo t('schedule'); ?></td>
                        <td style="padding: 15px;"><?php echo t('admission_fee'); ?>: 2,000 / <?php echo t('monthly_fee'); ?>: 1,500 <?php echo t('tk'); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">3. <?php echo t('level_advanced'); ?></td>
                        <td style="padding: 15px;"><?php echo t('duration_3_months'); ?></td>
                        <td style="padding: 15px;"><?php echo t('schedule'); ?></td>
                        <td style="padding: 15px;"><?php echo t('admission_fee'); ?>: 2,000 / <?php echo t('monthly_fee'); ?>: 1,500 <?php echo t('tk'); ?></td>
                    </tr>
                    <tr style="font-weight: bold; background: #f9f9f9;">
                        <td style="padding: 15px;">4. <?php echo t('level_full'); ?></td>
                        <td style="padding: 15px;"><?php echo t('duration_9_months'); ?></td>
                        <td style="padding: 15px;"><?php echo t('schedule'); ?></td>
                        <td style="padding: 15px;"><?php echo t('admission_fee'); ?>: 2,000 / <?php echo t('monthly_fee'); ?>: 1,500 <?php echo t('tk'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 3rem; padding: 2rem; background: #f8f9fa; border-radius: 8px;">
            <h3 style="margin-bottom: 1rem; color: #333;"><?php echo t('who_can_join_title'); ?></h3>
            <p style="color: #666; line-height: 1.8;">
                <?php echo t('who_can_join_description'); ?>
            </p>
        </div>
    </div>
</section>

<?php
// Include courses section on the home page
include_once(__DIR__ . '/courses.php');
?>

<section id="features" class="section section-alt">
    <div class="container reveal">
        <h2 class="section-title"><?php echo t('why_us_title'); ?></h2>
        <div class="feature-grid">
            <article class="feature-card">
                <i class="fa-solid fa-chalkboard-user"></i>
                <h3><?php echo t('feature_practical'); ?></h3>
                <p><?php echo t('feature_practical_desc'); ?></p>
            </article>
            <article class="feature-card">
                <i class="fa-solid fa-users"></i>
                <h3><?php echo t('feature_batches'); ?></h3>
                <p><?php echo t('feature_batches_desc'); ?></p>
            </article>
            <article class="feature-card">
                <i class="fa-solid fa-certificate"></i>
                <h3><?php echo t('feature_certificate'); ?></h3>
                <p><?php echo t('feature_certificate_desc'); ?></p>
            </article>
            <article class="feature-card">
                <i class="fa-solid fa-briefcase"></i>
                <h3><?php echo t('feature_career'); ?></h3>
                <p><?php echo t('feature_career_desc'); ?></p>
            </article>
        </div>
    </div>
</section>
