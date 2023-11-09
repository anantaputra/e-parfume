<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();

        Product::create([
           'name' => 'BTS BODY MIST',
           'category_id' => '1',
           'price' => 200000,
           'stock' => 12,
           'size' => 120,
           'fragrances' => json_encode([
               'Strawberry',
               'Violet Musk'
           ]),
           'weight' => 0.185,
           'box' => 'Soft Box',
           'description' => '<p>Toleransi size hingga ± 1cm</p>
           <p>Warna yang terlihat pada gambar mungkin tidak 100% sama dengan produk yang sebenarnya, bisa disebabkan karena proses pencahayaan pada pengambilan gambar atau kualitas layar gadget yang digunakan untuk melihat gambar.</p>
           <p>Untuk pembelian online, mohon pertimbangkan toleransi ketidaksesuaian ukuran produk yang diterima dengan sizechart yang ditampilkan, apabila terjadi ketidaksesuaian terlalu jauh dan tidak dapat diterima, silahkan ajukan penukaran barang melalui Customer Service kami.</p>',
           'images' => json_encode(['https://images.unsplash.com/photo-1587304946976-cbbbafce2133?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']),
           'rating' => 5
        ]);

        Product::create([
           'name' => 'BTS HAIR MIST',
           'category_id' => '1',
           'price' => 150000,
           'stock' => 10,
           'size' => 120,
           'fragrances' => json_encode([
               'Strawberry',
               'Violet Musk'
           ]),
           'weight' => 0.210,
           'box' => 'Soft Box',
           'description' => '<p>Toleransi size hingga ± 1cm</p>
           <p>Warna yang terlihat pada gambar mungkin tidak 100% sama dengan produk yang sebenarnya, bisa disebabkan karena proses pencahayaan pada pengambilan gambar atau kualitas layar gadget yang digunakan untuk melihat gambar.</p>
           <p>Untuk pembelian online, mohon pertimbangkan toleransi ketidaksesuaian ukuran produk yang diterima dengan sizechart yang ditampilkan, apabila terjadi ketidaksesuaian terlalu jauh dan tidak dapat diterima, silahkan ajukan penukaran barang melalui Customer Service kami.</p>',
           'images' => json_encode(['https://images.unsplash.com/photo-1587304946930-61652a3051a9?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']),
           'rating' => 5
        ]);

        Product::create([
           'name' => 'BTS PARFUMERY SPRAY',
           'category_id' => '1',
           'price' => 250000,
           'stock' => 10,
           'size' => 150,
           'fragrances' => json_encode([
               'Strawberry',
               'Violet Musk'
           ]),
           'weight' => 0.250,
           'box' => 'Soft Box',
           'description' => '<p>Toleransi size hingga ± 1cm</p>
           <p>Warna yang terlihat pada gambar mungkin tidak 100% sama dengan produk yang sebenarnya, bisa disebabkan karena proses pencahayaan pada pengambilan gambar atau kualitas layar gadget yang digunakan untuk melihat gambar.</p>
           <p>Untuk pembelian online, mohon pertimbangkan toleransi ketidaksesuaian ukuran produk yang diterima dengan sizechart yang ditampilkan, apabila terjadi ketidaksesuaian terlalu jauh dan tidak dapat diterima, silahkan ajukan penukaran barang melalui Customer Service kami.</p>',
           'images' => json_encode(['https://images.unsplash.com/photo-1587304883316-2ce43897de48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']),
           'rating' => 4
        ]);

        Product::create([
           'name' => 'BTS EAU DE PARFUM',
           'category_id' => '1',
           'price' => 280000,
           'stock' => 5,
           'size' => 150,
           'fragrances' => json_encode([
               'Mandarin',
               'Bergamot',
               'Pepper',
           ]),
           'weight' => 0.350,
           'box' => 'Soft Box',
           'description' => '<p>Toleransi size hingga ± 1cm</p>
           <p>Warna yang terlihat pada gambar mungkin tidak 100% sama dengan produk yang sebenarnya, bisa disebabkan karena proses pencahayaan pada pengambilan gambar atau kualitas layar gadget yang digunakan untuk melihat gambar.</p>
           <p>Untuk pembelian online, mohon pertimbangkan toleransi ketidaksesuaian ukuran produk yang diterima dengan sizechart yang ditampilkan, apabila terjadi ketidaksesuaian terlalu jauh dan tidak dapat diterima, silahkan ajukan penukaran barang melalui Customer Service kami.</p>',
           'images' => json_encode(['https://images.unsplash.com/photo-1581954725292-be19419dbed8?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']),
           'rating' => 5
        ]);
    }
}
