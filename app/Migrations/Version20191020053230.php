<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020053230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable("user");
        $table->addColumn("language", "string");

    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable("user");
        $table->dropColumn("language");

    }
}
