<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('SHA_SECRET',							'raHa5!4');
define('NEGARA_INDONESIA_ID',					99);
define('APPLY_STATUS_EMPTY',					0);
define('APPLY_STATUS_OPEN',						1);
define('APPLY_STATUS_INTERVIEW',				2);
define('APPLY_STATUS_REJECT',					4);
define('APPLY_STATUS_VIEW',						5);
define('EXAM_OPEN',								1);
define('EXAM_DOWNLOAD',							2);
define('EXAM_DONE',								3);
define('ARTICLE_PUBLISH',						2);
define('VACANCY_STATUS_APPROVE',				3);
define('VACANCY_STATUS_CANCEL',					4);
define('VACANCY_STATUS_EXAM',					6);
define('VACANCY_STATUS_DONE',					7);
define('VACANCY_SUBMIT_VIA_EMAIL',				1);
define('VACANCY_SUBMIT_VIA_LINK',				2);

define('APPLY',									'apply');
define('APPLY_STATUS',							'apply_status');
define('ARTICLE',								'article');
define('ARTICLE_STATUS',						'article_status');
define('ARTICLE_TAG',							'article_tag');
define('COMPANY',								'company');
define('COMPANY_MEMBERSHIP',					'company_membership');
define('COMPANY_POST',							'company_post');
define('EDITOR',								'editor');
define('EVENT',									'event');
define('EVENT_TAG',								'event_tag');
define('EXAM',									'exam');
define('EXAM_STATUS',							'exam_status');
define('INDUSTRI',								'industri');
define('JENIS_PEKERJAAN',						'jenis_pekerjaan');
define('JENIS_SUBSCRIBE',						'jenis_subscribe');
define('JENJANG',								'jenjang');
define('KATEGORI',								'kategori');
define('KATEGORI_TAG',							'kategori_tag');
define('KELAMIN',								'kelamin');
define('KOTA',									'kota');
define('MARITAL',								'marital');
define('MEMBERSHIP',							'membership');
define('NEGARA',								'negara');
define('NEWS',									'news');
define('PENGALAMAN',							'pengalaman');
define('POSITION',								'position');
define('PROPINSI',								'propinsi');
define('REPORT',								'report');
define('SEEKER',								'seeker');
define('SEEKER_ADDON',							'seeker_addon');
define('SEEKER_EDUCATION',						'seeker_education');
define('SEEKER_EXAM',							'seeker_exam');
define('SEEKER_EXP',							'seeker_exp');
define('SEEKER_EXPERT',							'seeker_expert');
define('SEEKER_LANGUAGE',						'seeker_language');
define('SEEKER_REFERENCE',						'seeker_reference');
define('SEEKER_SETTING',						'seeker_setting');
define('SEEKER_SUBSCRIBE',						'seeker_subscribe');
define('SEEKER_SUMMARY',						'seeker_summary');
define('SUBSCRIBE',								'subscribe');
define('SUBKATEGORI',							'subkategori');
define('SUBKATEGORI_TAG',						'subkategori_tag');
define('SURAT_LAMARAN',							'surat_lamaran');
define('TAG',									'tag');
define('VACANCY',								'vacancy');
define('VACANCY_STATUS',						'vacancy_status');
define('WIDGET',								'widget');


/* End of file constants.php */
/* Location: ./application/config/constants.php */