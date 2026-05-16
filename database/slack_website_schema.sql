-- ============================================================
--  slack_website — Complete Database Schema
--  Laravel 12 Compatible · TDD-Aligned · May 2026
--  Engine: InnoDB · Charset: utf8mb4 · Collation: utf8mb4_unicode_ci
-- ============================================================

CREATE DATABASE IF NOT EXISTS `slack_website`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `slack_website`;

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- ============================================================
--  SECTION 1: LARAVEL CORE TABLES
-- ============================================================

-- ------------------------------------------------------------
-- 1.1  migrations  (Laravel standard)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
  `id`        INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255)    NOT NULL,
  `batch`     INT             NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 1.2  jobs  (Laravel Queue)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jobs` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue`        VARCHAR(255)    NOT NULL,
  `payload`      LONGTEXT        NOT NULL,
  `attempts`     TINYINT UNSIGNED NOT NULL,
  `reserved_at`  INT UNSIGNED    NULL,
  `available_at` INT UNSIGNED    NOT NULL,
  `created_at`   INT UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 1.3  failed_jobs  (Laravel Queue)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid`       VARCHAR(255)    NOT NULL UNIQUE,
  `connection` TEXT            NOT NULL,
  `queue`      TEXT            NOT NULL,
  `payload`    LONGTEXT        NOT NULL,
  `exception`  LONGTEXT        NOT NULL,
  `failed_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 1.4  job_batches  (Laravel Bus Batching)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id`             VARCHAR(255) NOT NULL,
  `name`           VARCHAR(255) NOT NULL,
  `total_jobs`     INT          NOT NULL,
  `pending_jobs`   INT          NOT NULL,
  `failed_jobs`    INT          NOT NULL,
  `failed_job_ids` LONGTEXT     NOT NULL,
  `options`        MEDIUMTEXT   NULL,
  `cancelled_at`   INT          NULL,
  `created_at`     INT          NOT NULL,
  `finished_at`    INT          NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 1.5  cache  (Laravel Cache)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache` (
  `key`        VARCHAR(255) NOT NULL,
  `value`      MEDIUMTEXT   NOT NULL,
  `expiration` INT          NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 1.6  cache_locks  (Laravel Cache)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key`        VARCHAR(255) NOT NULL,
  `owner`      VARCHAR(255) NOT NULL,
  `expiration` INT          NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 1.7  sessions  (Laravel Session — database driver)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id`            VARCHAR(255)    NOT NULL,
  `user_id`       BIGINT UNSIGNED NULL,
  `ip_address`    VARCHAR(45)     NULL,
  `user_agent`    TEXT            NULL,
  `payload`       LONGTEXT        NOT NULL,
  `last_activity` INT             NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index`      (`user_id`),
  INDEX `sessions_last_activity_index`(`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 2: AUTHENTICATION & USER MANAGEMENT
-- ============================================================

-- ------------------------------------------------------------
-- 2.1  users
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id`                    BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `name`                  VARCHAR(191)     NOT NULL,
  `email`                 VARCHAR(191)     NOT NULL,
  `email_verified_at`     TIMESTAMP        NULL,
  `password`              VARCHAR(255)     NOT NULL,
  `avatar`                VARCHAR(500)     NULL COMMENT 'Path in media storage',
  `status`                ENUM('active','suspended','pending','banned')
                                           NOT NULL DEFAULT 'active',
  `two_factor_secret`     TEXT             NULL,
  `two_factor_recovery_codes` TEXT         NULL,
  `two_factor_confirmed_at`   TIMESTAMP    NULL,
  `last_login_at`         TIMESTAMP        NULL,
  `last_login_ip`         VARCHAR(45)      NULL,
  `remember_token`        VARCHAR(100)     NULL,
  `created_at`            TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`            TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at`            TIMESTAMP        NULL COMMENT 'Soft delete',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  INDEX `users_status_index`      (`status`),
  INDEX `users_deleted_at_index`  (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 2.2  password_reset_tokens  (Laravel 12 standard)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email`      VARCHAR(191) NOT NULL,
  `token`      VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP    NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 2.3  personal_access_tokens  (Laravel Sanctum)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id`             BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `tokenable_type` VARCHAR(255)     NOT NULL,
  `tokenable_id`   BIGINT UNSIGNED  NOT NULL,
  `name`           VARCHAR(255)     NOT NULL,
  `token`          VARCHAR(64)      NOT NULL,
  `abilities`      TEXT             NULL,
  `last_used_at`   TIMESTAMP        NULL,
  `expires_at`     TIMESTAMP        NULL,
  `created_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  INDEX `personal_access_tokens_tokenable_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 3: ROLES & PERMISSIONS  (Spatie Laravel-Permission)
-- ============================================================

-- ------------------------------------------------------------
-- 3.1  roles
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(191)    NOT NULL COMMENT 'Slug: super_admin, admin, editor',
  `guard_name`   VARCHAR(191)    NOT NULL DEFAULT 'web',
  `display_name` VARCHAR(191)    NULL,
  `description`  TEXT            NULL,
  `created_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_unique` (`name`, `guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3.2  permissions
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `permissions` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(191)    NOT NULL COMMENT 'Slug: page.publish, theme.edit',
  `guard_name`   VARCHAR(191)    NOT NULL DEFAULT 'web',
  `group`        VARCHAR(100)    NULL     COMMENT 'pages | themes | media | settings | users',
  `display_name` VARCHAR(191)    NULL,
  `created_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_unique` (`name`, `guard_name`),
  INDEX `permissions_group_index` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3.3  model_has_roles  (User → Role pivot)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id`    BIGINT UNSIGNED NOT NULL,
  `model_type` VARCHAR(255)    NOT NULL,
  `model_id`   BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`),
  INDEX `model_has_roles_model_index` (`model_type`, `model_id`),
  CONSTRAINT `fk_mhr_role_id`
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3.4  model_has_permissions  (User → Permission direct pivot)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` BIGINT UNSIGNED NOT NULL,
  `model_type`    VARCHAR(255)    NOT NULL,
  `model_id`      BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
  INDEX `model_has_permissions_model_index` (`model_type`, `model_id`),
  CONSTRAINT `fk_mhp_permission_id`
    FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3.5  role_has_permissions  (Role → Permission pivot)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` BIGINT UNSIGNED NOT NULL,
  `role_id`       BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`),
  CONSTRAINT `fk_rhp_permission_id`
    FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rhp_role_id`
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 4: MEDIA MANAGEMENT
-- ============================================================

