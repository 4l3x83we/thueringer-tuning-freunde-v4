<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: GenerateSitemapCommand.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2022
 * Time: 13:38
 */

namespace App\Console\Commands;

use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use File;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'generate:sitemap';

    protected $description = 'Generieren Sie die Sitemap.';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/#ueber-uns'))
            ->add(Url::create('/team'))
            ->add(Url::create('/fahrzeuge'))
            ->add(Url::create('/galerie'))
            ->add(Url::create('/#veranstaltungen'))
            ->add(Url::create('/kontakt'))
            ->add(Url::create('/antrag'))
            ->add(Url::create('/gaestebuch'))
            ->add(Url::create('/impressum'))
            ->add(Url::create('/datenschutz'));

        if (!File::exists(public_path('sitemap.xml'))) {
            File::put(public_path('sitemap.xml'), '<?xml version="1.0" encoding="UTF-8"?>');
        }

        $teams = Team::where('published', true)->get();
        foreach ($teams as $team) {
            $sitemap->add(Url::create("/team/{$team->slug}"));
        }

        $fahrzeuges = Fahrzeug::where('published', true)->get();
        foreach ($fahrzeuges as $fahrzeuge) {
            $sitemap->add(Url::create("/fahrzeuge/{$fahrzeuge->slug}"));
        }

        $galleries = Album::where('published', true)->get();
        foreach ($galleries as $galerie) {
            $sitemap->add(Url::create("/galerie/{$galerie->slug}"));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
