drop database if exists projtm ;
create database if not exists projtm character set='utf8' ;
use projtm ;

create table if not exists user 
(
    user_mail varchar(255) NOT NULL,
    username varchar(100) NOT NULL,
    user_password varchar(255) NOT NULL,
    isAdmin boolean NOT NULL,
    isSeller boolean NOT NULL,
    date_registration date NOT NULL,

    primary key(user_mail)
) engine=innodb;


create table if not exists car_brand
(
    brand_name varchar(100) NOT NULL,

    primary key(brand_name)
) engine = innodb ;

create table if not exists car_model
(
    model_name varchar(100) NOT NULL,
    brand_name varchar(100) NOT NULL,

    primary key(model_name, brand_name),
    key(brand_name)
) engine = innodb ;

alter table car_model
add constraint fk_car_modelbrand_name 
foreign key(brand_name) 
references car_brand(brand_name)
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists sale
(
    id_sale int unsigned NOT NULL auto_increment,
    price float NOT NULL,
    publication_date date NOT NULL,
    sale_description text NOT NULL,
    car_kilometer int NOT NULL,
    car_year year not NULL,
    car_power int unsigned NOT NULL,
    car_fuel varchar(50) NOT NULL,
    car_color varchar(255) NOT NULL,
    car_state varchar(100) NOT NULL,
    additional_info varchar(50),
    model_name varchar(100) NOT NULL,
    brand_name varchar(100) NOT NULL,
    user_mail varchar(255) NOT NULL,

    primary key(id_sale)
) engine = innodb ;

alter table sale
add constraint fk_salemodel_name
foreign key(model_name)
references car_model(model_name)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint fk_saleuser_mail
foreign key(user_mail)
references user(user_mail) 
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists car_picture
(
    picture_name varchar(255) NOT NULL,
    picture_order int unsigned NOT NULL,
    id_sale int unsigned NOT NULL,

    primary key (picture_name)
) engine=InnoDB ;

alter table car_picture
add constraint fk_car_pictureid_sale
foreign key (id_sale)&
references sale(id_sale)
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists conversation(
    id_conversation int unsigned NOT NULL auto_increment,
    user1 varchar(255) NOT NULL,
    user2 varchar(255) NOT NULL,
    id_sale int unsigned NOT NULL,

    primary key (id_conversation)
) engine = innodb ;

alter table conversation
add constraint conversation_user1
foreign key (user1)
references user(user_mail)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint conversation_user2
foreign key (user2)
references user(user_mail)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint conversationid_sale
foreign key (id_sale)
references sale(id_sale)
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists message
(
    id_message int unsigned not null auto_increment,
    user_send  varchar(255) NOT NULL,
    message text NOT NULL,
    date_send datetime not null,

    id_conversation int unsigned NOT NULL,
    
    primary key(id_message) 

) engine = innodb ;

alter table message
add constraint fk_message_sale_id_conversation
foreign key (id_conversation)
references conversation(id_conversation)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint message_user_send
foreign key (user_send)
references user(user_mail)
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists seller_candidacy
(
    id_candidacy int unsigned not null auto_increment,
    user_message text NOT NULL,
    user_from varchar(255) NOT NULL,
    date_send date not null,

    primary key(id_candidacy) 
) engine = innodb ;

alter table seller_candidacy
add constraint fk_user_fromuser_mail
foreign key (user_from)
references user(user_mail)
on delete cascade
on UPDATE cascade;
