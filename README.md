## About Laravel-base

Terimaksih kepada Allah SWT.
Aplikasi ini dibuat untuk mempermudah pembuatan aplikasi, dengan menghadirkan fitur roles dan permission, app setting, user management.
dan telah terinstall admin template.

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## How To Install

#1 Clone Repository

```bash
git clone https://github.com/FarhanRiuzaki/laravel-base-v2.git
cp .env.example .env
```
#2 Open .ENV

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=database_name 
DB_USERNAME=root 
DB_PASSWORD=password
```

#3 Database

- create database
- create apps table

```bash
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for apps
-- ----------------------------
DROP TABLE IF EXISTS `apps`;
CREATE TABLE `apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

```

#4 Artisan

```bash
composer install 
php artisan migrate
```
#5 RUN IN SQL

```bash

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Records of roles
-- ----------------------------
-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'Admin', 'web', '2020-02-11 09:51:38', '2020-02-11 09:51:38');
INSERT INTO `roles` VALUES (6, 'User', 'web', '2020-02-11 11:23:50', '2020-02-11 11:23:50');
INSERT INTO `roles` VALUES (99, 'super-admin', 'web', '2020-02-11 15:03:43', '2020-02-11 15:03:43');
COMMIT;


-- ----------------------------
-- Records of apps
-- ----------------------------
BEGIN;
INSERT INTO `apps` VALUES (2, 'BASE APP', 'Exsclusive Dashboard', '1583207480laravel-base.jpg', '1584503138laravel-base.png', '1584503139laravel-base.png', 'dark', '2020-02-08 21:32:08', NULL, '2020-03-24 13:05:26', 5);
COMMIT;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
BEGIN;
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 2);
INSERT INTO `model_has_roles` VALUES (99, 'App\\User', 5);
COMMIT;


-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'apps-show', 'web', '2020-02-11 14:38:29', '2020-02-11 14:38:29');
INSERT INTO `permissions` VALUES (2, 'role-show', 'web', '2020-02-11 14:38:39', '2020-02-11 14:38:39');
INSERT INTO `permissions` VALUES (3, 'role permission-show', 'web', '2020-02-11 14:38:50', '2020-02-11 14:38:50');
INSERT INTO `permissions` VALUES (4, 'users-show', 'web', '2020-02-11 14:38:59', '2020-02-11 14:38:59');
COMMIT;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (1, 99);
INSERT INTO `role_has_permissions` VALUES (2, 99);
INSERT INTO `role_has_permissions` VALUES (3, 99);
INSERT INTO `role_has_permissions` VALUES (4, 99);
COMMIT;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (2, 'Administrator', '000', 'admin@email.com', NULL, '$2y$10$iT79gWz9IU7QuG/wxuhNteROMwb1s9o3yVZREWC.KbB5DOZNUVW8i', 1, NULL, '2020-02-11 11:51:29', NULL, '2020-02-11 11:51:29', NULL);
INSERT INTO `users` VALUES (5, 'Farhan Riuzaki', '000', 'admin@gmail.com', NULL, '$2y$10$Jn7jqNPLzI2As3cBehD61ORDUYRUnNo2lQrBjiBDyLrZlUv3M0LaC', 1, NULL, '2020-02-11 13:24:40', NULL, '2020-02-11 13:24:40', NULL);
COMMIT;
```

#6 Add key generate
```bash
php artisan key:generate
```

#7 link storage

```bash
php artisan storage:link
```

user untuk login:
```bash
    username: admin@gmail.com
    password: admin123
```

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [riuzakif@gmail.com](mailto:riuzakif@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
