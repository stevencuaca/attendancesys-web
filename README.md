# Attendancesys-Web

<p align="center">
  <img src="https://i.ibb.co/S3hD5PB/10.png">
</p>

This is an Admin Panel application for attendancesys. This app is integerated with another desktop application. You can check on my another repo or just click this link: https://github.com/stevencuaca/attendancesys-desktop

## Getting Started

This is an Admin Panel web page to seeing the report, manage the employee, office rules, salary calculation, etc. It's developed using Laravel framework. I also used Voyager for the admin panel template.

### Prerequisites

A local web server with database (example: XAMPP).

### Installing

#### 1. Download/clone this repo
#### 2. Extract in your htdocs folder (if you are using XAMPP)
#### 3. Import the database "attendance_system.sql" if you haven't done it
#### 4. Change the .env file in to your laptop/pc configuration
#### 5. Run with "php artisan serve" command
#### 6. Login with email "superuser@klpi.com" and password "password"
#### 7. After, you seeing the Dashboard, you will see a message "Missing stograge symlink" like the picture below
![alt text](https://i.ibb.co/bmr7wBt/Annotation-2020-06-08-170247.png)
#### 8. Click fix it
#### 9. Don't worry if some of images are disappeared, just follow another steps below
#### 10. Go to the project directory and go to "public" folder
#### 11. Inside the public folder you will see two folders ("storage" and "storage_old")
#### 12. Go inside the "storage_old" folder and move all the files inside the "storage_old" folder to "storage" folder
![alt text](https://i.ibb.co/tHZDn8F/Annotation-2020-06-08-172026.png)
#### 13. After you moved it, just delete the "storage_old" folder, your "public" folder should look like this now
![alt text](https://i.ibb.co/j6YYSL2/Annotation-2020-06-08-172103.png)


## Running the tests

I've uploaded the demo of application, so you can see it from here: https://bit.ly/2zME7A2

## Built With

* [Python 3.6.8](https://www.python.org/) - The programming language used
* [Laravel](https://laravel.com/) - The framework used
 

## Authors

* **Steven Cuaca** - *Final Project* - [E-mail] cuacasteven@gmail.com
