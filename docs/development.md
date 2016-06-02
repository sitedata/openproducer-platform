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
