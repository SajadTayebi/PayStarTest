<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'اردبيل', NULL, NULL),
(2, 'اصفهان', NULL, NULL),
(3, 'البرز', NULL, NULL),
(4, 'ايلام', NULL, NULL),
(5, 'آذربايجان شرقي', NULL, NULL),
(6, 'آذربايجان غربي', NULL, NULL),
(7, 'بوشهر', NULL, NULL),
(8, 'تهران', NULL, NULL),
(9, 'چهارمحال وبختياري', NULL, NULL),
(10, 'خراسان جنوبي', NULL, NULL),
(11, 'خراسان رضوي', NULL, NULL),
(12, 'خراسان شمالي', NULL, NULL),
(13, 'خوزستان', NULL, NULL),
(14, 'زنجان', NULL, NULL),
(15, 'سمنان', NULL, NULL),
(16, 'سيستان وبلوچستان', NULL, NULL),
(17, 'فارس', NULL, NULL),
(18, 'قزوين', NULL, NULL),
(19, 'قم', NULL, NULL),
(20, 'كردستان', NULL, NULL),
(21, 'كرمان', NULL, NULL),
(22, 'كرمانشاه', NULL, NULL),
(23, 'كهگيلويه وبويراحمد', NULL, NULL),
(24, 'گلستان', NULL, NULL),
(25, 'گيلان', NULL, NULL),
(26, 'لرستان', NULL, NULL),
(27, 'مازندران', NULL, NULL),
(28, 'مركزي', NULL, NULL),
(29, 'هرمزگان', NULL, NULL),
(30, 'همدان', NULL, NULL),
(31, 'يزد', NULL, NULL);
");
    }
}
