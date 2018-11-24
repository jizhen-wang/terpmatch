**This is our repo for the worlds best dating site.**

*Let's make the main page, login, and the register page.*


Database schema:
    create table accounts (username varchar(20) NOT NULL,
                           password varchar(100) NOT NULL,
                           first_name varchar(20),
                           middle_name varchar(20),
                           last_name varchar(20),
                           gender enum('male', 'female', 'other'),
                           birthdate date,
                           year_in_school enum('freshman', 'sophomore', 'junior', 'senior', 'master', 'doctor'),
                           major varchar(50),
                           minor varchar(50),
                           rs_type varchar(20),
                           rs_status varchar(20),
                           laguages varchar(50),
                           hobbies varchar(100),
                           interests varchar(100),
                           goals varchar(200),
                           bio varchar(200),
                           PRIMARY KEY (username));
Profile photo schema:                         
    create table photos (username varchar(20) NOT NULL,
                         docData longblob,
                         docMimeType varchar(512));
                                           
    