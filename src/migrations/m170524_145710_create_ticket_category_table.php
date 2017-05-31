<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `ticket_category`.
 */
class m170524_145710_create_ticket_category_table extends Migration
{
    /**
     * @var string
     */
    private static $_tableName = '{{%ticket_category}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable(
            self::$_tableName, [
                'id'    => $this->primaryKey(),
                'name'  => $this->string(255)->notNull(),
                'color' => $this->string(45)
            ]
        );

        $this->batchInsert(
            self::$_tableName, ['name', 'color'], [
                ['Support', '#ffffff'],
                ['Billing', '#ffffff'],
                ['Customer Services', '#ffffff']
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::$_tableName);
    }
}
