Feature: Base settings and configuration
  In order to accelerate delivery of a completer OpenProducer site
  as a Site builder,
  I want to be able to enable a set of default functionality and configuration on install

  Scenario: Ensure some core utility modules are enabled
    Given I run "drush @default pm-list --status=enabled --type=module --core --format=list"
     Then I should get:
     """
     node
     block
     dblog
     page_cache
     dynamic_page_cache
     views
		 """
