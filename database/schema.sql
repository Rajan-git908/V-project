
create database if not exists Blood_Managementdb;
use Blood_Managementdb;

--Blood_group table
create table if not exists blood_group (
    blood_id int auto_increment primary key,
    group_name varchar(5) not null
);
--User Table
create table if not exists members(
    user_Id int(10) auto_increment primary key,
    Name varchar(50) not null,
    DOB date;
    Gender enum('Male','Female','Other'),
    blood_group_id int,
    Email varchar(100) not null,
    Password varchar(256) not null,
    Phone varchar(10) not null,
    Address varchar(200) ,
    role enum('admin','donor') default 'donor',
    is_active boolean default true,
    created_at timestamp default current_timestamp,
    foreign key (blood_group_id) references blood_group(blood_id)

);

--default blood group
INSERT IGNORE INTO blood_groups (group_name) VALUES 
('A+'), ('A-'), ('B+'), ('B-'), ('AB+'), ('AB-'), ('O+'), ('O-');

--default Admin 
Insert into members(Name,DOB,Gender,Blood_Group_id,Email,Password,Phone,Address,role) 
values ('Ajit Shah','2003-07-05','Male','3','ajitshah000@gmail.com','9090','9817622807','janakpur','admin');
