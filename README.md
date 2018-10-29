**This is our repo for the worlds best dating site.**

*Let's make the main page, login, and the register page.*


Database schema:
    create table accounts (username varchar(20) NOT NULL,
                           password varchar(50) NOT NULL,
                           first_name varchar(20),
                           middle_name varchar(20),
                           last_name varchar(20),
                           gender enum('male', 'female', 'other'),
                           birthdate date,
                           year_in_school enum('freshman', 'sophomore', 'junior', 'senior', 'master', 'doctor'),
                           major int,
                           PRIMARY KEY (username));
                           
    