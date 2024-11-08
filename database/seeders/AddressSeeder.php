<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Addis Ababa', 'code' => 'AA'],
            ['name' => 'Dire Dawa', 'code' => 'DD'],
            
            // Oromia Region
            ['name' => 'Adama', 'code' => 'OR'],
            ['name' => 'Jimma', 'code' => 'OR'],
            ['name' => 'Bishoftu', 'code' => 'OR'],
            ['name' => 'Shashamane', 'code' => 'OR'],
            ['name' => 'Ambo', 'code' => 'OR'],
            ['name' => 'Asella', 'code' => 'OR'],
            ['name' => 'Nekemte', 'code' => 'OR'],
            ['name' => 'Dembi Dolo', 'code' => 'OR'],
            ['name' => 'Metu', 'code' => 'OR'],
            ['name' => 'Woliso', 'code' => 'OR'],
            ['name' => 'Goba', 'code' => 'OR'],
            ['name' => 'Fiche', 'code' => 'OR'],
            ['name' => 'Gimbi', 'code' => 'OR'],
            ['name' => 'Bedele', 'code' => 'OR'],
            ['name' => 'Moyale', 'code' => 'OR'],
            ['name' => 'Wenchi', 'code' => 'OR'],
            ['name' => 'Ziway', 'code' => 'OR'],
            ['name' => 'Guder', 'code' => 'OR'],
            ['name' => 'Sire', 'code' => 'OR'],
            ['name' => 'Tulu Bolo', 'code' => 'OR'],
            
            // Amhara Region
            ['name' => 'Bahir Dar', 'code' => 'AM'],
            ['name' => 'Gondar', 'code' => 'AM'],
            ['name' => 'Debre Berhan', 'code' => 'AM'],
            ['name' => 'Dessie', 'code' => 'AM'],
            ['name' => 'Debre Markos', 'code' => 'AM'],
            ['name' => 'Woldia', 'code' => 'AM'],
            ['name' => 'Debre Tabor', 'code' => 'AM'],
            ['name' => 'Debark', 'code' => 'AM'],
            ['name' => 'Kemise', 'code' => 'AM'],
            ['name' => 'Lalibela', 'code' => 'AM'],
            ['name' => 'Kobo', 'code' => 'AM'],
            ['name' => 'Finote Selam', 'code' => 'AM'],
            ['name' => 'Metema', 'code' => 'AM'],
            ['name' => 'Dejen', 'code' => 'AM'],
            ['name' => 'Addis Zemen', 'code' => 'AM'],
            ['name' => 'Mota', 'code' => 'AM'],

            // SNNPR Region
            ['name' => 'Hawassa', 'code' => 'SN'],
            ['name' => 'Arba Minch', 'code' => 'SN'],
            ['name' => 'Wolaita Sodo', 'code' => 'SN'],
            ['name' => 'Dilla', 'code' => 'SN'],
            ['name' => 'Hosaena', 'code' => 'SN'],
            ['name' => 'Bonga', 'code' => 'SN'],
            ['name' => 'Sawla', 'code' => 'SN'],
            ['name' => 'Yirgalem', 'code' => 'SN'],
            ['name' => 'Jinka', 'code' => 'SN'],
            ['name' => 'Tepi', 'code' => 'SN'],
            ['name' => 'Wendo Genet', 'code' => 'SN'],
            ['name' => 'Areka', 'code' => 'SN'],
            ['name' => 'Durame', 'code' => 'SN'],

            // Tigray Region
            ['name' => 'Mekelle', 'code' => 'TG'],
            ['name' => 'Adigrat', 'code' => 'TG'],
            ['name' => 'Axum', 'code' => 'TG'],
            ['name' => 'Shire', 'code' => 'TG'],
            ['name' => 'Alamata', 'code' => 'TG'],
            ['name' => 'Adwa', 'code' => 'TG'],
            ['name' => 'Rama', 'code' => 'TG'],
            ['name' => 'Wukro', 'code' => 'TG'],

            // Afar Region
            ['name' => 'Semera', 'code' => 'AF'],
            ['name' => 'Awash', 'code' => 'AF'],
            ['name' => 'Logiya', 'code' => 'AF'],
            ['name' => 'Dubti', 'code' => 'AF'],
            ['name' => 'Asayita', 'code' => 'AF'],

            // Somali Region
            ['name' => 'Jijiga', 'code' => 'SM'],
            ['name' => 'Gode', 'code' => 'SM'],
            ['name' => 'Degehabur', 'code' => 'SM'],
            ['name' => 'Shilabo', 'code' => 'SM'],
            ['name' => 'Fik', 'code' => 'SM'],
            ['name' => 'Kebri Dahar', 'code' => 'SM'],
            ['name' => 'Wardheer', 'code' => 'SM'],

            // Benishangul-Gumuz Region
            ['name' => 'Assosa', 'code' => 'BG'],
            ['name' => 'Gilgil Beles', 'code' => 'BG'],
            ['name' => 'Kemashi', 'code' => 'BG'],
            ['name' => 'Mandura', 'code' => 'BG'],

            // Gambela Region
            ['name' => 'Gambela', 'code' => 'GB'],
            ['name' => 'Itang', 'code' => 'GB'],
            ['name' => 'Meti', 'code' => 'GB'],

            // Additional Cities
            ['name' => 'Abomsa', 'code' => 'OR'],
            ['name' => 'Agaro', 'code' => 'OR'],
            ['name' => 'Arsi Negele', 'code' => 'OR'],
            ['name' => 'Bati', 'code' => 'AM'],
            ['name' => 'Chelenko', 'code' => 'OR'],
            ['name' => 'Dolo Odo', 'code' => 'SM'],
            ['name' => 'Enjibara', 'code' => 'AM'],
            ['name' => 'Ginchi', 'code' => 'OR'],
            ['name' => 'Huruta', 'code' => 'OR'],
            ['name' => 'Kombolcha', 'code' => 'AM'],
            ['name' => 'Mojo', 'code' => 'OR'],
            ['name' => 'Robi', 'code' => 'OR'],
            ['name' => 'Yabello', 'code' => 'OR'],
            ['name' => 'Zala', 'code' => 'SN'],
            ['name' => 'Senkata', 'code' => 'SN'],
            ['name' => 'Aleta Wondo', 'code' => 'SN'],
            ['name' => 'Gedeb', 'code' => 'SN'],
            ['name' => 'Qola Diba', 'code' => 'AM'],
            ['name' => 'Bambasi', 'code' => 'BG'],
        ];

        Address::insert($cities);
    }
}
