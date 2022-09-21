# my-drupal-project

## QED Task

To setup the project in Local environment
### 1. Clone the repository.
     git clone git@github.com:balasaranyav/my-project.git
### 4. Start lando (It will automatically install the composer).
     lando start
### 5. List information about this app. (check If lando works)
     lando info
### 6. To install site
     lando drush site-install standard --db-url='mysql://drupal9:drupal9@database/drupal9' --site-name='my-drupal-9' --yes
### 7. Update settings.php file
     $settings['config_sync_directory'] = '../config/sync';
     drush cr  // to clear the cache
### 6. Import the configurations.
     lando ssh
     drush cim
### To solve UUID error
     drush cget system.site uuid // to get the system UUID
     drush cset system.site [uuid] // to set the system UUID (If this doesn't work then manually edit the UUID value from system.site.yml file)
### To solve Entities exists (shortcut_link) error
    drush entity:delete shortcut_set
    // try `drush cim -y` now to import the configurations without error


### Create new branch from develop branch and work on it.
     git checkout -b feature/qed-[ticket-number]-[feature-title]
Example : git checkout -b feature/[purpose-of-branch]
