-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2018 at 12:23 PM
-- Server version: 5.6.40
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moonboy2_moonboy_in`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ative_product_all_price`
-- (See below for the actual view)
--
CREATE TABLE `view_ative_product_all_price` (
`imag` text
,`product_id` int(11)
,`category_id` int(11)
,`name` varchar(200)
,`description` text
,`short_desc` text
,`mrp` int(11)
,`price` int(11)
,`special_price` int(11)
,`quantity` varchar(50)
,`special_pric_from_dt` date
,`seller_id` int(11)
,`special_pric_to_dt` date
,`sku` varchar(250)
,`tax_rate_percentage` float
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ative_product_final_price`
-- (See below for the actual view)
--
CREATE TABLE `view_ative_product_final_price` (
`imag` text
,`product_id` int(11)
,`category_id` int(11)
,`name` varchar(200)
,`description` text
,`short_desc` text
,`final_price` int(11)
,`quantity` varchar(50)
,`special_pric_from_dt` date
,`seller_id` int(11)
,`special_pric_to_dt` date
,`sku` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_attrbute_filter_data`
-- (See below for the actual view)
--
CREATE TABLE `view_attrbute_filter_data` (
`id` int(11)
,`product_id` int(11)
,`sku` varchar(200)
,`attr_id` int(11)
,`attr_value` varchar(500)
,`attribute_field_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_catinfo`
-- (See below for the actual view)
--
CREATE TABLE `view_catinfo` (
`lvl2` int(11)
,`lvl2_name` varchar(500)
,`lvl1` bigint(20)
,`lvl1_name` varchar(500)
,`lvlmain` bigint(20)
,`lvlmain_name` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_cronjobattrbute_filter_data`
-- (See below for the actual view)
--
CREATE TABLE `view_cronjobattrbute_filter_data` (
`id` int(11)
,`product_id` int(11)
,`sku` varchar(200)
,`attr_id` int(11)
,`attr_value` varchar(500)
,`attribute_field_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sale_performance`
-- (See below for the actual view)
--
CREATE TABLE `view_sale_performance` (
`prd_id` int(9)
,`prd_name` varchar(200)
,`delivered_count` bigint(21)
,`sale_month_year` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_second_leable_category`
-- (See below for the actual view)
--
CREATE TABLE `view_second_leable_category` (
`category_id` int(9)
,`category_name` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sku_brand`
-- (See below for the actual view)
--
CREATE TABLE `view_sku_brand` (
`attr_id` int(11)
,`attr_value` varchar(500)
,`sku` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sku_brand_color`
-- (See below for the actual view)
--
CREATE TABLE `view_sku_brand_color` (
`sku` varchar(200)
,`color` varchar(500)
,`attr_id` int(11)
,`brand` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sku_colors`
-- (See below for the actual view)
--
CREATE TABLE `view_sku_colors` (
`attr_id` int(11)
,`attr_value` varchar(500)
,`sku` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sku_size`
-- (See below for the actual view)
--
CREATE TABLE `view_sku_size` (
`attr_id` int(11)
,`attr_value` varchar(500)
,`sku` varchar(200)
);

-- --------------------------------------------------------

--
-- Structure for view `view_ative_product_all_price`
--
DROP TABLE IF EXISTS `view_ative_product_all_price`;

CREATE VIEW `view_ative_product_all_price`  AS  select `a`.`imag` AS `imag`,`b`.`product_id` AS `product_id`,`b`.`category_id` AS `category_id`,`c`.`name` AS `name`,`c`.`description` AS `description`,`c`.`short_desc` AS `short_desc`,`d`.`mrp` AS `mrp`,`d`.`price` AS `price`,`d`.`special_price` AS `special_price`,`d`.`quantity` AS `quantity`,`d`.`special_pric_from_dt` AS `special_pric_from_dt`,`d`.`seller_id` AS `seller_id`,`d`.`special_pric_to_dt` AS `special_pric_to_dt`,`d`.`sku` AS `sku`,`f`.`tax_rate_percentage` AS `tax_rate_percentage` from ((((((`product_image` `a` join `product_category` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_general_info` `c` on((`c`.`product_id` = `b`.`product_id`))) join `product_master` `d` on((`d`.`product_id` = `c`.`product_id`))) join `product_setting` `e` on((`e`.`product_id` = `a`.`product_id`))) join `tax_management` `f` on((`d`.`tax_class` = `f`.`tax_id`))) join `seller_account` `g` on((`g`.`seller_id` = `d`.`seller_id`))) where ((`d`.`approve_status` = 'Active') and (`d`.`seller_id` <> 0) and (`g`.`status` = 'Active') and (`d`.`mrp` > 0) and (`d`.`price` = 0) and (`d`.`special_price` = 0)) union all select `a`.`imag` AS `imag`,`b`.`product_id` AS `product_id`,`b`.`category_id` AS `category_id`,`c`.`name` AS `name`,`c`.`description` AS `description`,`c`.`short_desc` AS `short_desc`,`d`.`mrp` AS `mrp`,`d`.`price` AS `price`,`d`.`special_price` AS `special_price`,`d`.`quantity` AS `quantity`,`d`.`special_pric_from_dt` AS `special_pric_from_dt`,`d`.`seller_id` AS `seller_id`,`d`.`special_pric_to_dt` AS `special_pric_to_dt`,`d`.`sku` AS `sku`,`f`.`tax_rate_percentage` AS `tax_rate_percentage` from ((((((`product_image` `a` join `product_category` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_general_info` `c` on((`c`.`product_id` = `b`.`product_id`))) join `product_master` `d` on((`d`.`product_id` = `c`.`product_id`))) join `product_setting` `e` on((`e`.`product_id` = `a`.`product_id`))) join `tax_management` `f` on((`d`.`tax_class` = `f`.`tax_id`))) join `seller_account` `g` on((`g`.`seller_id` = `d`.`seller_id`))) where ((`d`.`approve_status` = 'Active') and (`d`.`seller_id` <> 0) and (`g`.`status` = 'Active') and (`d`.`mrp` > 0) and (`d`.`price` > 0) and (`d`.`special_price` = 0)) union all select `a`.`imag` AS `imag`,`b`.`product_id` AS `product_id`,`b`.`category_id` AS `category_id`,`c`.`name` AS `name`,`c`.`description` AS `description`,`c`.`short_desc` AS `short_desc`,`d`.`mrp` AS `mrp`,`d`.`price` AS `price`,`d`.`special_price` AS `special_price`,`d`.`quantity` AS `quantity`,`d`.`special_pric_from_dt` AS `special_pric_from_dt`,`d`.`seller_id` AS `seller_id`,`d`.`special_pric_to_dt` AS `special_pric_to_dt`,`d`.`sku` AS `sku`,`f`.`tax_rate_percentage` AS `tax_rate_percentage` from ((((((`product_image` `a` join `product_category` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_general_info` `c` on((`c`.`product_id` = `b`.`product_id`))) join `product_master` `d` on((`d`.`product_id` = `c`.`product_id`))) join `product_setting` `e` on((`e`.`product_id` = `a`.`product_id`))) join `tax_management` `f` on((`d`.`tax_class` = `f`.`tax_id`))) join `seller_account` `g` on((`g`.`seller_id` = `d`.`seller_id`))) where ((`d`.`approve_status` = 'Active') and (`d`.`seller_id` <> 0) and (`g`.`status` = 'Active') and (`d`.`special_price` > 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_ative_product_final_price`
--
DROP TABLE IF EXISTS `view_ative_product_final_price`;

CREATE VIEW `view_ative_product_final_price`  AS  select `a`.`imag` AS `imag`,`b`.`product_id` AS `product_id`,`b`.`category_id` AS `category_id`,`c`.`name` AS `name`,`c`.`description` AS `description`,`c`.`short_desc` AS `short_desc`,`d`.`mrp` AS `final_price`,`d`.`quantity` AS `quantity`,`d`.`special_pric_from_dt` AS `special_pric_from_dt`,`d`.`seller_id` AS `seller_id`,`d`.`special_pric_to_dt` AS `special_pric_to_dt`,`d`.`sku` AS `sku` from (((((`product_image` `a` join `product_category` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_general_info` `c` on((`c`.`product_id` = `b`.`product_id`))) join `product_master` `d` on((`d`.`product_id` = `c`.`product_id`))) join `product_setting` `e` on((`e`.`product_id` = `a`.`product_id`))) join `seller_account` `g` on((`g`.`seller_id` = `d`.`seller_id`))) where ((`d`.`approve_status` = 'Active') and (`d`.`seller_id` <> 0) and (`g`.`status` = 'Active') and (`d`.`mrp` > 0) and (`d`.`price` = 0) and (`d`.`special_price` = 0)) union all select `a`.`imag` AS `imag`,`b`.`product_id` AS `product_id`,`b`.`category_id` AS `category_id`,`c`.`name` AS `name`,`c`.`description` AS `description`,`c`.`short_desc` AS `short_desc`,`d`.`price` AS `price`,`d`.`quantity` AS `quantity`,`d`.`special_pric_from_dt` AS `special_pric_from_dt`,`d`.`seller_id` AS `seller_id`,`d`.`special_pric_to_dt` AS `special_pric_to_dt`,`d`.`sku` AS `sku` from (((((`product_image` `a` join `product_category` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_general_info` `c` on((`c`.`product_id` = `b`.`product_id`))) join `product_master` `d` on((`d`.`product_id` = `c`.`product_id`))) join `product_setting` `e` on((`e`.`product_id` = `a`.`product_id`))) join `seller_account` `g` on((`g`.`seller_id` = `d`.`seller_id`))) where ((`d`.`approve_status` = 'Active') and (`d`.`seller_id` <> 0) and (`g`.`status` = 'Active') and (`d`.`mrp` > 0) and (`d`.`price` > 0) and (`d`.`special_price` = 0)) union all select `a`.`imag` AS `imag`,`b`.`product_id` AS `product_id`,`b`.`category_id` AS `category_id`,`c`.`name` AS `name`,`c`.`description` AS `description`,`c`.`short_desc` AS `short_desc`,`d`.`special_price` AS `special_price`,`d`.`quantity` AS `quantity`,`d`.`special_pric_from_dt` AS `special_pric_from_dt`,`d`.`seller_id` AS `seller_id`,`d`.`special_pric_to_dt` AS `special_pric_to_dt`,`d`.`sku` AS `sku` from (((((`product_image` `a` join `product_category` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_general_info` `c` on((`c`.`product_id` = `b`.`product_id`))) join `product_master` `d` on((`d`.`product_id` = `c`.`product_id`))) join `product_setting` `e` on((`e`.`product_id` = `a`.`product_id`))) join `seller_account` `g` on((`g`.`seller_id` = `d`.`seller_id`))) where ((`d`.`approve_status` = 'Active') and (`d`.`seller_id` <> 0) and (`g`.`status` = 'Active') and (`d`.`special_price` > 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_attrbute_filter_data`
--
DROP TABLE IF EXISTS `view_attrbute_filter_data`;

CREATE VIEW `view_attrbute_filter_data`  AS  select `a`.`id` AS `id`,`a`.`product_id` AS `product_id`,`a`.`sku` AS `sku`,`a`.`attr_id` AS `attr_id`,`a`.`attr_value` AS `attr_value`,`b`.`attribute_field_name` AS `attribute_field_name` from (`product_attribute_value` `a` join `attribute_real` `b` on((`a`.`attr_id` = `b`.`attribute_id`))) where (`b`.`attribute_field_name` in ('Brand','Color','Size','Size Type')) union all select `a`.`id` AS `id`,`a`.`seller_product_id` AS `seller_product_id`,`a`.`sku` AS `sku`,`a`.`attr_id` AS `attr_id`,`a`.`attr_value` AS `attr_value`,`b`.`attribute_field_name` AS `attribute_field_name` from (`seller_product_attribute_value` `a` join `attribute_real` `b` on((`a`.`attr_id` = `b`.`attribute_id`))) where (`b`.`attribute_field_name` in ('Brand','Color','Size','Size Type')) ;

-- --------------------------------------------------------

--
-- Structure for view `view_catinfo`
--
DROP TABLE IF EXISTS `view_catinfo`;

CREATE VIEW `view_catinfo`  AS  select `sub1`.`category_id` AS `lvl2`,`sub1`.`category_name` AS `lvl2_name`,`sub`.`category_id` AS `lvl1`,`sub`.`category_name` AS `lvl1_name`,`main_catg`.`category_id` AS `lvlmain`,`main_catg`.`category_name` AS `lvlmain_name` from ((`category_indexing` `sub1` join `category_indexing` `sub` on((`sub1`.`parent_id` = `sub`.`category_id`))) join `category_indexing` `main_catg` on((`sub`.`parent_id` = `main_catg`.`category_id`))) union all select `sub1`.`category_id` AS `lvl2`,`sub1`.`category_name` AS `lvl2_name`,0 AS `lvl1`,'' AS `lvl1_name`,0 AS `lvlmain`,'' AS `lvlmain_name` from `category_indexing` `sub1` where (`sub1`.`parent_id` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `view_cronjobattrbute_filter_data`
--
DROP TABLE IF EXISTS `view_cronjobattrbute_filter_data`;

CREATE VIEW `view_cronjobattrbute_filter_data`  AS  select `a`.`id` AS `id`,`a`.`product_id` AS `product_id`,`a`.`sku` AS `sku`,`a`.`attr_id` AS `attr_id`,`a`.`attr_value` AS `attr_value`,`b`.`attribute_field_name` AS `attribute_field_name` from (`product_attribute_value` `a` join `attribute_real` `b` on((`a`.`attr_id` = `b`.`attribute_id`))) where (`b`.`attribute_field_name` in ('Brand','Color','Size','Size Type','Type','occasion','Capacity','RAM','ROM')) union all select `a`.`id` AS `id`,`a`.`seller_product_id` AS `seller_product_id`,`a`.`sku` AS `sku`,`a`.`attr_id` AS `attr_id`,`a`.`attr_value` AS `attr_value`,`b`.`attribute_field_name` AS `attribute_field_name` from (`seller_product_attribute_value` `a` join `attribute_real` `b` on((`a`.`attr_id` = `b`.`attribute_id`))) where (`b`.`attribute_field_name` in ('Brand','Color','Size','Size Type','Type','occasion','Capacity','RAM','ROM')) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sale_performance`
--
DROP TABLE IF EXISTS `view_sale_performance`;

CREATE VIEW `view_sale_performance`  AS  select `a`.`product_id` AS `prd_id`,`b`.`name` AS `prd_name`,count(`a`.`product_id`) AS `delivered_count`,now() AS `sale_month_year` from (`ordered_product_from_addtocart` `a` join `product_general_info` `b` on((`a`.`product_id` = `b`.`product_id`))) where (`a`.`product_order_status` = 'Delivered') group by `a`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_second_leable_category`
--
DROP TABLE IF EXISTS `view_second_leable_category`;

CREATE VIEW `view_second_leable_category`  AS  select `category_indexing`.`category_id` AS `category_id`,`category_indexing`.`category_name` AS `category_name` from `category_indexing` where `category_indexing`.`parent_id` in (select `category_indexing`.`category_id` from `category_indexing` where (`category_indexing`.`parent_id` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sku_brand`
--
DROP TABLE IF EXISTS `view_sku_brand`;

CREATE VIEW `view_sku_brand`  AS  select distinct `seller_product_attribute_value`.`attr_id` AS `attr_id`,`seller_product_attribute_value`.`attr_value` AS `attr_value`,`seller_product_attribute_value`.`sku` AS `sku` from `seller_product_attribute_value` where (`seller_product_attribute_value`.`attr_id` in (select `attribute_real`.`attribute_id` from `attribute_real` where (`attribute_real`.`attribute_field_name` = 'Brand')) and (`seller_product_attribute_value`.`attr_value` is not null) and (`seller_product_attribute_value`.`attr_value` <> '')) union all select distinct `product_attribute_value`.`attr_id` AS `attr_id`,`product_attribute_value`.`attr_value` AS `attr_value`,`product_attribute_value`.`sku` AS `sku` from `product_attribute_value` where (`product_attribute_value`.`attr_id` in (select `attribute_real`.`attribute_id` from `attribute_real` where (`attribute_real`.`attribute_field_name` = 'Brand')) and (`product_attribute_value`.`attr_value` is not null) and (`product_attribute_value`.`attr_value` <> '')) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sku_brand_color`
--
DROP TABLE IF EXISTS `view_sku_brand_color`;

CREATE VIEW `view_sku_brand_color`  AS  select `a`.`sku` AS `sku`,`a`.`attr_value` AS `color`,`b`.`attr_id` AS `attr_id`,`b`.`attr_value` AS `brand` from (`view_sku_colors` `a` join `view_sku_brand` `b` on((`a`.`sku` = `b`.`sku`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sku_colors`
--
DROP TABLE IF EXISTS `view_sku_colors`;

CREATE VIEW `view_sku_colors`  AS  select distinct `seller_product_attribute_value`.`attr_id` AS `attr_id`,`seller_product_attribute_value`.`attr_value` AS `attr_value`,`seller_product_attribute_value`.`sku` AS `sku` from `seller_product_attribute_value` where (`seller_product_attribute_value`.`attr_id` in (select `attribute_real`.`attribute_id` from `attribute_real` where (`attribute_real`.`attribute_field_name` = 'Color')) and (`seller_product_attribute_value`.`attr_value` is not null) and (`seller_product_attribute_value`.`attr_value` <> '')) union all select distinct `product_attribute_value`.`attr_id` AS `attr_id`,`product_attribute_value`.`attr_value` AS `attr_value`,`product_attribute_value`.`sku` AS `sku` from `product_attribute_value` where (`product_attribute_value`.`attr_id` in (select `attribute_real`.`attribute_id` from `attribute_real` where (`attribute_real`.`attribute_field_name` = 'Color')) and (`product_attribute_value`.`attr_value` is not null) and (`product_attribute_value`.`attr_value` <> '')) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sku_size`
--
DROP TABLE IF EXISTS `view_sku_size`;

CREATE VIEW `view_sku_size`  AS  select distinct `seller_product_attribute_value`.`attr_id` AS `attr_id`,`seller_product_attribute_value`.`attr_value` AS `attr_value`,`seller_product_attribute_value`.`sku` AS `sku` from `seller_product_attribute_value` where (`seller_product_attribute_value`.`attr_id` in (select `attribute_real`.`attribute_id` from `attribute_real` where (`attribute_real`.`attribute_field_name` = 'Size')) and (`seller_product_attribute_value`.`attr_value` is not null) and (`seller_product_attribute_value`.`attr_value` <> '')) union all select distinct `product_attribute_value`.`attr_id` AS `attr_id`,`product_attribute_value`.`attr_value` AS `attr_value`,`product_attribute_value`.`sku` AS `sku` from `product_attribute_value` where (`product_attribute_value`.`attr_id` in (select `attribute_real`.`attribute_id` from `attribute_real` where (`attribute_real`.`attribute_field_name` = 'Size')) and (`product_attribute_value`.`attr_value` is not null) and (`product_attribute_value`.`attr_value` <> '')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
