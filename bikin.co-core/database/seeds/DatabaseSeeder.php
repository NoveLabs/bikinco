<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UsersRolesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SubCategoriesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(VariantSeeder::class);
        $this->call(SubvariantSeeder::class);
        $this->call(ProductModelSeeder::class);
        $this->call(SizepackSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(SizesSeeder::class);
        $this->call(SizeTypesSeeder::class);
        $this->call(ProductArtworkPrintMethodSeeder::class);
        $this->call(ProductArtworkPrintTypeSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ClusterSeeder::class);
        $this->call(WashingAddonSeeder::class);
    }
}
