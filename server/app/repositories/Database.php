<?php
    namespace App\Repositories;

    use App\Utils\ErrorMessages;
    use App\Utils\RegisterLog;
    use PDO;
    use PDOException;

    class Database
    {
        public $PDO;
        
        public function __construct()
        {
            $host = $_ENV['HOST'];
            $database = $_ENV['DATABASE'];
            $username = $_ENV['USERNAME'];
            $password = $_ENV['PASSWORD'];
            
            try
            {
                $this->PDO = new PDO(
                    "mysql:host=$host;dbname=$database",
                    $username,
                    $password,
                    array(PDO::ATTR_PERSISTENT => true)
                );
            }
            catch(PDOException $err)
            {
                RegisterLog::RegisterLog("Database Exception", $err->getMessage(), "exceptions.log");
                ErrorMessages::returnMessageError(500, "Internal Server Error",$err, "Erro conectando ao banco de dados");
            }
        }

        public function getConnection()
        {
            return $this->PDO;
        }

        public function findAllProducts($actualPageLimitInit, $limit)
        {
            $stmt = $this->PDO->prepare("SELECT * FROM produtos LIMIT $actualPageLimitInit,$limit");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function filterProducts($filter, $actualPageLimitInit, $limit, $count = false)
        {
            if(empty($filter))
            {
                return $this->findAllProducts($actualPageLimitInit, $limit);
            }
            
            $whereFilters = $this->performWhereFilters($filter);

            $stmt = $this->PDO->prepare("SELECT * FROM produtos WHERE {$whereFilters} LIMIT {$actualPageLimitInit},{$limit}");
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function numberOfRows($filters = NULL)
        {
            $stmt = "";

            if(!empty($filters))
            {
                $whereFilters = $this->performWhereFilters($filters);
                $stmt = $this->PDO->prepare("SELECT COUNT(*) FROM produtos WHERE {$whereFilters}");
            }
            else
            {
                $stmt = $this->PDO->prepare("SELECT COUNT(*) FROM produtos");
            }
            
            $stmt->execute();
            
            return $stmt->fetchColumn();
        }

        private function performWhereFilters($filters)
        {
            $whereFilter = array();

            foreach($filters as $key => $value)
            {
                if($key === 'discountTag')
                {
                    array_push(
                        $whereFilter,
                        "{$key} BETWEEN " . intval($value) - 10 . " AND " . intval($value)
                    );
                    continue;
                }

                if($key === 'productName')
                {
                    array_push($whereFilter, "{$key} LIKE '%{$value}%'");
                    continue;
                }

                array_push(
                    $whereFilter,
                    $this->createWhereRegex($key, $value)
                );
            }

            return implode(" AND ", $whereFilter);
        }

        private function createWhereRegex($columnName, $valuesToRegexCreate)
        {
            return "{$columnName} REGEXP '" . implode("|", explode(" ", $valuesToRegexCreate)) . "'";
        }
    }
?>