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
$string['choosereadme'] = 'Le theme uha est un enfant du thème Boost. C\'est le thème utilisé par l\'Université de Haute-Alsace.';
// The name of our plugin.
$string['pluginname'] = 'UHA';
// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Droite';
$string['advancedsettings'] = 'Paramètres avancés';
// The brand colour setting.
$string['brandcolor'] = 'Couleur principale';
// The brand colour setting description.
$string['brandcolor_desc'] = 'Couleur principale';
// Name of the settings pages.
$string['configtitle'] = 'UHA paramètres';
// Name of the first settings tab.
$string['generalsettings'] = 'Paramètres généraux';
// Preset files setting.
$string['presetfiles'] = 'Fichiers additionnels preset de thèmes';
// Preset files help text.
$string['presetfiles_desc'] = 'Fichiers de preset peuvent être utilisés pour changer fortement un thème. Voir <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> pour des informations sur la création et le partage de vos propres presets. Voir la <a href=http://moodle.net/boost>base de données de Presets</a> pour trouver des presets partagés par d\'autres.';
// Preset setting.
$string['preset'] = 'Preset de thème';
// Preset help text.
$string['preset_desc'] = 'Sélectionnez un preset pour modifier le look du thème.';
// Raw SCSS setting.
$string['rawscss'] = 'SCSS brut';
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Utilisez ce champ pour fournir du code SCSS ou CSS qui sera injecté à la fin de la feuille de style.';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'SCSS brut initial';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'Utilisez ce champ pour fournir du code SCSS ou CSS qui sera injecté avant tout autre chose. La plupart du temps vous utiliserez ce champ pour définir des variables.';
$string['mycourses'] = 'Mes cours';
$string['textsettings'] = "Texte";
$string['textfrontpage'] = "Texte page d'accueil ";
$string['textfrontpage_desc'] = "Texte de la page d'accueil quand on n'est pas connecté";
$string['text'] = 'Textes';
$string['firstlinkname'] = "Nom du premier lien du footer";
$string['firstlinkname_desc'] = 'Nom du premier lien du footer';
$string['firstlinkurl'] = "URL du premier lien du footer";
$string['firstlinkurl_desc'] = 'URL du premier lien du footer';
$string['secondlinkname'] = "Nom du second lien du footer";
$string['secondlinkname_desc'] = 'Nom du second lien du footer';
$string['secondlinkurl'] = "URL du second lien du footer";
$string['secondlinkurl_desc'] = 'URL du second lien du footer';
$string['centerlinkname'] = "Nom du lien au centre";
$string['centerlinkname_desc'] = 'Nom du lien au centre dans le footer';
$string['centerlinkurl'] = "Url du lien au centre";
$string['centerlinkurl_desc'] = 'URL du lien au centre  dans le footer';
$string['preferencetitle'] = 'Thème UHA';
$string['themepref'] = "Préférences du thème";
$string['enablemycourses'] = "Activer menu 'Mes cours'";
$string['configenablemycourses'] = "Cocher cette case pour afficher un menu 'Mes cours' dans l'entête de la page. Cela permet de changer de cours sans avoir à passer par le tableau de bord.";
$string['enableplus'] = "Activer menu 'Plus'";
$string['configenableplus'] = "Cocher cette case pour afficher un menu 'Plus' dans l'entête de la page. Cela permet d'afficher quelques liens utiles si vous avez des droits de création de cours.";
$string['enablelangmenu'] = "Activer menu 'Langue'";
$string['configenablelangmenu'] = "Cocher cette case pour afficher un menu 'Langues' dans l'entête de la page. Cela permet de changer facilement la langue de l'interface et des cours multilingues. Vous pouvez aussi changer la langue dans vos préférences.";
$string['colorset'] = "Jeu de couleurs";
$string['configcolorset'] = "Vous pouvez personnaliser votre interface en choisissant un jeu de couleur";
$string['couleur1'] = "Défaut (Sobre orange)";
$string['couleur2'] = "Coloré (orange)";
$string['couleur3'] = "Sobre (bleu)";
