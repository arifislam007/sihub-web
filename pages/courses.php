<?php
// Courses Page
// Fetch courses from database
try {
    $stmt = $pdo->query("SELECT * FROM courses ORDER BY id ASC");
    $courses = $stmt->fetchAll();
} catch (Exception $e) {
    $courses = [];
}
?>

<section id="courses" class="section">
    <div class="container reveal">
        <h2 class="section-title"><?php echo t('section_it_courses'); ?></h2>
        <p class="section-subtitle"><?php echo t('it_courses_subtitle'); ?></p>

        <div class="course-grid">
            <div class="course-column">
                <h3>Foundation Courses</h3>

                <article class="course-card" style="border-left: 5px solid #6f42c1;">
                    <i class="fa-solid fa-palette"></i>
                    <h4>Graphic Design & Freelancing</h4>
                    <p>Master Photoshop and design workflows to start freelancing confidently.</p>
                    <div class="meta"><span>2 Months</span><span>Online/Offline</span></div>
                </article>

                <article class="course-card" style="border-left: 5px solid #007bff;">
                    <i class="fa-solid fa-bullhorn"></i>
                    <h4>Digital Marketing & Freelancing</h4>
                    <p>Learn SEO, ads, and social media strategy for business growth and freelancing.</p>
                    <div class="meta"><span>3 Months</span><span>Online/Offline</span></div>
                </article>

                <article class="course-card" style="border-left: 5px solid #28a745;">
                    <i class="fa-solid fa-tools"></i>
                    <h4>IT Support</h4>
                    <p>Develop troubleshooting and system support skills for modern workplaces.</p>
                    <div class="meta"><span>1.5 Months</span><span>Offline</span></div>
                </article>

                <article class="course-card" style="border-left: 5px solid #17a2b8;">
                    <i class="fa-solid fa-keyboard"></i>
                    <h4>Basic Computer Operation</h4>
                    <p>Build confidence with core computer, internet, and office productivity tasks.</p>
                    <div class="meta"><span>1 Month</span><span>Online/Offline</span></div>
                </article>
            </div>

            <div class="course-column premium">
                <h3>Advanced & Certification</h3>

                <article class="course-card">
                    <i class="fa-brands fa-linux"></i>
                    <h4>Linux Operation for Beginner</h4>
                    <p>Learn Linux fundamentals, shell commands, and server basics through labs.</p>
                    <div class="meta"><span>2 Months</span><span>Online/Offline</span></div>
                </article>

                <article class="course-card">
                    <i class="fa-solid fa-certificate"></i>
                    <h4>RHCSA & RHCE Exam Preparation</h4>
                    <p>Structured Red Hat certification prep with guided practice and mock tests.</p>
                    <div class="meta"><span>3 Months</span><span>Offline</span></div>
                </article>

                <article class="course-card">
                    <i class="fa-brands fa-docker"></i>
                    <h4>DevOps & Docker</h4>
                    <p>Ship faster with CI/CD basics, containers, and practical DevOps workflows.</p>
                    <div class="meta"><span>3 Months</span><span>Online/Offline</span></div>
                </article>

                <article class="course-card">
                    <i class="fa-brands fa-aws"></i>
                    <h4>AWS Cloud for Beginner</h4>
                    <p>Get hands-on with EC2, networking, security, and cloud deployment basics.</p>
                    <div class="meta"><span>2 Months</span><span>Online/Offline</span></div>
                </article>
            </div>

        </div>

        <div style="margin-top: 3rem; width: 100%;">
            <h3 style="margin-bottom: 1.5rem;">Asset Program With NSDA</h3>
            <div class="asset-grid" style="display:flex; gap:1rem; align-items:stretch; flex-wrap:nowrap; overflow-x:auto; width:100%;">
                <article class="course-card" style="border-left: 5px solid #fd7e14; flex:1 1 30%; min-width:220px;">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>Digital Marketing for Freelancing - Level 3</h4>
                    <p>Turn clicks into customers with SEO, paid ads, content strategy, and analytics-driven growth.</p>
                    <div class="meta"><span>3 Months</span><span>Asset Program</span></div>
                </article>

                <article class="course-card" style="border-left: 5px solid #e83e8c; flex:1 1 30%; min-width:220px;">
                    <i class="fa-solid fa-pen-nib"></i>
                    <h4>Graphics Design for Freelancing - Level 3</h4>
                    <p>Master advanced Photoshop/Illustrator, brand identity, and visual storytelling for premium clients.</p>
                    <div class="meta"><span>3 Months</span><span>Asset Program</span></div>
                </article>

                <article class="course-card" style="border-left: 5px solid #6c757d; flex:1 1 30%; min-width:220px;">
                    <i class="fa-solid fa-headset"></i>
                    <h4>IT Support - Level 3</h4>
                    <p>Build technical support expertise in hardware, networking, cloud basics, security, and OS management.</p>
                    <div class="meta"><span>3 Months</span><span>Asset Program</span></div>
                </article>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="/?page=contact" class="btn btn-enroll"><?php echo t('form_submit'); ?></a>
            <a href="/sombhabona_courses.pdf" class="btn btn-ghost" target="_blank" style="margin-left: 12px;"><i class="fa-solid fa-download"></i> Download Brochure</a>
        </div>
    </div>
</section>

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
