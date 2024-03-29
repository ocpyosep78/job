<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Helper files
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packges
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

$autoload['libraries'] = array('database', 'session');


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('date', 'common', 'recaptcha', 'excel_reader', 'url');


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array(
	'Seeker_model', 'Propinsi_model', 'Kelamin_model', 'Marital_model', 'Seeker_model', 'Seeker_Setting_model', 'Company_model', 'Editor_model', 'Jenjang_model',
	'Surat_Lamaran_model', 'Apply_model', 'Kota_model', 'Article_model', 'Article_Status_model', 'Kategori_model', 'Subkategori_model', 'Event_model', 'Widget_model',
	'Company_Post_model', 'Vacancy_model', 'Seeker_Exp_model', 'Pengalaman_model', 'Vacancy_Status_model', 'Jenis_Pekerjaan_model', 'Position_model',
	'Seeker_Summary_model', 'Industri_model', 'Membership_model', 'Company_Membership_model', 'Kategori_Tag_model', 'Subkategori_Tag_model', 'Article_Tag_model',
	'Seeker_Expert_model', 'Seeker_Education_model', 'Seeker_Language_model', 'Seeker_Reference_model', 'Seeker_Addon_model', 'Tag_model', 'Event_Tag_model',
	'Report_model', 'Subscribe_model', 'Jenis_Subscribe_model', 'News_model', 'Exam_model', 'Seeker_Subscribe_model', 'Seeker_Exam_model', 'Region_model',
	'Vacancy_Submit_Via_model'
);


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */