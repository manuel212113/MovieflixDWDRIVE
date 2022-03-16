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

 
class GDrive extends App
{
    protected $proxy;
    public $authUser = false;
    protected $id;
    protected $source;
    protected $cookiz;
    protected $relrd = 0;
    protected $tbl = 'drive_auth';
    protected $error = '';
    protected $key = 'lolypop';

    public function __construct($id = '')
    {
        if ($p = Proxy::getOne())
        {
            $this->proxy = $p;
        }
        if (!empty($id)) $this->id = $id;

        $this->setAuth();
    }

    public function get($id = '')
    {
        if (!empty($id)) $this->id = $id;
        return $this->getSources();

    }

    protected function getSources($reloads = 0)
    {
        $url = "https://docs.google.com/get_video_info?docid=" . $this->id;

        $isAuth = false;
        $cookies = [];
        $sources = [];
        $title = '';
        if (isset($this->authUser['access_token']) && !empty($this->authUser['access_token']))
        {
            $token = json_decode($this->authUser['access_token'], true);
            $isAuth = true;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, Main::getUserAgent());
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, ROOT . '/data/cache/cookie~' . $this->key . '.txt');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        if ($isAuth)
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: " . $token['token_type'] . ' ' . $token['access_token']
            ));
        }
        if (!empty($this->proxy))
        {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, self::$config['proxyUser'] . ':' . self::$config['proxyPass']);
            if (Proxy::isSocks($this->proxy))
            {
                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            }
        }

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if (empty($result) || $info["http_code"] != "200")
        {
            if ($info["http_code"] == "200")
            {

                $error = "cURL Error (" . curl_errno($ch) . "): " . (curl_error($ch) ? : "Unknown");
            }
            else
            {
                $error = "Error Occurred (" . $info["http_code"] . ")";
            }
        }
        else
        {

            $header = substr($result, 0, $info["header_size"]);
            $result = substr($result, $info["header_size"]);
            preg_match_all("/^Set-Cookie:\\s*([^=]+)=([^;]+)/mi", $header, $cookie);
            foreach ($cookie[1] as $i => $val)
            {
                $cookies[] = $val . "=" . trim($cookie[2][$i], " \n\r\t");
            }

            parse_str($result, $fileData);

            if ($fileData['status'] == 'ok')
            {
                $streams = explode(',', $fileData['fmt_stream_map']);
                foreach ($streams as $stream)
                {
                    list($quality, $link) = explode("|", $stream);
                    $fmt_list = array(
                        '37' => "1080",
                        '22' => "720",
                        '59' => "480",
                        '18' => "360",
                    );
                    if (array_key_exists($quality, $fmt_list))
                    {
                        $quality = $fmt_list[$quality];
                        $sources[$quality] = ['file' => $link, 'quality' => $quality, 'type' => 'video/mp4', 'size' => 0];
                    }

                }
                if (isset($fileData['title']))
                {
                    $title = $fileData['title'];
                }

            }
            else
            {
                // $error = $fileData['reason'];
                $error = 'This Video is unavailable !';
            }

        }

        if (empty($error))
        {

            return ['title' => $title, 'data' => ['sources' => $sources, 'cookies' => $cookies]];
        }
        else
        {

            if ($reloads < 1)
            {
                return $this->getSources($reloads + 1);
            }

            $this->error = $error;
        }

        return '';

    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getError()
    {
        return $this->error;
    }

    public function hasError()
    {
        if (!empty($this->error))
        {
            return true;
        }
        return false;
    }

    protected function setAuth()
    {

        $this->setAccount();
        if ($this->authUser)
        {
            if (!$this->isTokenValid())
            {
                if ($this->relrd < 2)
                {
                    $this->reloadToken();
                }

            }
        }

    }

    protected function isTokenValid()
    {
        if (!empty($this->authUser['access_token']))
        {
            $lastUpdated = $this->authUser['updated_at'];
            $timeFirst = strtotime($lastUpdated);
            $timeSecond = strtotime(Main::tnow());
            $differenceInSeconds = $timeSecond - $timeFirst;

            if ($differenceInSeconds < 3500 && $differenceInSeconds > 1)
            {
                return true;
            }

        }
        return false;

    }

    protected function updateToken($token)
    {
        self::$db->where('id', $this->authUser['id']);
        self::$db->update($this->tbl, ['access_token' => $token, 'updated_at' => Main::tnow() ]);
    }

    protected function reloadToken()
    {
        $userData = ['client_id' => $this->authUser['client_id'], 'client_secret' => $this->authUser['client_secret'], 'refresh_token' => $this->authUser['refresh_token'], 'grant_type' => 'refresh_token'];

        session_write_close();
        usleep(rand(1000000, 1500000));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.googleapis.com/oauth2/v4/token',
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($userData) ,
            CURLOPT_USERAGENT => Main::getUserAgent() ,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (!$err)
        {
            $result = json_decode($response, true);
            if (!isset($result['error']))
            {
                $tokenInfo = $result;
            }
            else
            {
                $this->error = 'gdrive_access_token ' . $result['error'] . ' => ' . $result['error_description'];
            }
        }
        else
        {
            $this->error = 'gdrive_access_token ' . $status . ' => ' . $err;
        }

        if (isset($tokenInfo))
        {
            if (isset($tokenInfo['expires_in'])) unset($tokenInfo['expires_in']);
            if (isset($tokenInfo['scope'])) unset($tokenInfo['scope']);

            $tokenInfo = json_encode($tokenInfo);

            $this->updateToken($tokenInfo);
            $this->authUser['access_token'] = $tokenInfo;

        }
        else
        {
            $this->broken();
            $this->relrd += 1;
            $this->setAuth();
        }

    }

    protected function broken()
    {
        $this->updateToken('');
        $this->authUser['access_token'] = '';
        self::$db->where('id', $this->authUser['id']);
        self::$db->update($this->tbl, ['status' => 1]);
    }

    protected function setAccount()
    {
        self::$db->where('status', 0);
        $users = self::$db->get($this->tbl);
        if (self::$db->count > 0)
        {

            $this->authUser = $users[array_rand($users) ];
        }
    }

}

