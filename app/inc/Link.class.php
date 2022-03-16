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


class Link extends App
{
    protected $obj = [];
    protected $tbl = 'links';
    protected $blackListed = ['id','deleted','views','downloads'];
    protected $error = '';
    protected $t = false;
    public $dgDebug = '';


    public function __construct()
    {
        $this->initProperties();
    }

    public function assign($data = [])
    {
        $this->s($data['main_link']);

        foreach($data as $k => $v)
        {
            if(array_key_exists($k, $this->obj))
            {
                $this->obj[$k] =  $v;
            }
        }

        if(!$this->isEdit() && empty($this->obj['slug']))
        {
            $slug = Main::random();
            if($this->isExit($slug))
            {
                $slug = Main::random();
            }
            $this->obj['slug'] = $slug;
        }


        if($data['type'] == 'GDrive' && $this->t)
        {
            $this->set();
        }
        if($data['type'] == 'Direct')
        {

            if(Main::getLinkStatus($data['main_link']) != 200)
            {
                if(!$this->isEdit())
                {
                    $this->error = 'Main link is does not exist !';
                }
                else
                {
                    $this->obj['status'] = 2;
                }
                
            }
            else
            {
                $this->obj['status'] = $data['status'];
            }
            
        }

        return $this;
    }

    protected function s($u)
    {
        if($this->isEdit() && Main::isDrive($u))
        {
            if($this->obj['type'] == 'GDrive')
            {
                $o_gid = Main::getDriveId($this->obj['main_link']);
                $n_gid = Main::getDriveId($u);
                if($o_gid != $n_gid)
                {
                    $this->t = true;
                }
            }
        }
        else
        {
            if(!$this->isEdit())
            {
                $this->t = true;
            }
        }

    }

    public function save()
    {
        if(!$this->hasError())
        {
            $this->beforeSave();
            
            if(!$this->isEdit())
            {
                $id = self::$db->insert($this->tbl, $this->getData());
                if($id)
                {
                    $this->obj['id'] = $id;
                }
                else{
                    $this->error = self::$db->getLastError();
                }
            }
            else
            {
               
                self::$db->where('id', $this->getID());
                if(!self::$db->update($this->tbl, $this->getData(), '1'))
                {
                    $this->error = 'Update Filed ! -> ' . self::$db->getLastError();
                }
            }
        }
    }

    public function getID()
    {
        if($this->isEdit())
        {
            return $this->obj['id'];
        }
        return false;
    }

    protected function beforeSave()
    {
        $this->obj['updated_at'] = Main::tnow();
        if(!$this->isEdit())
        {
           

            $this->obj['created_at'] = Main::tnow();
            
        }
    }

    protected function getData()
    {
        $data = $this->obj;
        foreach($this->blackListed as $bl)
        {
            if(array_key_exists($bl, $data))
            {
                unset($data[$bl]);
            }
        }
        return $data;

    }


    protected function set($alt = false)
    {
        if(!$alt)
        {
            $gid = Main::getDriveId($this->obj['main_link']);
        }
        else
        {
            $gid = Main::getDriveId($this->obj['alt_link']);
        }
        
        if(!empty($gid))
        {
            $gdrive = new GDrive();
            $gdrive->setKey($this->obj['slug']);
            $result = $gdrive->get($gid);

            if(!empty($result))
            {
                if(empty($this->obj['title']))
                {
                    $this->obj['title'] = $result['title'];
                } 
                $this->obj['data'] = json_encode($result['data']);
                if(!$alt)
                {
                    $this->obj['status'] = 0;
                }
            }
            else
            {
                if($gdrive->hasError())
                {
                    $this->dgDebug = $gdrive->getError();
                    if(!$alt)
                    {
                        $this->obj['status'] = 2;
                    }
                    if(!$this->isEdit())
                    {
                        $this->error = $gdrive->getError();
                    }
                    
                }
            }
        }
    }

    public function refresh($alt = false)
    {
        if($this->isEdit())
        {
            
            $this->set($alt);
            $this->save();
        }
    }


    protected function isEdit()
    {
        if(!empty($this->obj['id']))
        {
            return true;
        }

        return false;
    }

