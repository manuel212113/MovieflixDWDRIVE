<?php

/**
 * ====================================================================================
 *                           Google Drive Proxy Player (c) CodySeller
 * ----------------------------------------------------------------------------------
 * @copyright This software is exclusively sold at codester.com. If you have downloaded this
 *  from another site or received it from someone else than me, then you are engaged
 *  in an illegal activity. You must delete this software immediately or buy a proper
 *  license from https://www.codester.com/codyseller?ref=codyseller.
 *
 *  Thank you for your cooperation and don't hesitate to contact me if anything :)
 * ====================================================================================
 *
 * @author CodySeller (http://codyseller.com)
 * @link http://codyseller.com
 * @license http://codyseller.com/license
 */


class Main extends App
{
    
    protected static $url = '';

    public static function url() {
        if (empty(self::$url)) {
            return self::$config["url"];
        } else {
            return self::$url;
        }
    }

    public static function set($meta, $value) {
        if (!empty($value)) {
            self::$$meta = $value;
        }
    }

    public static function clean($data) {
        // Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
        // we are done...
        return trim($data);
    }

    public static function isUrl($url) {
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url) && filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }

    public static function redirect($url = '', $fullurl = FALSE, $message = array(), $header = "") {
        if (!empty($message)) {
            $_SESSION["msg"] = self::clean("{$message[0]}::{$message[1]}", 2);
        }
        switch ($header) {
            case '301':
                header('HTTP/1.1 301 Moved Permanently');
            break;
            case '404':
                header('HTTP/1.1 404 Not Found');
            break;
            case '503':
                header('HTTP/1.1 503 Service Temporarily Unavailable');
                header('Status: 503 Service Temporarily Unavailable');
                header('Retry-After: 60');
            break;
        }
        if ($fullurl) {
            header("Location: $url");
            exit;
        }
        header("Location: " . PROOT . "/$url");
        exit;
    }


    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    public static function uploadImg($name, $temp_name, $dir = "/uploads/") {
        $filename = strtolower(str_replace(' ', '_', $name));
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "ico" => "image/ico", "svg" => "image/svg", "png" => "image/png", "gif" => "image/gif");
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (array_key_exists($ext, $allowed)) {
            move_uploaded_file($temp_name, ROOT . $dir . $filename);
            return $filename;
        }
        return false;
    }


    public static function tnow()
    {
        $dt = new DateTime("now");
        return $dt->format('Y-m-d H:i:s');
    }

    public static function getUserAgent()
    {
        $ua ='Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36';
        return $ua;
    }


    public static function isDrive($url) 
    {
        if (strpos($url, 'drive.google.com/file/d/') !== false) 
        {
            $gId = self::getDriveId($url);
        }
        return (!empty($gId)) ? true : false;
    }

    public static function getDriveId($url) 
    {
        $path = explode('/', parse_url($url) ['path']);
        return (isset($path[3]) && !empty($path[3])) ? $path[3] : '';
    }


    public static function isOneDrive($url) 
    {
        if (strpos($url, '1drv.ms') !== false || strpos($url, 'my.sharepoint.com') !== false) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public static function isPhoto($url) 
    {
        //only allowed short url
        if (strpos($url, 'photos.app.goo.gl') !== false)
        {
            return true;
        }
        return false;
    }

    public static function isDirect($url) {
        //only allowed short url
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $allowedExt = ['mp4','m4a','mov','3GP','ogg','wmv','webm','avi'];
        if(!empty($ext))
        {
            if(in_array($ext, $allowedExt))
            {
                return true;
            }
        }
        
        return false;
    }


    public static function getLinkType($url) {
        if (self::isDrive($url))
        {
            return 'GDrive';
        } 
        elseif (self::isPhoto($url)) 
        {
            return 'GPhoto';
        }
        elseif (self::isDirect($url))
        {
            return 'Direct';
        } 
        elseif (self::isOneDrive($url))
        {
            return 'OneDrive';
        } 
        else
        {
            return false;
        }
    }

    public static function random($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++) {
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }


    public static function slugify($text)
    {
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = preg_replace('~[^-\w]+~', '', $text);
      $text = trim($text, '-');
      $text = preg_replace('~-+~', '-', $text);
      if (empty($text)) {
        return self::random();
      }
      return $text;
    }

    public static function getHost() 
    {
        if (isset($_SERVER['HTTP_HOST'])) 
        {
            $host = $_SERVER['HTTP_HOST'];
        } 
        else 
        {
            $host = $_SERVER['SERVER_NAME'];
        }
        return trim($host);
    }

    public static function getDomain()
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . self::getHost();
    }

    public static function getPlyrLink($id = '')
    {
        return self::getDomain() . PROOT . '/' . self::$config['playerSlug'] . '/' . $id;
    }

    public static function getStreamLink($id = '', $q = '')
    {
        if(empty($q)) $q = 360;
        return self::getDomain() . PROOT . '/stream/'.$q.'/' . $id . '.mp4';
    }

    public static function getDownloadLink($id = '')
    {
        return self::getDomain() . PROOT . '/' . self::$config['downloadSlug'] . '/' . $id;
    }
    public static function getEmbedCode($url)
    {
        return'<iframe src="'.$url.'" frameborder="0" allowFullScreen="true" width="640" height="320"></iframe>';
    }

    public static function getOneDrive($link) {

        $err = 0;
    

        if (strpos($link, 'my.sharepoint.com') !== false) {
            $link = $link . '&download=1';
            $ls = self::getLinkStatus($link);
          
            if($ls == 404)
            { 
                $err = 1;
            }
           
        } else {
            if (filter_var($link, FILTER_VALIDATE_URL) !== FALSE && strpos($link, "1drv.ms") !== false) {
                $link = strtok($link, "?");
                $link = @file_get_contents(str_replace('?txt', '', str_replace('1drv.ms', '1drv.ws', $link)) . '?txt');
                if(strpos($link, 'login.live.com') !== false)
                {
                    $err = 1;
                }
            }
            else
            {
                $err = 1;
            }
        }
        

        if(empty($err))
        {
           
            $link =  PROOT . '/stream/k/' . base64_encode(urlencode($link)) . '/onedrive';
         
            return $link;
        }
        else
        {
            return false;
        }
       
     
    }


    public static function getLinkStatus($link)
    {
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_exec($ch);
        $sc =  curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $sc;

    }
    public static function getQulities($data) {
        $data = json_decode($data, true);
        $q = array_keys($data['sources']);
        return $q;
    }

    public static function getData($file) {

            $qulities = self::getQulities($file['data']);
            $slug = $file['slug'];
            $links = [];
            foreach ($qulities as $q) {
                $f = PROOT . "/stream/{$q}/{$slug}/gdrive";
                // $links[] = '{"label":"' . $q . 'p","type":"video\/mp4","file":"' . $f . '"}';
                $links[] = [
                    'file' => $f,
                    'q' => $q
                ];
            }
            // $links = '[' . implode(',', $links) . ']';
            return $links;

    }

    public static function getGPhotos($url) 
    {
        $error = 0;
        $content = self::curl($url);
        $checkLink = preg_match('/photos.google.com\/share\/.*\/photo\/.*/', $url, $match);
        if ($checkLink) 
        {
            $__decodedSource = rawurldecode($content);
            preg_match_all('/https:\/\/(.*?)=m(22|18|37)/', $__decodedSource, $matched);
            if(isset($matched[2]))
            {
                foreach ($matched[2] as $v) 
                {
                    switch ($v) 
                    {
                        case '18':
                            $__a[360] = [
                                'file' =>  'https://'.$matched[1][0] .'=m18',
                                'q' => '360'
                            ];
                        break;
                        case '22':
                            $__a[720] = [
                                'file' =>  'https://'.$matched[1][0] .'=m22',
                                'q' => '720'
                            ];
                        break;
                        case '37':
                            $__a[1080] = [
                                'file' =>  'https://'.$matched[1][0] .'=m37',
                                'q' => '1080'
                            ];
                        break;
                    }
                }
                krsort($__a);
                $res = implode(',', $__a);
                $sources = '[' . $res . ']';
                $isOx = preg_match('/\[\]/', $sources, $match);
                if ($isOx) 
                {
                    $error = 1;
                }
            }
            else
            {
                $error = 1;
            }

        } 
        else 
        {
            preg_match('/<meta property="og:image" content="(.*?)\=.*">/', $content, $matched);
            if(isset($matched[1]))
            {
                $q__360p = trim($matched[1] . '=m18');
                $q__720p = trim($matched[1] . '=m22');
                $q__1080p = trim($matched[1] . '=m37');
                if (self::isI($q__1080p) != 404) 
                {
                    $sources = [
                        [
                            'file' => self::getGPhotoURI($q__360p),
                            'q' => '360'
                        ],
                        [
                            'file' => self::getGPhotoURI($q__720p),
                            'q' => '720'
                        ],
                        [
                            'file' => self::getGPhotoURI($q__1080p),
                            'q' => '1080'
                        ]
                    ];
                } 
                else if (self::isI($q__720p) != 404) 
                {
                
                    $sources = [
                        [
                            'file' => self::getGPhotoURI($q__360p),
                            'q' => '360'
                        ],
                        [
                            'file' => self::getGPhotoURI($q__720p),
                            'q' => '720'
                        ]

                    ];
                
                } 
                else if (self::isI($q__360p) != 404) 
                {
                    $sources = [
                        [
                            'file' => self::getGPhotoURI($q__360p),
                            'q' => '360'
                        ]
                    ];
                }
                 else 
                 {
                    $error = 1;
                 }
            }
            else 
            {
            $error = 1;
            }

        }

        if(empty($error))
        {
            $sources = json_decode(str_replace('lh3.googleusercontent.com', '3.bp.blogspot.com', json_encode($sources)), true);
            return $sources;
        }

        return false;
    }

    public static function getGPhotoURI($tag ='') {
        if(!empty($tag)) $tag = base64_encode($tag);
        return PROOT . '/stream/k/'.$tag.'/gphoto';
    }

    public static function makePlyrFile($data, $plyr ='jw')
    {
       $sources = [];

       foreach($data as $d)
       {
           if($plyr == 'plyr')
           {
            $sources[] = "{ src: '".$d['file']."',type: 'video/mp4', size: ".$d['q']." }";
           }
           else
           {
            $sources[] = " {'label':'" . $d['q'] . "p','type':'video\/mp4','file':'" . $d['file'] . "'}";
           }
           
       }
    
       $sources  = '[' . implode(',', $sources) . ']';
       return $sources;
    }



    public static function isI($url) 
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_USERAGENT, self::getUserAgent());
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_exec($ch);
        $info = curl_getinfo($ch);
        return $info["http_code"];
    }

    public static function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, self::getUserAgent());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch,CURLOPT_ENCODING , 'gzip');
        curl_setopt($ch,CURLOPT_CAINFO, NULL);
        curl_setopt($ch,CURLOPT_CAPATH, NULL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    public  static function getDL($gurl)
    {

        $headers = [
            'accept-encoding: gzip, deflate, br',
            'content-length: 0',
            'content-type: application/x-www-form-urlencoded;charset=UTF-8',
            'origin: https://drive.google.com',
            'referer: https://drive.google.com/drive/my-drive',
            'x-drive-first-party: DriveWebUi',
            'x-json-requested: true'
        ];
        $gid = self::getDriveId($gurl);

        $ch = curl_init("https://drive.google.com/uc?id=$gid&authuser=0&export=download");
        curl_setopt($ch, CURLOPT_USERAGENT, self::getUserAgent());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, []);
        curl_setopt($ch, CURLOPT_ENCODING,  'gzip,deflate');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $result = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($statusCode == '200') { 
            $res = json_decode(str_replace(')]}\'', '', $result), true);
            return $res;
        }
    
        return false;


    }




    public static function getSubTrack($sub , $plyr = 'jw')
    {
        if(!empty($sub))
        {
            $sub = '[' . $sub .']';
            if($plyr == 'plyr')
            {
                $subArr = json_decode($sub, true);
                $sub = [];
                if($subArr)
                {
                    foreach($subArr as $k => $s)
                    {
                        $d = $k == 0 ? true : false;
                        $sub[] = "{'kind' : 'captions','label' : '".$s['label']."', 'src' : '".$s['file']."','default' : '".$d."'}";
                    }
                }
                $sub = '[' . implode(',', $sub) .']';
            }
        
            return $sub;
        }
        return '[]';
    }


    public static function getDownloadLinks($file)
    {
        $data = json_decode($file['data'], true);
        $links = [];

        $qualities = array_keys($data['sources']);

        foreach($qualities as $q)
        {
            $links[$q] = self::getDownloadLink() . $file['slug'] . '/' . $q;
        }

        return $links;
    }



    public static function dateFormat($date)
    {
        return date("j-M-Y", strtotime($date));
    }

    public static function getTimeZoneList() 
    {
        return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    }


    public static function sanitized($str) 
    {
        return htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
    }
    public static function unsanitized($str) 
    {
        return html_entity_decode($str, ENT_QUOTES, 'UTF-8');
    }


    public static function getVInfo($url, $key)
    {
        $headers = [];

        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Pragma: no-cache';
        
        session_write_close();
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, self::getUserAgent());
        curl_setopt($ch, CURLOPT_COOKIEFILE, ROOT  . '/data/cache/cookie~'.$key.'.txt');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_BUFFERSIZE, 8192);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_exec($ch);
        $fsize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $ftype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        return [
            'fsize' => $fsize,
            'ftype' => $ftype
        ];

    }

    public static function getOS() { 

    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}


                  

}