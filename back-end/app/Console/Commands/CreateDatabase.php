<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $database_parameters = config('database.connections.mysql');

        [
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password
        ] = $database_parameters;

        $dsn = "mysql:host=$host;port=$port";

        $connection = new PDO($dsn, $username, $password);
        $connection->exec("CREATE DATABASE $database");
        $connection = null;

        return 0;
    }
}