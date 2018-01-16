<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "inter_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'InterTheme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'InterTheme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<h2>Bootstrap</h2><p>When adding HTML or need a reference to the Grid Layout please see <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank">Bootstrap</a>. This theme was built using Bootstrap as a foundation and shares the same code.</p><h3>Helpful Links</h3><ol><li>Grid Reference: <a href="https://getbootstrap.com/docs/4.0/layout/grid/" target="_blank">Bootstrap Grid</a></li><li>Hide/Show elements on mobile/tablet/desktop: <a href="https://getbootstrap.com/docs/4.0/utilities/display/" target="_bank">Bootstrap display utilities</a></li><li>Font Awesome Icons: <a href="https://fontawesome.com/" target="_blank">Font Awesome 5</a></li></ol>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( "<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>", 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This theme was developed by <a href="https://www.interpolate.co" target="_blank">Interpolate co</a>.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Business Information', 'redux-framework-demo' ),
        'id'         => 'business-information',
        'desc'       => __( 'This information is used for your websites Markup Schema. It is important that you used Markup schema to satisfy Google\'s algorithms.', 'redux-framework-demo'),
        'icon'       => 'el el-address-book',
        'fields'     => array(
            array(
                'id'       => 'business-name',
                'type'     => 'text',
                'title'    => __( 'Business Name', 'redux-framework-demo' ),
                'default'  => 'Business',
            ),
            array(
                'id'       => 'business-legal-name',
                'type'     => 'text',
                'title'    => __( 'Business Legal Name', 'redux-framework-demo' ),
                'default'  => 'Business ltd.',
            ),
            array(
                'id'       => 'business-founding-date',
                'type'     => 'text',
                'title'    => __( 'Business Founding Date', 'redux-framework-demo' ),
                'subtitle'    => __( 'Enter a year', 'redux-framework-demo' ),
                'default'  => '2017',
            ),
            array(
                'id'       => 'business-founder-one',
                'type'     => 'text',
                'title'    => __( 'Business Founder One', 'redux-framework-demo' ),
                'default'  => 'John Smith',
            ),
            array(
                'id'       => 'business-founder-two',
                'type'     => 'text',
                'title'    => __( 'Business Founder Two', 'redux-framework-demo' ),
                'default'  => 'Scott William',
            ),
            array(
                'id'       => 'business-founder-three',
                'type'     => 'text',
                'title'    => __( 'Business Founder Three', 'redux-framework-demo' ),
                'default'  => 'Michael Jackson',
            ),
            array(
                'id'       => 'business-logo',
                'type'     => 'media',
                'url'      => false,
                'title'    => __( 'Business Logo', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
            array(
                'id'       => 'business-streeet-address',
                'type'     => 'text',
                'title'    => __( 'Street Address', 'redux-framework-demo' ),
                'default'  => '123 Business Avenue',
            ),
            array(
                'id'       => 'business-city',
                'type'     => 'text',
                'title'    => __( 'City', 'redux-framework-demo' ),
                'default'  => 'Newcastle Upon Tyne',
            ),
            array(
                'id'       => 'business-region',
                'type'     => 'text',
                'title'    => __( 'Region', 'redux-framework-demo' ),
                'default'  => 'Tyne and Wear',
            ),
            array(
                'id'       => 'business-postal-code',
                'type'     => 'text',
                'title'    => __( 'Postal Code', 'redux-framework-demo' ),
                'default'  => 'NE10 0JP',
            ),
            array(
                'id'       => 'business-country',
                'type'     => 'text',
                'title'    => __( 'Country', 'redux-framework-demo' ),
                'default'  => 'UK',
            ),
            array(
                'id'       => 'business-contact-telephone',
                'type'     => 'text',
                'title'    => __( 'Contact Telephone', 'redux-framework-demo' ),
                'default'  => '+44 (0)191 123 4567',
            ),
            array(
                'id'       => 'business-contact-email',
                'type'     => 'text',
                'title'    => __( 'Contact Email', 'redux-framework-demo' ),
                'default'  => 'help@business.com',
            ),
            array(
                'id'       => 'use-markup-schema',
                'type'     => 'select',
                'title'    => __( 'Use Markup Schema', 'redux-framework-demo' ),
                'subtitle' => __( 'By default the theme provides some markup scheme but this can be removed if it is causing conflict with other plugins.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Favicon', 'redux-framework-demo' ),
        'id'         => 'favicon',
        'desc'       => __( 'Upload a Favicon and choose to turn it on or off.', 'redux-framework-demo'),
        'icon'       => 'el el-picture',
        'fields'     => array(
            array(
                'id'       => 'use-favicon',
                'type'     => 'select',
                'title'    => __( 'Use Favicon', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
            array(
                'id'       => 'favicon',
                'type'     => 'media',
                'url'      => false,
                'title'    => __( 'Favicon', 'redux-framework-demo' ),
                'subtitle' => __( 'Max 32x32 Pixels.', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Top Bar', 'redux-framework-demo' ),
        'id'               => 'top-bar',
        'desc'              => __( 'We have added the option to add a Top Bar to the theme. This can be used to display Contact Information or Social Links, etc.', 'redux-framework-demo' ),
        'customizer_width' => '500px',
        'icon'       => 'el el-website',
        'fields'           => array(
            array(
                'id'       => 'show-top-bar',
                'type'     => 'select',
                'title'    => __( 'Show Top Bar?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'top-bar-mobile',
                'type'     => 'select',
                'title'    => __( 'Show Top Bar on small devices?', 'redux-framework-demo' ),
                'subtitle' => __( 'Devices less than 768px.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
            array(
                'id'       => 'top-bar-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Top Bar Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the Top Bar button.', 'redux-framework-demo' ),
                'output' => array('.top-bar'),
                'default'  => array(
                    'color' => '#8b1f1f',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'top-bar-font-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Top Bar Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the font colour of the Top Bar.', 'redux-framework-demo' ),
                'output' => array('.top-bar, .top-bar p, .top-bar a, .top-bar i'),
                'default'  => array(
                    'color' => '#FFFFFF',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'top-bar-left-html',
                'type'     => 'ace_editor',
                'title'    => __('Left HTML', 'redux-framework-demo'),
                'subtitle' => __('Paste your HTML code here.', 'redux-framework-demo'),
                'mode'     => 'html',
                'theme'    => 'chrome'
            ),
            array(
                'id'       => 'top-bar-left-mobile',
                'type'     => 'select',
                'title'    => __( 'Show Top Bar left small devices?', 'redux-framework-demo' ),
                'subtitle' => __( 'Devices less than 768px.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
            array(
                'id'       => 'top-bar-right-html',
                'type'     => 'ace_editor',
                'title'    => __('Right HTML', 'redux-framework-demo'),
                'subtitle' => __('Paste your HTML code here.', 'redux-framework-demo'),
                'mode'     => 'html',
                'theme'    => 'chrome'
            ),
            array(
                'id'       => 'top-bar-right-mobile',
                'type'     => 'select',
                'title'    => __( 'Show Top bar right small devices?', 'redux-framework-demo' ),
                'subtitle' => __( 'Devices less than 768px.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Navigation', 'redux-framework-demo' ),
        'id'         => 'navigation',
        'desc'       => __( 'Theme Navigation settings.', 'redux-framework-demo'),
        'icon'       => 'el el-lines',
        'fields'     => array(
            array(
                'id'       => 'use-nav-logo',
                'type'     => 'select',
                'title'    => __( 'Use Navigation Logo', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose to use a logo. If not, the sites name will be used.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
            array(
                'id'       => 'nav-logo',
                'type'     => 'media',
                'url'      => false,
                'required' => array('use-nav-logo', 'equals', 'yes'),
                'title'    => __( 'Navigation Logo', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
            array(
                'id'       => 'nav-logo-max-width',
                'type'     => 'text',
                'title'    => __( 'Navigation Logo max width', 'redux-framework-demo' ),
                'required' => array('use-nav-logo', 'equals', 'yes'),
                'subtitle' => __( 'Set a max width on the Navigation logo?', 'redux-framework-demo' ),
                'default'  => '100px',
            ),
            array(
                'id'            => 'website-title-font',
                'type'          => 'typography',
                'title'         => __( 'Website Title', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Website Font font properties - this is the name of the website that appears in your navigation when you do not want to use a logo.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '.navbar-brand a.navbar-brand-text' ),
                'line-height'   => false,
                'text-align'    => false,
                'text-transform' => true,
                'units'         => 'rem',
                'required' => array('use-nav-logo', 'equals', 'no'),
                'default'       => array(
                    'color'       => '#c42d2d',
                    'font-size'   => '1rem',
                    'font-family' => 'Montserrat',
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'       => 'sticky-nav',
                'type'     => 'select',
                'title'    => __( 'Sticky Navigation', 'redux-framework-demo' ),
                'subtitle' => __( 'Stick the nav to the top of the screen on scroll?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'nav-align',
                'type'     => 'select',
                'title'    => __( 'Navigation Alignment', 'redux-framework-demo' ),
                'subtitle' => __( 'Align the Navigation to the Left or Right of the Navigation Bar?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default'  => 'left'
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Navigation Colours', 'redux-framework-demo' ),
        'id'               => 'nav-colours',
        'subsection'       => true,
        'customizer_width' => '500px',
        'fields'           => array(
            array(
                'id'       => 'nav-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Navigation Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the Navigation.', 'redux-framework-demo' ),
                'output' => array('background-color' => '#topNavBar, #topNavBar .sub-menu'),
                'default'  => array(
                    'color' => '#f8f9fa',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'nav-link-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Navigation Link Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the link colour of the Navigation.', 'redux-framework-demo' ),
                'output' => array('#navbarSupportedContent .navbar-nav .nav-item .nav-link, .navbar .navbar-nav li.menu-item-has-children > .arrow, .navbar .navbar-toggler'),
                'default'  => array(
                    'color' => '#BBBBBB',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'nav-link-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Navigation Link Hover Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the link hover colour of the Navigation.', 'redux-framework-demo' ),
                'output' => array('#navbarSupportedContent .navbar-nav .nav-item .nav-link:hover'),
                'default'  => array(
                    'color' => '#c42d2d',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'nav-link-color-active',
                'type'     => 'color_rgba',
                'title'    => __( 'Navigation Link Active Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the link active colour of the Navigation.', 'redux-framework-demo' ),
                'output' => array('#navbarSupportedContent .navbar-nav .nav-item.current-menu-item > a, #navbarSupportedContent .navbar-nav .nav-item.current_page_parent > a'),
                'default'  => array(
                    'color' => '#c42d2d',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ), 
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Call To Action', 'redux-framework-demo' ),
        'id'               => 'nav-cta',
        'subsection'       => true,
        'customizer_width' => '500px',
        'fields'           => array(
            array(
                'id'       => 'show-cta-in-nav',
                'type'     => 'select',
                'title'    => __( 'Show CTA button in Navigation bar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the CTA button within the Navigation Bar?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'cta-nav-icon',
                'type'     => 'select',
                'data'     => 'elusive-icons',
                'title'    => __( 'CTA Icon', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose an elusive icon to appear in your Call To Action.', 'redux-framework-demo' ),
                'enqueue'  => true,
                'enqueue_frontend' => true
            ),
            array(
                'id'       => 'cta-nav-text',
                'type'     => 'text',
                'title'    => __( 'CTA Text', 'redux-framework-demo' ),
                'subtitle' => __( 'What should the CTA say?', 'redux-framework-demo' ),
                'default'  => 'Call Now',
            ),
            array(
                'id'       => 'cta-nav-link',
                'type'     => 'text',
                'title'    => __( 'CTA Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Where should the CTA link to?', 'redux-framework-demo' ),
                'desc'     => __('For example: mailto:collaborate@interpolate.co', 'redux-framework-demo'),
                'default'  => 'mailto:collaborate@interpolate.co',
            ),
            array(
                'id'       => 'cta-nav-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'CTA Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the CTA.', 'redux-framework-demo' ),
                'output' => array('#navBarCTA'),
                'default'  => array(
                    'color' => '#c42d2d',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'cta-nav-font-color',
                'type'     => 'color_rgba',
                'title'    => __( 'CTA Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the font colour of the CTA.', 'redux-framework-demo' ),
                'output' => array('#navBarCTA'),
                'default'  => array(
                    'color' => '#FFFFFF',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'cta-nav-border',
                'type'     => 'border',
                'title'    => __( 'CTA Border', 'redux-framework-demo' ),
                'subtitle' => __( 'Select a border for the CTA.', 'redux-framework-demo' ),
                'output'   => array( '#navBarCTA' ),
                'all'      => false,
                'default'  => array(
                    'border-color'  => '#c42d2d',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Search Bar', 'redux-framework-demo' ),
        'id'               => 'nav-search-bar',
        'subsection'       => true,
        'customizer_width' => '500px',
        'fields'           => array(
            array(
                'id'       => 'show-search-bar-in-nav',
                'type'     => 'select',
                'title'    => __( 'Show Search bar in Navigation bar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the Search Bar within the Navigation Bar?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'show-search-icon-mobile',
                'type'     => 'select',
                'title'    => __( 'Show Search icon in Mobile Navigation bar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the Search Bar within the Mobile Navigation Bar?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'nav-search-bar-placeholder',
                'type'     => 'text',
                'title'    => __( 'Search Bar placeholder text', 'redux-framework-demo' ),
                'subtitle' => __( 'What should the placeholder text say?', 'redux-framework-demo' ),
                'default'  => 'Search...',
            ),
            array(
                'id'       => 'nav-search-bar-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Search Bar Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the Search Bar.', 'redux-framework-demo' ),
                'output' => array('#topNavBar #search, .mobile-search #search'),
                'default'  => array(
                    'color' => '#FFF',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'nav-search-bar-font-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Search Bar Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the font colour of the Search Bar.', 'redux-framework-demo' ),
                'output'   => array('#topNavBar #search, .mobile-search #search'),
                'default'  => array(
                    'color' => '#585858',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'nav-search-bar-border',
                'type'     => 'border',
                'title'    => __( 'Search Bar Border', 'redux-framework-demo' ),
                'subtitle' => __( 'Select a border for the Search Bar.', 'redux-framework-demo' ),
                'output'   => array('#topNavBar #search, .mobile-search #search'),
                'all'       => false,
                'default'  => array(
                    'border-color'  => '#c42d2d',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
            array(
                'id'       => 'nav-search-bar-button-background-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Search Bar button Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the Search Bar button.', 'redux-framework-demo' ),
                'output' => array('#topNavBar #searchSubmit, .mobile-search #searchSubmit'),
                'default'  => array(
                    'color' => '#c42d2d',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'nav-search-bar-button-font-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Search Bar button Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the font colour of the Search Bar button.', 'redux-framework-demo' ),
                'output'   => array('#topNavBar #searchSubmit, .mobile-search #searchSubmit'),
                'default'  => array(
                    'color' => '#FFFFFF',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'nav-search-bar-button-border',
                'type'     => 'border',
                'title'    => __( 'Search Bar button Border', 'redux-framework-demo' ),
                'subtitle' => __( 'Select a border for the Search Bar button.', 'redux-framework-demo' ),
                'output'   => array('#topNavBar #searchSubmit, .mobile-search #searchSubmit'),
                'all'       => false,
                'default'  => array(
                    'border-color'  => '#c42d2d',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Header', 'redux-framework-demo' ),
        'id'               => 'page-header',
        'customizer_width' => '500px',
        'icon'       => 'el el-website',
        'fields'           => array(
            array(
                'id'            => 'page-header-heading',
                'type'          => 'typography',
                'title'         => __( 'Title Font Size', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading One font properties.', 'redux-framework-demo' ),
                'google'        => false,
                'output'        => array( '.page-header h1' ),
                'line-height'   => false,
                'color'         => false,
                'text-align'    => false,
                'font-family'   => false,
                'font-weight'   => false,
                'font-style'    => false,
                'text-transform' => true,
                'hint'          => false,
                'units'         => 'rem',
                'default'       => array(
                    'font-size'   => '1.75rem',
                    'text-transform' => 'uppercase',
                )
            ),
            array(
                'id'       => 'page-header-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Page Header Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the Page Header button.', 'redux-framework-demo' ),
                'output' => array('header.page-header'),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'page-header-title-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Page Header Title Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the title font colour of the Page Header button.', 'redux-framework-demo' ),
                'output' => array('header.page-header h1'),
                'default'  => array(
                    'color' => '#FFFFFF',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'page-header-breadcrumb-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Page Header Breadcrumb Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the breadcrumb font colour of the Page Header button.', 'redux-framework-demo' ),
                'output' => array('header.page-header .breadcrumb-item a, .breadcrumb-item:before, .breadcrumb-item+.breadcrumb-item::before'),
                'default'  => array(
                    'color' => '#FFFFFF',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'page-header-breadcrumb-active-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Page Header Breadcrumb active Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the breadcrumb active font colour of the Page Header button.', 'redux-framework-demo' ),
                'output' => array('header.page-header .breadcrumb-item.item-current'),
                'default'  => array(
                    'color' => '#EEEEEE',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer', 'redux-framework-demo' ),
        'id'               => 'footer',
        'customizer_width' => '500px',
        'icon'       => 'el el-website',
        'fields'           => array(
            array(
                'id'       => 'use-footer-logo',
                'type'     => 'select',
                'title'    => __( 'Use Footer Logo', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose to use a logo. If not, the sites name will be used.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'no'
            ),
            array(
                'id'       => 'footer-logo',
                'type'     => 'media',
                'url'      => false,
                'title'    => __( 'Footer Logo', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
            array(
                'id'       => 'footer-logo-max-width',
                'type'     => 'text',
                'title'    => __( 'Footer Logo max width', 'redux-framework-demo' ),
                'subtitle' => __( 'Set a max width on the Footer logo?', 'redux-framework-demo' ),
                'default'  => '100px',
            ),
            array(
                'id'            => 'footer-heading-size',
                'type'          => 'typography',
                'title'         => __( 'Footer Heading Size', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Footer Heading font size properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '#footer .widgettitle' ),
                'line-height'   => false,
                'color'         => false,
                'font-family'   => false,
                'font-weight'   => false,
                'font-style'    => false,
                'text-align'    => false,
                'units'         => 'rem',
                'default'       => array(
                    'font-size'   => '1.75rem'
                )
            ),
            array(
                'id'       => 'footer-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer Background Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the background colour of the Footer.', 'redux-framework-demo' ),
                'output' => array('#footer'),
                'default'  => array(
                    'color' => '#f8f9fa',
                    'alpha' => '1'
                ),
                'mode'     => 'background'
            ),
            array(
                'id'       => 'footer-font-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer Font Colour RGBA', 'redux-framework-demo' ),
                'subtitle' => __( 'Set the title font colour of the Footer.', 'redux-framework-demo' ),
                'output' => array('#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer p, #footer a, #footer li, #copyright'),
                'default'  => array(
                    'color' => '#333333',
                    'alpha' => '1'
                ),
                'mode'     => 'color'
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( '404 Page', 'redux-framework-demo' ),
        'id'         => '404-page',
        'desc'       => __( '404 Page settings.', 'redux-framework-demo'),
        'icon'       => 'el el-warning-sign',
        'fields'     => array(
            array(
                'id'               => '404-body-copy',
                'type'             => 'editor',
                'title'            => __('404 Page Content', 'redux-framework-demo'), 
                'args'   => array(
                    // 'teeny'            => true,
                    'textarea_rows'    => 10
                )
            ),
            array(
                'id'       => '404-layout',
                'type'     => 'select',
                'title'    => __( 'Choose a boxed layout or Full Width layout for the 404 page.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'boxed' => 'Boxed',
                    'full-width' => 'Full Width'
                ),
                'default'  => 'boxed'
            ),
            array(
                'id'       => '404-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( '404 Page Background colour', 'redux-framework-demo' ),
                'output'   => array('.error404 main.page-main'),
                'default'  => array(
                    'color' => '#EFEFEF',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => '404-show-sidebar',
                'type'     => 'select',
                'title'    => __( 'Show Sidebar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the sidebar on the 404 page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => '404-sidebar-position',
                'type'     => 'select',
                'title'    => __( 'Sidebar Position?', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose the sidebar position.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => '404-spacing',
                'type'     => 'spacing',
                'output'   => array( '#PageNotFound' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                'units'    => 'px',
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'top'           => true,     // Disable the left
                'bottom'        => true,     // Disable the left
                'title'    => __( 'Padding Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose how much spacing should be applied to the top and bottom of the page.', 'redux-framework-demo' ),
                'default'  => array(
                    'padding-top'    => '30px',
                    'padding-bottom' => '30px'
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Archive Page', 'redux-framework-demo' ),
        'id'         => 'archive-page',
        'desc'       => __( 'Archive Page settings.', 'redux-framework-demo'),
        'icon'       => 'el el-website',
        'fields'     => array(
            array(
                'id'               => 'archive-body-copy',
                'type'             => 'editor',
                'title'            => __('Archive Page Content', 'redux-framework-demo'),
                'subtitle'              => 'This copy will only appear on pages that are selected to show your blogs posts within WordPress settings.',
                'args'   => array(
                    'textarea_rows'    => 10
                )
            ),
            array(
                'id'       => 'archive-layout',
                'type'     => 'select',
                'title'    => __( 'Choose a boxed layout or Full Width layout for the Archive page.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'boxed' => 'Boxed',
                    'full-width' => 'Full Width'
                ),
                'default'  => 'boxed'
            ),
            array(
                'id'       => 'archive-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Archive Page Background colour', 'redux-framework-demo' ),
                'output'   => array('.blog main.page-main'),
                'default'  => array(
                    'color' => '#EFEFEF',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'archive-show-sidebar',
                'type'     => 'select',
                'title'    => __( 'Show Sidebar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the sidebar on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'archive-sidebar-position',
                'type'     => 'select',
                'title'    => __( 'Sidebar Position?', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose the sidebar position.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'archive-show-header',
                'type'     => 'select',
                'title'    => __( 'Show Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'archive-show-title',
                'type'     => 'select',
                'title'    => __( 'Show Title in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the title in the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'archive-show-breadcrumbs',
                'type'     => 'select',
                'title'    => __( 'Show Breadcrumbs in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the breadcrumbs in the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'archive-posts-per-row',
                'type'     => 'select',
                'title'    => __( 'Posts per row', 'redux-framework-demo' ),
                'subtitle' => __( 'How many posts should be shown per row?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'archive-spacing',
                'type'     => 'spacing',
                'output'   => array( '.blog main.page-main, #archive' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                'units'    => 'px',
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'top'           => true,     // Disable the left
                'bottom'        => true,     // Disable the left
                'title'    => __( 'Padding Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose how much spacing should be applied to the top and bottom of the page.', 'redux-framework-demo' ),
                'default'  => array(
                    'padding-top'    => '30px',
                    'padding-bottom' => '30px'
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Search Page', 'redux-framework-demo' ),
        'id'         => 'search-page',
        'desc'       => __( 'Search Page settings.', 'redux-framework-demo'),
        'icon'       => 'el el-search',
        'fields'     => array(
            array(
                'id'       => 'search-layout',
                'type'     => 'select',
                'title'    => __( 'Choose a boxed layout or Full Width layout for the Search page.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'boxed' => 'Boxed',
                    'full-width' => 'Full Width'
                ),
                'default'  => 'boxed'
            ),
            array(
                'id'       => 'search-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Search Page Background colour', 'redux-framework-demo' ),
                'output'   => array('.search main.page-main'),
                'default'  => array(
                    'color' => '#EFEFEF',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'search-show-sidebar',
                'type'     => 'select',
                'title'    => __( 'Show Sidebar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the sidebar on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'search-sidebar-position',
                'type'     => 'select',
                'title'    => __( 'Sidebar Position?', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose the sidebar position.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'search-show-header',
                'type'     => 'select',
                'title'    => __( 'Show Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'search-show-title',
                'type'     => 'select',
                'title'    => __( 'Show Title in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the title in the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'search-show-breadcrumbs',
                'type'     => 'select',
                'title'    => __( 'Show Breadcrumbs in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the breadcrumbs in the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'search-posts-per-row',
                'type'     => 'select',
                'title'    => __( 'Posts per row', 'redux-framework-demo' ),
                'subtitle' => __( 'How many posts should be shown per row?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'search-spacing',
                'type'     => 'spacing',
                'output'   => array( '#archive' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                'units'    => 'px',
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'top'           => true,     // Disable the left
                'bottom'        => true,     // Disable the left
                'title'    => __( 'Padding Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose how much spacing should be applied to the top and bottom of the page.', 'redux-framework-demo' ),
                'default'  => array(
                    'padding-top'    => '30px',
                    'padding-bottom' => '30px'
                )
            ),
        )
    ) );

    if ( class_exists( 'WooCommerce' ) ):

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Woocommerce', 'redux-framework-demo' ),
        'id'         => 'woocommerce-settings',
        'desc'       => __( 'Shop Page settings.', 'redux-framework-demo'),
        'icon'       => 'el el-shopping-cart',
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Shop Page', 'redux-framework-demo' ),
        'id'         => 'woocommerce-shop',
        'desc'       => __( 'Shop Page settings.', 'redux-framework-demo'),
        'icon'       => 'el el-shopping-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'shop-layout',
                'type'     => 'select',
                'title'    => __( 'Choose a boxed layout or Full Width layout for the Shop page.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'boxed' => 'Boxed',
                    'full-width' => 'Full Width'
                ),
                'default'  => 'boxed'
            ),
            array(
                'id'       => 'shop-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Shop Page Background colour', 'redux-framework-demo' ),
                'output'   => array('.archive.woocommerce main.page-main'),
                'default'  => array(
                    'color' => '#EFEFEF',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'shop-show-sidebar',
                'type'     => 'select',
                'title'    => __( 'Show Sidebar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the sidebar on the shop page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'shop-sidebar-position',
                'type'     => 'select',
                'title'    => __( 'Sidebar Position?', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose the sidebar position.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'shop-show-header',
                'type'     => 'select',
                'title'    => __( 'Show Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the header on the shop page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'shop-show-title',
                'type'     => 'select',
                'title'    => __( 'Show Title in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the title in the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'shop-show-breadcrumbs',
                'type'     => 'select',
                'title'    => __( 'Show Breadcrumbs in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the breadcrumbs in the header on the archive page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'shop-posts-per-row',
                'type'     => 'select',
                'title'    => __( 'Posts per row', 'redux-framework-demo' ),
                'subtitle' => __( 'How many posts should be shown per row?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'shop-spacing',
                'type'     => 'spacing',
                'output'   => array( '.archive.woocommerce main.page-main, #archive' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                'units'    => 'px',
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'top'           => true,     // Disable the left
                'bottom'        => true,     // Disable the left
                'title'    => __( 'Padding Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose how much spacing should be applied to the top and bottom of the page.', 'redux-framework-demo' ),
                'default'  => array(
                    'padding-top'    => '30px',
                    'padding-bottom' => '30px'
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Product Page', 'redux-framework-demo' ),
        'id'         => 'woocommerce-product',
        'desc'       => __( 'Product Page settings.', 'redux-framework-demo'),
        'icon'       => 'el el-shopping-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'product-layout',
                'type'     => 'select',
                'title'    => __( 'Choose a boxed layout or Full Width layout for the Product page.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'boxed' => 'Boxed',
                    'full-width' => 'Full Width'
                ),
                'default'  => 'boxed'
            ),
            array(
                'id'       => 'product-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Product Page Background colour', 'redux-framework-demo' ),
                'output'   => array('.woocommerce main.page-main#single'),
                'default'  => array(
                    'color' => '#EFEFEF',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'product-show-sidebar',
                'type'     => 'select',
                'title'    => __( 'Show Sidebar?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the sidebar on the product page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'product-sidebar-position',
                'type'     => 'select',
                'title'    => __( 'Sidebar Position?', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose the sidebar position.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'product-show-header',
                'type'     => 'select',
                'title'    => __( 'Show Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the header on the product page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'product-show-title',
                'type'     => 'select',
                'title'    => __( 'Show Title in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the title in the header on the product page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'product-show-breadcrumbs',
                'type'     => 'select',
                'title'    => __( 'Show Breadcrumbs in Header?', 'redux-framework-demo' ),
                'subtitle' => __( 'Show the breadcrumbs in the header on the product page?', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'product-spacing',
                'type'     => 'spacing',
                'output'   => array( '.woocommerce main.page-main#single' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                'units'    => 'px',
                // Have one field that applies to all
                'right'         => false,     // Disable the right
                'left'          => false,     // Disable the left
                'top'           => true,     // Disable the left
                'bottom'        => true,     // Disable the left
                'title'    => __( 'Padding Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose how much spacing should be applied to the top and bottom of the page.', 'redux-framework-demo' ),
                'default'  => array(
                    'padding-top'    => '30px',
                    'padding-bottom' => '30px'
                )
            ),
        )
    ) );

    endif;

    // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'redux-framework-demo' ),
        'id'     => 'typography',
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'            => 'typography-body',
                'type'          => 'typography',
                'title'         => __( 'Body Font', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Body font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'p, .p, li, .li, th, td, dt' ),
                'line-height'   => true,
                'text-align'    => false,
                'units'         => 'rem',
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1rem',
                    'font-family' => 'Open Sans',
                    'font-weight' => '300',
                ),
            ),
            array(
                'id'            => 'typography-body-strong',
                'type'          => 'typography',
                'title'         => __( 'Body Font - Bold', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Bold Body font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'p strong, .p strong, li strong, .li strong, th strong, td strong, dt strong, strong' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'false',
                'font-size'     => false,
                'color'         => false,
                'subsets'       => false,
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1rem',
                    'font-family' => 'Open Sans',
                    'font-weight' => '300',
                ),
            ),
            array(
                'id'            => 'typography-body-anchor',
                'type'          => 'typography',
                'title'         => __( 'Ancher Font', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specfify link font properties.', 'redux-framework-demo' ),
                'google'        => false,
                'output'        => array( 'a, p a' ),
                'line-height'   => false,
                'text-align'    => false,
                'font-size'     => false,
                'font-family'   => false,
                'font-weight'   => false,
                'font-style'    => false,
                'units'         => 'rem',
                'default'       => array(
                    'color'       => '#c42d2d',
                    'font-size'   => '1rem',
                    'font-family' => 'Open Sans',
                    'font-weight' => 'Normal',
                ),
            ),
            array(
                'id'            => 'typography-heading-one',
                'type'          => 'typography',
                'title'         => __( 'Heading One', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading One font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'h1, .h1' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#000',
                    'font-size'   => '2.5rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-heading-two',
                'type'          => 'typography',
                'title'         => __( 'Heading Two', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading Two font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'h2, .h2' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#c42d2d',
                    'font-size'   => '2rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-heading-three',
                'type'          => 'typography',
                'title'         => __( 'Heading Three', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading Three font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'h3, .h3' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1.75rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-heading-four',
                'type'          => 'typography',
                'title'         => __( 'Heading Four', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading Four font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'h4, .h4' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1.5rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-heading-five',
                'type'          => 'typography',
                'title'         => __( 'Heading Five', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading Five font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'h5, .h5' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1.25rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-heading-six',
                'type'          => 'typography',
                'title'         => __( 'Heading Six', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Heading Six font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( 'h6, .h6' ),
                'line-height'   => false,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-navigation',
                'type'          => 'typography',
                'title'         => __( 'Navigation', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Navigation font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '#navbarSupportedContent .navbar-nav .nav-item .nav-link' ),
                'line-height'   => true,
                'text-align'    => false,
                'color'         => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'font-size'   => '1rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-topbar',
                'type'          => 'typography',
                'title'         => __( 'Top bar', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Top bar font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '.top-bar' ),
                'line-height'   => true,
                'text-align'    => false,
                'color'         => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'font-size'   => '1rem',
                    'font-family' => 'Open Sans',
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-footer',
                'type'          => 'typography',
                'title'         => __( 'Footer Font', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Footer font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '#footer p, #footer a, #footer li, #copyright' ),
                'line-height'   => true,
                'text-align'    => false,
                'units'         => 'rem',
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                ),
            ),
            array(
                'id'            => 'typography-breadcrumb',
                'type'          => 'typography',
                'title'         => __( 'Breadcrumb Font', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Breadcrumb font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '#breadcrumbs li, #breadcrumbs li a, #breadcrumbs li:before, .woocommerce-breadcrumb, .woocommerce-breadcrumb a, .woocommerce-breadcrumb a:before' ),
                'line-height'   => true,
                'color'         => false,
                'text-align'    => false,
                'units'         => 'rem',
                'default'       => array(
                    'color'       => '#000000',
                    'font-size'   => '1rem',
                    'font-family' => 'Open Sans',
                    'font-weight' => 'Normal',
                ),
            ),
            array(
                'id'            => 'typography-button-primary',
                'type'          => 'typography',
                'title'         => __( 'Primary Button', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Primary Button font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '.btn-primary, .btn-primary:hover, .woocommerce button.single_add_to_cart_button.button, .woocommerce a.button, .woocommerce a.button:hover, #commentform input[type="submit"], .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce #place_order, .woocommerce #place_order:hover, .woocommerce-MyAccount-downloads-file, .woocommerce-MyAccount-downloads-file:hover' ),
                'line-height'   => true,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#FFFFFF',
                    'font-size'   => '1rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            ),
            array(
                'id'            => 'typography-button-secondary',
                'type'          => 'typography',
                'title'         => __( 'Secondary Button', 'redux-framework-demo' ),
                'subtitle'      => __( 'Specify the Secondary Button font properties.', 'redux-framework-demo' ),
                'google'        => true,
                'output'        => array( '.btn-secondary, .btn-secondary:hover, .woocommerce a.button.alt, .woocommerce a.button.alt:hover' ),
                'line-height'   => true,
                'text-align'    => false,
                'units'         => 'rem',
                'text-transform' => true,
                'default'       => array(
                    'color'       => '#FFFFFF',
                    'font-size'   => '1rem',
                    'font-family' => "PT Serif",
                    'font-weight' => 'Normal',
                )
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social', 'redux-framework-demo' ),
        'id'               => 'social',
        'customizer_width' => '500px',
        'icon'       => 'el el-facebook',
        'fields'           => array(
            array(
                'id'       => 'facebook-link',
                'type'     => 'text',
                'title'    => __( 'Facebook Link', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'twiiter-link',
                'type'     => 'text',
                'title'    => __( 'Twitter Link', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'instagram-link',
                'type'     => 'text',
                'title'    => __( 'Instagram Link', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'google-plus-link',
                'type'     => 'text',
                'title'    => __( 'Google Plus Link', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'pinterest-link',
                'type'     => 'text',
                'title'    => __( 'Pinterest Link', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'linkedin-link',
                'type'     => 'text',
                'title'    => __( 'LinkedIn Link', 'redux-framework-demo' ),
                'default'  => '',
            ),
            array(
                'id'       => 'youtube-link',
                'type'     => 'text',
                'title'    => __( 'YouTube Link', 'redux-framework-demo' ),
                'default'  => '',
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Buttons', 'redux-framework-demo' ),
        'id'               => 'button',
        'customizer_width' => '500px',
        'icon'       => 'el el-brush',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Primary Button', 'redux-framework-demo' ),
        'id'               => 'primary-button',
        'customizer_width' => '500px',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'primary-btn-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Primary Button Background colour', 'redux-framework-demo' ),
                'output'   => array('.btn-primary, .btn-primary:hover, .woocommerce button.single_add_to_cart_button.button, .woocommerce button.single_add_to_cart_button.button:hover, .woocommerce a.button, .woocommerce a.button:hover, #commentform input[type="submit"], .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce #place_order, .woocommerce #place_order:hover, .woocommerce-MyAccount-downloads-file, .woocommerce-MyAccount-downloads-file:hover:hover'),
                'default'  => array(
                    'color' => '#c42d2d',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'primary-btn-font-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Primary Button Font colour', 'redux-framework-demo' ),
                'output'   => array('.btn-primary, .btn-primary:hover, .woocommerce button.single_add_to_cart_button.button, .woocommerce button.single_add_to_cart_button.button:hover .woocommerce a.button, .woocommerce a.button:hover, #commentform input[type="submit"], .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce #place_order, .woocommerce #place_order:hover, .woocommerce-MyAccount-downloads-file, .woocommerce-MyAccount-downloads-file:hover'),
                'default'  => array(
                    'color' => '#FFFFFF',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'primary-btn-border',
                'type'     => 'border',
                'title'    => __( 'Primary Button Border', 'redux-framework-demo' ),
                'output'   => array( '.btn-primary, .btn-primary:hover, .woocommerce button.single_add_to_cart_button.button, .woocommerce button.single_add_to_cart_button.button:hover, .woocommerce a.button, .woocommerce a.button:hover, #commentform input[type="submit"], .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce #place_order, .woocommerce #place_order:hover, .woocommerce-MyAccount-downloads-file, .woocommerce-MyAccount-downloads-file:hover' ),
                'radius_enabled' => true,
                'all'      => false,
                'default'  => array(
                    'border-color'  => '#c42d2d',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Secondary Button', 'redux-framework-demo' ),
        'id'               => 'secondary-button',
        'customizer_width' => '500px',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'secondary-btn-background-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Secondary Button Background colour', 'redux-framework-demo' ),
                'output'   => array('.btn-secondary, .btn-secondary:hover, #sidebar button, #sidebar input[type="submit"], .single-post-tags .badge,.woocommerce a.button.alt, .woocommerce a.button.alt:hover'),
                'default'  => array(
                    'color' => '#e4e4e4',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'secondary-btn-font-colour',
                'type'     => 'color_rgba',
                'title'    => __( 'Secondary Button Font colour', 'redux-framework-demo' ),
                'output'   => array('.btn-secondary, .btn-secondary:hover #sidebar button, #sidebar input[type="submit"], .single-post-tags .badge,.woocommerce a.button.alt, .woocommerce a.button.alt:hover'),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => '1'
                ),
                'mode'     => 'color',
            ),
            array(
                'id'       => 'secondary-btn-border',
                'type'     => 'border',
                'title'    => __( 'Secondary Button Border', 'redux-framework-demo' ),
                'output'   => array( '.btn-secondary, .btn-secondary:hover #sidebar button, #sidebar input[type="submit"],.woocommerce a.button.alt, .woocommerce a.button.alt:hover' ),
                'all'      => false,
                'default'  => array(
                    'border-color'  => '#e4e4e4',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-css',
        'title'  => __( 'CSS', 'redux-framework-demo' ),
        'fields' => array(
            array(
                'id'       => 'css_editor',
                'type'     => 'ace_editor',
                'title'    => __('CSS Code', 'redux-framework-demo'),
                'subtitle' => __('This editor uses CSS. Paste your CSS code here.', 'redux-framework-demo'),
                'default' => '',
                'mode'     => 'scss',
                'theme'    => 'monokai'
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon'   => 'el el-wrench',
        'title'  => __( 'JavaScript', 'redux-framework-demo' ),
        'fields' => array(
            array(
                'id'       => 'js_editor',
                'type'     => 'ace_editor',
                'title'    => __('JS Code', 'redux-framework-demo'),
                'subtitle' => __('This editor uses JS. Paste your JS code here.', 'redux-framework-demo'),
                'mode'     => 'javascript',
                'default' => '',
                'theme'    => 'monokai'
            )
        )
    ) );
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

