<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::table('users')->insert([

            [
                'name' => 'Ahmed Al-Harbi',
                'email' => 'ahmed@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara Al-Mutairi',
                'email' => 'sara@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fahad Al-Otaibi',
                'email' => 'fahad@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Noura Al-Qahtani',
                'email' => 'noura@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Majed Al-Shehri',
                'email' => 'majed@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        // Insert categories
        DB::table('categories')->insert([
            ['name' => 'Horror Games', 'slug' => 'horror-games', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Action Games', 'slug' => 'action-games', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Puzzle Games', 'slug' => 'puzzle-games', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kids Friendly', 'slug' => 'kids-friendly', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Popular Games', 'slug' => 'popular-games', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert 25 games
        $games = [

            // HORROR = category_id 1
            [
                'name' => 'Silent Hill 4',
                'slug' => 'silent-hill-4',
                'description' => 'Horror survival game.',
                'platform' => 'PC',
                'image' => 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/19000/header.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Resident Evil Village',
                'slug' => 'resident-evil-village',
                'description' => 'Horror action game.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1196590/header.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Outlast',
                'slug' => 'outlast',
                'description' => 'First person horror.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/238320/header.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Amnesia Rebirth',
                'slug' => 'amnesia-rebirth',
                'description' => 'Horror atmosphere.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/999220/header.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Dead Space Remake',
                'slug' => 'dead-space-remake',
                'description' => 'Sci-fi horror.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1693980/header.jpg',
                'category_id' => 1,
            ],

            // ACTION = category_id 2
            [
                'name' => 'Call of Duty MW2',
                'slug' => 'cod-mw2',
                'description' => 'Action shooter.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1938090/header.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'GTA V',
                'slug' => 'gta-v',
                'description' => 'Action open world.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/271590/header.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Red Dead Redemption 2',
                'slug' => 'rdr2',
                'description' => 'Western action.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1174180/header.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'God of War',
                'slug' => 'god-of-war',
                'description' => 'Action mythology.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1593500/header.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Assassin’s Creed Valhalla',
                'slug' => 'ac-valhalla',
                'description' => 'Action RPG.',
                'platform' => 'PC',
                'image' => 'https://staticctf.ubisoft.com/Jk0H5SEPEjWamrtMbPvFAg/1yUhx2pjOL6FL1_YujmkQ8/2f29b52fffe1808692975286d82da651/ACV_KeyArt_Store_Portrait_2020.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Tomb Raider',
                'slug' => 'tomb-raider',
                'description' => 'Action adventure.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/203160/header.jpg',
                'category_id' => 2,
            ],

            // PUZZLE = category_id 3
            [
                'name' => 'Portal 2',
                'slug' => 'portal-2',
                'description' => 'Puzzle action.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/620/header.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Inside',
                'slug' => 'inside',
                'description' => 'Puzzle adventure.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/304430/header.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'The Witness',
                'slug' => 'the-witness',
                'description' => 'Puzzle open world.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/210970/header.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Limbo',
                'slug' => 'limbo',
                'description' => 'Puzzle dark theme.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/48000/header.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Little Nightmares',
                'slug' => 'little-nightmares',
                'description' => 'Puzzle horror.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/424840/header.jpg',
                'category_id' => 3,
            ],

            // KIDS FRIENDLY = category_id 4
            [
                'name' => 'Minecraft',
                'slug' => 'minecraft',
                'description' => 'Kids friendly creativity.',
                'platform' => 'PC',
                'image' => 'https://cdn.mos.cms.futurecdn.net/fdhFhIuw3LBzp14AeVt5VH.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Lego Star Wars',
                'slug' => 'lego-star-wars',
                'description' => 'Kids action.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/920210/header.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Super Mario Bros',
                'slug' => 'super-mario-bros',
                'description' => 'Kids platformer.',
                'platform' => 'Nintendo',
                'image' => 'https://m.media-amazon.com/images/I/81-yKbVND-L._AC_UF894,1000_QL80_.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Roblox',
                'slug' => 'roblox',
                'description' => 'Kids creativity.',
                'platform' => 'PC',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/3/39/Roblox_logo_2022.jpg',
                'category_id' => 4,
            ],

            // POPULAR = category_id 5
            [
                'name' => 'Fortnite',
                'slug' => 'fortnite',
                'description' => 'Popular battle royale.',
                'platform' => 'PC',
                'image' => 'https://cdn2.unrealengine.com/fortnite-chapter-4-season-4-key-art-1920x1080-f8e43a0cfc2c.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'FIFA 23',
                'slug' => 'fifa-23',
                'description' => 'Football game.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1811260/header.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Valorant',
                'slug' => 'valorant',
                'description' => 'Popular tactical shooter.',
                'platform' => 'PC',
                'image' => 'https://images.contentstack.io/v3/assets/bltb6530b271fddd0b1/blt8b996b37534f7b14/60b064764cd88b3cdf6ed281/val-key-art.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Fall Guys',
                'slug' => 'fall-guys',
                'description' => 'Popular fun game.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1097150/header.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Rocket League',
                'slug' => 'rocket-league',
                'description' => 'Popular sports game.',
                'platform' => 'PC',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/252950/header.jpg',
                'category_id' => 5,
            ],
        ];

        DB::table('games')->insert($games);
    }

    public function down()
    {
        DB::table('games')->truncate();
        DB::table('categories')->truncate();
    }


};
