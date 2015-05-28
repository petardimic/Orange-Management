<?php
$lang = $this->getData('lang');

$companies = [
    'SD', 'GDF'
];

if($this->request->getUri()->getQuery('source') === null || !in_array($this->request->getUri()->getQuery('source'), $companies)) {
    $source = $companies[0];
} else {
    $source = $this->request->getData('source');
}

$ac = [
    8050, 8052, 8055, 8090, 8095, 8100, 8105, 8106, 8110, 8113, 8115, 8120, 8121, 8122, 
    8125, 8130, 8140, 8160, 8161, 8162, 8300, 8305, 8306, 8310, 8315, 8320, 8330, 8340, 
    8360, 8361, 8362, 8367, 8368, 8380, 8740, 8746, 8749, 8765, 8781, 8791, 8793, 8841, 
    8843, 8851, 8853, 8861, 8863, 8871, 8873, 8955, 
    8000, 8005, 8006, 8010, 8013, 8020, 8021, 8022, 8030, 8040, 8060, 8062, 8064, 
    8065, 8070, 8075, 8400, 8405, 8406, 8410, 8413, 8415, 8420, 8425, 8430, 8440, 8460, 
    8461, 8462, 8463, 8464, 8465, 8487, 8488, 8489, 8502, 8505, 8506, 8507, 8508, 8509, 
    8690, 8733, 8734, 8736, 8739, 8754, 8756, 8757, 8794, 8796, 8799, 8840, 8850, 8860, 
    8870, 8998, 8865, 8500, 8502, 8503, 8505, 8510, 8511, 8512, 8520, 8530, 8584, 8585, 
    8730, 8855, 
    8200, 8205, 8206, 8210, 8213, 8215, 8220, 8221, 8225, 8230, 8240, 8260, 8261, 8262, 
    8263, 8264, 8287, 8289, 8290, 8741, 8753, 8754, 8761, 8782, 8792, 8795, 8842, 8852, 
    8862, 8872, 8910,
];

$ac_inland = [
    8000, 8005, 8006, 8010, 8013, 8020, 8021, 8022, 8030, 8040, 8060, 8062, 8064, 
    8065, 8070, 8075, 8400, 8405, 8406, 8410, 8413, 8415, 8420, 8425, 8430, 8440, 8460, 
    8461, 8462, 8463, 8464, 8465, 8487, 8488, 8489, 8502, 8505, 8506, 8507, 8508, 8509, 
    8690, 8733, 8734, 8736, 8739, 8754, 8756, 8757, 8794, 8796, 8799, 8840, 8850, 8860, 
    8870, 8998, 8865, 8500, 8502, 8503, 8505, 8510, 8511, 8512, 8520, 8530, 8584, 8585, 
    8730, 8855, 
];

$cc = [
    'KOR' => 'KR', 'PRK' => 'KP', 'CHN' => 'CN', 'TWN' => 'TW', 'MNG' => 'MN', 'HKG' => 'HK', 
    'VNM' => 'VN', 'THA' => 'TH', 'SGP' => 'SG', 'MYS' => 'MY', 'PHL' => 'PH', 'IDN' => 'ID', 
    'KHM' => 'KH', 'LAO' => 'LA', 'MMR' => 'MM', 'IND' => 'IN', 'PAK' => 'PK', 'LKA' => 'LK', 
    'BGD' => 'BD', 'AFG' => 'AF', 'NPL' => 'NP', 'IRN' => 'IR', 'IRQ' => 'IQ', 'BHR' => 'BH', 
    'SAU' => 'SA', 'KWT' => 'KW', 'QAT' => 'QA', 'OMN' => 'OM', 'JOR' => 'JO', 'SYR' => 'SY', 
    'LBN' => 'LB', 'ARE' => 'AE', 'YEM' => 'YE', 'AZE' => 'AZ', 'ARM' => 'AM', 'GEO' => 'GE', 
    'PSE' => 'PS', 'CYP' => 'CY', 'TUR' => 'TR', 'BRN' => 'BN', 'TJK' => 'TJ', 'ISR' => 'IL', 
    'UZB' => 'UZ', 'KAZ' => 'KZ', 'RUS' => 'RU', 'MDA' => 'MD', 'HND' => 'HN', 'SLV' => 'SV', 
    'NIC' => 'NI', 'CRI' => 'CR', 'PAN' => 'PA', 'CUB' => 'CU', 'DOM' => 'DO', 'COL' => 'CO', 
    'VEN' => 'VE', 'GUY' => 'GY', 'ECU' => 'EC', 'PER' => 'PE', 'BOL' => 'BO', 'CHL' => 'CL', 
    'BRA' => 'BR', 'PRY' => 'PY', 'URY' => 'UY', 'ARG' => 'AR', 'MAR' => 'MA', 'DZA' => 'DZ', 
    'TUN' => 'TN', 'LBY' => 'LY', 'EGY' => 'EG', 'SDN' => 'SD', 'CIV' => 'CI', 'BEN' => 'BJ', 
    'MLI' => 'ML', 'NGA' => 'NG', 'RWA' => 'RW', 'BDI' => 'BI', 'AGO' => 'AO', 'KEN' => 'KE', 
    'UGA' => 'UG', 'TZA' => 'TZ', 'MDG' => 'MG', 'MUS' => 'MU', 'ZAF' => 'ZA', 'ZMB' => 'ZM', 
    'AUS' => 'AU', 'PNG' => 'PG', 'NZL' => 'NZ', 'VUT' => 'VU', 'ATG' => 'AG', 'KGZ' => 'KG', 
    'ISL' => 'IS', 'NOR' => 'NO', 'SWE' => 'SE', 'DNK' => 'DK', 'GBR' => 'GB', 'IRL' => 'IE', 
    'NLD' => 'NL', 'BEL' => 'BE', 'FRA' => 'FR', 'DEU' => 'DE', 'CHE' => 'CH', 'PRT' => 'PT', 
    'ESP' => 'ES', 'ITA' => 'IT', 'MLT' => 'MT', 'FIN' => 'FI', 'POL' => 'PL', 'AUT' => 'AT', 
    'HUN' => 'HU', 'SRB' => 'RS', 'ALB' => 'AL', 'GRC' => 'GR', 'ROU' => 'RO', 'BGR' => 'BG', 
    'EST' => 'EE', 'LVA' => 'LV', 'LTU' => 'LT', 'UKR' => 'UA', 'BLR' => 'BY', 'HRV' => 'HR', 
    'SVN' => 'SI', 'CZE' => 'CZ', 'SVK' => 'SK', 'LIE' => 'LI', 'MKD' => 'MK', 'BIH' => 'BA', 
    'LUX' => 'LU', 'MNE' => 'ME', 'JPN' => 'JP', 'CAN' => 'CA', 'USA' => 'US', 'MEX' => 'MX', 
    'GTM' => 'GT', 'PRI' => 'PR', 
    'AAA' => '???'
];

