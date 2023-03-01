<?php

class Database {
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;
    private $limit = 250;

    public function __construct($db_name = "cir2", $db_user = 'cir2', $db_pass = 'cir2', $db_host = 'localhost') {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPDO() {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=localhost', $this->db_user, $this->db_user);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($stmt, $class_name) {
        $req = $this->getPDO()->query($stmt);
        return $req->fetchAll(PDO::FETCH_CLASS, $class_name);
    }

    public function getEchouages($filters = null) {
        $whereArgs = [];
        $offset = isset($_GET['page']) ? $_GET['page']*$this->limit : 0;

        $sql = 'SELECT *
        FROM echouage ';

        if ($filters != null) {
            foreach ($filters as $key => $value) {
                if($value != '') $whereArgs[] = $key.' = :'.$key;
            }
        }
        if(!empty($whereArgs)) $sql .= 'WHERE '.implode(' AND ', $whereArgs);

        $sql .= ' LIMIT :limit
        OFFSET :offset';

        $sth = $this->getPDO()->prepare($sql);

        if ($filters != null) {
            if($filters['date'] != '') $sth->bindParam('date', $filters['date']);
            if($filters['espece'] != '') $sth->bindParam('espece', $filters['espece']);
            if($filters['zone'] != '') $sth->bindParam('zone', $filters['zone']);
        }

        // Pour pagination
        $sth->bindParam('offset', $offset, PDO::PARAM_INT);
        $sth->bindParam('limit', $this->limit, PDO::PARAM_INT);

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_CLASS, 'Echouage');
    }

    public function getEspecesByType() {
        $sql = 'SELECT espece
        FROM echouage
        GROUP BY espece';

        $sth = $this->getPDO()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, 'Echouage');
    }

    public function getZonesEchouage() {
        $sql = 'SELECT zone
        FROM echouage
        GROUP BY zone';

        $sth = $this->getPDO()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, 'Echouage');
    }

    public function getTotalPages(){

        $sql = 'SELECT count(DISTINCT id) as n FROM echouage';

        $sth = $this->getPDO()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute();
        $allResultats = $sth->fetch(PDO::FETCH_ASSOC);

        return (int)($allResultats['n'] / $this->limit);

    }
}
