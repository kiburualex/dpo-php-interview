<?php 

class Database
{
    private $host = 'mssql_server';
    private $db_name = 'dpo_db';
    private $username = 'SA';
    private $password = 'fakePassw0rd';
    private $conn;

    public function __construct(){
        $this->connect();
    }

    private function connect(){
        try {
            $this->conn = new PDO(
                "sqlsrv:Server={$this->host};Database={$this->db_name}",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' . $e->getMessage());
        }
    }

    public function getData(){
        try {
            $sql = "
                SELECT
                    u.username,
                    COUNT(o.order_id) AS total_orders,
                    SUM(o.amount) AS total_amount
                FROM
                    users u
                LEFT JOIN
                    orders o ON u.user_id = o.user_id
                GROUP BY
                    u.username
                ORDER BY
                    total_amount DESC;
            ";

            $stmt = $this->conn->query($sql);

            if (!$stmt) {
                throw new Exception('Failed to execute the SQL query.');
            }

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            throw new Exception('Query failed: ' . $e->getMessage());
        }
    }

    public function __destruct(){
        if ($this->conn) {
            $this->conn = null;
        }
    }
}

?>