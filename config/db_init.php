<?php


class DB{
    public $db_user;
    public $db_pass;
    public $db_port;
    public $db_host;
    public $db_dbname;


    public function __construct($array = [])
        /*
         * 构造函数初始化配置问题
         * */
    {
        list($this->db_user, $this->db_pass, $this->db_dbname, $this->db_port, $this->db_host) = $array;
        $this->conn = $this->db_con();
        $this->conn->query("set names 'utf8'");
    }


    public function db_con(){
        $conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_dbname);
        if ($conn->connect_error){
            die('Connect Error');
        }else{
            return $conn;
        }
    }


    public function select($sql = ""){
        $status = $this->conn->query($sql);
        $result = $status?$status->fetch_all():"";
        $status->close();
        return $result;
    }


}



?>
