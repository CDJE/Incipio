<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Class FrontContext.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FrontContext extends MinkContext
{
    /**
     * Fill login page for admin user.
     *
     * @Given I authenticate myself as admin
     */
    public function authenticateAs()
    {
        $this->fillField('username', 'admin');
        $this->fillField('password', 'admin');
    }
}
