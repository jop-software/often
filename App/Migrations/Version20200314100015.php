<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200314100015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $userTable = $schema->getTable("user");
        $userTable->addColumn("created_at", "datetime", ["notnull" => true, "default" => "CURRENT_TIMESTAMP"]);

        $entryTable = $schema->getTable("entry");
        $entryTable->addColumn("created_at", "datetime", ["notnull" => true, "default" => "CURRENT_TIMESTAMP"]);
    }

    public function down(Schema $schema) : void
    {
        $userTable = $schema->getTable("user");
        $userTable->dropColumn("created_at");

        $entryTable = $schema->getTable("entry");
        $entryTable->dropColumn("created_at"); 
    }
}
