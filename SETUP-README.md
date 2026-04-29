# Sombhabona Innovation Hub - Multi-Page PHP Website

A modern, multi-language (English/Bangla) PHP-based website for Sombhabona Innovation Hub with PostgreSQL database integration for lead collection.

## Features

- ✅ **Multi-Page Structure** - Home, Courses, Contact, About pages
- ✅ **Multi-Language Support** - English and Bangla (বাংলা)
- ✅ **PostgreSQL Database** - Lead collection and management
- ✅ **Contact Form** - Integrated form with database storage
- ✅ **Admin Dashboard** - View and manage leads
- ✅ **Responsive Design** - Mobile-friendly interface
- ✅ **Docker Support** - Easy deployment with Docker Compose
- ✅ **URL Rewriting** - SEO-friendly URLs

## Project Structure

```
├── config/
│   ├── config.php              # Global configuration
│   └── database.php            # Database connection
├── languages/
│   ├── en.php                  # English translations
│   └── bn.php                  # Bangla translations
├── includes/
│   ├── header.php              # Header template
│   └── footer.php              # Footer template
├── pages/
│   ├── home.php                # Home page
│   ├── courses.php             # Courses listing
│   ├── contact.php             # Contact form
│   └── about.php               # About page
├── api/
│   └── submit-form.php         # Form submission API
├── admin/
│   ├── index.php               # Admin dashboard
│   ├── login.php               # Admin login
│   └── logout.php              # Admin logout
├── assets/                     # Images, icons, etc.
├── storage/                    # File uploads, logs
├── index.php                   # Main router
├── styles.css                  # Main stylesheet
├── script.js                   # JavaScript
├── db-setup.sql               # Database schema
├── docker-compose.yml         # Docker configuration
├── Dockerfile                 # PHP image configuration
├── .env.example               # Environment variables template
└── .htaccess                  # URL rewriting rules
```

## Installation

### Option 1: Using Docker (Recommended)

1. **Clone or navigate to project directory**
   ```bash
   cd f:\php-project\ihub
   ```

2. **Start Docker containers**
   ```bash
   docker-compose up -d
   ```

3. **Wait for PostgreSQL to initialize** (30-60 seconds)

4. **Access the website**
   - Frontend: http://localhost:8080
   - Admin Panel: http://localhost:8080/admin/login.php

### Option 2: Manual Setup (Local PHP + PostgreSQL)

#### Prerequisites
- PHP 8.1+ with PDO PostgreSQL extension
- PostgreSQL 12+
- Apache with mod_rewrite enabled

#### Steps

1. **Configure Database**
   ```sql
   -- Create database
   CREATE DATABASE sombhabona_hub;
   
   -- Run the setup script
   psql -U postgres -d sombhabona_hub -f db-setup.sql
   ```

2. **Configure Environment**
   ```bash
   # Copy environment template
   cp .env.example .env
   
   # Edit .env with your settings
   ```

3. **Set Apache Configuration**
   - Point document root to project directory
   - Enable mod_rewrite
   - Copy .htaccess to root

4. **Set Permissions**
   ```bash
   chmod -R 755 storage/
   chmod -R 755 admin/
   ```

5. **Access Website**
   - Frontend: http://localhost/ihub
   - Admin: http://localhost/ihub/admin/login.php

## Configuration

### Environment Variables (.env)

```
DB_HOST=localhost
DB_PORT=5432
DB_NAME=sombhabona_hub
DB_USER=postgres
DB_PASS=password

ADMIN_EMAIL=admin@sombhabona.com
SITE_URL=http://localhost
SITE_EMAIL=info@sombhabona.com
SITE_PHONE=01737243447

# SMTP (optional, for email notifications)
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=your-email@gmail.com
SMTP_PASS=your-app-password
```

## Usage

### Accessing Different Pages

- **Home**: `/` or `/?page=home`
- **Courses**: `/?page=courses`
- **Contact**: `/?page=contact`
- **About**: `/?page=about`

### Language Switching

Add `&lang=bn` or `&lang=en` to any URL:
- English: `/?page=courses&lang=en`
- Bangla: `/?page=courses&lang=bn`

