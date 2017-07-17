<?php

use yii\db\Migration;

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

        $tableSchema = \Yii::$app->getDb()->getTableSchema('ticket_category', true);

        if($tableSchema !== null) {
            $this->dropTable('ticket_category');
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::$_tableName, [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(255)->notNull(),
            'color' => $this->string(45)
        ], $tableOptions);

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
