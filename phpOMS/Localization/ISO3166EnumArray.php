<?php
namespace phpOMS\Localization;

/**
 * Country codes ISO list
 *
 * PHP Version 5.4
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ISO3166EnumArray extends \phpOMS\Datatypes\EnumArray
{

// region Class Fields
    protected static $constatns = [
        'af' => 'Afghanistan',
        'ax' => 'Aland Islands',
        'al' => 'Albania',
        'dz' => 'Algeria',
        'as' => 'American Samoa',
        'ad' => 'Andorra',
        'ao' => 'Angola',
        'ai' => 'Anguilla',
        'aq' => 'Antarctica',
        'ag' => 'Antigua And Barbuda',
        'ar' => 'Argentina',
        'am' => 'Armenia',
        'aw' => 'Aruba',
        'au' => 'Australia',
        'at' => 'Austria',
        'az' => 'Azerbaijan',
        'bs' => 'Bahamas',
        'bh' => 'Bahrain',
        'bd' => 'Bangladesh',
        'bb' => 'Barbados',
        'by' => 'Belarus',
        'be' => 'Belgium',
        'bz' => 'Belize',
        'bj' => 'Benin',
        'bm' => 'Bermuda',
        'bt' => 'Bhutan',
        'bo' => 'Bolivia',
        'ba' => 'Bosnia And Herzegovina',
        'bw' => 'Botswana',
        'bv' => 'Bouvet Island',
        'br' => 'Brazil',
        'io' => 'British Indian Ocean Territory',
        'bn' => 'Brunei Darussalam',
        'bg' => 'Bulgaria',
        'bf' => 'Burkina Faso',
        'bi' => 'Burundi',
        'kh' => 'Cambodia',
        'cm' => 'Cameroon',
        'ca' => 'Canada',
        'cv' => 'Cape Verde',
        'ky' => 'Cayman Islands',
        'cf' => 'Central African Republic',
        'td' => 'Chad',
        'cl' => 'Chile',
        'cn' => 'China',
        'cx' => 'Christmas Island',
        'cc' => 'Cocos (Keeling) Islands',
        'co' => 'Colombia',
        'km' => 'Comoros',
        'cg' => 'Congo',
        'cd' => 'Congo, Democratic Republic',
        'ck' => 'Cook Islands',
        'cr' => 'Costa Rica',
        'ci' => 'Cote D\'Ivoire',
        'hr' => 'Croatia',
        'cu' => 'Cuba',
        'cy' => 'Cyprus',
        'cz' => 'Czech Republic',
        'dk' => 'Denmark',
        'dj' => 'Djibouti',
        'dm' => 'Dominica',
        'do' => 'Dominican Republic',
        'ec' => 'Ecuador',
        'eg' => 'Egypt',
        'sv' => 'El Salvador',
        'gq' => 'Equatorial Guinea',
        'er' => 'Eritrea',
        'ee' => 'Estonia',
        'et' => 'Ethiopia',
        'fk' => 'Falkland Islands (Malvinas)',
        'fo' => 'Faroe Islands',
        'fj' => 'Fiji',
        'fi' => 'Finland',
        'fr' => 'France',
        'gf' => 'French Guiana',
        'pf' => 'French Polynesia',
        'tf' => 'French Southern Territories',
        'ga' => 'Gabon',
        'gm' => 'Gambia',
        'ge' => 'Georgia',
        'de' => 'Germany',
        'gh' => 'Ghana',
        'gi' => 'Gibraltar',
        'gr' => 'Greece',
        'gl' => 'Greenland',
        'gd' => 'Grenada',
        'gp' => 'Guadeloupe',
        'gu' => 'Guam',
        'gt' => 'Guatemala',
        'gg' => 'Guernsey',
        'gn' => 'Guinea',
        'gw' => 'Guinea-Bissau',
        'gy' => 'Guyana',
        'ht' => 'Haiti',
        'hm' => 'Heard Island & Mcdonald Islands',
        'va' => 'Holy See (Vatican City State)',
        'hn' => 'Honduras',
        'hk' => 'Hong Kong',
        'hu' => 'Hungary',
        'is' => 'Iceland',
        'in' => 'India',
        'id' => 'Indonesia',
        'ir' => 'Iran, Islamic Republic Of',
        'iq' => 'Iraq',
        'ie' => 'Ireland',
        'im' => 'Isle Of Man',
        'il' => 'Israel',
        'it' => 'Italy',
        'jm' => 'Jamaica',
        'jp' => 'Japan',
        'je' => 'Jersey',
        'jo' => 'Jordan',
        'kz' => 'Kazakhstan',
        'ke' => 'Kenya',
        'ki' => 'Kiribati',
        'kr' => 'Korea',
        'kw' => 'Kuwait',
        'kg' => 'Kyrgyzstan',
        'la' => 'Lao People\'s Democratic Republic',
        'lv' => 'Latvia',
        'lb' => 'Lebanon',
        'ls' => 'Lesotho',
        'lr' => 'Liberia',
        'ly' => 'Libyan Arab Jamahiriya',
        'li' => 'Liechtenstein',
        'lt' => 'Lithuania',
        'lu' => 'Luxembourg',
        'mo' => 'Macao',
        'mk' => 'Macedonia',
        'mg' => 'Madagascar',
        'mw' => 'Malawi',
        'my' => 'Malaysia',
        'mv' => 'Maldives',
        'ml' => 'Mali',
        'mt' => 'Malta',
        'mh' => 'Marshall Islands',
        'mq' => 'Martinique',
        'mr' => 'Mauritania',
        'mu' => 'Mauritius',
        'yt' => 'Mayotte',
        'mx' => 'Mexico',
        'fm' => 'Micronesia, Federated States Of',
        'md' => 'Moldova',
        'mc' => 'Monaco',
        'mn' => 'Mongolia',
        'me' => 'Montenegro',
        'ms' => 'Montserrat',
        'ma' => 'Morocco',
        'mz' => 'Mozambique',
        'mm' => 'Myanmar',
        'na' => 'Namibia',
        'nr' => 'Nauru',
        'np' => 'Nepal',
        'nl' => 'Netherlands',
        'an' => 'Netherlands Antilles',
        'nc' => 'New Caledonia',
        'nz' => 'New Zealand',
        'ni' => 'Nicaragua',
        'ne' => 'Niger',
        'ng' => 'Nigeria',
        'nu' => 'Niue',
        'nf' => 'Norfolk Island',
        'mp' => 'Northern Mariana Islands',
        'no' => 'Norway',
        'om' => 'Oman',
        'pk' => 'Pakistan',
        'pw' => 'Palau',
        'ps' => 'Palestinian Territory, Occupied',
        'pa' => 'Panama',
        'pg' => 'Papua New Guinea',
        'py' => 'Paraguay',
        'pe' => 'Peru',
        'ph' => 'Philippines',
        'pn' => 'Pitcairn',
        'pl' => 'Poland',
        'pt' => 'Portugal',
        'pr' => 'Puerto Rico',
        'qa' => 'Qatar',
        're' => 'Reunion',
        'ro' => 'Romania',
        'ru' => 'Russian Federation',
        'rw' => 'Rwanda',
        'bl' => 'Saint Barthelemy',
        'sh' => 'Saint Helena',
        'kn' => 'Saint Kitts And Nevis',
        'lc' => 'Saint Lucia',
        'mf' => 'Saint Martin',
        'pm' => 'Saint Pierre And Miquelon',
        'vc' => 'Saint Vincent And Grenadines',
        'ws' => 'Samoa',
        'sm' => 'San Marino',
        'st' => 'Sao Tome And Principe',
        'sa' => 'Saudi Arabia',
        'sn' => 'Senegal',
        'rs' => 'Serbia',
        'sc' => 'Seychelles',
        'sl' => 'Sierra Leone',
        'sg' => 'Singapore',
        'sk' => 'Slovakia',
        'si' => 'Slovenia',
        'sb' => 'Solomon Islands',
        'so' => 'Somalia',
        'za' => 'South Africa',
        'gs' => 'South Georgia And Sandwich Isl.',
        'es' => 'Spain',
        'lk' => 'Sri Lanka',
        'sd' => 'Sudan',
        'sr' => 'Suriname',
        'sj' => 'Svalbard And Jan Mayen',
        'sz' => 'Swaziland',
        'se' => 'Sweden',
        'ch' => 'Switzerland',
        'sy' => 'Syrian Arab Republic',
        'tw' => 'Taiwan',
        'tj' => 'Tajikistan',
        'tz' => 'Tanzania',
        'th' => 'Thailand',
        'tl' => 'Timor-Leste',
        'tg' => 'Togo',
        'tk' => 'Tokelau',
        'to' => 'Tonga',
        'tt' => 'Trinidad And Tobago',
        'tn' => 'Tunisia',
        'tr' => 'Turkey',
        'tm' => 'Turkmenistan',
        'tc' => 'Turks And Caicos Islands',
        'tv' => 'Tuvalu',
        'ug' => 'Uganda',
        'ua' => 'Ukraine',
        'ae' => 'United Arab Emirates',
        'gb' => 'United Kingdom',
        'us' => 'United States',
        'um' => 'United States Outlying Islands',
        'uy' => 'Uruguay',
        'uz' => 'Uzbekistan',
        'vu' => 'Vanuatu',
        've' => 'Venezuela',
        'vn' => 'Viet Nam',
        'vg' => 'Virgin Islands, British',
        'vi' => 'Virgin Islands, U.S.',
        'wf' => 'Wallis And Futuna',
        'eh' => 'Western Sahara',
        'ye' => 'Yemen',
        'zm' => 'Zambia',
        'zw' => 'Zimbabwe',
    ];
// endregion

}
