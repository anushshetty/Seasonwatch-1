<?php
/**
*    The functions, required for class phpMultiLang ver.2.0
*    @package phpMultiLang
*    @author Konsantin S. Budylov
*/

/**
*    Function checks, is the file expired, or not.
*
*    @param $fname Filename.
*    @param $expire Value of expire(seconds) for check.
*    @return bool TRUE if not expired, or FALSE -if expired.
*/
function check_file_expire($fname="",$expire=0)
{
    return (file_exists($fname))?((time()<(filemtime($fname)+$expire))?true:false):false;
}

function lang_setting()
{
	$cookieName = "SWLang";
	$Lang = new phpMultiLang("language","cache");
	/*Set a root directory for language files, and directory for cache*/

	/*Assign languages with locale configurations*/
        $Lang -> AssignLanguage('en',null,array("LC_ALL","en"));
        $Lang -> AssignLanguage('ml',null,array("LC_ALL","ml"));
        $Lang -> AssignLanguage('hn',null,array("LC_ALL","hn"));
        $Lang -> AssignLanguage('kan',null,array("LC_ALL","kan"));
        $Lang -> AssignLanguage('tam',null,array("LC_ALL","tam"));
        $Lang -> AssignLanguage('tel',null,array("LC_ALL","tel"));
        $Lang -> AssignLanguage('ma',null,array("LC_ALL","ma"));

	// Adding the language data.

	//files
	
	$Lang -> AssignLanguageSource('en','en.lang',3600);
        $Lang -> AssignLanguageSource('ml','ml.lang',3600);
        $Lang -> AssignLanguageSource('hn','hn.lang',3600);
	$Lang -> AssignLanguageSource('kan','kan.lang',3600);
        $Lang -> AssignLanguageSource('tam','tam.lang',3600);
	$Lang -> AssignLanguageSource('tel','tel.lang',3600);
        $Lang -> AssignLanguageSource('ma','ma.lang',3600);
	

	//or arrays, (keys will be indexes, and values - strings)

	
	$Lang -> AssignLanguageSource('en',array("select_lang"=>"Select language"));	
        $Lang -> AssignLanguageSource('ml',array("select_lang"=>"Select language"));
	$Lang -> AssignLanguageSource('hn',array("select_lang"=>"Select language"));	
        $Lang -> AssignLanguageSource('kan',array("select_lang"=>"Select language"));
	$Lang -> AssignLanguageSource('tam',array("select_lang"=>"Select language"));	
        $Lang -> AssignLanguageSource('tel',array("select_lang"=>"Select language"));
	$Lang -> AssignLanguageSource('ma',array("select_lang"=>"Select language"));	

	//Set Cookie
	$Month = 2592000 + time();
	if(!isset($_COOKIE[$cookieName]))
		setcookie($cookieName, "en", $Month);

	//Selecting language
	if(!isset($_POST['lang']))$lang = $_COOKIE[$cookieName];
        else { $lang = $_POST['lang']; }//setcookie($cookieName, $lang, $Month); }
	if($lang == "")$lang = "en";


	//At last, we have found out, what language we shall use
	//It also we initialize
	$Lang -> SetLanguage($lang,FALSE);  //If second argument is true - the caching wil be enabled for current language

	return $Lang;
}

?>