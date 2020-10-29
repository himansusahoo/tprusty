-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2020 at 04:55 PM
-- Server version: 10.2.34-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_prusty`
--

-- --------------------------------------------------------

--
-- Table structure for table `rbac_actions`
--

CREATE TABLE `rbac_actions` (
  `action_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `code` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_actions`
--

INSERT INTO `rbac_actions` (`action_id`, `name`, `status`, `created`, `modified`, `code`) VALUES
(1, 'create', 'active', '2018-10-25 17:38:32', NULL, 'CREATE'),
(2, 'edit', 'active', '2018-10-25 17:38:56', NULL, 'EDIT'),
(3, 'view', 'active', '2018-10-25 17:39:03', NULL, 'VIEW'),
(4, 'delete', 'active', '2018-10-25 17:39:11', NULL, 'DELETE'),
(5, 'List', 'active', '2018-10-25 17:39:24', NULL, 'LIST'),
(6, 'Assign Module Permissions', 'active', '2018-10-25 20:41:17', NULL, 'ASSIGN_MODULE_PERMISSIONS'),
(7, 'Assign Role Permissions', 'active', '2018-10-25 20:45:32', NULL, 'ASSIGN_ROLE_PERMISSIONS'),
(9, 'Export as Excel', 'active', '2018-11-09 00:12:42', NULL, 'XLS_EXPORT'),
(10, 'Export as CSV', 'active', '2018-11-09 00:13:02', NULL, 'CSV_EXPORT'),
(11, 'Export as PDF', 'active', '2018-11-09 00:15:15', NULL, 'PDF_EXPORT'),
(13, 'set_app_config', 'active', '2019-02-02 12:00:58', NULL, 'SET_APP_CONFIG'),
(14, 'Employee Upload Utility', 'active', '2019-02-14 13:46:37', NULL, 'EMPLOYEE_UPLOAD_UTILTIY'),
(16, 'Print', 'active', '2019-02-24 17:19:36', NULL, 'PRINT'),
(17, 'Generate QR Code', 'active', '2019-02-24 17:20:14', NULL, 'QRCODE'),
(18, 'My Profile', 'active', '2019-07-28 15:57:18', NULL, 'MY_PROFILE'),
(19, 'All reports', 'active', '2020-06-20 21:23:38', NULL, 'ALL_REPORTS'),
(20, 'Seller GST Reports', 'active', '2020-06-25 11:48:05', NULL, 'SELLER_GST_REPO'),
(21, 'Seller Account', 'active', '2020-07-07 19:30:10', NULL, 'SELLER_ACCOUNT');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_custom_permissions`
--

