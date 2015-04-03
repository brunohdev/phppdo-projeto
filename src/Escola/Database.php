<?php

namespace Escola;

class Database
{
    /**
     *
     * @var \PDO
     */
    private $pdo;
    
    public function __construct(array $config)
    {
        $dsn = "mysql:{$config['host']};";
        $username = $config['user'];
        $password = $config['pass'];
        $options = array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        );
        
        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
            $this->pdo->exec('USE '.$config['name']);
        }
        catch(\PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        }
    }
    
    /**
     * 
     * @return \PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}