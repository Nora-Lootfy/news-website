# News-website 📰

## Introduction
Introducing PHP-powered news website, a one-stop destination for the latest updates. With landing page features Breaking, Featured, Recent, and Top Views sections, ensuring you're always in the know. Navigate through categories, explore detailed news articles, and interact with moderators who manage content, categories, and messages through our "Contact Us" section.

## Table of Contents
- [Demo](#Demo)
- [User Manual](#User-Manual)
- [Top Level Design](#Top-Level-Design)

## Demo

## User Manual


## Top Level Design
The Website have 4 main parts:
1. [Users](#Users).
2. [Categories](#Categories).
3. [News](#News).
4. [Contact US](#Contact-US)

### Users 🙆
Users have basic data **"fullname, email, username, password"** also controlling data  **"supervisor, active"**. 

There is two types of users:
1. Supervisor user: supervisor user is able to perform all tasks: _create, update and delete_ also can edit all data of all users.
2. Normal user: this type of user is able to perform all tasks in categories and news, but he can only edit his own data except for active status and cannot edit basic information of other users.

### Categories 📂
Categories is just a table that containes all catrgories names.

### News 🗞️
Here, we save the date, title, content, author, published, image, is featured, is breaking, views

### Contact US ☎️
This is for the data for users want to contact moderators of the website, it containes name, email, subject, message