$clients = [];
$accounts = [];
$countries = [];

foreach($ac as $account) {
    $accounts[$account] = 0.0;
}

foreach($cc as $d3 => $d2) {
    $countries[$d2] = 0.0;
}

// Dataframe
$file = fopen(__DIR__ . '/' . $source . '_clientsNOGIT.csv', 'r');
while(($line = fgetcsv($file, 0, ';')) !== false) {
    $clients[$line[0]] = $line[1];
}
fclose($file);

// Fibu
$file = fopen(__DIR__ . '/' . $source . '_entriesNOGIT.csv', 'r');
while(($line = fgetcsv($file, 0, ',', '"')) !== false) {
    if(isset($accounts[$line[10]])) {
        $accounts[$line[10]] += (float) str_replace(['.', ','], ['', '.'], $line[4]);
        $accounts[$line[10]] -= (float) str_replace(['.', ','], ['', '.'], $line[3]);

        if(isset($clients[$line[11]]) && !in_array($line[10], $ac_inland)) { // Client existiert und Erloeskonto ist fuers Inland
            if($clients[$line[11]] == 'QU') { $clients[$line[11]] = '???'; } // QU Ausland!
            if($clients[$line[11]] == 'DE') { $clients[$line[11]] = '???'; } // DE Muss aber Ausland sein!
            $countries[$clients[$line[11]]] += (float) str_replace(['.', ','], ['', '.'], $line[4]);
            $countries[$clients[$line[11]]] -= (float) str_replace(['.', ','], ['', '.'], $line[3]);
        } else { // Client existiert nicht oder ist Inland Erloeskonto
            if(in_array($line[10], $ac_inland)) { // Account ist Inland
                $countries['DE'] += (float) str_replace(['.', ','], ['', '.'], $line[4]);
                $countries['DE'] -= (float) str_replace(['.', ','], ['', '.'], $line[3]);
            } else { // Account ist nicht Inland und existiert nicht -> Ausland?
                $countries['???'] += (float) str_replace(['.', ','], ['', '.'], $line[4]);
                $countries['???'] -= (float) str_replace(['.', ','], ['', '.'], $line[3]);
            }
        }
    }
}
fclose($file);

$sum_countries = array_sum($countries);
$sum_accounts = array_sum($accounts);
?>

    <div class="b b-1">
        <h1><?= $lang['Company']; ?></h1>

        <div>
            <form method="post"
                  action="<?= $this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . \phpOMS\Uri\UriFactory::build([$this->l11n->getLanguage(),
                    'api',
                    'reporter',
                    'single'], ['id' => $this->request->getData('id')]) ?>">
                <ul class="l-1">
                    <li><label for="i-areamanager"><?= $lang['Company']; ?></label>: 
                        <select name="i-areamanager" id="i-areamanager">
                            <option value="-1" selected disabled><?= $lang['Select']; ?>
                                <?php foreach ($companies as $company): ?>
                            <option value="<?= $company; ?>"<?= $company === $source ? ' selected' : ''; ?>><?= $company; ?>
                                <?php endforeach; ?>
                        </select>
                    <li><label for="i-areamanager"><?= $lang['Status']; ?></label>: <?= abs($sum_countries-$sum_accounts) < 0.01 ? 'OK' : 'NOK'; ?>
                </ul>
            </form>
        </div>
    </div>

<div class="b b-1">
    <h1><?= $lang['SalesByCountry']; ?></h1>
    <div class="bc-1">
        <table class="tc-1">
        <?php foreach($countries as $d2 => $sales) : if($sales != 0.0) : ?>
            <tr><th><?= $d2; ?><td><?= number_format($sales, 2, ',', '.'); ?><th><?= array_search($d2, $cc); ?>
        <?php endif; endforeach; ?>
            <tr><th><?= $lang['Sum']; ?><td colspan="2"><strong><?= number_format($sum_countries, 2, ',', '.'); ?></strong>
        </table>
    </div>
</div>

<div class="b b-1">
    <h1><?= $lang['SalesByAccount']; ?></h1>
    <div class="bc-1">
        <table class="tc-1">
        <?php foreach($accounts as $d2 => $sales) : if($sales != 0.0) : ?>
            <tr><th><?= $d2; ?><td><?= number_format($sales, 2, ',', '.'); ?>
        <?php endif; endforeach; ?>
            <tr><th><?= $lang['Sum']; ?><td><strong><?= number_format($sum_accounts, 2, ',', '.'); ?></strong>
        </table>
    </div>
</div>