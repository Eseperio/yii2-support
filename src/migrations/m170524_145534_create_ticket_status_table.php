<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_status`.
 */
class m170524_145534_create_ticket_status_table extends Migration
{
    /**
     * @var string
     */
    private static $_tableName = '{{%ticket_status}}';

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
                ['Pending', '#e69900'],
                ['Solved', '#15a000'],
                ['Closed', '#000000']
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
