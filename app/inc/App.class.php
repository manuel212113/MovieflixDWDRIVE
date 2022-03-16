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

class App
{

    protected static $db;
    protected static $config;
    protected $actions = ["home", "links", "stream", "ajax", "bulk", "ads", "settings", "dashboard", "profile", "login", "logout", "api"];
    protected $logged = false;
    protected $hasAccess = false;
    protected $userImg = '';
    protected $alerts = [];
    protected $data;

    public function __construct($db, $config)
    {
        self::$db = $db;
        self::$config = $config;
    }

    public function run()
    {

        $this->setup();

        if (isset($_GET['a']) && !empty($_GET['a']))
        {

            $var = explode('/', $_GET['a']);
            $var[0] = str_replace('.', '', $var[0]);

            $this->action = Main::clean($var[0]);
            unset($var[0]);

            if (in_array($this->action, $this->actions))
            {
                $this->resolveCustomSlugs();
                $this->check();
                if (method_exists($this, $this->action))
                {
                    return call_user_func_array([$this, $this->action], $var);
                }
                else
                {
                    //method does not exist
                    die('This method is does not exists in app !');
                }
            }
            else
            {
                //page not found
                $this->_404();

            }
        }

        return $this->home();

    }

    public function dashboard()
    {

        $this->analyze();
        $this->display('dashboard');

    }

    protected function isHit($data, $id)
    {
        $stream = new Stream();
        if (!empty($data))
        {

            if (!is_array($data))
            {
                $data = json_decode($data, true);

            }

            $q = key($data['sources']);

            $source = $data['sources'][$q]['file'];

            $cookiz = implode('; ', $data['cookies']);

            $stream->setKey($id);
            $stream->load($source, $cookiz);

            if ($stream->isOk())
            {
                return true;
            }

        }
        return false;
    }

    public function api($type = '', $id = '')
    {

        $link = new Link();
        $data = '';

        $err = '';

        if (isset($_GET['id']) && isset($_GET['apikey']))
        {

            if ($_GET['apikey'] == API_KEY)
            {
                $gid = Main::clean($_GET['id']);
                $title = isset($_GET['title']) ? Main::clean($_GET['title']) : '';

                if (Main::isUrl($gid))
                {
                    $gurl = $gid;
                }
                else
                {
                    $gurl = "https://drive.google.com/file/d/{$gid}/view";;
                }

                $mtype = Main::getLinkType($gurl);

                if (!$mtype)
                {
                    $err = 'Invalid link format !';
                }

                if (empty($err))
                {
                    $data = ['main_link' => $gurl, 'title' => $title, 'type' => $mtype, 'status' => 0];

                    $link->assign($data)->save();

                    if (!$link->hasError())
                    {
                        $id = $link->getID();

                        $link = $link->findById($id);

                        $s = $link['slug'];
                        $directLinks = [];
                        if (!empty($link['data']))
                        {
                            $qulities = Main::getQulities($link['data']);

                            foreach ($qulities as $q)
                            {
                                $directLinks[$q] = Main::getStreamLink($s, $q);
                            }
                        }

                        $data = ['title' => $link['title'], 'plyrLink' => Main::getPlyrLink($s) , 'downLink' => Main::getDownloadLink($s) , 'directLinks' => $directLinks];

                    }
                    else
                    {
                        $err = $link->getError();
                    }

                }
            }
            else
            {
                $err = 'Invalid API key !';
            }

        }
        else
        {
            $err = 'Required parameters are missing !';

        }

        if (empty($err) && !empty($data))
        {
            $rep = ['status' => 'success', 'data' => $data];
        }
        else
        {
            if (empty($err)) $err = 'Something went wrong !';
            $rep = ['status' => 'failed', 'error' => $err];
        }

        $this->jsonResponse($rep);

    }

    public function login()
    {

        if ($this->logged)
        {
            Main::redirect('dashboard');
        }

        if (Main::isPost())
        {
            $username = Main::clean(trim($_POST['username']));
            $password = Main::clean($_POST['password']);

            $user = new User();
            $user = $user->findByUsername($username);

            if (!empty($user))
            {
                if (password_verify($password, $user['password']))
                {
                    $_SESSION['user'] = $user['username'];
                    $_SESSION['logged'] = 1;
                    Main::redirect('dashboard');
                }
                else
                {
                    $this->addAlert('Invalid Password !', 'danger');
                }
            }
            else
            {
                $this->addAlert('Invalid Username !', 'danger');
            }

        }

        $this->display('login', true);

    }

