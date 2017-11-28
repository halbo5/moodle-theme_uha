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
 * Theme UHA
 *
 * @package    theme_uha
 * @copyright  2017 Alain Bolli, <alain.bolli@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . "/../../config.php");
require_login();

require_once($CFG->dirroot.'/user/editlib.php');

$userid = optional_param('id', $USER->id, PARAM_INT);    // User id.
$courseid = optional_param('course', SITEID, PARAM_INT);   // Course id (defaults to Site).

$PAGE->set_url('/theme/uha/pref.php', array('id' => $userid, 'course' => $courseid));

list($user, $course) = useredit_setup_preference_page($userid, $courseid);

// Create form.
$courseform = new theme_uha\uha_form(null, array('userid' => $user->id));

$courseform->set_data($user);

$redirect = new moodle_url("/user/preferences.php", array('userid' => $user->id));
if ($courseform->is_cancelled()) {
    redirect($redirect);
} else if ($data = $courseform->get_data()) {

    useredit_update_user_preference(['id' => $user->id,
        'preference_mycourses' => $data->enablemycourses]);
    useredit_update_user_preference(['id' => $user->id,
        'preference_plus' => $data->enableplus]);
    useredit_update_user_preference(['id' => $user->id,
        'preference_langmenu' => $data->enablelangmenu]);
    redirect($redirect);
}

// Display page header.
$strpref = get_string('preferencetitle', 'theme_uha');
$userfullname = fullname($user, true);

// Display breadcrumb.
$PAGE->navbar->ignore_active();
$url = new moodle_url('/user/preferences.php', array('userid' => $userid));
$navbar = $PAGE->navbar->add(get_string('preferences', 'moodle'), $url);
$PAGE->navbar->add($strpref, new moodle_url('/theme/uha/pref.php', array('userid' => $userid)));

$PAGE->set_title("$course->shortname: $strpref");
$PAGE->set_heading($userfullname);

echo $OUTPUT->header();
echo $OUTPUT->heading($strpref);

// Finally display THE form.
$courseform->display();

// And proper footer.
echo $OUTPUT->footer();
