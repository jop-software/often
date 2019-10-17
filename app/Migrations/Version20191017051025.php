<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017051025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable("entry");

        $table->addColumn("userid", "integer", ["notnull" => false]);

        $table->addForeignKeyConstraint("user", ["userid"], ["ID"], [], "entry_userid");

    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable("entry");
        $table->dropColumn("userid");
        $table->removeForeignKey("entry_userid");

    }
}
