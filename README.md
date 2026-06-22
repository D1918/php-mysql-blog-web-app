### 📝 PHP MySQL Blog Web App - Test Task Implementation

PHP web app powered by a custom MVC architecture, Smarty templating, Sass, MySQL and Docker.

### ⚙️ Installation

1. cp .env.example .env

2. docker compose -f docker-compose.dev.yml up --build

### 📌 Test Task Requirements

You are required to develop a simple but fully functional website in pure PHP (without frameworks) using MySQL and the Smarty templating engine. The site should implement blog functionality with categories and posts.

### Technology stack:

* PHP 8.1+
* Smarty templating engine
* MySQL database
* No frameworks allowed

---

### Data structure:

**Category:**

* Name
* Description

**Article:**

* Image
* Title
* Description
* Text
* Category (one or multiple)
* Number of views

---

### Required pages:

**Home page:**

* Display each category that contains articles and show the 3 latest posts (by publication date)
* Add a “All articles” button for each category

**Category page:**

* Display category name, description, and list of articles
* Implement article sorting (by number of views, by publication date)
* Implement pagination

**Article page:**

* Display all information about the article
* Show a block of 3 related articles

---

### Additional functionality:

* Implement seeding functionality for categories and articles

---

### What will be evaluated:

* Simplicity, readability, and structure of the code
* Project structure
* MySQL usage
* Level of independent implementation
* Depth of understanding of the solution

---

### Bonus points:

* Use of SCSS for styling
* Docker environment

---

The completed assignment can be submitted as a link to a public Git repository (GitLab/GitHub/Bitbucket of your choice).

Along with the submission, you must indicate whether you used AI during development and, if so, specify exactly what it was used for. This is important for proper evaluation, as we pay special attention to the level of independent implementation, depth of understanding of the solution, and your personal technical approach.

It is also appreciated if commits are made step by step during development so the progress and logic of implementation can be reviewed.

📄 License

This project is open-source and available under the MIT License.
