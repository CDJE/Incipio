Feature: Authenticate users
  The authentication system should work application wide.
  It should be possible to authenticate from the API.

  Scenario: Authenticate to the API with valid credentials gives back a JWT Token.
    When I send a "POST" request to "/api/login_check" with parameters:
      | key      | value |
      | username | admin |
      | password | admin |
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "token" should exist

  Scenario Outline: Access to the API with JWT token should be acccepted.
    Given I authenticate myself as <user>
    When I send a "GET" request to "/api/contexts/Entrypoint"
    Then the response status code should be 200

  Examples:
    | user  |
    | admin |
    | ca    |
    | guest |

  Scenario: Authenticate to the API with wrong credentials combination should result in an error.
    When I send a "POST" request to "/api/login_check" with parameters:
      | key      | value   |
      | username | unknown |
      | password | unknown |
    Then the response status code should be 401
    And the JSON should be equal to:
    """
    {
      "code": 401,
      "message": "Bad credentials"
    }
    """

  @resetSession
  Scenario: Access to the API without JWT token should be refused.
    When I send a "GET" request to "/api/contexts/Entrypoint"
    Then the response status code should be 401
