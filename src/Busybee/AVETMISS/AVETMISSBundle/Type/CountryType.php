<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Busybee\AVETMISS\AVETMISSBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

class CountryType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(
			array(
				'choices'                   => $this->getCountryList(),
				'choice_translation_domain' => false,
				'preferred_choices'         => array('1101')
			)
		);
	}

	/**
	 * {@inheritdoc}
	 */
	private function getCountryList()
	{
		$s    = <<<HHH
OCEANIA AND ANTARCTICA:
    Australia (includes External Territories):
        Australia: 1101
        Norfolk Island: 1102
        Australian External Territories, nec: 1199
    New Zealand:
        New Zealand: 1201
    Melanesia:
        New Caledonia: 1301
        Papua New Guinea: 1302
        Solomon Islands: 1303
        Vanuatu: 1304
    Micronesia:
        Guam: 1401
        Kiribati: 1402
        Marshall Islands: 1403
        Micronesia, Federated States of: 1404  
        Nauru: 1405
        Northern Mariana Islands: 1406
        Palau: 1407
    Polynesia (excludes Hawaii):
        Cook Islands: 1501
        Fiji: 1502
        French Polynesia: 1503
        Niue: 1504
        Samoa: 1505
        Samoa, American: 1506
        Tokelau: 1507
        Tonga: 1508
        Tuvalu: 1511
        Wallis and Futuna: 1512
        Pitcairn Islands: 1513
        Polynesia (excludes Hawaii), nec: 1599
    Antarctica:
        Adelie Land (France): 1601
        Argentinian Antarctic Territory: 1602
        Australian Antarctic Territory: 1603
        British Antarctic Territory: 1604
        Chilean Antarctic Territory: 1605
        Queen Maud Land (Norway): 1606
        Ross Dependency (New Zealand): 1607

NORTH-WEST EUROPE:
    United Kingdom, Channel Islands and Isle of Man:
        England: 2102
        Isle of Man: 2103
        Northern Ireland: 2104
        Scotland: 2105
        Wales: 2106
        Guernsey: 2107
        Jersey: 2108
    Ireland:
        Ireland: 2201
    Western Europe:
        Austria: 2301
        Belgium: 2302
        France: 2303
        Germany: 2304
        Liechtenstein: 2305
        Luxembourg: 2306
        Monaco: 2307
        Netherlands: 2308
        Switzerland: 2311
    Northern Europe:
        Denmark: 2401
        Faroe Islands: 2402
        Finland: 2403
        Greenland: 2404
        Iceland: 2405
        Norway: 2406
        Sweden: 2407
        Aland Islands: 2408

SOUTHERN AND EASTERN EUROPE:
    Southern Europe:
        Andorra: 3101
        Gibraltar: 3102
        Holy See: 3103
        Italy: 3104
        Malta: 3105
        Portugal: 3106
        San Marino: 3107
        Spain: 3108
    South Eastern Europe:
        Albania: 3201
        Bosnia and Herzegovina: 3202
        Bulgaria: 3203
        Croatia: 3204
        Cyprus: 3205
        The former Yugoslav Republic of Macedonia: 3206
        Greece: 3207
        Moldova: 3208
        Romania: 3211
        Slovenia: 3212
        Montenegro: 3214
        Serbia: 3215
        Kosovo: 3216
    Eastern Europe:
        Belarus: 3301
        Czech Republic: 3302
        Estonia: 3303
        Hungary: 3304
        Latvia: 3305
        Lithuania: 3306
        Poland: 3307
        Russian Federation: 3308
        Slovakia: 3311
        Ukraine: 3312

NORTH AFRICA AND THE MIDDLE EAST:
    North Africa:
        Algeria: 4101
        Egypt: 4102
        Libya: 4103
        Morocco: 4104
        Sudan: 4105
        Tunisia: 4106
        Western Sahara: 4107
        Spanish North Africa: 4108
        South Sudan: 4111
    Middle East:
        Bahrain: 4201
        Gaza Strip and West Bank: 4202
        Iran: 4203
        Iraq: 4204
        Israel: 4205
        Jordan: 4206
        Kuwait: 4207
        Lebanon: 4208
        Oman: 4211
        Qatar: 4212
        Saudi Arabia: 4213
        Syria: 4214
        Turkey: 4215
        United Arab Emirates: 4216
        Yemen: 4217

SOUTH-EAST ASIA:
    Mainland South-East Asia:
        Myanmar: 5101
        Cambodia: 5102
        Laos: 5103
        Thailand: 5104
        Vietnam: 5105
    Maritime South-East Asia:
        Brunei Darussalam: 5201
        Indonesia: 5202
        Malaysia: 5203
        Philippines: 5204
        Singapore: 5205
        Timor-Leste: 5206

NORTH-EAST ASIA:
    Chinese Asia (includes Mongolia):
        China (excludes SARs and Taiwan): 6101
        Hong Kong (SAR of China): 6102
        Macau (SAR of China): 6103
        Mongolia: 6104
        Taiwan: 6105
    Japan and the Koreas:
        Japan: 6201
        Korea, Democratic People's Republic of (North): 6202
        Korea, Republic of (South): 6203

SOUTHERN AND CENTRAL ASIA:
    Southern Asia:
        Bangladesh: 7101
        Bhutan: 7102
        India: 7103
        Maldives: 7104
        Nepal: 7105
        Pakistan: 7106
        Sri Lanka: 7107
    Central Asia:
        Afghanistan: 7201
        Armenia: 7202
        Azerbaijan: 7203
        Georgia: 7204
        Kazakhstan: 7205
        Kyrgyzstan: 7206
        Tajikistan: 7207
        Turkmenistan: 7208
        Uzbekistan: 7211

AMERICAS:
    Northern America:
        Bermuda: 8101
        Canada: 8102
        St Pierre and Miquelon: 8103
        United States of America: 8104
    South America:
        Argentina: 8201
        Bolivia: 8202
        Brazil: 8203
        Chile: 8204
        Colombia: 8205
        Ecuador: 8206
        Falkland Islands: 8207
        French Guiana: 8208
        Guyana: 8211
        Paraguay: 8212
        Peru: 8213
        Suriname: 8214
        Uruguay: 8215
        Venezuela: 8216
        South America, nec: 8299
    Central America:
        Belize: 8301
        Costa Rica: 8302
        El Salvador: 8303
        Guatemala: 8304
        Honduras: 8305
        Mexico: 8306
        Nicaragua: 8307
        Panama: 8308
    Caribbean:
        Anguilla: 8401
        Antigua and Barbuda: 8402
        Aruba: 8403
        Bahamas: 8404
        Barbados: 8405
        Cayman Islands: 8406
        Cuba: 8407
        Dominica: 8408
        Dominican Republic: 8411
        Grenada: 8412
        Guadeloupe: 8413
        Haiti: 8414
        Jamaica: 8415
        Martinique: 8416
        Montserrat: 8417
        Puerto Rico: 8421
        St Kitts and Nevis: 8422
        St Lucia: 8423
        St Vincent and the Grenadines: 8424
        Trinidad and Tobago: 8425
        Turks and Caicos Islands: 8426
        Virgin Islands, British: 8427
        Virgin Islands, United States: 8428
        St Barthelemy: 8431
        St Martin (French part): 8432
        Bonaire, Sint Eustatius and Saba: 8433
        Curacao: 8434
        Sint Maarten (Dutch part): 8435

SUB-SAHARAN AFRICA:
    Central and West Africa:
        Benin: 9101
        Burkina Faso: 9102
        Cameroon: 9103
        Cabo Verde: 9104
        Central African Republic: 9105
        Chad: 9106
        Congo, Republic of: 9107
        Congo, Democratic Republic of: 9108
        Cote d'Ivoire: 9111
        Equatorial Guinea: 9112
        Gabon: 9113
        Gambia: 9114
        Ghana: 9115
        Guinea: 9116
        Guinea-Bissau: 9117
        Liberia: 9118
        Mali: 9121
        Mauritania: 9122
        Niger: 9123
        Nigeria: 9124
        Sao Tome and Principe: 9125
        Senegal: 9126
        Sierra Leone: 9127
        Togo: 9128
    Southern and East Africa:
        Angola: 9201
        Botswana: 9202
        Burundi: 9203
        Comoros: 9204
        Djibouti: 9205
        Eritrea: 9206
        Ethiopia: 9207
        Kenya: 9208
        Lesotho: 9211
        Madagascar: 9212
        Malawi: 9213
        Mauritius: 9214
        Mayotte: 9215
        Mozambique: 9216
        Namibia: 9217
        Reunion: 9218
        Rwanda: 9221
        St Helena: 9222
        Seychelles: 9223
        Somalia: 9224
        South Africa: 9225
        Swaziland: 9226
        Tanzania: 9227
        Uganda: 9228
        Zambia: 9231
        Zimbabwe: 9232
        Southern and East Africa, nec: 9299
HHH;
		$list = Yaml::parse($s);

		return $list;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getParent()
	{
		return 'Symfony\Component\Form\Extension\Core\Type\ChoiceType';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'country';
	}
}
