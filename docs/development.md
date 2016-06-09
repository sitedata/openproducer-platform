Developing OpenProducer [![Build status](https://gitlab.com/openproducer/openproducer/badges/8.x-0.0.x/build.svg)](https://gitlab.com/openproducer/openproducer/builds)
=======================

OpenProducer is built on Drupal 8, and consists mostly of modules exported using Features.

Behaviour-Driven Development
----------------------------

We're already largely tooled up for [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development), using Drumkit and Behat.

Basically, the workflow for adding a new feature involves:

1. Create new issue here in the main (distro) project (we can then dispatch it to a separate module, if req'd.)
2. Label it as a "Feature request".
3. Flesh out one or more user stories.
4. (Optional) Depending on scope and such, split out multiple stories into separate issues.
5. (Optional) Fork this repo, if the developer doesn't have commit access.
6. Create one or more new feature branches.
7. Begin writing tests that capture the components and workflows.
8. Run the new tests to ensure they fail.
9. Begin building Features to satisfy the tests.
10. Begin documenting the new feature, within the UI, here in the docs, and perhaps using the Tour module to introduce more complex workflows.
10. Once reasonably complete, with passing tests and good documentation, create a merge request.
11. Once we're satisfied with the state of the implementation and tests, merge the feature branch.
12. Update draft of release notes for next version.


Development Environment
-----------------------

To get started, clone this repo locally, and check out the feature branch you want to work on:

    :::console
    $ git clone --recursive https://gitlab.com/openproducer/openproducer.git
    $ cd openproducer
    $ git checkout 6-base-profile-feature

Bootstrap Drumkit, and install a local development site:

    :::console
    $ . d    # Note the *space*, as we're **sourcing** this file, in order to load some environment variable, etc.
    $ make drupal

You should now have a browser window open on the development site (http://localhost:8888/) prompting you to login using the one-time login link.


Writing Tests
-------------

Next we need to add a Behat feature. Create a file under the `features/` directory (e.g. `features/devel.feature`) that contains the feature specification. For example, here's the beginning of a "Developer tools" feature:

    :::gherkin
    Feature: Developer tools
      In order to accelerate development of OpenProducer
      as a Developer,
      I want to be able to securely and easily enable and disable developer tools
    
      @security @wip
      Scenario: Ensure developer tools are disabled by default
        Given I run "drush @default pm-list --status=enabled --type=module --core --format=list"
         Then I should not get:
         """
         features_ui
         views_ui
         devel
         """

Note that the latest scenario we're about to build is tagged with "@wip". This represents a 'work-in-progress', and won't be run during our automated CI tests.

    :::console
    $ make drupal-tests-wip
    Downloading the 1.0.0-beta1 release of Composer.
    [...]
    Generating project-specific Behat config.

    Feature: Developer tools
      In order to accelerate development of OpenProducer
      as a Developer,
      I want to be able to securely and easily enable and disable developer tools
    
      @security
      Scenario: Ensure developer tools are disabled by default                                   # features/devel.feature:7
        Given I run "drush @default pm-list --status=enabled --type=module --core --format=list" # FeatureContext::iRun()
        Then I should not get:                                                                   # FeatureContext::iShouldNotGet()
          """
          features_ui
          views_ui
          devel
          """
    
    1 scenario (1 passed)
    2 steps (2 passed)
    0m3.91s (22.22Mb)

If this is the first time that you're running the test suite in this project, then the above command will install Behat for you.

As we can see, this test passed (as expected). This is only because it's testing the default state. But now we need to re-run that test, to ensure that it *can* fail. If we don't confirm that the test fails before implementing the feature it's intended to test, then we have a false negative. That is, the test isn't really ensuring that the desired functionality actually works. Thus it wouldn't be helpful in flagging regressions later on either.

In this case, we need to simply enable one of the modules that we're going to make a part of our feature, and re-run the tests:

    :::console
    $ drush -y @default en views_ui
    The following extensions will be enabled: views_ui
    Do you really want to continue? (y/n): y
    views_ui was enabled successfully.                                                                             [ok]
    views_ui defines the following permissions: administer views
    $ make drupal-tests CURRENT_TEST=features/devel.feature
    Generating project-specific Behat config.
    [...]
        Given I run "drush @default pm-list --status=enabled --type=module --core --format=list" # FeatureContext::iRun()
        Then I should not get:                                                                   # FeatureContext::iShouldNotGet()
          """
          features_ui
          views_ui
          devel
          """
          'views_ui' was found in command output:
          ------
          block
          [...]
          views
          views_ui
    --- Failed scenarios:
    
        features/devel.feature:7
    
    1 scenario (1 failed)
    2 steps (1 passed, 1 failed)
    0m1.83s (22.30Mb)

Note that, when we called `make drupal-tests`, we set the `CURRENT_TEST` variable to point to the file where our current tests reside. This is another way to limit the tests we'll run on any given invocation.

Anyway, that failed, as expected, thus confirming that our test is valid. We can remove the "@wip" tag, since this feature will work as-is. Next let's define what should happen when we enable our feature. Again, in `features/devel.feature`, we add our next scenario:

    :::gherkin
    @wip
    Scenario: Enable developer tools
      Given I run "drush -y @default en openproducer_devel"
       Then I should get:
       """
       openproducer_devel was enabled successfully.
       """
        And I run "drush @default pm-list --status=enabled --type=module --format=list"
       Then I should get:
       """
       openproducer_devel
       features_ui
       views_ui
       devel
       """

Running this test ought to fail with an error like this:

    :::console
    Scenario: Enable developer tools                                                  # features/devel.feature:21
      Given I run "drush -y @default en openproducer_devel"                           # FeatureContext::iRun()
        openproducer_devel was not found.                                    [warning]
        No release history was found for the requested project               [error]
        (openproducer_devel).

The next step is to implement the feature on the dev Drupal site. The easiest way to accomplish this is to use Features to create a module, building out the necessary scaffolding for us. The Features module is already included in our makefile, and thus available on our dev site. It need only be enabled. We won't go into detail on how to build Features, since that's beyond the scope of this documentation.

Once the Feature has been exported, our tests ought to pass. If not, we've likely missed something, which should become pretty obvious from the output of our tests. Iterate on your feature until it passes the current scenario. Once it does, you should remove the "@wip" tag and commit the code. Remember to add a good commit message.

Upon pushing this code, our Continuous Integration (CI) system should kick off our test suite. Ensure that the new tests are being run (and passing, of course). After that, you're ready to tackle the next scenario.

