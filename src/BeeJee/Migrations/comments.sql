create table if not exists comments
(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    username char(100) NOT NULL,
    email char(100) default '',
    body varchar(255) default '',
    changed_by_admin bool default false,
    image varchar(255) default '',
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    primary key (id)
);
ALTER TABLE `comments` ADD INDEX `c_username` (`username`);
ALTER TABLE `comments` ADD INDEX `c_emain` (`email`);
ALTER TABLE `comments` ADD INDEX `c_created_at` (`created_at`);
ALTER TABLE `comments` ADD INDEX `c_changed_by_admin` (`changed_by_admin`);