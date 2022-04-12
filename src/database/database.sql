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
    logo_path varchar(255),

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

create table if not exists sale_like
(
    user_mail varchar(255) NOT NULL,
    id_sale int unsigned NOT NULL,

    primary key (user_mail, id_sale),
    key (id_sale)
) engine = innodb ;

alter table sale_like
add constraint fk_sale_likeuser_mail
foreign key (user_mail)
references user (user_mail)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint fk_sale_likeid_sale
foreign key (id_sale)
references sale (id_sale)
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
foreign key (id_sale)
references sale(id_sale)
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists message_sale
(
    id_message int unsigned not null auto_increment,
    user_message text NOT NULL,
    user_from varchar(255) NOT NULL,
    user_to varchar(255) NOT NULL,
    id_sale int unsigned NOT NULL,
    
    primary key(id_message) 

) engine = innodb ;

alter table message_sale
add constraint fk_message_saleuser_mail
foreign key (user_from)
references user(user_mail)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint fk_user_touser_mail
foreign key (user_to)
references user(user_mail)
ON DELETE CASCADE
ON UPDATE CASCADE,
add constraint fk_message_saleid_sale
foreign key (id_sale)
references sale(id_sale)
ON DELETE CASCADE
ON UPDATE CASCADE;

create table if not exists seller_candidacy
(
    id_candidacy int unsigned not null auto_increment,
    user_message text NOT NULL,
    user_from varchar(255) NOT NULL,

    primary key(id_candidacy) 
) engine = innodb ;

alter table seller_candidacy
add constraint fk_user_fromuser_mail
foreign key (user_from)
references user(user_mail)
on delete cascade
on UPDATE cascade;
