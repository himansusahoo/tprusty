-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2020 at 07:29 PM
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
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `config_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `configs` longtext DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_configs`
--

INSERT INTO `app_configs` (`config_id`, `name`, `category`, `configs`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'DOMAIN', 'DOMAIN', '', '2019-02-02 14:54:47', 1, '2019-03-03', 2),
(4, 'RBAC', 'RBAC', '{\"role_priority\":[\"ADMIN_STAFF\",\"SELLER\",\"GUEST\"]}', '2019-03-02 22:12:10', 1, '2020-06-30', 2049),
(5, 'EMPLOYEE', 'EMPLOYEE', '{\"employee_id_prefix\":\"EMP\",\"employee_id_zero_prefix\":\"5\"}', '2019-03-03 16:07:41', 2, '2020-06-29', 2049),
(6, 'REPORTS', 'REPORTS', '{\"seller_gst_report\":{\"default\":{\"business_name\":{\"column\":\"business_name\",\"label\":\"business_name\",\"order\":\"1\"},\"buyer_name\":{\"column\":\"buyer_name\",\"label\":\"buyer_name\",\"order\":\"2\"}},\"admin\":{\"admin_sku\":{\"column\":\"admin_sku\",\"label\":\"Admin SKU\",\"order\":\"14\"},\"business_name\":{\"column\":\"business_name\",\"label\":\"Business Name\",\"order\":\"2\"},\"buyer_email\":{\"column\":\"buyer_email\",\"label\":\"Buyer Email\",\"order\":\"10\"},\"buyer_mobile\":{\"column\":\"buyer_mobile\",\"label\":\"Buyer Mobile\",\"order\":\"9\"},\"buyer_name\":{\"column\":\"buyer_name\",\"label\":\"Buyer Name\",\"order\":\"8\"},\"buyer_state\":{\"column\":\"buyer_state\",\"label\":\"Buyer State\",\"order\":\"13\"},\"cgst\":{\"column\":\"cgst\",\"label\":\"CGST\",\"order\":\"29\"},\"cgst_tax_rate\":{\"column\":\"cgst_tax_rate\",\"label\":\"CGST Tax Rate\",\"order\":\"26\"},\"courier_name\":{\"column\":\"courier_name\",\"label\":\"Courier Name\",\"order\":\"34\"},\"date_of_order\":{\"column\":\"date_of_order\",\"label\":\"Date Of Order\",\"order\":\"20\"},\"delivered_date\":{\"column\":\"delivered_date\",\"label\":\"Delivered Date\",\"order\":\"36\"},\"gstin\":{\"column\":\"gstin\",\"label\":\"Seller GSTIN\",\"order\":\"1\"},\"igst\":{\"column\":\"igst\",\"label\":\"IGST\",\"order\":\"31\"},\"igst_tax_rate\":{\"column\":\"igst_tax_rate\",\"label\":\"IGST Tax Rate\",\"order\":\"28\"},\"invoice_date\":{\"column\":\"invoice_date\",\"label\":\"Invoice Date\",\"order\":\"36\"},\"mrp\":{\"column\":\"mrp\",\"label\":\"MRP\",\"order\":\"21\"},\"order_id\":{\"column\":\"order_id\",\"label\":\"Order ID\",\"order\":\"16\"},\"order_status\":{\"column\":\"order_status\",\"label\":\"Order Status\",\"order\":\"32\"},\"payment_mode\":{\"column\":\"payment_mode\",\"label\":\"Payment Mode\",\"order\":\"19\"},\"product_name\":{\"column\":\"product_name\",\"label\":\"Product Name\",\"order\":\"17\"},\"quantity\":{\"column\":\"quantity\",\"label\":\"Quantity\",\"order\":\"18\"},\"seller_address\":{\"column\":\"seller_address\",\"label\":\"Seller Address\",\"order\":\"5\"},\"seller_city\":{\"column\":\"seller_city\",\"label\":\"Seller City\",\"order\":\"6\"},\"seller_email\":{\"column\":\"seller_email\",\"label\":\"Seller Email\",\"order\":\"4\"},\"seller_mobile\":{\"column\":\"seller_mobile\",\"label\":\"Seller Mobile\",\"order\":\"3\"},\"seller_sku\":{\"column\":\"seller_sku\",\"label\":\"Seller SKU\",\"order\":\"15\"},\"seller_state\":{\"column\":\"seller_state\",\"label\":\"Seller State\",\"order\":\"7\"},\"sgst\":{\"column\":\"sgst\",\"label\":\"SGST\",\"order\":\"30\"},\"sgst_tax_rate\":{\"column\":\"sgst_tax_rate\",\"label\":\"SGST Tax Rate\",\"order\":\"27\"},\"ship_address\":{\"column\":\"ship_address\",\"label\":\"Ship Address\",\"order\":\"11\"},\"ship_city\":{\"column\":\"ship_city\",\"label\":\"Ship City\",\"order\":\"12\"},\"shipping_date\":{\"column\":\"shipping_date\",\"label\":\"Shipping Date\",\"order\":\"33\"},\"tax_exclusive_gross\":{\"column\":\"tax_exclusive_gross\",\"label\":\"Tax Exclusive Gross\",\"order\":\"24\"},\"tax_rate\":{\"column\":\"tax_rate\",\"label\":\"Tax Rate\",\"order\":\"25\"},\"total_amount\":{\"column\":\"total_amount\",\"label\":\"Total Amount\",\"order\":\"22\"},\"total_tax_amount\":{\"column\":\"total_tax_amount\",\"label\":\"Total Tax Amount\",\"order\":\"23\"},\"tracking_id\":{\"column\":\"tracking_id\",\"label\":\"Tracking ID\",\"order\":\"35\"}},\"seller\":{\"business_name\":{\"column\":\"business_name\",\"label\":\"Business Name\",\"order\":\"2\"},\"buyer_name\":{\"column\":\"buyer_name\",\"label\":\"Buyer Name\",\"order\":\"9\"},\"cgst\":{\"column\":\"cgst\",\"label\":\"CGST\",\"order\":\"24\"},\"cgst_tax_rate\":{\"column\":\"cgst_tax_rate\",\"label\":\"CGST Tax Rate\",\"order\":\"21\"},\"date_of_order\":{\"column\":\"date_of_order\",\"label\":\"Date of Order\",\"order\":\"12\"},\"delivered_date\":{\"column\":\"delivered_date\",\"label\":\"Delivered Date\",\"order\":\"27\"},\"delivery_state\":{\"column\":\"delivery_state\",\"label\":\"Ship State\",\"order\":\"11\"},\"gstin\":{\"column\":\"gstin\",\"label\":\"GSTIN\",\"order\":\"1\"},\"igst\":{\"column\":\"igst\",\"label\":\"IGST\",\"order\":\"26\"},\"igst_tax_rate\":{\"column\":\"igst_tax_rate\",\"label\":\"IGST Tax Rate\",\"order\":\"23\"},\"mrp\":{\"column\":\"mrp\",\"label\":\"MRP\",\"order\":\"13\"},\"order_id\":{\"column\":\"order_id\",\"label\":\"Order ID\",\"order\":\"7\"},\"order_status\":{\"column\":\"order_status\",\"label\":\"Order Status\",\"order\":\"16\"},\"payment_mode\":{\"column\":\"payment_mode\",\"label\":\"Payment Mode\",\"order\":\"15\"},\"product_name\":{\"column\":\"product_name\",\"label\":\"Product Name\",\"order\":\"8\"},\"quantity\":{\"column\":\"quantity\",\"label\":\"Quantity\",\"order\":\"14\"},\"seller_address\":{\"column\":\"seller_address\",\"label\":\"Address\",\"order\":\"3\"},\"seller_city\":{\"column\":\"seller_city\",\"label\":\"City\",\"order\":\"4\"},\"seller_sku\":{\"column\":\"seller_sku\",\"label\":\"SKU\",\"order\":\"6\"},\"seller_state\":{\"column\":\"seller_state\",\"label\":\"State\",\"order\":\"5\"},\"sgst\":{\"column\":\"sgst\",\"label\":\"SGST\",\"order\":\"25\"},\"sgst_tax_rate\":{\"column\":\"sgst_tax_rate\",\"label\":\"SGST Tax Rate\",\"order\":\"22\"},\"ship_city\":{\"column\":\"ship_city\",\"label\":\"Ship City\",\"order\":\"10\"},\"tax_exclusive_gross\":{\"column\":\"tax_exclusive_gross\",\"label\":\"Tax Exclusive Gross\",\"order\":\"19\"},\"tax_rate\":{\"column\":\"tax_rate\",\"label\":\"Tax Rate\",\"order\":\"20\"},\"total_amount\":{\"column\":\"total_amount\",\"label\":\"Total Amount\",\"order\":\"17\"},\"total_tax_amount\":{\"column\":\"total_tax_amount\",\"label\":\"Total Tax Amount\",\"order\":\"18\"}}}}', '2020-06-29 21:52:51', 2049, '2020-07-23', 2049);

