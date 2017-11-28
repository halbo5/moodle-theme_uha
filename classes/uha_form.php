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
 * Local plugin "Expert Role" - Preference form
 *
 * @package    local_expertrole
 * @copyright  2017 Alain Bolli, <alain.bolli@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_uha;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');  // It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/lib/formslib.php');

class uha_form extends \moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        global $COURSE;

        $mform = $this->_form;

        $mform->addElement('advcheckbox',
            'enablemycourses',
            get_string('enablemycourses', 'theme_uha'),
            get_string('configenablemycourses', 'theme_uha'));
        $mform->setDefault('enablemycourses',
            get_user_preferences('mycourses', false, $this->_customdata['userid']));

        $mform->addElement('advcheckbox',
            'enableplus',
            get_string('enableplus', 'theme_uha'),
            get_string('configenableplus', 'theme_uha'));
        $mform->setDefault('enableplus',
            get_user_preferences('plus', false, $this->_customdata['userid']));

        $mform->addElement('advcheckbox',
            'enablelangmenu',
            get_string('enablelangmenu', 'theme_uha'),
            get_string('configenablelangmenu', 'theme_uha'));
        $mform->setDefault('enablelangmenu',
            get_user_preferences('langmenu', true, $this->_customdata['userid']));

        // Add some extra hidden fields.
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'course', $COURSE->id);
        $mform->setType('course', PARAM_INT);

        $this->add_action_buttons(true, get_string('savechanges'));
    }
}