    protected function initProperties()
    {
        $dbColumns = self::$db->rawQuery("DESCRIBE " . $this->tbl);
        if (!empty($dbColumns)) {
            foreach ($dbColumns as $col) {
                $this->obj[$col['Field']] = NULL;
            }
        }
    }
    public function hasError()
    {
        if(!empty($this->error))
        {
            return true; 
        }
        return false;
    } 

    public function getError()
    {
        return $this->error;
    }

    public function findBySlug($s)
    {
        self::$db->where('slug', $s);
        $link = self::$db->getOne($this->tbl);
        if(self::$db->count > 0)
        {
            return $link;
        }
        return false;

    }


    public function findById($id)
    {
        self::$db->where('id', $id);
        $link = self::$db->getOne($this->tbl);
        if(self::$db->count > 0)
        {
            return $link;
        }
        return false;

    }

    public function isExit($s , $ty = 'slug')
    {
        if($ty == 'slug')
        {
            if($link = $this->findBySlug($s))
            {

                
                
                if($link['slug'] != $this->obj['slug']) 
                {
                    return true;
                }
                
            }
        }

        if($ty == 'id')
        {
            if($this->findById($s))
            {
                return true;
            }
        }

        return false;
    }

    public function load($id, $t = 'id')
    {
        if($t == 'id')
        {
            $link = $this->findById($id);
        }
        else
        {
            $link = $this->findBySlug($id);
        }
      
        if($link)
        {
            foreach($link as $k => $v)
            {
                if(array_key_exists($k, $this->obj))
                {
                    $this->obj[$k] = $v;
                }
            }
        }

    }

    public function updateData($url, $q, $data)
    {
        $fMeta = Main::getVInfo($url, $this->obj['slug']);

        $data['sources'][$q]['size'] = $fMeta['fsize'];
        $data['sources'][$q]['type'] = $fMeta['ftype'];


        $this->obj['data'] = json_encode($data);
        $this->save();

        return $fMeta;

        
    }


    public function broken($un = true)
    {
        if($this->isEdit())
        {
            $this->obj['status'] = 2;
            self::$db->where('id', $this->getID());
            $status = $un ? 2 : 0;
            self::$db->update($this->tbl, ['status'=>$status], '1');
        }

    }

    public function downloaded()
    {
        if($this->isEdit())
        {
            self::$db->where('id', $this->getID());
            self::$db->update($this->tbl, ['downloads'=>$this->obj['downloads'] + 1], 1);
        }

    }

    public function viewed()
    {
        if($this->isEdit())
        {
            self::$db->where('id', $this->getID());
            self::$db->update($this->tbl, ['views'=>$this->obj['views'] + 1], 1);
        }

    }



    public function getAll($s = 'active')
    {
        $st = [
            'active' => 0,
            'paused' => 1,
            'broken' => 2
        ];
        self::$db->where ("status", $st[$s]);
        self::$db->orderBy("id","Desc");

        $links = self::$db->get($this->tbl);
        return self::$db->count > 0 ? $links : [];


    }

    public function delete($id)
    {
        self::$db->where('id', $id);
        if(self::$db->delete($this->tbl)){
            return true;
        }
        return false;
    }

    public function search($gid)
    {

        self::$db->where("main_link", "%$gid%", 'like');
        $results = self::$db->getOne($this->tbl);
        if(self::$db->count > 0)
        {
            return $results;
        }

        return false;

    }


    public function getTotalLinks() {
        self::$db->get($this->tbl);
        return self::$db->count;
    }

    public function getTotalViews() {
        $stats = self::$db->getOne($this->tbl, "sum(views)");
        return (isset($stats['sum(views)'])) ? $stats['sum(views)'] : 0;
    }

    public function getTotalDownloads() {
        $stats = self::$db->getOne($this->tbl, "sum(downloads)");
        return (isset($stats['sum(downloads)'])) ? $stats['sum(downloads)'] : 0;
    }

    public function getMostViewed() {
        self::$db->where("status", 2, "!=");
        self::$db->orderBy("views", "desc");
        $results = self::$db->get($this->tbl, 10);
        if (self::$db->count > 0) {
            return $results;
        } else {
            return [];
        }
    }
    public function getRecentlyAdded() {
        self::$db->where("status", 2, "!=");
        self::$db->orderBy("created_at", "desc");
        $results = self::$db->get($this->tbl, 10);
        if (self::$db->count > 0) {
            return $results;
        } else {
            return [];
        }
    }




}