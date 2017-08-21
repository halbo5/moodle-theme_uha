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
 * A two column layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');
$config = get_config('theme_uha');

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
    $colorsetid = get_user_preferences('colorset', 1, $USER->id);
    $colorset = 'colorset'.$colorsetid;
} else {
    $navdraweropen = false;
    $colorset = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
if ($colorset) {
    $extraclasses[] = $colorset;
}

$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
if ($config->firstlinkname && $config->firstlinkurl) {
    $firstlinkname = $config->firstlinkname;
    $firstlinkurl = $config->firstlinkurl;
}
if ($config->secondlinkname && $config->secondlinkurl) {
    $secondlinkname = $config->secondlinkname;
    $secondlinkurl = $config->secondlinkurl;
}
if ($config->centerlinkname && $config->centerlinkurl) {
    $centerlinkname = $config->centerlinkname;
    $centerlinkurl = $config->centerlinkurl;
}
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'firstlinkname' => $firstlinkname,
    'firstlinkurl' => $firstlinkurl,
    'secondlinkname' => $secondlinkname,
    'secondlinkurl' => $secondlinkurl,
    'centerlinkname' => $centerlinkname,
    'centerlinkurl' => $centerlinkurl
];

$templatecontext['flatnavigation'] = $PAGE->flatnav;
if (isloggedin()) {
    echo $OUTPUT->render_from_template('theme_uha/columns2', $templatecontext);
} else {
    $templatecontext['textfrontpage'] = get_config('theme_uha', 'textfrontpage');
    echo $OUTPUT->render_from_template('theme_uha/columns2_guest', $templatecontext);
}