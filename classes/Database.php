<?php
class Database
{
    private $db_host, $db_name, $db_user, $db_user_pwd;

    public function __construct($db_user, $db_user_pwd, $db_host, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_user_pwd = $db_user_pwd;
    }

    public function getConn()
    {
        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";
        return new PDO($dsn, $this->db_user, $this->db_user_pwd);
    }
}