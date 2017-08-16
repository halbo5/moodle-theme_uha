<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * UHA.
 *
 * @package    theme_uha
 * @copyright  2017 Alain Bolli
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.
function theme_uha_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/uha/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');

    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_uha', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_uha and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }
    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/uha/scss/pre.scss');
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/uha/scss/post.scss');

    // Combine them together.
    return $pre . "\n" . $scss . "\n" . $post;
}

/**
 * Add a user preference to choose complete interface or not
 */
function theme_uha_extend_navigation_user_settings($navigation, $user) {
    global $USER, $PAGE;

    // Don't bother doing needless calculations unless we are on the relevant pages and if no capacity to create courses.
    $onpreferencepage = $PAGE->url->compare(new moodle_url('/user/preferences.php'), URL_MATCH_BASE);
    $onthemepage = $PAGE->url->compare(new moodle_url('/theme/uha/pref.php'), URL_MATCH_BASE);
    $systemcontext = context_system::instance();

    if (!$onpreferencepage && !$onthemepage) {
        return null;
    }

    // No access to other peoples subscriptions.
    if ($USER->id == $user->id) {
        // We skip doing a check here if we are on the event monitor page as the check is done internally on that page.
        $node = navigation_node::create(get_string('preferencetitle', 'theme_uha'), null,
                navigation_node::TYPE_CONTAINER, null, 'preferencetitle');

        if (isset($node) && !empty($navigation)) {
            $navigation->add_node($node);
        }

        $url = new moodle_url('/theme/uha/pref.php');
        $subsnode = navigation_node::create(get_string('themepref', 'theme_uha'), $url,
                navigation_node::TYPE_SETTING, null, 'themepref', new pix_icon('i/settings', ''));

        if (isset($subsnode) && !empty($navigation)) {
            $node->add_node($subsnode);
        }
    }
}

/**
 * Validating the new preference
 */

function theme_uha_user_preferences() {
    $preferences = array();
    $preferences['mycourses'] = array(
        'type' => PARAM_INT,
        'null' => NULL_NOT_ALLOWED,
        'default' => 0,
        'choices' => array(0, 1)
    );
    $preferences['plus'] = array(
        'type' => PARAM_INT,
        'null' => NULL_NOT_ALLOWED,
        'default' => 0,
        'choices' => array(0, 1)
    );
        $preferences['langmenu'] = array(
        'type' => PARAM_INT,
        'null' => NULL_NOT_ALLOWED,
        'default' => 1,
        'choices' => array(0, 1)
    );

    return $preferences;
}

function get_user_mycourses_preference($user) {
    // We look for the interface preference and add it to the user object.
    $pref = get_user_preferences('mycourses', false, $user->id);
    $user->mycourses = $pref;
    return $user;
}

function get_user_plus_preference($user) {
    // We look for the interface preference and add it to the user object.
    $pref = get_user_preferences('plus', false, $user->id);
    $user->plus = $pref;
    return $user;
}

function get_user_langmenu_preference($user) {
    // We look for the interface preference and add it to the user object.
    $pref = get_user_preferences('langmenu', true, $user->id);
    $user->langmenu = $pref;
    return $user;
}