📚 BookNest

A Campus-Only Book Exchange Platform built with Laravel & MySQL

BookNest is a web-based campus book exchange platform designed to help students buy, sell, and exchange used academic books within their campus community.

The system provides a structured way for students to list books, search and filter available listings, send requests, complete transactions, coordinate offline meetups, and access previous-year question papers (PYQs). An administrator manages users, books, requests, transactions, meetups, and verifies PYQ submissions.

📖 About

BookNest is a campus-focused academic book exchange system developed using Laravel, Blade, Bootstrap, HTML, CSS, JavaScript, Vite, and MySQL.

The platform is designed around two primary roles:

Role

Responsibilities

👤 Student / User

List books, browse books, search and filter listings, send exchange/purchase requests, manage transactions, schedule meetups, and access verified PYQs

🛡️ Admin

Manage students, books, transactions, meetups, and verify PYQ submissions

BookNest focuses on making the exchange of used academic books more organized, affordable, and campus-oriented, while also providing a centralized platform for PYQs.

✨ Core Features

👤 Student / User

Feature

Description

🔐 Authentication

Secure user registration and login

📚 Book Listings

Add and manage personal book listings

🔎 Search

Search books by relevant details

🎯 Filters

Filter books by semester, listing type, condition, and other available fields

💰 Sell Books

List books for selling

🔄 Exchange Books

Offer books for exchange

🔀 Sell / Exchange

Support listings that allow both selling and exchange

📩 Book Requests

Send and manage requests for listed books

📦 Request Management

Track request status such as pending, accepted, and rejected

🤝 Transaction Tracking

Track transactions created after an accepted request

📅 Meetup Coordination

Schedule offline meetups for completing transactions

📍 Meetup Details

Store meetup location, date, time, and notes

📞 Contact Sharing

Contact phone details become available after meetup confirmation

📄 PYQs

Browse and download verified previous-year question papers

👤 Profile

Manage user profile information

🛡️ Admin

Feature

Description

📊 Dashboard

Centralized administrative dashboard

👥 Student Management

Manage valid campus students

📥 CSV Import

Import valid student registration IDs through CSV

📚 Book Management

Monitor book listings

📩 Request Management

Monitor book request activity

💳 Transaction Tracking

Monitor transactions

🤝 Meetup Management

Monitor scheduled meetups

📄 PYQ Management

Review uploaded PYQs

✅ PYQ Verification

Verify PYQs before making them available to students

🔎 PYQ Filtering

Manage PYQ resources by academic criteria

📚 Book Management

BookNest allows students to create academic book listings with information such as:

Book title

Author

Subject

Subject code

Course

Semester

Book condition

Listing type

Price

Photo

Description

Listing Types

                 BOOK LISTING
                      │
            ┌─────────┼─────────┐
            │         │         │
           SELL    EXCHANGE   BOTH
            │         │         │
            ▼         ▼         ▼
          Buyer     Exchange   Buy /
          Request    Request   Exchange

🔎 Search & Filter

BookNest provides structured search and filtering to help students quickly find relevant academic books.

Users can search/filter using information such as:

Book title

Author

Subject

Subject code

Course

Semester

Listing type

Book condition

The system also provides appropriate empty states when no matching books are available.

📩 Request Management Workflow

BookNest uses a request-based workflow instead of directly completing a transaction from a book listing.

Student A
   │
   ▼
Browse Book
   │
   ▼
Send Request
   │
   ▼
Pending
   │
   ▼
Book Owner Reviews Request
   │
   ├──────────────► Reject
   │
   ▼
 Accept
   │
   ▼
Book Reserved
   │
   ▼
Transaction Created

When a seller accepts a request:

The request becomes accepted

The book becomes reserved

Other pending requests for the same book are automatically rejected

A transaction is created for the accepted request

This prevents multiple users from simultaneously completing a transaction for the same book.

🤝 Meetup Coordination

BookNest is designed around offline campus transactions.

