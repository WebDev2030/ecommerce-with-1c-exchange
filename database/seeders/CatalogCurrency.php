<?php

namespace Database\Seeders;

use App\Catalog\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogCurrency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = new \App\Catalog\Models\Currency();
        $currency->name = 'Казахстанский тенге';
        $currency->code = 'KZT';
        $currency->base = true;

        $currency->save();
    }
}
