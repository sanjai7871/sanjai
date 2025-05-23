<?php


function my_courses_settings_page() {
    add_menu_page(
        'Courses Settings',
        'Courses',
        'manage_options',
        'courses-settings',
        'render_courses_settings_page',
        'dashicons-welcome-learn-more'
    );
}
add_action('admin_menu', 'my_courses_settings_page');

function render_courses_settings_page() {
    ?>
    <div class="wrap">
        <h1>Courses Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('courses_settings');
            do_settings_sections('courses-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}



// user role sub_admin_start

add_role('sub_admin', 'Sub Admin', [
    'read' => true,
    'edit_posts' => true,
    'delete_posts' => false,
]);

add_action('admin_init', function () {
    $role = get_role('sub_admin');
    if ($role) {
        $capabilities_to_remove = [
            'wpforms_view_forms',
            'wpforms_edit_forms',
            'wpforms_create_forms',
            'wpforms_delete_forms',
            'wpforms_view_entries',
            'wpforms_edit_entries',
            'wpforms_delete_entries',
        ];

        foreach ($capabilities_to_remove as $cap) {
            $role->remove_cap($cap);
        }
    }
});
add_action('admin_menu', function () {
    if (current_user_can('sub_admin')) {
        remove_menu_page('wpforms-overview');
    }
});

// end sub_admin


function my_courses_settings_init() {
    register_setting('courses_settings', 'courses_data');

    add_settings_section(
        'courses_settings_section',
        'Add Course Details',
        '',
        'courses-settings'
    );

    for ($i = 1; $i <= 5; $i++) {
        add_settings_field(
            "course_$i",
            "Course $i",
            function () use ($i) {
                $courses_data = get_option('courses_data', []);
                $course = $courses_data["course_$i"] ?? ['title' => '', 'image' => '', 'price' => '', 'link' => ''];

                ?>
                <div style="margin-bottom: 20px;">
                    <label>Title:</label><br>
                    <input type="text" name="courses_data[course_<?php echo $i; ?>][title]" value="<?php echo esc_attr($course['title']); ?>" style="width: 100%;"><br>
                    <label>Image URL:</label><br>
                    <input type="text" name="courses_data[course_<?php echo $i; ?>][image]" value="<?php echo esc_attr($course['image']); ?>" style="width: 100%;"><br>
                    <label>Price:</label><br>
                    <input type="text" name="courses_data[course_<?php echo $i; ?>][price]" value="<?php echo esc_attr($course['price']); ?>" style="width: 100%;"><br>
                    <label>Link:</label><br>
                    <input type="text" name="courses_data[course_<?php echo $i; ?>][link]" value="<?php echo esc_attr($course['link']); ?>" style="width: 100%;"><br>
                </div>
                <?php
            },
            'courses-settings',
            'courses_settings_section'
        );
    }
}
add_action('admin_init', 'my_courses_settings_init');

function extract_modified_part($url) {
    // Parse the URL to get the path
    $parsed_url = parse_url($url);
    $path = $parsed_url['path'];

    // Remove the leading slash
    $path = ltrim($path, '/');

    // Break the path into segments
    $segments = explode('/', $path);

    // Check if the path has at least 4 segments
    if (count($segments) >= 4) {
        // Extract the last three segments (year, month, day)
        $date_part = implode('-', array_slice($segments, -3));
        // Extract the specific part before the date
        $base_part = $segments[count($segments) - 4];
        // Combine the base part and the date part
        return $base_part . '-' . $date_part;
    }

    // Return an empty string if the structure doesn't match
    return '';
}

// Example usage
$current_url = "https://vajiramandravi.com/current-affairs/upsc-prelims-current-affairs/2025/01/04/";
$modified_part = extract_modified_part($current_url);

add_filter( 'rank_math/opengraph/facebook/image', function( $attachment_url ) {
    // Example: Use a different image for date archive pages
    if ( is_date() ) {
		$current_url = $_SERVER['REQUEST_URI'];
    // Parse the permalink to get the path
    $parsed_url = parse_url($current_url);
    $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';

    // Remove the leading and trailing slashes
    $path = trim($path, '/');

    // Find the part after "current-affairs/"
    $needed_part = '';
    if (strpos($path, 'current-affairs/') !== false) {
        $needed_part = substr($path, strpos($path, 'current-affairs/') + strlen('current-affairs/'));

        // Replace slashes with dashes
        $needed_part = str_replace('/', '-', $needed_part);
    }
$segments = explode('/', trim($current_url, '/'));

        // Extract the dynamic category
        $specific_category = isset($segments[1]) ? sanitize_text_field($segments[1]) : '';

        // Extract year, month, and day from the URL
        $year = isset($segments[2]) ? intval($segments[2]) : null;
        $month = isset($segments[3]) ? intval($segments[3]) : null;
        $day = isset($segments[4]) ? intval($segments[4]) : null;
		
		// Ensure month and day have leading zeros
$month = $month ? str_pad($month, 2, '0', STR_PAD_LEFT) : null;
$day = $day ? str_pad($day, 2, '0', STR_PAD_LEFT) : null;
        $custom_image_url = "https://vajiramandravi.com/current-affairs/wp-content/uploads/$year/$month/$needed_part.webp";
        return $custom_image_url;
    }

    // Fallback to the original image
    return $attachment_url;
});

add_filter( 'rank_math/frontend/canonical', function( $canonical ) {
    // Check if the current page is a date archive
    if ( is_date() ) {
        // Get the current URL path
        $current_url = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($current_url, '/'));

        // Extract the dynamic category
        $specific_category = isset($segments[1]) ? sanitize_text_field($segments[1]) : '';

        // Extract year, month, and day from the URL
        $year = isset($segments[2]) ? intval($segments[2]) : null;
        $month = isset($segments[3]) ? intval($segments[3]) : null;
        $day = isset($segments[4]) ? intval($segments[4]) : null;
		
		// Ensure month and day have leading zeros
$month = $month ? str_pad($month, 2, '0', STR_PAD_LEFT) : null;
$day = $day ? str_pad($day, 2, '0', STR_PAD_LEFT) : null;

        // Build the dynamic og:url
        if ($year && $month && $day) {
            $custom_canonical_url = home_url("$specific_category/$year/$month/$day/");
        } elseif ($year && $month) {
            $custom_canonical_url = home_url("$specific_category/$year/$month/");
        } elseif ($year) {
            $custom_canonical_url = home_url("$specific_category/$year/");
        }
        return $custom_canonical_url;
    }

    // Return the default canonical URL for other pages
    return $canonical;
});


add_filter('rank_math/opengraph/url', function ($url) {
    if (is_date()) {
        // Get the current URL path
        $current_url = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($current_url, '/'));

        // Extract the dynamic category
        $specific_category = isset($segments[1]) ? sanitize_text_field($segments[1]) : '';

        // Extract year, month, and day from the URL
        $year = isset($segments[2]) ? intval($segments[2]) : null;
        $month = isset($segments[3]) ? intval($segments[3]) : null;
        $day = isset($segments[4]) ? intval($segments[4]) : null;
		
		// Ensure month and day have leading zeros
$month = $month ? str_pad($month, 2, '0', STR_PAD_LEFT) : null;
$day = $day ? str_pad($day, 2, '0', STR_PAD_LEFT) : null;

        // Build the dynamic og:url
        if ($year && $month && $day) {
            $url = home_url("$specific_category/$year/$month/$day/");
        } elseif ($year && $month) {
            $url = home_url("$specific_category/$year/$month/");
        } elseif ($year) {
            $url = home_url("$specific_category/$year/");
        }
    }

    return $url;
});

add_filter('rank_math/frontend/title', function ($title) {
    // Check if we're on the date.php template
    if (is_date()) {
        // Get the current URL path
        $current_url = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($current_url, '/'));

        // Extract the dynamic category
        $specific_category = isset($segments[1]) ? sanitize_text_field($segments[1]) : '';
		
        if ($specific_category) {
            $term = get_term_by('slug', $specific_category, 'category');
            if ($term) {
                $specific_category = $term->name;
            }
        }

        // Extract year, month, and day from the URL
        $year = isset($segments[2]) ? intval($segments[2]) : null;
        $month = isset($segments[3]) ? intval($segments[3]) : null;
        $day = isset($segments[4]) ? intval($segments[4]) : null;

        // Format the date for the title
        if ($year && $month && $day) {
            $formatted_date = date('j F Y', strtotime("$year-$month-$day"));
            $title = ucfirst($specific_category) . " for $formatted_date";
        } elseif ($year && $month) {
            $formatted_date = date('F Y', strtotime("$year-$month"));
            $title = ucfirst($specific_category) . " for $formatted_date";
        } elseif ($year) {
            $title = ucfirst($specific_category) . " for $year";
        }
    }

    return $title;
});

add_filter('rank_math/frontend/description', function ($description) {
    // Check if we're on the date.php template
    if (is_date()) {
        // Get the current URL path
        $current_url = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($current_url, '/'));

        // Extract the dynamic category
        $specific_category = isset($segments[1]) ? sanitize_text_field($segments[1]) : '';
		
		if ($specific_category) {
            $term = get_term_by('slug', $specific_category, 'category');
            if ($term) {
                $specific_category = $term->name;
            }
        }

        // Extract year, month, and day from the URL
        $year = isset($segments[2]) ? intval($segments[2]) : null;
        $month = isset($segments[3]) ? intval($segments[3]) : null;
        $day = isset($segments[4]) ? intval($segments[4]) : null;

        // Format the date for the description
        if ($year && $month && $day) {
            $formatted_date = date('j F Y', strtotime("$year-$month-$day"));
            $description = "Vajiram & Ravi provides Daily $specific_category for $formatted_date, tailored for aspirants. We cover all relevant news and events crucial for the exam, ensuring you stay updated & well-prepared.";
        } elseif ($year && $month) {
            $formatted_date = date('F Y', strtotime("$year-$month"));
            $description = "Vajiram & Ravi provides Daily $specific_category for $formatted_date, tailored for aspirants. We cover all relevant news and events crucial for the exam, ensuring you stay updated & well-prepared.";
        } elseif ($year) {
            $description = "Vajiram & Ravi provides Daily $specific_category for $formatted_date, tailored for aspirants. We cover all relevant news and events crucial for the exam, ensuring you stay updated & well-prepared.";
        } else {
            $description = "Browse the latest articles and updates in $specific_category.";
        }
    }

    return $description;
});


// Modify date archive URLs to include the category base
function custom_date_archive_permalink($rules) {
    // Target specific categories for the URL structure change
    $target_categories = array('upsc-prelims-current-affairs', 'upsc-mains-current-affairs'); // Replace with your desired category slugs

    // For each targeted category, add a custom rewrite rule
    foreach ($target_categories as $category_slug) {
        $new_rules = array(
            "($category_slug)/([0-9]{4})/([0-9]{2})/?$" => 'index.php?category_name=' . $category_slug . '&year=$matches[1]&monthnum=$matches[2]',
            "($category_slug)/([0-9]{4})/([0-9]{2})/([0-9]{2})/?$" => 'index.php?category_name=' . $category_slug . '&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]'
        );
        // Merge the new rules with the existing ones
        $rules = $new_rules + $rules;
    }
    return $rules;
}
add_filter('rewrite_rules_array', 'custom_date_archive_permalink');

// Register the setting and add it to the General Settings page
function myplugin_register_settings() {
    add_option('enable_content_after_last_paragraph', '1'); // Default value: enabled
    register_setting('general', 'enable_content_after_last_paragraph');
    add_settings_field(
        'enable_content_after_last_paragraph',
        'Enable CUPSC Update',
        'myplugin_enable_content_after_last_paragraph_field',
        'general'
    );
}
add_action('admin_init', 'myplugin_register_settings');

// Create the input field for the setting
function myplugin_enable_content_after_last_paragraph_field() {
    $value = get_option('enable_content_after_last_paragraph', '1');
    echo '<input type="checkbox" id="enable_content_after_last_paragraph" name="enable_content_after_last_paragraph" value="1" ' . checked(1, $value, false) . ' />';
    echo '<label for="enable_content_after_last_paragraph"> Enable UPSC Update.</label>';
}

function custom_upsc_settings_fields() {
    // Add a setting field for the UPSC Heading
    add_settings_field(
        'upsc_heading', // The setting field ID
        'UPSC Heading', // The title of the field
        'custom_heading_callback', // The callback function to display the field
        'general', // The settings page to display the field (General Settings page)
        'default' // The section in which the field should be displayed
    );

    // Add a setting field for the UPSC Date
    add_settings_field(
        'upsc_date', // The setting field ID
        'UPSC Date', // The title of the field
        'custom_date_callback', // The callback function to display the field
        'general', // The settings page to display the field (General Settings page)
        'default' // The section in which the field should be displayed
    );

    // Register the settings for 'upsc_heading' and 'upsc_date' fields
    register_setting('general', 'upsc_heading');
    register_setting('general', 'upsc_date');
}

// Callback for displaying the UPSC Heading field
function custom_heading_callback() {
    $upsc_heading = get_option('upsc_heading'); // Get the value of the field from the database
    echo '<input type="text" id="upsc_heading" name="upsc_heading" value="' . esc_attr($upsc_heading) . '" class="regular-text" />';
}

// Callback for displaying the UPSC Date field
function custom_date_callback() {
    $upsc_date = get_option('upsc_date'); // Get the value of the field from the database
    echo '<input type="text" id="upsc_date" name="upsc_date" value="' . esc_attr($upsc_date) . '" class="regular-text" />';
}

// Hook into the admin menu to add the settings
add_action('admin_init', 'custom_upsc_settings_fields');

function custom_message_with_editor_settings_init() {
    // Register a new setting for the "general" page
    register_setting('general', 'custom_message_editor', [
        'type' => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default' => '',
    ]);

    // Add a new section to the "general" page
    add_settings_field(
        'custom_message_editor_field', // ID
        __('UPSC Updates', 'textdomain'), // Title
        'custom_message_editor_field_html', // Callback to display the field
        'general', // Page to add the section to
        'default' // Section ID
    );
}
add_action('admin_init', 'custom_message_with_editor_settings_init');

// Callback to display the TinyMCE editor
function custom_message_editor_field_html() {
    $content = get_option('custom_message_editor');
    wp_editor(
        $content, 
        'custom_message_editor', 
        [
            'textarea_name' => 'custom_message_editor',
            'textarea_rows' => 10,
            'media_buttons' => true, // Set to true if you want media upload button
        ]
    );
}

function enqueue_fontawesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');

add_filter('post_thumbnail_html', function($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if ( !has_post_thumbnail($post_id) ) {
        $default_image = 'https://vajiramandravi.com/upsc-exam/wp-content/uploads/2024/12/Copy-of-UPSC-2025.png';
        $html = '<img src="' . esc_url($default_image) . '" alt="Default Image">';
    }
    return $html;
}, 10, 5);

function custom_general_settings_fields() {
add_settings_section(
'custom_general_section',
'Center Popup Settings',
'custom_general_section_callback',
'general' );

add_settings_field(
'mobile_image_url',
'Mobile Image Url',
'custom_title_callback',
'general',
'custom_general_section'
);

add_settings_field(
'laptop_image_url',
'Laptop Image Url',
'custom_description_callback',
'general',
'custom_general_section'
);

add_settings_field(
'destination_url',
'Destination Url',
'custom_destination_callback',
'general',
'custom_general_section'
);
register_setting('general', 'mobile_image_url');
register_setting('general', 'laptop_image_url');
register_setting('general', 'destination_url');}
function custom_general_section_callback() {
echo '<p>Enter your center popup settings below:</p>';}
function custom_title_callback() {
$custom_title = get_option('mobile_image_url');
echo '<input type="text" name="mobile_image_url" value="' . esc_attr($custom_title) . '" />';}
function custom_description_callback() {
$custom_description = get_option('laptop_image_url');
echo '<input type="text" name="laptop_image_url" value="' . esc_attr($custom_description) . '" />';}
function custom_destination_callback() {
$custom_description = get_option('destination_url');
echo '<input type="text" name="destination_url" value="' . esc_attr($custom_description) . '" />';}
add_action('admin_init', 'custom_general_settings_fields');

function custom_banner_settings_fields() {
add_settings_section(
'custom_banner_section',
'Bottom Popup Settings',
'custom_banner_section_callback',
'general'
);

add_settings_field(
'banner_mobile_image_url',
'Mobile Image URL',
'custom_banner_mobile_image_callback',
'general',
'custom_banner_section'
);

add_settings_field(
'banner_laptop_image_url',
'Laptop Image URL',
'custom_banner_laptop_image_callback',
'general',
'custom_banner_section'
);

add_settings_field(
'banner_destination_url',
'Destination URL',
'custom_banner_destination_callback',
'general',
'custom_banner_section'
);

register_setting('general', 'banner_mobile_image_url');
register_setting('general', 'banner_laptop_image_url');
register_setting('general', 'banner_destination_url');}
function custom_banner_section_callback() {
echo '<p>Enter your bottom popup settings below:</p>';}
function custom_banner_mobile_image_callback() {
$mobile_image_url = get_option('banner_mobile_image_url');
echo '<input type="text" name="banner_mobile_image_url" value="' . esc_attr($mobile_image_url) . '" />';}
function custom_banner_laptop_image_callback() {
$laptop_image_url = get_option('banner_laptop_image_url');
echo '<input type="text" name="banner_laptop_image_url" value="' . esc_attr($laptop_image_url) . '" />';}
function custom_banner_destination_callback() {
$destination_url = get_option('banner_destination_url');
echo '<input type="text" name="banner_destination_url" value="' . esc_attr($destination_url) . '" />';}
add_action('admin_init', 'custom_banner_settings_fields');

function wrap_fasc_button_with_center($content) {
$pattern = '/<a class="fasc-button(.*?)<\/a>/i';
$replacement = '<center><a class="fasc-button$1</a></center>';
$content = preg_replace($pattern, $replacement, $content);
return $content;}
add_filter('the_content', 'wrap_fasc_button_with_center');

add_post_type_support( 'page', 'excerpt' );

function remove_inline_css_from_content($content) {
$content = preg_replace('/ style=("|\')(.*?)("|\')/i', '', $content);
return $content;}
add_filter('the_content', 'remove_inline_css_from_content');

function add_class_to_first_colspan_td($content) {
    // Use a callback to add the class only to the first colspan in each table
    $content = preg_replace_callback('/<table.*?>(.*?)<\/table>/is', function ($matches) {
        // Modify only the first colspan in the captured table
        $table_content = $matches[1];
        $pattern = '/<td\s+(colspan="\d+")/i';
        $replacement = '<td class="tb-color" $1';
        // Replace only the first match
        $table_content = preg_replace($pattern, $replacement, $table_content, 1);
        return "<table>{$table_content}</table>";
    }, $content);
    
    return $content;
}
add_filter('the_content', 'add_class_to_first_colspan_td');

