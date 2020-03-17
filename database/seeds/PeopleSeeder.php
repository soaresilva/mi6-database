<?php

use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // WARNING: this seeder truncates your people, aliases and images tables
        DB::table('people')->truncate();    // people
        DB::table('aliases')->truncate();   // aliases
        DB::table('images')->truncate();    // images

        $source_file = storage_path('data.json'); // data.json
        if (!file_exists($source_file)) {
            die('Source file '.$source_file.' not found');
        }

        $data = json_decode(file_get_contents($source_file));

        $statuses = \App\Status::pluck('name', 'id')->toArray(); // \App\Status, name, id
        $unknown_status_id = array_search('Unknown', $statuses) ?: null;

        foreach ($data as $item) {

            $image = null;
            if ($item->image) {
                $image = new \App\Image; // \App\Image
                $image->path = 'people/'.$item->image;
                $image->save();
            }

            $person = new \App\Person; // \App\Person
            if ($image) {
                $person->image_id = $image->id; // image_id
            }

            // find the right status 
            foreach ($statuses as $status_id => $name) {
                if (preg_match('#'.preg_quote($name, '#').'#i', $item->status)) {
                    $person->status_id = $status_id;
                    break;
                }
            }

            // if not found, set the Unknown status
            if (null === $person->status_id) {
                $person->status_id = $unknown_status_id;
            }

            $person->name = $item->name;                // name
            $person->title = $item->title;              // title
            $person->age = $item->age;                  // age
            $person->born = $item->born;                // born
            $person->died = $item->died;                // died
            $person->features = $item->features;        // features
            $person->hair_color = $item->hair_color;    // hair_color
            $person->eye_color = $item->eye_color;      // eye_color
            $person->height = $item->height;            // height
            $person->weight = $item->weight;            // weight
            $person->nationality = $item->nationality;  // nationality
            $person->occupation = $item->occupation;    // occupation
            $person->status_text = $item->status;       // status

            $person->save();

            foreach ($item->aliases as $alias_name) {
                $alias = new \App\Alias;            // \App\Alias
                $alias->person_id = $person->id;    // person_id
                $alias->alias = $alias_name;        // alias
                $alias->save();
            }
        }
    }
}
