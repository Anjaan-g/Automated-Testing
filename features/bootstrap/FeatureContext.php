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
     * @Given I have navigated to the login page
     */
    public function iHaveNavigatedToTheLoginPage()
    {
        $this->visitPath("/users/login");
        sleep(5);
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
        sleep(5);
    }

    /**
     * @When submit
     */
    public function submit()
    {
        $button = $this->getSession()->getPage()->find("xpath","//div[@class='container']//button[@type='submit'][1]");
        $button->click();
        sleep(5);
    }

    /**
     * @Then redirect to home page
     */
    public function redirectToHomePage()
    {
        $profile = $this->getSession()->getPage()->find("xpath","//*[@id='navbarSupportedContent']/ul[2]/li[1]/a");
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
        if ($disp !== "Wow! Thanks for coming") {
          throw new Exception("Login Error");
        }
    }

    /**
     * @Then redirect to login page
     */
    public function redirectToLoginPage()
    {
        throw new PendingException();
    }

    /**
     * @Then show error message containing :arg1
     */
    public function showErrorMessageContaining($arg1)
    {
        throw new PendingException();
    }
}
