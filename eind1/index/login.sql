create database login;

use login;

create table inlog(
inlogid int auto_increment,
email varchar (45),
password varchar (45) NOT NULL,
primary key (inlogid)
);

select * from inlog;
drop table inlog;