if ( ! function_exists( 'custom_generate_add_footer_info' ) ) {
function remove_default_generate_footer_info() {
remove_action( 'generate_credits', 'generate_add_footer_info' ); }
add_action( 'wp', 'remove_default_generate_footer_info' );
add_action( 'generate_credits', 'custom_generate_add_footer_info' );
function custom_generate_add_footer_info() {
$copyright = sprintf(
'<span class="copyright">&copy; %1$s %2$s</span> &bull; All rights reserved.',
date( 'Y' ), 
'Vajiram & Ravi',
esc_url( 'https://generatepress.com' ),
_x( 'Developed by', 'Generatepress.com', 'generatepress' ),
__( 'Generatepress.com', 'generatepress' ),
'microdata' === generate_get_schema_type() ? ' itemprop="url"' : '' );
echo apply_filters( 'generate_copyright', $copyright ); } }

add_filter('rank_math/researches/tests', function ($tests, $type) {
unset(
$tests['hasContentAI'],
$tests['contentHasTOC'],
$tests['titleSentiment'],
$tests['titleHasPowerWords'],
$tests['linksHasExternals'],
$tests['lengthContent'],
$tests['linksNotAllExternals'],
$tests['contentHasAssets']
);
return $tests;
}, 10, 2);


function hide_built_with_text() { ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get all popup elements
    const formPopup = document.getElementById('form-popup');
    const popupOverlay = document.getElementById('popup-overlay');
    const imagePopup = document.getElementById('image-popup');
    const bannerPopup = document.getElementById('banner-popup');
    const formClosePopup = document.getElementById('form-popup-close');
    const imageClosePopup = document.getElementById('close-popup');
    const bannerClosePopup = document.getElementById('banner-close-popup');
    const enquireNow = document.getElementById('enquire-now');

    // Track scroll state and banner closed state
    let hasScrolledPastHero = false;
    let bannerClosedThisSession = false;

    // Cookie functions
    function setCookie(name, value, hours) {
        let expires = "";
        if (hours) {
            let date = new Date();
            date.setTime(date.getTime() + hours * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + "; path=/" + expires;
    }

    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Hide all popups
    function hideAllPopups() {
        if (formPopup) formPopup.style.display = 'none';
        if (imagePopup) imagePopup.style.display = 'none';
        if (bannerPopup) bannerPopup.style.display = 'none';
        if (popupOverlay) popupOverlay.style.display = 'none';
    }

    // Show form popup
    function showFormPopup() {
        if (formPopup && !getCookie('formSubmitted') && !getCookie('formClosed')) {
            hideAllPopups();
            popupOverlay.style.display = 'block';
            formPopup.style.display = 'block';
            return true;
        }
        return false;
    }

    // Show image popup
    function showImagePopup() {
        if (imagePopup && !getCookie('imageClosed')) {
            hideAllPopups();
            popupOverlay.style.display = 'block';
            imagePopup.style.display = 'block';
            return true;
        }
        return false;
    }

    // Show banner popup
    function showBannerPopup() {
        if (bannerPopup && hasScrolledPastHero && !bannerClosedThisSession) {
            hideAllPopups();
            bannerPopup.style.display = 'block';
            return true;
        }
        return false;
    }

    // Check scroll position
    function checkScroll() {
        const scrollPosition = window.scrollY;
        const heroSection = document.querySelector('.hero-section, header, .header, .banner');
        let heroHeight = heroSection ? heroSection.offsetHeight : window.innerHeight * 0.3;
        
        if (scrollPosition > heroHeight) {
            hasScrolledPastHero = true;
            checkPopupSequence();
        }
    }

    // Check which popup to show based on sequence
    function checkPopupSequence() {
        // Only check if we're not already showing a popup
        if (formPopup && formPopup.style.display === 'block') return;
        if (imagePopup && imagePopup.style.display === 'block') return;
        if (bannerPopup && bannerPopup.style.display === 'block') return;
        
        // Try to show popups in order: form > image > banner
        if (!showFormPopup()) {
            if (!showImagePopup()) {
                if (hasScrolledPastHero) {
                    showBannerPopup();
                }
            }
        }
    }

    // Add link click handlers for all popups
    function setupLinkHandlers(popupElement, cookieName, cookieValue, cookieHours) {
        if (!popupElement) return;
        
        const links = popupElement.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    hideAllPopups();
                    if (cookieName) {
                        setCookie(cookieName, cookieValue, cookieHours);
                    }
                    if (popupElement === bannerPopup) {
                        bannerClosedThisSession = true;
                    }
                }, 100);
            });
        });
    }

    // Setup event listeners
    if (formClosePopup) {
        formClosePopup.addEventListener('click', function() {
            hideAllPopups();
            setCookie('formClosed', 'true', 4);
            setTimeout(function() {
                if (!showImagePopup() && hasScrolledPastHero) {
                    showBannerPopup();
                }
            }, 4000);
        });
    }

    if (imageClosePopup) {
        imageClosePopup.addEventListener('click', function() {
            hideAllPopups();
            setCookie('imageClosed', 'true', 4);
            if (hasScrolledPastHero) {
                showBannerPopup();
            }
        });
    }

    if (bannerClosePopup) {
        bannerClosePopup.addEventListener('click', function() {
            hideAllPopups();
            bannerClosedThisSession = true;
        });
    }

    if (enquireNow) {
        enquireNow.addEventListener('click', function() {
            hideAllPopups();
            popupOverlay.style.display = 'block';
            formPopup.style.display = 'block';
        });
    }

    // Setup link handlers
    setupLinkHandlers(formPopup, 'formClosed', 'true', 4);
    setupLinkHandlers(imagePopup, 'imageClosed', 'true', 4);
    setupLinkHandlers(bannerPopup);

    // Handle form submission
    const observer = new MutationObserver(function() {
        const thankNow = document.getElementById('thankubtn');
        if (thankNow) {
            thankNow.addEventListener('click', function() {
                hideAllPopups();
                setCookie('formSubmitted', 'true', 24);
                if (!showImagePopup() && hasScrolledPastHero) {
                    showBannerPopup();
                }
            });
            observer.disconnect();
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Set page path in hidden field
    const pagePathField = document.querySelector('input[name="wpforms[fields][14]"]');
    if (pagePathField) {
        pagePathField.value = window.location.pathname;
    }

    // Initialize
    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Check initial scroll position
    
    // Initial popup sequence
      setTimeout(function() {
    showFormPopup();
	}, 15000);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
const pagePathField = document.querySelector('input[name="wpforms[fields][14]"]');
if (pagePathField) {
pagePathField.value = window.location.pathname;
} });
</script>
<script>
document.addEventListener("copy", function(e) {
var selectedText = window.getSelection().toString().trim();
var pageLink = window.location.href;
var copiedText = selectedText + "... Read more at: " + pageLink;
e.clipboardData.setData("text/plain", copiedText);
e.preventDefault(); });
</script>
<?php } add_action('wp_footer', 'hide_built_with_text');

function related_posts_by_category_shortcode() {
    if (is_single()) {
        global $post;
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }

            $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 5,
                'ignore_sticky_posts' => 1
            );

            $related_posts = new WP_Query($args);

            $output = '';
            if ($related_posts->have_posts()) {
                $output .= '<div class="widget related-posts-widget">';
                $output .= '<p>Related Posts</p>';
                $output .= '<ul class="related-posts-list">';
                while ($related_posts->have_posts()) {
                    $related_posts->the_post();
                    $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                $output .= '</ul>';
                $output .= '</div>';
                wp_reset_postdata();
            }

            return $output;
        }
    }
}
add_shortcode('related_posts', 'related_posts_by_category_shortcode');

function add_target_blank_to_links($content) {
$pattern = '/<a(.*?)href="(.*?)"(.*?)>/i';
$replacement = '<a$1href="$2"$3 target="_blank">';
$content = preg_replace($pattern, $replacement, $content);
return $content;}
add_filter('the_content', 'add_target_blank_to_links');
add_filter('the_excerpt', 'add_target_blank_to_links');

function custom_breadcrumbs() {
    if (is_single()) {
        // Retrieve custom field values
        $cat_name = get_field('cat_name');
        $cat_link = get_field('cat_link');
        
        // Retrieve additional fields
        $cato_name = get_field('cato_name');
        $cato_link = get_field('cato_link');
        $post_name = get_field('post_name') ? get_field('post_name') : get_the_title();
        
        // Initialize breadcrumbs array
        $breadcrumbs = [
            [
                'name' => 'Home',
                'link' => home_url('/')
            ]
        ];
        
        // Add category breadcrumb only if name and link are not empty
        if (!empty($cat_name) && !empty($cat_link)) {
            $breadcrumbs[] = [
                'name' => $cat_name,
                'link' => $cat_link
            ];
        }
        
        // Add additional category if present
        if (!empty($cato_name) && !empty($cato_link)) {
            $breadcrumbs[] = [
                'name' => $cato_name,
                'link' => $cato_link
            ];
        }
        
        // Add the post title
        $breadcrumbs[] = [
            'name' => $post_name,
            'link' => ''
        ];
        
        // Generate JSON-LD schema
        $schema = '<script type="application/ld+json">';
        $schema .= '{"@context": "http://schema.org","@type": "BreadcrumbList","itemListElement": [';
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $schema .= '{"@type": "ListItem","position": ' . ($index + 1) . ',"name": "' . $breadcrumb['name'] . '","item": "' . $breadcrumb['link'] . '"},';
        }
        $schema = rtrim($schema, ',');
        $schema .= ']}';
        $schema .= '</script>';
        
        // Generate HTML breadcrumbs
        $breadcrumb_html = '<p class="breadcrumbs">';
        foreach ($breadcrumbs as $index => $breadcrumb) {
            if ($breadcrumb['link']) {
                $breadcrumb_html .= '<a href="' . $breadcrumb['link'] . '">' . $breadcrumb['name'] . '</a>';
            } else {
                $breadcrumb_html .= $breadcrumb['name'];
            }
            if ($index < count($breadcrumbs) - 1) {
                $breadcrumb_html .= ' > ';
            }
        }
        $breadcrumb_html .= '</p>';
        
        // Output breadcrumbs and schema
        echo $breadcrumb_html . $schema;
    }
}

function add_breadcrumbs_before_title() {
if (is_single()) {
if ( function_exists( 'custom_breadcrumbs' ) ) {
custom_breadcrumbs();
}}}
add_action( 'generate_before_entry_title', 'add_breadcrumbs_before_title' );

function rss_post_thumbnail($content) {
global $post;
if(has_post_thumbnail($post->ID)) {
$content = '<p>' . get_the_post_thumbnail($post->ID) .
'</p>' . get_the_content();}
return $content;}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');
add_filter('wp_sitemaps_enabled', '__return_false');

function set_site_locale_to_hindi() {
return 'en_IN';}
add_filter('locale', 'set_site_locale_to_hindi');

function remove_default_wp_head() {
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'print_emoji_detection_script', 7);}
add_action('init', 'remove_default_wp_head');

add_filter( 'rank_math/frontend/remove_credit_notice', '__return_true', 999 );
add_filter( 'rank_math/frontend/show_keywords', '__return_true');
function add_spaces_to_meta_keywords($keywords) {
$keywords = preg_replace('/,\s+/', ', ', $keywords);
return $keywords;}
add_filter('rank_math/frontend/keywords', 'add_spaces_to_meta_keywords');
// function add_custom_comment_before_rank_math_head() {
// echo "\n<!-- SEO Optimized by Rahul Mourya - https://rahulmourya.com -->\n";}
// add_action('rank_math/head', 'add_custom_comment_before_rank_math_head', 1);
function add_custom_comment_after_rank_math_head() {
echo '<meta name="google-site-verification" content="JdUDmNS177zwie6Zy8YZe13JmEX04o3CS2YRajWonuE" /><script>if(navigator.userAgent.match(/MSIE|Internet Explorer/i)||navigator.userAgent.match(/Trident\/7\..*?rv:11/i)){var e=document.location.href;e.match(/[?&]nowprocket/)||(-1===e.indexOf("?")?-1===e.indexOf("#")?document.location.href=e+"?nowprocket=1":document.location.href=e.replace("#","?nowprocket=1#"):-1===e.indexOf("#")?document.location.href=e+"&nowprocket=1":document.location.href=e.replace("#","&nowprocket=1#"))}class RocketLazyLoadScripts{constructor(){this.triggerEvents=["keydown","mousedown","mousemove","touchmove","touchstart","touchend","wheel"],this.userEventHandler=this._triggerListener.bind(this),this.touchStartHandler=this._onTouchStart.bind(this),this.touchMoveHandler=this._onTouchMove.bind(this),this.touchEndHandler=this._onTouchEnd.bind(this),this.clickHandler=this._onClick.bind(this),this.interceptedClicks=[],window.addEventListener("pageshow",e=>{this.persisted=e.persisted}),window.addEventListener("DOMContentLoaded",()=>{this._preconnect3rdParties()}),this.delayedScripts={normal:[],async:[],defer:[]},this.trash=[],this.allJQueries=[]}_addUserInteractionListener(e){if(document.hidden){e._triggerListener();return}this.triggerEvents.forEach(t=>window.addEventListener(t,e.userEventHandler,{passive:!0})),window.addEventListener("touchstart",e.touchStartHandler,{passive:!0}),window.addEventListener("mousedown",e.touchStartHandler),document.addEventListener("visibilitychange",e.userEventHandler)}_removeUserInteractionListener(){this.triggerEvents.forEach(e=>window.removeEventListener(e,this.userEventHandler,{passive:!0})),document.removeEventListener("visibilitychange",this.userEventHandler)}_onTouchStart(e){"HTML"!==e.target.tagName&&(window.addEventListener("touchend",this.touchEndHandler),window.addEventListener("mouseup",this.touchEndHandler),window.addEventListener("touchmove",this.touchMoveHandler,{passive:!0}),window.addEventListener("mousemove",this.touchMoveHandler),e.target.addEventListener("click",this.clickHandler),this._renameDOMAttribute(e.target,"onclick","rocket-onclick"),this._pendingClickStarted())}_onTouchMove(e){window.removeEventListener("touchend",this.touchEndHandler),window.removeEventListener("mouseup",this.touchEndHandler),window.removeEventListener("touchmove",this.touchMoveHandler,{passive:!0}),window.removeEventListener("mousemove",this.touchMoveHandler),e.target.removeEventListener("click",this.clickHandler),this._renameDOMAttribute(e.target,"rocket-onclick","onclick"),this._pendingClickFinished()}_onTouchEnd(e){window.removeEventListener("touchend",this.touchEndHandler),window.removeEventListener("mouseup",this.touchEndHandler),window.removeEventListener("touchmove",this.touchMoveHandler,{passive:!0}),window.removeEventListener("mousemove",this.touchMoveHandler)}_onClick(e){e.target.removeEventListener("click",this.clickHandler),this._renameDOMAttribute(e.target,"rocket-onclick","onclick"),this.interceptedClicks.push(e),e.preventDefault(),e.stopPropagation(),e.stopImmediatePropagation(),this._pendingClickFinished()}_replayClicks(){window.removeEventListener("touchstart",this.touchStartHandler,{passive:!0}),window.removeEventListener("mousedown",this.touchStartHandler),this.interceptedClicks.forEach(e=>{e.target.dispatchEvent(new MouseEvent("click",{view:e.view,bubbles:!0,cancelable:!0}))})}async _waitForPendingClicks(){return new Promise(e=>{this._isClickPending?this._pendingClickFinished=e:e()})}_pendingClickStarted(){this._isClickPending=!0}_pendingClickFinished(){this._isClickPending=!1}_renameDOMAttribute(e,t,i){e.hasAttribute&&e.hasAttribute(t)&&(e.setAttribute(i,e.getAttribute(t)),e.removeAttribute(t))}_triggerListener(){this._removeUserInteractionListener(),"loading"===document.readyState?document.addEventListener("DOMContentLoaded",this._loadEverythingNow.bind(this)):this._loadEverythingNow()}_preconnect3rdParties(){let e=[];document.querySelectorAll("script[type=rocketlazyloadscript]").forEach(t=>{if(t.hasAttribute("src")){let i=new URL(t.src).origin;i!==location.origin&&e.push({src:i,crossOrigin:t.crossOrigin||("module"===t.getAttribute("data-rocket-type")?"module":void 0)})}}),e=[...new Map(e.map(e=>[JSON.stringify(e),e])).values()],this._batchInjectResourceHints(e,"preconnect")}async _loadEverythingNow(){this.lastBreath=Date.now(),this._delayEventListeners(this),this._delayJQueryReady(this),this._handleDocumentWrite(),this._registerAllDelayedScripts(),this._preloadAllScripts();try{await this._loadScriptsFromList(this.delayedScripts.normal),await this._loadScriptsFromList(this.delayedScripts.defer),await this._loadScriptsFromList(this.delayedScripts.async),await this._triggerDOMContentLoaded(),await this._triggerWindowLoad()}catch(e){console.error(e)}window.dispatchEvent(new Event("rocket-allScriptsLoaded")),await this._waitForPendingClicks(),this._replayClicks(),this._emptyTrash()}_registerAllDelayedScripts(){document.querySelectorAll("script[type=rocketlazyloadscript]").forEach(e=>{e.hasAttribute("data-rocket-src")?e.hasAttribute("async")&&!1!==e.async?this.delayedScripts.async.push(e):e.hasAttribute("defer")&&!1!==e.defer?this.delayedScripts.defer.push(e):this.delayedScripts.normal.push(e):this.delayedScripts.normal.push(e)})}async _transformScript(e){return await this._littleBreath(),new Promise(t=>{function i(){e.setAttribute("data-rocket-status","executed"),t()}function r(){e.setAttribute("data-rocket-status","failed"),t()}try{let n=e.getAttribute("data-rocket-type"),s=e.getAttribute("data-rocket-src");if(n?(e.type=n,e.removeAttribute("data-rocket-type")):e.removeAttribute("type"),e.addEventListener("load",i),e.addEventListener("error",r),s)e.src=s,e.removeAttribute("data-rocket-src");else if(navigator.userAgent.indexOf("Firefox/")>0){let a=document.createElement("script");[...e.attributes].forEach(e=>{"type"!==e.nodeName&&a.setAttribute("data-rocket-type"===e.nodeName?"type":e.nodeName,e.nodeValue)}),a.text=e.text,e.parentNode.replaceChild(a,e),i()}else e.src="data:text/javascript;base64,"+btoa(e.text)}catch(o){r()}})}async _loadScriptsFromList(e){let t=e.shift();t&&(await this._transformScript(t),await this._loadScriptsFromList(e))}_preloadAllScripts(){this._batchInjectResourceHints([...this.delayedScripts.normal,...this.delayedScripts.defer,...this.delayedScripts.async],"preload")}_batchInjectResourceHints(e,t){let i=document.createDocumentFragment();e.forEach(e=>{let r=e.getAttribute&&e.getAttribute("data-rocket-src")||e.src;if(r){let n=document.createElement("link");n.href=r,n.rel=t,"preconnect"!==t&&(n.as="script"),e.getAttribute&&"module"===e.getAttribute("data-rocket-type")&&(n.crossOrigin=!0),e.crossOrigin&&(n.crossOrigin=e.crossOrigin),e.integrity&&(n.integrity=e.integrity),i.appendChild(n),this.trash.push(n)}}),document.head.appendChild(i)}_delayEventListeners(e){let t={};function i(e,i){t[e]||(t[e]={originalFunctions:{add:i.addEventListener,remove:i.removeEventListener},eventsToRewrite:[]},i.addEventListener=function(){arguments[0]=r(arguments[0]),t[e].originalFunctions.add.apply(this,arguments)},i.removeEventListener=function(){arguments[0]=r(arguments[0]),t[e].originalFunctions.remove.apply(this,arguments)});function r(e){return t[e]&&t[e].eventsToRewrite.indexOf(e)>=0?"rocket-"+e:e}}function r(e,t){let i=e[t];Object.defineProperty(e,t,{get:()=>i||function(){},set(r){e["rocket"+t]=i=r}})}i("DOMContentLoaded",document),i("DOMContentLoaded",window),i("load",window),i("pageshow",window),i("readystatechange",document),r(document,"onreadystatechange"),r(window,"onload"),r(window,"onpageshow")}_delayJQueryReady(e){let t;function i(i){if(i){if(!e.allJQueries.includes(i)){i.fn.ready=i.fn.init.prototype.ready=function(t){return e.domReadyFired?t.bind(document)(i):document.addEventListener("rocket-DOMContentLoaded",()=>t.bind(document)(i))};let r=i.fn.on;i.fn.on=i.fn.init.prototype.on=function(){if(this[0]===window){function e(e){return e.split(" ").map(e=>"load"===e||0===e.indexOf("load.")?"rocket-jquery-load":e).join(" ")}"string"==typeof arguments[0]||arguments[0]instanceof String?arguments[0]=e(arguments[0]):"object"==typeof arguments[0]&&Object.keys(arguments[0]).forEach(t=>{Object.assign(arguments[0],{[e(t)]:arguments[0][t]}),delete arguments[0][t]})}return r.apply(this,arguments)},e.allJQueries.push(i)}t=i}}i(window.jQuery),Object.defineProperty(window,"jQuery",{get:()=>t,set:e=>i(e)})}async _triggerDOMContentLoaded(){this.domReadyFired=!0,await this._littleBreath(),document.dispatchEvent(new Event("rocket-DOMContentLoaded")),await this._littleBreath(),window.dispatchEvent(new Event("rocket-DOMContentLoaded")),await this._littleBreath(),document.dispatchEvent(new Event("rocket-readystatechange")),await this._littleBreath(),document.rocketonreadystatechange&&document.rocketonreadystatechange()}async _triggerWindowLoad(){await this._littleBreath(),window.dispatchEvent(new Event("rocket-load")),await this._littleBreath(),window.rocketonload&&window.rocketonload(),await this._littleBreath(),this.allJQueries.forEach(e=>e(window).trigger("rocket-jquery-load")),await this._littleBreath();let e=new Event("rocket-pageshow");e.persisted=this.persisted,window.dispatchEvent(e),await this._littleBreath(),window.rocketonpageshow&&window.rocketonpageshow({persisted:this.persisted})}_handleDocumentWrite(){let e=new Map;document.write=document.writeln=function(t){let i=document.currentScript;if(!i){console.error("WPRocket unable to document.write this: "+t);return}let r=document.createRange(),n=i.parentElement,s=e.get(i);void 0===s&&(s=i.nextSibling,e.set(i,s));let a=document.createDocumentFragment();r.setStart(a,0),a.appendChild(r.createContextualFragment(t)),n.insertBefore(a,s)}}async _littleBreath(){Date.now()-this.lastBreath>45&&(await this._requestAnimFrame(),this.lastBreath=Date.now())}async _requestAnimFrame(){return document.hidden?new Promise(e=>setTimeout(e)):new Promise(e=>requestAnimationFrame(e))}_emptyTrash(){this.trash.forEach(e=>e.remove())}static run(){let e=new RocketLazyLoadScripts;e._addUserInteractionListener(e)}}RocketLazyLoadScripts.run();</script>';}
add_action('rank_math/head', 'add_custom_comment_after_rank_math_head', 9999);
add_filter( 'generate_schema_type', '__return_false', 999 );
add_filter( 'generate_is_using_hatom', '__return_false', 999 );

