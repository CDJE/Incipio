Feature: Authenticate users
  The authentication system should work application wide.
  It should be possible to authenticate from the API or the front-end.

#  TODO: WIP
#  Scenario: Authenticate via the login page should redirect to the home page.
#    Given I am on "/login"
#    When I authenticate myself as "admin"
#    Then I should be on "/"
#
#
#  Scenario Outline: Access to the API with JWT token should be acccepted.
#    Given I authenticate myself as <user>
#    When I send a "GET" request to "/api/contexts/Entrypoint"
#    Then the response status code should be 200
#
#  Examples:
#    |  user   |
#    |  admin  |
#    |  ca     |
#    |  guest  |
#
#  @resetSession
#  Scenario: Access to the API without JWT token should be refused.
#    When I send a "GET" request to "/api/contexts/Entrypoint"
#    Then the response status code should be 401



  #
  # Front side
  #
#  Scenario: Authenticate via the login page should redirect to the home page.
    #TODO

#  Scenario: Access to a page without login first should redirect to the login page.
    #TODO
