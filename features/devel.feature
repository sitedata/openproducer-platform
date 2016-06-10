Feature: Developer tools
  In order to accelerate development of OpenProducer
  as a Developer,
  I want to be able to securely and easily enable and disable developer tools

  @security
  Scenario: Ensure developer tools are disabled by default
    Given I run "drush @default pm-list --status=enabled --type=module --format=list"
     Then I should not get:
     """
     openproducer_devel
     features_ui
     views_ui
     devel
     """

#  @security @wip
#  Scenario: Ensure developer tools cannot be enabled from the front-end

  Scenario: Enable developer tools
    Given I run "drush -y @default en openproducer_devel"
      And I run "drush @default pm-list --status=enabled --type=module --format=list"
     Then I should get:
     """
     openproducer_devel
     features_ui
     views_ui
     devel
     """

  @wip
  Scenario: Disable developer tools
	  Given I run "drush -y @default pm-uninstall openproducer_devel"
      And I run "drush @default pm-list --status='not installed' --type=module --format=list"
     Then I should get:
     """
     openproducer_devel
     features_ui
     views_ui
     devel
     """

