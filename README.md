# drupal-playground
Dev drupal module to help with debugging.

### What we can do here
* Run code on each page load.
* Empty page under route /playground/test.
* Ability to view any entity in any view mode.

##### Run code on every request
Checkout playground.module file.

##### View entity
**To view any entity**

/playground/test/{entity_type}/{entity}/

**Optional parameter view_mode can be specified**

/playground/test/{entity_type}/{entity}/{view_mode}

