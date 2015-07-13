<?php

use Behat\MinkExtension\Context\MinkContext;

/**
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