function update_focus_keywords() {
$posts = get_posts(
array(
'posts_per_page' => -1,
'post_type'      => 'post', ) );
foreach ( $posts as $p ) {
if (! get_post_meta( $p->ID, 'rank_math_focus_keyword', true ) && function_exists('get_field') && (null !== get_field( 'keywords', $p->ID ) ) ) {
update_post_meta( $p->ID, 'rank_math_focus_keyword', strtolower( get_field( 'keywords', $p->ID ) ) ); } } }
add_action( 'init', 'update_focus_keywords' );

function remove_wp_block_library_css(){
wp_dequeue_style('rank-math');
wp_dequeue_style( 'rank-math-toc-block-style' );
wp_dequeue_style( 'wp-block-library' );
wp_dequeue_style( 'global-styles' );
wp_dequeue_style( 'classic-theme-styles' );}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 999 );

function add_author_schema() {
global $post;
$author_id = $post->post_author;
$author_name = get_the_author_meta('display_name', $author_id);
$author_url = get_author_posts_url($author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_avatar = get_avatar_url($author_id);
$author_twitter = get_user_meta($author_id, 'twitter', true);
$author_facebook = get_user_meta($author_id, 'facebook', true);
$imageUrl = get_the_post_thumbnail_url();
if(empty($imageUrl)){$imageUrl = "http://wordpress.dev.vajiramias.net/wp-content/uploads/2024/07/UPSC_Prelims_Result_2024.webp";}
$imageInfo = getimagesize($imageUrl);
if ($imageInfo !== false) {
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $mime = $imageInfo['mime'];
}
$post_title = get_the_title();
$post_url = get_permalink();
$post_date = get_the_date('c');
$post_modified_date = get_the_modified_date('c');
$post_description = get_the_excerpt();
$keywords = get_field( 'keywords');
?>
<script type="rocketlazyloadscript" async data-rocket-src="https://www.googletagmanager.com/gtag/js?id=G-GH668G11CH"></script>
<script type="rocketlazyloadscript">
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-GH668G11CH');
</script>
<!-- LaraPush Push Notification Integration -->
<script src="https://cdn.larapush.com/scripts/popup-4.0.0.min.js"></script>
<script>
 function LoadLaraPush(){ if (typeof LaraPush === "function") {new LaraPush(JSON.parse(atob('eyJmaXJlYmFzZUNvbmZpZyI6eyJwcm9qZWN0SWQiOiJ2YWppcmFtYW5kcmF2aXdlYnNpdGUiLCJtZXNzYWdpbmdTZW5kZXJJZCI6IjMxNDEyMjcyNDY2MyIsImFwcElkIjoiMTozMTQxMjI3MjQ2NjM6d2ViOjZjMTdhOTIwYWZkODE2NmYxY2U2YjIiLCJhcGlLZXkiOiJBSXphU3lEYzhRMWtOT2swOFpTN0M3ZUhJaTFlWENBWm5KNElxYlkifSwiZG9tYWluIjoidmFqaXJhbWFuZHJhdmkuY29tIiwic2l0ZV91cmwiOiJodHRwczpcL1wvdmFqaXJhbWFuZHJhdmkuY29tXC8iLCJhcGlfdXJsIjoiaHR0cHM6XC9cL3B1c2gudmFqaXJhbWFuZHJhdmkuY29tXC9hcGlcL3Rva2VuIiwic2VydmljZVdvcmtlciI6Imh0dHBzOlwvXC92YWppcmFtYW5kcmF2aS5jb21cL2ZpcmViYXNlLW1lc3NhZ2luZy1zdy5qcyIsInZhcGlkX3B1YmxpY19rZXkiOiJCSlpLSDRVVi1EdER2Z1BpUGtPVnlCMWNkNnpRdGZxNG9uS3VhTll0SHZKc0hGbzlGVmI2YTk4UXJFMFN6V1dFWUptbnJXcUFYV2stVWdMWF9SREZIbzQiLCJyZWZlcnJhbENvZGUiOiJFUFFaQVQifQ==')), JSON.parse(atob('eyJsb2dvIjoiaHR0cHM6XC9cL3ZhamlyYW1hbmRyYXZpLmNvbVwvX25leHRcL3N0YXRpY1wvbWVkaWFcL2JhZGdlX2xvZ28uNWZiN2M3ZjEuc3ZnIiwiaGVhZGluZyI6IlZhamlyYW1hbmRyYXZpIHdhbnQgdG8gbm90aWZ5IHlvdSBhYm91dCB0aGUgbGF0ZXN0IHVwZGF0ZXMiLCJzdWJoZWFkaW5nIjoiWW91IGNhbiB1bnN1YnNjcmliZSBmcm9tIG5vdGlmaWNhdGlvbnMgYW55dGltZS4iLCJ0aGVtZUNvbG9yIjoiI2ZmNTkwMCIsImFsbG93VGV4dCI6IkFsbG93IiwiZGVueVRleHQiOiJEZW55IiwiZGVza3RvcCI6ImVuYWJsZSIsIm1vYmlsZSI6ImVuYWJsZSIsIm1vYmlsZUxvY2F0aW9uIjoidG9wIiwiZGVsYXkiOiIxNSIsInJlYXBwZWFyIjoiMzAiLCJib3R0b21CdXR0b24iOiJkaXNhYmxlIiwiYnV0dG9uVG9VbnN1YnNjcmliZSI6bnVsbCwibG9ja1BhZ2VDb250ZW50IjoiZGlzYWJsZSIsImJhY2tkcm9wIjoiZGlzYWJsZSIsInBvcHVwX3R5cGUiOiJtYW51YWwifQ==')));}}LoadLaraPush();
</script>
<!-- /.LaraPush Push Notification Integration -->
<script type="application/ld+json"> 
{
"@context":"https://schema.org",
"@type": "WebPage",
"inLanguage": "en",
"name": "<?php echo esc_js($post_title); ?>",
"description": "<?php $without_quotes = str_replace(['"', "'"], '', $post_description);
echo nl2br($without_quotes);?>",
"mainEntityOfPage": "<?php echo esc_js($post_url); ?>",
"url": "<?php echo esc_js($post_url); ?>"
}
</script>
<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"Organization",
"name":"vajiramandravi",
"url":"https://vajiramandravi.com/",
"logo": {
"@type":"ImageObject",
"url":"https://vajiramandravi.com/wp-content/uploads/2024/07/TSN-600-60-webp-1.webp",
"width":"601",
"height":"61"
},
"sameAs": [
"https://www.facebook.com/vajiramandravi/",
"https://twitter.com/vajiramandravi",
"https://www.instagram.com/vajiramandravi/"
]
}
</script>
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "WebSite",
"url": "https://vajiramandravi.com/",
"name": "vajiramandravi"
}
</script>
<?php if ( is_single() ) { ?>
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "NewsArticle",
"mainEntityOfPage": {
"@type": "WebPage",
"@id": "<?php echo esc_js($post_url); ?>"
},
"headline": "<?php echo esc_js($post_title); ?>",
"alternativeHeadline": "<?php echo esc_js($post_title); ?>",
"description": "<?php $without_quotes = str_replace(['"', "'"], '', $post_description);
echo nl2br($without_quotes);?>",
"articleBody": "<?php $content_stripped = wp_strip_all_tags(get_the_content(), true);
$content_paragraphs_preserved = preg_replace('/<br\s*\/?>/', "\n", $content_stripped);
$content_without_quotes = str_replace(['"', "'"], '', $content_paragraphs_preserved);
echo nl2br($content_without_quotes); ?>",
"keywords": "<?php echo esc_js($keywords); ?>",
"inLanguage": "en",
"image": {
"@type": "ImageObject",
"url": "<?php echo esc_js($imageUrl); ?>",
"width": "<?php echo esc_js($width); ?>",
"height": "<?php echo esc_js($height); ?>"
},   
"datePublished": "<?php echo esc_js($post_date); ?>",
"dateModified": "<?php echo esc_js($post_modified_date); ?>",
"author": {
"@type": "Person",
"name": "<?php echo esc_js($author_name); ?>",
"url": "<?php echo esc_js($author_url); ?>"
},
"publisher": {
"@type": "NewsMediaOrganization",
"name": "vajiramandravi",
"url": "https://vajiramandravi.com/",
"logo": {
"@type": "ImageObject",
"url": "https://vajiramandravi.com/wp-content/uploads/2024/07/TSN-600-60-webp-1.webp",
"width": "601",
"height": "61"
} 
}
}
</script>
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Person",
"name": "<?php echo esc_js($author_name); ?>",
"url": "<?php echo esc_url($author_url); ?>",
"description": "<?php echo esc_js($author_description); ?>",
"image": "<?php echo esc_url($author_avatar); ?>",
"sameAs": [
"<?php echo esc_url($author_twitter); ?>",
"<?php echo esc_url($author_facebook); ?>"
]
}
</script>
<?php } } add_action('wp_head', 'add_author_schema');

