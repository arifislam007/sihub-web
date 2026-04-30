<?php
// Contact Page
$message = '';
$error = '';
?>

<section id="contact" class="section">
    <div class="container contact-grid reveal">
        <aside class="contact-info">
            <h2 class="section-title"><?php echo t('contact_title'); ?></h2>
            <p><?php echo t('contact_description'); ?></p>
            <ul>
                <li><i class="fa-solid fa-location-dot"></i> <a href="https://maps.app.goo.gl/mmyZqbGQDvKQTXD7A" target="_blank" style="text-decoration: none; color: inherit;"><?php echo t('contact_location'); ?></a></li>
                <li style="font-size: 1.2rem; color: #28a745;"><i class="fa-solid fa-phone"></i> <a href="tel:<?php echo SITE_PHONE; ?>"><?php echo SITE_PHONE; ?></a></li>
                <li><i class="fa-solid fa-clock"></i> <?php echo t('contact_office_hours'); ?>: <?php echo t('contact_office_hours_value'); ?></li>
                <li><i class="fa-solid fa-clock"></i> <?php echo t('contact_time'); ?>: <?php echo t('contact_time_value'); ?></li>
                <li><i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a></li>
            </ul>
        </aside>

        <form id="contactForm" class="contact-form" method="POST" action="/api/submit-form.php">
            <input type="hidden" name="lang" value="<?php echo getCurrentLanguage(); ?>">
            
            <div class="form-message" id="formMessage"></div>

            <div class="field">
                <label for="fullName"><?php echo t('form_name_label'); ?></label>
                <input id="fullName" type="text" name="full_name" placeholder="<?php echo t('form_name_placeholder'); ?>" required />
            </div>

            <div class="field">
                <label for="email"><?php echo t('form_email_label'); ?></label>
                <input id="email" type="email" name="email" placeholder="<?php echo t('form_email_placeholder'); ?>" required />
            </div>

            <div class="field">
                <label for="phone"><?php echo t('form_phone_label'); ?></label>
                <input id="phone" type="tel" name="phone" placeholder="<?php echo t('form_phone_placeholder'); ?>" required />
            </div>

            <div class="field">
                <label for="course"><?php echo t('form_course_label'); ?></label>
                <select id="course" name="course_name" required>
                    <option value=""><?php echo t('form_course_select'); ?></option>
                    <option value="spoken-english"><?php echo t('form_course_english'); ?></option>
                    <option value="basic-computer"><?php echo t('form_course_basic'); ?></option>
                    <option value="digital-marketing"><?php echo t('form_course_digital'); ?></option>
                    <option value="devops"><?php echo t('form_course_devops'); ?></option>
                    <optgroup label="<?php echo t('course_nsda'); ?>">
                        <option value="asset-program-digital"><?php echo t('form_course_asset_digital'); ?></option>
                        <option value="asset-program-graphics"><?php echo t('form_course_asset_graphics'); ?></option>
                        <option value="asset-program-it"><?php echo t('form_course_asset_it'); ?></option>
                    </optgroup>
                </select>
            </div>

            <div class="field">
                <label for="message"><?php echo t('form_message_label'); ?></label>
                <textarea id="message" name="message" placeholder="<?php echo t('form_message_placeholder'); ?>" rows="4"></textarea>
            </div>

            <button type="submit" class="btn submit-btn" id="submitBtn">
                <i class="fa-solid fa-paper-plane"></i>
                <span><?php echo t('form_submit'); ?></span>
            </button>
        </form>
    </div>
</section>

<style>
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

.contact-info ul {
    list-style: none;
    padding: 0;
}

.contact-info li {
    padding: 1rem 0;
    font-size: 1rem;
    line-height: 1.6;
}

.contact-info a {
    color: #0056b3;
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}

.contact-form .field {
    margin-bottom: 1.5rem;
}

.contact-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #333;
}

.contact-form input,
.contact-form select,
.contact-form textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-family: inherit;
    font-size: 1rem;
}

.contact-form input:focus,
.contact-form select:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: #0056b3;
    box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
}

.form-message {
    padding: 1rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
    display: none;
}

.form-message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.form-message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}
</style>
