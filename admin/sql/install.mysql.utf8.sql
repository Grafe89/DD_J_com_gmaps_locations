-- DD GMAPS LOCATIONS table SQL script
-- This will install all the the tables to run DD GMAPS LOCATIONS

--
-- Table structure for table `#__dd_gmaps_locations`
--

CREATE TABLE IF NOT EXISTS `#__dd_gmaps_locations` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `catid` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',

  `profileimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contact_person` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,

  `street` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `federalstate` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,

  `latitude` decimal(10, 8) NOT NULL DEFAULT '00.00000000',
  `longitude` decimal(11, 8) NOT NULL DEFAULT '00.00000000',

  `ll_c` tinyint(1) unsigned NOT NULL DEFAULT '1'

  `description` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,

  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',

  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) NOT NULL DEFAULT '1',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,

  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `#__dd_gmaps_locations`
--
ALTER TABLE `#__dd_gmaps_locations`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `#__dd_gmaps_locations`
--
ALTER TABLE `#__dd_gmaps_locations`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `#__dd_gmaps_locations_iptables`
--

CREATE TABLE IF NOT EXISTS `#__dd_gmaps_locations_iptables` (
  `profile_id` int(11) NOT NULL,
  `visitor_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sample data for table `#__categories`
--
INSERT INTO `#__categories` (`parent_id`, `path`, `extension`, `title`, `alias`, `published`, `access`, `params`, `metadata`, `language`) VALUES
(1, 'uncategorised', 'com_dd_gmaps_locations', 'Default', 'uncategorised', 1, 1, '{"category_layout":"","image":"media\\\\com_dd_gmaps_locations\\\\img\\\\marker.png","image_alt":""}', '{"author":"","robots":""}', '*');