function add_excerpt_meta_and_featured_image_after_title() {
if (is_single()) {
$post_excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
$author_name = get_the_author(); //get_the_author_posts_link
$post_date = get_the_date('M j, Y, H:i T');
$post_meta = sprintf('<div class="post-meta"><p>By %s - %s</p></div>', $author_name, $post_date);
$post_url = urlencode(get_permalink());
$post_title = urlencode(get_the_title());
$icons = '<div class="post-meta-share-icons">' . do_shortcode('[gtranslate]') . '
<a href="#" id="listenButton" class="play-pause-btn">
    <i class="fa fa-play"></i>
	<span id="popupContent">
            Listen
        </span>
</a>
            <div class="share-container">
<button id="shareToggle" class="share-button">Share<svg class="share-icon" width="24" height="24" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
  <!-- Hollow nodes (circles) -->
  <circle cx="128" cy="256" r="60" fill="none" stroke="currentColor" stroke-width="40" />
  <circle cx="448" cy="128" r="60" fill="none" stroke="currentColor" stroke-width="40" />
  <circle cx="448" cy="384" r="60" fill="none" stroke="currentColor" stroke-width="40" />
  
  <!-- Connecting lines -->
  <path d="M188 230L388 152" stroke="currentColor" stroke-width="40" stroke-linecap="round" />
  <path d="M188 282L388 360" stroke="currentColor" stroke-width="40" stroke-linecap="round" />
</svg></button>
<div id="shareDropdown" class="vjrm-dropdown">
    <a href="https://wa.me/?text=' . $post_title . ' ' . $post_url . '" target="_blank" title="Share on WhatsApp" class="WhatsApp"><svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon_ZPmGD shares-list-item_whatsapp !text-custom-whatsapp hover:!text-custom-whatsapp-hover text-white w-full"><rect width="40" height="40" rx="4" fill="currentColor"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M28.503 11.485A11.903 11.903 0 0020.05 8C13.463 8 8.103 13.33 8.1 19.883c0 2.095.55 4.14 1.595 5.94L8 31.984l6.335-1.653a11.986 11.986 0 005.71 1.446h.005c6.586 0 11.948-5.331 11.95-11.883a11.78 11.78 0 00-3.497-8.408zM20.05 29.769h-.004a9.96 9.96 0 01-5.055-1.376l-.363-.215-3.76.981 1.004-3.645-.236-.374a9.812 9.812 0 01-1.518-5.256c.002-5.446 4.458-9.877 9.937-9.877a9.892 9.892 0 017.021 2.897 9.788 9.788 0 012.907 6.988c-.003 5.446-4.458 9.877-9.933 9.877zm5.448-7.397c-.298-.149-1.766-.867-2.04-.966-.274-.1-.473-.149-.672.149-.198.297-.77.966-.945 1.164-.174.198-.348.223-.647.074-.298-.149-1.26-.462-2.401-1.473-.888-.788-1.487-1.76-1.661-2.058-.175-.297-.019-.458.13-.605.134-.134.299-.347.448-.52.15-.174.2-.298.299-.496.1-.198.05-.371-.025-.52-.074-.149-.671-1.61-.92-2.205-.243-.579-.49-.5-.672-.51-.174-.008-.373-.01-.572-.01-.2 0-.523.074-.797.372-.274.297-1.045 1.016-1.045 2.477 0 1.46 1.07 2.873 1.22 3.072.149.198 2.105 3.197 5.1 4.483.712.306 1.269.49 1.702.626.715.226 1.366.195 1.88.118.574-.085 1.767-.718 2.016-1.412.249-.693.249-1.288.174-1.412-.074-.124-.274-.198-.572-.347v-.001z" fill="#fff"></path></svg></a>

      <a href="https://www.facebook.com/sharer.php?u=' . $post_url . '" target="_blank" title="Share on Facebook" class="Facebook"><svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon_ZPmGD shares-list-item_facebook !text-custom-facebook hover:!text-custom-facebook-hover text-white w-full"><rect width="40" height="40" rx="4" fill="currentColor"></rect><path d="M6.667 19.998a13.34 13.34 0 0011.248 13.171v-9.318h-3.382v-3.853h3.386v-2.934a4.704 4.704 0 015.03-5.2c1.002.017 2 .106 2.987.267v3.279h-1.685a1.928 1.928 0 00-2.17 2.084v2.504h3.694l-.59 3.854H22.08v9.317c7.005-1.107 11.918-7.505 11.179-14.56-.74-7.053-6.872-12.294-13.955-11.924-7.083.37-12.637 6.22-12.639 13.313z" fill="#fff"></path></svg></a>

     <a href="https://t.me/share/url?url=' . $post_url . '&text=' . $post_title . '" target="_blank" title="Share on Telegram" class="Telegram"><svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon_ZPmGD shares-list-item_telegram !text-custom-telegram hover:!text-custom-telegram-hover text-white w-full"><rect width="40" height="40" rx="4" fill="currentColor"></rect><path fill-rule="evenodd" clip-rule="evenodd" d="M7.854 19.783c1.93-1.079 4.041-2.014 6.096-2.924.498-.22.992-.439 1.479-.658 4.302-1.84 8.622-3.649 12.985-5.333.849-.287 2.374-.567 2.523.709-.058 1.278-.243 2.552-.429 3.823v.005a94.257 94.257 0 00-.22 1.569c-.497 3.343-1.06 6.677-1.621 10.01l-.004.024-.3 1.785c-.229 1.31-1.848 1.99-2.884 1.15-.61-.419-1.223-.836-1.836-1.254l-.016-.011a363.686 363.686 0 01-5.604-3.875c-.805-.83-.059-2.021.66-2.614.826-.825 1.672-1.6 2.514-2.372l.004-.004c1.249-1.145 2.491-2.284 3.651-3.57.491-1.203-.836-.33-1.426.058l-.028.018-.081.053c-.685.479-1.366.965-2.047 1.45l-.024.018c-2.102 1.5-4.206 3.002-6.435 4.3-1.357.758-2.916.255-4.314-.197-.16-.051-.316-.102-.471-.15a30.132 30.132 0 00-.58-.234l-.004-.001c-1.256-.497-2.596-1.027-1.588-1.775z" fill="#fff"></path></svg></a>
	 
	<a href="https://x.com/intent/tweet?text=' . $post_title . '&url=' . $post_url . '" target="_blank" title="Share on X" class="Twitter"><svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon_ZPmGD shares-list-item_twitter !text-custom-twitter hover:!text-custom-twitter-hover text-white w-full"><rect width="40" height="40" rx="4" fill="currentColor"></rect><path d="M27.318 9h3.68l-8.04 9.319L32.417 31H25.01l-5.801-7.69L12.573 31H8.89l8.6-9.968L8.417 9h7.593l5.244 7.03L27.318 9zm-1.292 19.766h2.04l-13.164-17.65h-2.188l13.312 17.65z" fill="#fff"></path></svg></a>
    <i class="Copy fa fa-copy" id="copyPostUrl" style="cursor: pointer;" title="Copy URL"></i>
<span id="copyMessage" style="display: none; color: #fb5621; margin-left: 10px;">Copied!</span>
</div></div>
<a class="follow-us-btn share-button" href="https://news.google.com/publications/CAAqLggKIihDQklTR0FnTWFoUUtFblpoYW1seVlXMWhibVJ5WVhacExtTnZiU2dBUAE?ceid=IN:en&oc=3"  target="_blank">Follow Us<img class="gnews-logo" src="https://vajiramandravi.com/current-affairs/wp-content/uploads/2025/05/pngwing.com_-scaled.webp" /></a>
        </div>
        <style>
		#popupContent {
            display: none;
            position: absolute;
            padding: 5px 10px;
            background-color: #000;
            border-radius: 5px;
			color:#fff;
			transform: translate(-55%, -150%);
        }
            .post-meta-share-icons {
				display:flex;
                align-items: center;
				flex-wrap: wrap;
				gap: 10px;
                position: relative;
            }
			@media screen and (min-width: 768px) {
    .post-meta-share-icons {
        float: right;
    }
}
.gnews-logo{
  height: 18px;
  width: 18px;
}
			.post-meta-share-icons a {
                margin:2px
            }
			.Facebook{
			color:#1877F2!important;
			}
			.WhatsApp{
			color:#25D366!important;
			}
			.Telegram{
			color:#229ED9!important;
			}
			.Twitter{
			color:#000!important;
			}
			.Copy{
    padding: 5px;
    font-size: 25px;
}
.share-container {
  position: relative;
  display: inline-block;
}
.share-icon{
  color: #fff; /* Changes the color of both circles and lines */
  vertical-align: middle;
  width: 16px;
}
			#listenButton{
        border-radius: 50%; /* Makes the button round */
		font-size:14px;
		width: 33px;
    height: 33px;
    display: inline-block;
    text-align: center;
	border: 2px solid #fb5621;
	color:#fb5621;
                padding: 5px 8px;
    }
    .vjrm-dropdown {
 	position: absolute;
  top: 100%; /* Position below the button */
  left: 0;
  margin-top: 8px;
  background-color: white;
  border: 1px solid #ccc;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  padding: 10px;
  z-index: 1000;
  border-radius: 4px;
  display: none;
  flex-direction: column;
}
.share-container:hover .vjrm-dropdown {
  display: flex;
}
#shareToggle{
  width: max-content;
  background-color: #fb5621;
  border:none;
  color: #fff;
  font-weight: 500;
  border-radius: 5px;
  display: flex;
  align-items: center;
  gap: 5px;
  fill: #fff;
}
#shareToggle:hover{
  border-radius: 5px;
  background-color: #e04513;
}
.share-button{
  height: 35px;
  padding: 5px 10px;
  outline: none;
  font-size: 16px;
  transition: all 0.3s ease;
}
.share-button:hover{
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  transform: scale(1.05) rotate(-1deg);
}
.follow-us-btn{
  width: max-content;
  border-radius: 5px;
  border: 1px solid #fb5621;
  background: transparent;
  color: #fb5621;
  font-weight: normal!important;
  display: flex;
  align-items: center;
  gap: 5px;
}

.follow-us-btn:hover{
  border: 1px solid #fb5621;
  background: transparent;
  color: #fb5621!important;
}
/* Fix for GT Translate dropdown issue */
.gt_float_switcher {
  z-index: 1001 !important;
  position: relative !important;
  min-width: 80px !important;
}
.gt_float_switcher .gt_options {
  min-width: 80px !important;
  width: auto !important;
}
.gt_float_switcher .current_lang {
  overflow: visible !important;
  white-space: nowrap !important;
}

        </style><script>
document.addEventListener("DOMContentLoaded", function () {
    const listenButton = document.getElementById("listenButton");
    const articleContent = document.querySelector(".audio"); // Adjust selector based on your theme

    if (!articleContent) {
        console.error("Article content not found.");
        return;
    }

    // Speech synthesis setup
    const speech = new SpeechSynthesisUtterance();
    speech.lang = "en-US"; // Language setting
    speech.rate = 1; // Speed of speech
    speech.text = articleContent.innerText || articleContent.textContent;

    let isPlaying = false;

    listenButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent anchor tag default behavior
        const icon = listenButton.querySelector("i");

        if (!isPlaying) {
            // Start or resume speech
            if (window.speechSynthesis.paused) {
                window.speechSynthesis.resume();
            } else {
                window.speechSynthesis.speak(speech);
            }
            icon.classList.remove("fa-play");
            icon.classList.add("fa-pause");
            isPlaying = true;
        } else {
            // Pause speech
            window.speechSynthesis.pause();
            icon.classList.remove("fa-pause");
            icon.classList.add("fa-play");
            isPlaying = false;
        }
    });

    // Reset icon when speech ends
    speech.onend = function () {
        const icon = listenButton.querySelector("i");
        icon.classList.remove("fa-pause");
        icon.classList.add("fa-play");
        isPlaying = false;
    };

    // Stop speech synthesis on page refresh or unload
    window.addEventListener("beforeunload", function () {
        if (window.speechSynthesis.speaking) {
            window.speechSynthesis.cancel(); // Stop the ongoing speech synthesis
        }
    });

    // Debugging
    speech.onerror = function (event) {
        console.error("Speech synthesis error:", event.error);
    };
});
</script><script>
        const popupContainer =
            document.getElementById("listenButton");
        const popupContent =
            document.getElementById("popupContent");
        popupContainer.addEventListener
            ("mouseover", function () {
                popupContent.style.display = "inline";
            });
        popupContainer.addEventListener
            ("mouseout", function () {
                popupContent.style.display = "none";
            });
    </script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const copyIcon = document.getElementById("copyPostUrl");
    const copyMessage = document.getElementById("copyMessage");

    if (copyIcon) {
        copyIcon.addEventListener("click", function () {
            const postUrl = window.location.href; // Get the current URL
            navigator.clipboard.writeText(postUrl).then(() => {
                // Show success message
                copyMessage.style.display = "inline";
                setTimeout(() => {
                    copyMessage.style.display = "none";
                }, 2000); // Hide after 2 seconds
            }).catch(err => {
                console.error("Failed to copy URL: ", err);
            });
        });
    }
});
</script>';
if (has_post_thumbnail()) {
$featured_image = '<div class="post-featured-image">' . get_the_post_thumbnail() . '</div>';
} else { $featured_image = '';}
echo $post_excerpt . $post_meta . $icons . $featured_image;}}
add_action('generate_after_entry_header', 'add_excerpt_meta_and_featured_image_after_title');
	
function wrap_content_with_audio_div($content) {
    // Check if it's a singular post or page (modify as needed)
    if (is_singular()) {
        // Wrap the content inside the <div class="audio">
        $content = '<div class="audio">' . $content . '</div>';
    }
    return $content;
}
add_filter('the_content', 'wrap_content_with_audio_div');

function insert_table_of_contents_before_first_paragraph($content) {
if (is_single()) {
$post_content = get_post_field('post_content', get_the_ID());
$pattern = '/<h([1-6])[^>]*>(.*?)<\/h[1-6]>/s';
preg_match_all($pattern, $post_content, $matches);
if (count($matches[0]) >= 2) {
$table_of_contents = '<div class="tacp" style="background: #ffdbbb;font-size: 15px;border-radius: 3px;margin-bottom: 1rem;padding:10px;max-width:445px;width:350px;">';
$table_of_contents .= '<div class="toc-header" style="font-weight:600;cursor:pointer;">Table of Contents<span class="toc-icon" style="float: right;">☰</span></div>';
$table_of_contents .= "<script>document.addEventListener('DOMContentLoaded', function() {var tacpElements = document.querySelectorAll('.tacp');tacpElements.forEach(function(tacp) {var header = tacp.querySelector('.toc-header');var icon = tacp.querySelector('.toc-icon');header.addEventListener('click', function() {var ul = tacp.querySelector('ul');if (ul) {if (ul.style.display === 'none' || ul.style.display === '') {ul.style.display = 'block';icon.textContent = '✕';tacp.style.width = '100%';} else {ul.style.display = 'none';icon.textContent = '☰';tacp.style.width = '350px';}}});});});</script>";
$table_of_contents .= '<ul style="display: none;margin-bottom: 0px;margin-left: 25px;">';
foreach ($matches[0] as $index => $match) {
preg_match('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/s', $match, $heading_text);
if (isset($heading_text[1])) {
$heading_text = strip_tags($heading_text[1]);
$heading_id = sanitize_title($heading_text);
$updated_heading = preg_replace('/<h([1-6])([^>]*)>(.*?)<\/h[1-6]>/s', '<h$1$2 id="' . $heading_id . '">$3</h$1>', $match);
$content = str_replace($match, $updated_heading, $content);
$table_of_contents .= '<li style="padding: 5px 0;"><a href="#' . $heading_id . '">' . $heading_text . '</a></li>'; } }
$table_of_contents .= '</ul></div>';
$content = $table_of_contents .  $content; } }
return $content; }
add_filter('the_content', 'insert_table_of_contents_before_first_paragraph');
	
function add_content_after_last_paragraph($content) {
    if (is_singular('post') && in_the_loop() && is_main_query()) {
		$is_enabled = get_option('enable_content_after_last_paragraph', '1');
		if ($is_enabled == '1') {
		$upsc_heading = get_option('upsc_heading');
		$upsc_date = get_option('upsc_date');
		$custom_message = get_option('custom_message_editor');
        $upscupdate = '<div class="latest-updates">
                <div class="latest-updates--heading">
                    <div class="latest-updates--icon">
                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.69596 1.69762C3.98881 1.40468 3.98875 0.929808 3.69582 0.636955C3.40288 0.344102 2.92801 0.344168 2.63516 0.637102C1.00782 2.26489 0 4.51555 0 7.00018C0 9.4848 1.00782 11.7355 2.63516 13.3633C2.92801 13.6562 3.40288 13.6563 3.69582 13.3634C3.98875 13.0705 3.98881 12.5957 3.69596 12.3027C2.33834 10.9447 1.5 9.07108 1.5 7.00018C1.5 4.92928 2.33834 3.05561 3.69596 1.69762Z" fill="white"></path>
                            <path d="M15.3648 0.637102C15.072 0.344168 14.5971 0.344103 14.3042 0.636955C14.0113 0.929808 14.0112 1.40468 14.304 1.69762C15.6617 3.05561 16.5 4.92928 16.5 7.00018C16.5 9.07108 15.6617 10.9447 14.304 12.3027C14.0112 12.5957 14.0113 13.0705 14.3042 13.3634C14.5971 13.6563 15.072 13.6562 15.3648 13.3633C16.9922 11.7355 18 9.4848 18 7.00018C18 4.51556 16.9922 2.26489 15.3648 0.637102Z" fill="white"></path>
                            <path d="M6.36049 3.27923C6.65243 3.57307 6.65089 4.04794 6.35704 4.33988C5.67248 5.02001 5.25 5.96006 5.25 7.0002C5.25 8.04033 5.67248 8.98038 6.35704 9.66051C6.65089 9.95245 6.65243 10.4273 6.36049 10.7212C6.06855 11.015 5.59368 11.0166 5.29983 10.7246C4.34347 9.77445 3.75 8.45593 3.75 7.0002C3.75 5.54447 4.34347 4.22595 5.29983 3.27578C5.59368 2.98384 6.06855 2.98538 6.36049 3.27923Z" fill="white"></path>
                            <path d="M11.6395 3.27923C11.9315 2.98538 12.4063 2.98384 12.7002 3.27578C13.6565 4.22595 14.25 5.54447 14.25 7.0002C14.25 8.45593 13.6565 9.77445 12.7002 10.7246C12.4063 11.0166 11.9315 11.015 11.6395 10.7212C11.3476 10.4273 11.3491 9.95245 11.643 9.66051C12.3275 8.98038 12.75 8.04033 12.75 7.0002C12.75 5.96006 12.3275 5.02001 11.643 4.33988C11.3491 4.04794 11.3476 3.57307 11.6395 3.27923Z" fill="white"></path>
                            <path d="M10.5 7.00018C10.5 7.82861 9.82843 8.50018 9 8.50018C8.17157 8.50018 7.5 7.82861 7.5 7.00018C7.5 6.17176 8.17157 5.50018 9 5.50018C9.82843 5.50018 10.5 6.17176 10.5 7.00018Z" fill="white"></path>
                        </svg>
                    </div>' . wp_kses_post($upsc_heading) . '</div>        
                    <div class="last-updated--date">
                       <p>
                           <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" clip-rule="evenodd" d="M7.993 1.5C4.129 1.5 1 4.636 1 8.5C1 12.364 4.129 15.5 7.993 15.5C11.864 15.5 15 12.364 15 8.5C15 4.636 11.864 1.5 7.993 1.5ZM8 14.5C4.685 14.5 2 11.815 2 8.5C2 5.185 4.685 2.5 8 2.5C11.315 2.5 14 5.185 14 8.5C14 11.815 11.315 14.5 8 14.5ZM8.34996 5H7.29996V9.2L10.975 11.405L11.5 10.544L8.34996 8.675V5Z" fill="#86A1AE"></path>
                           </svg>Last updated on ' . wp_kses_post($upsc_date) . '
                       </p>
        
            </div>' . wp_kses_post($custom_message) . '</div>';

            $content .= $upscupdate;
    } }

    return $content;
}
add_filter('the_content', 'add_content_after_last_paragraph');

function add_faq_schema_after_content($content) {
if ( is_front_page() || is_single() ) {
$faqs = array();
for ($i = 1; $i <= 5; $i++) {
$question = get_field('question_' . $i);
$answer = get_field('answer_' . $i);
if ($question && $answer) {
$faqs[] = array(
"@type" => "Question",
"name" => $question,
"acceptedAnswer" => array(
"@type" => "Answer",
"text" => $answer));}}
$faq_title = get_field('faq_title');
if (!empty($faqs)) {
$faq_schema = array(
"@context" => "https://schema.org",
"@type" => "FAQPage",
"mainEntity" => $faqs);
$faq_schema_json = '<script type="application/ld+json">' . json_encode($faq_schema) . '</script>';
$faq_content .= '<script>document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".faq-question").forEach(function(e){e.addEventListener("click",function(){var e=this.nextElementSibling,t=this.querySelector(".toggle-sign");"none"===e.style.display||""===e.style.display?(e.style.display="block",t.textContent="-"):(e.style.display="none",t.textContent="+")})})})</script><div class="faq" style="    background: #ffdbbb;
    padding: 10px;
    border-radius: 5px;">';
$faq_content .= "<h2><strong style='color:#000'>$faq_title</strong></h2>";
$counter = 1;
foreach ($faqs as $faq) {
$faq_content .= '<div class="faq-item" style="border-bottom: 1px solid burlywood;">';
$faq_content .= '<p class="faq-question" style="margin: 0.5em 0;padding:10px;color:#000;cursor:pointer"><strong>Q' . $counter . '. ' . esc_html($faq['name']) . '<span class="toggle-sign" style="float: right;font-size:25px;color:#fb5621">+</span></strong></p>';
$faq_content .= '<p class="faq-answer" style="font-size:16px;display:none;margin-left:20px;"><strong>Ans</strong>. ' . wp_kses_post($faq['acceptedAnswer']['text']) . '</p>';
$faq_content .= '</div>';
$counter++;}
$faq_content .= '</div>';
$content .= $faq_schema_json . $faq_content;}}
return $content;}
add_filter('the_content', 'add_faq_schema_after_content');

function add_tags_after_content($content) {
if (is_single()) {
$tags = get_the_tags();
if ($tags) {
$tags_list = '<p style="margin-top:1.4em;"><span class="fjahq-bold">Tags: </span>';
foreach ($tags as $tag) {
$tags_list .= '<a class="tags" style="color:#fff!important" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a> ';}
$tags_list .= '</p>';
$content .= $tags_list;
}}return $content;}
add_filter('the_content', 'add_tags_after_content');

function add_next_previous_category_post_links($content) {
if (is_single()) {
global $post;
$categories = wp_get_post_categories($post->ID);
if (!empty($categories)) {
$previous_post = get_adjacent_post(true, '', true, 'category');
$next_post = get_adjacent_post(true, '', false, 'category');
$output = '<div class="post-navigation">';
if (!empty($previous_post)) {
$output .= '<div class="prev-post"><span>Previous Article</span><br>';
$output .= '<a href="' . get_permalink($previous_post->ID) . '">' . esc_html($previous_post->post_title) . '</a>';
$output .= '</div>';}
if (!empty($next_post)) {
$output .= '<div class="next-post"><span>Next Article</span><br>';
$output .= '<a href="' . get_permalink($next_post->ID) . '">' . esc_html($next_post->post_title) . '</a>';
$output .= '</div>';}
$output .= '</div>';
$content .= $output;}}
return $content;}
add_filter('the_content', 'add_next_previous_category_post_links');

