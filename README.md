# Documentation
Quote quize application is simple web application built using **PHP** and **HTML+CSS+JS**. Application was designed as **SPA (Single Page Application)**, it has not many features, user interacts just with  two pages to play quiz game and change game mode.
## Backend docs
Application uses **Core PHP** without any framework. backend part serves as an api to frontend side. Whole code  is in **api** folder uses **REST** style with Object-oriented design.We use **MYSQL** database to store our recources.

We have two types of resources in our application, **Questions**(with answers) and **SETTINGS**.  Their  access logic are split into directories with corresponding names inside **/api** directory. finally we have objects direcory that contains actual **PHP** classes to communicate with database.

#### Api methods
- **/api/question/read.php**
 GET
Read all questions
- **/api/question/update.php**
 POST
Update question

 		{
		"id": "1",
		"question": "The greatest glory in living lies not in never falling",
		"answers": [
                {
                    "id": "1",
                    "answer": "Nelson Mandela",
                    "is_right": "0"
                },
                {
                    "id": "2",
                    "answer": "Mahatma Gandhi",
                    "is_right": "1"
                },
                {
                    "id": "3",
                    "answer": "Che Guevara",
                    "is_right": "0"
                }
            ]
		}
		
- **/api/question/check.php?id=1&answer=2**
 POST
 Check if question answer is correct
 
 
 - **/api/setting/read.php**
 GET
 Read all settings
 
 
  - **/api/setting/update.php**
 POST
 Update setting
 
        {
 			"id": "1",
 			"name": "binary",
 			"value": "0"
 		}

## Frontend Docs
**jQuery** is used as fontend framework  with **handlebars** as tempate engine.
All the logic is located inside **/js/main.js** directory, including event handlers and  application state data.

**CSS** is used to style frontend without any framework. all the styles are located inside **/css** directory.