Create Database test;

create Table gegevens(
id int auto_increment, 
naam varchar(255) not null,
email varchar(255) not null,
wachtwoord varchar(255) not null,
primary key (id)
)
