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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');  // It must be included from a Moodle page.
}

 require_once($CFG->dirroot . "/theme/boost/classes/output/core_renderer.php");
 require_once($CFG->dirroot . "/theme/uha/lib.php");

class theme_uha_core_renderer extends \theme_boost\output\core_renderer {

    public function custom_menu($custommenuitems = '') {
        global $CFG, $USER, $DB;

        $user = $DB->get_record('user', array('id' => $USER->id));
        if ($user) {
            $usernew = get_user_plus_preference($user);
        } else {
            $usernew = new StdClass();
            $usernew->plus = 0;
        }

        if (empty($custommenuitems) && !empty($CFG->custommenuitems && $usernew->plus == 1)) {
            $custommenuitems = $CFG->custommenuitems;
        }
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }

    protected function render_custom_menu(custom_menu $menu) {

        global $PAGE, $USER, $DB;

        // Add my courses menu if user preference ok.
        $mycourses = $this->page->navigation->get('mycourses');
        $user = $DB->get_record('user', array('id' => $USER->id));
        if ($user) {
            $user = get_user_mycourses_preference($user);
            $usernew = get_user_langmenu_preference($user);
        } else {
            $usernew = new StdClass();
            $usernew->mycourses = 0;
            $usernew->langmenu = 1;
        }

        if (isloggedin() && $usernew->mycourses == 1 && $mycourses && $mycourses->has_children()) {
            $branchlabel = get_string('mycourses');
            $branchurl   = new moodle_url('/course/index.php');
            $branchtitle = $branchlabel;
            $branchsort  = 10000;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            foreach ($mycourses->children as $coursenode) {
                $branch->add($coursenode->get_content(), $coursenode->action, $coursenode->get_title());
            }
        }

        // Add lang menu if user preference ok.
        if ($usernew->langmenu == 1) {
            $langs = get_string_manager()->get_list_of_translations();
            $haslangmenu = $this->lang_menu() != '';

            if (!$menu->has_children() && !$haslangmenu) {
                return '';
            }

            if ($haslangmenu) {
                $strlang = get_string('language');
                $currentlang = current_language();
                if (isset($langs[$currentlang])) {
                    $currentlang = $langs[$currentlang];
                } else {
                    $currentlang = $strlang;
                }
                $this->language = $menu->add($currentlang, new moodle_url('#'), $strlang, 10000);
                foreach ($langs as $langtype => $langname) {
                    $this->language->add($langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
                }
            }
        }

        $content = '';
        foreach ($menu->get_children() as $item) {
            $context = $item->export_for_template($this);
            $content .= $this->render_from_template('core/custom_menu_item', $context);
        }

        return $content;
    }
}