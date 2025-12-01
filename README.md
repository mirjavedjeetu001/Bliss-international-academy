# Bliss International Academy - School Management System

A comprehensive school management system built with Laravel 11, featuring student management, content management, media galleries, and more.

## 🎓 About

Bliss International Academy is a modern educational institution management system designed to handle:
- Student and teacher information
- Academic content and curriculum
- Event management
- Photo and video galleries
- Career opportunities
- Contact management
- E-library with PDF resources
- Multiple campus support (Satkhira & Debhata)

## 🚀 Features

- **Content Management System (CMS)** - Dynamic page creation and management
- **Media Gallery** - Photo and video galleries with categorization
- **E-Library** - Digital library with PDF book management
- **Career Portal** - Job posting and career opportunities
- **Event Management** - Past events showcase with detailed descriptions
- **Latest Updates** - Announcements and updates with PDF attachments
- **Multi-Campus Support** - Separate management for Satkhira and Debhata campuses
- **Responsive Design** - Mobile-friendly interface
- **Admin Dashboard** - Comprehensive backend management
- **Contact Forms** - Campus-specific contact forms with Google Maps integration

## 🛠️ Tech Stack

- **Framework:** Laravel 11.x
- **PHP:** 8.2+
- **Database:** MySQL
- **Frontend:** Bootstrap 5, JavaScript
- **Image Slider:** Swiper.js
- **Rich Text Editor:** TinyMCE
- **Icons:** Font Awesome

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js & NPM
- Apache/Nginx web server

## 🔧 Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/bliss_backup.git
cd bliss_backup
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**
Edit `.env` file with your database credentials:
```env
DB_DATABASE=bliss_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Seed the database (optional)**
```bash
php artisan db:seed
```

8. **Create storage symlink**
```bash
php artisan storage:link
```

9. **Set file permissions**
```bash
chmod -R 775 storage bootstrap/cache
chmod -R 775 public/frontend/assets/
chmod -R 775 public/backend/assets/
```

10. **Build assets**
```bash
npm run build
# or for development
npm run dev
```

11. **Start the server**
```bash
php artisan serve
```

Visit `http://localhost:8000`

## 👤 Default Admin Credentials

After seeding the database, login with:
- **URL:** `http://localhost:8000/backend/login`
- **Email:** Check `database/seeders/AdminUserSeeder.php`
- **Password:** Check seeder file

## 📁 Directory Structure

```
bliss_backup/
├── app/
│   ├── Http/Controllers/
│   │   ├── Backend/        # Admin panel controllers
│   │   └── Frontend/       # Public website controllers
│   ├── Models/             # Eloquent models
│   └── Livewire/           # Livewire components
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── public/
│   ├── backend/           # Admin assets
│   └── frontend/          # Frontend assets
├── resources/
│   └── views/
│       ├── backend/       # Admin views
│       ├── frontend/      # Public views
│       └── master/        # Layout templates
└── routes/
    └── web.php           # Application routes
```

## 🎨 Frontend Pages

- **Home** - Slider, events, latest updates, videos
- **About BIA** - Institution information, management, faculty
- **Admission** - Procedures, fees, online admission
- **Academics** - Calendar, curriculum, downloads
- **Clubs** - Various student clubs
- **Media Gallery** - Photos and videos
- **Library** - E-library with books
- **Career** - Job opportunities
- **Contact** - Campus contact forms with maps

## 🔐 Admin Panel Features

- Dashboard with statistics
- Slider management
- Event management
- Latest updates
- Page management with rich text editor
- Media categories and galleries
- Book/Form management
- Teacher profiles
- Contact form submissions
- User management

## 📧 Email Configuration

For sending emails, configure your `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@blim.edu.bd"
```

## 🗺️ Campus Information

### Satkhira Campus
- **Address:** Kharibila, Bypass Road, Satkhira Sadar, Satkhira-9400
- **Phone:** 01919888316
- **Email:** blisia bd@gmail.com, info@blim.edu.bd

### Debhata Campus
- **Address:** Sekendra, Debhata, Satkhira
- **Phone:** 01926261818
- **Email:** blimia bd@gmail.com, info@blms.edu.bd

### Career Inquiries
- **Email:** Career@blim.edu.bd

## 🐛 Troubleshooting

### File Upload Issues
```bash
chmod -R 775 public/frontend/assets/page-attachments/
chmod -R 775 public/backend/assets/images/
chmod -R 775 public/backend/attachments/
chown -R www-data:www-data public/
```

### Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## 📝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is proprietary software for Bliss International Academy.

## 👨‍💻 Development Team

**Developed by:** Mir Javed Jeetu
- **Website:** https://javed.metasoftinfo.com
- **Email:** javedmirjeetu.official@gmail.com
- **Phone:** 01811480222
- **Address:** Jashore IT park

## 🆘 Support

For support, email info@blim.edu.bd or contact the development team.

## 🔄 Updates & Maintenance

Last Updated: December 1, 2025

### Recent Changes
- ✅ Updated email addresses across all pages
- ✅ Fixed Past Events "Read More" functionality
- ✅ Added Career email display
- ✅ Fixed Latest Update description alignment
- ✅ Verified Google Maps integration
- ✅ Enhanced responsive design

---

**© 2025 Bliss International Academy. All rights reserved.**
