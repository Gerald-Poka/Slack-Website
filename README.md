# Slack Website Platform

[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Architecture-Modular_Monolith-blue](https://img.shields.io/badge/Architecture-Modular_Monolith-blue.svg)](#architecture)

A powerful, theme-driven, and highly configurable website engine built with Laravel 12. This platform is designed for institutions, enterprises, and schools that require professional web presences with non-technical administration.

## 🏗️ Architecture: Domain-Driven Modular Monolith

Unlike standard Laravel applications, this platform follows a **Domain-Driven Modular** structure. Every core feature is encapsulated within its own module in `app/Modules/`, containing its own Controllers, Models, and logic.

### Core Modules
- **Auth**: Granular Role-Based Access Control (RBAC) using Spatie and Fortify.
- **Theme**: A dynamic engine allowing runtime configuration of colors, fonts, and layouts via CSS variables.
- **CMS**: Comprehensive content management with multi-status workflows (Draft, Review, Published).
- **PageBuilder**: A block-based composition system for building dynamic landing pages.
- **Media**: A centralized digital asset library with automatic image optimization (WebP).
- **Settings**: A hierarchical key-value store for system-wide configurations.
- **Plugin**: An extension system using hooks and filters for third-party integrations.

## 🛠️ Technology Stack
- **Backend**: Laravel 12.x, PHP 8.3
- **Frontend (Admin)**: Livewire 3.x, Alpine.js, Tailwind CSS
- **Frontend (Public)**: Blade, Alpine.js, Tailwind CSS
- **Database**: MySQL 8.0
- **Cache/Queue**: Redis 7.x
- **Containerization**: Docker & Docker Compose

## 🚀 Getting Started

### Prerequisites
- Docker & Docker Compose
- Node.js & NPM (for local asset compilation)

### Installation
1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd slack-website
   ```

2. **Initialize the Docker environment**:
   ```bash
   docker compose up -d --build
   ```

3. **Install dependencies**:
   ```bash
   docker compose exec app composer install
   docker compose exec app php artisan migrate
   ```

4. **Access the platform**:
   - **Public Site**: `http://localhost:8085`
   - **Admin Panel**: `http://localhost:8085/admin/dashboard`

## 🔒 Security & RBAC
The platform implements granular permissions. Users can be assigned specific module access (e.g., `theme.edit` or `cms.publish`), allowing multiple administrators to have different levels of visibility and control across the platform.

## 👨‍💻 Developed By

**Poka Machande Junior Software Engineer** - *Lead Developer & Architect*

---

## 📜 License
This platform is developed as a proprietary engine for the Slack Website project.