    public function profile()
    {

        $user = new User();
        $user->load(self::$config['adminId']);

        if (Main::isPost())
        {
            $username = Main::clean(trim($_POST['username']));
            $password = Main::clean($_POST['password']);
            $img = Main::clean($_POST['image']);

            if (empty($username))
            {
                $this->addAlert('Username is required !', 'danger');
            }
            else
            {
                if ($username != $user->obj['username'])
                {
                    $isNewU = true;
                }
            }

            if (!empty($password))
            {
                if (empty($_POST['confirm_passsword']))
                {
                    $this->addAlert('Confirm password is required !', 'danger');
                }
                else
                {
                    if ($password != $_POST['confirm_passsword'])
                    {
                        $this->addAlert('Password does not matched !', 'danger');
                    }
                }

            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
            {
                $piname = $_FILES['image']['name'];
                $pitmp = $_FILES['image']['tmp_name'];
                $imgDir = "/uploads/images/";
                if (!file_exists(ROOT . $imgDir))
                {
                    $this->addAlert("Profile image upload failed ! -> <b>{$imgDir}</b> folder does not exist . ", 'warning');
                }
                else
                {
                    if (!is_writable(ROOT . $imgDir))
                    {
                        $this->addAlert("Profile image upload failed ! -> <b>{$imgDir}</b> folder is not writable . ", 'warning');
                    }
                    else
                    {
                        $upname = Main::uploadImg($piname, $pitmp, $imgDir);
                        if (!$upname)
                        {
                            $this->addAlert("Profile image upload failed. -> Invalid file format !", 'warning');
                        }
                        else
                        {
                            $img = $upname;
                        }
                    }
                }

            }
            else
            {
                $img = Main::clean($_POST['image']);
            }

            if (!$this->hasAlerts())
            {

                $data = ['username' => $username, 'img' => $img];

                if (!empty($password))
                {
                    $hasedPass = password_hash($password, PASSWORD_DEFAULT);
                    $data['password'] = $hasedPass;
                }

                if ($user->assign($data)->save())
                {
                    if ($isNewU)
                    {
                        $_SESSION['user'] = $username;
                    }
                    $this->addAlert('Saved changes successfully !', 'success');
                    $this->saveAlerts();
                    Main::redirect('profile');
                }

            }

        }

        $this->addData($user->obj, 'user');
        $this->display('profile');

    }

    protected function analyze()
    {
        $link = new Link();
        $updater = new AutoUpdater();

        $tl = number_format($link->getTotalLinks());
        $tv = number_format($link->getTotalViews());
        $td = number_format($link->getTotalDownloads());
        $bl = number_format(count($link->getAll('broken')));

        $mal = $link->getMostViewed();
        $ral = $link->getRecentlyAdded();

        $data = ['totalLinks' => $tl, 'totalViews' => $tv, 'totalDownloads' => $td, 'brokenLinks' => $bl, 'maLinks' => $mal, 'raLinks' => $ral];

        $this->addData($updater->isnew() , 'isNewUpdate');
        $this->addData($updater->getNewV() , 'newV');

        $this->addData($data, 'data');

    }

    public function ads($action = '', $id = '')
    {

        switch ($action)
        {
            case 'new':

                if (Main::isPost())
                {

                    $isEdit = false;
                    if (!empty($_POST['id']))
                    {
                        $id = Main::clean($_POST['id']);
                        $isEdit = true;
                    }

                    $title = Main::clean($_POST['title']);
                    $xml = Main::clean($_POST['xml']);
                    $type = Main::clean($_POST['type']);
                    $offset = Main::clean($_POST['offset']);

                    $adcode = ['tag' => $xml, 'offset' => $offset];

                    if ($type != 'nonlinear')
                    {
                        if (!empty(Main::clean($_POST['skip-offset'])))
                        {
                            $skipOffset = $_POST['skip-offset'];
                        }
                        else
                        {
                            $skipOffset = 5;
                        }
                        $adcode['skipoffset'] = $skipOffset;
                    }
                    else
                    {
                        $adcode['type'] = $type;
                    }

                    $adcode = json_encode($adcode);

                    $data = ['title' => $title, 'type' => 'vast', 'code' => $adcode];

                    if (!$isEdit)
                    {
                        $id = self::$db->insert('ads', $data);

                        if ($id)
                        {
                            $this->addAlert('VAST Ad Saved Successfully !', 'success');
                        }
                        else
                        {
                            $this->addAlert('Something went wrong!', 'danger');
                        }
                    }
                    else
                    {
                        self::$db->where('id', $id);
                        if (!self::$db->update('ads', $data))
                        {
                            $this->addAlert('Something went wrong!', 'danger');
                        }
                    }

                    $this->saveAlerts();
                    Main::redirect('ads');

                }

            break;

            case 'del':

                if (!empty($id) && is_numeric($id))
                {
                    self::$db->where('id', $id);
                    self::$db->delete('ads');

                    $this->addAlert('Vast Ad item deleted successfully !', 'success');
                    $this->saveAlerts();
                    Main::redirect('ads');
                }
                else
                {
                    $this->_404();
                }

            break;

            case 'popad':
                if (Main::isPost())
                {
                    $adcode = base64_encode($_POST['popads']);

                    self::$db->where('type', 'popad');
                    self::$db->update('ads', ['code' => $adcode]);
                    $this->addAlert('Popad code saved successfully !', 'success');

                    $this->saveAlerts();
                    Main::redirect('ads');
                }
            break;

            case 'd_banner':
                if (Main::isPost())
                {

                    $allowed = [12, 14, 15];
                    foreach ($_POST as $ad)
                    {
                        if (isset($ad['id']) && isset($ad['code']) && in_array($ad['id'], $allowed))
                        {
                            self::$db->where('id', $ad['id']);
                            self::$db->update('ads', ['code' => base64_encode($ad['code']) ]);
                        }
                    }

                    $this->addAlert('Banner ads saved successfully !', 'success');

                    $this->saveAlerts();
                    Main::redirect('ads');
                }
            break;

        }

        $ads = [];

        self::$db->where('type', 'vast');
        $ads['vast'] = self::$db->get('ads');

        self::$db->where('type', 'd_banner');
        $ads['d_banner'] = self::$db->get('ads');

        self::$db->where('type', 'popad');
        $ads['popad'] = self::$db->get('ads');
        $ads['popad'] = $ads['popad'][0]['code'];

        $this->addData($ads, 'ads');
        $this->display('ads');

    }

    public function settings($action = '', $sAction = '', $id = '')
    {

        if (!empty($action))
        {
            switch ($action)
            {
                case 'proxy':
                    $proxy = new Proxy();

                    if (Main::isPost())
                    {
                        $acp_list = Main::clean($_POST['activeProxy']);
                        $bcp_list = Main::clean($_POST['brokenProxy']);

                        $proxyUser = Main::clean(trim($_POST['proxyUser']));
                        $proxyPass = Main::clean(trim($_POST['proxyPass']));

                        if (!empty($acp_list))
                        {
                            $acp_list = explode(',', str_replace(' ', '', $acp_list));
                            if (!$proxy->saveProxy($acp_list))
                            {
                                if ($proxy->hasError())
                                {
                                    $this->addAlert($proxy->getError() , 'danger');
                                }
                            }

                        }
                        else
                        {
                            $proxy->clear();
                        }

                        if (!empty($bcp_list))
                        {

                            $bcp_list = explode(',', str_replace(' ', '', $bcp_list));
                            if (!$proxy->saveBrokenProxy($bcp_list, 'new'))
                            {
                                if ($proxy->hasError())
                                {
                                    $this->addAlert($proxy->getError() , 'danger');
                                }
                            }

                        }
                        else
                        {
                            $proxy->clear('broken');
                        }

                        $this->_updateSettings(['proxyUser' => $proxyUser, 'proxyPass' => $proxyPass]);

                        Main::redirect('settings/proxy');
                    }

                    $activeProxy = $proxy->getProxyList();
                    $brokenProxy = $proxy->getProxyList('broken');
                    $activeProxy = !empty($activeProxy) ? implode(',' . PHP_EOL, $activeProxy) : '';
                    $brokenProxy = !empty($brokenProxy) ? implode(',' . PHP_EOL, $brokenProxy) : '';

                    $this->addData($activeProxy, 'activeProxy');
                    $this->addData($brokenProxy, 'brokenProxy');
                    $this->display('proxy');
                break;

                case 'gdrive-auth':

                    if (!empty($sAction))
                    {
                        switch ($sAction)
                        {
                            case 'new':
                            case 'edit':

                                $isEdit = false;

                                $auth = ['email' => '', 'client_id' => '', 'client_secret' => '', 'refresh_token' => ''];

                                if ($sAction == 'edit')
                                {
                                    if (!empty($id))
                                    {
                                        self::$db->where('id', $id);
                                        $auth = self::$db->getOne('drive_auth');
                                        $isEdit = true;
                                        if (self::$db->count == 0)
                                        {
                                            $this->_404();
                                        }
                                    }
                                    else
                                    {
                                        $this->_404();
                                    }
                                }

                                if (Main::isPost())
                                {
                                    $email = Main::clean(trim($_POST['email']));
                                    $client_id = Main::clean(trim($_POST['client_id']));
                                    $client_secret = Main::clean(trim($_POST['client_secret']));
                                    $refresh_token = Main::clean(trim($_POST['refresh_token']));

                                    if (empty($client_id))
                                    {
                                        $this->addAlert('Client ID is required !', 'danger');
                                    }

                                    if (empty($client_secret))
                                    {
                                        $this->addAlert('Client Secret is required !', 'danger');
                                    }

                                    if (empty($refresh_token))
                                    {
                                        $this->addAlert('Refresh Token is required !', 'danger');
                                    }

                                    if (!$this->hasAlerts())
                                    {
                                        $data = ['email' => $email, 'client_id' => $client_id, 'client_secret' => $client_secret, 'refresh_token' => $refresh_token];

                                        if (!$isEdit)
                                        {
                                            self::$db->insert('drive_auth', $data);
                                        }
                                        else
                                        {
                                            $data['access_token'] = '';
                                            self::$db->where('id', $id);
                                            self::$db->update('drive_auth', $data);
                                        }

                                        Main::redirect('settings/gdrive-auth');

                                    }

                                }

                                $this->addData($auth, 'auth');
                                $this->display('__new-gdrive-auth');
                                exit;
                            break;

                            case 'delete':
                                if (!empty($id))
                                {
                                    self::$db->where('id', $id);
                                    self::$db->delete('drive_auth');
                                }
                                Main::redirect('settings/gdrive-auth');
                            break;

                            default:
                                $this->_404();
                            break;

                        }
                    }

                    $gdriveAuths = self::$db->get('drive_auth');

                    $this->addData($gdriveAuths, 'auth');
                    $this->display('gdrive-auth');
                break;

                case 'general':

                    if (Main::isPost())
                    {

                        $firewall = isset($_POST['firewall']) && $_POST['firewall'] == 'on' ? 1 : 0;
                        $dark_theme = isset($_POST['dark_theme']) && $_POST['dark_theme'] == 'on' ? 1 : 0;
                        $autoEmbed = isset($_POST['autoEmbed']) && $_POST['autoEmbed'] == 'on' ? 1 : 0;
                        $streamLink = isset($_POST['streamLink']) && $_POST['streamLink'] == 'on' ? 1 : 0;
                        $isDownload = isset($_POST['isDownload']) && $_POST['isDownload'] == 'on' ? 1 : 0;
                        $isDownloadPage = isset($_POST['isDownloadPage']) && $_POST['isDownloadPage'] == 'on' ? 1 : 0;

                        $sublist = [];
                        if (!empty($_POST['sublist']))
                        {
                            $sublist = str_replace(' ', '', strtolower(Main::clean(trim($_POST['sublist']))));
                            $sublist = explode(',', $sublist);
                        }
                        $sublist = json_encode($sublist);

                        $allowedDomains = [];
                        if (!empty($_POST['allowed_domains']))
                        {
                            $allowedDomains = str_replace(' ', '', strtolower(Main::clean(trim($_POST['allowed_domains']))));
                            $allowedDomains = explode(',', $allowedDomains);
                        }
                        $allowedDomains = json_encode($allowedDomains);

                        $timezone = Main::clean($_POST['timezone']);

                        $player = Main::clean($_POST['player']);
                        if (!in_array($player, ['jw', 'plyr'])) $player = 'jw';

                        $playerSlug = str_replace(' ', '', Main::clean($_POST['playerSlug']));

                        $defaultVideo = Main::clean($_POST['defaultVideo']);
                        $defaultVideo = Main::clean($_POST['defaultVideo']);
                        $downloadSlug = str_replace(' ', '', Main::clean($_POST['downloadSlug']));
                        $downloadPrefix = Main::clean($_POST['downloadPrefix']);
                        $countdown = Main::clean($_POST['countdown']);
                        if (!is_numeric($countdown)) $countdown = 0;
                        $downloadPageContent = Main::sanitized($_POST['downloadPageContent']);

                        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
                        {
                            $piname = $_FILES['logo']['name'];
                            $pitmp = $_FILES['logo']['tmp_name'];
                            $imgDir = "/uploads/images/";
                            if (!file_exists(ROOT . $imgDir))
                            {
                                $this->addAlert("Logo image upload failed ! -> <b>{$imgDir}</b> folder does not exist . ", 'warning');
                            }
                            else
                            {
                                if (!is_writable(ROOT . $imgDir))
                                {
                                    $this->addAlert("Logo image upload failed ! -> <b>{$imgDir}</b> folder is not writable . ", 'warning');
                                }
                                else
                                {
                                    $upname = Main::uploadImg($piname, $pitmp, $imgDir);
                                    if (!$upname)
                                    {
                                        $this->addAlert("Logo image upload failed. -> Invalid file format !", 'warning');
                                    }
                                    else
                                    {
                                        $logo = $upname;
                                    }
                                }
                            }

                        }
                        else
                        {

                            if (!empty(self::$config['logo']) && empty($_POST['logo']))
                            {
                                if (file_exists(ROOT . '/uploads/images/' . self::$config['logo']))
                                {
                                    unlink(ROOT . '/uploads/images/' . self::$config['logo']);
                                }
                                $logo = '';
                            }
                            else
                            {
                                $logo = Main::clean($_POST['logo']);
                            }

                        }

                        if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] == 0)
                        {
                            $piname = $_FILES['favicon']['name'];
                            $pitmp = $_FILES['favicon']['tmp_name'];
                            $imgDir = "/uploads/images/";
                            if (!file_exists(ROOT . $imgDir))
                            {
                                $this->addAlert("Favicon image upload failed ! -> <b>{$imgDir}</b> folder does not exist . ", 'warning');
                            }
                            else
                            {
                                if (!is_writable(ROOT . $imgDir))
                                {
                                    $this->addAlert("Favicon image upload failed ! -> <b>{$imgDir}</b> folder is not writable . ", 'warning');
                                }
                                else
                                {
                                    $upname = Main::uploadImg($piname, $pitmp, $imgDir);
                                    if (!$upname)
                                    {
                                        $this->addAlert("Favicon image upload failed. -> Invalid file format !", 'warning');
                                    }
                                    else
                                    {
                                        $favicon = $upname;
                                    }
                                }
                            }

                        }
                        else
                        {

                            if (!empty(self::$config['favicon']) && empty($_POST['favicon']))
                            {
                                if (file_exists(ROOT . '/uploads/images/' . self::$config['favicon']))
                                {
                                    unlink(ROOT . '/uploads/images/' . self::$config['favicon']);
                                }
                                $favicon = '';
                            }
                            else
                            {
                                $favicon = Main::clean($_POST['favicon']);
                            }

                        }

                        if (empty($playerSlug))
                        {
                            $this->addAlert('Player slug is required !', 'danger');
                        }

                        if (empty($downloadSlug))
                        {
                            $this->addAlert('Download slug is required !', 'danger');
                        }

                        if (!$this->hasAlerts())
                        {
                            $data = ['firewall' => $firewall, 'dark_theme' => $dark_theme, 'autoEmbed' => $autoEmbed, 'streamLink' => $streamLink, 'isDownload' => $isDownload, 'isDownloadPage' => $isDownloadPage, 'sublist' => $sublist, 'allowed_domains' => $allowedDomains, 'timezone' => $timezone, 'player' => $player, 'playerSlug' => $playerSlug, 'defaultVideo' => $defaultVideo, 'downloadSlug' => $downloadSlug, 'downloadPrefix' => $downloadPrefix, 'countdown' => $countdown, 'downloadPageContent' => $downloadPageContent, 'logo' => $logo, 'favicon' => $favicon];

                            $this->_updateSettings($data);

                            $this->addAlert('Settings saved successfully !', 'success');
                            $this->saveAlerts();
                            Main::redirect('settings/general');
                        }

                    }

                    $this->display('gen-settings');
                    break;

                case 'update':
                    $this->display('update');
                    break;

                default:
                    $this->_404();
                    break;

                }
            }

    }

    public function bulk()
    {

        $this->display('bulk-import');

    }

    public function ajax()
    {
        $rep = ['success' => false];
        $err = '';
        if (isset($_GET['type']))
        {
            switch ($_GET['type'])
            {
                case 'delete-link':

                    $id = isset($_GET['id']) && !empty($_GET['id']) ? Main::clean($_GET['id']) : '';

                    if (!empty($id))
                    {
                        $link = new Link();

                        if ($link->delete($id))
                        {
                            $rep = ['success' => true];
                        }

                    }

                break;

                case 'import-link':

                    $url = isset($_GET['url']) && !empty($_GET['url']) ? trim(Main::clean($_GET['url'])) : '';
                    sleep(2);
                    if (!empty($url) && Main::isUrl($url))
                    {

                        $type = Main::getLinkType($url);

                        if ($type !== false)
                        {
                            $link = new Link();
                            $data = ['main_link' => $url, 'type' => $type, 'status' => 0];

                            $link->assign($data)->save();

                            if (!$link->hasError())
                            {
                                $id = $link->getID();

                                $link = $link->findById($id);

                                if (!empty($link))
                                {
                                    $rep = ['success' => true, 'title' => $link['title']];
                                }

                            }
                            else
                            {
                                $rep['error'] = $link->getError();

                            }

                        }
                        else
                        {
                            $rep['error'] = 'Link Format Not Supported !';
                        }

                    }
                    else
                    {
                        $rep['error'] = 'Invalid URL !';
                    }

                break;

                case 'check-proxy':

                    $ip = isset($_GET['ip']) && !empty($_GET['ip']) ? trim(Main::clean($_GET['ip'])) : '';
                    sleep(2);

                    if (!empty($ip))
                    {
                        $proxy = new Proxy();

                        if ($proxy->check($ip))
                        {
                            $rep = ['success' => true];
                        }

                    }

                break;

                case 'check-update':

                    $updater = new AutoUpdater();

                    if ($updater->isnew())
                    {
                        $rep = ['success' => true, 'version' => $updater->getNewV() , 'logs' => $updater->getLogs()

                        ];
                    }

                break;

                case 'script-update':

                    $updater = new AutoUpdater();

                    if ($updater->isOk())
                    {
                        if (!$updater->install())
                        {
                            $err = $updater->getError();
                            if (empty($err))
                            {
                                $err = 'Update Failed !.  Something went wrong .';
                            }
                        }

                    }
                    else
                    {
                        $err = $updater->getError();
                    }

                    if (empty($err))
                    {
                        $rep = ['success' => true];
                    }
                    else
                    {
                        $rep = ['success' => false, 'error' => $err];
                    }

                break;

            }
        }

        $this->jsonResponse($rep);
    }

    public function check()
    {
        $public = ['login', 'stream', 'video', 'download', 'api'];
        // $this->hasAccess = true;
        if (!$this->logged)
        {
            if (in_array($this->action, $public))
            {
                $this->hasAccess = true;
            }
            else
            {
                $this->_400();
            }
        }
        else
        {
            $this->hasAccess = true;
        }

    }

    protected function setup()
    {
        $videoSlug = $this->getSlug('playerSlug');
        $downloadSlug = $this->getSlug('downloadSlug');
        $this->actions[] = $videoSlug;
        $this->actions[] = $downloadSlug;

        if (isset($_SESSION['alerts']))
        {
            $this->alerts = $_SESSION['alerts'];
            unset($_SESSION['alerts']);
        }

        if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1)
        {
            $user = new User();
            $user = $user->findByUsername($_SESSION['user']);
            if (!empty($user))
            {
                //we have only admin user
                $this->logged = true;
                $this->userImg = $user['img'];

            }
        }

    }

    protected function resolveCustomSlugs()
    {
        $videoSlug = $this->getSlug('playerSlug');
        $downloadSlug = $this->getSlug('downloadSlug');
        $cslugs = [$videoSlug => 'video', $downloadSlug => 'download'];
        if (array_key_exists($this->action, $cslugs))
        {
            $this->action = $cslugs[$this->action];
        }

    }

    protected function getSlug($slug)
    {
        $default = ['videoSlug' => 'video', 'downloadSlug' => 'download'];
        return !empty(self::$config[$slug]) ? self::$config[$slug] : $default[$slug];
    }

    public function home()
    {

        $this->display('home', true);

    }

    public function download($slug = '', $q = '', $sessID = '')
    {

        $link = new Link();
        $stream = new Stream();
        $isOk = $uTurn = $galt = false;

        if (!empty(session_id()))
        {
            $this->addData(session_id() , 'sessID');
        }
        else
        {
            $this->_400();
        }

        if (self::$config['isDownload'])
        {

            if (!empty($slug))
            {

                $file = $link->findBySlug($slug);

                if (!empty($file) && $file['type'] == 'GDrive')
                {

                    $link->load($file['id']);

                    if (empty($file['data']))
                    {
                        $link->refresh();
                        $file = $link->obj;
                    }
                    if (!empty($file['data']))
                    {
                        $stream->setKey($file['slug']);
                        $data = json_decode($file['data'], true);
                        $downloadLinks = Main::getDownloadLinks($file);
                        $this->addData($downloadLinks, 'links');
                        $this->addData($file['title'], 'title');

                        if (isset($data['sources'][$q]) && !empty($data['cookies'])) $galt = true;

                        if (!empty($q) || !self::$config['isDownloadPage'])
                        {
                            if ($sessID == session_id() || !self::$config['isDownloadPage'])
                            {
                                // if (!self::$config['mdl'])
                                // {
                                //     $dl = Main::getDL($file['main_link']);
                                //     if (!empty($dl))
                                //     {
                                //         $link->downloaded();
                                //         header('Location: ' . $dl['downloadUrl']);
                                //         exit;
                                //     }
                                //     else
                                //     {
                                //         if ($galt) $uTurn = true;
                                //     }
                                // }
                                if (self::$config['mdl'] || $uTurn)
                                {

                                    $i = 0;
                                    while ($i < 2)
                                    {
                                        $cookiz = implode('; ', $data['cookies']);
                                        $stream->load($data['sources'][$q]['file'], $cookiz);

                                        if (!$stream->isOk())
                                        {
                                            $link->refresh();
                                            if (!empty($link->obj['data']))
                                            {
                                                $data = json_decode($link->obj['data'], true);
                                            }
                                            else
                                            {
                                                break;
                                            }
                                        }
                                        else
                                        {
                                            $isOk = true;
                                        }
                                        $i++;
                                    }

                                    if ($isOk)
                                    {

                                        $link->downloaded();

                                        if (empty($data['sources'][$q]['size']))
                                        {
                                            $metaData = $link->updateData($data['sources'][$q]['file'], $q, $data);
                                        }
                                        else
                                        {
                                            $metaData = ['fsize' => $data['sources'][$q]['size'], 'ftype' => $data['sources'][$q]['type']];
                                        }
                                        $stream->setMeta($metaData);

                                        $stream->__download($file['title']);
                                    }
                                    else
                                    {
                                        die('Something went wrong ! pls try again later.');
                                    }

                                }
                            }
                            else
                            {
                                $this->_400();
                            }

                        }

                    }
                    else
                    {
                        $this->addAlert('Can not download this video at this time !', 'danger');
                    }
                }
                else
                {
                    //not found
                    $this->addAlert('File not found !', 'danger');
                }
            }
            else
            {
                $this->_404();
            }

            if (self::$config['isDownloadPage'])
            {
                self::$db->where('type', 'd_banner');
                $ads = self::$db->get('ads');

                $this->addData($ads, 'ads');
                $this->addData($this->getPopAds() , 'popads');

                $this->display('download', true);
            }

        }
        else
        {
            $this->_400();
        }

    }

    public function video($id = '')
    {

        $this->_firewall();

        $link = new Link();
        $p = self::$config['player'];
        $gp = false;
        if (!empty($id))
        {
            if ($link->isExit($id))
            {

                $link->load($id, 'slug');
                $file = $link->obj;
                $type = $file['type'];

                if ($file['status'] != 1)
                {
                    $link->viewed();
                    switch ($type)
                    {
                        case 'GDrive':

                            if (empty($file['data']))
                            {
                                $link->refresh();
                                $file = $link->obj;
                            }
                            else
                            {
                                if (!$this->isHit($file['data'], $id))
                                {
                                    $link->refresh();
                                    $file = $link->obj;
                                }

                            }

                            if (!empty($file['data']))
                            {
                                $sources = Main::makePlyrFile(Main::getData($file) , $p);
                            }

                        break;
                        case 'GPhoto':
                            $data = Main::getGPhotos($file['main_link']);

                            if ($data !== false)
                            {
                                if ($file['status'] == 2)
                                {
                                    $link->broken(false);
                                }
                                $sources = Main::makePlyrFile($data, $p);
                                $gp = true;
                            }
                            else
                            {
                                $sources = Main::makePlyrFile([['file' => PROOT . '/stream/k/' . $file['slug'] . '/d/alt', 'q' => '360']], $p);

                                $link->broken();
                            }
                        break;
                        case 'OneDrive':

                            $od_link = Main::getOneDrive($file['main_link']);

                            if ($od_link !== false)
                            {
                                if ($file['status'] == 2)
                                {
                                    $link->broken(false);
                                }
                                $sources = Main::makePlyrFile([['file' => $od_link, 'q' => 360]], $p);
                            }
                            else
                            {
                                $sources = Main::makePlyrFile([['file' => PROOT . '/stream/k/' . $file['slug'] . '/d/alt', 'q' => '360']], $p);

                                $link->broken();
                            }

                        break;
                        case 'Direct':
                            $sources = Main::makePlyrFile([['file' => PROOT . '/stream/k/' . $file['slug'], 'q' => 720]], $p);
                        break;
                    }

                }
                else
                {
                    $this->_404();
                }

            }
            else
            {
                if (self::$config['autoEmbed'])
                {
                    $searchResult = $link->search($id);
                    if (!empty($searchResult))
                    {
                        $vurl = Main::getPlyrLink($searchResult['slug']);
                        Main::redirect($vurl, true);
                    }
                    else
                    {
                        $gurl = "https://drive.google.com/file/d/{$id}/view";
                        $data = ['main_link' => $gurl, 'type' => 'GDrive', 'status' => 0];

                        $link->assign($data)->save();

                        if (!$link->hasError())
                        {
                            $id = $link->getID();

                            $link = $link->findById($id);

                            if (!empty($link))
                            {
                                $vurl = Main::getPlyrLink($link['slug']);
                                Main::redirect($vurl, true);
                            }
                        }
                    }
                }
                die("This video doesn't exist.");
            }

        }

        $subs = Main::getSubTrack($file['subtitles'], $p);
        $poster = PROOT . '/uploads/images/' . $file['preview_img'];
        $logo = PROOT . '/uploads/images/' . self::$config['logo'];
        $downloadLink = self::$config['isDownload'] ? Main::getDownloadLink($file['slug']) : '#';
        $this->addData($sources, 'sources');
        $this->addData($file['title'], 'title');
        $this->addData($poster, 'poster');
        $this->addData($subs, 'subtitles');
        $this->addData($logo, 'logo');
        $this->addData($gp, 'gp');
        $this->addData($downloadLink, 'downloadLink');
        $this->addData($this->getPopAds() , 'popads');
        $this->addData($this->getPlyrAds() , 'ads');
        if ($p == 'plyr')
        {
            $this->display('player/plyr-io', true);
        }
        else
        {
            $this->display('player/jw_plyr', true);
        }

    }

    protected function getPlyrAds()
    {
        self::$db->where('type', 'vast');
        $ads = self::$db->get('ads');
        $this->addData($ads, 'ads');

        if (!empty($ads) && is_array($ads))
        {
            $adList = [];
            foreach ($ads as $ad)
            {
                if (!empty($ad['code']))
                {
                    $adList[] = $ad['code'];
                }
            }
            $adList = implode(', ', $adList);
            return $adList;
        }
        return '';
    }

    protected function getPopAds()
    {
        self::$db->where('type', 'popad');
        $popads = self::$db->get('ads');
        return $popads[0]['code'];
    }

    protected function addData($data, $name = '')
    {
        if (!empty($name))
        {
            $this->data[$name] = $data;
        }
        else
        {
            $this->data = $data;
        }

    }

    public function stream($q = '', $id = '', $type = '', $o = '')
    {

        $os = Main::getOS();

        if (!(strpos($os, 'Windows') !== false || strpos($os, 'Android') !== false))
        {
            self::$config['streamMethod'] = 'default';
        }

        if ($type != 'gphoto')
        {
            $this->_firewall(true);

        }
        $id = preg_replace('/\\.[^.\\s]{3,4}$/', '', $id);
        $debug = isset($_GET['debug']) && $_GET['debug'] == 1 ? true : false;
        $error = '';
        $glt = $d2d = false;
        $uTurn = $isOk = false;
        $iq = true;

        $stream = new Stream();
        $link = new Link();
        $stream->setKey($id);

        if ($type == 'gphoto' || $type == 'onedrive')
        {
            if (empty($o))
            {
                $url = base64_decode($id);
                if ($type == 'onedrive') $url = urldecode($url);

                $stream->start($url);
            }
        }

        if (!empty($id) && $link->isExit($id))
        {

            $link->load($id, 'slug');

            $file = $link->obj;

            if (!empty($file))
            {
                $url = $file['main_link'];
                $type = $file['type'];

                if ($type == 'Direct' || $type == 'GDrive' || (($type == 'GPhoto' || $type == 'OneDrive') && $o = 'alt'))
                {

                    if ($type == 'GPhoto' || $type == 'OneDrive')
                    {
                        if (!empty($file['alt_link']))
                        {

                            if (Main::isDirect($file['alt_link']))
                            {
                                $url = $file['alt_link'];
                                $d2d = true;
                            }
                            else if (!Main::isDrive($file['alt_link']))
                            {

                                $uTurn = true;
                            }

                        }
                        else
                        {
                            $uTurn = true;
                        }
                    }

                    if ($type == 'Direct' || $d2d)
                    {

                        if (Main::getLinkStatus($url) == 200)
                        {
                            if ($file['status'] == 2 && !$d2d)
                            {
                                $link->broken(false);
                            }
                            $stream->start($url);
                        }
                        else
                        {

                            if (!$d2d)
                            {
                                $link->broken();

                                if (!empty($file['alt_link']))
                                {
                                    $glt = true;
                                }
                                else
                                {
                                    $error = 'Main link does not exist ! -> ' . $url;
                                    $uTurn = true;
                                }
                            }
                            else
                            {
                                $error = 'Alternative link does not exist ! -> ' . $url;
                                $uTurn = true;
                            }

                        }
                    }

                    if (!$uTurn)
                    {

                        if (empty($q)) $q = '360';

                        if (empty($link->obj['data']) || ($link->obj['status'] == 2 && !$glt))
                        {
                            if ($o == 'alt' && ($type == 'GPhoto' || $type == 'OneDrive'))
                            {
                                $glt = true;
                            }

                            $link->refresh($glt);
                            $file = $link->obj;

                        }

                        $data = json_decode($file['data'], true);

                        $qq = ['360', '480', '720', '1080'];
                        if (!in_array($q, $qq))
                        {
                            $q = '360';
                        }
                        if (isset($data['sources'][$q]))
                        {

                            $source = $data['sources'][$q]['file'];
                            $cookiz = implode('; ', $data['cookies']);

                            $reloads = 0;

                            $alt = $gdAlt = false;

                            if (!empty($file['alt_link']))
                            {
                                $alt = true;
                                if (Main::isDrive($file['alt_link']))
                                {

                                    $gdAlt = true;
                                }

                            }

                            while ($reloads < 5)
                            {

                                $stream->load($source, $cookiz);

                                if (!$stream->isOk())
                                {
                                    if ($file['status'] == 2 || $reloads > 2 || $glt)
                                    {
                                        if ($alt)
                                        {
                                            if ($gdAlt)
                                            {
                                                $alt = true;
                                            }
                                            else
                                            {
                                                //other
                                                if (Main::getLinkStatus($file['alt_link']) == 200)
                                                {
                                                    $stream->start($file['alt_link']);
                                                }
                                                else
                                                {
                                                    $error = 'Alternative link does not exist ! -> ' . $file['alt_link'];
                                                    break;
                                                }

                                            }
                                        }
                                        else
                                        {
                                            break;
                                        }

                                    }
                                    else
                                    {
                                        $alt = false;
                                    }

                                    $link->refresh($alt);
                                    if (!$link->hasError())
                                    {
                                        $data = json_decode($link->obj['data'], true);
                                        if (isset($data['sources'][$q]))
                                        {
                                            $source = $data['sources'][$q]['file'];
                                            $cookiz = implode('; ', $data['cookies']);
                                            $stream->load($source, $cookiz);
                                            $isOk = true;
                                        }
                                        else
                                        {
                                            $isOk = true;
                                            $iq = false;
                                        }

                                    }
                                }
                                else
                                {
                                    $isOk = true;
                                }

                                if (!$isOk && $reloads == 2)
                                {
                                    $link->broken();
                                }

                                if ($isOk) break;
                                $reloads++;
                            }
                        }
                        else
                        {
                            $error = 'Invalid video qulity format or cookies are empty !';
                        }

                    }

                    if ($isOk && $iq)
                    {

                        if (empty($data['sources'][$q]['size']))
                        {
                            $metaData = $link->updateData($source, $q, $data);
                        }
                        else
                        {
                            $metaData = ['fsize' => $data['sources'][$q]['size'], 'ftype' => $data['sources'][$q]['type']];
                        }

                        $stream->setMeta($metaData);

                        $stream->start();
                        // exit;
                        
                    }
                    else
                    {
                        //404
                        if ($debug)
                        {
                            if (!empty($link->dgDebug))
                            {
                                echo 'Drive File Error : ' . $link->dgDebug . '<br>';
                            }
                            else
                            {
                                echo 'Stream Issue ! <br>';
                            }
                            if (!empty($error))
                            {
                                echo $error;
                            }
                        }
                        else
                        {
                            $stream->start('default');
                            // $this->_404();
                            
                        }
                    }
                }

            }
        }

    }

    public function links($action = '', $id = '')
    {
        $link = new Link();
        switch ($action)
        {
            case 'new':
            case 'edit':

                $isEdit = false;
                if (!empty($id))
                {
                    if (is_numeric($id) && $link->isExit($id, 'id'))
                    {
                        $link->load($id);
                        $isEdit = true;
                    }
                    else
                    {
                        $this->_404();
                    }
                }
                if (Main::isPost())
                {

                    $title = Main::clean(trim($_POST['title']));
                    $mainLink = Main::clean(trim($_POST['main_link']));
                    $altLink = Main::clean(trim($_POST['alt_link']));
                    $slug = Main::clean(trim($_POST['slug']));
                    $status = Main::clean(trim($_POST['status']));
                    $previewImg = '';

                    $sub_list = [];
                    $altData = [];
                    //allowed subtitle format list
                    $allowed = ['vtt', 'srt', 'dfxp', 'ttml', 'xml'];

                    if (empty($mainLink))
                    {
                        $this->addAlert('Main link is required !', 'danger');
                    }
                    else
                    {
                        if (!main::isUrl($mainLink))
                        {
                            $this->addAlert('Invalid URL -> main link !', 'danger');
                        }
                        else
                        {
                            $mtype = Main::getLinkType($mainLink);
                            if (!$mtype)
                            {
                                $this->addAlert('Main link format not supported !', 'danger');
                            }
                        }
                    }

                    if (!empty($altLink))
                    {
                        if (!main::isUrl($altLink))
                        {
                            $this->addAlert('Invalid URL -> alternative link !', 'danger');
                        }
                        else
                        {
                            $type = Main::getLinkType($altLink);

                            if (!in_array($type, ['GDrive', 'Direct']))
                            {
                                $this->addAlert('Alternative link format not supported !', 'danger');
                            }

                        }

                    }

                    if (!in_array($status, [0, 1]))
                    {
                        $this->addAlert('Invalid status value provided !', 'danger');
                    }

                    if ($isEdit && empty($slug))
                    {
                        $this->addAlert('Video slug is required !', 'danger');
                    }
                    else
                    {
                        $slug = Main::slugify($slug);
                        if ($link->isExit($slug))
                        {
                            $this->addAlert('Video slug is already exist !', 'danger');
                        }
                    }

                    if (isset($_POST['sub']) && is_array($_POST['sub']))
                    {
                        foreach ($_POST['sub'] as $sk => $sub)
                        {

                            if (!$isEdit || ($isEdit && isset($_FILES['sub']['name'][$sk]['file']) && !empty($_FILES['sub']['name'][$sk]['file'])))
                            {
                                if (isset($_FILES['sub']['name'][$sk]) && !empty($_FILES['sub']['name'][$sk]['file']))
                                {
                                    $filename = $_FILES['sub']['name'][$sk]['file'];
                                    if ($_FILES['sub']['error'][$sk]['file'] == 0)
                                    {
                                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                        $temp_name = $_FILES['sub']['tmp_name'][$sk]['file'];
                                        if (in_array($ext, $allowed))
                                        {
                                            //try to upload now
                                            $filename = strtolower(str_replace(' ', '_', $filename));
                                            $sdf = '{"kind": "captions","file": "' . PROOT . '/uploads/subtitles/' . $filename . '",  "label": "' . $sub['label'] . '"  }';
                                            $sub_list[] = $sdf;
                                            move_uploaded_file($temp_name, ROOT . "/uploads/subtitles/" . $filename);
                                        }
                                        else
                                        {
                                            $this->addAlert("Subtile upload failed ! -> Invalid file type. {$filename}", 'warning');
                                        }
                                    }
                                }
                            }
                            else
                            {

                                if (isset($sub['file']) && !empty($sub['file']))
                                {

                                    if (!isset($sub['deleted']))
                                    {
                                        if (!isset($sub['label']))
                                        {
                                            $sub['label'] = '';
                                        }
                                        $sdf = '{"kind": "captions","file": "' . $sub['file'] . '",  "label": "' . $sub['label'] . '"  }';
                                        $sub_list[] = $sdf;
                                    }
                                    else
                                    {
                                        $dt = !empty(PROOT) ? str_replace(PROOT, '', $sub['file']) : $sub['file'];
                                        if (file_exists(ROOT . $dt))
                                        {

                                            unlink(ROOT . $dt);
                                        }

                                    }

                                }

                            }

                        }
                    }

                    if (isset($_FILES['preview_img']) && $_FILES['preview_img']['error'] == 0)
                    {
                        $piname = $_FILES['preview_img']['name'];
                        $pitmp = $_FILES['preview_img']['tmp_name'];
                        $imgDir = "/uploads/images/";
                        if (!file_exists(ROOT . $imgDir))
                        {
                            $this->addAlert("Preview image upload failed ! -> <b>{$imgDir}</b> folder does not exist . ", 'warning');
                        }
                        else
                        {
                            if (!is_writable(ROOT . $imgDir))
                            {
                                $this->addAlert("Preview image upload failed ! -> <b>{$imgDir}</b> folder is not writable . ", 'warning');
                            }
                            else
                            {
                                $upname = Main::uploadImg($piname, $pitmp, $imgDir);
                                if (!$upname)
                                {
                                    $this->addAlert("Preview image upload failed. -> Invalid file format !", 'warning');
                                }
                                else
                                {
                                    $previewImg = $upname;
                                }
                            }
                        }

                    }
                    else
                    {
                        if ($isEdit && !empty($_POST['preview_img']))
                        {
                            $previewImg = Main::clean($_POST['preview_img']);
                        }
                    }

                    if (!$this->hasAlerts())
                    {
                        $subs = !empty($sub_list) ? implode(',', $sub_list) : '';
                        $data = ['title' => $title, 'main_link' => $mainLink, 'alt_link' => $altLink, 'subtitles' => $subs, 'slug' => $slug, 'type' => $mtype, 'preview_img' => $previewImg, 'status' => $status];

                        $link->assign($data)->save();

                        if (!$link->hasError())
                        {
                            $id = $link->getID();

                            if (!$isEdit)
                            {
                                $this->addAlert('Link saved successfully !', 'success');
                                $this->saveAlerts();

                                Main::redirect("links/edit/$id");
                            }
                            else
                            {
                                Main::redirect("links/active");
                            }

                        }
                        else
                        {
                            $this->addAlert($link->getError() , 'danger');
                        }

                    }

                }

                if (!$isEdit)
                {
                    $this->display('__new_link');
                }
                else
                {
                    $this->data = $link->obj;
                    // dnd($link);
                    $this->display('__edit_link');
                }

            break;

            case 'active';
        case 'paused':
        case 'broken':

            $links = $link->getAll($action);
            $this->addData($links, 'links');
            $this->addData($action, 'linksType');
            $this->display('links');

        break;

        default:
            $this->_404();
        break;

    }

}

