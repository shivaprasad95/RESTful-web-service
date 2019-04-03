# RESTful-web-service
Web service will provide information about books. <br />
http://localhost/books will give list of books (title, price, category) that are stored in your database. <br />
http://localhost/books/id will give all book details (title, year, price, category, authors) for given book id. <br />
Results will be in JSON format. <br />

Database schema is as follows: <br />
Book (Book_id, Title, Year, Price, Category) Book_Author (Book_id, Author_id) <br />
Author (Author_id, Author_Name) <br />
