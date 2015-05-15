Feature: Authenticate users
  The authentication system should work application wide.
  It should be possible to authenticate the login form.

  Scenario Outline: Authenticate via the login page should redirect to the home page.
  Once logged in, the login page is inaccessible.
  It should be possible to log out.
    Given I am on "/login"
    When I fill in the following:
      | username | <username> |
      | password | <password> |
    And I press "Se connecter"
    Then I should be on "/"
    And I should see ""
    And I should not see "Se connecter"
    When I go to "/login"
    Then I am on "/"
    When I follow "Se déconnecter"
    Then I am on "/login"

  Examples:
    | username             | password |
    | admin                | admin    |
    | admin@incipio.fr     | admin    |
    | ca                   | ca       |
    | ca-member@incipio.fr | ca       |
    | guest                | guest    |
    | guest@incipio.fr     | guest    |

  Scenario: Access to a page when not logged in should redirect to the login page.
  Once logged in, the user should be redirected to the first requested page.
    Given I am on "/users"
    Then I am on "/login"
    When I authenticate myself as admin
    And I press "Se connecter"
    Then I should be on "/users/"

  Scenario: Try to log in with wrong credentials.
    Given I am on "/login"
    When I fill in the following:
      | username | unknown |
      | password | unknown |
    And I press "Se connecter"
    Then I should see "Logins invalides"
