<?php
namespace too\sistemadeventasBundle\Modals;
/**
 * Created by PhpStorm.
 * User: Elmer_Melgar
 * Date: 9/10/2015
 * Time: 7:44 PM
 */
class Login
{
    private $username;
    private $password;
    private $rol;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getSername()
    {
        return $this->sername;
    }

    /**
     * @param mixed $sername
     */
    public function setSername($sername)
    {
        $this->sername = $sername;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }



}