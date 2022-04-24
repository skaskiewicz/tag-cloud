CREATE TABLE `main` (
                        `id_main` int(10) unsigned NOT NULL AUTO_INCREMENT,
                        `description` varchar(5000) NOT NULL,
                        `url` varchar(5000) NOT NULL,
                        `tags` varchar(255) NOT NULL,
                        `checked` tinyint(1) NOT NULL,
                        PRIMARY KEY (`id_main`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;