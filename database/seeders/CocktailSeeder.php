<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cocktail;

class CocktailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cocktail::insert([
            [
                'name' => 'Margarita',
                'brand' => 'Tequila Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Cocktail Glass'
            ],
            [
                'name' => 'Martini',
                'brand' => 'Vodka Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Cocktail Glass'
            ],
            [
                'name' => 'Mojito',
                'brand' => 'Rum Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Cocktail Glass'
            ],
            [
                'name' => 'Cosmopolitan',
                'brand' => 'Vodka Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Cocktail Glass'
            ],
            [
                'name' => 'Daiquiri',
                'brand' => 'Rum Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Cocktail Glass'
            ],
            [
                'name' => 'Pina Colada',
                'brand' => 'Rum Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Cocktail Glass'
            ],
            [
                'name' => 'Old Fashioned',
                'brand' => 'Whiskey Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Champagne Flute'
            ],
            [
                'name' => 'Screwdriver',
                'brand' => 'Vodka Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Champagne Flute'
            ],
            [
                'name' => 'Whiskey Sour',
                'brand' => 'Whiskey Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Champagne Flute'
            ],
            [
                'name' => 'Negroni',
                'brand' => 'Gin Brand',
                'alcohol' => 'Alcoholic',
                'category' => 'Classic',
                'glass' => 'Champagne Flute'
            ],
            [
                'name' => 'Virgin Mojito',
                'brand' => 'Non-Alcoholic Brand',
                'alcohol' => 'Non_Alcoholic',
                'category' => 'Non_Alcoholic',
                'glass' => 'Champagne Flute'
            ],
        ]);
    }
}
