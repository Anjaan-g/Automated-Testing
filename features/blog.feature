Feature: add blog posts

As a logged in user
I want to create new blogs
So that i can publish them

Scenario: add blog posts
  Given I have logged in with "anjaan" as user id and "anjaan4480" as password
  When i navigate to create new blog post page
  And i fill up the following details in the create new blog post form
  |title|technology|
  |slug|tech|
  |content|This is blog for technology.|
  |publish_date|2019-2-15|
  And send
  Then i should be redirected to create new blog post page
  When i navigate to blog page
  Then i should see the blog post with title "technology" should appear
