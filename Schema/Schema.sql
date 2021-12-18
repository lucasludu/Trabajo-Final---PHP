USE worldwork;

CREATE TABLE companies (
	companyId INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  cuit VARCHAR(12) NOT NULL,
  companyName VARCHAR(50) NOT NULL,
  companyCity VARCHAR(50) NOT NULL,
  companyDescription DATE NOT NULL,
  companyEmail DATE NOT NULL,
  companyPhoneNumber VARCHAR(20) NOT NULL,
  constraint unq_cuit unique (cuit)
)Engine=InnoDB;

CREATE TABLE careers (
	careerId int auto_increment not null primary key,
    description VARCHAR(100) NOT NULL,
    active boolean NOT NULL
)Engine=InnoDB;

CREATE TABLE jobs (
	jobPositionId int auto_increment not null primary key,
    careerId int,
    description VARCHAR(100) NOT NULL,
    constraint fk_careerId foreign key (careerId) references careers (careerId)
)Engine=InnoDB;

CREATE TABLE users (
    userId int auto_increment not null primary key,
	email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    profile VARCHAR(50) NOT NULL,
    constraint unq_email unique (email)
)Engine=InnoDB;


CREATE TABLE jobOffers (
    jobOfferId int auto_increment not null primary key,
    publishedDate date,
    finishDate date,
    task VARCHAR(50) NOT NULL,
    skills VARCHAR(50) NOT NULL,
    salary float,
    jobPositionId int,
    companyId int,
    careerId int,
    constraint fk_jobPositionId foreign key (jobPositionId) references jobs (jobPositionId),
    constraint fk_companyId foreign key (companyId) references companies (companyId),
    constraint fk_careerId foreign key (careerId) references careers (careerId)
)Engine=InnoDB;

CREATE TABLE appointments
(
	appointmentId int auto_increment not null primary key,
    jobOfferId int,
    studentId int,
    message VARCHAR(100) NOT NULL,
    cv VARCHAR(50) NOT NULL,
	constraint fk_jobOfferId foreign key (jobOfferId) references jobOffers (jobOfferId),
    constraint fk_studentId foreign key (studentId) references users (userId)
)Engine=InnoDB;
