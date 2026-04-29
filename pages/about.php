<?php
// About Page
?>

<section id="about" class="section">
    <div class="container reveal">
        <h2 class="section-title"><?php echo t('why_us_title'); ?></h2>
        
        <div style="max-width: 900px; margin: 0 auto;">
            <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem; color: #555;">
                <?php echo SITE_NAME; ?> <?php echo t('contact_description'); ?>
            </p>

            <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
                <h3 style="color: #333; margin-bottom: 1rem;"><?php echo t('form_title'); ?></h3>
                <p style="color: #666; line-height: 1.8;">
                    Located at <?php echo t('contact_location'); ?>, we provide comprehensive training in Spoken English, 
                    Digital Marketing, Graphic Design, and IT courses with a focus on practical skills and career development.
                </p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 3rem;">
            <div class="info-card">
                <i class="fa-solid fa-users" style="font-size: 2.5rem; color: #0056b3; margin-bottom: 1rem;"></i>
                <h4><?php echo t('feature_batches'); ?></h4>
                <p><?php echo t('feature_batches_desc'); ?></p>
            </div>

            <div class="info-card">
                <i class="fa-solid fa-chalkboard-user" style="font-size: 2.5rem; color: #28a745; margin-bottom: 1rem;"></i>
                <h4><?php echo t('feature_practical'); ?></h4>
                <p><?php echo t('feature_practical_desc'); ?></p>
            </div>

            <div class="info-card">
                <i class="fa-solid fa-briefcase" style="font-size: 2.5rem; color: #ffc107; margin-bottom: 1rem;"></i>
                <h4><?php echo t('feature_career'); ?></h4>
                <p><?php echo t('feature_career_desc'); ?></p>
            </div>

            <div class="info-card">
                <i class="fa-solid fa-certificate" style="font-size: 2.5rem; color: #dc3545; margin-bottom: 1rem;"></i>
                <h4><?php echo t('feature_certificate'); ?></h4>
                <p><?php echo t('feature_certificate_desc'); ?></p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="/?page=contact" class="btn btn-enroll"><?php echo t('hero_cta'); ?></a>
        </div>
    </div>
</section>

<style>
.info-card {
    padding: 1.5rem;
    background: white;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
}

.info-card h4 {
    margin: 1rem 0 0.5rem 0;
    font-size: 1.1rem;
    color: #333;
}

.info-card p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
}
</style>
