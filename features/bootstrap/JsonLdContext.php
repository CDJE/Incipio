<?php

/**
 * Class JsonLdContext.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class JsonLdContext extends \Sanpi\Behatch\Context\RestContext
{
    /**
     * Check if the response is in JSON-LD. Is considered as JSON-LD response a valid JSON with the property
     * content-type header.
     *
     * @Then the response should be in JSON-LD
     */
    public function jsonLdResponse()
    {
        $isJson = json_decode($this->getSession()->getDriver()->getContent());
        if (!$isJson) {
            throw new \Exception('Expected response content to be JSON.');
        }

        $this->theHeaderShouldBeEqualTo('content-type', 'application/ld+json');
    }
}
