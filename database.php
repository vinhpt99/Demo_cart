<?php
class database {
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $database = "demo_app_login";
    public $connection;
    //phương thức khởi tạo
    public function __construct()
    {
        $this->connection = $this->connectDatabase();
        
    }
    public function connectDatabase()
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $connection;
    }
    //phương thức chạy câu lệnh sql
    public function runQuery($sql)
    {   
        $data = array();
        $result = mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }
        return $data;

        
    }
    //lấy số bản ghi trong cơ sở dữ liệu
    public function num_rows($sql)
    {
       $result = mysqli_query($this->connection, $sql);
       $count = mysqli_num_rows($result);
       return count;
    }
    public function delete($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

}
?>