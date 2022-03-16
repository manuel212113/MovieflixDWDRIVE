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


class User extends App
{
    protected $tbl = 'users';
    protected $blackListed = ['id']; 
    public $obj = [];


    public function __construct()
    {
        $this->initProperties();
    }

    public function load($id)
    {
        $user = $this->findById($id);
        if(!empty($user))
        {
            $this->obj = $user;
        }
    }

    public function findById($id)
    {
        self::$db->where('id', $id);
        $user = self::$db->getOne($this->tbl);
        if(self::$db->count > 0)
        {
            return $user;
        }
        return false;
    }


    public function findByUsername($user)
    {
        self::$db->where('username', $user);
        $user = self::$db->getOne($this->tbl);
        if(self::$db->count > 0)
        {
            return $user;
        }
        return false;
    }

    public function assign($data)
    {
        foreach($data as $k => $v)
        {
            if(in_array($k, $this->obj))
            {
                $this->obj[$k] = $v;
            }
            
        }
        return $this;

    }


    public function save()
    {
        if(!empty($this->obj['id']))
        {
            self::$db->where('id', $this->obj['id']);
            if(self::$db->update($this->tbl, $this->getData()))
            {
                return true;
            }
        }
        return false;
    }


    protected function getData()
    {
        $data = $this->obj;
        
        foreach($data as $k => $v)
        {
            if(in_array($k, $this->blackListed))
            {
                unset($data[$k]);
            }
        }
        return $data;
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




}