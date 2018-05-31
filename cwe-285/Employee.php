<?php
class Employee
{
     /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->createTables();
    }

    /**
     * create tables
     */
    public function createTables() {
        $commands = array('CREATE TABLE IF NOT EXISTS employee (
                        id   INTEGER PRIMARY KEY NOT NULL,
                        first_name VARCHAR(30) NOT NULL,
                        last_name VARCHAR(30) NOT NULL,
                        email VARCHAR(50) NOT NULL,
                        salary NUMBER NOT NULL
                      )');
        if(!$this->existTable('employee')) {
            foreach ($commands as $command) {
                $this->pdo->exec($command);
            }
            $this->loadData();
        }
    }

    public function getDefaultData() {
        return array(
            array(
                'first_name' => 'OSWALDO',
                'last_name' => 'CHUQUIRIMA CAMACHO',
                'email' => 'oswaldochc86@gmailc.om',
                'salary' => '2000',
            ),
            array(
                'first_name' => 'STEVEN',
                'last_name' => 'KING',
                'email' => 'sking@gmailc.om',
                'salary' => '1800',
            ),
            array(
                'first_name' => 'BRUCE',
                'last_name' => 'ERNST',
                'email' => 'bernst@gmailc.om',
                'salary' => '1250',
            ),
        );
    }

    public function loadData() {
        $sql = "INSERT INTO employee (first_name, last_name, email, salary) ".
            "VALUES (:first_name, :last_name, :email, :salary)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':salary', $salary);

        foreach ($this->getDefaultData() as $r) {
            $firstName = $r['first_name'];
            $lastName = $r['last_name'];
            $email = $r['email'];
            $salary = $r['salary'];
            $stmt->execute();
        }
    }

    public function getEmployees() {
        $query = "
            SELECT
                first_name, last_name, email, salary
            FROM employee
            order by last_name
        ";
        $stmt = $this->pdo->query($query);
        $employees = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $employees[] = $row;
        }
        return $employees;
    }

    public function existTable($table) {
        $query = "SELECT name FROM sqlite_master WHERE type='table' AND name = :table_name";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':table_name' => $table));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * get the table list in the database
     */
    public function getTableList() {

        $stmt = $this->pdo->query("SELECT name
                                   FROM sqlite_master
                                   WHERE type = 'table'
                                   ORDER BY name");
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }

        return $tables;
    }
}