### Admin Dashboard

1. Visit `/admin/login.php`
2. **Default Credentials:**
   - Username: `admin`
   - Password: `admin123`

3. **Change credentials** in `admin/login.php` (production)

## Database Schema

### Leads Table
```sql
CREATE TABLE leads (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course_id INT REFERENCES courses(id),
    course_name VARCHAR(255),
    message TEXT,
    status VARCHAR(50) DEFAULT 'new', -- new, contacted, enrolled
    source VARCHAR(50) DEFAULT 'contact_form',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address INET
);
```

### Courses Table
```sql
CREATE TABLE courses (
    id SERIAL PRIMARY KEY,
    name_en VARCHAR(255) NOT NULL,
    name_bn VARCHAR(255) NOT NULL,
    description_en TEXT,
    description_bn TEXT,
    category VARCHAR(50),
    fee_amount DECIMAL(10, 2),
    discount_percentage INT DEFAULT 0,
    duration_months INT,
    schedule_en VARCHAR(255),
    schedule_bn VARCHAR(255)
);
```

## Form Submission

When a user submits the contact form:

1. Form data is validated on client-side
2. AJAX request sent to `/api/submit-form.php`
3. Server-side validation performed
4. Data inserted into `leads` table
5. Confirmation email sent to user
6. Admin notification sent (if configured)

### Form Endpoints

- **Submit**: `POST /api/submit-form.php`
- **Response Format**: JSON

```json
{
    "success": true,
    "message": "Thank you! We will contact you soon.",
    "lead_id": 123
}
```

## Email Configuration

To enable email notifications:

1. Configure SMTP in `.env`
2. Uncomment email functions in `api/submit-form.php`
3. Use Gmail App Password (recommended)

## Docker Commands

```bash
# Start containers
docker-compose up -d

# View logs
docker-compose logs -f web
docker-compose logs -f postgres

# Stop containers
docker-compose down

# Rebuild images
docker-compose build --no-cache

# Access PostgreSQL
docker-compose exec postgres psql -U postgres -d sombhabona_hub
```

## Troubleshooting

### Database Connection Error
- Check PostgreSQL is running
- Verify DB credentials in `.env`
- Ensure PostgreSQL container health (wait 30 seconds after start)

### Form Not Submitting
- Check browser console for errors
- Verify `/api/submit-form.php` is accessible
- Check PHP error logs

### Admin Dashboard Not Loading
- Verify session support is enabled
- Check `/storage` directory permissions
- Clear session files and retry

### Images Not Loading
- Verify `/assets` directory exists
- Check file permissions
- Verify correct paths in HTML

## Security Considerations

For production deployment:

1. **Change admin password** immediately
2. **Use environment variables** for secrets
3. **Enable HTTPS** (SSL/TLS)
4. **Implement CSRF tokens** for forms
5. **Validate all user inputs** on server-side
6. **Use prepared statements** (already implemented)
7. **Set proper file permissions**
8. **Enable rate limiting** on contact form
9. **Implement proper authentication** for admin panel
10. **Regular database backups**

## Performance Optimization

- Database queries are indexed
- Lazy loading for images
- CSS/JS minification recommended
- CDN for static assets (already using)

## Support & Maintenance

- Check logs in `/storage` directory
- Monitor database for large lead tables
- Implement pagination for large datasets
- Regular database maintenance

## License

© 2026 Sombhabona Innovation Hub. All rights reserved.

## Contact

- **Phone**: 01737243447
- **Email**: info@sombhabona.com
- **Location**: 756 West Sewrapara, Mirpur, Dhaka

---

## Development Notes

### Adding New Pages
1. Create file in `pages/` directory
2. Add translations in `languages/en.php` and `languages/bn.php`
3. Include page in router logic in `index.php`

### Adding New Translations
1. Add key-value pair to `languages/en.php`
2. Add corresponding Bangla translation to `languages/bn.php`
3. Use `t('key')` function in templates

### Database Migrations
1. Modify `db-setup.sql` for schema changes
2. For existing databases, run changes manually or create migration scripts
