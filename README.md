To run this the minimum requirement is a basic knowledge of setting up and working with MySQL both locally and when Hosting it globally

Make a SQL Database named "articles" and add appropriate columns namely:
1. id (type: int)
2. title (type: text)
3. cover (type: text)
4. Date (type: Date)
5. description (type: text)
6. content (type: longtext)

Make the id column the Primary Key

All the details of the database go in db_connection.php

Make another database named "admins" which stores the email and password of users

Add the columns: 
1. id (type: int)
2. email (type: text)
3. password (type: text)

make the id column the primary key

Make a third database named "messages" to store the feedback from users directly thorugh the website, (this was my crude way of establishing a one-way communication without revealing my socials)

Add the columns:
1. id (type: int)
2. Date (type: Date)
3. email (type: text)
4. message (type: text)

make the id column the primary key

NOTE: It is advised not to hardcode any information into the Database, leave it empty initially
