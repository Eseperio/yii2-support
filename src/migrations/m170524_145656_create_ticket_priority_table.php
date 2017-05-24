<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_priority`.
 */
class m170524_145656_create_ticket_priority_table extends Migration
{
    /**
     * @var string
     */
    private static $_tableName = '{{%ticket_priority}}';

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
                ['Low', '#15a000'],
                ['Normal', '#e1d200'],
                ['Critical', '#e10000']
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
