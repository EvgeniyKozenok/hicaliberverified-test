<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class HouseSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/property-data.csv';
        $this->tablename = 'houses';
        $this->delimiter = ',';
        $this->aliases = [
            'Name' => 'name',
            'Price' => 'price',
            'Bedrooms' => 'bedrooms',
            'Bathrooms' => 'bathrooms',
            'Storeys' => 'storeys',
            'Garages' => 'garages'
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
