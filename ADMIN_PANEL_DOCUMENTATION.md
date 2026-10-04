# MG Events Admin Panel - Documentation

## Overview
A custom-built admin panel for managing the MG Events website. Built from scratch using Laravel without any external packages.

## Access Information

### Admin Login Credentials
- **URL**: http://127.0.0.1:8000/admin/login
- **Email**: admin@mgevents.pk
- **Password**: admin123

## Features

### 1. Dashboard
- Quick statistics overview
- Recent blog posts
- Quick action buttons
- Elegant golden and dark theme

### 2. Blog Management
**Location**: Admin → Blog Posts

Features:
- Create new blog posts
- Edit existing posts
- Delete posts
- Upload featured images
- Set categories (Wedding Planning, Corporate Events, Decor Trends, etc.)
- Publish/Draft status
- Rich text content editor

**Available Categories**:
- Wedding Planning
- Corporate Events
- Decor Trends
- Catering
- Budget Tips
- Venue Guide
- Planning Tips

### 3. Portfolio Management
**Location**: Admin → Portfolio

Features:
- Add portfolio items
- Upload portfolio images
- Categorize items (Wedding, Corporate, Birthday, Social Event)
- Set display order
- Activate/Deactivate items
- Edit and delete portfolio items

### 4. Site Settings
**Location**: Admin → Site Settings

Manage all website content:

**Hero Section**:
- Hero title
- Hero description
- Hero background image

**About Section**:
- About title
- About content
- About section image

**Contact Information**:
- Phone number
- Email address
- Office address

**Social Media**:
- Facebook URL
- Instagram URL
- Twitter/X URL
- WhatsApp number

## Technical Details

### Database Tables Created
1. **admins** - Admin users with authentication
2. **blog_posts** - Blog content with images and publishing
3. **portfolio_items** - Portfolio gallery items
4. **site_settings** - Dynamic website content

### File Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       ├── AuthController.php
│   │       ├── DashboardController.php
│   │       ├── BlogController.php
│   │       ├── PortfolioController.php
│   │       └── SettingsController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── Admin.php
│   ├── BlogPost.php
│   ├── PortfolioItem.php
│   └── SiteSetting.php

resources/views/admin/
├── auth/
│   └── login.blade.php
├── layouts/
│   └── app.blade.php
├── dashboard.blade.php
├── blogs/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── portfolio/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── settings/
    └── index.blade.php

public/
├── css/
│   └── admin-styles.css
└── js/
    └── admin-scripts.js
```

### Routes
All admin routes are prefixed with `/admin`:
- GET /admin/login - Login page
- POST /admin/login - Login action
- POST /admin/logout - Logout action
- GET /admin/dashboard - Dashboard
- Resource routes for blogs, portfolio

### Authentication
- Uses Laravel's built-in authentication with custom `admin` guard
- Protected by `AdminMiddleware`
- Session-based authentication

## Usage Guide

### Creating a Blog Post
1. Navigate to Blog Posts
2. Click "Create New Post"
3. Fill in:
   - Title (required)
   - Category (required)
   - Excerpt (required)
   - Content (required)
   - Featured Image (optional)
   - Publish status (checkbox)
4. Click "Create Blog Post"

### Adding Portfolio Items
1. Navigate to Portfolio
2. Click "Add Portfolio Item"
3. Fill in:
   - Title (required)
   - Category (required)
   - Description (optional)
   - Image (required)
   - Display Order (number)
   - Active status (checkbox)
4. Click "Add Portfolio Item"

### Updating Site Settings
1. Navigate to Site Settings
2. Edit any section:
   - Hero Section
   - About Section
   - Contact Information
   - Social Media Links
3. Upload new images if needed
4. Click "Save All Settings"

## Image Upload
All images are stored in `storage/app/public`:
- Blog images: `storage/app/public/blog-images/`
- Portfolio images: `storage/app/public/portfolio/`
- Settings images: `storage/app/public/settings/`

## Security Features
- Password hashing (bcrypt)
- CSRF protection on all forms
- Authentication middleware
- Separate admin guard
- File upload validation
- XSS protection

## Customization

### Adding More Admin Users
Run in artisan tinker:
```php
php artisan tinker
```

Then:
```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

Admin::create([
    'name' => 'New Admin',
    'email' => 'newadmin@mgevents.pk',
    'password' => Hash::make('password123')
]);
```

### Adding New Settings
In the `site_settings` table:
```php
SiteSetting::set('setting_key', 'setting_value', 'text', 'group_name');
```

### Modifying Colors
Edit `public/css/admin-styles.css`:
- Primary color: `#D4A853` (Golden)
- Dark background: `#1a1a2e`
- Text color: `#2c3e50`

## Maintenance

### Backup Database
```bash
php artisan db:backup
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Storage Link
If images don't show, run:
```bash
php artisan storage:link
```

## Support Features
- Auto-hiding success messages
- Image preview on upload
- Responsive design
- Form validation
- Pagination on lists
- Confirm dialogs on delete

## Browser Compatibility
- Chrome (recommended)
- Firefox
- Safari
- Edge

## Responsive Design
The admin panel is fully responsive and works on:
- Desktop (1920px+)
- Laptop (1366px+)
- Tablet (768px+)
- Mobile (320px+)

## Important Notes
1. Always logout when finished
2. Backup database before major changes
3. Test image uploads are < 2MB
4. Use descriptive titles for SEO
5. Published blogs appear on frontend immediately

## Troubleshooting

**Can't login?**
- Check email/password
- Clear browser cache
- Ensure database is migrated

**Images not uploading?**
- Check file size (< 2MB)
- Ensure storage is linked
- Check file permissions

**Settings not saving?**
- Check form CSRF token
- Clear application cache
- Check database connection

---

**Developed by**: Custom Built
**Version**: 1.0
**Last Updated**: December 18, 2025
