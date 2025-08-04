
create database if not exists Blood_Managementdb;
use Blood_Managementdb;

 
--UsMembers Table
create table if not exists members(
    user_Id int(10) auto_increment primary key,
    Name varchar(50) not null,
    DOB date,
    Gender enum('Male','Female','Other'),
    blood_group varchar(5),
    Email varchar(100) not null,
    Password varchar(256) not null,
    Phone varchar(10) not null,
    Address varchar(200) ,
    role enum('admin','donor') default 'donor',
    is_active boolean default true,
    created_at timestamp default current_timestamp
    );

 

--default Admin 
Insert into members(Name,DOB,Gender,Blood_Group_id,Email,Password,Phone,Address,role) values ('Ajit Shah','2003-07-05','Male','3','ajitshah000@gmail.com','9090','9817622807','janakpur','admin');

--Donation history Table 
CREATE TABLE donation_history (
  Donation_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  donation_date DATE NOT NULL,
  volume_ml INT CHECK (volume_ml > 0),
  location VARCHAR(100),
  remarks TEXT,
  FOREIGN KEY (user_id) REFERENCES members(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


