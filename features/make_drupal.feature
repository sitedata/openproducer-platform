Feature: Bootstrap OpenProducer development
  In order to develop and test the OpenProducer distribution
  As a developer
  I need to be able install a basic dev/test site

  Scenario: Install a local development site
     When I run "make clean-drupal"
     Then I should get:
      """
      Stopping any running PHP servers.
      Giving PHP servers a chance to stop.
      Deleting 'default' site database.
      Deleting 'default' site platform.
      """
      And I run "make drupal"
     Then I should get:
      """
      Stopping any running PHP servers.
      """
#      Giving PHP servers a chance to stop.
#      Building platform using dev.build.yml.
#      Make new site in the current directory? (y/n): y
#      Loading composer repositories with package information
#      Installing dependencies
#      Nothing to install or update
#      Generating autoload files
#      Project features contains 2 modules: features_ui, features.
#      Project config_update contains 2 modules: config_update_ui, config_update.
#      Creating local SQLite directory.
#      Creating SQLite directory for default.
#      You are about to create a .mk/.local/drupal/drupal-default/sites/default/settings.php file and CREATE the '.mk/.local/drupal/sqlite/default/db.sqlite' database. Do you want to continue? (y/n): y
#      Starting PHP server.
#      Giving PHP server a chance to start.
#      A browser window should open on your new site. If not, use the following URL:
#      http://localhost:8888/user/reset/
#      """
      And the following files should exist:
      """
      .mk/.local/drupal/drupal-default/sites/default/settings.php
      .mk/.local/drupal/sqlite/default/db.sqlite
      """
      And the file ".mk/.local/drupal/drupal-default/sites/default/settings.php" should contain:
      """
      $settings['install_profile'] = 'openproducer';
      """
