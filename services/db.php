<?php

class SafeQuery {
  private $sql;
  private $parameters;

  public function __construct($sql, $args = []) {
    $this->sql = $sql;
    $this->parameters = $args;
  }

  public function getSafeString($connection) {
    $pattern = '/(?<!\\\)%(s|d)/';
    $count = count($this->parameters);
    $i = 0;
    $result = preg_replace_callback(
      $pattern,
      function ($matches) use ($connection, $count, &$i) {
        if ($i >= $count) {
          throw new Exception("Mosperputhje e parametrave tek $this->sql.");
        }
        $parameter = $this->parameters[$i++];
        switch ($matches[1]) {
          case 's':
            return "'" . mysqli_real_escape_string($connection, $parameter) . "'";
          case 'd':
            $numberPattern = '/^\s*[+\-]?(?:\d+(?:\.\d+)?|\.\d+)\s*$/';
            if (preg_match($numberPattern, $parameter)) {
              return $parameter;
            } else {
              throw new Exception("Vlere jo numerike $parameter.");
            }

          default:
            return $matches[0];
        }
      },
      $this->sql);
    return str_replace("\%", "%", $result);
  }
}

class DbConnection {
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $port;
  private $connection;

  private function prepareSql($sql, $args) {
    try {
      if ($sql instanceof SafeQuery) {
        return $sql->getSafeString($this->connection);
      } else if (count($args) > 0) {
        return (new SafeQuery($sql, $args))->getSafeString($this->connection);
      } else {
        return $sql;
      }
    } catch (Exception $e) {
      return null;
    }
  }

  public function __construct() {
    $this->servername = $_ENV['DB_SERVER'];
    $this->username = $_ENV['DB_USER'];
    $this->password = $_ENV['DB_PASS'];
    $this->dbname = $_ENV['DB_NAME'];
    $this->port = $_ENV['DB_PORT'];
    $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname, $this->port);
  }

  public function error() {
    return mysqli_error($this->connection);
  }

  public function queryAssoc($sql, ...$args) {
    $sql = $this->prepareSql($sql, $args);
    if (!$sql) {
      return null;
    }

    $result = mysqli_query($this->connection, $sql);
    if (!$result) {
      return null;
    }

    $array = [];
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        array_push($array, $row);
      }
    }

    return $array;
  }

  public function query($sql, ...$args) {
    $sql = $this->prepareSql($sql, $args);
    if (!$sql) {
      return null;
    }

    $result = mysqli_query($this->connection, $sql);
    if (!$result) {
      return null;
    }

    $array = [];
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_object($result)) {
        array_push($array, $row);
      }
    }

    return $array;
  }

  public function first($sql, ...$args) {
    $result = $this->query($sql, ...$args);
    if ($result && count($result) > 0) {
      return $result[0];
    } else {
      return null;
    }
  }

  public function exists($sql, ...$args) {
    $result = $this->query($sql, ...$args);
    return $result && count($result) > 0;
  }

  public function scalar($sql, ...$args) {
    $sql = $this->prepareSql($sql, $args);
    if (!$sql) {
      return null;
    }

    $result = mysqli_query($this->connection, $sql);
    if (!$result) {
      return null;
    }

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      return $row[0];
    } else {
      return null;
    }
  }

  public function execute($sql, ...$args) {
    $sql = $this->prepareSql($sql, $args);
    if (!$sql) {
      return false;
    }

    if (mysqli_multi_query($this->connection, $sql)) {
      return true;
    } else {
      return false;
    }
  }

  public function getConnection() {
    return $this->connection;
  }
}
