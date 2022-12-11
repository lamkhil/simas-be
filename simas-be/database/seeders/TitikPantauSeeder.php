<?php

namespace Database\Seeders;

use App\Models\TitikPantau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitikPantauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TitikPantau::create([
            'nama' => 'Subdas Sumber Brantas Arboretum',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.759076,
            'latitude' => 112.5255058
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Coban Talun',
            'desa' => 'Talun',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8039179,
            'latitude' => 112.4989693
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Tulungrejo Payan Atas',
            'desa' => 'Tulungrejo',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.823405,
            'latitude' => 112.5225026
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Tulungrejo Kungkuk',
            'desa' => 'Kungkuk',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8249257,
            'latitude' => 112.5186228
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Junggo Banyuning Ds.Punten',
            'desa' => 'Punten',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8002167,
            'latitude' => 112.5316518
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Brugan',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.758521,
            'latitude' => 112.526074
        ]);
        TitikPantau::create([
            'nama' => 'Jembatan Kekep',
            'desa' => 'Tulungrejo',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8200047,
            'latitude' => 112.5196528,
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Sumber Brantas (Dekat Makam)',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.7672614,
            'latitude' => 112.5232923
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Brugan (Punden Sumberrejo 1)',
            'desa' => 'Gunung Sari',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8425477,
            'latitude' => 112.5163778
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Sumbergunung (Metro 1 Ds.Sidomulyo)',
            'desa' => 'Sidomulyo',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8602587,
            'latitude' => 112.5201068
        ]);
        TitikPantau::create([
            'nama' => 'Jembatan Punden',
            'desa' => 'Gunung Sari',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8411387,
            'latitude' => 112.5218048
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Ngunjung (Sebelah Kantor Pajak)',
            'desa' => 'Sidomulyo',
            'kecamatan' => 'Batu',
            'longitude' => -7.865253,
            'latitude' => 112.530452
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali lanang(masukan dari kali lanang Ds.Giripurno)',
            'desa' => 'Giripurno',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8751225,
            'latitude' => 112.5541175
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali lanang (Jurang Susuh Ds.Giripurno)',
            'desa' => 'Giripurno',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.8732837,
            'latitude' => 112.5464048
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Lanang (Dekat Dam Temas)',
            'desa' => 'Temas',
            'kecamatan' => 'Batu',
            'longitude' => -7.8729087,
            'latitude' => 112.5358046
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Mranak (Dekat Archa Ganesta)',
            'desa' => 'Torongrejo',
            'kecamatan' => 'Junrejo',
            'longitude' => -7.8822353,
            'latitude' => 112.5629917
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Mewek (Dekat Tambang Pasir)',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.758521,
            'latitude' => 112.526074
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Mewek (Depan Gardu Induk PLN)',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.758521,
            'latitude' => 112.526074
        ]);
        TitikPantau::create([
            'nama' => 'Subdas Kali Ampu (Depan Catring Bu Gito)',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.9082932,
            'latitude' => 112.5799188
        ]);
        TitikPantau::create([
            'nama' => 'Kali Mewek Kel.Dadaprejo,Sumberjo',
            'desa' => 'Sumberjo',
            'kecamatan' => 'Dadaprejo',
            'longitude' => -7.9131617,
            'latitude' => 112.5775998,
        ]);
    }
}
