-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vikuraa
-- ------------------------------------------------------
-- Server version	10.5.23-MariaDB-1:10.5.23+maria~ubu2004

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `vikuraa_app_config`
--

DROP TABLE IF EXISTS `vikuraa_app_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_app_config` (
  `key` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_app_config`
--

LOCK TABLES `vikuraa_app_config` WRITE;
/*!40000 ALTER TABLE `vikuraa_app_config` DISABLE KEYS */;
INSERT INTO `vikuraa_app_config` VALUES ('address','123 Nowhere street'),('allow_duplicate_barcodes','0'),('barcode_content','id'),('barcode_first_row','category'),('barcode_font','Arial'),('barcode_font_size','10'),('barcode_formats','[]'),('barcode_generate_if_empty','0'),('barcode_height','50'),('barcode_num_in_row','2'),('barcode_page_cellspacing','20'),('barcode_page_width','100'),('barcode_second_row','item_code'),('barcode_third_row','unit_price'),('barcode_type','Code39'),('barcode_width','250'),('cash_decimals','2'),('cash_rounding_code','0'),('company','Open Source Point of Sale'),('company_logo',''),('country_codes','us'),('currency_code',''),('currency_decimals','2'),('currency_symbol','$'),('customer_reward_enable','0'),('dateformat','m/d/Y'),('date_or_time_format',''),('default_receivings_discount','0'),('default_receivings_discount_type','0'),('default_register_mode','sale'),('default_sales_discount','0'),('default_sales_discount_type','0'),('default_tax_1_name',''),('default_tax_1_rate',''),('default_tax_2_name',''),('default_tax_2_rate',''),('default_tax_category','Standard'),('default_tax_code',''),('default_tax_jurisdiction',''),('default_tax_rate','8'),('derive_sale_quantity','0'),('dinner_table_enable','0'),('email','changeme@example.com'),('email_receipt_check_behaviour','last'),('enforce_privacy','0'),('fax',''),('financial_year','1'),('gcaptcha_enable','0'),('gcaptcha_secret_key',''),('gcaptcha_site_key',''),('giftcard_number','series'),('image_allowed_types','gif|jpg|png'),('image_max_height','480'),('image_max_size','128'),('image_max_width','640'),('include_hsn','0'),('invoice_default_comments','This is a default comment'),('invoice_email_message','Dear {CU}, In attachment the receipt for sale {ISEQ}'),('invoice_enable','1'),('invoice_type','invoice'),('language','english'),('language_code','en-US'),('last_used_invoice_number','0'),('last_used_quote_number','0'),('last_used_work_order_number','0'),('lines_per_page','25'),('line_sequence','0'),('login_form','floating_labels'),('mailpath','/usr/sbin/sendmail'),('msg_msg',''),('msg_pwd',''),('msg_src',''),('msg_uid',''),('multi_pack_enabled','0'),('notify_horizontal_position','center'),('notify_vertical_position','bottom'),('number_locale','en_US'),('payment_options_order','cashdebitcredit'),('phone','555-555-5555'),('print_bottom_margin','0'),('print_delay_autoreturn','0'),('print_footer','0'),('print_header','0'),('print_left_margin','0'),('print_receipt_check_behaviour','last'),('print_right_margin','0'),('print_silently','1'),('print_top_margin','0'),('protocol','mail'),('quantity_decimals','0'),('quote_default_comments','This is a default quote comment'),('receipt_font_size','12'),('receipt_show_company_name','1'),('receipt_show_description','1'),('receipt_show_serialnumber','1'),('receipt_show_taxes','0'),('receipt_show_tax_ind','0'),('receipt_show_total_discount','1'),('receipt_template','receipt_default'),('receiving_calculate_average_price','0'),('recv_invoice_format','{CO}'),('return_policy','Test'),('sales_invoice_format','{CO}'),('sales_quote_format','Q%y{QSEQ:6}'),('smtp_crypto','ssl'),('smtp_host',''),('smtp_pass',''),('smtp_port','465'),('smtp_timeout','5'),('smtp_user',''),('suggestions_first_column','name'),('suggestions_second_column',''),('suggestions_third_column',''),('tax_decimals','2'),('tax_id',''),('tax_included','0'),('theme','flatly'),('thousands_separator','1'),('timeformat','H:i:s'),('timezone','America/New_York'),('use_destination_based_tax','0'),('website',''),('work_order_enable','0'),('work_order_format','W%y{WSEQ:6}');
/*!40000 ALTER TABLE `vikuraa_app_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_attribute_definitions`
--

DROP TABLE IF EXISTS `vikuraa_attribute_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_attribute_definitions` (
  `definition_id` int(10) NOT NULL AUTO_INCREMENT,
  `definition_name` varchar(255) NOT NULL,
  `definition_type` varchar(45) NOT NULL,
  `definition_unit` varchar(16) DEFAULT NULL,
  `definition_flags` tinyint(1) NOT NULL,
  `definition_fk` int(10) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`definition_id`),
  KEY `definition_fk` (`definition_fk`),
  KEY `definition_name` (`definition_name`),
  KEY `definition_type` (`definition_type`),
  CONSTRAINT `fk_vikuraa_attribute_definitions_ibfk_1` FOREIGN KEY (`definition_fk`) REFERENCES `vikuraa_attribute_definitions` (`definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_attribute_definitions`
--

LOCK TABLES `vikuraa_attribute_definitions` WRITE;
/*!40000 ALTER TABLE `vikuraa_attribute_definitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_attribute_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_attribute_links`
--

DROP TABLE IF EXISTS `vikuraa_attribute_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_attribute_links` (
  `attribute_id` int(11) DEFAULT NULL,
  `definition_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `receiving_id` int(11) DEFAULT NULL,
  UNIQUE KEY `attribute_links_uq1` (`attribute_id`,`definition_id`,`item_id`,`sale_id`,`receiving_id`),
  UNIQUE KEY `attribute_links_uq2` (`item_id`,`sale_id`,`receiving_id`,`definition_id`,`attribute_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `definition_id` (`definition_id`),
  KEY `item_id` (`item_id`),
  KEY `sale_id` (`sale_id`),
  KEY `receiving_id` (`receiving_id`),
  CONSTRAINT `vikuraa_attribute_links_ibfk_1` FOREIGN KEY (`definition_id`) REFERENCES `vikuraa_attribute_definitions` (`definition_id`) ON DELETE CASCADE,
  CONSTRAINT `vikuraa_attribute_links_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `vikuraa_attribute_values` (`attribute_id`) ON DELETE CASCADE,
  CONSTRAINT `vikuraa_attribute_links_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `vikuraa_items` (`item_id`),
  CONSTRAINT `vikuraa_attribute_links_ibfk_4` FOREIGN KEY (`receiving_id`) REFERENCES `vikuraa_receivings` (`receiving_id`) ON DELETE CASCADE,
  CONSTRAINT `vikuraa_attribute_links_ibfk_5` FOREIGN KEY (`sale_id`) REFERENCES `vikuraa_sales` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_attribute_links`
--

LOCK TABLES `vikuraa_attribute_links` WRITE;
/*!40000 ALTER TABLE `vikuraa_attribute_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_attribute_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_attribute_values`
--

DROP TABLE IF EXISTS `vikuraa_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_attribute_values` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_value` varchar(255) DEFAULT NULL,
  `attribute_date` date DEFAULT NULL,
  `attribute_decimal` decimal(7,3) DEFAULT NULL,
  PRIMARY KEY (`attribute_id`),
  UNIQUE KEY `attribute_value` (`attribute_value`),
  UNIQUE KEY `attribute_date` (`attribute_date`),
  UNIQUE KEY `attribute_decimal` (`attribute_decimal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_attribute_values`
--

LOCK TABLES `vikuraa_attribute_values` WRITE;
/*!40000 ALTER TABLE `vikuraa_attribute_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_attribute_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_cash_up`
--

DROP TABLE IF EXISTS `vikuraa_cash_up`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_cash_up` (
  `cashup_id` int(10) NOT NULL AUTO_INCREMENT,
  `open_date` timestamp NULL DEFAULT current_timestamp(),
  `close_date` timestamp NULL DEFAULT NULL,
  `open_amount_cash` decimal(15,2) NOT NULL,
  `transfer_amount_cash` decimal(15,2) NOT NULL,
  `note` int(1) NOT NULL,
  `closed_amount_cash` decimal(15,2) NOT NULL,
  `closed_amount_card` decimal(15,2) NOT NULL,
  `closed_amount_check` decimal(15,2) NOT NULL,
  `closed_amount_total` decimal(15,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `open_employee_id` int(10) NOT NULL,
  `close_employee_id` int(10) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `closed_amount_due` decimal(15,2) NOT NULL,
  PRIMARY KEY (`cashup_id`),
  KEY `open_employee_id` (`open_employee_id`),
  KEY `close_employee_id` (`close_employee_id`),
  CONSTRAINT `vikuraa_cash_up_ibfk_1` FOREIGN KEY (`open_employee_id`) REFERENCES `vikuraa_employees` (`person_id`),
  CONSTRAINT `vikuraa_cash_up_ibfk_2` FOREIGN KEY (`close_employee_id`) REFERENCES `vikuraa_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_cash_up`
--

LOCK TABLES `vikuraa_cash_up` WRITE;
/*!40000 ALTER TABLE `vikuraa_cash_up` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_cash_up` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_customers`
--

DROP TABLE IF EXISTS `vikuraa_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_customers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `taxable` tinyint(1) NOT NULL DEFAULT 1,
  `tax_id` varchar(32) NOT NULL DEFAULT '',
  `sales_tax_code_id` int(11) DEFAULT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_type` tinyint(1) NOT NULL DEFAULT 0,
  `package_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(10) NOT NULL,
  `consent` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `account_number` (`account_number`),
  KEY `package_id` (`package_id`),
  KEY `sales_tax_code_id` (`sales_tax_code_id`),
  KEY `company_name` (`company_name`),
  CONSTRAINT `vikuraa_customers_ibfk_3` FOREIGN KEY (`sales_tax_code_id`) REFERENCES `vikuraa_tax_codes` (`tax_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_customers`
--

LOCK TABLES `vikuraa_customers` WRITE;
/*!40000 ALTER TABLE `vikuraa_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_customers_packages`
--

DROP TABLE IF EXISTS `vikuraa_customers_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_customers_packages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) DEFAULT NULL,
  `points_percent` float NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_customers_packages`
--

LOCK TABLES `vikuraa_customers_packages` WRITE;
/*!40000 ALTER TABLE `vikuraa_customers_packages` DISABLE KEYS */;
INSERT INTO `vikuraa_customers_packages` VALUES (1,'Default',0,0),(2,'Bronze',10,0),(3,'Silver',20,0),(4,'Gold',30,0),(5,'Premium',50,0);
/*!40000 ALTER TABLE `vikuraa_customers_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_customers_points`
--

DROP TABLE IF EXISTS `vikuraa_customers_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_customers_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `points_earned` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  KEY `package_id` (`package_id`),
  KEY `sale_id` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_customers_points`
--

LOCK TABLES `vikuraa_customers_points` WRITE;
/*!40000 ALTER TABLE `vikuraa_customers_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_customers_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_dinner_tables`
--

DROP TABLE IF EXISTS `vikuraa_dinner_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_dinner_tables` (
  `dinner_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`dinner_table_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_dinner_tables`
--

LOCK TABLES `vikuraa_dinner_tables` WRITE;
/*!40000 ALTER TABLE `vikuraa_dinner_tables` DISABLE KEYS */;
INSERT INTO `vikuraa_dinner_tables` VALUES (1,'Delivery',0,0),(2,'Take Away',0,0);
/*!40000 ALTER TABLE `vikuraa_dinner_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_employees`
--

DROP TABLE IF EXISTS `vikuraa_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_employees` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `hash_version` tinyint(1) NOT NULL DEFAULT 2,
  `language` varchar(48) DEFAULT NULL,
  `language_code` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_employees`
--

LOCK TABLES `vikuraa_employees` WRITE;
/*!40000 ALTER TABLE `vikuraa_employees` DISABLE KEYS */;
INSERT INTO `vikuraa_employees` VALUES ('admin','$2y$10$vJBSMlD02EC7ENSrKfVQXuvq9tNRHMtcOA8MSK2NYS748HHWm.gcG',1,0,2,NULL,NULL);
/*!40000 ALTER TABLE `vikuraa_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_expense_categories`
--

DROP TABLE IF EXISTS `vikuraa_expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_expense_categories` (
  `expense_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`expense_category_id`),
  UNIQUE KEY `category_name` (`category_name`),
  KEY `category_description` (`category_description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_expense_categories`
--

LOCK TABLES `vikuraa_expense_categories` WRITE;
/*!40000 ALTER TABLE `vikuraa_expense_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_expense_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_expenses`
--

DROP TABLE IF EXISTS `vikuraa_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_expenses` (
  `expense_id` int(10) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `amount` decimal(15,2) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `supplier_tax_code` varchar(255) DEFAULT NULL,
  `tax_amount` decimal(15,2) DEFAULT NULL,
  `supplier_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`expense_id`),
  KEY `expense_category_id` (`expense_category_id`),
  KEY `employee_id` (`employee_id`),
  KEY `vikuraa_expenses_ibfk_3` (`supplier_id`),
  KEY `date` (`date`),
  KEY `payment_type` (`payment_type`),
  KEY `amount` (`amount`),
  CONSTRAINT `vikuraa_expenses_ibfk_1` FOREIGN KEY (`expense_category_id`) REFERENCES `vikuraa_expense_categories` (`expense_category_id`),
  CONSTRAINT `vikuraa_expenses_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `vikuraa_employees` (`person_id`),
  CONSTRAINT `vikuraa_expenses_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `vikuraa_suppliers` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_expenses`
--

LOCK TABLES `vikuraa_expenses` WRITE;
/*!40000 ALTER TABLE `vikuraa_expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_giftcards`
--

DROP TABLE IF EXISTS `vikuraa_giftcards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_giftcards` (
  `record_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `giftcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `giftcard_number` varchar(255) DEFAULT NULL,
  `value` decimal(15,2) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `person_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`giftcard_id`),
  UNIQUE KEY `giftcard_number` (`giftcard_number`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_giftcards`
--

LOCK TABLES `vikuraa_giftcards` WRITE;
/*!40000 ALTER TABLE `vikuraa_giftcards` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_giftcards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_grants`
--

DROP TABLE IF EXISTS `vikuraa_grants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_grants` (
  `permission_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `menu_group` varchar(32) DEFAULT 'home',
  PRIMARY KEY (`permission_id`,`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_grants`
--

LOCK TABLES `vikuraa_grants` WRITE;
/*!40000 ALTER TABLE `vikuraa_grants` DISABLE KEYS */;
INSERT INTO `vikuraa_grants` VALUES ('attributes',1,'office'),('cashups',1,'home'),('config',1,'office'),('customers',1,'home'),('employees',1,'office'),('expenses',1,'home'),('expenses_categories',1,'office'),('giftcards',1,'home'),('home',1,'office'),('items',1,'home'),('items_stock',1,'home'),('item_kits',1,'home'),('messages',1,'home'),('office',1,'home'),('receivings',1,'home'),('receivings_stock',1,'home'),('reports',1,'home'),('reports_categories',1,'home'),('reports_customers',1,'home'),('reports_discounts',1,'home'),('reports_employees',1,'home'),('reports_expenses_categories',1,'home'),('reports_inventory',1,'home'),('reports_items',1,'home'),('reports_payments',1,'home'),('reports_receivings',1,'home'),('reports_sales',1,'home'),('reports_sales_taxes',1,'home'),('reports_suppliers',1,'home'),('reports_taxes',1,'home'),('sales',1,'home'),('sales_change_price',1,'--'),('sales_delete',1,'--'),('sales_stock',1,'home'),('suppliers',1,'home'),('taxes',1,'office');
/*!40000 ALTER TABLE `vikuraa_grants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_inventory`
--

DROP TABLE IF EXISTS `vikuraa_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_inventory` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_items` int(11) NOT NULL DEFAULT 0,
  `trans_user` int(11) NOT NULL DEFAULT 0,
  `trans_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `trans_comment` text NOT NULL,
  `trans_location` int(11) NOT NULL,
  `trans_inventory` decimal(15,3) NOT NULL DEFAULT 0.000,
  PRIMARY KEY (`trans_id`),
  KEY `trans_items` (`trans_items`),
  KEY `trans_user` (`trans_user`),
  KEY `trans_location` (`trans_location`),
  KEY `trans_date` (`trans_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_inventory`
--

LOCK TABLES `vikuraa_inventory` WRITE;
/*!40000 ALTER TABLE `vikuraa_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_item_kit_items`
--

DROP TABLE IF EXISTS `vikuraa_item_kit_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_item_kit_items` (
  `item_kit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(15,3) NOT NULL,
  `kit_sequence` int(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_kit_id`,`item_id`,`quantity`),
  KEY `vikuraa_item_kit_items_ibfk_2` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_item_kit_items`
--

LOCK TABLES `vikuraa_item_kit_items` WRITE;
/*!40000 ALTER TABLE `vikuraa_item_kit_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_item_kit_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_item_kits`
--

DROP TABLE IF EXISTS `vikuraa_item_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_item_kits` (
  `item_kit_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_kit_number` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `kit_discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `kit_discount_type` tinyint(1) NOT NULL DEFAULT 0,
  `price_option` tinyint(1) NOT NULL DEFAULT 0,
  `print_option` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`item_kit_id`),
  KEY `item_kit_number` (`item_kit_number`),
  KEY `name` (`name`,`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_item_kits`
--

LOCK TABLES `vikuraa_item_kits` WRITE;
/*!40000 ALTER TABLE `vikuraa_item_kits` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_item_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_item_quantities`
--

DROP TABLE IF EXISTS `vikuraa_item_quantities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_item_quantities` (
  `item_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `quantity` decimal(15,3) NOT NULL DEFAULT 0.000,
  PRIMARY KEY (`item_id`,`location_id`),
  KEY `item_id` (`item_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_item_quantities`
--

LOCK TABLES `vikuraa_item_quantities` WRITE;
/*!40000 ALTER TABLE `vikuraa_item_quantities` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_item_quantities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_items`
--

DROP TABLE IF EXISTS `vikuraa_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_items` (
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item_number` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `reorder_level` decimal(15,3) NOT NULL DEFAULT 0.000,
  `receiving_quantity` decimal(15,3) NOT NULL DEFAULT 1.000,
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `pic_filename` varchar(255) DEFAULT NULL,
  `allow_alt_description` tinyint(1) NOT NULL,
  `is_serialized` tinyint(1) NOT NULL,
  `stock_type` tinyint(1) NOT NULL DEFAULT 0,
  `item_type` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `tax_category_id` int(10) DEFAULT NULL,
  `qty_per_pack` decimal(15,3) NOT NULL DEFAULT 1.000,
  `pack_name` varchar(8) DEFAULT 'Each',
  `low_sell_item_id` int(10) DEFAULT 0,
  `hsn_code` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `items_uq1` (`supplier_id`,`item_id`,`deleted`,`item_type`),
  KEY `item_number` (`item_number`),
  KEY `supplier_id` (`supplier_id`),
  KEY `deleted` (`deleted`,`item_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_items`
--

LOCK TABLES `vikuraa_items` WRITE;
/*!40000 ALTER TABLE `vikuraa_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_items_taxes`
--

DROP TABLE IF EXISTS `vikuraa_items_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_items_taxes` (
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL,
  PRIMARY KEY (`item_id`,`name`,`percent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_items_taxes`
--

LOCK TABLES `vikuraa_items_taxes` WRITE;
/*!40000 ALTER TABLE `vikuraa_items_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_items_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_migrations`
--

DROP TABLE IF EXISTS `vikuraa_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_migrations`
--

LOCK TABLES `vikuraa_migrations` WRITE;
/*!40000 ALTER TABLE `vikuraa_migrations` DISABLE KEYS */;
INSERT INTO `vikuraa_migrations` VALUES (20210714140000);
/*!40000 ALTER TABLE `vikuraa_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_modules`
--

DROP TABLE IF EXISTS `vikuraa_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_modules`
--

LOCK TABLES `vikuraa_modules` WRITE;
/*!40000 ALTER TABLE `vikuraa_modules` DISABLE KEYS */;
INSERT INTO `vikuraa_modules` VALUES ('module_attributes','module_attributes_desc',107,'attributes'),('module_cashups','module_cashups_desc',110,'cashups'),('module_config','module_config_desc',900,'config'),('module_customers','module_customers_desc',10,'customers'),('module_employees','module_employees_desc',80,'employees'),('module_expenses','module_expenses_desc',108,'expenses'),('module_expenses_categories','module_expenses_categories_desc',109,'expenses_categories'),('module_giftcards','module_giftcards_desc',90,'giftcards'),('module_home','module_home_desc',1,'home'),('module_items','module_items_desc',20,'items'),('module_item_kits','module_item_kits_desc',30,'item_kits'),('module_messages','module_messages_desc',98,'messages'),('module_office','module_office_desc',999,'office'),('module_receivings','module_receivings_desc',60,'receivings'),('module_reports','module_reports_desc',50,'reports'),('module_sales','module_sales_desc',70,'sales'),('module_suppliers','module_suppliers_desc',40,'suppliers'),('module_taxes','module_taxes_desc',105,'taxes');
/*!40000 ALTER TABLE `vikuraa_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_people`
--

DROP TABLE IF EXISTS `vikuraa_people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `person_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`person_id`),
  KEY `email` (`email`),
  KEY `first_name` (`first_name`,`last_name`,`email`,`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_people`
--

LOCK TABLES `vikuraa_people` WRITE;
/*!40000 ALTER TABLE `vikuraa_people` DISABLE KEYS */;
INSERT INTO `vikuraa_people` VALUES ('John','Doe',NULL,'555-555-5555','changeme@example.com','Address 1','','','','','','',1);
/*!40000 ALTER TABLE `vikuraa_people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_permissions`
--

DROP TABLE IF EXISTS `vikuraa_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_permissions` (
  `permission_id` varchar(255) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `location_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_permissions`
--

LOCK TABLES `vikuraa_permissions` WRITE;
/*!40000 ALTER TABLE `vikuraa_permissions` DISABLE KEYS */;
INSERT INTO `vikuraa_permissions` VALUES ('attributes','attributes',NULL),('cashups','cashups',NULL),('config','config',NULL),('customers','customers',NULL),('employees','employees',NULL),('expenses','expenses',NULL),('expenses_categories','expenses_categories',NULL),('giftcards','giftcards',NULL),('home','home',NULL),('items','items',NULL),('items_stock','items',1),('item_kits','item_kits',NULL),('messages','messages',NULL),('office','office',NULL),('receivings','receivings',NULL),('receivings_stock','receivings',1),('reports','reports',NULL),('reports_categories','reports',NULL),('reports_customers','reports',NULL),('reports_discounts','reports',NULL),('reports_employees','reports',NULL),('reports_expenses_categories','reports',NULL),('reports_inventory','reports',NULL),('reports_items','reports',NULL),('reports_payments','reports',NULL),('reports_receivings','reports',NULL),('reports_sales','reports',NULL),('reports_sales_taxes','reports',NULL),('reports_suppliers','reports',NULL),('reports_taxes','reports',NULL),('sales','sales',NULL),('sales_change_price','sales',NULL),('sales_delete','sales',NULL),('sales_stock','sales',1),('suppliers','suppliers',NULL),('taxes','taxes',NULL);
/*!40000 ALTER TABLE `vikuraa_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_receivings`
--

DROP TABLE IF EXISTS `vikuraa_receivings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_receivings` (
  `receiving_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `receiving_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(20) DEFAULT NULL,
  `reference` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`receiving_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `employee_id` (`employee_id`),
  KEY `reference` (`reference`),
  KEY `receiving_time` (`receiving_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_receivings`
--

LOCK TABLES `vikuraa_receivings` WRITE;
/*!40000 ALTER TABLE `vikuraa_receivings` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_receivings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_receivings_items`
--

DROP TABLE IF EXISTS `vikuraa_receivings_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_receivings_items` (
  `receiving_id` int(10) NOT NULL DEFAULT 0,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL,
  `quantity_purchased` decimal(15,3) NOT NULL DEFAULT 0.000,
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_type` tinyint(1) NOT NULL DEFAULT 0,
  `item_location` int(11) NOT NULL,
  `receiving_quantity` decimal(15,3) NOT NULL DEFAULT 1.000,
  PRIMARY KEY (`receiving_id`,`item_id`,`line`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_receivings_items`
--

LOCK TABLES `vikuraa_receivings_items` WRITE;
/*!40000 ALTER TABLE `vikuraa_receivings_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_receivings_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sales`
--

DROP TABLE IF EXISTS `vikuraa_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sales` (
  `sale_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `invoice_number` varchar(32) DEFAULT NULL,
  `quote_number` varchar(32) DEFAULT NULL,
  `sale_id` int(10) NOT NULL AUTO_INCREMENT,
  `sale_status` tinyint(1) NOT NULL DEFAULT 0,
  `dinner_table_id` int(11) DEFAULT NULL,
  `work_order_number` varchar(32) DEFAULT NULL,
  `sale_type` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sale_id`),
  UNIQUE KEY `invoice_number` (`invoice_number`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  KEY `sale_time` (`sale_time`),
  KEY `dinner_table_id` (`dinner_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sales`
--

LOCK TABLES `vikuraa_sales` WRITE;
/*!40000 ALTER TABLE `vikuraa_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sales_items`
--

DROP TABLE IF EXISTS `vikuraa_sales_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sales_items` (
  `sale_id` int(10) NOT NULL DEFAULT 0,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT 0,
  `quantity_purchased` decimal(15,3) NOT NULL DEFAULT 0.000,
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_type` tinyint(1) NOT NULL DEFAULT 0,
  `item_location` int(11) NOT NULL,
  `print_option` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sale_id`,`item_id`,`line`),
  KEY `sale_id` (`sale_id`),
  KEY `item_id` (`item_id`),
  KEY `item_location` (`item_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sales_items`
--

LOCK TABLES `vikuraa_sales_items` WRITE;
/*!40000 ALTER TABLE `vikuraa_sales_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_sales_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sales_items_taxes`
--

DROP TABLE IF EXISTS `vikuraa_sales_items_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sales_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(3) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `tax_type` tinyint(1) NOT NULL DEFAULT 0,
  `rounding_code` tinyint(1) NOT NULL DEFAULT 0,
  `cascade_sequence` tinyint(1) NOT NULL DEFAULT 0,
  `item_tax_amount` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `sales_tax_code_id` int(11) DEFAULT NULL,
  `jurisdiction_id` int(11) DEFAULT NULL,
  `tax_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`),
  KEY `sale_id` (`sale_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sales_items_taxes`
--

LOCK TABLES `vikuraa_sales_items_taxes` WRITE;
/*!40000 ALTER TABLE `vikuraa_sales_items_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_sales_items_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sales_payments`
--

DROP TABLE IF EXISTS `vikuraa_sales_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sales_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  `cash_refund` decimal(15,2) NOT NULL DEFAULT 0.00,
  `cash_adjustment` tinyint(4) NOT NULL DEFAULT 0,
  `employee_id` int(11) DEFAULT NULL,
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_code` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`payment_id`),
  KEY `payment_sale` (`sale_id`,`payment_type`),
  KEY `employee_id` (`employee_id`),
  KEY `payment_time` (`payment_time`),
  CONSTRAINT `vikuraa_sales_payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `vikuraa_sales` (`sale_id`),
  CONSTRAINT `vikuraa_sales_payments_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `vikuraa_employees` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sales_payments`
--

LOCK TABLES `vikuraa_sales_payments` WRITE;
/*!40000 ALTER TABLE `vikuraa_sales_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_sales_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sales_reward_points`
--

DROP TABLE IF EXISTS `vikuraa_sales_reward_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sales_reward_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `earned` float NOT NULL,
  `used` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sales_reward_points`
--

LOCK TABLES `vikuraa_sales_reward_points` WRITE;
/*!40000 ALTER TABLE `vikuraa_sales_reward_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_sales_reward_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sales_taxes`
--

DROP TABLE IF EXISTS `vikuraa_sales_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sales_taxes` (
  `sales_taxes_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) NOT NULL,
  `jurisdiction_id` int(11) DEFAULT NULL,
  `tax_category_id` int(11) DEFAULT NULL,
  `tax_type` smallint(2) NOT NULL,
  `tax_group` varchar(32) NOT NULL,
  `sale_tax_basis` decimal(15,4) NOT NULL,
  `sale_tax_amount` decimal(15,4) NOT NULL,
  `print_sequence` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `tax_rate` decimal(15,4) NOT NULL,
  `sales_tax_code_id` int(11) DEFAULT NULL,
  `rounding_code` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sales_taxes_id`),
  KEY `print_sequence` (`sale_id`,`print_sequence`,`tax_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sales_taxes`
--

LOCK TABLES `vikuraa_sales_taxes` WRITE;
/*!40000 ALTER TABLE `vikuraa_sales_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_sales_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_sessions`
--

DROP TABLE IF EXISTS `vikuraa_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` mediumblob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`),
  KEY `id` (`id`),
  KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_sessions`
--

LOCK TABLES `vikuraa_sessions` WRITE;
/*!40000 ALTER TABLE `vikuraa_sessions` DISABLE KEYS */;
INSERT INTO `vikuraa_sessions` VALUES ('a33b9f0157c4a8e923d48913c4207c0562904fd7','10.1.119.208',1706345020,'__ci_last_regenerate|i:1706345020;person_id|s:1:\"1\";menu_group|s:4:\"home\";'),('ea9e274cbd232874a010d6b99c1f0908d731840e','10.1.103.139',1706343927,'__ci_last_regenerate|i:1706343927;'),('dca6553c9fae4e147443367168dd0137bf87a252','10.1.119.208',1706345039,'__ci_last_regenerate|i:1706345020;person_id|s:1:\"1\";menu_group|s:4:\"home\";'),('5f84c8eba09f92175265271d7938d94f931c5cf3','10.1.119.208',1706346590,'__ci_last_regenerate|i:1706346590;'),('5454a99db843a45424bbad5ae74e3330bb33dc6c','10.1.119.208',1706345755,'__ci_last_regenerate|i:1706345755;'),('9980959ec389faebed8420762521b0597f9563ba','10.1.119.208',1706346604,'__ci_last_regenerate|i:1706346590;');
/*!40000 ALTER TABLE `vikuraa_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_stock_locations`
--

DROP TABLE IF EXISTS `vikuraa_stock_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_stock_locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_stock_locations`
--

LOCK TABLES `vikuraa_stock_locations` WRITE;
/*!40000 ALTER TABLE `vikuraa_stock_locations` DISABLE KEYS */;
INSERT INTO `vikuraa_stock_locations` VALUES (1,'stock',0);
/*!40000 ALTER TABLE `vikuraa_stock_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_suppliers`
--

DROP TABLE IF EXISTS `vikuraa_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_suppliers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `tax_id` varchar(32) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `category` tinyint(1) NOT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `account_number` (`account_number`),
  KEY `person_id` (`person_id`),
  KEY `category` (`category`),
  KEY `company_name` (`company_name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_suppliers`
--

LOCK TABLES `vikuraa_suppliers` WRITE;
/*!40000 ALTER TABLE `vikuraa_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_tax_categories`
--

DROP TABLE IF EXISTS `vikuraa_tax_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_tax_categories` (
  `tax_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `tax_category` varchar(32) NOT NULL,
  `tax_group_sequence` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tax_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_tax_categories`
--

LOCK TABLES `vikuraa_tax_categories` WRITE;
/*!40000 ALTER TABLE `vikuraa_tax_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_tax_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_tax_codes`
--

DROP TABLE IF EXISTS `vikuraa_tax_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_tax_codes` (
  `tax_code_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_code` varchar(32) NOT NULL,
  `tax_code_name` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tax_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_tax_codes`
--

LOCK TABLES `vikuraa_tax_codes` WRITE;
/*!40000 ALTER TABLE `vikuraa_tax_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_tax_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_tax_jurisdictions`
--

DROP TABLE IF EXISTS `vikuraa_tax_jurisdictions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_tax_jurisdictions` (
  `jurisdiction_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurisdiction_name` varchar(255) DEFAULT NULL,
  `tax_group` varchar(32) NOT NULL,
  `tax_type` smallint(2) NOT NULL,
  `reporting_authority` varchar(255) DEFAULT NULL,
  `tax_group_sequence` tinyint(1) NOT NULL DEFAULT 0,
  `cascade_sequence` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`jurisdiction_id`),
  UNIQUE KEY `tax_jurisdictions_uq1` (`tax_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_tax_jurisdictions`
--

LOCK TABLES `vikuraa_tax_jurisdictions` WRITE;
/*!40000 ALTER TABLE `vikuraa_tax_jurisdictions` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_tax_jurisdictions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vikuraa_tax_rates`
--

DROP TABLE IF EXISTS `vikuraa_tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vikuraa_tax_rates` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `rate_tax_code_id` int(11) NOT NULL,
  `rate_tax_category_id` int(10) NOT NULL,
  `rate_jurisdiction_id` int(11) NOT NULL,
  `tax_rate` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `tax_rounding_code` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tax_rate_id`),
  KEY `rate_tax_category_id` (`rate_tax_category_id`),
  KEY `rate_tax_code_id` (`rate_tax_code_id`),
  KEY `rate_jurisdiction_id` (`rate_jurisdiction_id`),
  CONSTRAINT `vikuraa_tax_rates_ibfk_1` FOREIGN KEY (`rate_tax_category_id`) REFERENCES `vikuraa_tax_categories` (`tax_category_id`),
  CONSTRAINT `vikuraa_tax_rates_ibfk_2` FOREIGN KEY (`rate_tax_code_id`) REFERENCES `vikuraa_tax_codes` (`tax_code_id`),
  CONSTRAINT `vikuraa_tax_rates_ibfk_3` FOREIGN KEY (`rate_jurisdiction_id`) REFERENCES `vikuraa_tax_jurisdictions` (`jurisdiction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vikuraa_tax_rates`
--

LOCK TABLES `vikuraa_tax_rates` WRITE;
/*!40000 ALTER TABLE `vikuraa_tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `vikuraa_tax_rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-28 14:50:48