public function logout()
{
    if (isset($_SESSION["logged"])) unset($_SESSION["logged"]);
    if (isset($_SESSION["user"])) unset($_SESSION["user"]);
    Main::redirect('login');
}

protected function saveAlerts()
{
    $_SESSION['alerts'] = $this->alerts;
}

protected function addAlert($msg, $type)
{

    if (!array_key_exists($type, $this->alerts))
    {
        $this->alerts[$type] = [];
    }

    $this->alerts[$type][] = $msg;

}

protected function hasAlerts($t = 'danger', $all = false)
{
    if ((isset($this->alerts[$t]) && !empty($this->alerts[$t])) || ($all && !empty($this->alerts)))
    {
        return true;

    }

    return false;
}

protected function displayAlerts()
{
    if ($this->hasAlerts('', true))
    {
        $alertHtml = '';

        foreach ($this->alerts as $k => $v)
        {
            $alertHtml .= '<div class="alert alert-' . $k . '" role="alert"><b>Alert:&nbsp;</b>';
            if (count($v) == 1)
            {
                $alertHtml .= $v[0];
            }
            else
            {
                $list = '<ul>';
                foreach ($v as $al)
                {
                    $list .= '<li>' . $al . '</li>';
                }
                $list .= '</ul>';
                $alertHtml .= $list;
            }
            $alertHtml .= '</div>';
        }
        echo $alertHtml;
    }
}

