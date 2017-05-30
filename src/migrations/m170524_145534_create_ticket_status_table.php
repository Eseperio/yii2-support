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
                'id'      => $this->primaryKey(),
                'name'    => $this->string(255)->notNull(),
                'color'   => $this->string(45),
                'default' => $this->integer(1)->defaultValue(0),
                'resolve' => $this->integer(1)->defaultValue(0)
            ]
        );

        $this->batchInsert(
            self::$_tableName, ['name', 'color', 'default', 'resolve'], [
                ['Opened', '#e69900', 1, 0],
                ['Closed', '#15a000', 0, 1]
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
