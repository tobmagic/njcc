<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $admin = User::where('email', 'admin@example.com')->first();

        // Scraped blog posts (full content placeholders; replace with actual scraped text)
        Post::create([
            'title' => 'TICAD 2025 Preview: Strategic Opportunities for Nigerian Businesses at Japan’s Premier Africa Conference',
            'slug' => 'ticad-2025-preview-strategic-opportunities-for-nigerian-businesses-at-japans-premier-africa-conference',
            'content' => '<h2>Inside Access to High-Level Diplomatic and Business Networking</h2><p>The Tokyo International Conference on African Development (TICAD) is Japan’s flagship... [Paste full scraped content here, including all paragraphs and subsections]</p>',
            'published_at' => '2025-08-07',  // Adjust dates as per scrape
            'user_id' => $admin->id,
        ]);

        Post::create([
            'title' => 'From Economic Crisis to Comeback: How Nigeria-Japan Trade Relations Are Rebounding Stronger',
            'slug' => 'from-economic-crisis-to-comeback-how-nigeria-japan-trade-relations-are-rebounding-stronger',
            'content' => '<h2>The Inside Story of Our Chamber’s Resilience...</h2><p>Over the past few years... [Paste full scraped content here]</p>',
            'published_at' => '2025-08-07',
            'user_id' => $admin->id,
        ]);

        // Add the other 4 scraped posts similarly: Osaka Expo, Japanese Etiquette, 5 Products, Diaspora Milestone.
        // Use full content from the scrape.

        // Fake posts for testing
        Post::factory(10)->create(['user_id' => $admin->id]);
    }
}
