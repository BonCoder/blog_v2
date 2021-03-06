<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            ['name'=>'西藏'],
            ['name'=>'青海'],
            ['name'=>'宁夏'],
            ['name'=>'海南'],
            ['name'=>'甘肃'],
            ['name'=>'贵州'],
            ['name'=>'新疆'],
            ['name'=>'云南'],
            ['name'=>'重庆'],
            ['name'=>'吉林'],
            ['name'=>'山西'],
            ['name'=>'天津'],
            ['name'=>'江西'],
            ['name'=>'广西'],
            ['name'=>'陕西'],
            ['name'=>'黑龙江'],
            ['name'=>'内蒙古'],
            ['name'=>'安徽'],
            ['name'=>'北京'],
            ['name'=>'福建'],
            ['name'=>'上海'],
            ['name'=>'湖北'],
            ['name'=>'湖南'],
            ['name'=>'四川'],
            ['name'=>'辽宁'],
            ['name'=>'河北'],
            ['name'=>'河南'],
            ['name'=>'浙江'],
            ['name'=>'山东'],
            ['name'=>'江苏'],
            ['name'=>'广东']
        ];
        foreach ($areas as $area) {
                $model= new \App\Models\Area();
                $model->name = $area['name'];
                $model->save();
        }

    }
}
