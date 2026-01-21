# 🛡️ SecureGuard - Security Agent Management System

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

> **A modern web application for managing security agents, sites, schedules, and attendance tracking with real-time analytics.**

---

## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Screenshots](#-screenshots)
- [Installation](#-installation)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [API Endpoints](#-api-endpoints)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## 🎯 About

**SecureGuard** is a comprehensive security agent management system designed to streamline operations for security companies. The application provides tools for managing agents, sites, schedules, and tracking attendance with automated absence detection.

### Problem Statement

Security companies face challenges with:
- ❌ Manual schedule management leading to errors
- ❌ Lack of real-time attendance tracking
- ❌ Inefficient communication with field agents
- ❌ Missing performance analytics

### Our Solution

✅ **Automated agent and site management**  
✅ **Smart scheduling system**  
✅ **Real-time digital attendance tracking**  
✅ **Interactive dashboards with analytics**  
✅ **Complete activity history**

---

## ✨ Features

### 👨‍💼 Admin Features

- **Agent Management**
  - Create, read, update, delete (CRUD) operations
  - Search and filter agents
  - Automatic user account creation
  - Pagination support

- **Site Management**
  - CRUD operations for security sites
  - Location tracking
  - Search functionality

- **Schedule Planning**
  - Assign agents to sites with specific dates and times
  - Support for night shifts (crosses midnight)
  - Calendar view with FullCalendar.js
  - Filter by agent, site, or date

- **Attendance Monitoring**
  - View all attendance records
  - Real-time statistics (present/late/absent)
  - Interactive charts with Chart.js
  - Advanced filtering options

- **Dashboard Analytics**
  - Total agents, sites, and schedules
  - Today's attendance overview
  - Pie chart for attendance distribution
  - Recent activity feed

### 👮 Agent Features

- **Digital Check-in**
  - Check-in during assigned shift hours only
  - Automatic status calculation (present if on-time, late if >15min)
  - One check-in per day
  - Check-in history

- **Personal Schedule**
  - Calendar view of personal assignments
  - Upcoming shift details (site, address, hours)
  - Location information

- **Personal Dashboard**
  - Today's check-in status
  - Monthly statistics (present/absent/late)
  - Next upcoming shift
  - Recent attendance history

### 🤖 Automation

- **Automatic Absence Detection**
  - Artisan command runs every minute
  - Marks agents as absent after shift ends
  - No manual intervention required

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 11
- **Language:** PHP 8.2
- **Database:** MySQL 8.0
- **ORM:** Eloquent
- **Authentication:** Laravel Breeze

### Frontend
- **Template Engine:** Blade
- **CSS Framework:** Bootstrap 5.3
- **Icons:** FontAwesome 6.5
- **Calendar:** FullCalendar.js 6.1
- **Charts:** Chart.js 4.0

### Development Tools
- **Version Control:** Git
- **Package Manager:** Composer, NPM
- **Task Scheduler:** Laravel Scheduler
- **Code Quality:** PSR-12 Standards

---

## 📸 Screenshots

### Login Page
![Login](docs/screenshots/login.png)
*Modern authentication with glassmorphism design*

### Admin Dashboard
![Admin Dashboard](docs/screenshots/admin-dashboard.png)
*Real-time statistics and attendance charts*

### Agent Management
![Agent List](docs/screenshots/agents-list.png)
*Comprehensive agent CRUD with search*

### Schedule Calendar
![Calendar](docs/screenshots/calendar.png)
*Interactive calendar view with FullCalendar*

### Agent Check-in
![Check-in](docs/screenshots/checkin.png)
*Digital attendance tracking*

---

## 🚀 Installation

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL >= 8.0
- Git

### Step 1: Clone Repository

```bash
git clone https://github.com/fayssal-ab/security-app.git
cd security-app
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secureguard
DB_USERNAME=root
DB_PASSWORD=your_password
```

Run migrations:

```bash
php artisan migrate
```

### Step 5: Seed Database (Optional)

```bash
php artisan db:seed
```

### Step 6: Build Assets

```bash
npm run build
```

### Step 7: Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

### Step 8: Configure Task Scheduler

For automatic absence detection, add to crontab:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Or run manually:

```bash
php artisan schedule:work
```

---

## 📖 Usage

### Default Credentials

After seeding, you can login with:

**Admin Account:**
- Email: `admin@secureguard.com`
- Password: `password`

**Agent Account:**
- Email: `agent@secureguard.com`
- Password: `password`

### Creating Your First Agent

1. Login as admin
2. Navigate to **Agents** → **Add Agent**
3. Fill in the form (name, email, phone, address, password)
4. Submit - User account is created automatically

### Creating a Schedule

1. Go to **Plannings** → **Add Planning**
2. Select agent and site
3. Choose date and time range
4. Submit - Agent can now check-in during this time

### Agent Check-in Process

1. Agent logs in
2. Goes to **Pointage** (Check-in)
3. If within assigned shift time, clicks "Confirm Presence"
4. Status calculated automatically:
   - **Present:** On-time (within 15 minutes)
   - **Late:** After 15 minutes tolerance
   - **Absent:** No check-in (marked automatically)

---

## 📁 Project Structure

```
security-app/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── CheckAbsences.php      # Auto absence detection
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AgentController.php
│   │   │   ├── SiteController.php
│   │   │   ├── PlanningController.php
│   │   │   ├── PresenceController.php
│   │   │   └── DashboardController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/
│   └── Models/
│       ├── User.php
│       ├── Agent.php
│       ├── Site.php
│       ├── Planning.php
│       └── Presence.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── agents/
│       ├── sites/
│       ├── plannings/
│       ├── dashboard/
│       ├── auth/
│       └── layouts/
├── routes/
│   └── web.php
└── public/
    ├── css/
    │   └── styles.css
    └── images/
```

---

## 🗄️ Database Schema

### Main Tables

**users**
- id, name, email, password, role (admin/agent), timestamps

**agents**
- id, nom, telephone, adresse, user_id (FK), timestamps

**sites**
- id, nom, adresse, timestamps

**plannings**
- id, agent_id (FK), site_id (FK), date, heure_debut, heure_fin, timestamps

**presences**
- id, agent_id (FK), date, statut (present/late/absent), timestamps

### Relationships

```
User 1---1 Agent
Agent 1---N Plannings
Site 1---N Plannings
Agent 1---N Presences
```

---

## 🔌 API Endpoints (Web Routes)

### Authentication
- `GET /login` - Login page
- `POST /login` - Authenticate user
- `POST /logout` - Logout user
- `GET /register` - Registration page
- `POST /register` - Register new user

### Admin Routes (Protected by `auth` + `admin` middleware)
- `GET|POST /agents` - List/Create agents
- `GET|PUT|DELETE /agents/{id}` - Show/Update/Delete agent
- `GET|POST /sites` - List/Create sites
- `GET|PUT|DELETE /sites/{id}` - Show/Update/Delete site
- `GET|POST /plannings` - List/Create schedules
- `GET|PUT|DELETE /plannings/{id}` - Show/Update/Delete schedule
- `GET /admin/presence` - View all attendances

### Agent Routes (Protected by `auth` middleware)
- `GET /dashboard` - Dashboard
- `GET /agent/pointage` - Check-in page
- `POST /agent/pointage` - Submit check-in
- `GET /agent/calendrier` - Personal calendar
- `GET /agent/calendrier/events` - Calendar events API
- `GET /historique` - Attendance history

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards
- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add comments for complex logic
- Test your changes before submitting

---

## 🔒 Security

### Implemented Security Features

- ✅ **CSRF Protection** on all forms
- ✅ **Password Hashing** with bcrypt
- ✅ **Role-based Access Control** (Admin/Agent)
- ✅ **Protected Routes** with middleware
- ✅ **SQL Injection Prevention** via Eloquent ORM
- ✅ **Session Security** with Laravel sessions

### Reporting Vulnerabilities

If you discover a security vulnerability, please email us at `security@secureguard.com`

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Contact

**Developer:** Fayssal AB  
**Email:** fayssal.abaibat@emsi-edu.ma  
**GitHub:** [@fayssal-ab](https://github.com/fayssal-ab)  
**Project Link:** [https://github.com/fayssal-ab/security-app](https://github.com/fayssal-ab/security-app)

---

## 🙏 Acknowledgments

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap](https://getbootstrap.com)
- [FullCalendar](https://fullcalendar.io)
- [Chart.js](https://www.chartjs.org)
- [FontAwesome](https://fontawesome.com)

---

## 🚀 Future Enhancements

- [ ] Native mobile app (iOS/Android)
- [ ] Push notifications
- [ ] Facial recognition for check-in
- [ ] Export reports (PDF, Excel)
- [ ] Internal messaging system
- [ ] GPS-based check-in verification
- [ ] Leave management
- [ ] Multi-company support
- [ ] API for third-party integrations
- [ ] Real-time notifications with WebSockets

---

<div align="center">

**⭐ Star this repo if you find it useful! ⭐**

Made with ❤️ by Fayssal AB

</div>
