# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8  < C:\Users\Korisnik\Documents\GitHub\BeDev2023\algebraapp.hr\algebraapp.sql

drop database if exists algebraapp;
create database algebraapp default charset utf8mb4;
use algebraapp;

create table operater(
    sifra int not null primary key auto_increment,
    email varchar(50) not null,
    lozinka varchar(100) not null,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    uloga varchar(20) not null
);
# admin a, oper o
insert into operater(email,lozinka,ime,prezime,uloga)
values
('admin@algebra.hr','$2a$12$/jebwgFgEG1MvVv8hNEH2eF0EOVcetrmfEDrAFBskXri9TMCTs1.O',
    'Algebra','Administrator','admin'),
('oper@algebra.hr','$2a$12$Uwhrki.xhi7d72u5Py/GJe5ADtJwrHkER6ZMsY6zcE6GW6V4vpb36',
    'Algebra', 'Operater','oper');





create table smjer(
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    cijena decimal(18,2), # kada ne piše not null podrazumjeva se null
    trajanje int,
    upisnina decimal(18,2),
    certificiran boolean
);

create table grupa(
    sifra int not null primary key auto_increment,
    naziv varchar(20) not null,
    datumpocetka datetime,
    maksimalnopolaznika int,
    smjer int not null, 
    predavac int 
);

create table clan(
    sifra int not null primary key auto_increment,
    grupa int not null, 
    polaznik int not null 
);

create table polaznik(
    sifra int not null primary key auto_increment,
    osoba int not null, 
    brojugovora varchar(10)
);

create table predavac(
    sifra int not null primary key auto_increment,
    osoba int not null, 
    iban varchar(50)
);

create table osoba(
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    email varchar(100),
    oib char(11)
);

# definiranje vanjskih ključeva
alter table grupa add foreign key (smjer) references smjer(sifra);
alter table grupa add foreign key (predavac) references predavac(sifra);

alter table clan add foreign key (grupa) references grupa(sifra);
alter table clan add foreign key (polaznik) references polaznik(sifra);

alter table polaznik add foreign key (osoba) references osoba(sifra);
alter table predavac add foreign key (osoba) references osoba(sifra);


insert into smjer(sifra,naziv,cijena,trajanje,
upisnina,certificiran) values 
(null,'Back-end developer',9999.99,230,null,false),
(null,'Python Developer',8999.99,220,null,true),
(null,'Front-end developer',7999.99,210,null,false);


insert into grupa 
(sifra,naziv,datumpocetka,maksimalnopolaznika,
smjer,predavac)
values 
(null,'BCK','2023-09-23',30,1,null),
(null,'PYT','2023-05-20',20,2,null),
(null,'FRNT','2023-05-01',20,2,null);


# 1
insert into osoba (sifra,ime,prezime,email,oib)
values (null,'Ivan','Mandić','imandic@gmail.com',null),
(null,'Pero','Perić','pero.peric@gmail.com',null),
(null,'Antonio','Majer','majer.antonio@gmail.com',null),
(null,'Toni','Tonić','tonitonic@gmail.com',null),
(null,'Marta','Martić','m.martic@gmail.com',null),
(null,'Ivan','Ivić','ivan.ivic@icloud',null),
(null,'Ivana','Ivić','ivanaivic@gmail.com',null),
(null,'Zorica','Zorić','zoric@gmail.com',null),
(null,'Antun','Antunović','ant@hotmail',null),
(null,'Marko','Marić','marko@gmail.com',null),
(null,'Iva','Ivić','ivai@gmail.com',null),
(null,'Marija','Majić','marijam@gmail.com',null),
(null,'Boris','Borić','boki@gmail.com',null),
(null,'Filip','Filić','filip1223@gmail.com',null),
(null,'Ena','Enić','enaenić@gmail.com',null),
(null,'Tara','Tarić','taratarić@outlook.com',null);



insert into predavac(sifra,osoba,iban)
values (null,1,null),(null,2,null),(null,7,null);


# 1 - 15
insert into polaznik (sifra,osoba,brojugovora)
values
(null,3,null),
(null,4,null),
(null,5,null),
(null,6,null),
(null,8,null),
(null,9,null),
(null,10,null),
(null,11,null),
(null,12,null),
(null,13,null),
(null,14,null),
(null,15,null),
(null,16,null);

