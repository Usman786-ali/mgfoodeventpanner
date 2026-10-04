# Email Setup Guide for Contact Forms

## Overview
All 3 contact forms on your website send submissions to the same email address:
1. Hero Section Quick Form (Home Page)
2. Bottom Contact Form (Home Page)
3. Contact Page Form

## Setup Steps

### 1. Update .env File

Open `.env` file and add/update these settings:

```env
ADMIN_EMAIL=your-email@example.com
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@mgfoodevent.com
MAIL_FROM_NAME="MG Food & Event Planners"
```

### 2. Gmail App Password Setup

1. Go to Google Account → Security
2. Enable 2-Step Verification
3. Go to App Passwords
4. Select "Mail" and generate password
5. Copy the 16-digit password
6. Paste in `.env` as `MAIL_PASSWORD`

### 3. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

### 4. Test

1. Fill any contact form on the website
2. Submit
3. Check your email inbox
4. Check admin panel for submission

## Email Options

### Option 1: Gmail (Testing)
- Host: smtp.gmail.com
- Port: 587
- Requires App Password

### Option 2: cPanel Email (Production)
- Host: mail.mgfoodevent.com
- Port: 587
- Use your cPanel email credentials

### Option 3: Mailtrap (Development)
- Host: smtp.mailtrap.io
- Port: 2525
- Free testing service

## Email Template

When someone submits a form, you'll receive an email with:
- Contact Information (Name, Email, Phone)
- Event Details (Type, Date, Budget)
- Message
- Reply button

## Troubleshooting

### Email not sending?
1. Check `.env` credentials
2. Run `php artisan config:clear`
3. Check spam folder
4. Verify SMTP settings with your email provider

### Gmail blocking?
1. Enable "Less secure app access" (not recommended)
2. Use App Password instead (recommended)
3. Check Google Security settings

## Support

For issues, check:
- Laravel logs: `storage/logs/laravel.log`
- Email queue: `php artisan queue:work`
