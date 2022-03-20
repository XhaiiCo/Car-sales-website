insert into car_brand value 
("BMW", "bmw.png"),
("Mercedes", "mercedes.png"),
("Porsche", "Porsche.png"),
("Ferrari", "ferrari.png"),
("Lamborghini", "lamborghini.png"),
("Audi", "audi.png") ;

insert into car_model value 
("M3", "BMW"),
("M2", "BMW"),
("M4", "BMW"),
("M6", "BMW"),
("Autres", "BMW"),

("G 63 AMG", "Mercedes"),
("A 45 AMG", "Mercedes"),
("A 45 AMG S", "Mercedes"),
("Autres", "Mercedes"),

("Cayman", "Porsche"),
("911", "Porsche"),
("718 Spyder", "Porsche"),
("Autres", "Porsche"),

("488", "Ferrari"),
("Testarossa", "Ferrari"),
("812", "Ferrari"),
("Autres", "Ferrari"),

("Aventador", "Lamborghini"),
("Countach", "Lamborghini"),
("Huracan", "Lamborghini"),
("Autres", "Lamborghini"),

("RS3", "Audi"),
("RS6", "Audi"),
("R8", "Audi"),
("Autres", "Audi") ;

insert into user (username, mail, user_password, isAdmin, isSeller, date_registration)
values ("David", "david@david.be", "", 0, 1, now()) ;

insert into sale (price, publication_date, sale_description, car_kilometer, car_year, car_power,
car_fuel, car_color, car_state,additional_info, model_name, brand_name, id_user)
values
(80000, now(), 'Elle est bien jte jure', 23932, "1986", 130, "Essence", "Noir", "Occasion", "E30", "M3", "BMW", 1) ;

insert into car_picture
(picture_name, picture_order, id_sale)
values ("1.jpg", 1, 1) ;