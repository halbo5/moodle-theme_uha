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
namespace theme_uha\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;
use core_completion\progress;

require_once($CFG->dirroot . '/blocks/myoverview/lib.php');
require_once($CFG->libdir . '/completionlib.php');

/**
 * Class containing data for my overview block.
 *
 * @copyright  2017 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_myoverview_main extends \block_myoverview\output\main {

    /**
     * @var string The tab to display.
     */
    public $tab;

    /**
     * Constructor.
     *
     * @param string $tab The tab to display.
     */
    public function __construct() {
        if (!$tab = optional_param('myoverviewtab', null, PARAM_ALPHA)) {
            // Check if the user has no preference, if so get the site setting.
            if (!$tab = get_user_preferences('block_myoverview_last_tab')) {
                $config = get_config('block_myoverview');
                $tab = $config->defaulttab;
            }
        }
        $this->tab = $tab;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param \renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $USER;

        $courses = enrol_get_my_courses('*', 'fullname ASC');
        $coursesprogress = [];

        foreach ($courses as $course) {

            $completion = new \completion_info($course);

            // First, let's make sure completion is enabled.
            if (!$completion->is_enabled()) {
                continue;
            }

            $percentage = progress::get_course_progress_percentage($course);
            if (!is_null($percentage)) {
                $percentage = floor($percentage);
            }

            $coursesprogress[$course->id]['completed'] = $completion->is_course_complete($USER->id);
            $coursesprogress[$course->id]['progress'] = $percentage;
        }

        $coursesview = new \theme_uha\output\block_myoverview_courses_view($courses, $coursesprogress);
        $nocoursesurl = $output->image_url('courses', 'block_myoverview')->out();
        $noeventsurl = $output->image_url('activities', 'block_myoverview')->out();

        // Now, set the tab we are going to be viewing.
        $viewingtimeline = false;
        $viewingcourses = false;
        if ($this->tab == BLOCK_MYOVERVIEW_TIMELINE_VIEW) {
            $viewingtimeline = true;
        } else {
            $viewingcourses = true;
        }

        return [
            'midnight' => usergetmidnight(time()),
            'coursesview' => $coursesview->export_for_template($output),
            'urls' => [
                'nocourses' => $nocoursesurl,
                'noevents' => $noeventsurl
            ],
            'viewingtimeline' => $viewingtimeline,
            'viewingcourses' => $viewingcourses
        ];
    }
}
