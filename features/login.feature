Feature: Login users

As a user
I want to login
So that i can add awesome blog posts

Scenario: login should be successful with correct username and password
  Given I have navigated to the login page
  When I put "anjaan" as user id and "anjaan4480" as password in the form
  And submit
  Then redirect to home page
  Then "Wow! Thanks for coming" should be displayed

Scenario: user login with invalid username
  Given I have navigated to the login page
  When I put "anjan" as user id and "anjaan4480" as password in the form
  And submit
  Then redirect to login page
  And show error message containing "Please enter a correct username and password"

Scenario: user login with invalid password
  Given I have navigated to the login page
  When I put "anjaan" as user id and "anjan4480" as password in the form
  And submit
  Then redirect to login page
  And show error message containing "Please enter a correct username and password"
