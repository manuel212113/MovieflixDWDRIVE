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

class Stream extends App
{

    protected $url;
    protected $cookiz;
    protected $type;
    protected $method;
    protected $statusCode;
    protected $isDownload = false;
    protected $headers = [];
    protected $fileName;
    protected $d = false;
    protected $isHit = false;
    protected $meta = [];
    protected $key = '';

    public function __construct()
    {

        $this->method = self::$config['streamMethod'];
        $this->statusCode = 403;

    }

    public function load($url, $cookiz = '')
    {

        $this->url = $url;
        $this->cookiz = $cookiz;
        $this->checkDriveLink();

        // $this->setHeaders();
        
    }

    public function setKey($k)
    {
        $this->key = $k;
    }

    public function isOk()
    {
        if (!empty($this->statusCode) && $this->statusCode != 403) return true;

        return false;
    }

    public function __download($fileName = '')
    {
        if (!empty($fileName))
        {
            $fileName = self::$config['downloadPrefix'] . pathinfo($fileName, PATHINFO_FILENAME);
        }
        else
        {
            if (empty(self::$config['downloadPrefix']))
            {
                $fileName = 'gdplyr_';
            }
            else
            {
                $fileName = self::$config['downloadPrefix'];
            }
        }
        $this->fileName = $fileName;

        $this->isDownload = true;
        $this->start();
        exit;
    }

    public function start($url = '')
    {

        if ($url == 'default') $url = self::$config['defaultVideo'];

        if ($this->isDownload)
        {
            header("Pragma: public");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Disposition: attachment; filename=\"" . $this->fileName . ".mp4\"");
        }

        if (empty($url))
        {
            if (!$this->isFlash() && !$this->isDownload)
            {

                          ob_start();



              if(ob_get_length() > 0) {
    ob_clean();
}
   session_write_close();

                header($this->headers[0]);
                header("Devloped-By: codyseller");
                if (http_response_code() != "403")
                {
                    if (isset($this->headers["Content-Type"]))
                    {
                        header("Content-Type: " . $this->headers["Content-Type"]);
                    }
                    if (isset($this->headers["Content-Length"]))
                    {
                        header("Content-Length: " . $this->headers["Content-Length"]);
                    }
                    if (isset($this->headers["Accept-Ranges"]))
                    {
                        header("Accept-Ranges: " . $this->headers["Accept-Ranges"]);
                    }
                    if (isset($this->headers["Content-Range"]))
                    {
                        header("Content-Range: " . $this->headers["Content-Range"]);
                    }
                    header("Connection: keep-alive");
                    header("Cache-Control: no-cache");
                    header("Pragma: no-cache");

                    $fp = fopen($this->url, "rb");
                    if ($fp !== false)
                    {
                        while (!feof($fp))
                        {
                            set_time_limit(0);
                            $buffer = fread($fp, 1024 * 1024 * 3);
                            echo $buffer;
                            ob_flush();
                            flush();
                        }
                    }

                    fclose($fp);
                    return;
                }

            }
            else
            {

                $headers = [];

                header('Accept-Ranges: bytes');
                header('Developed-by: CodySeller');

                $headers[] = 'Connection: keep-alive';
                $headers[] = 'Cache-Control: no-cache';
                $headers[] = 'Pragma: no-cache';

                $file = ['filesize' => $this->meta['fsize'], 'fileType' => $this->meta['ftype']];

                if ($file)
                {
                    $size = $file['filesize'];
                    header('Content-Type: ' . $file['fileType']);
                }
                else
                {
                    http_response_code(404);
                    return;
                }

                $range = !empty($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : '';
                if (!empty($range))
                {
                    list($start, $end) = explode('-', str_replace('bytes=', '', $range) , 2);
                    $length = intval($size) - intval($start);

                    header('HTTP/1.1 206 Partial Content');
                    header(sprintf('Content-Range: bytes %d-%d/%d', $start, ($size - 1) , $size));
                    header('Content-Length: ' . $length);

                    $headers[] = sprintf('Range: bytes=%d-', $start);
                }
                else
                {
                    header('Content-Length: ' . $size);
                }

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->url);
                curl_setopt($ch, CURLOPT_COOKIEFILE, ROOT . '/data/cache/cookie~' . $this->key . '.txt');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_BUFFERSIZE, 8192);
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_USERAGENT, Main::getUserAgent());
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_NOBODY, false);
                session_write_close();
                curl_exec($ch);
                curl_close($ch);
                return;

            }
        }
        else
        {
            header('Location: ' . $url);
            die();
        }

    }

    public function setMeta($md)
    {
        $this->meta = $md;
    }

    protected function isFlash()
    {
        if ($this->method == 'flash')
        {
            return true;
        }
        return false;
    }

    protected function checkDriveLink()
    {
        $headers = [];

        if ($this->isFlash())
        {
            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_COOKIEFILE, ROOT . '/data/cache/cookie~' . $this->key . '.txt');
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        }
        else
        {

            $headers[] = (!empty($this->cookiz)) ? "Cookie: " . $this->cookiz : $headers = [];
            if (isset($_SERVER["HTTP_RANGE"])) $headers[] = "Range: " . $_SERVER["HTTP_RANGE"];
            $options = ["http" => ['header' => $headers]];
            stream_context_set_default($options);
            $headers = get_headers($this->url, true);

            if (isset($headers["Location"]))
            {
                if (is_array($headers["Location"]))
                {
                    $headers["Location"] = end($headers["Location"]);
                }
                $url = $headers["Location"];
                $headers = get_headers($url, true);
            }
            $httpCode = substr($headers[0], 9, 3);
            if (!empty($httpCode) && $httpCode != 403)
            {
                if (isset($url)) $this->url = $url;
                $this->headers = $headers;
                $this->statusCode = 200;
            }

        }

        $this->statusCode = $httpCode;
    }

}

