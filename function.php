<?php
session_start();function head(){include('header.php');}function foot(){include('footer.php');}function curl($u,$p1=''){$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$u);curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);$r=curl_exec($ch);curl_close($ch);if($p1=='json_decode')$r=json_decode($r,true);return $r;}function urltofile($url){return preg_replace('/[^a-zA-Z0-9]+/','',$url);}function redirect($page=''){($page)?header("Location: ".(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'?"https":"http")."://".$_SERVER['HTTP_HOST'].(dirname($_SERVER['PHP_SELF'])=="\\"?"/":(dirname($_SERVER['PHP_SELF'])=="/"?"/":dirname($_SERVER['PHP_SELF'])."/")).$page.'.php'):header("Location: ".(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'?"https":"http")."://".$_SERVER['HTTP_HOST'].(dirname($_SERVER['PHP_SELF'])=="\\"?"/":(dirname($_SERVER['PHP_SELF'])=="/"?"/":dirname($_SERVER['PHP_SELF'])."/")));}function host($name='',$val=''){$host=json_decode(file_get_contents('db/site/host.json'),true);if($val){$host[$name]=$val;file_put_contents('db/site/host.json',json_encode($host));};if($name)return $host[$name];else return $host;}function siteinfo($key){if(is_array($key)){$siteinfo=json_decode(file_get_contents('db/site/siteinfo.json'),true);foreach($key as $ky=>$val)if(isset($ky))$siteinfo[$ky]=$val;file_put_contents('db/site/siteinfo.json',json_encode($siteinfo));return;}if($key=='url')return(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'?"https":"http")."://".$_SERVER['HTTP_HOST'].(dirname($_SERVER['PHP_SELF'])=="\\"?"/":(dirname($_SERVER['PHP_SELF'])=="/"?"/":dirname($_SERVER['PHP_SELF'])."/"));if($key&&$siteinfo=json_decode(file_get_contents('db/site/siteinfo.json'),true))if(isset($siteinfo[$key]))return $siteinfo[$key];return false;}function ads($p){if(siteinfo('ads_'.$p)&&userActive()){return '<div class="alert warning response medium center">Ads & Anti Adblock is hidden when you logged in</div>';}return siteinfo('ads_'.$p);}function userActive($user=''){if($user=='logout'){session_unset();session_destroy();return;}if($user)return $_SESSION["user"]=$user;return isset($_SESSION["user"])&&$_SESSION["user"]?$_SESSION["user"]:false;}function get_drive_id($string){$string=preg_replace('#/u/\d+?/#','/',$string);if(strpos($string,"/edit")||strpos($string,"/preview")){$string=preg_replace("#(/edit|/preview)#","/view",$string);}else if(strpos($string,"?id=")||strpos($string,"&id=")){$parts=parse_url($string);parse_str($parts['query'],$query);return $query['id'];}else if(!strpos($string,"/view")){$string=$string."/view";}$start="file/d/";$end="/view";$string=" ".$string;$ini=strpos($string,$start);if($ini==0){return "";}$ini+=strlen($start);$len=strpos($string,$end,$ini)-$ini;return substr($string,$ini,$len);}function user($key,$val=''){$userinfo=json_decode(file_get_contents('db/user/admin.json'),true);if($val){$userinfo[$key]=$val;if($key=='user')userActive($val);file_put_contents('db/user/admin.json',json_encode($userinfo));}else return $userinfo[$key];}function page($url=''){if($url)return str_replace('.php','',basename($url));return str_replace('.php','',basename($_SERVER['PHP_SELF']));}function anti_adblock($e='test'){if(userActive())return;if($e=='checker'&&siteinfo('anti_adblock'))echo '<script>if (window.tidakAdaPenghalangAds === undefined) {document.getElementById("dl").parentNode.innerHTML = "<div class=\"alert danger\">Please Disable Your <strong>Adblock</strong></div>";}</script>';if(siteinfo('anti_adblock'))echo '<script src="'.siteinfo('url').'lib/adsbygoogle.js?v='.date('his').'"></script>';}function get($p){return(isset($_GET[$p])&&$_GET[$p]?$_GET[$p]:false);}function remove($t){if(is_dir($t)){$files=glob($t.'*',GLOB_MARK);foreach($files as $file){remove($file);}if(file_exists($t))rmdir($t);}elseif(is_file($t)){unlink($t);}}function byteformat($s){$prefix=" B";if($s>1000){$s=$s/1024;$prefix=" KB";}if($s>1000){$s=$s/1024;$prefix=" MB";}if($s>1000){$s=$s/1024;$prefix=" GB";}if($prefix==" KB")$s=round($s);if($prefix==" MB")$s=round($s);if($prefix==" GB")$s=round($s,1);return $s.$prefix;}function encoder($string,$action='e',$secret_key='',$secret_iv=''){if(strpos(strtolower($string),"drive.google.com")!==false){$string="https://drive.google.com/file/d/".get_drive_id($string);}$secret_key=siteinfo('secret_key');$secret_iv=siteinfo('secret_iv');$output=false;$encrypt_method="AES-256-CBC";$key=hash('sha256',$secret_key);$iv=substr(hash('sha256',$secret_iv),0,16);if($action=='e'){$output=base64_encode(openssl_encrypt($string,$encrypt_method,$key,0,$iv));}else if($action=='d'){$output=openssl_decrypt(base64_decode($string),$encrypt_method,$key,0,$iv);}return $output;}function errorinfo($host='',$key='',$val=''){$error_message=json_decode(file_get_contents('db/site/error_message.json'),true);if(is_array($host)){json_encode(file_get_contents('db/site/error_message.json'));}if($host&&$key&&isset($error_message[$host][$key]))return $error_message[$host][$key];if($host&&isset($error_message[$host]))return $error_message[$host];return $error_message;}if(page()=='login'){$response_warning='<b>Admin</b> only no Register';if(userActive())(isset($_GET["logout"]))?userActive('logout'):redirect('manage');elseif(isset($_POST)&&$_POST){if(isset($_POST["user"])&&isset($_POST["pass"])&&!isset($_GET["logout"])){if(user('pass')==$_POST['pass']){userActive($_POST["user"]);redirect('manage');}else $response_danger="Wrong Username or Password";}}elseif(file_exists("installer.php")){if(userActive())session_destroy();redirect('installer');}}if(page()=='manage'){if(!userActive())redirect('login');if(isset($_POST)&&$_POST){if(isset($_POST['error'])){print_r($_POST['error']);}else{siteinfo($_POST);}$response_success='Saved';}}if(page()=='settings'){if(!userActive())return redirect('login');if(isset($_POST['useredit'])){if($_POST['user']&&user('user')!=$_POST['user'])user('user',$_POST['user']);if($_POST["pass"]&&$_POST["repass"])if($_POST["pass"]==$_POST["repass"])user('pass',$_POST['pass']);else $response_danger="<b>Password</b> didn't match";$response_success='Saved';}if(isset($_POST['siteedit'])){siteinfo($_POST);$response_success='Saved';}$updates=[];$updates['current']='';$updates['date']='';$updates['new']='';if(file_exists('version.json')){$updates['current']=json_decode(file_get_contents('version.json'),true);$updates['date']=$updates['current']['date'];$updates['current']['updates']=implode('',preg_filter('/^(.+)$/','<p>- $1</p>',$updates['current']['updates']));$current='';foreach($updates['current']as $key=>$val){$current.="<p><b>$key:</b> <span>$val</span></p>";}$updates['current']=$current;}if(isset($_POST['check_update'])){$version=curl("https://raw.githubusercontent.com/roymanID/roydirect/master/version.txt",'json_decode');if(isset($version['date'])&&str_replace('/','',$version['date'])>str_replace('/','',$updates['date'])){$updates['new']=$version;$updates['new']['updates']=implode('',preg_filter('/^(.+)$/','<p>- $1</p>',$updates['new']['updates']));unset($updates['new']['key']);$new='';foreach($updates['new']as $key=>$val){$new.="<p><b>$key:</b> <span>$val</span></p>";}$updates['new']=$new;}else $response_warning='No Updates Available';}}function response_status(){global $response_danger,$response_warning,$response_success;if(isset($response_danger)&&$response_danger)echo '<div class="alert danger response">'.$response_danger.'</div>';if(isset($response_warning)&&$response_warning)echo '<div class="alert warning response">'.$response_warning.'</div>';if(isset($response_success)&&$response_success)echo '<div class="alert success response">'.$response_success.'</div>';}function getToken($length){$token="";$codeAlphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ";$codeAlphabet.="abcdefghijklmnopqrstuvwxyz";$codeAlphabet.="0123456789";$max=strlen($codeAlphabet);for($i=0;$i<$length;$i++){$token.=$codeAlphabet[rand(0,$max-1)];}return $token;}if(page()=='dl'||page()=='embed'){$file=[];$file['id']=get('id');$file['name']='';$file['size']='';$file['download']='';$file['error']='';$file['type']='';$file['down_type']=get('type');if($file['down_type']==0||siteinfo('direct_link'))$file['down_type']="button";else if($file['down_type']==1)$file['down_type']="direct";else if($file['down_type']==2)$file['down_type']="countdown";else $file['down_type']="button";if($file['id']||get('short')){$file['url']=encoder($file['id'],'d');if(get('short')&&file_exists('db/link/short/'.get('short').'.txt')){$file['url']=file_get_contents('db/link/short/'.get('short').'.txt');}$file['host']=(isset(parse_url($file['url'])['host'])?parse_url($file['url'])['host']:'Not Found');if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i',$file['host'],$regs)){$file['host']=$regs['domain'];}if($file['host']!='Not Found'&&file_exists('host/'.$file['host'].'.php')){if(host($file['host'])=='online'&&(page()!='embed'||siteinfo('video_embed'))){include 'host/'.$file['host'].'.php';}else if(host($file['host'])=='offline'){$file['error']='Url not supported';}else $file['error']=host($file['host']);if($file['error']=='Google Drive is not supported. Google has block this script'){$file['error'].='</br>Please download from this <a href="'.$file['url'].'">link</a>';}if($file['name']){if(!$file['type']){$file['type']=explode('.',$file['name']);$file['type']=strtolower(end($file['type']));}if(in_array($file['type'],array('webm','mpg','mp2','mpeg','mpe','mpv','ogg','mp4','m4p','m4v','avi','wmv','mov','qt','flv','swf','avchd','mkv','x-matroska'))){$file['type']='video';}}}if($file['down_type']=="direct"&&!$file['error']){header("Location: ".$file['download']);}}}
?>