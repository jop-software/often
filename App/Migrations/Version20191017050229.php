<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017050229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // create user table
        $table = $schema->createTable("user");

        $table->addColumn("ID", "integer", ["autoincrement" => true]);

        $table->addColumn("username", "string");
        $table->addColumn("password", "string");

        $table->setPrimaryKey(["ID"]);

    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable("entry");
        
    }
}
