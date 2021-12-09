    <?php 
    class Database {
        // private $host = "sarkoship10101.domaincommysql.com";
        // private $Database_name = "honest_fixers";
        // private $username = "sarkoship10101";
        // private $password = "Byblos#2021";
        private $host = "localhost";
        private $Database_name = "honest_fixers";
        private $username = "root";
        private $password = "";
        public $conn;

        public function getConnection(){
            $this->conn = null;
$myfile = fopen("logfile.txt", "w") or die("Unable to open file!");

            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->Database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
fwrite($myfile, "Database could not be connected");
fclose($myfile);
                echo json_encode("Database could not be connected: " . $exception->getMessage());
            }
            return $this->conn;
        }
    }  
?>
