<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class RelationSheepSeeder extends Seeder
{
    public function run(): void
    {
        $glueck    = Topic::create(['name' => 'Glück',      'slug' => 'glueck']);
        $beziehung = Topic::create(['name' => 'Beziehung',  'slug' => 'beziehung']);
        $alltag    = Topic::create(['name' => 'Alltag',     'slug' => 'alltag']);

        $autor = Author::create(['name' => 'Kai Pflaume']);

        $post1 = Post::create([
            'topic_id'  => $glueck->id,
            'author_id' => $autor->id,
            'title'     => 'Tipp zum Glück',
            'content'   => 'Denke an etwas, das dich glücklich macht.',
        ]);

        $post2 = Post::create([
            'topic_id'  => $beziehung->id,
            'author_id' => $autor->id,
            'title'     => 'Tipp für Beziehungen',
            'content'   => 'Mach dir keine Sorgen, wenn du nicht die perfekte Beziehung hast. Es gibt auch keine perfekten Menschen.',
        ]);

        $post3 = Post::create([
            'topic_id'  => $alltag->id,
            'author_id' => $autor->id,
            'title'     => 'Tipp für den Alltag',
            'content'   => 'Wenn du dich schlecht fühlst, dann denke daran, dass es auch andere Menschen gibt, die sich schlecht fühlen.',
        ]);

        $spruch = Tag::create(['name' => 'Spruch', 'slug' => 'spruch']);

        $post1->tags()->attach($spruch);
        $post2->tags()->attach($spruch);
    }
}