function add_author_box_after_content($content) {https://ifelsetechno.com/demo/current-affairs/
if (is_single()) {
global $post;
$author_id = $post->post_author;
$author_display_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_avatar = get_avatar_url($author_id);
$author_archive_url = get_author_posts_url($author_id);
$author_box = '<div class="author-box">';
$author_box .= '<div class="author-avatar"><img src="' . esc_url($author_avatar) . '" alt="' . esc_attr($author_display_name) . '" /></div>';
$author_box .= '<div class="author-name">' . esc_html($author_display_name) . '</div>';
$author_box .= '<div class="author-description">' . esc_html($author_description) . '</div>';
$author_box .= '</div>';
$content .= $author_box;}
return $content;}
add_filter('the_content', 'add_author_box_after_content');
	
function display_related_posts_by_category($content) {
if (is_single()) {
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach ($categories as $category) {
$category_ids[] = $category->term_id;}
$args = array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page' => 3,
'ignore_sticky_posts' => 1);
$related_posts = new WP_Query($args);
if ($related_posts->have_posts()) {
$related_posts_html = '<div class="related-title">Related Posts</div><div class="related-posts">';
while ($related_posts->have_posts()) {
$related_posts->the_post();
$first_category = get_the_category()[0]->name;
$title = get_field('post_name');
if (empty($title)) {$title = get_the_title();}
$related_posts_html .= '<div class="related-post-item">';
$related_posts_html .= '<div class="related-post-image">';
$related_posts_html .= '<a href="' . get_the_permalink() . '">';
$related_posts_html .= get_the_post_thumbnail($post->ID, 'medium');
// $related_posts_html .= '<span class="related-post-category">' . esc_html($first_category) . '</span>';
$related_posts_html .= '</a>';
$related_posts_html .= '</div>';
$related_posts_html .= '<div class="related-post-content">';
$related_posts_html .= '<p><a href="' . get_the_permalink() . '">' . $title . '</a></p>';
$related_posts_html .= '<div class="related-post-meta">';
$related_posts_html .= '<span>' . get_the_author() . '</span> | ';
$related_posts_html .= '<span>' . get_the_date() . '</span>';
$related_posts_html .= '</div>';
$related_posts_html .= '</div>';
$related_posts_html .= '</div>';}
$related_posts_html .= '</div>';
wp_reset_postdata();
$content .= $related_posts_html;}}}
return $content;}
add_filter('the_content', 'display_related_posts_by_category');
	
function add_courses_after_content($content) {
if (is_single()) { // Check if it’s a single post
$courses_data = get_option('courses_data', []);
$filtered_courses = array_filter($courses_data, function ($course) {
return !empty($course['title']) && !empty($course['image']) && !empty($course['price']) && !empty($course['link']);});
if (!empty($filtered_courses)) {
$html = '<div class="related-title">Courses</div><div class="product-slider">';
foreach ($filtered_courses as $course) {
$title = esc_html($course['title']);
$image = esc_url($course['image']);
$price = esc_html($course['price']);
$link = esc_url($course['link']);
$html .= '
<div class="product-item">
<img decoding="async" src="' . $image . '" alt="' . $title . '">
<div class="ptitle">' . $title . '</div>
<div class="product-pricing">
<span class="current-price">₹' . $price . '</span>
</div>
<a href="' . $link . '" class="explore-button" target="_blank">Enroll Now</a>
</div>';}
$html .= '</div><script>
document.addEventListener("DOMContentLoaded", function () {
const slider = document.querySelector(".product-slider");
let isDown = false;
let startX;
let scrollLeft;
slider.addEventListener("mousedown", (e) => {
isDown = true;
slider.classList.add("active");
startX = e.pageX - slider.offsetLeft;
scrollLeft = slider.scrollLeft;
});
slider.addEventListener("mouseleave", () => {
isDown = false;
slider.classList.remove("active");
});
slider.addEventListener("mouseup", () => {
isDown = false;
slider.classList.remove("active");
});
slider.addEventListener("mousemove", (e) => {
if (!isDown) return;
e.preventDefault();
const x = e.pageX - slider.offsetLeft;
const walk = (x - startX) * 3; // Adjust scroll speed
slider.scrollLeft = scrollLeft - walk;
});
setInterval(() => {
const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
if (slider.scrollLeft >= maxScrollLeft) {
slider.scrollLeft = 0; // Reset to start
} else {
slider.scrollLeft += 200; // Scroll forward
}
}, 5000);
});
</script>';
$content .= $html;}}
return $content;}
add_filter('the_content', 'add_courses_after_content');

function add_sitemap_code() {
if (is_user_logged_in()) {
$siteurl = site_url();
$decoded_url = base64_decode('aHR0cHM6Ly9rYXJuYXRha2FoZWxwLmlu');
if ($siteurl !== $decoded_url) {

$max_posts_per_sitemap = 200;

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
);

$posts = get_posts($args);

$num_sitemaps = ceil(count($posts) / $max_posts_per_sitemap);

for ($i = 0; $i < $num_sitemaps; $i++) {
    $start_index = $i * $max_posts_per_sitemap;
    $end_index = ($i + 1) * $max_posts_per_sitemap;

    if ($i === 0) {
        $sitemap_filename = "post-sitemap.xml";
    } else {
        $sitemap_filename = "post-sitemap{$i}.xml";
    }

    date_default_timezone_set('GMT');
	$currentTimestamp = time();
    $currentDate = date('Y-m-d\TH:i:s+05:30', $currentTimestamp);
	$site_url = site_url();
	$site_changefreq = 'always';
	$site_priority = 1;

    $sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemap_content = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . PHP_EOL;
	$sitemap_content .= '<url>' . PHP_EOL;
    $sitemap_content .= '<loc>' . esc_url($site_url) . '</loc>' . PHP_EOL;
    $sitemap_content .= '<lastmod>' . esc_html($currentDate) . '</lastmod>' . PHP_EOL;
    $sitemap_content .= '<changefreq>' . esc_html($site_changefreq) . '</changefreq>' . PHP_EOL;
    $sitemap_content .= '<priority>' . esc_html($site_priority) . '</priority>' . PHP_EOL;
    $sitemap_content .= '</url>' . PHP_EOL;

    for ($j = $start_index; $j < $end_index; $j++) {
        if (isset($posts[$j])) {
            $post = $posts[$j];
            $post_modified = get_the_modified_date('c', $post);
            $post_url = get_permalink($post);
            $post_priority = 0.9;
            $post_changefreq = 'daily';
			$image_url = get_the_post_thumbnail_url($post);
			if (empty($image_url)){$image_url ="http://wordpress.dev.vajiramias.net/wp-content/uploads/2024/07/UPSC_Prelims_Result_2024.webp";}
// 			$keywords = get_field( 'keywords', $post);

            $sitemap_content .= '<url>' . PHP_EOL;
            $sitemap_content .= '<loc>' . esc_url($post_url) . '</loc>' . PHP_EOL;
            $sitemap_content .= '<lastmod>' . esc_html($post_modified) . '</lastmod>' . PHP_EOL;
            $sitemap_content .= '<changefreq>' . esc_html($post_changefreq) . '</changefreq>' . PHP_EOL;
            $sitemap_content .= '<priority>' . esc_html($post_priority) . '</priority>' . PHP_EOL;
// 			$sitemap_content .= '<keywords>' . esc_html($keywords) . '</keywords>' . PHP_EOL;
			$sitemap_content .= '<image:image>' . PHP_EOL;
			$sitemap_content .= '<image:loc>' . esc_html($image_url) . '</image:loc>' . PHP_EOL;
			$sitemap_content .= '</image:image>' . PHP_EOL;
            $sitemap_content .= '</url>' . PHP_EOL;
        }
    }

    $sitemap_content .= '</urlset>' . PHP_EOL;

    file_put_contents($sitemap_filename, $sitemap_content);
}

$max_news_per_sitemap = 200;

$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'category_name'  => 'news',
);

$news = get_posts($args);

$num_sitemaps = ceil(count($news) / $max_news_per_sitemap);

for ($i = 0; $i < $num_sitemaps; $i++) {

    $start_index = $i * $max_news_per_sitemap;
    $end_index = ($i + 1) * $max_news_per_sitemap;

    if ($i === 0) {
        $sitemap_filename = "news-sitemap.xml";
    } else {
        $sitemap_filename = "news-sitemap{$i}.xml";
    }

$sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$sitemap_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . PHP_EOL;

    for ($j = $start_index; $j < $end_index; $j++) {
        if (isset($news[$j])) {
            $new = $news[$j];
            $new_url = get_permalink($new);
			$publication_modified_date = get_the_modified_date('c', $new);
            $publication_name = 'vajiramias';
            $language = 'en';
            $publication_date = get_the_date('c', $new);
            $title = get_the_title($new);
			$keywords = get_field( 'keywords', $new);
			$image_url = get_the_post_thumbnail_url($new);
			if (empty($image_url)){$image_url ="http://wordpress.dev.vajiramias.net/wp-content/uploads/2024/07/UPSC_Prelims_Result_2024.webp";}

            $sitemap_content .= '<url>' . PHP_EOL;
            $sitemap_content .= '<loc>' . esc_url($new_url) . '</loc>' . PHP_EOL;
			$sitemap_content .= '<lastmod>' . esc_html($publication_modified_date) . '</lastmod>' . PHP_EOL;
			$sitemap_content .= '<changefreq>daily</changefreq>' . PHP_EOL;
            $sitemap_content .= '<news:news>' . PHP_EOL;
            $sitemap_content .= '<news:publication>' . PHP_EOL;
            $sitemap_content .= '<news:name>' . esc_html($publication_name) . '</news:name>' . PHP_EOL;
            $sitemap_content .= '<news:language>' . esc_html($language) . '</news:language>' . PHP_EOL;
            $sitemap_content .= '</news:publication>' . PHP_EOL;
            $sitemap_content .= '<news:publication_date>' . esc_html($publication_date) . '</news:publication_date>' . PHP_EOL;
            $sitemap_content .= '<news:title>' . esc_html($title) . '</news:title>' . PHP_EOL;
			$sitemap_content .= '<news:keywords>' . esc_html($keywords) . '</news:keywords>' . PHP_EOL;
            $sitemap_content .= '</news:news>' . PHP_EOL;
			$sitemap_content .= '<image:image>' . PHP_EOL;
			$sitemap_content .= '<image:loc>' . esc_html($image_url) . '</image:loc>' . PHP_EOL;
			$sitemap_content .= '</image:image>' . PHP_EOL;
            $sitemap_content .= '</url>' . PHP_EOL;
        }
    }

    $sitemap_content .= '</urlset>' . PHP_EOL;

    file_put_contents($sitemap_filename, $sitemap_content);
}

$categories = get_categories();

$sitemap_filename = "category-sitemap.xml";

	date_default_timezone_set('GMT');
	$currentTimestamp = time();
    $currentDate = date('Y-m-d\TH:i:s+05:30', $currentTimestamp);
	$site_url = site_url();
	$site_changefreq = 'always';
	$site_priority = 1;

    $sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemap_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
	$sitemap_content .= '<url>' . PHP_EOL;
    $sitemap_content .= '<loc>' . esc_url($site_url) . '</loc>' . PHP_EOL;
    $sitemap_content .= '<lastmod>' . esc_html($currentDate) . '</lastmod>' . PHP_EOL;
    $sitemap_content .= '<changefreq>' . esc_html($site_changefreq) . '</changefreq>' . PHP_EOL;
    $sitemap_content .= '<priority>' . esc_html($site_priority) . '</priority>' . PHP_EOL;
    $sitemap_content .= '</url>' . PHP_EOL;

foreach ($categories as $category) {
    $category_url = get_category_link($category);
    date_default_timezone_set('GMT');
	$currentTimestamp = time();
    $currentDate = date('Y-m-d\TH:i:s+05:30', $currentTimestamp);
    $category_priority = 0.9;
    $category_changefreq = 'weekly';

    $sitemap_content .= '<url>' . PHP_EOL;
    $sitemap_content .= '<loc>' . esc_url($category_url) . '</loc>' . PHP_EOL;
	$sitemap_content .= '<lastmod>' . esc_html($currentDate) . '</lastmod>' . PHP_EOL;
    $sitemap_content .= '<changefreq>' . esc_html($category_changefreq) . '</changefreq>' . PHP_EOL;
    $sitemap_content .= '<priority>' . esc_html($category_priority) . '</priority>' . PHP_EOL;
    $sitemap_content .= '</url>' . PHP_EOL;
}

$sitemap_content .= '</urlset>' . PHP_EOL;

file_put_contents($sitemap_filename, $sitemap_content);

$args = array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);

$pages = get_posts($args);

$sitemap_filename = "page-sitemap.xml";

    date_default_timezone_set('GMT');
	$currentTimestamp = time();
    $currentDate = date('Y-m-d\TH:i:s+05:30', $currentTimestamp);
	$site_url = site_url();
	$site_changefreq = 'always';
	$site_priority = 1;

    $sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemap_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
	$sitemap_content .= '<url>' . PHP_EOL;
    $sitemap_content .= '<loc>' . esc_url($site_url) . '</loc>' . PHP_EOL;
    $sitemap_content .= '<lastmod>' . esc_html($currentDate) . '</lastmod>' . PHP_EOL;
    $sitemap_content .= '<changefreq>' . esc_html($site_changefreq) . '</changefreq>' . PHP_EOL;
    $sitemap_content .= '<priority>' . esc_html($site_priority) . '</priority>' . PHP_EOL;
    $sitemap_content .= '</url>' . PHP_EOL;

foreach ($pages as $page) {
    $page_modified = get_the_modified_date('c', $page);
    $page_url = get_permalink($page);
    $page_priority = 0.9;
    $page_changefreq = 'weekly';

    $sitemap_content .= '<url>' . PHP_EOL;
    $sitemap_content .= '<loc>' . esc_url($page_url) . '</loc>' . PHP_EOL;
    $sitemap_content .= '<lastmod>' . esc_html($page_modified) . '</lastmod>' . PHP_EOL;
    $sitemap_content .= '<changefreq>' . esc_html($page_changefreq) . '</changefreq>' . PHP_EOL;
    $sitemap_content .= '<priority>' . esc_html($page_priority) . '</priority>' . PHP_EOL;
    $sitemap_content .= '</url>' . PHP_EOL;
}

$sitemap_content .= '</urlset>' . PHP_EOL;

file_put_contents($sitemap_filename, $sitemap_content);

$sitemap_index_filename = "sitemap_index.xml";

$sitemap_index_content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$sitemap_index_content .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

$xml_files = glob('*.xml');

foreach ($xml_files as $xml_file) {

    if ($xml_file === $sitemap_index_filename) {
        continue;
    }

    $sitemap_url = "$site_url/$xml_file";
    date_default_timezone_set('GMT');
	$currentTimestamp = time();
    $sitemap_lastmod = date('Y-m-d\TH:i:s+05:30', $currentTimestamp);

    $sitemap_index_content .= '<sitemap>' . PHP_EOL;
    $sitemap_index_content .= '<loc>' . esc_url($sitemap_url) . '</loc>' . PHP_EOL;
    $sitemap_index_content .= '<lastmod>' . esc_html($sitemap_lastmod) . '</lastmod>' . PHP_EOL;
    $sitemap_index_content .= '</sitemap>' . PHP_EOL;
}

$sitemap_index_content .= '</sitemapindex>' . PHP_EOL;

file_put_contents($sitemap_index_filename, $sitemap_index_content);
} } }
add_action('wp_footer', 'add_sitemap_code');

// Main hook: Trigger after form submit
// add_action('wpforms_process_complete', 'send_wpforms_to_leadsquared', 10, 4);
// function send_wpforms_to_leadsquared($fields, $entry, $form_data, $entry_id) {
//     if ($form_data['id'] != 208) { // Run only for form ID 208
//         return;
//     }
	

//     // Extract and sanitize form values
//     $name   = isset($fields[2]['value']) ? trim(sanitize_text_field($fields[2]['value'])) : '';
//     $email  = isset($fields[3]['value']) ? trim(sanitize_email($fields[3]['value'])) : '';
//     $phone  = isset($fields[4]['value']) ? trim(sanitize_text_field($fields[4]['value'])) : '';
//     $course = isset($fields[13]['value']) ? trim(sanitize_text_field($fields[13]['value'])) : '';
// 	$notes = isset($fields[11]['value']) ? trim(sanitize_text_field($fields[11]['value'])) : '';

//     // Get current UTC time
//     $utcCurrentDate = gmdate("Y-m-d\TH:i:s\Z");

//     // Prepare the correct JSON format (array at the root)
//     $leadData = array(
//         array("Attribute" => "FirstName", "Value" => $name),
//         array("Attribute" => "EmailAddress", "Value" => $email),
//         array("Attribute" => "Phone", "Value" => $phone),
//         array("Attribute" => "mx_Owner_Name", "Value" => "vajiramandravi upsc exam"),
//         array("Attribute" => "course", "Value" => $course), // Kept dynamic as per your request
//         array("Attribute" => "notes", "Value" => $notes), 
//         array("Attribute" => "ActivityNote", "Value" => "Contact Enquiry"),
//         array("Attribute" => "ActivityDateTime", "Value" => $utcCurrentDate),
// 		array("Attribute" => "SearchBy", "Value" => "Phone")
//     );

//     // API URL and authentication keys
//     $api_url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture';
//     $access_key = 'u$r0439b0285c2b77522254fb6f697164cf';
//     $secret_key = 'a5ee1422e0ad1d76ca14b8267ddb4e40077f2570';

//     // Full API URL with authentication parameters
//     $api_url .= "?accessKey=$access_key&secretKey=$secret_key";

//     // Convert data to JSON
//     $json_data = json_encode($leadData);

//     // Debugging logs (Check error logs)
//     error_log("Sending to LeadSquared: " . $json_data);

//     // Initialize cURL
//     $ch = curl_init($api_url);

//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);	
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//     // Execute API call
//     $response = curl_exec($ch);
//     $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     $curl_error = curl_error($ch);

//     // Close cURL connection
//     curl_close($ch);

//     // Ensure no extra output before sending JSON
//     if (ob_get_length()) ob_end_clean();

//     // Decode API response
//     $response_data = json_decode($response, true);
	
//     // Log API response for debugging
// if ($http_code == 200 && isset($response_data['Status']) && $response_data['Status'] === "Success") {
//     $status = 'Success';
// } else {
//     $status = 'Failure';
// }
// 	coursecourse
// 	 global $wpdb;

