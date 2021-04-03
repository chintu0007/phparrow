<?php

// Singleton to connect db.
class DbConnect
{
    // Hold the class instance.
    private static $instance = null;
    protected $conn;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'phparrrow';

    // The db connection is established in the private constructor.
    protected function __construct()
    {

        try {
            $this->conn = @new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $e) {
            $this->fatal(
                "An error occurred while connecting to the database. " .
                    "The error reported by the server was: " . $e->getMessage()
            );
        }

        // try {
        //     $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . '', $this->user, $this->pass);
        // } catch (PDOException $e) {
        //     print "Error!: " . $e->getMessage() . "<br/>";
        //     die();
        // }
    }

    /**
     * Throw a fatal error.
     *
     * This writes out an error message in a JSON string which DataTables will
     * see and show to the user in the browser.
     *
     * @param  string $msg Message to send to the client
     */
    public function fatal($msg)
    {
        echo json_encode(array(
            "error" => $msg
        ));

        exit(0);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DbConnect();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
