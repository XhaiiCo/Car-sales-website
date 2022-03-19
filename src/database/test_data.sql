insert into car_brand value 
("BMW", "bmw.png") ;

insert into car_model value 
("M3 E30", "BMW") ;

insert into user (username, mail, user_password, isAdmin, isSeller, date_registration)
values ("David", "david@david.be", "", 0, 1, now()) ;

insert into sale (price, publication_date, sale_description, car_kilometer, car_year, car_power,
car_fuel, car_color, car_state, model_name, brand_name, id_user)
values
(80000, now(), 'Elle est bien jte jure', 23932, "1986", 130, "Essence", "Noir", "Occasion", "M3 E30", "BMW", 1) ;

insert into car_picture
(picture_name, picture_order, id_sale)
values ("1.jpg", 1, 1) ;