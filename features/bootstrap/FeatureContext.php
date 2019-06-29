<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext
{
  /**
   * @BeforeScenario
   */
  public function BeforeScenario(){
    $this->username="saugat234";
    echo "Imagine that we cloned new {$this->username}.";
  }

  /**
   * @AfterScenario
   */
  public function AfterScenario(){
    echo "{$this->username}";
  }

    /**
     * @Given I have navigated to the login page
     */
    public function iHaveNavigatedToTheLoginPage()
    {
        $this->visitPath("/users/login");
        sleep(2);
    }

    /**
     * @When I put :arg1 as user id and :arg2 as password in the form
     */
    public function iPutAsUserIdAndAsPasswordInTheForm($arg1, $arg2)
    {
        $username = $this->getSession()->getPage()->findById("id_username");
        $username->setValue($arg1);
        $pass = $this->getSession()->getPage()->findById("id_password");
        $pass->setValue($arg2);
        sleep(2);
    }

    /**
     * @When submit
     */
    public function submit()
    {
        $button = $this->getSession()->getPage()->find("xpath","//div[@class='container']//button[@type='submit'][1]");
        $button->click();
        sleep(2);
    }

    /**
     * @Then redirect to home page
     */
    public function redirectToHomePage()
    {
        $profile = $this->getSession()->getPage()->find("xpath","//a[text()='Profile']");
        if ($profile === null){
          throw new Exception("Not logged in. jasmine le vaneko xaina xaina");
        }
    }

    /**
     * @Then :arg1 should be displayed
     */
    public function shouldBeDisplayed($arg1)
    {
        $disp = $this->getSession()->getPage()->find("xpath","//div[@class='container']/h2");
        if ($disp->getText() !== "Wow! Thanks for coming.") {
          throw new Exception("Login Error");
        }
    }

    /**
     * @Then user should be on the login page
     */
    public function redirectToLoginPage()
    {
        $text = $this->getSession()->getPage()->find("xpath","//div/h2[text()='Login']");
        if ($text===null) {
          throw new Exception("Not on login page");

        }
    }

    /**
     * @Then show error message containing :arg1
     */
    public function showErrorMessageContaining($arg1)
    {
      $error = $this->getSession()->getPage()->find("xpath","//ul[contains(@class,'errorlist')]");
      if ($error === null) {
        throw new Exception("No error found");

      }
      if ($error->getText()!==$arg1) {
         throw new Exception("Found error {$error->getText()}");

      }
    }

    /**
     * @Given I have logged in with :arg1 as user id and :arg2 as password
     */
    public function iHaveLoggedInWithAsUserIdAndAsPassword($arg1, $arg2)
    {
        $this->iHaveNavigatedToTheLoginPage();
        $this->iPutAsUserIdAndAsPasswordInTheForm($arg1,$arg2);
        $this->submit();
        $this->redirectToHomePage();
    }

    /**
     * @When i navigate to create new blog post page
     */
    public function iNavigateToCreateNewBlogPostPage()
    {
      $this->visitPath("/blog-new");
      sleep(2);
    }

    /**
     * @When i fill up the following details in the create new blog post form
     */
    public function iFillUpTheFollowingDetailsInTheCreateNewBlogPostForm(TableNode $table)
    {
        $tab = $table->getRowsHash();
        foreach ($tab as $row => $value) {
          $field = $this->getSession()->getPage()->find("xpath","//*[@name='$row']");
          if ($field === null) {
            throw new Exception("{$row} field was not found");
          }else {
            $row = $value;
          }
          sleep(3);

        }
    }

    /**
     * @When send
     */
    public function send()
    {
        throw new PendingException();
    }

    /**
     * @Then i should be redirected to create new blog post page
     */
    public function iShouldBeRedirectedToCreateNewBlogPostPage()
    {
        throw new PendingException();
    }

    /**
     * @When i navigate to blog page
     */
    public function iNavigateToBlogPage()
    {
        throw new PendingException();
    }

    /**
     * @Then i should see the blog post with title :arg1 should appear
     */
    public function iShouldSeeTheBlogPostWithTitleShouldAppear($arg1)
    {
        throw new PendingException();
    }
}
