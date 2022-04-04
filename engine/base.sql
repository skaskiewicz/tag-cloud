CREATE TABLE `tag-cloud`.tags (
                                  id_tags INT auto_increment NOT NULL,
                                  tag_name varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                                  CONSTRAINT id_tags_pk PRIMARY KEY (id_tags)
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_general_ci;
CREATE TABLE `tag-cloud`.main (
                                  id_main INT auto_increment NOT NULL,
                                  id_tags INT NOT NULL,
                                  description VARCHAR(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                                  url varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                                  CONSTRAINT id_main_pk PRIMARY KEY (id_main),
                                  CONSTRAINT main_FK FOREIGN KEY (id_tags) REFERENCES `tag-cloud`.tags(id_tags)
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_general_ci;

