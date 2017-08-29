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

// A description shown in the admin theme selector.
$string['choosereadme'] = 'Theme uha is a child theme of Boost. It is the theme used by Université de Haute-Alsace.';
// The name of our plugin.
$string['pluginname'] = 'UHA';
// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Right';
$string['advancedsettings'] = 'Advanced settings';
// The brand colour setting.
$string['brandcolor'] = 'Brand colour';
// The brand colour setting description.
$string['brandcolor_desc'] = 'The accent colour.';
// Name of the settings pages.
$string['configtitle'] = 'UHA settings';
// Name of the first settings tab.
$string['generalsettings'] = 'General settings';
// Preset files setting.
$string['presetfiles'] = 'Additional theme preset files';
// Preset files help text.
$string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme. See <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> for information on creating and sharing your own preset files, and see the <a href=http://moodle.net/boost>Presets repository</a> for presets that others have shared.';
// Preset setting.
$string['preset'] = 'Theme preset';
// Preset help text.
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';
// Raw SCSS setting.
$string['rawscss'] = 'Raw SCSS';
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'Raw initial SCSS';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';
$string['mycourses'] = 'My courses';
$string['textsettings'] = "Text";
$string['textfrontpage'] = "Frontpage text";
$string['textfrontpage_desc'] = "Text on the frontpage when not connected";
$string['text'] = 'Text';
$string['firstlinkname'] = "First footer link name";
$string['firstlinkname_desc'] = 'First link in the footer. Name of the link.';
$string['firstlinkurl'] = "First footer link url";
$string['firstlinkurl_desc'] = 'First link in the footer. Url of the link.';
$string['secondlinkname'] = "Second footer link name";
$string['secondlinkname_desc'] = 'Second link in the footer. Name of the link.';
$string['secondlinkurl'] = "Second footer link url";
$string['secondlinkurl_desc'] = 'Second link in the footer. Url of the link.';
$string['centerlinkname'] = "Center footer link name";
$string['centerlinkname_desc'] = 'Center link in the footer. Name of the link.';
$string['centerlinkurl'] = "Center footer link url";
$string['centerlinkurl_desc'] = 'Center link in the footer. Url of the link.';
$string['preferencetitle'] = 'Theme UHA';
$string['themepref'] = "Theme preferences";
$string['enablemycourses'] = "Activate 'My courses' menu";
$string['configenablemycourses'] = "Activate this option to display the 'My courses' menu in page header. This lets you change course without having to return to the dashboard.";
$string['enableplus'] = "Activate 'Plus' menu";
$string['configenableplus'] = "Activate this option to display the custom menu in page header. This let's you display some usefull links if you have course creation rights.";
$string['enablelangmenu'] = "Activate 'Language' menu";
$string['configenablelangmenu'] = "Activate this option to display the language menu in page header. This lets you easily change the interface language and multilingual courses. You can also change the language in your preferences.";
$string['colorset'] = "Colors set";
$string['configcolorset'] = "You can customize your interface by choosing a color theme";
$string['couleur1'] = "Default (Simple orange)";
$string['couleur2'] = "Colored (orange)";
$string['couleur3'] = "Simple (Blue)";