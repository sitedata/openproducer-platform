Feature: Check basic status of an OpenProducer site
  In order to develop and test the OpenProducer distribution
  As a developer
  I need to be able to ensure an OP site is basically functional

  Scenario: Anonymous access to the homepage
    Given I am not logged in
      And I am on the homepage
     Then I should see the text "Log in"

  Scenario: New account creation
    Given I am not logged in
      And I visit "/user/register"
     Then I should see the text "Create new account"

  Scenario: Anonymous access to the status report
    Given I am not logged in
      And I am on "/admin/reports/status"
     Then I should get a "403" HTTP response
     Then I should see the text "Access denied"

#  @api
# This is currently failing. We could work-around it, perhaps using selenium/js.
# But it should be fixed in the upcoming 3.2.0 version of the Behat Drupal extension.
# See: https://github.com/jhedstrom/drupalextension/pull/237
#  Scenario: Administrator access to the status report
#    Given I am logged in as a user with the "Administrator" role
#      And I visit "/admin/reports/status"
#     Then I should see the text "Status report"
#      And I should see the text "OpenProducer (openproducer-)"
