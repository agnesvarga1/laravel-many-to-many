<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i=0; $i<5;$i++){
            $project = new Project();
            $project->project_name = $faker->words(3, true);
            $project-> description = $faker->text(200);
            $project-> slug = Str::slug($project->project_name,'-');
            $project->image = null;
            $project-> website = $faker->url();
            $project->save();
        }
    }
}
