<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingSetting;
use App\Models\LandingProgram;
use App\Models\LandingNavLink;
use App\Models\LandingFooterLink;

class LandingSeeder extends Seeder
{
    public function run(): void
    {
        /** ===============================
         * LANDING SETTINGS (Hero Section)
         * =============================== */
        $settings = [
            ['hero_title', 'Kampus Vokasi Terbaik Untuk Masa Depan Karier Anda', 'text'],
            ['hero_subtitle', 'LP3I hadir dengan fokus pendidikan vokasi yang relevan dengan dunia kerja. Raih keterampilan praktis dan peluang karier lebih cepat bersama kami.', 'text'],
            ['hero_image', 'landing/hero-lp3i.jpg', 'image'],
            ['footer_text', '© 2025 LP3I College - All Rights Reserved', 'text'],
        ];

        foreach ($settings as $item) {
            LandingSetting::updateOrCreate(
                ['key' => $item[0]],
                ['value' => $item[1], 'type' => $item[2], 'status' => 1]
            );
        }

        /** ===============================
         * NAVIGATION MENU
         * =============================== */
        $navLinks = [
            ['Beranda', '#beranda', 1],
            ['Program', '#program', 2],
            ['Tentang', '#tentang', 3],
            ['Kontak', '#kontak', 4],
        ];

        foreach ($navLinks as $item) {
            LandingNavLink::updateOrCreate(
                ['label' => $item[0]],
                ['url' => $item[1], 'position' => $item[2], 'status' => 1]
            );
        }

        /** ===============================
         * PROGRAM PENDIDIKAN SECTION
         * =============================== */
        $programs = [
            ['Administrasi Bisnis', 'Belajar pengelolaan bisnis, administrasi perkantoran, dan dunia manajemen modern.', null, 1],
            ['Informatika & Komputer', 'Program vokasi untuk dunia IT: pemrograman, jaringan, dan data.', null, 2],
            ['Digital Marketing', 'Menguasai strategi pemasaran digital sesuai kebutuhan industri.', null, 3],
        ];

        foreach ($programs as $item) {
            LandingProgram::updateOrCreate(
                ['title' => $item[0]],
                [
                    'description' => $item[1],
                    'image' => $item[2],
                    'position' => $item[3],
                    'status' => 1
                ]
            );
        }

        /** ===============================
         * FOOTER LINKS
         * =============================== */
        $footerLinks = [
            ['Beranda', '#beranda', 1],
            ['Program', '#program', 2],
            ['Tentang', '#tentang', 3],
            ['Kontak', '#kontak', 4],
            ['Email: info@lp3i.ac.id', 'mailto:info@lp3i.ac.id', 5],
            ['Telp: (021) 12345678', 'tel:+622112345678', 6],
        ];

        foreach ($footerLinks as $item) {
            LandingFooterLink::updateOrCreate(
                ['label' => $item[0]],
                ['url' => $item[1], 'position' => $item[2], 'status' => 1]
            );
        }
    }
}