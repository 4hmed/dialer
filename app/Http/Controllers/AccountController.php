<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $countries = array(0 => array('name' => 'Afghanistan (‫افغانستان‬‎)', 'iso' => 'AF', 'code' => '+93'),
            1 => array('name' => 'Åland Islands (Åland)', 'iso' => 'AX', 'code' => '+358'),
            2 => array('name' => 'Albania (Shqipëri)', 'iso' => 'AL', 'code' => '+355'),
            3 => array('name' => 'Algeria (‫الجزائر‬‎)', 'iso' => 'DZ', 'code' => '+213'),
            4 => array('name' => 'American Samoa', 'iso' => 'AS', 'code' => '+1'),
            5 => array('name' => 'Andorra', 'iso' => 'AD', 'code' => '+376'),
            6 => array('name' => 'Angola', 'iso' => 'AO', 'code' => '+244'),
            7 => array('name' => 'Anguilla', 'iso' => 'AI', 'code' => '+1'),
            8 => array('name' => 'Antarctica', 'iso' => 'AQ', 'code' => '+672'),
            9 => array('name' => 'Antigua and Barbuda', 'iso' => 'AG', 'code' => '+1'),
            10 => array('name' => 'Argentina', 'iso' => 'AR', 'code' => '+54'),
            11 => array('name' => 'Armenia (Հայաստան)', 'iso' => 'AM', 'code' => '+374'),
            12 => array('name' => 'Aruba', 'iso' => 'AW', 'code' => '+297'),
            13 => array('name' => 'Australia', 'iso' => 'AU', 'code' => '+61'),
            14 => array('name' => 'Austria (Österreich)', 'iso' => 'AT', 'code' => '+43'),
            15 => array('name' => 'Azerbaijan (Azərbaycan)', 'iso' => 'AZ', 'code' => '+994'),
            16 => array('name' => 'Bahamas', 'iso' => 'BS', 'code' => '+1'),
            17 => array('name' => 'Bahrain (‫البحرين‬‎)', 'iso' => 'BH', 'code' => '+973'),
            18 => array('name' => 'Bangladesh (বাংলাদেশ)', 'iso' => 'BD', 'code' => '+880'),
            19 => array('name' => 'Barbados', 'iso' => 'BB', 'code' => '+1'),
            20 => array('name' => 'Belarus (Беларусь)', 'iso' => 'BY', 'code' => '+375'),
            21 => array('name' => 'Belgium (België)', 'iso' => 'BE', 'code' => '+32'),
            22 => array('name' => 'Belize', 'iso' => 'BZ', 'code' => '+501'),
            23 => array('name' => 'Benin (Bénin)', 'iso' => 'BJ', 'code' => '+229'),
            24 => array('name' => 'Bermuda', 'iso' => 'BM', 'code' => '+1'),
            25 => array('name' => 'Bhutan (འབྲུག)', 'iso' => 'BT', 'code' => '+975'),
            26 => array('name' => 'Bolivia', 'iso' => 'BO', 'code' => '+591'),
            27 => array('name' => 'Bosnia and Herzegovina (Босна и Херцеговина)', 'iso' => 'BA', 'code' => '+387'),
            28 => array('name' => 'Botswana', 'iso' => 'BW', 'code' => '+267'),
            29 => array('name' => 'Bouvet Island', 'iso' => 'BV', 'code' => '+55'),
            30 => array('name' => 'Brazil (Brasil)', 'iso' => 'BR', 'code' => '+55'),
            31 => array('name' => 'British Indian Ocean Territory', 'iso' => 'IO', 'code' => '+246'),
            32 => array('name' => 'British Virgin Islands', 'iso' => 'VG', 'code' => '+1'),
            33 => array('name' => 'Brunei', 'iso' => 'BN', 'code' => '+673'),
            34 => array('name' => 'Bulgaria (България)', 'iso' => 'BG', 'code' => '+359'),
            35 => array('name' => 'Burkina Faso', 'iso' => 'BF', 'code' => '+226'),
            36 => array('name' => 'Burundi (Uburundi)', 'iso' => 'BI', 'code' => '+257'),
            37 => array('name' => 'Cambodia (កម្ពុជា)', 'iso' => 'KH', 'code' => '+855'),
            38 => array('name' => 'Cameroon (Cameroun)', 'iso' => 'CM', 'code' => '+237'),
            39 => array('name' => 'Canada', 'iso' => 'CA', 'code' => '+1'),
            40 => array('name' => 'Cape Verde (Kabu Verdi)', 'iso' => 'CV', 'code' => '+238'),
            41 => array('name' => 'Cayman Islands', 'iso' => 'KY', 'code' => '+1'),
            42 => array('name' => 'Central African Republic (République centrafricaine)', 'iso' => 'CF', 'code' => '+236'),
            43 => array('name' => 'Chad (Tchad)', 'iso' => 'TD', 'code' => '+235'),
            44 => array('name' => 'Chile', 'iso' => 'CL', 'code' => '+56'),
            45 => array('name' => 'China (中国)', 'iso' => 'CN', 'code' => '+86'),
            46 => array('name' => 'Christmas Island', 'iso' => 'CX', 'code' => '+61'),
            47 => array('name' => 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'iso' => 'CC', 'code' => '+891'),
            48 => array('name' => 'Colombia', 'iso' => 'CO', 'code' => '+57'),
            49 => array('name' => 'Comoros (‫جزر القمر‬‎)', 'iso' => 'KM', 'code' => '+269'),
            50 => array('name' => 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'iso' => 'CD', 'code' => '+243'),
            51 => array('name' => 'Congo (Republic) (Congo-Brazzaville)', 'iso' => 'CG', 'code' => '+242'),
            52 => array('name' => 'Cook Islands', 'iso' => 'CK', 'code' => '+682'),
            53 => array('name' => 'Costa Rica', 'iso' => 'CR', 'code' => '+506'),
            54 => array('name' => 'Côte d’Ivoire', 'iso' => 'CI', 'code' => '+225'),
            55 => array('name' => 'Croatia (Hrvatska)', 'iso' => 'HR', 'code' => '+385'),
            56 => array('name' => 'Cuba', 'iso' => 'CU', 'code' => '+53'),
            57 => array('name' => 'Cyprus (Κύπρος)', 'iso' => 'CY', 'code' => '+357'),
            58 => array('name' => 'Czech Republic (Česká republika)', 'iso' => 'CZ', 'code' => '+420'),
            59 => array('name' => 'Denmark (Danmark)', 'iso' => 'DK', 'code' => '+45'),
            60 => array('name' => 'Djibouti', 'iso' => 'DJ', 'code' => '+253'),
            61 => array('name' => 'Dominica', 'iso' => 'DM', 'code' => '+1'),
            62 => array('name' => 'Dominican Republic (República Dominicana)', 'iso' => 'DO', 'code' => '+1'),
            63 => array('name' => 'Ecuador', 'iso' => 'EC', 'code' => '+593'),
            64 => array('name' => 'Egypt (‫مصر‬‎)', 'iso' => 'EG', 'code' => '+20'),
            65 => array('name' => 'El Salvador', 'iso' => 'SV', 'code' => '+503'),
            66 => array('name' => 'Equatorial Guinea (Guinea Ecuatorial)', 'iso' => 'GQ', 'code' => '+240'),
            67 => array('name' => 'Eritrea', 'iso' => 'ER', 'code' => '+291'),
            68 => array('name' => 'Estonia (Eesti)', 'iso' => 'EE', 'code' => '+372'),
            69 => array('name' => 'Ethiopia', 'iso' => 'ET', 'code' => '+251'),
            70 => array('name' => 'Faroe Islands (Føroyar)', 'iso' => 'FO', 'code' => '+298'),
            71 => array('name' => 'Falkland Islands (Islas Malvinas)', 'iso' => 'FK', 'code' => '+500'),
            72 => array('name' => 'Fiji', 'iso' => 'FJ', 'code' => '+679'),
            73 => array('name' => 'Finland (Suomi)', 'iso' => 'FI', 'code' => '+358'),
            74 => array('name' => 'France', 'iso' => 'FR', 'code' => '+33'),
            75 => array('name' => 'French Guiana (Guyane française)', 'iso' => 'GF', 'code' => '+594'),
            76 => array('name' => 'French Polynesia (Polynésie française)', 'iso' => 'PF', 'code' => '+689'),
            77 => array('name' => 'French Southern Territories (Terres australes françaises)', 'iso' => 'TF', 'code' => '+262'),
            78 => array('name' => 'Gabon', 'iso' => 'GA', 'code' => '+241'),
            79 => array('name' => 'Gambia', 'iso' => 'GM', 'code' => '+220'),
            80 => array('name' => 'Georgia (საქართველო)', 'iso' => 'GE', 'code' => '+995'),
            81 => array('name' => 'Germany (Deutschland)', 'iso' => 'DE', 'code' => '+49'),
            82 => array('name' => 'Ghana (Gaana)', 'iso' => 'GH', 'code' => '+233'),
            83 => array('name' => 'Gibraltar', 'iso' => 'GI', 'code' => '+350'),
            84 => array('name' => 'Greece (Ελλάδα)', 'iso' => 'GR', 'code' => '+30'),
            85 => array('name' => 'Greenland (Kalaallit Nunaat)', 'iso' => 'GL', 'code' => '+299'),
            86 => array('name' => 'Grenada', 'iso' => 'GD', 'code' => '+1'),
            87 => array('name' => 'Guadeloupe', 'iso' => 'GP', 'code' => '+590'),
            88 => array('name' => 'Guam', 'iso' => 'GU', 'code' => '+1'),
            89 => array('name' => 'Guatemala', 'iso' => 'GT', 'code' => '+502'),
            90 => array('name' => 'Guernsey', 'iso' => 'GG', 'code' => '+44'),
            91 => array('name' => 'Guinea (Guinée)', 'iso' => 'GN', 'code' => '+224'),
            92 => array('name' => 'Guinea-Bissau (Guiné Bissau)', 'iso' => 'GW', 'code' => '+245'),
            93 => array('name' => 'Guyana', 'iso' => 'GY', 'code' => '+592'),
            94 => array('name' => 'Haiti', 'iso' => 'HT', 'code' => '+509'),
            95 => array('name' => 'Heard & McDonald Islands', 'iso' => 'HM', 'code' => '-'),
            96 => array('name' => 'Vatican City (Città del Vaticano)', 'iso' => 'VA', 'code' => '+39'),
            97 => array('name' => 'Honduras', 'iso' => 'HN', 'code' => '+504'),
            98 => array('name' => 'Hong Kong (香港)', 'iso' => 'HK', 'code' => '+852'),
            99 => array('name' => 'Hungary (Magyarország)', 'iso' => 'HU', 'code' => '+36'),
            100 => array('name' => 'Iceland (Ísland)', 'iso' => 'IS', 'code' => '+354'),
            101 => array('name' => 'India (भारत)', 'iso' => 'IN', 'code' => '+91'),
            102 => array('name' => 'Indonesia', 'iso' => 'ID', 'code' => '+62'),
            103 => array('name' => 'Iran (‫ایران‬‎)', 'iso' => 'IR', 'code' => '+98'),
            104 => array('name' => 'Iraq (‫العراق‬‎)', 'iso' => 'IQ', 'code' => '+964'),
            105 => array('name' => 'Ireland', 'iso' => 'IE', 'code' => '+353'),
            106 => array('name' => 'Isle of Man', 'iso' => 'IM', 'code' => '+44'),
            107 => array('name' => 'Israel (‫ישראל‬‎)', 'iso' => 'IL', 'code' => '+972'),
            108 => array('name' => 'Italy (Italia)', 'iso' => 'IT', 'code' => '+39'),
            109 => array('name' => 'Jamaica', 'iso' => 'JM', 'code' => '+1'),
            110 => array('name' => 'Japan (日本)', 'iso' => 'JP', 'code' => '+81'),
            111 => array('name' => 'Jersey', 'iso' => 'JE', 'code' => '+44'),
            112 => array('name' => 'Jordan (‫الأردن‬‎)', 'iso' => 'JO', 'code' => '+962'),
            113 => array('name' => 'Kazakhstan (Казахстан)', 'iso' => 'KZ', 'code' => '+7'),
            114 => array('name' => 'Kenya', 'iso' => 'KE', 'code' => '+254'),
            115 => array('name' => 'Kiribati', 'iso' => 'KI', 'code' => '+686'),
            116 => array('name' => 'North Korea (조선 민주주의 인민 공화국)', 'iso' => 'KP', 'code' => '+850'),
            117 => array('name' => 'South Korea (대한민국)', 'iso' => 'KR', 'code' => '+82'),
            118 => array('name' => 'Kuwait (‫الكويت‬‎)', 'iso' => 'KW', 'code' => '+965'),
            119 => array('name' => 'Kyrgyzstan (Кыргызстан)', 'iso' => 'KG', 'code' => '+996'),
            120 => array('name' => 'Laos (ລາວ)', 'iso' => 'LA', 'code' => '+856'),
            121 => array('name' => 'Latvia (Latvija)', 'iso' => 'LV', 'code' => '+371'),
            122 => array('name' => 'Lebanon (‫لبنان‬‎)', 'iso' => 'LB', 'code' => '+961'),
            123 => array('name' => 'Lesotho', 'iso' => 'LS', 'code' => '+266'),
            124 => array('name' => 'Liberia', 'iso' => 'LR', 'code' => '+231'),
            125 => array('name' => 'Libya (‫ليبيا‬‎)', 'iso' => 'LY', 'code' => '+218'),
            126 => array('name' => 'Liechtenstein', 'iso' => 'LI', 'code' => '+423'),
            127 => array('name' => 'Lithuania (Lietuva)', 'iso' => 'LT', 'code' => '+370'),
            128 => array('name' => 'Luxembourg', 'iso' => 'LU', 'code' => '+352'),
            129 => array('name' => 'Macau (澳門)', 'iso' => 'MO', 'code' => '+853'),
            130 => array('name' => 'Macedonia (FYROM) (Македонија)', 'iso' => 'MK', 'code' => '+389'),
            131 => array('name' => 'Madagascar (Madagasikara)', 'iso' => 'MG', 'code' => '+261'),
            132 => array('name' => 'Malawi', 'iso' => 'MW', 'code' => '+265'),
            133 => array('name' => 'Malaysia', 'iso' => 'MY', 'code' => '+60'),
            134 => array('name' => 'Maldives', 'iso' => 'MV', 'code' => '+960'),
            135 => array('name' => 'Mali', 'iso' => 'ML', 'code' => '+223'),
            136 => array('name' => 'Malta', 'iso' => 'MT', 'code' => '+356'),
            137 => array('name' => 'Marshall Islands', 'iso' => 'MH', 'code' => '+692'),
            138 => array('name' => 'Martinique', 'iso' => 'MQ', 'code' => '+596'),
            139 => array('name' => 'Mauritania (‫موريتانيا‬‎)', 'iso' => 'MR', 'code' => '+222'),
            140 => array('name' => 'Mauritius (Moris)', 'iso' => 'MU', 'code' => '+230'),
            141 => array('name' => 'Mayotte', 'iso' => 'YT', 'code' => '+262'),
            142 => array('name' => 'Mexico (México)', 'iso' => 'MX', 'code' => '+52'),
            143 => array('name' => 'Micronesia', 'iso' => 'FM', 'code' => '+691'),
            144 => array('name' => 'Moldova (Republica Moldova)', 'iso' => 'MD', 'code' => '+373'),
            145 => array('name' => 'Monaco', 'iso' => 'MC', 'code' => '+377'),
            146 => array('name' => 'Mongolia (Монгол)', 'iso' => 'MN', 'code' => '+976'),
            147 => array('name' => 'Montenegro (Crna Gora)', 'iso' => 'ME', 'code' => '+382'),
            148 => array('name' => 'Montserrat', 'iso' => 'MS', 'code' => '+1'),
            149 => array('name' => 'Morocco (‫المغرب‬‎)', 'iso' => 'MA', 'code' => '+212'),
            150 => array('name' => 'Mozambique (Moçambique)', 'iso' => 'MZ', 'code' => '+258'),
            151 => array('name' => 'Myanmar (Burma) (မြန်မာ)', 'iso' => 'MM', 'code' => '+95'),
            152 => array('name' => 'Namibia (Namibië)', 'iso' => 'NA', 'code' => '+264'),
            153 => array('name' => 'Nauru', 'iso' => 'NR', 'code' => '+674'),
            154 => array('name' => 'Nepal (नेपाल)', 'iso' => 'NP', 'code' => '+977'),
            155 => array('name' => 'Netherlands (Nederland)', 'iso' => 'NL', 'code' => '+31'),
            156 => array('name' => 'New Caledonia (Nouvelle-Calédonie)', 'iso' => 'NC', 'code' => '+687'),
            157 => array('name' => 'New Zealand', 'iso' => 'NZ', 'code' => '+64'),
            158 => array('name' => 'Nicaragua', 'iso' => 'NI', 'code' => '+505'),
            159 => array('name' => 'Niger (Nijar)', 'iso' => 'NE', 'code' => '+227'),
            160 => array('name' => 'Nigeria', 'iso' => 'NG', 'code' => '+234'),
            161 => array('name' => 'Niue', 'iso' => 'NU', 'code' => '+683'),
            162 => array('name' => 'Norfolk Island', 'iso' => 'NF', 'code' => '+672'),
            163 => array('name' => 'Northern Mariana Islands', 'iso' => 'MP', 'code' => '+1'),
            164 => array('name' => 'Norway (Norge)', 'iso' => 'NO', 'code' => '+47'),
            165 => array('name' => 'Oman (‫عُمان‬‎)', 'iso' => 'OM', 'code' => '+968'),
            166 => array('name' => 'Pakistan (‫پاکستان‬‎)', 'iso' => 'PK', 'code' => '+92'),
            167 => array('name' => 'Palau', 'iso' => 'PW', 'code' => '+680'),
            168 => array('name' => 'Palestine (‫فلسطين‬‎)', 'iso' => 'PS', 'code' => '+970'),
            169 => array('name' => 'Panama (Panamá)', 'iso' => 'PA', 'code' => '+507'),
            170 => array('name' => 'Papua New Guinea', 'iso' => 'PG', 'code' => '+675'),
            171 => array('name' => 'Paraguay', 'iso' => 'PY', 'code' => '+595'),
            172 => array('name' => 'Peru (Perú)', 'iso' => 'PE', 'code' => '+51'),
            173 => array('name' => 'Philippines', 'iso' => 'PH', 'code' => '+63'),
            174 => array('name' => 'Pitcairn Islands', 'iso' => 'PN', 'code' => '+64'),
            175 => array('name' => 'Poland (Polska)', 'iso' => 'PL', 'code' => '+48'),
            176 => array('name' => 'Portugal', 'iso' => 'PT', 'code' => '+351'),
            177 => array('name' => 'Puerto Rico', 'iso' => 'PR', 'code' => '+1'),
            178 => array('name' => 'Qatar (‫قطر‬‎)', 'iso' => 'QA', 'code' => '+974'),
            179 => array('name' => 'Réunion (La Réunion)', 'iso' => 'RE', 'code' => '+262'),
            180 => array('name' => 'Romania (România)', 'iso' => 'RO', 'code' => '+40'),
            181 => array('name' => 'Russia (Россия)', 'iso' => 'RU', 'code' => '+7'),
            182 => array('name' => 'Rwanda', 'iso' => 'RW', 'code' => '+250'),
            183 => array('name' => 'Saint Barthélemy (Saint-Barthélemy)', 'iso' => 'BL', 'code' => '+590'),
            184 => array('name' => 'Saint Helena', 'iso' => 'SH', 'code' => '+290'),
            185 => array('name' => 'Saint Kitts and Nevis', 'iso' => 'KN', 'code' => '+1'),
            186 => array('name' => 'Saint Lucia', 'iso' => 'LC', 'code' => '+1'),
            187 => array('name' => 'Saint Martin (Saint-Martin (partie française))', 'iso' => 'MF', 'code' => '+590'),
            188 => array('name' => 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'iso' => 'PM', 'code' => '+508'),
            189 => array('name' => 'St. Vincent & Grenadines', 'iso' => 'VC', 'code' => '+1'),
            190 => array('name' => 'Samoa', 'iso' => 'WS', 'code' => '+685'),
            191 => array('name' => 'San Marino', 'iso' => 'SM', 'code' => '+378'),
            192 => array('name' => 'São Tomé and Príncipe (São Tomé e Príncipe)', 'iso' => 'ST', 'code' => '+239'),
            193 => array('name' => 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'iso' => 'SA', 'code' => '+966'),
            194 => array('name' => 'Senegal (Sénégal)', 'iso' => 'SN', 'code' => '+221'),
            195 => array('name' => 'Serbia (Србија)', 'iso' => 'RS', 'code' => '+381'),
            196 => array('name' => 'Seychelles', 'iso' => 'SC', 'code' => '+248'),
            197 => array('name' => 'Sierra Leone', 'iso' => 'SL', 'code' => '+232'),
            198 => array('name' => 'Singapore', 'iso' => 'SG', 'code' => '+65'),
            199 => array('name' => 'Slovakia (Slovensko)', 'iso' => 'SK', 'code' => '+421'),
            200 => array('name' => 'Slovenia (Slovenija)', 'iso' => 'SI', 'code' => '+386'),
            201 => array('name' => 'Solomon Islands', 'iso' => 'SB', 'code' => '+677'),
            202 => array('name' => 'Somalia (Soomaaliya)', 'iso' => 'SO', 'code' => '+252'),
            203 => array('name' => 'South Africa', 'iso' => 'ZA', 'code' => '+27'),
            204 => array('name' => 'South Georgia & South Sandwich Islands', 'iso' => 'GS', 'code' => '+500'),
            205 => array('name' => 'Spain (España)', 'iso' => 'ES', 'code' => '+34'),
            206 => array('name' => 'Sri Lanka (ශ්‍රී ලංකාව)', 'iso' => 'LK', 'code' => '+94'),
            207 => array('name' => 'Sudan (‫السودان‬‎)', 'iso' => 'SD', 'code' => '+249'),
            208 => array('name' => 'Suriname', 'iso' => 'SR', 'code' => '+597'),
            209 => array('name' => 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'iso' => 'SJ', 'code' => '+47'),
            210 => array('name' => 'Swaziland', 'iso' => 'SZ', 'code' => '+268'),
            211 => array('name' => 'Sweden (Sverige)', 'iso' => 'SE', 'code' => '+46'),
            212 => array('name' => 'Switzerland (Schweiz)', 'iso' => 'CH', 'code' => '+41'),
            213 => array('name' => 'Syria (‫سوريا‬‎)', 'iso' => 'SY', 'code' => '+963'),
            214 => array('name' => 'Taiwan (台灣)', 'iso' => 'TW', 'code' => '+886'),
            215 => array('name' => 'Tajikistan', 'iso' => 'TJ', 'code' => '+992'),
            216 => array('name' => 'Tanzania', 'iso' => 'TZ', 'code' => '+255'),
            217 => array('name' => 'Thailand (ไทย)', 'iso' => 'TH', 'code' => '+66'),
            218 => array('name' => 'Timor-Leste', 'iso' => 'TL', 'code' => '+670'),
            219 => array('name' => 'Togo', 'iso' => 'TG', 'code' => '+228'),
            220 => array('name' => 'Tokelau', 'iso' => 'TK', 'code' => '+690'),
            221 => array('name' => 'Tonga', 'iso' => 'TO', 'code' => '+676'),
            222 => array('name' => 'Trinidad and Tobago', 'iso' => 'TT', 'code' => '+1'),
            223 => array('name' => 'Tunisia (‫تونس‬‎)', 'iso' => 'TN', 'code' => '+216'),
            224 => array('name' => 'Turkey (Türkiye)', 'iso' => 'TR', 'code' => '+90'),
            225 => array('name' => 'Turkmenistan', 'iso' => 'TM', 'code' => '+993'),
            226 => array('name' => 'Turks and Caicos Islands', 'iso' => 'TC', 'code' => '+1'),
            227 => array('name' => 'Tuvalu', 'iso' => 'TV', 'code' => '+688'),
            228 => array('name' => 'Uganda', 'iso' => 'UG', 'code' => '+256'),
            229 => array('name' => 'Ukraine (Україна)', 'iso' => 'UA', 'code' => '+380'),
            230 => array('name' => 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'iso' => 'AE', 'code' => '+971'),
            231 => array('name' => 'United Kingdom', 'iso' => 'GB', 'code' => '+44'),
            232 => array('name' => 'United States', 'iso' => 'US', 'code' => '+1'),
            233 => array('name' => 'U.S. Outlying Islands', 'iso' => 'UM', 'code' => '+699'),
            234 => array('name' => 'U.S. Virgin Islands', 'iso' => 'VI', 'code' => '+1'),
            235 => array('name' => 'Uruguay', 'iso' => 'UY', 'code' => '+598'),
            236 => array('name' => 'Uzbekistan (Oʻzbekiston)', 'iso' => 'UZ', 'code' => '+998'),
            237 => array('name' => 'Vanuatu', 'iso' => 'VU', 'code' => '+678'),
            238 => array('name' => 'Venezuela', 'iso' => 'VE', 'code' => '+58'),
            239 => array('name' => 'Vietnam (Việt Nam)', 'iso' => 'VN', 'code' => '+84'),
            240 => array('name' => 'Wallis and Futuna', 'iso' => 'WF', 'code' => '+681'),
            241 => array('name' => 'Western Sahara (‫الصحراء الغربية‬‎)', 'iso' => 'EH', 'code' => '+212'),
            242 => array('name' => 'Yemen (‫اليمن‬‎)', 'iso' => 'YE', 'code' => '+967'),
            243 => array('name' => 'Zambia', 'iso' => 'ZM', 'code' => '+260'),
            244 => array('name' => 'Zimbabwe', 'iso' => 'ZW', 'code' => '+263'));
        $user = Auth::user();
        return view('account')->with('user', $user);
    }

    public function updateDetails(Request $request, $id)
    {
        $user = Auth::user();

        $this->validate($request, array(
            "name" => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:10|unique:users,mobile,' . $user->id,
            'country_code' => 'required',
            'birth_date' => 'required|date|date_format:Y-m-d',
        ));

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->code = $request->country_code;
        $user->dob = $request->birth_date;
        $user->update();
        return $user;
    }

    public function updateImage(Request $request, $id)
    {

        $user = Auth::user();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');

        $imageName = rand() . '_' . round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/imgs/');
        $image->move($location, $imageName);
        $user->image = $imageName;
        $user->update();

    }

    public function updatePassword(Request $request, $id)
    {

        $user = Auth::user();
        $this->validate($request, [
            'current_password' => 'required|old_password:' . Auth::user()->password,
            'password' => 'required|min:6|confirmed',
        ]);
        $user->password = bcrypt($request->password);
        $user->update();

    }
}
