<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

class ModelTestCase extends TestCase
{
    protected function runConfigurationAssertion(
        $model,
        $fillalbe = [],
        $hidden = [],
        $guarded = ['*'],
        $visible = [],
        $casts = ['id' => 'int'],
        $dates = ['created_at', 'updated_at'],
        $collectionClass = Collection::class,
        $table = null,
        $primaryKey = 'id',
        $connection = null
    ) {
        if (!$model instanceof Model) {
            $model = new $model;
        }
        $this->assertEquals($fillalbe, $model->getFillable());
        $this->assertEquals($hidden, $model->getHidden());
        $this->assertEquals($guarded, $model->getGuarded());
        $this->assertEquals($visible, $model->getVisible());
        $this->assertEquals($casts, $model->getCasts());
        $this->assertEquals($dates, $model->getDates());
        $this->assertEquals($primaryKey, $model->getKeyName());

        $c = $model->newCollection();
        $this->assertEquals($collectionClass, get_class($c));
        $this->assertInstanceOf(Collection::class, $c);

        if ($connection != null) {
            $this->assertEquals($connection, $model->getConnection());
        }

        if ($table != null) {
            $this->assertEquals($table, $model->getTable());
        }
    }
}
