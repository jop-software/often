<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016143524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable("entry");

        // Set AI ID column
        $table->addColumn("ID", "integer", ["autoincrement" => true]);

        $table->addColumn("date", "date", ["notnull" => false]);
        $table->addColumn("start", "time", ["notnull" => false]);
        $table->addColumn("end", "time", ["notnull" => false]);
        $table->addColumn("break", "time", ["notnull" => false]);
        $table->addColumn("exp", "time", ["notnull" => false]);
        $table->addColumn("note", "text", ["notnull" => false]);

        // Create keys
        $table->setPrimaryKey(["ID"]);

    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable("entry");

    }
}
