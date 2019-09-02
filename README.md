# Sol Blog

## About
A simple blog built using Laravel (5.8) and MongoDB.

The first user to register is the administrator and can add blog entries that appear on the main page.
Guests can read the entries without logging in.
Blog posts are minimal and only allow text content and new-lines.

## Author
Abdallah Chamas

## Installation
Assuming you have composer installed:

    $ git clone https://github.com/abdallahchamas/sol
    $ cd sol
    $ composer install

Update the .env and .env_testing files with:
1) Your database credentials as well as your test database credentials
2) Mail setup

## Tests
Unit and feature tests are in the tests directory.

## TODO
- Use policy authentication instead of relying on a private method in the PostsController class
- Implement caching
- Implement users that can comment on posts
- Implement WYSIWYG or Markdown
- Allow uploading photos
- Allow uploading files
- Add social media sharing links
- Lazy loading of posts on the main page
- Add a side menu containing the post titles for easier browsing
- Create SEO-friendly blog post URLs
- Use caching to save the admin ID and use it in the User:isAdmin method

## Contact
If you like the blog or if you're just feeling social, feel free to [email](mailto:abdallah.chamas@gmail.com) me or connect with me on [LinkedIn](https://www.linkedin.com/in/achamas).