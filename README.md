# Sombhabona Innovation Hub Website

Single-page IT training website with a PHP contact form and Docker Compose runtime.

## Tech Stack
- HTML5 + CSS3 + Vanilla JavaScript
- PHP 8.3 (Apache)
- Docker Compose

## Run With Docker Compose

1. Open terminal in project root.
2. Build and start:

```bash
docker compose up --build
```

3. Open:

- http://localhost:8080

4. Stop containers:

```bash
docker compose down
```

## Contact Form
- Endpoint: `contact.php`
- Stores submissions in `storage/contact-submissions.log`
- Validates required fields server-side

## Project Files
- `index.html` - Main page
- `styles.css` - Styling and responsive layout
- `script.js` - Interactions, validation, animations
- `contact.php` - Form backend
- `docker-compose.yml` - Local runtime
- `Dockerfile` - PHP Apache image

## Notes
- This setup logs form submissions locally.
- Replace backend logging with PHPMailer + SMTP when production email is ready.