After a request is accepted, users can coordinate a meetup by providing:

Meetup location

Custom location

Meetup date

Meetup time

Notes

The system can keep contact information restricted until the meetup is confirmed.

Meetup Flow

Request Accepted
       │
       ▼
Transaction Created
       │
       ▼
Schedule Meetup
       │
       ├── Location
       ├── Date
       ├── Time
       └── Notes
       │
       ▼
Meetup Confirmed
       │
       ▼
Transaction Completion

📄 PYQ Module

BookNest also provides a dedicated Previous Year Question Paper (PYQ) module.

Students can upload PYQs with academic information such as:

Subject name

Subject code

Course

Semester

Year

Exam type

PDF document

PYQ Verification Workflow

Student
   │
   ▼
Upload PYQ
   │
   ▼
Pending Verification
   │
   ▼
Admin Reviews
   │
   ├──────────────► Reject
   │
   ▼
 Verify
   │
   ▼
PYQ Available to Students

Only verified PYQs are made available through the platform.

PYQ Search & Filters

PYQs can be organized and filtered using:

Semester

Exam type

Subject

Course

Year

🔄 Complete Application Workflow

                         BOOKNEST
                            │
             ┌──────────────┴──────────────┐
             │                             │
          STUDENT                        ADMIN
             │                             │
      ┌──────┴──────┐             ┌────────┴────────┐
      │             │             │                 │
   Book Flow     PYQ Flow     User Management   PYQ Verification
      │             │             │                 │
      ▼             ▼             ▼                 ▼
   Add Book      Upload PYQ    Valid Students    Approve / Reject
      │             │
      ▼             ▼
   Browse       Verification
      │             │
      ▼             ▼
 Search/Filter   Verified PYQ
      │             │
      ▼             │
 Send Request      │
      │             │
      ▼             │
 Owner Accepts     │
      │             │
      ▼             │
 Book Reserved     │
      │
      ▼
 Transaction
      │
      ▼
 Meetup
      │
      ▼
 Offline Exchange / Sale

🛠️ Technology Stack

Category

Technology

Backend

Laravel 12

Language

PHP

Frontend

Blade Templates, HTML5, CSS3

UI Framework

Bootstrap 5.3.x

JavaScript

JavaScript

Build Tool

Vite

Database

MySQL / MariaDB

ORM

Laravel Eloquent

Local Development

XAMPP

Version Control

Git & GitHub

BookNest uses Bootstrap for UI and responsiveness rather than Tailwind CSS.

🗄️ Database Design

BookNest uses a relational MySQL/MariaDB database to manage students, books, requests, transactions, meetups, and PYQs.

The database design supports the following major entities:

Entity

Purpose

users

Stores student/admin accounts and user information

valid_students

Stores valid campus registration IDs

books

Stores academic book listings

book_requests

Stores requests made for listed books

transactions

Stores transaction information created after accepted requests

meetups

Stores offline meetup scheduling details

pyqs

Stores uploaded previous-year question papers and verification information

Core Relationships

Users
 │
 ├──────────────► Books
 │                   │
 │                   ▼
 │             Book Requests
 │                   │
 │                   ▼
 │              Transactions
 │                   │
 │                   ▼
 │                 Meetups
 │
 └──────────────► PYQs

Valid Students
       │
       ▼
     Users

Key Relationships

A user can create multiple book listings.

A book belongs to a user/listing owner.

A book can receive multiple requests.

A request is associated with the requesting user and listed book.

An accepted request creates a transaction.

A transaction can be associated with a meetup.

Users can upload PYQs.

Admin verification determines whether a PYQ becomes available to students.

Valid student registration IDs are used to support campus-only access.

📁 Project Structure