-- --------------------------------------------------------

--
-- Table structure for table `app_routes`
--

CREATE TABLE `app_routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `module` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `path` text NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_routes`
--

INSERT INTO `app_routes` (`id`, `module`, `slug`, `path`, `status`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'app_configs', 'manage-app-configs', 'app_configs/index', 'active', '2019-08-25 23:45:32', NULL, NULL, NULL),
(2, 'app_configs', 'save-app-configs', 'app_configs/save_configs', 'active', '2019-08-25 23:45:44', NULL, NULL, NULL),
(56, 'app-routes', 'manage-app-routes', 'app_routes/index', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(57, 'app-routes', 'create-app-routes', 'app_routes/create', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(58, 'app-routes', 'edit-app-routes/(:any)', 'app_routes/edit/$1', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(59, 'app-routes', 'edit-app-routes-save', 'app_routes/edit', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(60, 'app-routes', 'view-app-routes/(:any)', 'app_routes/view/$1', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(61, 'app-routes', 'delete-app-routes', 'app_routes/delete', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(62, 'app-routes', 'export-app-routes', 'app_routes/export_grid_data', 'active', '2019-08-26 00:41:21', NULL, NULL, NULL),
(92, 'rbac', 'create-rbac-module', 'rbac/rbac_modules/create', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(93, 'rbac', 'rbac-actions-list', 'rbac/rbac_actions/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(94, 'rbac', 'create-rbac-action', 'rbac/rbac_actions/create', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(95, 'rbac', 'edit-rbac-action/(:any)', 'rbac/rbac_actions/edit/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(96, 'rbac', 'edit-rbac-action-save', 'rbac/rbac_actions/edit', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(97, 'rbac', 'view-rbac-action/(:any)', 'rbac/rbac_actions/view/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(98, 'rbac', 'delete-rbac-action', 'rbac/rbac_actions/delete', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(99, 'rbac', 'export-rbac-action', 'rbac/rbac_actions/export_grid_data', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(100, 'rbac', 'rbac-modules-list', 'rbac/rbac_modules/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(101, 'rbac', 'edit-rbac-module/(:any)', 'rbac/rbac_modules/edit/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(102, 'rbac', 'edit-rbac-module-save', 'rbac/rbac_modules/edit', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(103, 'rbac', 'view-rbac-module/(:any)', 'rbac/rbac_modules/view/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(104, 'rbac', 'delete-rbac-module', 'rbac/rbac_modules/delete', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(105, 'rbac', 'export-rbac-module', 'rbac/rbac_modules/export_grid_data', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(106, 'rbac', 'rbac-roles-list', 'rbac/rbac_roles/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(107, 'rbac', 'create-rbac-role', 'rbac/rbac_roles/create', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(108, 'rbac', 'edit-rbac-role/(:any)', 'rbac/rbac_roles/edit/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(109, 'rbac', 'edit-rbac-role-save', 'rbac/rbac_roles/edit', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(110, 'rbac', 'view-rbac-role/(:any)', 'rbac/rbac_roles/view/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(111, 'rbac', 'delete-rbac-role', 'rbac/rbac_roles/delete', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(112, 'rbac', 'export-rbac-role', 'rbac/rbac_roles/export_grid_data', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(113, 'rbac', 'rbac-module-permissions', 'rbac/rbac_permissions/module_permissions', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(114, 'rbac', 'rbac-role-permissions', 'rbac/rbac_role_permissions/role_permissions', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(115, 'rbac', 'manage_menu', 'rbac/rbac_menus/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(116, 'rbac', 'user-list', 'rbac/rbac_users/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(117, 'rbac', 'manage-users', 'rbac/rbac_users/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(118, 'rbac', 'employee-list', 'employee/manage_employees/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(119, 'rbac', 'create-employee-profile', 'employee/manage_employees/create', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(120, 'rbac', 'edit-employee-profile/(:any)', 'employee/manage_employees/edit/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(121, 'rbac', 'edit-employee-profile-save', 'employee/manage_employees/edit', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(122, 'rbac', 'view-employee-profile/(:any)', 'employee/manage_employees/view/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(123, 'rbac', 'delete-employee-profile', 'employee/manage_employees/delete', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(124, 'rbac', 'export-employee-profile', 'employee/manage_employees/export_grid_data', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(125, 'rbac', 'my-profile', 'employee/manage_employees/employee_profile', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(126, 'rbac', 'validate-my-password', 'employee/manage_employees/validate_my_password', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(127, 'rbac', 'update-my-password', 'employee/manage_employees/update_my_password', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(128, 'rbac', 'update-my-profile-pic', 'employee/manage_employees/update_my_profile_pic', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(129, 'rbac', 'student-list', 'students/manage_students/index', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(130, 'rbac', 'create-student-profile', 'students/manage_students/create', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(131, 'rbac', 'edit-student-profile/(:any)', 'students/manage_students/edit/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(132, 'rbac', 'edit-student-profile-save', 'students/manage_students/edit', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(133, 'rbac', 'view-student-profile/(:any)', 'students/manage_students/view/$1', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(134, 'rbac', 'delete-student-profile', 'students/manage_students/delete', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(135, 'rbac', 'export-student-profile', 'students/manage_students/export_grid_data', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(136, 'rbac', 'reset-student-password', 'student/manage_students/reset_student_password', 'active', '2019-08-26 11:38:04', NULL, NULL, NULL),
(137, 'upload_utilities', 'course-academic-batch-upload', 'upload_utilities/course_academic_batch_utilities/index', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(138, 'upload_utilities', 'course-academic-batch-upload-process', 'upload_utilities/course_academic_batch_utilities/upload_file', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(139, 'upload_utilities', 'course-academic-batch-upload-valid', 'upload_utilities/course_academic_batch_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(140, 'upload_utilities', 'course-academic-batch-upload-invalid', 'upload_utilities/course_academic_batch_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(141, 'upload_utilities', 'course-academic-batch-delete-row', 'upload_utilities/course_academic_batch_utilities/delete_temp_record', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(142, 'upload_utilities', 'course-academic-batch-export', 'upload_utilities/course_academic_batch_utilities/export_grid_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(143, 'upload_utilities', 'course-academic-batch-import', 'upload_utilities/course_academic_batch_utilities/save_import_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(144, 'upload_utilities', 'book-ledger-upload', 'upload_utilities/book_ledger_upload_utilities/index', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(145, 'upload_utilities', 'book-ledger-upload-template-download', 'upload_utilities/book_ledger_upload_utilities/get_ledger_template', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(146, 'upload_utilities', 'book-ledger-upload-process', 'upload_utilities/book_ledger_upload_utilities/upload_file', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(147, 'upload_utilities', 'book-ledger-upload-valid', 'upload_utilities/book_ledger_upload_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(148, 'upload_utilities', 'book-ledger-upload-invalid', 'upload_utilities/book_ledger_upload_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(149, 'upload_utilities', 'book-ledger-upload-delete-row', 'upload_utilities/book_ledger_upload_utilities/delete_temp_record', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(150, 'upload_utilities', 'book-ledger-upload-export', 'upload_utilities/book_ledger_upload_utilities/export_grid_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(151, 'upload_utilities', 'book-ledger-upload-import', 'upload_utilities/book_ledger_upload_utilities/save_import_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(152, 'upload_utilities', 'employee-upload', 'upload_utilities/emp_upload_utilities/index', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(153, 'upload_utilities', 'employee-upload-template-download', 'upload_utilities/emp_upload_utilities/get_ledger_template', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(154, 'upload_utilities', 'employee-upload-process', 'upload_utilities/emp_upload_utilities/upload_file', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(155, 'upload_utilities', 'employee-upload-valid', 'upload_utilities/emp_upload_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(156, 'upload_utilities', 'employee-upload-invalid', 'upload_utilities/emp_upload_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(157, 'upload_utilities', 'employee-upload-delete-row', 'upload_utilities/emp_upload_utilities/delete_temp_record', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(158, 'upload_utilities', 'employee-upload-export', 'upload_utilities/emp_upload_utilities/export_grid_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(159, 'upload_utilities', 'employee-upload-import', 'upload_utilities/emp_upload_utilities/save_import_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(160, 'upload_utilities', 'student-upload', 'upload_utilities/student_upload_utilities/index', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(161, 'upload_utilities', 'student-upload-template-download', 'upload_utilities/student_upload_utilities/get_ledger_template', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(162, 'upload_utilities', 'student-upload-process', 'upload_utilities/student_upload_utilities/upload_file', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(163, 'upload_utilities', 'student-upload-valid', 'upload_utilities/student_upload_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(164, 'upload_utilities', 'student-upload-invalid', 'upload_utilities/student_upload_utilities/get_temp_table_data_grid', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(165, 'upload_utilities', 'student-upload-delete-row', 'upload_utilities/student_upload_utilities/delete_temp_record', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(166, 'upload_utilities', 'student-upload-export', 'upload_utilities/student_upload_utilities/export_grid_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(167, 'upload_utilities', 'student-upload-import', 'upload_utilities/student_upload_utilities/save_import_data', 'active', '2019-08-26 11:40:25', NULL, NULL, NULL),
(229, 'Reports', 'all-reports', 'reports/index', 'active', '2020-06-20 21:26:10', NULL, NULL, NULL),
(230, 'dashboards', 'employee-dashboard', 'admin_users/dashboard', 'active', '2020-06-23 13:41:01', NULL, NULL, NULL),
(231, 'dashboards', 'seller-dashboard', 'admin_users/dashboard', 'active', '2020-06-23 13:42:55', NULL, NULL, NULL),
(232, 'dashboards', 'admin-dashboard', 'admin_users/dashboard', 'active', '2020-06-23 13:43:18', NULL, NULL, NULL),
(233, 'dashboards', 'developer-dashboard', 'admin_users/dashboard', 'active', '2020-06-23 13:52:18', NULL, NULL, NULL),
(234, 'rbac', 'admin-login', 'admin_users/sign_in', 'active', '2020-06-25 07:22:28', NULL, NULL, NULL),
(235, 'Reports', 'seller-gst-reports', 'reports/seller_gst_reports/index', 'active', '2020-06-25 11:42:24', NULL, NULL, NULL),
(236, 'Reports', 'export-seller-gst-reports', 'reports/seller_gst_reports/export_grid_data', 'active', '2020-06-25 11:44:30', NULL, NULL, NULL),
(237, 'Reports', 'seller-reports', 'admin/report/seller_report', 'active', '2020-06-25 21:51:34', NULL, NULL, NULL),
(238, 'Reports', 'seller-payout-reports', 'admin/payment/seller_all_payout', 'active', '2020-06-25 21:52:20', NULL, NULL, NULL),
(239, 'Reports', 'seller-profile-reports', 'admin/payment/slr_profile_report', 'active', '2020-06-25 21:53:04', NULL, NULL, NULL),
(240, 'Reports', 'seller-wise-top-selling-products', 'admin/report/top_selling', 'active', '2020-06-25 21:53:38', NULL, NULL, NULL),
(241, 'Reports', 'buyer-reports', 'admin/report/buyer_report', 'active', '2020-06-25 21:54:21', NULL, NULL, NULL),
(242, 'Reports', 'buyer-wallet-reports', 'admin/report/byrwallet_report', 'active', '2020-06-25 21:54:58', NULL, NULL, NULL),
(243, 'Reports', 'buyer-profile-reports', 'admin/payment/buyer_profile_report', 'active', '2020-06-25 21:55:24', NULL, NULL, NULL),
(244, 'Reports', 'order-reports', 'admin/report', 'active', '2020-06-25 21:56:37', NULL, NULL, NULL),
(245, 'Reports', 'return-order-reports', 'admin/report/return_order_report', 'active', '2020-06-25 21:56:58', NULL, NULL, NULL),
(246, 'Reports', 'product-reports', 'admin/report/product_report', 'active', '2020-06-25 21:57:40', NULL, NULL, NULL),
(247, 'Reports', 'sale-reports', 'admin/report/sales_report', 'active', '2020-06-25 21:58:08', NULL, NULL, NULL),
(248, 'Reports', 'tax-reports', 'admin/payment/tax_report', 'active', '2020-06-25 21:58:41', NULL, NULL, NULL),
(249, 'rbac', 'admin-logout', 'admin_users/sign_out', 'active', '2020-06-26 09:37:32', NULL, NULL, NULL),
(250, 'Reports', 'seller-gst-report-grid', 'reports/seller_gst_reports/seller_gst_grid_config', 'active', '2020-06-27 15:02:20', NULL, NULL, NULL),
(251, 'Reports', 'seller-gst-reports-data', 'reports/seller_gst_reports/seller_gst_grid_data', 'active', '2020-07-06 21:49:19', NULL, NULL, NULL),
(252, 'rbac', 'seller-logout', 'admin_users/sign_out', 'active', '2020-07-07 23:58:14', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `app_routes`
--
ALTER TABLE `app_routes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `config_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_routes`
--
ALTER TABLE `app_routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
