create database message_board;

use message_board;

create table user
(
	user_id int unsigned not null auto_increment primary key,
	nickname varchar(255) not null unique key,
	password char(32) not null,
	created datetime not null,
	updated datetime
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

create table message
(
	message_id int unsigned not null auto_increment primary key,
	user_id int unsigned not null,
	title varchar(255) not null,
	content text,
	created datetime not null,
	updated datetime
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;