BookNest/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── BookController.php
│   │       ├── RequestController.php
│   │       ├── ProfileController.php
│   │       └── PyqController.php
│   │
│   └── Models/
│       ├── User.php
│       ├── Book.php
│       ├── BookRequest.php
│       ├── Transaction.php
│       ├── Meetup.php
│       └── Pyq.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── pyqs/
│
├── resources/
│   ├── css/
│   │   └── app.css
│   │
│   ├── js/
│   │   └── app.js
│   │
│   └── views/
│       ├── layouts/
│       ├── partials/
│       ├── admin/
│       ├── books/
│       ├── pyq/
│       └── ...
│
├── routes/
│   └── web.php
│
├── storage/
│
├── .env
├── .env.example
├── composer.json
├── package.json
├── vite.config.js
└── README.md

⚙️ Installation & Setup

1. Clone the Repository

git clone https://github.com/Bhkapoor/BookNest.git

2. Move the Project

Place the project inside the XAMPP htdocs directory:

C:\xampp\htdocs\

3. Start XAMPP

Start:

Apache
MySQL

4. Create the Database

Create a MySQL/MariaDB database for BookNest using phpMyAdmin:

http://localhost/phpmyadmin

Update the database configuration in your local .env file.

Example:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booknest
DB_USERNAME=root
DB_PASSWORD=

5. Install PHP Dependencies

From the project directory:

composer install

6. Configure Environment

Create the .env file:

cp .env.example .env

On Windows, you can also create .env manually from .env.example.

Generate the application key:

php artisan key:generate

7. Run Database Migrations

php artisan migrate

If seeders are configured:

php artisan db:seed

8. Create Storage Link

For uploaded PYQ files and public storage access:

php artisan storage:link

9. Install Frontend Dependencies

npm install

Run Vite during development:

npm run dev

10. Run the Application

php artisan serve

Open:

http://127.0.0.1:8000

🔐 Authentication & Access Control

BookNest separates functionality based on user roles.

                 LOGIN
                   │
          ┌────────┴────────┐
          │                 │
        ADMIN             STUDENT
          │                 │
          ▼                 ▼
   Admin Dashboard     User Dashboard

Administrative functionality is protected so that normal students cannot access admin management operations.

🛡️ Admin Controls

The administrator provides centralized control over important platform operations:

                    ADMIN
                      │
       ┌──────────────┼──────────────┐
       │              │              │
    Students        Books         Transactions
       │              │              │
       └──────────────┼──────────────┘
                      │
                   Meetups
                      │
                     PYQs
                      │
              Verification

The admin can also import valid student registration IDs through CSV to support campus-restricted access.

🔒 Security Considerations

BookNest follows basic application security practices including:

Role-based access control

Authentication for protected functionality

Laravel's built-in security features

CSRF protection through Laravel

Eloquent ORM for database interaction

Validation of submitted form data

Protected local environment configuration

.env excluded from version control

Controlled access to uploaded PYQ resources

Admin verification before PYQs become publicly available within the application

🚀 Future Enhancements

Potential future improvements include:

⭐ Rating and feedback system

🔔 User notifications

📱 Improved mobile experience

🔎 Advanced book recommendations

📊 Advanced admin analytics

📍 Improved campus meetup coordination

📚 Enhanced PYQ categorization

💬 Student-to-student communication

📈 Transaction and platform reports

Note: The Rating/Feedback module is planned but is currently not part of the implemented workflow.

🎯 Project Highlights

🎓 Campus-focused academic book exchange platform

📚 Buy, sell, and exchange used academic books

🔎 Search and filter books using academic attributes

📩 Request-based book exchange workflow

🔒 Automatic book reservation after request acceptance

❌ Automatic rejection of other pending requests

🤝 Offline meetup coordination

📅 Meetup scheduling with location, date, time, and notes

📞 Controlled contact information visibility

📄 PYQ upload and admin verification system

📥 CSV-based valid student registration management

🛡️ Role-based Admin and Student access

🖥️ Laravel Blade + Bootstrap responsive interface

🗄️ MySQL/MariaDB database

⚡ Vite-powered frontend assets

👩‍💻 Author

Bharti Kapoor

GitHub: Bhkapoor
