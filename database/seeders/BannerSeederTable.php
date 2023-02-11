<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("INSERT INTO `banners` (`id`, `image`, `title`, `text`, `priority`, `is_active`, `type`, `button_text`, `button_link`, `button_icon`, `created_at`, `updated_at`) VALUES
    (3, '2020_11_7_19_3_49_slider_1.jpg', 'لورم ایپسوم', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است', 1, 1, 'slider', 'فروشگاه', 'categories/mens-shirts', 'sli sli-basket-loaded', '2020-09-02 11:14:23', '2020-11-07 12:03:49'),
(4, '2020_11_7_19_4_2_slider_2.jpg', 'لورم ایپسوم', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است', 2, 1, 'slider', 'فروشگاه', 'categories/mens-shirts', 'sli sli-basket-loaded', '2020-09-02 11:14:58', '2020-11-07 12:04:02'),
(5, '2020_11_7_19_6_28_index_top_1.png', 'زنانه', NULL, 1, 1, 'index-top', NULL, '#', NULL, '2020-09-02 11:26:16', '2020-11-07 12:06:28'),
(6, '2020_11_7_19_6_41_index_top_2.png', 'جین', NULL, 2, 1, 'index-top', NULL, '#', NULL, '2020-09-02 11:27:51', '2020-11-07 12:06:41'),
(7, '2020_11_7_19_7_0_index_top_3.png', 'مردانه', NULL, 3, 1, 'index-top', NULL, '#', NULL, '2020-09-02 11:28:28', '2020-11-07 12:07:00'),
(8, '2020_11_7_19_7_22_index_top_4.png', 'لورم ایپسوم', 'لورم ایپسوم', 4, 1, 'index-top', 'فروشگاه', 'categories/mens-shirts', NULL, '2020-09-02 11:29:27', '2020-11-07 12:07:22'),
(9, '2020_11_7_19_7_36_index_top_5.png', 'لورم ایپسوم', 'لورم ایپسوم', 5, 1, 'index-top', 'فروشگاه', '#', NULL, '2020-09-02 11:29:55', '2020-11-07 12:07:36'),
(10, '2020_11_7_19_8_54_index_bottom_1.png', 'لورم ایپسوم', 'لورم ایپسوم', 1, 1, 'index-bottom', 'فروشگاه', 'categories/mens-shirts', NULL, '2020-09-02 11:31:05', '2020-11-07 12:08:54'),
(11, '2020_11_7_19_9_15_index_bottom_2.png', 'لورم ایپسوم', 'لورم ایپسوم', 2, 1, 'index-bottom', 'فروشگاه', 'categories/mens-shirts', NULL, '2020-09-02 11:31:36', '2020-11-07 12:09:15');
");
    }
}
