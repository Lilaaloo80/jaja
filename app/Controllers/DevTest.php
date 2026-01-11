<?php

namespace App\Controllers;

class DevTest extends BaseController
{
    public function dbtest()
    {
        $db = db_connect();

        $row = $db->query("SELECT DB_NAME() AS DbName, @@VERSION AS ServerVersion;")
                  ->getRowArray();

        return $this->response->setJSON([
            "connected" => true,
            "database"  => $row["DbName"] ?? null,
            "version"   => $row["ServerVersion"] ?? null,
        ]);
    }
}
