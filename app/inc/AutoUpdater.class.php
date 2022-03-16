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

class AutoUpdater
{

    const latestVersion = "2.1";
    const serverURL = "https://cdn1.kccmacs.lk/updater.php";

    protected $newVersion = NULL;
    protected $dlink = NULL;
    protected $logs = NULL;
    protected $error = '';

    public function __construct()
    {
        $this->checkErrors();
    }

    protected function checkErrors()
    {

        if (!in_array('curl', get_loaded_extensions()))
        {
            $this->error = "cURL library is not available. Please update manually.";
            return false;
        }

        if (!class_exists("ZipArchive"))
        {
            $this->error = "ZipArchive library is not available. Please update manually.";
            return false;
        }

        if (!is_writable(ROOT))
        {
            $this->error = ROOT . " is not writable. Please change the permission to 755.";
            return false;
        }

    }

    public function install()
    {
        // Check to make sure everything is OK
        if ($this->isOk())
        {
            if ($this->verify())
            {
                return $this->download();
            }
        }

        $this->error = "An unexpected error occured. Please update manually.";
        return false;
    }

    public function isOk()
    {
        if (empty($this->error))
        {
            return true;
        }
        return false;
    }

    public function getError()
    {
        return $this->error;
    }

    protected function verify()
    {
        $rurl = self::serverURL . '?v=' . self::latestVersion;
        $response = Main::curl($rurl);

        $response = json_decode($response);

        if ($response !== NULL)
        {
            if ($response->status == 'success')
            {
                $this->newVersion = $response->version;
                $this->dlink = $response->link;
                $this->logs = $response->clogs;
                return true;
            }
        }
        else
        {
            $this->error = 'Something went wrong !';
        }
        return false;

    }

    public function isnew()
    {
        return $this->verify();
    }

    protected function download()
    {

        if (!file_put_contents(ROOT . "/main-updated.zip", @fopen($this->dlink, 'r')))
        {
            $this->error = "The file cannot be downloaded an error occured.";
            return false;
        }

        return $this->extract();

    }

    protected function extract()
    {

        $zip = new ZipArchive();
        $file = $zip->open(ROOT . "/main-updated.zip");

        if ($file === true)
        {

            if (!$zip->extractTo(ROOT . "/"))
            {
                $this->error = "The file was downloaded but cannot be extracted due to permission.";
                return false;
            }

            $zip->close();

        }
        else
        {
            $this->error = "The file cannot be extracted.";
            return false;
        }

        return $this->update();
    }

    protected function update()
    {
        $endpoint = Main::getDomain() . "/updater.php";
        Main::curl($endpoint);
        return $this->clean();
    }

    protected function clean()
    {
        if (file_exists(ROOT . "/main-updated.zip"))
        {
            unlink(ROOT . "/main-updated.zip");
            return true;
        }
    }

    public function getLogs()
    {
        return base64_decode($this->logs);
    }

    public function getNewV()
    {
        return $this->newVersion;
    }

}

