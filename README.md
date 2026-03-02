# Raw WP theme to start with SSH/FTP auto deploy
This project uses GitHub Actions to manage automated deployments. The deployment process requires specific secrets to securely connect to the remote server.
Theme contains both SSH and FTP auto deploy actions. Please uncomment one that suite for your scenario.

## Auto deploy Required Secrets

### 1. `WEBSITE_HOST`
- **Description**: The hostname or IP address of the remote server.
- **Example**: `example.com` or `192.168.1.1`

### 2. `WEBSITE_USER_NAME`
- **Description**: The username for the SSH connection to the remote server.
- **Example**: `deployer` or `root`

### 3. `WEBSITE_SSH_KEY`
- **Description**: The private SSH key for authenticating the user on the remote server.
- **Notes**:
    - Ensure the key is in PEM format.
    - Do not include the public key.
    - If you are using FTP Deploy, use this secret for FTP password

### 4. `WEBSITE_THEME_PATH`
- **Description**: The destination path on the remote server where files will be uploaded.
- **Example**: `var/www/html/wp-content/themes/my-theme/`

## ACF development approach
This theme uses components based approach in creating custom ACF page builder. WordPress gutenberg blocks are disabled in this theme. **Components based** means that you need to only use **clone** fields in you ACF page builder and all of your blocks need to be separate components and have different field groups for them. So your page builder must just clone all of theirs fields.

Use such structure for adding your custom CPT files **template-parts/{CPT name}/{archive or single}/{corresponding CPT files}** 
**Example**: `template-parts/events/single/content.php`

Use such structure for adding your custom CPT cards **template-parts/items/{CPT name}-card.php**
**Example**: `template-parts/items/events-card.php`

**Required name** for ACF Flexible Content page builder field is `page-builder`

## Folder structure
- **js/classes/Ajax.js**: EXAMPLE OF JS AJAX class to simplify AJAX logic **[NEED TO BE ADDED TO THE MAIN BUILD FILE AND REMOVED IN RELEASE VERSION OF THE WEBSITE]**
- **js/components/ajax_actions.js**: EXAMPLE OF JS-side AJAX logic file **[NEED TO BE ADDED TO THE MAIN BUILD FILE AND REMOVED IN RELEASE VERSION OF THE WEBSITE]**
- **include/acf.php**: ACF-related settings
- **include/acf_preview.php**: ACF blocks preview logic
- **include/ajax_actions.php**: AJAX-related actions
- **include/constants.php**: Constants
- **include/cpt.php**: CPT registering
- **include/taxonomy.php**: Taxonomies registering
- **include/enqueue_scripts.php**: Scripts/Styles registering
- **include/setup_theme.php**: All others theme settings
- **include/theme_functions.php**: Theme global functions
- **template-img**: Uses for storing images of page builder blocks
- **template-parts/page-builder**: Uses for blocks displaying
- **template-parts/sections**: Uses for storing static sections without blocks logic
- **template-parts/items**: Uses for storing CPT cards
- **template-parts/components**: Uses for storing small repetitive elements, like a buttons

## Project build process

### 1. Use `yarn install` command to install all dependencies
### 2. Use one of the build command to build project
#### 2.1 `yarn build` use this command to build project right before going production
#### 2.2 `yarn watch` use this command for development purposes