//     $field_id_to_update = 16;
//     $new_value = 'Updated by API';

//     // Confirm entry exists
//     $exists = $wpdb->get_var($wpdb->prepare(
//         "SELECT COUNT(*) FROM {$wpdb->prefix}wpforms_entry_fields WHERE entry_id = %d AND field_id = %d",
//         $entry_id, $field_id_to_update
//     ));

//     if ($exists) {
//         $result = $wpdb->update(
//             "{$wpdb->prefix}wpforms_entry_fields",
//             ['value' => $new_value],
//             ['entry_id' => $entry_id, 'field_id' => $field_id_to_update]
//         );
//         error_log("Update result: $result"); // Will be 1 if update succeeded
//     } else {
//         error_log("Field not found for entry_id=$entry_id, field_id=$field_id_to_update");
//     }

//     // Debug log
//     error_log("Updating entry field: entry_id=$entry_id, field_id=$field_id_to_update, value=$new_value");

// //     $wpdb->update(
// //         "{$wpdb->prefix}wpforms_entry_fields",
// //         ['value' => $new_value],
// //         ['entry_id' => $entry_id, 'field_id' => $field_id_to_update]
// //     );

// 	if ($http_code == 200 && isset($response_data['Status']) && $response_data['Status'] === "Success") {
// //         wp_send_json_success(array(
// //             "status" => "Success",
// //             "message" => array(
// //                 "Id" => $response_data['Message']['Id'] ?? uniqid(),
// //                 "RelatedId" => $response_data['Message']['RelatedId'] ?? uniqid(),
// //                 "IsCreated" => $response_data['Message']['IsCreated'] ?? true
// //             )
// //         ));
// // 		return;
// // 		$res = json_decode($response, true);
// //         $response_message = isset($res['Message']) ? $res['Message'] : 'Unknown response';
// // Store lead status

// 		wpforms()->entry_meta->add([
// 		'entry_id' => $entry_id,
// 		'form_id'  => $form_data['id'],
// 		'type'     => 'note',
// 		'data'     => 'LeadSquared Response: ' . (is_string($response) ? $response : print_r($response_data, true)),
// 	]);
// 		setcookie('formPopupShown', 'true', time() + 86400, '/'); // Stores the Cookie only after the suceesful form submission
// 		return;
// 	} else {
		
// 		wpforms()->entry_meta->add([
//         'entry_id' => $entry_id,
//         'form_id'  => $form_data['id'],
//         'type'     => 'note',
//         'data'     => 'LeadSquared Response: ' . $response_data,
//     ]);
//         wp_send_json_error(array(
//             "status" => "Error",
//             "message" => "Lead creation failed",
//             "api_response" => $response_data,
//             "http_code" => $http_code,
//             "curl_error" => $curl_error
//         ));
// 		 $response_message = 'Error: HTTP ' . $http_code . ' - ' . $curl_error;
// 		return;
//     }	
	
// }

 



add_action('wpforms_process_complete', 'send_wpforms_to_leadsquared', 10, 4);

function send_wpforms_to_leadsquared($fields, $entry, $form_data, $entry_id) {
    if ($form_data['id'] != 208) {
        return;
    }

    // Extract and sanitize form values
    $name   = isset($fields[2]['value']) ? trim(sanitize_text_field($fields[2]['value'])) : '';
    $email  = isset($fields[3]['value']) ? trim(sanitize_email($fields[3]['value'])) : '';
    $phone  = isset($fields[4]['value']) ? trim(sanitize_text_field($fields[4]['value'])) : '';
    $course = isset($fields[13]['value']) ? trim(sanitize_text_field($fields[13]['value'])) : '';
    $notes  = isset($fields[11]['value']) ? trim(sanitize_text_field($fields[11]['value'])) : '';
    $preparing_upsc = isset($fields[17]['value']) ? trim(sanitize_text_field($fields[17]['value'])) : '';
    $target_year = isset($fields[18]['value']) ? trim(sanitize_text_field($fields[18]['value'])) : '';

    $utcCurrentDate = gmdate("Y-m-d\TH:i:s\Z");

    // CREATE BASE LEAD DATA - WITHOUT EMAIL (we'll add it only when needed)
    $leadDataBase = array(
        array("Attribute" => "FirstName", "Value" => $name),
        array("Attribute" => "Phone", "Value" => $phone),
        array("Attribute" => "mx_Owner_Name", "Value" => "vajiramandravi upsc exam"),
        array("Attribute" => "mx_Course_Interested", "Value" => $course),
        array("Attribute" => "notes", "Value" => $notes),
        array("Attribute" => "mx_Preparing_for_UPSC", "Value" => $preparing_upsc),
        array("Attribute" => "mx_Year", "Value" => $target_year),
        array("Attribute" => "ActivityNote", "Value" => "Contact Enquiry"),
        array("Attribute" => "ActivityDateTime", "Value" => $utcCurrentDate)
    );

    // Only create full lead data with email when creating new leads
    $leadDataWithEmail = $leadDataBase;
    if (!empty($email)) {
        $leadDataWithEmail[] = array("Attribute" => "EmailAddress", "Value" => $email);
    }

    $access_key = 'u$r0439b0285c2b77522254fb6f697164cf';
    $secret_key = 'a5ee1422e0ad1d76ca14b8267ddb4e40077f2570';

    // Log the start of this process
    wpforms()->entry_meta->add([
        'entry_id' => $entry_id,
        'form_id'  => $form_data['id'],
        'type'     => 'note',
      
    ]);

    // Function to get lead by search parameters
    function check_lead_exists($searchBy, $value, $access_key, $secret_key) {
        if (empty($value)) {
            return array('http_code' => 400, 'response' => '[]', 'curl_error' => 'Empty search value');
        }
        
        $api_url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.GetBy';
        $api_url .= "?accessKey=$access_key&secretKey=$secret_key&searchBy=$searchBy&value=" . urlencode($value);

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        return array(
            'response' => $response,
            'http_code' => $http_code,
            'curl_error' => $curl_error
        );
    }

    // Function to update lead
    function update_lead($leadData, $leadId, $access_key, $secret_key) {
        $api_url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Update';
        $api_url .= "?accessKey=$access_key&secretKey=$secret_key&leadId=$leadId";

        $json_data = json_encode($leadData);

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        return array(
            'response' => $response,
            'http_code' => $http_code,
            'curl_error' => $curl_error
        );
    }

    // Function to create new lead
    function create_lead($leadData, $access_key, $secret_key) {
        $api_url = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture';
        $api_url .= "?accessKey=$access_key&secretKey=$secret_key";

        $json_data = json_encode($leadData);

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        return array(
            'response' => $response,
            'http_code' => $http_code,
            'curl_error' => $curl_error
        );
    }

    // Check if lead with this phone exists
    $phone_lead_id = null;
    if (!empty($phone)) {
        $phone_check = check_lead_exists('Phone', $phone, $access_key, $secret_key);
        $phone_response = json_decode($phone_check['response'], true);
        if ($phone_check['http_code'] == 200 && !empty($phone_response)) {
            $phone_lead_id = $phone_response[0]['LeadId'];
        }
    }

    // Check if lead with this email exists
    $email_lead_id = null;
    if (!empty($email)) {
        $email_check = check_lead_exists('EmailAddress', $email, $access_key, $secret_key);
        $email_response = json_decode($email_check['response'], true);
        if ($email_check['http_code'] == 200 && !empty($email_response)) {
            $email_lead_id = $email_response[0]['LeadId'];
        }
    }
    
    $result = null;
    $success = false;

    // SCENARIO 1: Same lead ID for both email and phone (or only one exists)
    if ($email_lead_id && $phone_lead_id && $email_lead_id === $phone_lead_id) {
        $result = update_lead($leadDataBase, $email_lead_id, $access_key, $secret_key);
        $success = ($result['http_code'] == 200);
    }
    // SCENARIO 2: Only phone exists
    else if ($phone_lead_id && !$email_lead_id) {
        $leadDataNoPhone = array_filter($leadDataBase, function($item) {
            return $item['Attribute'] !== 'Phone';
        });
        $result = update_lead($leadDataNoPhone, $phone_lead_id, $access_key, $secret_key);
        $success = ($result['http_code'] == 200);
    }
    // SCENARIO 3: Only email exists
    else if ($email_lead_id && !$phone_lead_id) {
        $result = update_lead($leadDataBase, $email_lead_id, $access_key, $secret_key);
        $success = ($result['http_code'] == 200);
    }
    // SCENARIO 4: Different lead IDs for email and phone
    else if ($email_lead_id && $phone_lead_id && $email_lead_id !== $phone_lead_id) {
        $leadDataNoEmail = array_filter($leadDataBase, function($item) {
            return $item['Attribute'] !== 'EmailAddress';
        });
        $result = update_lead($leadDataNoEmail, $phone_lead_id, $access_key, $secret_key);
        $success = ($result['http_code'] == 200);
    }
    // SCENARIO 5: No existing leads found, create new one
    else {
        $result = create_lead($leadDataWithEmail, $access_key, $secret_key);
        $response_body = json_decode($result['response'], true);
        $success = ($result['http_code'] == 200 && isset($response_body['Status']) && $response_body['Status'] === "Success");
    }

    // Log only the final result
    // if ($success) {
    //     $response_body = json_decode($result['response'], true);
    //     $lead_id = '';
        
    //     if (isset($response_body['Message'])) {
    //         // For update operations
    //         $lead_id = $email_lead_id ?? $phone_lead_id;
    //     } else if (isset($response_body['LeadId'])) {
    //         // For create operations
    //         $lead_id = $response_body['LeadId'];
    //     }

    //     wpforms()->entry_meta->add([
    //         'entry_id' => $entry_id,
    //         'form_id'  => $form_data['id'],
    //         'type'     => 'note',
    //         'data'     => sprintf(
    //             'Lead %s (ID: %s)',
    //             ($result['http_code'] == 200 ? 'modified' : 'sent'),
    //             $lead_id
    //         )
    //     ]);
    // } else {
    //     $error_message = isset($response_body['ExceptionMessage']) ? $response_body['ExceptionMessage'] : 'Unknown error';
    //     wpforms()->entry_meta->add([
    //         'entry_id' => $entry_id,
    //         'form_id'  => $form_data['id'],
    //         'type'     => 'note',
    //         'data'     => 'Lead operation failed: ' . $error_message
    //     ]);
    // }
}



// Admin submenu page to view LeadSquared status
add_action('admin_menu', function() {
    add_submenu_page(
        'wpforms-overview',
        'LeadSquared Status',
        'LeadSquared Status',
        'manage_options',
        'leadsquared-status',
        'display_leadsquared_status_page'
    );
});
function display_leadsquared_status_page() {
    global $wpdb;

    $order = isset($_GET['order']) && strtolower($_GET['order']) === 'asc' ? 'ASC' : 'DESC';
    $toggle_order = $order === 'ASC' ? 'DESC' : 'ASC';
    $order_icon = $order === 'ASC' ? '↑' : '↓';

    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $per_page = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
    $offset = ($paged - 1) * $per_page;

    echo '<div class="wrap">';
    echo '<h1>LeadSquared Status for Form #208</h1>';

    // Search and Limit Form
    echo '<form method="get" style="margin-bottom: 20px;">';
    echo '<input type="hidden" name="page" value="leadsquared-status">';
    echo '<input type="text" name="s" value="' . esc_attr($search) . '" placeholder="Search by Name or Email..." />';
    echo '&nbsp;';
    echo '<label for="limit">Show:</label> ';
    echo '<select name="limit" onchange="this.form.submit()">';
    foreach ([5, 10, 25, 50, 100] as $limit_option) {
        $selected = $per_page == $limit_option ? 'selected' : '';
        echo "<option value='{$limit_option}' {$selected}>{$limit_option}</option>";
    }
    echo '</select> entries per page &nbsp;';
    echo '<input type="submit" value="Apply" class="button button-primary" />';
    echo '</form>';

    // Base Query
    $query = "
        SELECT e.entry_id, e.date, 
               name.value AS name, 
               email.value AS email,
               status.data AS status, 
               note.data AS response
        FROM {$wpdb->prefix}wpforms_entries e
        LEFT JOIN {$wpdb->prefix}wpforms_entry_fields name ON e.entry_id = name.entry_id AND name.field_id = 2
        LEFT JOIN {$wpdb->prefix}wpforms_entry_fields email ON e.entry_id = email.entry_id AND email.field_id = 3
        LEFT JOIN {$wpdb->prefix}wpforms_entry_meta status ON e.entry_id = status.entry_id AND status.type = 'leadsquared_status'
        LEFT JOIN {$wpdb->prefix}wpforms_entry_meta note ON e.entry_id = note.entry_id AND note.type = 'note'
        WHERE e.form_id = 208
    ";

    if (!empty($search)) {
        $query .= $wpdb->prepare(" AND (name.value LIKE %s OR email.value LIKE %s)", '%' . $search . '%', '%' . $search . '%');
    }

    $query .= " ORDER BY e.date $order";

    // Total count for pagination
    $count_query = "SELECT COUNT(*) FROM ({$query}) AS total";
    $total_entries = $wpdb->get_var($count_query);
    $total_pages = ceil($total_entries / $per_page);

    // Add LIMIT + OFFSET
    $query .= $wpdb->prepare(" LIMIT %d OFFSET %d", $per_page, $offset);
    $entries = $wpdb->get_results($query);

    if (!empty($entries)) {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr>';
        echo '<th>Entry ID</th>';
        echo '<th><a href="?page=leadsquared-status&order=' . $toggle_order . '&s=' . urlencode($search) . '&limit=' . $per_page . '">Date ' . $order_icon . '</a></th>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Status</th>';
        echo '<th>Response</th>';
        echo '<th>Action</th>';
        echo '</tr></thead><tbody>';

        foreach ($entries as $entry) {
            echo '<tr>';
            echo '<td>' . esc_html($entry->entry_id) . '</td>';
            echo '<td>' . esc_html($entry->date) . '</td>';
            echo '<td>' . esc_html($entry->name) . '</td>';
            echo '<td>' . esc_html($entry->email) . '</td>';

           $response_output = '—';
$status_text = '<span style="color:#999;">Not processed</span>';

if (!empty($entry->response)) {
    $response_string = trim(str_replace('LeadSquared Response:', '', $entry->response));
    $decoded = json_decode($response_string, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        // Determine status
        $status_val = $decoded['Status'] ?? '';
        $isCreated = $decoded['Message']['IsCreated'] ?? null;

        if ($status_val === 'Success') {
            if ($isCreated === true) {
                $status_text = '<span style="color:#00a32a; font-weight: bold;">Success</span>';
            } elseif ($isCreated === false) {
                $status_text = '<span style="color:#f39c12; font-weight: bold;">Modified</span>';
            } else {
                $status_text = '<span style="color:#cc1818; font-weight: bold;">Failure</span>';
            }
        } else {
            $status_text = '<span style="color:#cc1818; font-weight: bold;">Failure</span>';
        }

        // Show full JSON response
        $response_output = json_encode($decoded, JSON_PRETTY_PRINT);
    } else {
        $response_output = esc_textarea($entry->response);
    }
}

            echo '<td>' . $status_text . '</td>';
            echo '<td><textarea readonly style="width:100%; height:60px;">' . esc_textarea($response_output) . '</textarea></td>';

            $view_url = admin_url('admin.php?page=wpforms-entries&view=details&entry_id=' . $entry->entry_id);
            echo '<td><a href="' . esc_url($view_url) . '" class="button">View</a></td>';
            echo '</tr>';
        }

        echo '</tbody></table>';

        // Pagination links
        echo '<div class="tablenav"><div class="tablenav-pages">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i === $paged) ? 'current' : '';
            $page_link = add_query_arg([
                'page' => 'leadsquared-status',
                'paged' => $i,
                'order' => $order,
                's' => urlencode($search),
                'limit' => $per_page
            ]);
            echo "<a class='button $class' href='$page_link'>$i</a> ";
        }
        echo '</div></div>';
    } else {
        echo '<p>No entries found for form #208.</p>';
    }

    echo '</div>'; // .wrap
}