CREATE TABLE `rbac_custom_permissions` (
  `custom_permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `assigned_by` int(10) UNSIGNED NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_menu`
--

CREATE TABLE `rbac_menu` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `parent` int(10) UNSIGNED NOT NULL,
  `icon_class` varchar(100) DEFAULT NULL,
  `menu_class` varchar(100) DEFAULT NULL,
  `attribute` varchar(500) DEFAULT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(500) DEFAULT NULL,
  `menu_type` enum('T','L','R','O') DEFAULT 'L' COMMENT 'T=Top\nL= Left\nR= Right\nO=Other',
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rbac_menu`
--

INSERT INTO `rbac_menu` (`menu_id`, `name`, `menu_order`, `parent`, `icon_class`, `menu_class`, `attribute`, `permission_id`, `url`, `menu_type`, `status`, `created`, `modified`) VALUES
(1, 'Manage RBAC', 1, 0, 'fa-cubes', '', '', 0, '', 'L', 'active', '0000-00-00 00:00:00', NULL),
(2, 'Manage Actions', 1, 1, 'fa-circle-o text-yellow', '', '', 5, 'rbac-actions-list', 'L', 'active', '0000-00-00 00:00:00', NULL),
(3, 'Manage Modules', 2, 1, 'fa-circle-o text-aqua', '', '', 10, 'rbac-modules-list', 'L', 'active', '0000-00-00 00:00:00', NULL),
(4, 'Manage Permissions', 3, 1, 'fa-universal-access', '', '', 0, '', 'L', 'active', '0000-00-00 00:00:00', NULL),
(5, 'Module Permissions', 1, 4, 'fa-circle-o text-aqua', '', '', 17, 'rbac-module-permissions', 'L', 'active', '0000-00-00 00:00:00', NULL),
(6, 'Role Permissions', 2, 4, 'fa-circle-o text-red', '', '', 18, 'rbac-role-permissions', 'L', 'active', '0000-00-00 00:00:00', NULL),
(7, 'Configuration', 2, 0, 'fa-gears', '', '', 0, '', 'L', 'active', '0000-00-00 00:00:00', NULL),
(11, 'Manage Menu', 1, 7, 'fa-circle-o text-yellow', '', '', 15, 'manage_menu', 'L', 'active', '0000-00-00 00:00:00', NULL),
(12, 'Manage User', 4, 0, ' fa-users', '', '', 0, '', 'L', 'active', '0000-00-00 00:00:00', NULL),
(13, 'Manage Roles', 4, 1, 'fa-gear', '', '', 29, 'rbac-roles-list', 'L', 'active', '0000-00-00 00:00:00', NULL),
(22, 'Manage App Configs', 2, 7, 'fa-circle-o text-aqua', '', '', 183, 'manage-app-configs', 'L', 'active', '0000-00-00 00:00:00', NULL),
(24, 'Manage Employees', 2, 12, 'fa-circle-o text-aqua', '', '', 24, 'employee-list', 'L', 'active', '0000-00-00 00:00:00', NULL),
(28, 'Manage App Routes', 3, 7, 'fa-circle-o text-yellow', '', '', 117, 'manage-app-routes', 'L', 'active', '0000-00-00 00:00:00', NULL),
(34, 'Manage Features', 4, 7, 'fa-circle-o text-aqua', '', '', 159, 'app-feature-flags', 'L', 'inactive', '0000-00-00 00:00:00', NULL),
(38, 'A-Orders', 7, 0, 'fa-shopping-cart', '', '', 173, 'admin/sales', 'L', 'active', '0000-00-00 00:00:00', NULL),
(39, 'A-Payments', 8, 0, 'fa-inr', '', '', 171, 'admin/payment', 'L', 'active', '0000-00-00 00:00:00', NULL),
(40, 'A-Catalogue', 9, 0, 'fa-shopping-cart', '', '', 174, 'admin/catalog', 'L', 'active', '0000-00-00 00:00:00', NULL),
(41, 'Sellers', 10, 0, 'fa-user', '', '', 175, 'admin/sellers', 'L', 'active', '0000-00-00 00:00:00', NULL),
(42, 'Customers', 11, 0, 'fa-users', '', '', 181, 'admin/customers', 'L', 'active', '0000-00-00 00:00:00', NULL),
(43, 'Pages', 12, 0, 'fa-files-o', '', '', 176, 'admin/pages', 'L', 'active', '0000-00-00 00:00:00', NULL),
(44, 'Newsletter', 14, 0, 'fa-file-text', '', '', 177, 'admin/newsletter', 'L', 'active', '0000-00-00 00:00:00', NULL),
(45, 'Config', 15, 0, 'fa-gears', '', '', 178, 'admin/super_admin/membership', 'L', 'active', '0000-00-00 00:00:00', NULL),
(46, 'Email Logs', 16, 0, 'fa-cogs', '', '', 179, 'admin/super_admin/email_log', 'L', 'active', '0000-00-00 00:00:00', NULL),
(47, 'BDM', 17, 0, 'fa-user', '', '', 180, 'admin/sellers/seller_porfile', 'L', 'active', '0000-00-00 00:00:00', NULL),
(48, 'Reports', 23, 0, 'fa-bar-chart', '', '', 172, 'all-reports', 'L', 'active', '0000-00-00 00:00:00', NULL),
(49, 'Account', 22, 0, 'fa-inr', '', '', 189, '/seller/account', 'L', 'active', '0000-00-00 00:00:00', NULL),
(50, 'Orders', 19, 0, 'fa-shopping-cart', '', '', 189, '/seller/orders', 'L', 'active', '0000-00-00 00:00:00', NULL),
(51, 'Catalogue', 18, 0, 'fa-shopping-cart', '', '', 189, '/seller/catalog/new_product_list', 'L', 'active', '0000-00-00 00:00:00', NULL),
(52, 'Payments', 21, 0, 'fa-inr', '', '', 189, '/seller/payments', 'L', 'active', '0000-00-00 00:00:00', NULL),
(53, 'Return', 20, 0, 'fa-reply', '', '', 189, '/seller/returns', 'L', 'active', '0000-00-00 00:00:00', NULL),
(54, 'Term & Condition', 24, 0, 'fa-handshake-o', '', '', 189, '/seller/seller/terms_conditions_page', 'L', 'active', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_modules`
--

CREATE TABLE `rbac_modules` (
  `module_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_modules`
--

INSERT INTO `rbac_modules` (`module_id`, `name`, `code`, `status`, `created`, `modified`) VALUES
(1, 'Manage Actions', 'MANAGE_ACTIONS', 'active', '2018-10-25 17:40:33', NULL),
(2, 'Manage Modules', 'MANAGE_MODULES', 'active', '2018-10-25 17:41:02', NULL),
(3, 'Manage Permissions', 'MANAGE_PERMISSIONS', 'active', '2018-10-25 17:41:54', NULL),
(4, 'Manage Menu', 'MANAGE_MENU', 'active', '2018-10-25 17:42:26', NULL),
(5, 'Upload Utilities', 'UPLOAD_UTILITIES', 'active', '2018-11-01 00:23:47', NULL),
(6, 'Users', 'USERS', 'active', '2018-11-08 21:43:24', NULL),
(7, 'Manage Roles', 'USER_ROLES', 'active', '2018-11-08 22:09:06', NULL),
(20, 'app routes', 'APP_ROUTES', 'active', '2019-08-26 00:34:10', NULL),
(28, 'Reports', 'REPORTS', 'active', '2020-06-20 21:23:55', NULL),
(29, 'Orders', 'ORDERS', 'active', '2020-06-20 21:48:41', NULL),
(30, 'Payments', 'PAYMENTS', 'active', '2020-06-20 21:49:09', NULL),
(31, 'catalogue', 'CATALOGUE', 'active', '2020-06-20 21:50:42', NULL),
(32, 'Seller', 'SELLER', 'active', '2020-06-20 21:51:20', NULL),
(33, 'Customers', 'CUSTOMERS', 'active', '2020-06-20 21:51:43', NULL),
(34, 'Pages', 'PAGES', 'active', '2020-06-20 21:52:25', NULL),
(35, 'Newsletter', 'Newsletter', 'active', '2020-06-20 21:53:13', NULL),
(36, 'Configs', 'CONFIGS', 'active', '2020-06-20 22:09:53', NULL),
(37, 'Logs', 'LOGS', 'active', '2020-06-20 22:10:15', NULL),
(38, 'BDM', 'BDM', 'active', '2020-06-20 22:10:35', NULL),
(39, 'Manage App Configs', 'MANAGE_APP_CONFIGS', 'active', '2020-06-29 10:31:47', NULL),
(43, 'Dummy', 'DUMMY', 'active', '2020-07-07 21:47:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_permissions`
--

CREATE TABLE `rbac_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_permissions`
--

INSERT INTO `rbac_permissions` (`permission_id`, `module_id`, `action_id`, `status`, `created`, `modified`) VALUES
(1, 1, 1, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(2, 1, 2, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(3, 1, 3, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(4, 1, 4, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(5, 1, 5, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(6, 2, 1, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(7, 2, 2, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(8, 2, 3, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(9, 2, 4, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(10, 2, 5, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(11, 4, 1, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(12, 4, 2, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(13, 4, 3, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(14, 4, 4, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(15, 4, 5, 'active', '2018-10-25 17:57:03', '2020-07-16 12:50:10'),
(16, 2, 6, 'inactive', '2018-10-25 20:42:35', '2020-07-16 12:50:10'),
(17, 3, 6, 'active', '2018-10-25 20:48:22', '2020-07-16 12:50:10'),
(18, 3, 7, 'active', '2018-10-25 20:48:22', '2020-07-16 12:50:10'),
(20, 6, 1, 'active', '2018-11-08 21:43:50', '2020-07-16 12:50:10'),
(21, 6, 2, 'active', '2018-11-08 21:43:50', '2020-07-16 12:50:10'),
(22, 6, 3, 'active', '2018-11-08 21:43:50', '2020-07-16 12:50:10'),
(23, 6, 4, 'active', '2018-11-08 21:43:50', '2020-07-16 12:50:10'),
(24, 6, 5, 'active', '2018-11-08 21:43:50', '2020-07-16 12:50:10'),
(25, 7, 1, 'active', '2018-11-08 22:09:45', '2020-07-16 12:50:10'),
(26, 7, 2, 'active', '2018-11-08 22:09:45', '2020-07-16 12:50:10'),
(27, 7, 3, 'active', '2018-11-08 22:09:45', '2020-07-16 12:50:10'),
(28, 7, 4, 'active', '2018-11-08 22:09:45', '2020-07-16 12:50:10'),
(29, 7, 5, 'active', '2018-11-08 22:09:45', '2020-07-16 12:50:10'),
(30, 1, 9, 'active', '2018-11-09 00:13:47', '2020-07-16 12:50:10'),
(31, 1, 10, 'active', '2018-11-09 00:13:47', '2020-07-16 12:50:10'),
(90, 5, 14, 'active', '2019-02-14 13:53:59', '2020-07-16 12:50:10'),
(113, 20, 1, 'inactive', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(114, 20, 2, 'active', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(115, 20, 3, 'active', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(116, 20, 4, 'active', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(117, 20, 5, 'active', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(118, 20, 9, 'active', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(119, 20, 10, 'active', '2019-08-26 00:34:46', '2020-07-16 12:50:10'),
(170, 28, 19, 'inactive', '2020-06-20 21:24:12', '2020-07-16 12:50:10'),
(171, 30, 5, 'active', '2020-06-21 23:18:15', '2020-07-16 12:50:10'),
(172, 28, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(173, 29, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(174, 31, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(175, 32, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(176, 34, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(177, 35, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(178, 36, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(179, 37, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(180, 38, 5, 'active', '2020-06-21 23:19:41', '2020-07-16 12:50:10'),
(181, 33, 5, 'active', '2020-06-21 23:37:20', '2020-07-16 12:50:10'),
(182, 28, 20, 'active', '2020-06-25 11:48:37', '2020-07-16 12:50:10'),
(183, 39, 13, 'active', '2020-06-29 10:32:17', '2020-07-16 12:50:10'),
(184, 28, 9, 'active', '2020-06-30 17:57:31', '2020-07-16 12:50:10'),
(185, 28, 10, 'active', '2020-06-30 17:57:31', '2020-07-16 12:50:10'),
(189, 43, 5, 'active', '2020-07-07 21:47:21', '2020-07-16 12:50:10'),
(190, 6, 18, 'active', '2020-07-16 08:20:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_roles`
--

CREATE TABLE `rbac_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_roles`
--

INSERT INTO `rbac_roles` (`role_id`, `name`, `code`, `status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'Developer', 'DEVELOPER', 'active', '2018-11-08 19:02:23', NULL, 0, 0),
(2, 'Admin', 'ADMIN', 'active', '2018-05-17 23:55:19', '2018-09-26 13:09:30', 2049, 0),
(3, 'Admin Staff', 'ADMIN_STAFF', 'active', '2018-09-28 17:56:32', '2020-06-21 22:32:20', 2049, 2049),
(4, 'Seller', 'SELLER', 'active', '2018-11-08 23:25:53', NULL, 2049, 0),
(5, 'Guest', 'GUEST', 'active', '2019-02-22 20:39:57', NULL, 2049, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rbac_role_list_view`
-- (See below for the actual view)
--
CREATE TABLE `rbac_role_list_view` (
`role_id` int(10) unsigned
,`name` varchar(45)
,`code` varchar(45)
,`created_by` varchar(201)
,`modified_by` varchar(201)
,`created` datetime
,`modified` datetime
,`status` enum('active','inactive')
,`created_by_id` int(10) unsigned
,`modified_by_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_role_permissions`
--

CREATE TABLE `rbac_role_permissions` (
  `role_permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_role_permissions`
--

INSERT INTO `rbac_role_permissions` (`role_permission_id`, `role_id`, `permission_id`, `status`, `created`, `modified`) VALUES
(1, 2, 116, 'active', '2020-07-18 14:38:33', NULL),
(2, 2, 114, 'active', '2020-07-18 14:38:33', NULL),
(3, 2, 119, 'active', '2020-07-18 14:38:33', NULL),
(4, 2, 118, 'active', '2020-07-18 14:38:33', NULL),
(5, 2, 117, 'active', '2020-07-18 14:38:33', NULL),
(6, 2, 115, 'active', '2020-07-18 14:38:33', NULL),
(7, 2, 180, 'active', '2020-07-18 14:38:33', NULL),
(8, 2, 174, 'active', '2020-07-18 14:38:33', NULL),
(9, 2, 178, 'active', '2020-07-18 14:38:33', NULL),
(10, 2, 181, 'active', '2020-07-18 14:38:33', NULL),
(11, 2, 189, 'active', '2020-07-18 14:38:33', NULL),
(12, 2, 179, 'active', '2020-07-18 14:38:33', NULL),
(13, 2, 1, 'active', '2020-07-18 14:38:33', NULL),
(14, 2, 4, 'active', '2020-07-18 14:38:33', NULL),
(15, 2, 2, 'active', '2020-07-18 14:38:33', NULL),
(16, 2, 31, 'active', '2020-07-18 14:38:33', NULL),
(17, 2, 30, 'active', '2020-07-18 14:38:33', NULL),
(18, 2, 5, 'active', '2020-07-18 14:38:33', NULL),
(19, 2, 3, 'active', '2020-07-18 14:38:33', NULL),
(20, 2, 183, 'active', '2020-07-18 14:38:33', NULL),
(21, 2, 11, 'active', '2020-07-18 14:38:33', NULL),
(22, 2, 14, 'active', '2020-07-18 14:38:33', NULL),
(23, 2, 12, 'active', '2020-07-18 14:38:33', NULL),
(24, 2, 15, 'active', '2020-07-18 14:38:33', NULL),
(25, 2, 13, 'active', '2020-07-18 14:38:33', NULL),
(26, 2, 6, 'active', '2020-07-18 14:38:33', NULL),
(27, 2, 9, 'active', '2020-07-18 14:38:33', NULL),
(28, 2, 7, 'active', '2020-07-18 14:38:33', NULL),
(29, 2, 10, 'active', '2020-07-18 14:38:33', NULL),
(30, 2, 8, 'active', '2020-07-18 14:38:33', NULL),
(31, 2, 17, 'active', '2020-07-18 14:38:33', NULL),
(32, 2, 18, 'active', '2020-07-18 14:38:33', NULL),
(33, 2, 25, 'active', '2020-07-18 14:38:33', NULL),
(34, 2, 28, 'active', '2020-07-18 14:38:33', NULL),
(35, 2, 26, 'active', '2020-07-18 14:38:33', NULL),
(36, 2, 29, 'active', '2020-07-18 14:38:33', NULL),
(37, 2, 27, 'active', '2020-07-18 14:38:33', NULL),
(38, 2, 177, 'active', '2020-07-18 14:38:33', NULL),
(39, 2, 173, 'active', '2020-07-18 14:38:33', NULL),
(40, 2, 176, 'active', '2020-07-18 14:38:33', NULL),
(41, 2, 171, 'active', '2020-07-18 14:38:33', NULL),
(42, 2, 185, 'active', '2020-07-18 14:38:33', NULL),
(43, 2, 184, 'inactive', '2020-07-18 14:38:33', '2020-07-18 19:10:40'),
(44, 2, 172, 'active', '2020-07-18 14:38:33', NULL),
(45, 2, 182, 'active', '2020-07-18 14:38:33', NULL),
(46, 2, 175, 'active', '2020-07-18 14:38:33', NULL),
(47, 2, 90, 'active', '2020-07-18 14:38:33', NULL),
(48, 2, 20, 'active', '2020-07-18 14:38:33', NULL),
(49, 2, 23, 'active', '2020-07-18 14:38:33', NULL),
(50, 2, 21, 'active', '2020-07-18 14:38:33', NULL),
(51, 2, 24, 'active', '2020-07-18 14:38:33', NULL),
(52, 2, 190, 'active', '2020-07-18 14:38:33', NULL),
(53, 2, 22, 'active', '2020-07-18 14:38:33', NULL),
(54, 4, 189, 'active', '2020-07-18 14:39:51', NULL),
(55, 4, 185, 'active', '2020-07-18 14:39:51', NULL),
(56, 4, 172, 'active', '2020-07-18 14:39:51', NULL),
(57, 4, 182, 'active', '2020-07-18 14:39:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_users`
--

CREATE TABLE `rbac_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `login_id` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `mobile_verified` enum('yes','no') NOT NULL DEFAULT 'no',
  `email_verified` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_type` enum('employee','seller','guest','developer','admin') NOT NULL,
  `login_status` enum('yes','no') DEFAULT 'no',
  `profile_pic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_users`
--

INSERT INTO `rbac_users` (`user_id`, `first_name`, `last_name`, `login_id`, `email`, `password`, `mobile`, `mobile_verified`, `email_verified`, `user_type`, `login_status`, `profile_pic`, `created`, `modified`, `created_by`, `modified_by`, `status`) VALUES
(1, 'developer', 'dev', '', 'developer@chm.com', 'ZGE4N2NuZmZqYmVxNTIwOQ##', '9886088890', 'no', 'no', 'developer', 'no', 'profile_pic_1.jpg', '2018-07-15 21:39:55', NULL, 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_user_roles`
--

CREATE TABLE `rbac_user_roles` (
  `user_role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rbac_user_roles`
--

INSERT INTO `rbac_user_roles` (`user_role_id`, `user_id`, `role_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure for view `rbac_role_list_view`
--
DROP TABLE IF EXISTS `rbac_role_list_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `rbac_role_list_view`  AS  select `rr`.`role_id` AS `role_id`,`rr`.`name` AS `name`,`rr`.`code` AS `code`,concat(`cb`.`first_name`,' ',`cb`.`last_name`) AS `created_by`,concat(`mb`.`first_name`,' ',`mb`.`last_name`) AS `modified_by`,`rr`.`created` AS `created`,`rr`.`modified` AS `modified`,`rr`.`status` AS `status`,`rr`.`created_by` AS `created_by_id`,`rr`.`modified_by` AS `modified_by_id` from ((`rbac_roles` `rr` left join `rbac_users` `cb` on(`cb`.`user_id` = `rr`.`created_by`)) left join `rbac_users` `mb` on(`mb`.`user_id` = `rr`.`modified_by`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rbac_actions`
--
ALTER TABLE `rbac_actions`
  ADD PRIMARY KEY (`action_id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `rbac_custom_permissions`
--
ALTER TABLE `rbac_custom_permissions`
  ADD PRIMARY KEY (`custom_permission_id`),
  ADD KEY `fk_custom_permission_user_id_idx` (`user_id`),
  ADD KEY `fk_custom_permission_permission_id_idx` (`permission_id`),
  ADD KEY `fk_custom_permission_assigned_by_idx` (`assigned_by`);

--
-- Indexes for table `rbac_menu`
--
ALTER TABLE `rbac_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `rbac_modules`
--
ALTER TABLE `rbac_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `rbac_permissions`
--
ALTER TABLE `rbac_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `fk_permissions_module_id_idx` (`module_id`),
  ADD KEY `fk_permissions_action_id_idx` (`action_id`);

--
-- Indexes for table `rbac_roles`
--
ALTER TABLE `rbac_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `rbac_role_permissions`
--
ALTER TABLE `rbac_role_permissions`
  ADD PRIMARY KEY (`role_permission_id`),
  ADD KEY `fk_role_permissions_role_id_idx` (`role_id`),
  ADD KEY `fk_role_permissions_permission_id_idx` (`permission_id`);

--
-- Indexes for table `rbac_users`
--
ALTER TABLE `rbac_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `rbac_user_roles`
--
ALTER TABLE `rbac_user_roles`
  ADD PRIMARY KEY (`user_role_id`),
  ADD KEY `fk_user_roles_role_id_idx` (`role_id`),
  ADD KEY `fk_user_roles_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rbac_actions`
--
ALTER TABLE `rbac_actions`
  MODIFY `action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rbac_custom_permissions`
--
ALTER TABLE `rbac_custom_permissions`
  MODIFY `custom_permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rbac_menu`
--
ALTER TABLE `rbac_menu`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `rbac_modules`
--
ALTER TABLE `rbac_modules`
  MODIFY `module_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `rbac_permissions`
--
ALTER TABLE `rbac_permissions`
  MODIFY `permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `rbac_roles`
--
ALTER TABLE `rbac_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rbac_role_permissions`
--
ALTER TABLE `rbac_role_permissions`
  MODIFY `role_permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `rbac_users`
--
ALTER TABLE `rbac_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rbac_user_roles`
--
ALTER TABLE `rbac_user_roles`
  MODIFY `user_role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rbac_custom_permissions`
--
ALTER TABLE `rbac_custom_permissions`
  ADD CONSTRAINT `fk_custom_permission_assigned_by` FOREIGN KEY (`assigned_by`) REFERENCES `rbac_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_custom_permission_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `rbac_permissions` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_custom_permission_user_id` FOREIGN KEY (`user_id`) REFERENCES `rbac_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rbac_permissions`
--
ALTER TABLE `rbac_permissions`
  ADD CONSTRAINT `fk_permissions_action_id` FOREIGN KEY (`action_id`) REFERENCES `rbac_actions` (`action_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissions_module_id` FOREIGN KEY (`module_id`) REFERENCES `rbac_modules` (`module_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rbac_role_permissions`
--
ALTER TABLE `rbac_role_permissions`
  ADD CONSTRAINT `fk_role_permissions_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `rbac_permissions` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_permissions_role_id` FOREIGN KEY (`role_id`) REFERENCES `rbac_roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rbac_user_roles`
--
ALTER TABLE `rbac_user_roles`
  ADD CONSTRAINT `fk_user_roles_role_id` FOREIGN KEY (`role_id`) REFERENCES `rbac_roles` (`role_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_roles_user_id` FOREIGN KEY (`user_id`) REFERENCES `rbac_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
