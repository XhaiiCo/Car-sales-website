drop database if exists projtm ;
create database if not exists projtm character set='utf8' ;
use projtm ;

create table if not exists user 
(
    id_user int unsigned auto_increment,
    username varchar(100) NOT NULL,
    mail varchar(255) NOT NULL,
    user_password varchar(255) NOT NULL,
    isAdmin boolean NOT NULL,
    isSeller boolean NOT NULL,
    date_registration date NOT NULL,

    primary key(id_user)
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
references car_brand(brand_name) ;

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
    model_name varchar(100) NOT NULL,
    brand_name varchar(100) NOT NULL,
    id_user int unsigned NOT NULL,

    primary key(id_sale)
) engine = innodb ;

alter table sale
add constraint fk_salemodel_name
foreign key(model_name)
references car_model(model_name),
add constraint fk_saleid_user
foreign key(id_user)
references user(id_user) ;

create table if not exists sale_like
(
    id_user int unsigned,
    id_sale int unsigned NOT NULL,

    primary key (id_user, id_sale),
    key (id_sale)
) engine = innodb ;

alter table sale_like
add constraint fk_sale_likeid_user
foreign key (id_user)
references user (id_user),
add constraint fk_sale_likeid_sale
foreign key (id_sale)
references sale (id_sale) ;

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
references sale (id_sale) ;