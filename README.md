# Slack Website Platform - Technical Design & Architecture

[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Architecture-Modular_Monolith-blue](https://img.shields.io/badge/Architecture-Modular_Monolith-blue.svg)](#system-architecture)
[![Quality-Enforced-green](https://img.shields.io/badge/Quality-Enforced-green.svg)](#cicd--quality-control)

## 1. Executive Summary
The **Slack Website Platform** is a high-performance, theme-driven engine built on **Laravel 12**. Unlike traditional monolithic applications, it utilizes a **Domain-Driven Modular Monolith** architecture. This ensures that the codebase remains scalable, maintainable, and prepared for a future transition to a multi-tenant SaaS or microservices if required.

---

## 2. System Architecture
### 2.1 Modular Monolith
The application logic is partitioned into self-contained modules located in `app/Modules/`. Each module encapsulates its own:
- **Controllers**: Handling HTTP/API requests for specific domains.
- **Models**: Eloquent entities and relationships.
- **Service Layer**: Orchestrating business logic to keep controllers thin.
- **ServiceProviders**: Managing module-level registration of views and migrations.

### 2.2 Core Design Patterns
- **Repository Pattern**: Abstraction layer for database access to ensure data consistency.
- **Service Layer**: Isolation of business rules from the framework's transport layer (HTTP).
- **View Namespacing**: Modules use namespaced views (e.g., `CMS::index`) to prevent template collision.

---

## 3. Domain Modules Breakdown
### 3.1 Auth & RBAC
Implements **Granular Role-Based Access Control**. While Spatie handles the role hierarchy, our implementation allows for "Permission Groups" (e.g., `theme.activate`, `cms.publish`), enabling two users with the same role to have different module access.

### 3.2 Theme Configuration Engine
A critical differentiator. It uses **CSS Custom Properties (Variables)** to allow non-technical admins to override primary colors, typography, and layout styles at runtime without requiring a CSS recompile or deployment.

### 3.3 Page Builder System
A block-based composition engine. Pages are constructed from **Sections** containing **Blocks** (Hero, Grid, Text, etc.). Data is stored as structured JSON props, allowing for high flexibility in layout design.

### 3.4 CMS & Media Management
- **CMS**: Multi-status workflow (Draft -> Under Review -> Published).
- **Media**: Centralized asset library with an image processing pipeline for automatic **WebP** conversion and responsive thumbnail generation.

---

## 4. CI/CD & Quality Control
We enforce a **Zero-Tolerance Quality Policy** through a multi-stage pipeline:

1. **Local Pre-commit (Husky)**: Blocks any commit that doesn't pass **Laravel Pint** styling checks.
2. **Push Protection**: GitHub-level blocking of commits containing sensitive secrets (e.g., API keys).
3. **Automated CI (GitHub Actions)**: Every push triggers a virtual environment that:
   - Sets up a MySQL/Redis stack.
   - Runs **Pest/PHPUnit** test suites.
   - Validates code style and static analysis.

---

## 5. Future Scalability (SaaS Ready)
The platform is built with a **Multi-Tenant Foundation**:
- **TenantMiddleware**: Already prepared to resolve tenant context via subdomains.
- **Database Strategy**: Designed for database-per-tenant isolation.
- **Namespacing**: Media and Cache are namespaced by `tenant_id` to prevent data leakage.

---

## 👨‍💻 Developed By
**Poka Machande Junior Software Engineer** - *Lead Developer & Architect*
