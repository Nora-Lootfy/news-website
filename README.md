# News-website 📰

## Introduction
Introducing PHP-powered news website, a one-stop destination for the latest updates. With landing page features Breaking, Featured, Recent, and Top Views sections, ensuring you're always in the know. Navigate through categories, explore detailed news articles, and interact with moderators who manage content, categories, and messages through our "Contact Us" section.

> Make sure that all the files and folders inside the repo are directly in the root folder.

## Table of Contents
- [Demo](#Demo)
- [Top Level Design](#Top-Level-Design)

## Demo
[![Watch the video](https://img.youtube.com/vi/MVqImynqXnY/hqdefault.jpg)](https://www.youtube.com/embed/MVqImynqXnY)



## Top Level Design
The Website have 4 main parts:
1. [Users](#users-).
2. [Categories](#caregories-).
3. [News](#news-).
4. [Contact US](#contact-us-)

## Users 🙆
Users have basic data **"fullname, email, username, password"** also controlling data  **"supervisor, active"**. 

There is two types of users:
1. Supervisor user: supervisor user is able to perform all tasks: _create, update and delete_ also can edit all data of all users.
2. Normal user: this type of user is able to perform all tasks in categories and news, but he can only edit his own data except for active status and cannot edit basic information of other users.

## Categories 📂
Categories data is just a table that contains all categories names.

## News 🗞
Here, we save the date, title, content, author, published, image, is featured, is breaking, views

## Contact US ☎
This is for the data for users want to contact moderators of the website, it containes name, email, subject, message



