
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
--password : Ajit@123 
Insert into members(Name,DOB,Gender,Blood_Group,Email,Password,Phone,Address,role) values ('Ajit Shah','2003-07-05','Male','A+','ajitshah000@gmail.com','$2y$10$W6hn.Q4jlVzgR6Ca7wEDTep40glo2Smm27vIAcCX0ebfHMyyzsh9W','9817622807','janakpur','admin');  

-- request history
CREATE TABLE blood_request (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    receiver_id INT NOT NULL,
    patient_name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    location VARCHAR(100) NOT NULL,
    request_date DATE NOT NULL,
    status ENUM('pending', 'approved', 'rejected', 'fulfilled') DEFAULT 'pending',
    FOREIGN KEY (receiver_id) REFERENCES members(user_id)
);

--Donation history Table 
CREATE TABLE donation_history (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT NOT NULL,
    receiver_id INT NOT NULL,
    request_id INT, -- optional link to blood_request
    patient_name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    location VARCHAR(100) NOT NULL,
    donation_date DATE NOT NULL,
    image_path VARCHAR(255), -- stores image filename
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (donor_id) REFERENCES members(user_id),
    FOREIGN KEY (receiver_id) REFERENCES members(user_id),
    FOREIGN KEY (request_id) REFERENCES blood_request(request_id)
); 



 
-- donar summary

CREATE VIEW donor_summary AS
SELECT 
    donor_id,
    MAX(donation_date) AS last_donation,
    DATE_ADD(MAX(donation_date), INTERVAL 90 DAY) AS next_eligible_date,
    COUNT(*) AS total_donations
FROM donation_history
GROUP BY donor_id;


