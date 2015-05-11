Feature: Authenticate users
  The authentication system should work application wide.
  It should be possible to authenticate from the API or the front-end.

  #
  # API side
  #
  Scenario: Authenticate to the API with login/password gives back a JWT Token.
    When I send a "POST" request to "/api/login_check" with parameters:
      | key      | value          |
      | username | admin          |
      | password | admin          |
    Then print current URL
    Then print the response
    Then the response status code should be 200
    And the response should be in JSON-LD
    And the JSON node "token" should exist

#  Scenario: Access to the API with JWT token should be acccepted.
#    Given I authenticate myself as "admin"
#    When I send a "GET" request to "/api/contexts/Entrypoint"
#    Then the response status code should be 200

#  Scenario: Access to the API without JWT token should be refused.
    #TODO


  #
  # Front side
  #
#  Scenario: Authenticate via the login page should redirect to the home page.
    #TODO

#  Scenario: Access to a page without login first should redirect to the login page.
    #TODO
