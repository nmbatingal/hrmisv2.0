<?php

namespace App\Console\Commands;

use DB;
use PDO;
use PDOException;
use Illuminate\Console\Command;

class MysqlDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mysql database schema based on the database config file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schemaName = $this->argument('name');
		$username = config("database.connections.mysql.username",'');
		$password = config("database.connections.mysql.password",'');
		$charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');
		
		try {
            $pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), $username, $password);

            $pdo->exec(sprintf(
                'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
                $schemaName,
                $charset,
                $collation
            ));

            $this->info(sprintf('Successfully created %s database', $schemaName));
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $schemaName, $exception->getMessage()));
        }
    }
	
	/**
     * @param  string $host
     * @param  integer $port
     * @param  string $username
     * @param  string $password
     * @return PDO
     */
    private function getPDOConnection($host, $port, $username, $password)
    {
        return new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }
}