protected function display($template, $isBlank = false)
{

    if (is_array($this->data))
    {
        foreach ($this->data as $k => $v)
        {
            $$k = $v;
        }
    }
    else
    {
        $data = $this->data;
    }

    if (!file_exists(TEMPLATE . '/' . $template . '.php'))
    {
        //template file not found
        die('File ' . TEMPLATE . '/' . $template . '.php not found !');
    }

    if (!$isBlank)
    {
        $this->header();
        include (TEMPLATE . '/' . $template . '.php');
        $this->footer();
    }
    else
    {
        include (TEMPLATE . '/' . $template . '.php');
    }
}

protected function header()
{
    include ($this->t(__FUNCTION__));
}

protected function footer()
{
    include ($this->t(__FUNCTION__));
}

protected function t($template)
{
    if (!file_exists(TEMPLATE . '/' . $template . '.php')) die('File ' . $template . ' does not exist !');
    return TEMPLATE . '/' . $template . '.php';
}

protected function jsonResponse($resp)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: applicaton/json; charset=UTF-8");
    http_response_code(200);
    echo json_encode($resp);
    exit;
}

protected function _updateSettings($data = [])
{
    foreach ($data as $config => $val)
    {
        self::$db->where('config', $config);
        self::$db->update('settings', ['var' => $val]);
    }
}

protected function _404()
{
    header('HTTP/1.1 404 Not Found');
    die('<h1>404 page not found !</h1>');
}

protected function _400()
{
    header('HTTP/1.1 400 bad request');
    die('<h1>400 Bad Request !</h1>');
}

protected function _firewall($s = false)
{
    if (self::$config['firewall'] == 1 || ($s && !self::$config['streamLink']))
    {
        $domains = json_decode(self::$config['allowed_domains'], true);
        if ($s)
        {
            $domains[] = Main::getHost();
        }

        if (!isset($_SERVER["HTTP_REFERER"]))
        {
            $this->display('lol', true);
            exit;
        }

        $referer = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);
        if (empty($referer) || !in_array($referer, $domains))
        {

            $this->_404();

            exit;
        }
    }
}

    public function __destruct()
    {
        self::$db->disconnect();
    }

}

