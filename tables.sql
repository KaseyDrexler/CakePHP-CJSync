
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('image','text') NOT NULL DEFAULT 'image',
  `description` text,
  `targeted_sex` enum('m','f','both') NOT NULL,
  `targeted_age_start` int(3) NOT NULL,
  `targeted_age_end` int(3) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `ads_start_date` datetime DEFAULT NULL,
  `ads_end_date` datetime DEFAULT NULL,
  `advertiser_id` int(11) NOT NULL,
  `advertiser_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `commission_click` varchar(100) NOT NULL,
  `height` int(5) NOT NULL,
  `width` int(5) NOT NULL,
  `link_html` text NOT NULL,
  `link_javascript` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `cj_link_id` int(11) NOT NULL,
  `promotion_type` enum('none','sale') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `ad_pools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `key` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `ads_to_pools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ads_id` int(11) NOT NULL,
  `ad_pools_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ads_id` (`ads_id`,`ad_pools_id`),
  KEY `ad_pools_id` (`ad_pools_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