-- ------------------------------------------------------------
-- 4.1  media_folders
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `media_folders` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id`   BIGINT UNSIGNED NULL,
  `name`        VARCHAR(191)    NOT NULL,
  `slug`        VARCHAR(255)    NOT NULL,
  `description` TEXT            NULL,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `media_folders_parent_id_index` (`parent_id`),
  CONSTRAINT `fk_mf_parent_id`
    FOREIGN KEY (`parent_id`) REFERENCES `media_folders`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 4.2  media
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `media` (
  `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `folder_id`         BIGINT UNSIGNED NULL,
  `filename`          VARCHAR(255)    NOT NULL COMMENT 'UUID-based stored filename',
  `original_filename` VARCHAR(255)    NOT NULL COMMENT 'Original upload name',
  `mime_type`         VARCHAR(100)    NOT NULL,
  `extension`         VARCHAR(20)     NOT NULL,
  `disk`              VARCHAR(50)     NOT NULL DEFAULT 'public'
                                      COMMENT 'local | s3 | spaces',
  `path`              VARCHAR(500)    NOT NULL COMMENT 'Relative path on disk',
  `url`               VARCHAR(1000)   NULL     COMMENT 'Full public URL (CDN)',
  `size`              BIGINT UNSIGNED NOT NULL COMMENT 'Bytes',
  `width`             INT UNSIGNED    NULL     COMMENT 'Pixels (images only)',
  `height`            INT UNSIGNED    NULL     COMMENT 'Pixels (images only)',
  `duration`          INT UNSIGNED    NULL     COMMENT 'Seconds (video/audio)',
  `alt_text`          VARCHAR(255)    NULL,
  `caption`           TEXT            NULL,
  `thumbnails`        JSON            NULL
                      COMMENT '{"thumb":"path","medium":"path","large":"path"}',
  `meta`              JSON            NULL     COMMENT 'EXIF, additional metadata',
  `uploader_id`       BIGINT UNSIGNED NOT NULL,
  `created_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at`        TIMESTAMP       NULL,
  PRIMARY KEY (`id`),
  INDEX `media_folder_id_index`   (`folder_id`),
  INDEX `media_mime_type_index`   (`mime_type`),
  INDEX `media_uploader_id_index` (`uploader_id`),
  INDEX `media_deleted_at_index`  (`deleted_at`),
  CONSTRAINT `fk_media_folder_id`
    FOREIGN KEY (`folder_id`)   REFERENCES `media_folders`(`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_media_uploader_id`
    FOREIGN KEY (`uploader_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 5: THEME ENGINE
-- ============================================================

-- ------------------------------------------------------------
-- 5.1  themes
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `themes` (
  `id`               BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(191)    NOT NULL COMMENT 'Slug: corporate, academic, minimal',
  `label`            VARCHAR(191)    NOT NULL COMMENT 'Display name: Corporate Blue',
  `description`      TEXT            NULL,
  `preview_image_id` BIGINT UNSIGNED NULL,
  `is_active`        TINYINT(1)      NOT NULL DEFAULT 0
                     COMMENT 'Only one row = 1 at a time',
  `is_default`       TINYINT(1)      NOT NULL DEFAULT 0,
  `is_system`        TINYINT(1)      NOT NULL DEFAULT 0
                     COMMENT 'System themes cannot be deleted',
  `version`          VARCHAR(20)     NOT NULL DEFAULT '1.0.0',
  `author`           VARCHAR(191)    NULL,
  `created_at`       TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`       TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at`       TIMESTAMP       NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `themes_name_unique` (`name`),
  INDEX `themes_is_active_index`  (`is_active`),
  INDEX `themes_deleted_at_index` (`deleted_at`),
  CONSTRAINT `fk_themes_preview_image_id`
    FOREIGN KEY (`preview_image_id`) REFERENCES `media`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 5.2  theme_settings
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `theme_settings` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme_id`   BIGINT UNSIGNED NOT NULL,
  `key`        VARCHAR(191)    NOT NULL
               COMMENT 'primary_color, heading_font, layout_type …',
  `value`      TEXT            NULL,
  `type`       ENUM('color','font','string','integer','boolean','select','json')
               NOT NULL DEFAULT 'string',
  `group`      VARCHAR(100)    NULL
               COMMENT 'colors | typography | layout | navigation | footer',
  `label`      VARCHAR(191)    NULL COMMENT 'Admin UI label',
  `options`    JSON            NULL COMMENT 'Valid options for select type',
  `sort_order` INT             NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `theme_settings_theme_key_unique` (`theme_id`, `key`),
  INDEX `theme_settings_group_index` (`group`),
  CONSTRAINT `fk_ts_theme_id`
    FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 6: PAGE BUILDER
-- ============================================================

-- ------------------------------------------------------------
-- 6.1  block_types
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `block_types` (
  `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`           VARCHAR(100)    NOT NULL COMMENT 'HeroBlock, TextBlock, …',
  `label`          VARCHAR(191)    NOT NULL COMMENT 'Hero Banner, Rich Text, …',
  `category`       VARCHAR(100)    NOT NULL
                   COMMENT 'content | media | layout | form | embed',
  `icon`           VARCHAR(100)    NULL,
  `description`    TEXT            NULL,
  `schema`         JSON            NOT NULL  COMMENT 'JSON Schema for props validation',
  `default_props`  JSON            NULL      COMMENT 'Default values for new instances',
  `renderer_class` VARCHAR(255)    NOT NULL  COMMENT 'App\\Blocks\\HeroBlockRenderer',
  `is_active`      TINYINT(1)      NOT NULL DEFAULT 1,
  `is_system`      TINYINT(1)      NOT NULL DEFAULT 0,
  `sort_order`     INT             NOT NULL DEFAULT 0,
  `created_at`     TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`     TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `block_types_name_unique` (`name`),
  INDEX `block_types_category_index`  (`category`),
  INDEX `block_types_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6.2  pages
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pages` (
  `id`                BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `parent_id`         BIGINT UNSIGNED  NULL     COMMENT 'Hierarchy support',
  `author_id`         BIGINT UNSIGNED  NOT NULL,
  `featured_image_id` BIGINT UNSIGNED  NULL,
  `title`             VARCHAR(255)     NOT NULL,
  `slug`              VARCHAR(255)     NOT NULL,
  `excerpt`           TEXT             NULL,
  `status`            ENUM('draft','review','published','scheduled','archived')
                      NOT NULL DEFAULT 'draft',
  `type`              ENUM('page','landing','post','system','custom')
                      NOT NULL DEFAULT 'page',
  `template`          VARCHAR(100)     NULL     COMMENT 'Named Blade template override',
  `meta_title`        VARCHAR(255)     NULL,
  `meta_description`  TEXT             NULL,
  `meta_keywords`     VARCHAR(500)     NULL,
  `og_title`          VARCHAR(255)     NULL     COMMENT 'Open Graph title',
  `og_description`    TEXT             NULL,
  `og_image_id`       BIGINT UNSIGNED  NULL,
  `is_homepage`       TINYINT(1)       NOT NULL DEFAULT 0,
  `is_in_menu`        TINYINT(1)       NOT NULL DEFAULT 0,
  `sort_order`        INT              NOT NULL DEFAULT 0,
  `published_at`      TIMESTAMP        NULL     COMMENT 'Scheduled publish datetime',
  `created_at`        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at`        TIMESTAMP        NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique`       (`slug`),
  INDEX `pages_parent_id_index`        (`parent_id`),
  INDEX `pages_author_id_index`        (`author_id`),
  INDEX `pages_status_index`           (`status`),
  INDEX `pages_type_index`             (`type`),
  INDEX `pages_is_homepage_index`      (`is_homepage`),
  INDEX `pages_published_at_index`     (`published_at`),
  INDEX `pages_deleted_at_index`       (`deleted_at`),
  FULLTEXT INDEX `pages_fulltext`      (`title`, `excerpt`),
  CONSTRAINT `fk_pages_parent_id`
    FOREIGN KEY (`parent_id`)          REFERENCES `pages`(`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pages_author_id`
    FOREIGN KEY (`author_id`)          REFERENCES `users`(`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_pages_featured_image`
    FOREIGN KEY (`featured_image_id`)  REFERENCES `media`(`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pages_og_image`
    FOREIGN KEY (`og_image_id`)        REFERENCES `media`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6.3  page_revisions  (version history)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `page_revisions` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id`      BIGINT UNSIGNED NOT NULL,
  `author_id`    BIGINT UNSIGNED NOT NULL,
  `revision_no`  INT UNSIGNED    NOT NULL DEFAULT 1,
  `snapshot`     LONGTEXT        NOT NULL COMMENT 'Full page+sections+blocks JSON',
  `change_note`  VARCHAR(500)    NULL,
  `created_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `page_revisions_page_id_index`   (`page_id`),
  INDEX `page_revisions_author_id_index` (`author_id`),
  CONSTRAINT `fk_pr_page_id`
    FOREIGN KEY (`page_id`)   REFERENCES `pages`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pr_author_id`
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6.4  page_sections
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `page_sections` (
  `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id`         BIGINT UNSIGNED NOT NULL,
  `bg_image_id`     BIGINT UNSIGNED NULL,
  `name`            VARCHAR(191)    NULL     COMMENT 'Admin identifier label',
  `layout`          VARCHAR(100)    NOT NULL DEFAULT 'full'
                    COMMENT 'full | two-col | three-col | four-col | sidebar-left | sidebar-right',
  `bg_color`        VARCHAR(50)     NULL,
  `bg_type`         ENUM('color','image','gradient','video','none')
                    NOT NULL DEFAULT 'none',
  `bg_gradient`     VARCHAR(500)    NULL,
  `bg_video_url`    VARCHAR(500)    NULL,
  `padding_top`     INT             NOT NULL DEFAULT 60,
  `padding_bottom`  INT             NOT NULL DEFAULT 60,
  `padding_left`    INT             NOT NULL DEFAULT 0,
  `padding_right`   INT             NOT NULL DEFAULT 0,
  `css_class`       VARCHAR(255)    NULL,
  `css_id`          VARCHAR(100)    NULL,
  `sort_order`      INT             NOT NULL DEFAULT 0,
  `is_active`       TINYINT(1)      NOT NULL DEFAULT 1,
  `full_width`      TINYINT(1)      NOT NULL DEFAULT 0
                    COMMENT 'Break out of container',
  `container_width` VARCHAR(50)     NULL DEFAULT 'default'
                    COMMENT 'default | wide | narrow | full',
  `created_at`      TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `page_sections_page_id_index`       (`page_id`),
  INDEX `page_sections_sort_order_index`    (`page_id`, `sort_order`),
  INDEX `page_sections_is_active_index`     (`is_active`),
  CONSTRAINT `fk_ps_page_id`
    FOREIGN KEY (`page_id`)     REFERENCES `pages`(`id`)  ON DELETE CASCADE,
  CONSTRAINT `fk_ps_bg_image_id`
    FOREIGN KEY (`bg_image_id`) REFERENCES `media`(`id`)  ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6.5  page_blocks
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `page_blocks` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id`    BIGINT UNSIGNED NOT NULL,
  `block_type_id` BIGINT UNSIGNED NOT NULL,
  `column`        TINYINT UNSIGNED NOT NULL DEFAULT 1
                  COMMENT 'Column slot within the section layout',
  `props`         JSON            NULL      COMMENT 'Block configuration JSON',
  `cache_key`     VARCHAR(255)    NULL      COMMENT 'For granular block cache invalidation',
  `sort_order`    INT             NOT NULL DEFAULT 0,
  `is_active`     TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `page_blocks_section_id_index`    (`section_id`),
  INDEX `page_blocks_block_type_id_index` (`block_type_id`),
  INDEX `page_blocks_sort_order_index`    (`section_id`, `sort_order`),
  INDEX `page_blocks_is_active_index`     (`is_active`),
  CONSTRAINT `fk_pb_section_id`
    FOREIGN KEY (`section_id`)    REFERENCES `page_sections`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pb_block_type_id`
    FOREIGN KEY (`block_type_id`) REFERENCES `block_types`(`id`)   ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 7: CONTENT MANAGEMENT SYSTEM
-- ============================================================

-- ------------------------------------------------------------
-- 7.1  content_categories
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `content_categories` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id`   BIGINT UNSIGNED NULL,
  `name`        VARCHAR(191)    NOT NULL,
  `slug`        VARCHAR(255)    NOT NULL,
  `description` TEXT            NULL,
  `image_id`    BIGINT UNSIGNED NULL,
  `color`       VARCHAR(50)     NULL,
  `sort_order`  INT             NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_categories_slug_unique` (`slug`),
  INDEX `content_categories_parent_id_index` (`parent_id`),
  CONSTRAINT `fk_cc_parent_id`
    FOREIGN KEY (`parent_id`) REFERENCES `content_categories`(`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_cc_image_id`
    FOREIGN KEY (`image_id`)  REFERENCES `media`(`id`)              ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7.2  content_tags
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `content_tags` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(191)    NOT NULL,
  `slug`       VARCHAR(255)    NOT NULL,
  `color`      VARCHAR(50)     NULL,
  `created_at` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7.3  content_posts
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `content_posts` (
  `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id`         BIGINT UNSIGNED NOT NULL,
  `category_id`       BIGINT UNSIGNED NULL,
  `featured_image_id` BIGINT UNSIGNED NULL,
  `title`             VARCHAR(500)    NOT NULL,
  `slug`              VARCHAR(500)    NOT NULL,
  `excerpt`           TEXT            NULL,
  `content`           LONGTEXT        NULL     COMMENT 'Sanitized HTML from CKEditor 5',
  `content_type`      ENUM('post','announcement','news','event','custom')
                      NOT NULL DEFAULT 'post',
  `status`            ENUM('draft','review','published','scheduled','archived')
                      NOT NULL DEFAULT 'draft',
  `is_featured`       TINYINT(1)      NOT NULL DEFAULT 0,
  `is_sticky`         TINYINT(1)      NOT NULL DEFAULT 0
                      COMMENT 'Pin to top of listing',
  `allow_comments`    TINYINT(1)      NOT NULL DEFAULT 1,
  `meta_title`        VARCHAR(255)    NULL,
  `meta_description`  TEXT            NULL,
  `meta_keywords`     VARCHAR(500)    NULL,
  `views_count`       BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `event_start_at`    TIMESTAMP       NULL     COMMENT 'For event type posts',
  `event_end_at`      TIMESTAMP       NULL,
  `event_location`    VARCHAR(500)    NULL,
  `expires_at`        TIMESTAMP       NULL     COMMENT 'Auto-archive after this date',
  `published_at`      TIMESTAMP       NULL,
  `created_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at`        TIMESTAMP       NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_posts_slug_unique`       (`slug`),
  INDEX `content_posts_author_id_index`        (`author_id`),
  INDEX `content_posts_category_id_index`      (`category_id`),
  INDEX `content_posts_status_index`           (`status`),
  INDEX `content_posts_content_type_index`     (`content_type`),
  INDEX `content_posts_is_featured_index`      (`is_featured`),
  INDEX `content_posts_published_at_index`     (`published_at`),
  INDEX `content_posts_expires_at_index`       (`expires_at`),
  INDEX `content_posts_deleted_at_index`       (`deleted_at`),
  FULLTEXT INDEX `content_posts_fulltext`      (`title`, `excerpt`, `content`),
  CONSTRAINT `fk_cp_author_id`
    FOREIGN KEY (`author_id`)         REFERENCES `users`(`id`)               ON DELETE RESTRICT,
  CONSTRAINT `fk_cp_category_id`
    FOREIGN KEY (`category_id`)       REFERENCES `content_categories`(`id`)  ON DELETE SET NULL,
  CONSTRAINT `fk_cp_featured_image_id`
    FOREIGN KEY (`featured_image_id`) REFERENCES `media`(`id`)               ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7.4  content_post_tags  (pivot)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `content_post_tags` (
  `post_id` BIGINT UNSIGNED NOT NULL,
  `tag_id`  BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  CONSTRAINT `fk_cpt_post_id`
    FOREIGN KEY (`post_id`) REFERENCES `content_posts`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cpt_tag_id`
    FOREIGN KEY (`tag_id`)  REFERENCES `content_tags`(`id`)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7.5  content_comments
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `content_comments` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id`     BIGINT UNSIGNED NOT NULL,
  `parent_id`   BIGINT UNSIGNED NULL     COMMENT 'Threaded replies',
  `user_id`     BIGINT UNSIGNED NULL     COMMENT 'NULL = guest comment',
  `author_name` VARCHAR(191)    NULL     COMMENT 'Guest display name',
  `author_email`VARCHAR(191)    NULL,
  `content`     TEXT            NOT NULL,
  `status`      ENUM('pending','approved','spam','rejected')
                NOT NULL DEFAULT 'pending',
  `ip_address`  VARCHAR(45)     NULL,
  `user_agent`  TEXT            NULL,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `content_comments_post_id_index`   (`post_id`),
  INDEX `content_comments_parent_id_index` (`parent_id`),
  INDEX `content_comments_user_id_index`   (`user_id`),
  INDEX `content_comments_status_index`    (`status`),
  CONSTRAINT `fk_cco_post_id`
    FOREIGN KEY (`post_id`)   REFERENCES `content_posts`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cco_parent_id`
    FOREIGN KEY (`parent_id`) REFERENCES `content_comments`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cco_user_id`
    FOREIGN KEY (`user_id`)   REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 8: NAVIGATION MENUS
-- ============================================================

-- ------------------------------------------------------------
-- 8.1  nav_menus
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `nav_menus` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(191)    NOT NULL COMMENT 'primary | footer | mobile | top-bar',
  `label`       VARCHAR(191)    NOT NULL,
  `description` TEXT            NULL,
  `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nav_menus_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 8.2  nav_menu_items
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `nav_menu_items` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id`      BIGINT UNSIGNED NOT NULL,
  `parent_id`    BIGINT UNSIGNED NULL     COMMENT 'Nested/dropdown support',
  `page_id`      BIGINT UNSIGNED NULL     COMMENT 'Internal page link',
  `post_id`      BIGINT UNSIGNED NULL     COMMENT 'Internal post link',
  `label`        VARCHAR(191)    NOT NULL,
  `url`          VARCHAR(500)    NULL     COMMENT 'External or custom URL',
  `target`       ENUM('_self','_blank')   NOT NULL DEFAULT '_self',
  `icon`         VARCHAR(100)    NULL     COMMENT 'Icon class or SVG identifier',
  `css_class`    VARCHAR(255)    NULL,
  `rel`          VARCHAR(100)    NULL     COMMENT 'nofollow, noopener, etc.',
  `sort_order`   INT             NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `nav_menu_items_menu_id_index`   (`menu_id`),
  INDEX `nav_menu_items_parent_id_index` (`parent_id`),
  INDEX `nav_menu_items_page_id_index`   (`page_id`),
  INDEX `nav_menu_items_sort_index`      (`menu_id`, `parent_id`, `sort_order`),
  CONSTRAINT `fk_nmi_menu_id`
    FOREIGN KEY (`menu_id`)   REFERENCES `nav_menus`(`id`)      ON DELETE CASCADE,
  CONSTRAINT `fk_nmi_parent_id`
    FOREIGN KEY (`parent_id`) REFERENCES `nav_menu_items`(`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_nmi_page_id`
    FOREIGN KEY (`page_id`)   REFERENCES `pages`(`id`)          ON DELETE SET NULL,
  CONSTRAINT `fk_nmi_post_id`
    FOREIGN KEY (`post_id`)   REFERENCES `content_posts`(`id`)  ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 9: SETTINGS & CONFIGURATION
-- ============================================================

-- ------------------------------------------------------------
-- 9.1  configurations
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `configurations` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `group`       VARCHAR(100)    NOT NULL
                COMMENT 'general | seo | mail | social | analytics | features | security',
  `key`         VARCHAR(191)    NOT NULL,
  `value`       LONGTEXT        NULL,
  `type`        ENUM('string','boolean','integer','float','json','encrypted','text','url','email','color')
                NOT NULL DEFAULT 'string',
  `is_public`   TINYINT(1)      NOT NULL DEFAULT 0
                COMMENT 'Whether safe to expose in public API',
  `is_locked`   TINYINT(1)      NOT NULL DEFAULT 0
                COMMENT 'Cannot be changed via admin UI',
  `label`       VARCHAR(255)    NULL,
  `description` TEXT            NULL     COMMENT 'Help text for admin UI',
  `sort_order`  INT             NOT NULL DEFAULT 0,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configurations_group_key_unique` (`group`, `key`),
  INDEX `configurations_group_index`     (`group`),
  INDEX `configurations_is_public_index` (`is_public`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 10: PLUGIN / EXTENSION SYSTEM
-- ============================================================

-- ------------------------------------------------------------
-- 10.1  plugins
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `plugins` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(191)    NOT NULL COMMENT 'Package slug: my-vendor/my-plugin',
  `label`         VARCHAR(191)    NOT NULL,
  `description`   TEXT            NULL,
  `version`       VARCHAR(20)     NOT NULL,
  `author`        VARCHAR(191)    NULL,
  `author_url`    VARCHAR(500)    NULL,
  `homepage_url`  VARCHAR(500)    NULL,
  `icon`          VARCHAR(500)    NULL,
  `requires`      JSON            NULL     COMMENT 'Dependency map',
  `entry_class`   VARCHAR(255)    NOT NULL COMMENT 'ServiceProvider class path',
  `manifest`      JSON            NULL     COMMENT 'Full plugin.json contents',
  `status`        ENUM('active','inactive','error','incompatible')
                  NOT NULL DEFAULT 'inactive',
  `error_message` TEXT            NULL,
  `installed_at`  TIMESTAMP       NULL,
  `activated_at`  TIMESTAMP       NULL,
  `created_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plugins_name_unique` (`name`),
  INDEX `plugins_status_index`     (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 10.2  plugin_settings
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `plugin_settings` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `plugin_id`  BIGINT UNSIGNED NOT NULL,
  `key`        VARCHAR(191)    NOT NULL,
  `value`      TEXT            NULL,
  `type`       ENUM('string','boolean','integer','json','encrypted')
               NOT NULL DEFAULT 'string',
  `created_at` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plugin_settings_plugin_key_unique` (`plugin_id`, `key`),
  CONSTRAINT `fk_plgs_plugin_id`
    FOREIGN KEY (`plugin_id`) REFERENCES `plugins`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 11: FORMS & SUBMISSIONS
-- ============================================================

-- ------------------------------------------------------------
-- 11.1  forms
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `forms` (
  `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`              VARCHAR(191)    NOT NULL,
  `slug`              VARCHAR(255)    NOT NULL,
  `description`       TEXT            NULL,
  `fields`            JSON            NOT NULL COMMENT 'Field definitions array',
  `recipient_emails`  JSON            NULL     COMMENT 'Array of notification email addresses',
  `success_message`   TEXT            NULL,
  `redirect_url`      VARCHAR(500)    NULL,
  `is_active`         TINYINT(1)      NOT NULL DEFAULT 1,
  `recaptcha_enabled` TINYINT(1)      NOT NULL DEFAULT 0,
  `honeypot_enabled`  TINYINT(1)      NOT NULL DEFAULT 1,
  `submissions_count` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 11.2  form_submissions
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `form_submissions` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id`     BIGINT UNSIGNED NOT NULL,
  `data`        JSON            NOT NULL COMMENT 'Submitted field values',
  `ip_address`  VARCHAR(45)     NULL,
  `user_agent`  TEXT            NULL,
  `referrer`    VARCHAR(500)    NULL,
  `status`      ENUM('new','read','archived','spam')
                NOT NULL DEFAULT 'new',
  `read_at`     TIMESTAMP       NULL,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `form_submissions_form_id_index` (`form_id`),
  INDEX `form_submissions_status_index`  (`status`),
  CONSTRAINT `fk_fs_form_id`
    FOREIGN KEY (`form_id`) REFERENCES `forms`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 12: AUDIT & ACTIVITY LOG
-- ============================================================

-- ------------------------------------------------------------
-- 12.1  activity_log  (Spatie ActivityLog compatible)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name`     VARCHAR(191)    NULL     DEFAULT 'default',
  `description`  TEXT            NOT NULL,
  `subject_type` VARCHAR(191)    NULL,
  `event`        VARCHAR(191)    NULL,
  `subject_id`   BIGINT UNSIGNED NULL,
  `causer_type`  VARCHAR(191)    NULL,
  `causer_id`    BIGINT UNSIGNED NULL,
  `properties`   JSON            NULL,
  `batch_uuid`   CHAR(36)        NULL,
  `created_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `activity_log_log_name_index`       (`log_name`),
  INDEX `activity_log_subject_index`        (`subject_type`, `subject_id`),
  INDEX `activity_log_causer_index`         (`causer_type`,  `causer_id`),
  INDEX `activity_log_event_index`          (`event`),
  INDEX `activity_log_created_at_index`     (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 13: NOTIFICATIONS
-- ============================================================

-- ------------------------------------------------------------
-- 13.1  notifications  (Laravel standard)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `notifications` (
  `id`             CHAR(36)         NOT NULL,
  `type`           VARCHAR(255)     NOT NULL,
  `notifiable_type`VARCHAR(255)     NOT NULL,
  `notifiable_id`  BIGINT UNSIGNED  NOT NULL,
  `data`           TEXT             NOT NULL,
  `read_at`        TIMESTAMP        NULL,
  `created_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `notifications_notifiable_index` (`notifiable_type`, `notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 14: REDIRECTS & SEO
-- ============================================================

-- ------------------------------------------------------------
-- 14.1  redirects
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `redirects` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_url`    VARCHAR(500)    NOT NULL,
  `to_url`      VARCHAR(500)    NOT NULL,
  `type`        SMALLINT        NOT NULL DEFAULT 301
                COMMENT '301 Permanent | 302 Temporary',
  `hit_count`   BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
  `note`        VARCHAR(255)    NULL,
  `created_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `redirects_from_url_index` (`from_url`(191)),
  INDEX `redirects_is_active_index`(`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  SECTION 15: SEED DATA
--  Essential bootstrap records for a working installation
-- ============================================================

-- Roles
INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `description`) VALUES
  (1, 'super_admin', 'web', 'Super Administrator', 'Full unrestricted access to all platform features.'),
  (2, 'admin',       'web', 'Administrator',       'Site configuration, theme management, user management.'),
  (3, 'editor',      'web', 'Editor',              'Create, edit, and publish content across the platform.'),
  (4, 'contributor', 'web', 'Contributor',         'Create and edit own content. Requires editor approval.'),
  (5, 'viewer',      'web', 'Viewer',              'Read-only access to admin panel.');

-- Permissions
INSERT INTO `permissions` (`name`, `guard_name`, `group`, `display_name`) VALUES
  -- Theme
  ('theme.view',        'web', 'themes',   'View Themes'),
  ('theme.create',      'web', 'themes',   'Create Themes'),
  ('theme.edit',        'web', 'themes',   'Edit Theme Settings'),
  ('theme.delete',      'web', 'themes',   'Delete Themes'),
  ('theme.activate',    'web', 'themes',   'Activate Theme'),
  -- Pages
  ('page.view',         'web', 'pages',    'View Pages'),
  ('page.create',       'web', 'pages',    'Create Pages'),
  ('page.edit',         'web', 'pages',    'Edit Pages'),
  ('page.delete',       'web', 'pages',    'Delete Pages'),
  ('page.publish',      'web', 'pages',    'Publish Pages'),
  -- Content
  ('content.view',      'web', 'content',  'View Content'),
  ('content.create',    'web', 'content',  'Create Content'),
  ('content.edit',      'web', 'content',  'Edit Content'),
  ('content.delete',    'web', 'content',  'Delete Content'),
  ('content.publish',   'web', 'content',  'Publish Content'),
  -- Media
  ('media.view',        'web', 'media',    'View Media Library'),
  ('media.upload',      'web', 'media',    'Upload Media'),
  ('media.delete',      'web', 'media',    'Delete Media'),
  -- Settings
  ('settings.view',     'web', 'settings', 'View Settings'),
  ('settings.edit',     'web', 'settings', 'Edit Settings'),
  ('settings.system',   'web', 'settings', 'Edit System Settings'),
  -- Users
  ('users.view',        'web', 'users',    'View Users'),
  ('users.create',      'web', 'users',    'Create Users'),
  ('users.edit',        'web', 'users',    'Edit Users'),
  ('users.delete',      'web', 'users',    'Delete Users'),
  ('users.assign_roles','web', 'users',    'Assign Roles'),
  -- Navigation
  ('nav.view',          'web', 'navigation','View Navigation Menus'),
  ('nav.edit',          'web', 'navigation','Edit Navigation Menus'),
  -- Plugins
  ('plugins.view',      'web', 'plugins',  'View Plugins'),
  ('plugins.manage',    'web', 'plugins',  'Install/Activate Plugins');

-- Assign all permissions to super_admin
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
  SELECT `id`, 1 FROM `permissions`;

-- Assign standard admin permissions
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
  SELECT `id`, 2 FROM `permissions`
  WHERE `name` NOT IN ('settings.system','plugins.manage','users.delete');

-- Assign editor permissions
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
  SELECT `id`, 3 FROM `permissions`
  WHERE `group` IN ('pages','content','media','navigation')
  AND `name` NOT IN ('page.delete');

-- Assign contributor permissions
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
  SELECT `id`, 4 FROM `permissions`
  WHERE `name` IN ('page.view','page.create','page.edit','content.view','content.create','content.edit','media.view','media.upload');

-- Assign viewer permissions
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
  SELECT `id`, 5 FROM `permissions`
  WHERE `name` LIKE '%.view';

-- Default themes
INSERT INTO `themes` (`name`, `label`, `description`, `is_active`, `is_default`, `is_system`, `version`) VALUES
  ('corporate',  'Corporate Blue',      'Professional corporate website theme with clean lines and a blue palette.', 1, 1, 1, '1.0.0'),
  ('academic',   'Academic Portal',     'University and school-oriented theme with navigation-heavy layout.',        0, 0, 1, '1.0.0'),
  ('minimal',    'Minimal Clean',       'Lightweight, whitespace-driven theme for marketing landing pages.',         0, 0, 1, '1.0.0');

-- Corporate theme settings
INSERT INTO `theme_settings` (`theme_id`, `key`, `value`, `type`, `group`, `label`, `sort_order`) VALUES
  (1, 'primary_color',    '#1E3A5F', 'color',  'colors',     'Primary Color',      1),
  (1, 'secondary_color',  '#2E86AB', 'color',  'colors',     'Secondary Color',    2),
  (1, 'accent_color',     '#F4A261', 'color',  'colors',     'Accent Color',       3),
  (1, 'background_color', '#FFFFFF', 'color',  'colors',     'Background Color',   4),
  (1, 'text_color',       '#1A1A2E', 'color',  'colors',     'Text Color',         5),
  (1, 'heading_font',     'Playfair Display','font','typography','Heading Font',   1),
  (1, 'body_font',        'DM Sans', 'font',   'typography', 'Body Font',          2),
  (1, 'base_font_size',   '16px',    'string', 'typography', 'Base Font Size',     3),
  (1, 'layout_type',      'boxed',   'select', 'layout',     'Layout Type',        1),
  (1, 'container_width',  '1280',    'integer','layout',     'Container Width (px)',2),
  (1, 'header_style',     'fixed',   'select', 'layout',     'Header Style',       3),
  (1, 'nav_style',        'horizontal','select','navigation','Navigation Style',   1),
  (1, 'footer_columns',   '3',       'integer','layout',     'Footer Columns',     4),
  (1, 'border_radius',    '8px',     'string', 'layout',     'Border Radius',      5);

-- Default block types
INSERT INTO `block_types` (`name`, `label`, `category`, `icon`, `description`, `schema`, `default_props`, `renderer_class`, `sort_order`) VALUES
  ('HeroBlock',        'Hero Banner',      'content', 'hero',       'Full-width hero section with title, subtitle and CTA.',
   '{"type":"object","properties":{"title":{"type":"string"},"subtitle":{"type":"string"},"bg_image_id":{"type":"integer"},"cta_text":{"type":"string"},"cta_url":{"type":"string"},"overlay_opacity":{"type":"number","minimum":0,"maximum":1}}}',
   '{"title":"Welcome to Our Website","subtitle":"We are glad you are here.","overlay_opacity":0.4,"cta_text":"Get Started","cta_url":"/contact"}',
   'App\\Blocks\\HeroBlockRenderer', 1),
  ('TextBlock',        'Rich Text',        'content', 'text',       'Rich text content block using CKEditor 5.',
   '{"type":"object","properties":{"content":{"type":"string"},"alignment":{"type":"string","enum":["left","center","right","justify"]}}}',
   '{"content":"<p>Enter your content here.</p>","alignment":"left"}',
   'App\\Blocks\\TextBlockRenderer', 2),
  ('ImageBlock',       'Image',            'media',   'image',      'Responsive image with optional caption.',
   '{"type":"object","properties":{"media_id":{"type":"integer"},"alt_text":{"type":"string"},"caption":{"type":"string"},"alignment":{"type":"string"}}}',
   '{"alignment":"center"}',
   'App\\Blocks\\ImageBlockRenderer', 3),
  ('VideoBlock',       'Video Embed',      'media',   'video',      'Embed YouTube, Vimeo, or self-hosted video.',
   '{"type":"object","properties":{"video_url":{"type":"string","format":"uri"},"autoplay":{"type":"boolean"},"muted":{"type":"boolean"},"loop":{"type":"boolean"}}}',
   '{"autoplay":false,"muted":false,"loop":false}',
   'App\\Blocks\\VideoBlockRenderer', 4),
  ('CardGridBlock',    'Card Grid',        'content', 'grid',       'Grid of feature or info cards.',
   '{"type":"object","properties":{"cards":{"type":"array"},"columns":{"type":"integer","minimum":1,"maximum":4},"style":{"type":"string"}}}',
   '{"columns":3,"style":"default","cards":[]}',
   'App\\Blocks\\CardGridBlockRenderer', 5),
  ('TestimonialBlock', 'Testimonials',     'content', 'quote',      'Customer or staff testimonial cards.',
   '{"type":"object","properties":{"testimonials":{"type":"array"},"layout":{"type":"string","enum":["slider","grid"]}}}',
   '{"layout":"grid","testimonials":[]}',
   'App\\Blocks\\TestimonialBlockRenderer', 6),
  ('ContactFormBlock', 'Contact Form',     'form',    'form',       'Dynamic configurable contact form.',
   '{"type":"object","properties":{"form_id":{"type":"integer"},"success_message":{"type":"string"}}}',
   '{"success_message":"Thank you! We will be in touch soon."}',
   'App\\Blocks\\ContactFormBlockRenderer', 7),
  ('AccordionBlock',   'Accordion / FAQ',  'content', 'accordion',  'Collapsible question and answer sections.',
   '{"type":"object","properties":{"items":{"type":"array"},"allow_multiple":{"type":"boolean"}}}',
   '{"allow_multiple":false,"items":[]}',
   'App\\Blocks\\AccordionBlockRenderer', 8),
  ('GalleryBlock',     'Photo Gallery',    'media',   'gallery',    'Image grid or lightbox gallery.',
   '{"type":"object","properties":{"media_ids":{"type":"array"},"columns":{"type":"integer"},"lightbox_enabled":{"type":"boolean"}}}',
   '{"columns":3,"lightbox_enabled":true,"media_ids":[]}',
   'App\\Blocks\\GalleryBlockRenderer', 9),
  ('CTABlock',         'Call to Action',   'content', 'cta',        'Prominent call-to-action banner strip.',
   '{"type":"object","properties":{"headline":{"type":"string"},"description":{"type":"string"},"button_text":{"type":"string"},"button_url":{"type":"string"},"bg_color":{"type":"string"}}}',
   '{"headline":"Ready to get started?","button_text":"Contact Us","button_url":"/contact"}',
   'App\\Blocks\\CTABlockRenderer', 10),
  ('SeparatorBlock',   'Section Divider',  'layout',  'separator',  'Visual divider between sections.',
   '{"type":"object","properties":{"style":{"type":"string","enum":["line","wave","dots","none"]},"spacing":{"type":"string"}}}',
   '{"style":"line","spacing":"md"}',
   'App\\Blocks\\SeparatorBlockRenderer', 11),
  ('StaffGridBlock',   'Staff Profiles',   'content', 'people',     'Grid of team member cards with photo, name, and role.',
   '{"type":"object","properties":{"staff":{"type":"array"},"columns":{"type":"integer"}}}',
   '{"columns":3,"staff":[]}',
   'App\\Blocks\\StaffGridBlockRenderer', 12),
  ('MapBlock',         'Map Embed',        'embed',   'map',        'Embed Google Maps or OpenStreetMap location.',
   '{"type":"object","properties":{"lat":{"type":"number"},"lng":{"type":"number"},"zoom":{"type":"integer"},"address_label":{"type":"string"}}}',
   '{"zoom":15}',
   'App\\Blocks\\MapBlockRenderer', 13),
  ('CounterBlock',     'Stats Counter',    'content', 'counter',    'Animated number statistics strip.',
   '{"type":"object","properties":{"stats":{"type":"array"},"animate":{"type":"boolean"}}}',
   '{"animate":true,"stats":[]}',
   'App\\Blocks\\CounterBlockRenderer', 14),
  ('NewsGridBlock',    'News / Blog Grid', 'content', 'news',       'Dynamic grid pulling latest content posts.',
   '{"type":"object","properties":{"category_id":{"type":"integer"},"limit":{"type":"integer"},"layout":{"type":"string"}}}',
   '{"limit":6,"layout":"grid"}',
   'App\\Blocks\\NewsGridBlockRenderer', 15);

-- Default navigation menus
INSERT INTO `nav_menus` (`name`, `label`, `description`) VALUES
  ('primary', 'Primary Navigation', 'Main top navigation menu displayed in the site header.'),
  ('footer',  'Footer Navigation',  'Links displayed in the website footer.'),
  ('mobile',  'Mobile Navigation',  'Hamburger menu for mobile viewports.'),
  ('top_bar', 'Top Bar',            'Optional slim top bar above the header.');

-- Default site configurations
INSERT INTO `configurations` (`group`, `key`, `value`, `type`, `is_public`, `label`, `description`, `sort_order`) VALUES
  -- General
  ('general', 'site_name',           'Slack Website',          'string',  1, 'Site Name',           'Displayed in browser tab and header logo area.',         1),
  ('general', 'site_tagline',        'Built with Laravel',     'string',  1, 'Site Tagline',        'Short tagline shown in hero sections and metadata.',      2),
  ('general', 'site_description',    '',                       'text',    1, 'Site Description',    'Default meta description for the homepage.',              3),
  ('general', 'contact_email',       'admin@example.com',      'email',   0, 'Contact Email',       'Primary contact address used by contact forms.',          4),
  ('general', 'contact_phone',       '',                       'string',  1, 'Contact Phone',       'Phone number shown in footer and contact section.',       5),
  ('general', 'contact_address',     '',                       'text',    1, 'Physical Address',    'Street address for map blocks and footer.',               6),
  ('general', 'logo_image_id',       NULL,                     'integer', 1, 'Logo Image',          'Media ID of the site logo.',                             7),
  ('general', 'favicon_image_id',    NULL,                     'integer', 1, 'Favicon Image',       'Media ID of the browser favicon.',                       8),
  ('general', 'timezone',            'Africa/Dar_es_Salaam',   'string',  0, 'Timezone',            'Application timezone.',                                  9),
  ('general', 'date_format',         'd M Y',                  'string',  1, 'Date Format',         'PHP date format string.',                                10),
  -- SEO
  ('seo',     'meta_title_format',   '%s | {site_name}',       'string',  0, 'Meta Title Format',   'Use %s for page title, {site_name} for site name.',      1),
  ('seo',     'default_meta_desc',   '',                       'text',    0, 'Default Meta Desc',   'Fallback meta description when page has none.',          2),
  ('seo',     'google_analytics_id', '',                       'string',  0, 'Google Analytics ID', 'G-XXXXXXXXXX format for GA4.',                           3),
  ('seo',     'google_tag_manager',  '',                       'string',  0, 'Google Tag Manager',  'GTM-XXXXXXX container ID.',                              4),
  ('seo',     'robots_txt',          "User-agent: *\nAllow: /", 'text',   0, 'robots.txt Content',  'Content served at /robots.txt.',                         5),
  ('seo',     'sitemap_enabled',     '1',                      'boolean', 0, 'Sitemap Enabled',     'Auto-generate and serve sitemap.xml.',                   6),
  -- Mail
  ('mail',    'from_name',           'Slack Website',          'string',  0, 'From Name',           'Display name for outgoing emails.',                      1),
  ('mail',    'from_address',        'noreply@example.com',    'email',   0, 'From Address',        'Sender address for outgoing emails.',                    2),
  ('mail',    'reply_to',            '',                       'email',   0, 'Reply-To',            'Optional reply-to address.',                             3),
  -- Social
  ('social',  'facebook_url',        '',                       'url',     1, 'Facebook URL',        'Full URL of the Facebook page.',                         1),
  ('social',  'twitter_handle',      '',                       'string',  1, 'Twitter Handle',      '@handle without the @ symbol.',                          2),
  ('social',  'instagram_url',       '',                       'url',     1, 'Instagram URL',       '',                                                       3),
  ('social',  'linkedin_url',        '',                       'url',     1, 'LinkedIn URL',        '',                                                       4),
  ('social',  'youtube_url',         '',                       'url',     1, 'YouTube URL',         '',                                                       5),
  -- Features / Feature Toggles
  ('features','blog_enabled',        '1',                      'boolean', 0, 'Blog Module',         'Enable or disable the blog/news section.',               1),
  ('features','comments_enabled',    '1',                      'boolean', 0, 'Comments',            'Allow visitors to leave comments on posts.',             2),
  ('features','contact_form_enabled','1',                      'boolean', 0, 'Contact Form',        'Enable or disable the contact form.',                    3),
  ('features','search_enabled',      '1',                      'boolean', 0, 'Site Search',         'Enable the public site search functionality.',           4),
  ('features','maintenance_mode',    '0',                      'boolean', 0, 'Maintenance Mode',    'Show maintenance page to visitors.',                     5),
  ('features','registration_enabled','0',                      'boolean', 0, 'Public Registration', 'Allow visitors to register for accounts.',               6),
  -- Security
  ('security','recaptcha_site_key',  '',                       'string',  0, 'reCAPTCHA Site Key',  'Google reCAPTCHA v3 site key.',                          1),
  ('security','recaptcha_secret_key','',                       'encrypted',0,'reCAPTCHA Secret Key','Google reCAPTCHA v3 secret key.',                         2),
  ('security','max_login_attempts',  '5',                      'integer', 0, 'Max Login Attempts',  'Login attempts before lockout (per minute).',            3);

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
--  END OF SCHEMA  —  slack_website
--  Tables: 34 | Indexes: 90+ | FK Constraints: 40+
--  Laravel 12 · MySQL 8.0+ · InnoDB · utf8mb4
-- ============================================================