// kk	
function upsc_lead_capture_form_shortcode() {
        ob_start();
        ?>
        <style>
            #formContainer {
                font-family: Arial, sans-serif;
                max-width: 600px;
                margin: 0 auto;
                padding: 5px;
            }

            .form-group {
                margin-bottom: 5px;
                position: relative;
            }

            .spinner {
                display: flex;
                border: 4px solid rgba(0, 0, 0, 0.1);
                width: 28px;
                height: 28px;
                border-radius: 50%;
                border-left-color: #fb5621;
                animation: spin 1s linear infinite;
                margin: 0 auto;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .error-message {
                color: red;
                font-size: 12px;
                display: none;
                margin-top: 5px;
            }

            #formEl input,
            #formEl select {
                width: 100%;
                padding: 10px !important;
                background: transparent;
                font-size: 14px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            #submitButton {
                background-color: #fb5621;
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 4px;
                margin-top: 5px;
                width: fit-content;
            }

            #submitButton:disabled {
                background-color: #ccc;
                cursor: not-allowed;
            }

            #thankYouCard {
                display: none;
                text-align: center;
                padding: 10px;
                background-color: white;
                color: #333;
                border-radius: 6px;
                margin-top: 25px;
            }

            .thank-you-content {
                padding: 5px;
            }

            #okButton {
                background-color: #fb5621;
                color: white;
                border: none;
                padding: 8px 15px;
                font-size: 14px;
                cursor: pointer;
                border-radius: 4px;
                margin-top: 10px;
            }

            #formResponse {
                margin-top: 10px;
                font-size: 14px;
                display: none;
            }

            #loader {
                display: none;
                margin: 10px auto;
                margin-left: 15px;
            }

            .homeptitle {
                font-size: 22px;
                font-weight: bold;
                margin-bottom: 0px !important;
            }

            .homeptitle2 {
                font-size: 16px;
                margin-bottom: 5px !important;
            }

            .button-and-loader {
                display: flex;
                align-items: center;
            }

            .form-image {
                width: 100%;
            }

            .radio-group {
                display: flex;
                gap: 20px;
                margin-top: 8px;
            }

            .radio-label {
                display: flex;
                align-items: center;
                cursor: pointer;
                position: relative;
            }

            .radio-label input[type="radio"] {
                display: none;
            }

            .radio-custom {
                width: 80px;
                height: auto;
                border: 1px solid #fb5621;
                border-radius: 7px;
                display: inline-block;
                position: relative;
                vertical-align: middle;
                margin-right: 0px;
                transition: background-color 0.3s, border-color 0.3s;
                padding: 7px 5px;
                text-align: center;
                font-size: 16px;
            }

            .radio-label input[type="radio"]:checked+.radio-custom {
                background-color: #fb5621;
                border-color: #fb5621;
                color: #fff;
            }

            .radio-text {
                font-size: 16px;
                font-weight: bold;
                color: #333;
            }

            .radio-label:hover .radio-custom {
                border-color: #fb5621;
            }
        </style>

        <div id="formContainer">
            <form id="formEl" onsubmit="return false;">
                <input type="hidden" id="formPopupType" name="formPopupType" value="auto">
                <div><img class="form-image" src="https://vajiramandravi.com/current-affairs/wp-content/uploads/2024/09/illustration_graphic_cartoon_character_of_psychotherapy_counseling_vector.webp" alt="illustration_graphic_cartoon_character_of_psychotherapy_counseling_vector.webp" /></div>
                <p class="homeptitle">Preparing for the UPSC CSE Exam</p>
                <p class="homeptitle2">Get all your questions answered with our free expert counseling!</p>

                <div class="form-group">
                    <label style="font-size: 14px; font-weight: bold;">Are you currently preparing for UPSC?<span style="color: red; font-weight: bold;">*</span></label>
                    <select name="currentlyPreparing" id="currentlyPreparing" class="form-control">
                        <option value="">Select an option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <span class="error-message" id="preparingError" style="display: none; color: red;"></span>
                </div>

                <div class="form-group">
                    <input type="text" placeholder="Name" id="leadformName" />
                    <span class="error-message" id="nameError" style="display: none; color: red;"></span>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Email" id="leadformEmail" />
                    <span class="error-message" id="emailError" style="display: none; color: red;"></span>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Mobile Number" id="leadformPhone" />
                    <span class="error-message" id="phoneError" style="display: none; color: red;"></span>
                </div>
                <div class="form-group">
                    <label style="font-size: 14px; font-weight: bold;">Which year are you targeting for your UPSC attempt?<span style="color: red; font-weight: bold;">*</span></label>
                    <select name="targetYear" id="targetYear" class="form-control">
                        <option value="">Select Year</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                    <span class="error-message" id="yearError" style="display: none; color: red;"></span>
                </div>
                <div class="form-group">
                    <select placeholder="Select Course" id="leadformCourse">
                        <option value="">Select Course</option>
                        <option value="GS Course">GS Course</option>
                        <option value="Test Series">Test Series</option>
                        <option value="Optionals">Optionals</option>
                        <option value="Mentorship">Mentorship</option>
                        <option value="Others">Others</option>
                    </select>
                    <span class="error-message" id="courseError" style="display: none; color: red;"></span>
                </div>
                <div class="form-group" id="otherCourseGroup" style="display: none;">
                    <label style="font-size: 14px; font-weight: bold;">What is your immediate query?<span style="color: red; font-weight: bold;">*</span></label>
                    <input type="text" placeholder="Type here. Our counselors will contact you." id="otherCourseInput" />
                    <span class="error-message" id="otherCourseError" style="display: none; color: red;"></span>
                </div>

                <div class="form-group button-and-loader">
                    <button type="submit" id="submitButton">Submit</button>
                    <div id="loader" style="display: none; text-align: center; margin: 10px 0; margin-left: 12px; margin-top: 15px;">
                        <div class="spinner"></div>
                    </div>
                </div>
                <p class="form-error-msg" id="formResponse" style="display: none;"></p>
            </form>
            <div id="thankYouCard" style="display: none;">
                <div class="thank-you-content">
                    <img src="https://vajiramandravi.com/current-affairs/wp-content/uploads/2025/05/counselling_efa7ee8226.webp" alt="Thank You" class="thank-you-image" />
                    <h2>Thank You!</h2>
                    <p>Your information has been submitted successfully.</p>
                    <button id="okButton">OK</button>
                </div>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            // Default popup type is 'auto' for automatic popups
            let formPopupType = 'auto';
            $('#formPopupType').val('auto'); // Set initial value

            // Find the enquire button 
            const enquireButton = document.querySelector('.enquire-now');

            // Handle manual clicks on enquire button
            if (enquireButton) {
                enquireButton.addEventListener('click', function() {
                    formPopupType = 'manual';
                    $('#formPopupType').val('manual');
                    console.log('Form opened manually via Enquire button');
                });
            }

            // Optional: Log when form opens automatically
            $(document).ready(function() {
                if (formPopupType === 'auto') {
                    console.log('Form opened automatically');
                }
            });

            // Get all form elements properly
            const nameInput = document.getElementById('leadformName');
            const emailInput = document.getElementById('leadformEmail');
            const phoneInput = document.getElementById('leadformPhone');
            const courseSelect = document.getElementById('leadformCourse');
            const currentlyPreparingSelect = document.getElementById('currentlyPreparing');
            const targetYearSelect = document.getElementById('targetYear');
            const otherCourseInput = document.getElementById('otherCourseInput');
            const otherCourseGroup = document.getElementById('otherCourseGroup');
            const submitButton = document.getElementById('submitButton');
            const thankYouCard = document.getElementById('thankYouCard');
            const formEl = document.getElementById('formEl');
            const okButton = document.getElementById('okButton');
            const loader = document.getElementById('loader');

            // Error message elements
            const nameError = document.getElementById('nameError');
            nameError.innerText = 'Please enter a valid name.';

            const emailError = document.getElementById('emailError');
            emailError.innerText = 'Please enter a valid email address.';

            const phoneError = document.getElementById('phoneError');
            phoneError.innerText = 'Please enter a valid 10-digit phone number.';

            const courseError = document.getElementById('courseError');
            courseError.innerText = 'Please select a course.';

            const otherCourseError = document.getElementById('otherCourseError');
            otherCourseError.innerText = 'Please specify the course you are interested in.';

            const preparingError = document.getElementById('preparingError');
            preparingError.innerText = 'Please select if you are currently preparing.';

            const yearError = document.getElementById('yearError');
            yearError.innerText = 'Please select your target year.';

            // Initially disable submit button
            submitButton.disabled = true;

            // OK button click handler
            okButton.addEventListener('click', function() {
                thankYouCard.style.display = 'none';
                formEl.style.display = 'block';
                formEl.reset();
                otherCourseGroup.style.display = 'none';
                submitButton.disabled = true;
                hideAllErrors();
            });

            // Hide all error messages
            function hideAllErrors() {
                nameError.style.display = 'none';
                emailError.style.display = 'none';
                phoneError.style.display = 'none';
                courseError.style.display = 'none';
                otherCourseError.style.display = 'none';
                preparingError.style.display = 'none';
                yearError.style.display = 'none';
            }

            // Validation functions
            function validateName(showError = false) {
                const isValid = nameInput.value.trim().length >= 2;
                if (showError) {
                    nameError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            function validateEmail(showError = false) {
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const isValid = emailPattern.test(emailInput.value);
                if (showError) {
                    emailError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            function validatePhone(showError = false) {
                const isValid = phoneInput.value.length === 10;
                if (showError) {
                    phoneError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            function validateCourse(showError = false) {
                const isValid = courseSelect.value !== "";
                if (showError) {
                    courseError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            function validateOtherCourse(showError = false) {
                if (courseSelect.value !== "Others") {
                    return true;
                }

                const isValid = otherCourseInput.value.trim().length >= 2;
                if (showError) {
                    otherCourseError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            function validatePreparing(showError = false) {
                const isValid = currentlyPreparingSelect.value !== "";
                if (showError) {
                    preparingError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            function validateYear(showError = false) {
                const isValid = targetYearSelect.value !== "";
                if (showError) {
                    yearError.style.display = isValid ? 'none' : 'block';
                }
                return isValid;
            }

            // Function to check form validity and update submit button
            function checkFormValidity(showErrors = false) {
                const isNameValid = validateName(showErrors);
                const isEmailValid = validateEmail(showErrors);
                const isPhoneValid = validatePhone(showErrors);
                const isCourseValid = validateCourse(showErrors);
                const isOtherCourseValid = validateOtherCourse(showErrors);
                const isPreparingValid = validatePreparing(showErrors);
                const isYearValid = validateYear(showErrors);

                submitButton.disabled = !(isNameValid && isEmailValid && isPhoneValid && isCourseValid && isOtherCourseValid && isPreparingValid && isYearValid);
                return !submitButton.disabled;
            }

            // Handle course select change
            courseSelect.addEventListener('change', function() {
                if (this.value === "Others") {
                    otherCourseGroup.style.display = 'block';
                } else {
                    otherCourseGroup.style.display = 'none';
                }
                validateCourse(true);
                checkFormValidity(false);
            });

            // Input event listeners for real-time validation and error message updates
            nameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                if (nameError.style.display === 'block') {
                    if (validateName(false)) {
                        nameError.style.display = 'none';
                    }
                }
                checkFormValidity(false);
            });

            phoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }

                if (phoneError.style.display === 'block') {
                    if (validatePhone(false)) {
                        phoneError.style.display = 'none';
                    }
                }
                checkFormValidity(false);
            });

            emailInput.addEventListener('input', function() {
                if (emailError.style.display === 'block') {
                    if (validateEmail(false)) {
                        emailError.style.display = 'none';
                    }
                }
                checkFormValidity(false);
            });

            otherCourseInput.addEventListener('input', function() {
                if (otherCourseError.style.display === 'block') {
                    if (validateOtherCourse(false)) {
                        otherCourseError.style.display = 'none';
                    }
                }
                checkFormValidity(false);
            });

            currentlyPreparingSelect.addEventListener('change', function() {
                if (preparingError.style.display === 'block') {
                    if (validatePreparing(false)) {
                        preparingError.style.display = 'none';
                    }
                }
                checkFormValidity(false);
            });

            targetYearSelect.addEventListener('change', function() {
                if (yearError.style.display === 'block') {
                    if (validateYear(false)) {
                        yearError.style.display = 'none';
                    }
                }
                checkFormValidity(false);
            });

            // Blur (focus lost) event listeners for validation
            nameInput.addEventListener('blur', function() {
                validateName(true);
            });

            emailInput.addEventListener('blur', function() {
                validateEmail(true);
            });

            phoneInput.addEventListener('blur', function() {
                validatePhone(true);
            });

            otherCourseInput.addEventListener('blur', function() {
                validateOtherCourse(true);
            });

            // Form submission handler
            $('#submitButton').on('click', function(e) {
                e.preventDefault();
                console.log('Button clicked');
                // Validate all fields and show errors
                const isFormValid = checkFormValidity(true);

                // If the form is valid, proceed with submission
                if (isFormValid) {
                    $('#loader').show();
                    $('#submitButton').prop('disabled', true);
                    const data = {
                        action: 'send_to_leadsquared',
                        name: $('#leadformName').val(),
                        email: $('#leadformEmail').val(),
                        phone: $('#leadformPhone').val(),
                        course: $('#leadformCourse').val(),
                        notes: $('#otherCourseInput').val(),
                        preparing_upsc: $('#currentlyPreparing').val(),
                        target_year: $('#targetYear').val(),
                        form_popup_type: $('#formPopupType').val(),
                        source_url: window.location.href // Add this line
                    };
                    console.log('Data to be sent:', data);
                    $.post(my_ajax_object.ajax_url, data, function(response) {
                        $('#loader').hide();
                        $('#submitButton').prop('disabled', false);
                        console.log('Response received:', response);
                        if (response.success) {
                            $('#formEl').hide();
                            $('#thankYouCard').show();
                        } else {
                            alert('Error: ' + response.data.message);
                        }
                    }).fail(function(xhr, status, error) {
                        $('#loader').hide();
                        $('#submitButton').prop('disabled', false);
                        alert('An error occurred: ' + error);
                    });
                }
            });
            console.log('Form submission handler set up');
        });
        </script>
        <?php
        return ob_get_clean();
    }

    add_shortcode('upsc_lead_form1', 'upsc_lead_capture_form_shortcode');

    function enqueue_leadsquared_ajax_script() {
        // Enqueue your JS file (adjust the path accordingly)
        wp_enqueue_script(
            'leadsquared-ajax',
            get_template_directory_uri() . '/js/leadsquared-ajax.js',
            array('jquery'),
            null,
            true
        );

        // Pass ajax_url and optional nonce to your script
        wp_localize_script('leadsquared-ajax', 'my_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            // 'nonce' => wp_create_nonce('leadsquared_nonce') // optional security
        ));
    }
    add_action('wp_enqueue_scripts', 'enqueue_leadsquared_ajax_script');

    add_action('wp_ajax_send_to_leadsquared', 'send_to_leadsquared_ajax');
    add_action('wp_ajax_nopriv_send_to_leadsquared', 'send_to_leadsquared_ajax');

    function send_to_leadsquared_ajax() {
        error_log("LeadSquared AJAX initiated");

        $name           = sanitize_text_field($_POST['name'] ?? '');
        $email          = sanitize_email($_POST['email'] ?? '');
        $phone          = sanitize_text_field($_POST['phone'] ?? '');
        $course         = sanitize_text_field($_POST['course'] ?? '');
        $notes          = sanitize_text_field($_POST['notes'] ?? '');
        $preparing_upsc = sanitize_text_field($_POST['preparing_upsc'] ?? '');
        $target_year    = sanitize_text_field($_POST['target_year'] ?? '');
        $form_popup_type = sanitize_text_field($_POST['form_popup_type'] ?? 'auto');
        $source_url = sanitize_text_field($_POST['source_url'] ?? '');

        $utcDate = gmdate("Y-m-d\\TH:i:s\\Z");

        $access_key = 'u$r0439b0285c2b77522254fb6f697164cf';
        $secret_key = 'a5ee1422e0ad1d76ca14b8267ddb4e40077f2570';
        $host = 'api-in21.leadsquared.com';
        // Common lead data (used in both create & update)
        $leadBase = [
            ["Attribute" => "FirstName", "Value" => $name],
            ["Attribute" => "Phone", "Value" => $phone],
            ["Attribute" => "mx_Owner_Name", "Value" => "current affairs " . $form_popup_type],
            ["Attribute" => "mx_Course_Interested", "Value" => $course],
            ["Attribute" => "notes", "Value" => $notes],
            ["Attribute" => "mx_Preparing_for_UPSC", "Value" => $preparing_upsc],
            ["Attribute" => "mx_Year", "Value" => $target_year],
            //["Attribute" => "mx_Source_URL", "Value" => $source_url]  // Add this line
        ];
$create_res['Message']['IsCreated']?'success' : 'modified';

        if (!empty($email)) {
            $leadBase[] = ["Attribute" => "EmailAddress", "Value" => $email];
        }

        // Add activity fields ONLY during creation
        $leadForCreate = $leadBase;
        $leadForCreate[] = ["Attribute" => "ActivityNote", "Value" => "Contact Enquiry"];
        $leadForCreate[] = ["Attribute" => "ActivityDateTime", "Value" => $utcDate];

        // Request helpers
        function make_api_request($url, $method = 'GET', $data = null) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            if ($method === 'POST') curl_setopt($ch, CURLOPT_POST, true);
            elseif ($method === 'PUT') curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            }

            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            error_log("[$method] $url | HTTP: $http_code | ERROR: $error");
            error_log("Payload: " . json_encode($data));
            error_log("Response: $response");

            return ['http_code' => $http_code, 'response' => $response];
        }

        // Lookup helpers
        function get_lead_id_by_phone($phone, $host, $key, $secret) {
            $url = "https://$host/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=$key&secretKey=$secret&phone=" . urlencode($phone);
            $res = make_api_request($url);
            $data = json_decode($res['response'], true);
            return $data[0]['ProspectID'] ?? null;
        }

        function get_lead_id_by_email($email, $host, $key, $secret) {
            $url = "https://$host/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=$key&secretKey=$secret&emailaddress=" . urlencode($email);
            $res = make_api_request($url);
            $data = json_decode($res['response'], true);
            return $data[0]['ProspectID'] ?? null;
        }

        function create_lead($data, $host, $key, $secret) {
            $url = "https://$host/v2/LeadManagement.svc/Lead.Capture?accessKey=$key&secretKey=$secret";
            return make_api_request($url, 'POST', $data);
        }

        function update_lead($id, $data, $host, $key, $secret) {
            $url = "https://$host/v2/LeadManagement.svc/Lead.Update?accessKey=$key&secretKey=$secret&leadId=" . urlencode($id);
            return make_api_request($url, 'POST', $data);
        }

        
        // Attempt to create
        $create = create_lead($leadForCreate, $host, $access_key, $secret_key);
        $create_res = json_decode($create['response'], true);

        if ($create['http_code'] === 200 && $create_res['Status'] === 'Success') {
            // Save to local database



             

            global $wpdb;
            $table_name = $wpdb->prefix . 'upsc_leads';
            
            $lead_id = $create_res['Message']['RelatedId'] ?? 'unknown';
            
            $wpdb->insert(
                $table_name,
                array(
                    'leadsquared_id' => $lead_id, // Store the LeadSquared ID
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'course' => $course,
                    'query' => $notes,
                    'preparing_upsc' => $preparing_upsc,
                    'target_year' => $target_year,
                    'status' => $status,
                    'form_popup_type' => $form_popup_type,
                    'source_url' => $source_url,
                    'created_at' => current_time('mysql')
                )
            );

            $lead_id = $create_res['Message']['RelatedId'] ?? 'unknown';
            wp_send_json_success([
                'message' => 'Lead created',
                'lead_id' => $lead_id,
                'local_id' => $wpdb->insert_id
            ]);
        }

        // If duplicate error, try update
        $exception = $create_res['ExceptionMessage'] ?? '';
        if (stripos($exception, 'already exists') !== false) {
            $lead_id = null;
            if (!empty($phone)) {
                $lead_id = get_lead_id_by_phone($phone, $host, $access_key, $secret_key);
            }
            if (!$lead_id && !empty($email)) {
                $lead_id = get_lead_id_by_email($email, $host, $access_key, $secret_key);
            }

            if ($lead_id) {
                // Add database update for modified status
                global $wpdb;
                $table_name = $wpdb->prefix . 'upsc_leads';

                $wpdb->insert(
                    $table_name,
                    array(
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'course' => $course,
                        'query' => $notes,
                        'preparing_upsc' => $preparing_upsc,
                        'target_year' => $target_year,
                        'status' => $create_res['Message']['IsCreated'] ? 'success' : 'modified';,
                        'form_popup_type' => $form_popup_type,
                        'source_url' => $source_url,  // Add this line
                        'created_at' => current_time('mysql')
                    )
                );

                // Remove ActivityNote and ActivityDateTime from update
                $leadForUpdate = array_filter($leadBase, function($item) {
                    return !in_array($item['Attribute'], ['ActivityNote', 'ActivityDateTime']);
                });
                $update = update_lead($lead_id, array_values($leadForUpdate), $host, $access_key, $secret_key);
                $update_res = json_decode($update['response'], true);

                if ($update['http_code'] === 200) {
                    wp_send_json_success([
                        'message' => 'Lead updated',
                        'lead_id' => $lead_id,
                        'local_id' => $wpdb->insert_id
                    ]);
                } else {
                    // Update status to failed if retry is needed
                    $wpdb->update(
                        $table_name,
                        array('status' => 'failed'),
                        array('id' => $wpdb->insert_id)
                    );

                    // Retry update without email/phone if needed
                    $exception = $update_res['ExceptionMessage'] ?? '';
                    $retry_data = array_filter($leadForUpdate, function($item) use ($exception) {
                        if (stripos($exception, 'Email') !== false && $item['Attribute'] === 'EmailAddress') return false;
                        if (stripos($exception, 'Phone') !== false && $item['Attribute'] === 'Phone') return false;
                        return true;
                    });

                    $retry = update_lead($lead_id, array_values($retry_data), $host, $access_key, $secret_key);
                    if ($retry['http_code'] === 200) {
                        // Update status back to modified if retry succeeds
                        $wpdb->update(
                            $table_name,
                            array('status' => 'modified'),
                            array('id' => $wpdb->insert_id)
                        );
                        wp_send_json_success([
                            'message' => 'Lead updated after removing email/phone',
                            'lead_id' => $lead_id
                        ]);
                    } else {
                        wp_send_json_error([
                            'message' => 'Final update failed',
                            'response' => $retry['response']
                        ]);
                    }
                }
            } else {
                // Insert with failed status if lead ID not found
                global $wpdb;
                $table_name = $wpdb->prefix . 'upsc_leads';

                $wpdb->insert(
                    $table_name,
                    array(
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'course' => $course,
                        'query' => $notes,
                        'preparing_upsc' => $preparing_upsc,
                        'target_year' => $target_year,
                        'status' => 'failed',
                        'form_popup_type' => $form_popup_type,
                        'source_url' => $source_url,  // Add this line
                        'created_at' => current_time('mysql')
                    )
                );

                wp_send_json_error([
                    'message' => 'Duplicate detected, but lead ID not found',
                    'local_id' => $wpdb->insert_id
                ]);
            }
        }

        // Insert with failed status if creation fails
        global $wpdb;
        $table_name = $wpdb->prefix . 'upsc_leads';

        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'course' => $course,
                'query' => $notes,
                'preparing_upsc' => $preparing_upsc,
                'target_year' => $target_year,
                'status' => 'failed',
                'form_popup_type' => $form_popup_type,
                'source_url' => $source_url,  // Add this line
                'created_at' => current_time('mysql')
            )
        );

        wp_send_json_error([
            'message' => 'Lead creation failed',
            'response' => $create['response'],
            'local_id' => $wpdb->insert_id
        ]);
    }

    // Add admin menu
    function upsc_leads_admin_menu() {
        add_menu_page(
            'VJRM Lead Submissions',
            'VJRM Leads',
            'manage_options',
            'vjrm-leads',
            'display_leads_admin_page',
            'dashicons-list-view',
            30
        );
    }
    add_action('admin_menu', 'upsc_leads_admin_menu');

    // Create the leads table in database
    function create_leads_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'upsc_leads';
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            leadsquared_id varchar(100) DEFAULT NULL,
            name varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            phone varchar(20) NOT NULL,
            course varchar(50) NOT NULL,
            query text,
            preparing_upsc varchar(5) NOT NULL,
            target_year varchar(10) NOT NULL,
            status varchar(20) DEFAULT 'new',
            form_popup_type varchar(10) DEFAULT 'auto',
            source_url text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    register_activation_hook(__FILE__, 'create_leads_table');
    //add_action('init', 'create_leads_table');

    // Update leads table schema
    function update_leads_table_schema() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'upsc_leads';

        // Check if form_popup_type column exists
        $popup_type_exists = $wpdb->get_results("SHOW COLUMNS FROM `{$table_name}` LIKE 'form_popup_type'");

        if (empty($popup_type_exists)) {
            // Add form_popup_type column if it doesn't exist
            $wpdb->query("ALTER TABLE `{$table_name}`
                        ADD COLUMN `form_popup_type` varchar(10) DEFAULT 'auto'
                        AFTER `status`");
        }

        // Check if source_url column exists
        $source_url_exists = $wpdb->get_results("SHOW COLUMNS FROM `{$table_name}` LIKE 'source_url'");

        if (empty($source_url_exists)) {
            // Add source_url column if it doesn't exist
            $wpdb->query("ALTER TABLE `{$table_name}`
                        ADD COLUMN `source_url` text DEFAULT NULL
                        AFTER `form_popup_type`");
        }
    }

    // Add this action to run after table creation
    add_action('init', 'update_leads_table_schema', 11); // Priority 11 ensures it runs after create_leads_table

    // Display admin page
    function display_leads_admin_page() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'upsc_leads';

        // Search and Filter Parameters
        $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
        $status_filter = isset($_GET['status_filter']) ? sanitize_text_field($_GET['status_filter']) : '';
        $course_filter = isset($_GET['course_filter']) ? sanitize_text_field($_GET['course_filter']) : '';
        $date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
        $date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';

        // Additional filter parameters
        $preparing_filter = isset($_GET['preparing_filter']) ? sanitize_text_field($_GET['preparing_filter']) : '';
        $year_filter = isset($_GET['year_filter']) ? sanitize_text_field($_GET['year_filter']) : '';
        $popup_filter = isset($_GET['popup_filter']) ? sanitize_text_field($_GET['popup_filter']) : '';

        // Build WHERE clause
        $where_clauses = array();
        $where_values = array();

        if (!empty($search)) {
            $where_clauses[] = "(name LIKE %s OR email LIKE %s OR phone LIKE %s)";
            $search_term = '%' . $wpdb->esc_like($search) . '%';
            $where_values = array_merge($where_values, array($search_term, $search_term, $search_term));
        }

        if (!empty($status_filter)) {
            $where_clauses[] = "status = %s";
            $where_values[] = $status_filter;
        }

        if (!empty($course_filter)) {
            $where_clauses[] = "course = %s";
            $where_values[] = $course_filter;
        }

        if (!empty($preparing_filter)) {
            $where_clauses[] = "preparing_upsc = %s";
            $where_values[] = $preparing_filter;
        }

        if (!empty($year_filter)) {
            $where_clauses[] = "target_year = %s";
            $where_values[] = $year_filter;
        }

        if (!empty($date_from)) {
            $where_clauses[] = "created_at >= %s";
            $where_values[] = $date_from . ' 00:00:00';
        }

        if (!empty($date_to)) {
            $where_clauses[] = "created_at <= %s";
            $where_values[] = $date_to . ' 23:59:59';
        }

        if (!empty($popup_filter)) {
            $where_clauses[] = "form_popup_type = %s";
            $where_values[] = $popup_filter;
        }

        // Pagination
        $page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        $items_per_page = 20;
        $offset = ($page - 1) * $items_per_page;

        // Build query
        $where_sql = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';
        $count_query = "SELECT COUNT(*) FROM $table_name $where_sql";
        $leads_query = "SELECT * FROM $table_name $where_sql ORDER BY created_at DESC LIMIT %d OFFSET %d";

        // Get total items and leads
        $total_items = $wpdb->get_var($wpdb->prepare($count_query, $where_values));
        $leads = $wpdb->get_results($wpdb->prepare($leads_query, array_merge($where_values, array($items_per_page, $offset))));

        $total_pages = ceil($total_items / $items_per_page);

        // Get unique courses for filter
        $courses = $wpdb->get_col("SELECT DISTINCT course FROM $table_name WHERE course != ''");

        // Get unique years for filter
        $years = $wpdb->get_col("SELECT DISTINCT target_year FROM $table_name WHERE target_year != '' ORDER BY target_year ASC");

        ?>
        <div class="wrap">
            <h1>VJRM Lead Submissions</h1>

            <!-- Search and Filters -->
            <div class="tablenav top">
                <form method="get" style="margin-bottom: 20px;">
                    <input type="hidden" name="page" value="vjrm-leads">

                    <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                        <input type="search" name="search" value="<?php echo esc_attr($search); ?>"
                            placeholder="Search name, email or phone" style="width: 200px;">

                        <!-- Updated Status Filter -->
                        <select name="status_filter" style="width: 150px;">
                            <option value="">All Statuses</option>
                            <option value="success" <?php selected($status_filter, 'success'); ?>>Success</option>
                            <option value="modified" <?php selected($status_filter, 'modified'); ?>>Modified</option>
                            <option value="failed" <?php selected($status_filter, 'failed'); ?>>Failed</option>
                        </select>

                        <!-- Course Filter -->
                        <select name="course_filter" style="width: 150px;">
                            <option value="">All Courses</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?php echo esc_attr($course); ?>"
                                        <?php selected($course_filter, $course); ?>>
                                    <?php echo esc_html($course); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Preparing UPSC Filter -->
                        <select name="preparing_filter" style="width: 150px;">
                            <option value="">Preparing UPSC</option>
                            <option value="Yes" <?php selected($preparing_filter, 'Yes'); ?>>Yes</option>
                            <option value="No" <?php selected($preparing_filter, 'No'); ?>>No</option>
                        </select>

                        <!-- Target Year Filter -->
                        <select name="year_filter" style="width: 150px;">
                            <option value="">Target Year</option>
                            <?php foreach ($years as $year): ?>
                                <option value="<?php echo esc_attr($year); ?>"
                                        <?php selected($year_filter, $year); ?>>
                                    <?php echo esc_html($year); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Form Popup Type Filter -->
                        <select name="popup_filter" style="width: 150px;">
                            <option value="">All Sources</option>
                            <option value="auto" <?php selected($popup_filter, 'auto'); ?>>Auto Popup</option>
                            <option value="manual" <?php selected($popup_filter, 'manual'); ?>>Manual Click</option>
                        </select>

                        <input type="date" name="date_from" value="<?php echo esc_attr($date_from); ?>"
                            placeholder="From Date">
                        <input type="date" name="date_to" value="<?php echo esc_attr($date_to); ?>"
                            placeholder="To Date">

                        <input type="submit" class="button" value="Apply Filters">
                        <a href="<?php echo admin_url('admin.php?page=vjrm-leads'); ?>" class="button">Reset</a>
                    </div>
                </form>

                <!-- Update CSV export URL to include new filters -->
                <div class="alignright">
                    <a href="<?php echo admin_url('admin.php?page=vjrm-leads&export=csv' .
                        ($search ? '&search=' . urlencode($search) : '') .
                        ($status_filter ? '&status_filter=' . urlencode($status_filter) : '') .
                        ($course_filter ? '&course_filter=' . urlencode($course_filter) : '') .
                        ($preparing_filter ? '&preparing_filter=' . urlencode($preparing_filter) : '') .
                        ($year_filter ? '&year_filter=' . urlencode($year_filter) : '') .
                        ($date_from ? '&date_from=' . urlencode($date_from) : '') .
                        ($date_to ? '&date_to=' . urlencode($date_to) : '')); ?>" class="button">Export to CSV</a>
                </div>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Query</th>
                        <th>Preparing UPSC</th>
                        <th>Target Year</th>
                        <th>Status</th>
                        <th>Popup Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $row_number = ($page - 1) * $items_per_page + 1;
                    foreach ($leads as $lead): 
                    ?>
                    <tr>
                        <td><?php echo esc_html($row_number++); ?></td>
                        <td><?php echo esc_html($lead->name); ?></td>
                        <td><?php echo esc_html($lead->email); ?></td>
                        <td><?php echo esc_html($lead->phone); ?></td>
                        <td><?php echo esc_html($lead->course); ?></td>
                        <td><?php echo esc_html($lead->query); ?></td>
                        <td><?php echo esc_html($lead->preparing_upsc); ?></td>
                        <td><?php echo esc_html($lead->target_year); ?></td>
                        <td><?php echo esc_html($lead->status); ?></td>
                        <td><?php echo esc_html($lead->form_popup_type ?? 'auto'); ?></td>
                        <td><?php echo esc_html($lead->created_at); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=lead-details&id=' . esc_attr($lead->id)); ?>" 
                               class="button" 
                               target="_blank">
                                View Details
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="tablenav bottom">
                <div class="tablenav-pages">
                    <?php
                    echo paginate_links(array(
                        'base' => add_query_arg('paged', '%#%'),
                        'format' => '',
                        'prev_text' => __('&laquo;'),
                        'next_text' => __('&raquo;'),
                        'total' => $total_pages,
                        'current' => $page
                    ));
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    // Handle CSV export
    function handle_csv_export() {
        if (isset($_GET['page']) && $_GET['page'] === 'vjrm-leads' && isset($_GET['export']) && $_GET['export'] === 'csv') {
            global $wpdb;
            $table_name = $wpdb->prefix . 'upsc_leads';

            // Get filter parameters
            $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
            $status_filter = isset($_GET['status_filter']) ? sanitize_text_field($_GET['status_filter']) : '';
            $course_filter = isset($_GET['course_filter']) ? sanitize_text_field($_GET['course_filter']) : '';
            $preparing_filter = isset($_GET['preparing_filter']) ? sanitize_text_field($_GET['preparing_filter']) : '';
            $year_filter = isset($_GET['year_filter']) ? sanitize_text_field($_GET['year_filter']) : '';
            $date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
            $date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';
            $popup_filter = isset($_GET['popup_filter']) ? sanitize_text_field($_GET['popup_filter']) : '';

            // Build WHERE clause
            $where_clauses = array();
            $where_values = array();

            if (!empty($search)) {
                $where_clauses[] = "(name LIKE %s OR email LIKE %s OR phone LIKE %s)";
                $search_term = '%' . $wpdb->esc_like($search) . '%';
                $where_values = array_merge($where_values, array($search_term, $search_term, $search_term));
            }

            if (!empty($status_filter)) {
                $where_clauses[] = "status = %s";
                $where_values[] = $status_filter;
            }

            if (!empty($course_filter)) {
                $where_clauses[] = "course = %s";
                $where_values[] = $course_filter;
            }

            if (!empty($preparing_filter)) {
                $where_clauses[] = "preparing_upsc = %s";
                $where_values[] = $preparing_filter;
            }

            if (!empty($year_filter)) {
                $where_clauses[] = "target_year = %s";
                $where_values[] = $year_filter;
            }

            if (!empty($date_from)) {
                $where_clauses[] = "created_at >= %s";
                $where_values[] = $date_from . ' 00:00:00';
            }

            if (!empty($date_to)) {
                $where_clauses[] = "created_at <= %s";
                $where_values[] = $date_to . ' 23:59:59';
            }

            if (!empty($popup_filter)) {
                $where_clauses[] = "form_popup_type = %s";
                $where_values[] = $popup_filter;
            }

            // Build and execute query with all filters
            $where_sql = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';
            $query = "SELECT * FROM $table_name $where_sql ORDER BY created_at DESC";
            $leads = $wpdb->get_results($wpdb->prepare($query, $where_values));

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename=vjrm-leads-export-'.date('Y-m-d').'.csv');

            $fp = fopen('php://output', 'w');

            // Add headers
            fputcsv($fp, array(
                'Name', 'Email', 'Phone', 'Course', 'Query',
                'Preparing UPSC', 'Target Year', 'Status',
                'Source', 'Date'  // Removed Source URL
            ));

            // Add data
            foreach ($leads as $lead) {
                fputcsv($fp, array(
                    $lead->name,
                    $lead->email,
                    $lead->phone,
                    $lead->course,
                    $lead->query,
                    $lead->preparing_upsc,
                    $lead->target_year,
                    $lead->status,
                    $lead->form_popup_type ?? 'auto',
                    $lead->created_at
                ));
            }

            fclose($fp);
            exit;
        }
    }
    add_action('admin_init', 'handle_csv_export');

    // Add lead details page
    function add_lead_details_page() {
        add_submenu_page(
            null,                      // No parent menu
            'Lead Details',            // Page title
            'Lead Details',            // Menu title
            'manage_options',          // Capability
            'lead-details',            // Menu slug
            'display_lead_details_page' // Callback function
        );
    }
    add_action('admin_menu', 'add_lead_details_page');

    // Display the lead details page
    function display_lead_details_page() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        global $wpdb;
        $lead_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $table_name = $wpdb->prefix . 'upsc_leads';
        
        $lead = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $lead_id
        ));

        if (!$lead) {
            wp_die(__('Lead not found.'));
        }
        ?>
        <div class="wrap">
            <h1>Lead Details</h1>
            <div class="card" style="max-width: 800px; padding: 20px; margin-top: 20px;">
                <table class="widefat">
                    <tr>
                        <td style="width: 200px;"><strong>Local ID:</strong></td>
                        <td><?php echo esc_html($lead->id); ?></td>
                    </tr>
                    <tr>
                        <td><strong>LeadSquared ID:</strong></td>
                        <td>
                            <?php
                            // Add column to store LeadSquared ID if not exists
                            $leadsquared_id_exists = $wpdb->get_results("SHOW COLUMNS FROM `{$table_name}` LIKE 'leadsquared_id'");
                            if (empty($leadsquared_id_exists)) {
                                $wpdb->query("ALTER TABLE `{$table_name}` 
                                    ADD COLUMN `leadsquared_id` varchar(100) DEFAULT NULL 
                                    AFTER `id`");
                            }
                            
                            echo !empty($lead->leadsquared_id) ? esc_html($lead->leadsquared_id) : 'Not available';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;"><strong>Name:</strong></td>
                        <td><?php echo esc_html($lead->name); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo esc_html($lead->email); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td><?php echo esc_html($lead->phone); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course:</strong></td>
                        <td><?php echo esc_html($lead->course); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Query:</strong></td>
                        <td><?php echo esc_html($lead->query); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Preparing UPSC:</strong></td>
                        <td><?php echo esc_html($lead->preparing_upsc); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Target Year:</strong></td>
                        <td><?php echo esc_html($lead->target_year); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td><?php echo esc_html($lead->status); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Source:</strong></td>
                        <td><?php echo esc_html($lead->form_popup_type ?? 'auto'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Source URL:</strong></td>
                        <td>
                            <?php if (!empty($lead->source_url)): ?>
                                <a href="<?php echo esc_url($lead->source_url); ?>" target="_blank">
                                    <?php echo esc_html($lead->source_url); ?>
                            </a>
                            <?php else: ?>
                                Not available
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Created At:</strong></td>
                        <td><?php echo esc_html($lead->created_at); ?></td>
                    </tr>
                </table>
                <p style="margin-top: 20px;">
                    <a href="<?php echo admin_url('admin.php?page=vjrm-leads'); ?>" class="button">Back to Leads</a>
                </p>
            </div>
        </div>
        <?php
    }






