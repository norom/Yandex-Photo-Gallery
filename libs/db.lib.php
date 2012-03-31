<?php
class db {
    /* Singletone */
    /** @var db */
    private static $instance = NULL;

    private $connected = FALSE;
    private $PDO = NULL;
    private $conn_time = array();

    private $host;
    private $db;
    private $user;
    private $pass;

    private $stmt;

    private function __construct() {}
    private function __clone() {}

    /**
     * @return db
     */
    public static function getInstance(){
        if (self::$instance === NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function config($host, $db, $user, $pass){
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
    }

    private function _connect() {
        try {
            $this->PDO = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (Exception $e) {
            errorLogger::getInstance()->fullLog('SQL', "SQL Error: can't connect to " . $this->host . ": " . $e->getMessage());
        }
        //     $this->PDO = query('SET NAMES utf8');
        $this->connected = true;
        $this->conn_time = microtime(true);
    }

    private function _prepareAndExec($sql, $params) {
        if (empty($this->connected)) $this->_connect();

        //$time_start = microtime(true);
        $stmt = $this->PDO->prepare(trim($sql));
        $stmt->execute((array)$params);
        //$duration = microtime(true) - $time_start;

        if ($stmt->errorCode() != '00000') {
            $err = $stmt->errorInfo();
            errorLogger::getInstance()->fullLog('SQL', array($err[2], $sql));
        }

        return $stmt;
    }

    /*
        Public methods
    */

    function fetch($sql, $params = array()) {
        $stmt = $this->_prepareAndExec($sql, $params);
        return (array)$stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetchArray($sql, $params = array()) {
        $stmt = $this->_prepareAndExec($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function fetchNext() {
        return $this->stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
    }

    function fetchField($sql, $params = array(), $field = null) {
        $stmt = $this->_prepareAndExec($sql, $params);
        $row = (array)$stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($field)) {
            $ret = $row[$field];
        } else {
            $ret = array_shift($row);
        }
        return $ret;
    }

    function fetchColumn($sql, $params = array(), $column = null) {
        $stmt = $this->_prepareAndExec($sql, $params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ret = array();
        foreach ($rows as $row) {
            if (isset($column)) {
                $ret[] = $row[$column];
            } else {
                $ret[] = array_shift($row);
            }
        }
        return $ret;
    }

    function fetchByColumn($sql, $params = array(), $column = null) {
        $stmt = $this->_prepareAndExec($sql, $params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ret = array();
        foreach ($rows as $row) {
            if (isset($column)) {
                $ret[$row[$column]] = $row;
            } else {
                // ???
                $ret[] = array_shift($row);
            }
        }
        return $ret;
    }

    function fetchAssoc($sql, $params = array(), $column_key = null, $column_value = null) {
        $stmt = $this->_prepareAndExec($sql, $params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ret = array();
        foreach ($rows as $row) {
            if (isset($column_key)) {
                $key = $row[$column_key];
            } else {
                $key = array_shift($row);
            }
            if (isset($column_value)) {
                $value = $row[$column_value];
            } else {
                $value = array_shift($row);
            }
            $ret[$key] = $value;
        }
        return $ret;
    }

    function execute($sql, $params = array()) {
        $this->stmt = $this->_prepareAndExec($sql, $params);
        return $this->stmt->rowCount();
    }

    function lastInsertId() {
        return $this->PDO->lastInsertId();
    }

    public function insertArray($table_name, $data, $params = array()){
        $cols = implode('`, `', array_keys($data[0]));
        $sql = 'INSERT INTO `'.$table_name.'` (`'.$cols.'`) VALUES';
        $rows = array();
        foreach($data as $row){
            $insert_data = implode("', '", $row);
            $rows[] = " ('".$insert_data."')";
        }
        $sql .= implode(', ', $rows).' ';
        return $this->execute($sql, $params);
    }

    public function updateArray($table_name, $values, $key_name, $key_value) {
        $fields = array();
        foreach ($values as $field => $value) {
            $fields[] = "`$field` = :$field";
        }

        $fields = implode(', ', $fields);
        $values[$key_name] = $key_value;

        return $this->execute("update `$table_name` set $fields where `$key_name` = :$key_name", $values);
    }

}

?>
