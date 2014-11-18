-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2014 at 05:47 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `linckt-scm`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_company`
--

CREATE TABLE IF NOT EXISTS `client_company` (
  `id` int(11) NOT NULL,
  `client_name` varchar(45) NOT NULL,
  `client_address` varchar(45) NOT NULL,
  `client_companytype` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_employee`
--

CREATE TABLE IF NOT EXISTS `client_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cemp_firstname` varchar(45) NOT NULL,
  `cemp_lastname` varchar(45) NOT NULL,
  `cemp_midinitial` varchar(45) DEFAULT NULL,
  `cemp_postion` varchar(45) NOT NULL,
  `cemp_contactnum` varchar(45) NOT NULL,
  `client_company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_employee_client_company_idx` (`client_company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_transaction`
--

CREATE TABLE IF NOT EXISTS `delivery_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_date` varchar(45) NOT NULL,
  `delivery_time` varchar(45) NOT NULL,
  `delivery_status` varchar(45) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `linckt_employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_delivery_transaction_purchase_order1_idx` (`purchase_order_id`),
  KEY `fk_delivery_transaction_linckt_employee1_idx` (`linckt_employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `linckt_employee`
--

CREATE TABLE IF NOT EXISTS `linckt_employee` (
  `id` int(11) NOT NULL,
  `emp_firstname` varchar(45) NOT NULL,
  `emp_lastname` varchar(45) NOT NULL,
  `emp_midinitial` varchar(45) DEFAULT NULL,
  `emp_position` varchar(45) NOT NULL,
  `emp_contactnum` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipt`
--

CREATE TABLE IF NOT EXISTS `payment_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_amt` varchar(45) NOT NULL,
  `pr_type` varchar(45) NOT NULL,
  `pr_dateissued` varchar(45) NOT NULL,
  `or_num` varchar(45) DEFAULT NULL,
  `pr_paymenttype` varchar(45) NOT NULL,
  `provisional_receipt_id` int(11) DEFAULT NULL,
  `client_company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_receipt_provisional_receipt1_idx` (`provisional_receipt_id`),
  KEY `fk_payment_receipt_client_company1_idx` (`client_company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(45) NOT NULL,
  `prod_desc` varchar(45) NOT NULL,
  `prod_price` double NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_product_category1_idx` (`product_category_id`),
  KEY `fk_product_supplier1_idx` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pcat_name` varchar(45) NOT NULL,
  `pcat_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `provisional_receipt`
--

CREATE TABLE IF NOT EXISTS `provisional_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_status` varchar(45) DEFAULT NULL,
  `prov_dateissued` varchar(45) DEFAULT NULL,
  `prov_checkdate` varchar(45) DEFAULT NULL,
  `prov_checknum` varchar(45) DEFAULT NULL,
  `prov_checkbank` varchar(45) DEFAULT NULL,
  `prov_checkbankbranch` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_date` varchar(45) NOT NULL,
  `client_company_id` int(11) NOT NULL,
  `linckt_employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_order_client_company1_idx` (`client_company_id`),
  KEY `fk_purchase_order_linckt_employee1_idx` (`linckt_employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orderline`
--

CREATE TABLE IF NOT EXISTS `purchase_orderline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_productqty` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_orderline_purchase_order1_idx` (`purchase_order_id`),
  KEY `fk_purchase_orderline_product1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice`
--

CREATE TABLE IF NOT EXISTS `sales_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linckt_employee_id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `payment_receipt_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sales_invoice_linckt_employee1_idx` (`linckt_employee_id`),
  KEY `fk_sales_invoice_purchase_order1_idx` (`purchase_order_id`),
  KEY `fk_sales_invoice_payment_receipt1_idx` (`payment_receipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supp_name` varchar(45) NOT NULL,
  `supp_address` varchar(45) NOT NULL,
  `supp_contactnum` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_firstname` varchar(45) NOT NULL,
  `u_middleinitial` char(3) NOT NULL,
  `u_lastname` varchar(45) NOT NULL,
  `u_employeenum` varchar(45) NOT NULL,
  `u_username` varchar(45) NOT NULL,
  `u_password` varchar(45) NOT NULL,
  `u_usertype` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_firstname`, `u_middleinitial`, `u_lastname`, `u_employeenum`, `u_username`, `u_password`, `u_usertype`) VALUES
(1, 'Philip John', 'M', 'Rellosa', '2012-100096', 'adminphilip', 'adminadmin', 'admin'),
(2, 'Juan', 'D', 'Cruz', '1890-000001', 'jdcruz', 'panday', 'regular'),
(3, 'Jamie', 'Z', 'Hill', '1890-0001234', 'jzhill', 'regularregular', 'supplier');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_employee`
--
ALTER TABLE `client_employee`
  ADD CONSTRAINT `fk_client_employee_client_company` FOREIGN KEY (`client_company_id`) REFERENCES `client_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `delivery_transaction`
--
ALTER TABLE `delivery_transaction`
  ADD CONSTRAINT `fk_delivery_transaction_linckt_employee1` FOREIGN KEY (`linckt_employee_id`) REFERENCES `linckt_employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_delivery_transaction_purchase_order1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  ADD CONSTRAINT `fk_payment_receipt_client_company1` FOREIGN KEY (`client_company_id`) REFERENCES `client_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_receipt_provisional_receipt1` FOREIGN KEY (`provisional_receipt_id`) REFERENCES `provisional_receipt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `fk_purchase_order_client_company1` FOREIGN KEY (`client_company_id`) REFERENCES `client_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_purchase_order_linckt_employee1` FOREIGN KEY (`linckt_employee_id`) REFERENCES `linckt_employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_orderline`
--
ALTER TABLE `purchase_orderline`
  ADD CONSTRAINT `fk_purchase_orderline_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_purchase_orderline_purchase_order1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD CONSTRAINT `fk_sales_invoice_linckt_employee1` FOREIGN KEY (`linckt_employee_id`) REFERENCES `linckt_employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sales_invoice_payment_receipt1` FOREIGN KEY (`payment_receipt_id`) REFERENCES `payment_receipt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sales_invoice_purchase_order1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
