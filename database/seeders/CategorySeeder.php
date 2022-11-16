<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ########### BENZOS
        $benzos = new Category();
        $benzos->name = 'Benzodiazepines';
        $benzos->slug = 'benzodiazepines';
        $benzos->save();

        $pills = new Category();
        $pills->parent_category = $benzos->id;
        $pills->name = 'Pills(Benzodiazepines)';
        $pills->slug = 'pills_benzodiazepines';
        $pills->save();

        $powder = new Category();
        $powder->parent_category = $benzos->id;
        $powder->name = 'Powder';
        $powder->slug = 'powder';
        $powder->save();

        $alprazolam = new Category();
        $alprazolam->parent_category = $benzos->id;
        $alprazolam->name = 'Alprazolam(Xanax)';
        $alprazolam->slug = 'alprazolam';
        $alprazolam->save();

        $diazepam = new Category();
        $diazepam->parent_category = $benzos->id;
        $diazepam->name = 'Diazepam';
        $diazepam->slug = 'diazepam';
        $diazepam->save();

        $otherbenzos = new Category();
        $otherbenzos->parent_category = $benzos->id;
        $otherbenzos->name = 'Other Benzos';
        $otherbenzos->slug = 'otherbenzos';
        $otherbenzos->save();

        ########### CANNABIS
        $cannabis = new Category();
        $cannabis->name = 'Cannabis';
        $cannabis->slug = 'cannabis';
        $cannabis->save();

        $budsAndFlower = new Category();
        $budsAndFlower->parent_category = $cannabis->id;
        $budsAndFlower->name = 'Buds & Flowers';
        $budsAndFlower->slug = 'buds-and-flower';
        $budsAndFlower->save();

        $edibles = new Category();
        $edibles->parent_category = $cannabis->id;
        $edibles->name = 'Edibles';
        $edibles->slug = 'edibles';
        $edibles->save();

        $concentrates = new Category();
        $concentrates->parent_category = $cannabis->id;
        $concentrates->name = 'Concentrates';
        $concentrates->slug = 'concentrates';
        $concentrates->save();

        $hash = new Category();
        $hash->parent_category = $cannabis->id;
        $hash->name = 'Hash';
        $hash->slug = 'hash';
        $hash->save();

        $extracts = new Category();
        $extracts->parent_category = $cannabis->id;
        $extracts->name = 'Extracts';
        $extracts->slug = 'extracts';
        $extracts->save();

        $ohtercannabis = new Category();
        $ohtercannabis->parent_category = $cannabis->id;
        $ohtercannabis->name = 'Other Cannabis';
        $ohtercannabis->slug = 'ohtercannabis';
        $ohtercannabis->save();

        ########### DISSOCIATIVES
        $dissociatives = new Category();
        $dissociatives->name = 'Dissociatives';
        $dissociatives->slug = 'dissociatives ';
        $dissociatives->save();

        $ghb = new Category();
        $ghb->parent_category = $dissociatives->id;
        $ghb->name = 'GHB';
        $ghb->slug = 'ghb';
        $ghb->save();

        $gbl = new Category();
        $gbl->parent_category = $dissociatives->id;
        $gbl->name = 'GBL';
        $gbl->slug = 'gbl';
        $gbl->save();

        $ketamine = new Category();
        $ketamine->parent_category = $dissociatives->id;
        $ketamine->name = 'Ketamine';
        $ketamine->slug = 'ketamine';
        $ketamine->save();

        $otherdissociatives = new Category();
        $otherdissociatives->parent_category = $dissociatives->id;
        $otherdissociatives->name = 'Other Dissociatives';
        $otherdissociatives->slug = 'otherdissociatives';
        $otherdissociatives->save();

        ########### ECSTASY
        $ecstasy = new Category();
        $ecstasy->name = 'Ecstasy';
        $ecstasy->slug = 'ecstasy';
        $ecstasy->save();

        $mdma = new Category();
        $mdma->parent_category = $ecstasy->id;
        $mdma->name = 'MDMA';
        $mdma->slug = 'mdma';
        $mdma->save();

        $mda = new Category();
        $mda->parent_category = $ecstasy->id;
        $mda->name = 'MDA';
        $mda->slug = 'mda';
        $mda->save();

        $mdea = new Category();
        $mdea->parent_category = $ecstasy->id;
        $mdea->name = 'MDEA';
        $mdea->slug = 'mdea';
        $mdea->save();

        $pills = new Category();
        $pills->parent_category = $ecstasy->id;
        $pills->name = 'Pills(Ecstasy)';
        $pills->slug = 'pills_ecstasy';
        $pills->save();

        $otherecstacy = new Category();
        $otherecstacy->parent_category = $ecstasy->id;
        $otherecstacy->name = 'Other Ecstacy';
        $otherecstacy->slug = 'otherecstacy';
        $otherecstacy->save();

        ########### OPIOIDS
        $opioids = new Category();
        $opioids->name = 'Opioids';
        $opioids->slug = 'opioids';
        $opioids->save();

        $heroin = new Category();
        $heroin->parent_category = $opioids->id;
        $heroin->name = 'Heroin';
        $heroin->slug = 'heroin';
        $heroin->save();

        $morphine = new Category();
        $morphine->parent_category = $opioids->id;
        $morphine->name = 'Morphine';
        $morphine->slug = 'morphine ';
        $morphine->save();

        $otheropiods = new Category();
        $otheropiods->parent_category = $opioids->id;
        $otheropiods->name = 'Other Opioids';
        $otheropiods->slug = 'otheropiods';
        $otheropiods->save();

        ########### PRESCRIPTION
        $prescription = new Category();
        $prescription->name = 'Prescription';
        $prescription->slug = 'prescription';
        $prescription->save();

        ########### PSYCHEDELICS
        $psychedelics = new Category();
        $psychedelics->name = 'Psychedelics';
        $psychedelics->slug = 'psychedelics';
        $psychedelics->save();

        $ce = new Category();
        $ce->parent_category = $psychedelics->id;
        $ce->name = '2CE';
        $ce->slug = '2ce';
        $ce->save();

        $lsa = new Category();
        $lsa->parent_category = $psychedelics->id;
        $lsa->name = 'LSA';
        $lsa->slug = 'lsa';
        $lsa->save();

        $lsd = new Category();
        $lsd->parent_category = $psychedelics->id;
        $lsd->name = 'LSD';
        $lsd->slug = 'lsd';
        $lsd->save();

        $dmt = new Category();
        $dmt->parent_category = $psychedelics->id;
        $dmt->name = 'DMT';
        $dmt->slug = 'dmt';
        $dmt->save();

        $shrooms = new Category();
        $shrooms->parent_category = $psychedelics->id;
        $shrooms->name = 'Mushrooms';
        $shrooms->slug = 'mushrooms';
        $shrooms->save();

        $twocb = new Category();
        $twocb->parent_category = $psychedelics->id;
        $twocb->name = '2C-B';
        $twocb->slug = '2c-b';
        $twocb->save();

        $mescaline = new Category();
        $mescaline->parent_category = $psychedelics->id;
        $mescaline->name = 'Mescaline';
        $mescaline->slug = 'mescaline';
        $mescaline->save();

        $otherpsychedelics = new Category();
        $otherpsychedelics->parent_category = $psychedelics->id;
        $otherpsychedelics->name = 'Other Psychedelics';
        $otherpsychedelics->slug = 'otherpsychedelics';
        $otherpsychedelics->save();

        ########### STEROIDS
        $steroids = new Category();
        $steroids->name = 'Steroids';
        $steroids->slug = 'steroids';
        $steroids->save();

        $catabolic = new Category();
        $catabolic->parent_category = $steroids->id;
        $catabolic->name = 'Catabolic';
        $catabolic->slug = 'catabolic';
        $catabolic->save();

        $anabolic = new Category();
        $anabolic->parent_category = $steroids->id;
        $anabolic->name = 'Anabolic';
        $anabolic->slug = 'anabolic';
        $anabolic->save();

        ########### STIMULANTS
        $stimulants = new Category();
        $stimulants->name = 'Stimulants';
        $stimulants->slug = 'stimulants';
        $stimulants->save();

        $amphetamine = new Category();
        $amphetamine->parent_category = $stimulants->id;
        $amphetamine->name = 'Amphetamine';
        $amphetamine->slug = 'amphetamine';
        $amphetamine->save();

        $meth = new Category();
        $meth->parent_category = $stimulants->id;
        $meth->name = 'Meth Amphetamine';
        $meth->slug = 'methamphetamine';
        $meth->save();

        $cocaine = new Category();
        $cocaine->parent_category = $stimulants->id;
        $cocaine->name = 'Cocaine';
        $cocaine->slug = 'cocaine';
        $cocaine->save();

        $mephedrone = new Category();
        $mephedrone->parent_category = $stimulants->id;
        $mephedrone->name = 'Mephedrone';
        $mephedrone->slug = 'mephedrone';
        $mephedrone->save();

        $fourmfp = new Category();
        $fourmfp->parent_category = $stimulants->id;
        $fourmfp->name = '4-MFP';
        $fourmfp->slug = '4mfp';
        $fourmfp->save();

        $otherstimulants = new Category();
        $otherstimulants->parent_category = $stimulants->id;
        $otherstimulants->name = 'Other Stimulants';
        $otherstimulants->slug = 'otherstimulants';
        $otherstimulants->save();

        ########### PHARMA
        $pharma = new Category();
        $pharma->name = 'Pharma';
        $pharma->slug = 'pharma';
        $pharma->save();

        $painKillers = new Category();
        $painKillers->parent_category = $pharma->id;
        $painKillers->name = 'PainKillers';
        $painKillers->slug = 'painKillers';
        $painKillers->save();

        $steroids = new Category();
        $steroids->parent_category = $pharma->id;
        $steroids->name = 'Steroids';
        $steroids->slug = 'steroids';
        $steroids->save();

        $tranquillizers = new Category();
        $tranquillizers->parent_category = $pharma->id;
        $tranquillizers->name = 'Tranquillizers';
        $tranquillizers->slug = 'tranquillizers';
        $tranquillizers->save();

        $ritalin = new Category();
        $ritalin->parent_category = $pharma->id;
        $ritalin->name = 'Ritalin';
        $ritalin->slug = 'ritalin';
        $ritalin->save();

        $otherpharma = new Category();
        $otherpharma->parent_category = $pharma->id;
        $otherpharma->name = 'Other Pharma';
        $otherpharma->slug = 'otherpharma';
        $otherpharma->save();

        ########### Counterfeits
        $counterfeits = new Category();
        $counterfeits->name = 'Counterfeits';
        $counterfeits->slug = 'counterfeits';
        $counterfeits->save();

        $passports = new Category();
        $passports->parent_category = $counterfeits->id;
        $passports->name = 'Passports';
        $passports->slug = 'passports';
        $passports->save();

        $currencies = new Category();
        $currencies->parent_category = $counterfeits->id;
        $currencies->name = 'Currencies';
        $currencies->slug = 'currencies';
        $currencies->save();

        $driverslicenses = new Category();
        $driverslicenses->parent_category = $counterfeits->id;
        $driverslicenses->name = 'Driver\'s Licenses';
        $driverslicenses->slug = 'driverslicenses';
        $driverslicenses->save();

        $othercounterfeits = new Category();
        $othercounterfeits->parent_category = $counterfeits->id;
        $othercounterfeits->name = 'Other Counterfeits';
        $othercounterfeits->slug = 'othercounterfeits';
        $othercounterfeits->save();

        ########### Digital
        $digital = new Category();
        $digital->name = 'Digital';
        $digital->slug = 'digital';
        $digital->save();

        $services = new Category();
        $services->parent_category = $digital->id;
        $services->name = 'Services';
        $services->slug = 'services';
        $services->save();

        $softwares = new Category();
        $softwares->parent_category = $digital->id;
        $softwares->name = 'Softwares';
        $softwares->slug = 'softwares';
        $softwares->save();

        $tutorials = new Category();
        $tutorials->parent_category = $digital->id;
        $tutorials->name = 'Tutorials';
        $tutorials->slug = 'tutorials';
        $tutorials->save();

        $malwares = new Category();
        $malwares->parent_category = $digital->id;
        $malwares->name = 'Malwares';
        $malwares->slug = 'malwares';
        $malwares->save();

        $erotics = new Category();
        $erotics->parent_category = $digital->id;
        $erotics->name = 'Erotics';
        $erotics->slug = 'erotics';
        $erotics->save();

        $hacking = new Category();
        $hacking->parent_category = $digital->id;
        $hacking->name = 'Hacking';
        $hacking->slug = 'hacking';
        $hacking->save();

        $exploits = new Category();
        $exploits->parent_category = $digital->id;
        $exploits->name = 'Exploits';
        $exploits->slug = 'exploits';
        $exploits->save();

        $vpn = new Category();
        $vpn->parent_category = $digital->id;
        $vpn->name = 'VPN';
        $vpn->slug = 'vpn';
        $vpn->save();

        $ebooks = new Category();
        $ebooks->parent_category = $digital->id;
        $ebooks->name = 'Ebooks';
        $ebooks->slug = 'ebooks';
        $ebooks->save();

        $otherdigitalitems = new Category();
        $otherdigitalitems->parent_category = $digital->id;
        $otherdigitalitems->name = 'Other Digital Items';
        $otherdigitalitems->slug = 'otherdigitalitems';
        $otherdigitalitems->save();

        ########### Fraud
        $fraud = new Category();
        $fraud->name = 'Fraud';
        $fraud->slug = 'fraud';
        $fraud->save();

        $logins = new Category();
        $logins->parent_category = $fraud->id;
        $logins->name = 'Logins';
        $logins->slug = 'logins';
        $logins->save();

        $cardscvv = new Category();
        $cardscvv->parent_category = $fraud->id;
        $cardscvv->name = 'Cards - CVV';
        $cardscvv->slug = 'cardscvv';
        $cardscvv->save();

        $drops = new Category();
        $drops->parent_category = $fraud->id;
        $drops->name = 'Drops';
        $drops->slug = 'drops';
        $drops->save();

        $dumps = new Category();
        $dumps->parent_category = $fraud->id;
        $dumps->name = 'Dumps';
        $dumps->slug = 'dumps';
        $dumps->save();

        $fullz = new Category();
        $fullz->parent_category = $fraud->id;
        $fullz->name = 'FUllz';
        $fullz->slug = 'fullz';
        $fullz->save();

        $accounts = new Category();
        $accounts->parent_category = $fraud->id;
        $accounts->name = 'Accounts';
        $accounts->slug = 'accounts';
        $accounts->save();

        $otherfrauditems = new Category();
        $otherfrauditems->parent_category = $fraud->id;
        $otherfrauditems->name = 'Other Fraud Items';
        $otherfrauditems->slug = 'otherfrauditems';
        $otherfrauditems->save();

        ########### Website Script
        $websitescript = new Category();
        $websitescript->name = 'Website Script';
        $websitescript->slug = 'websitescript';
        $websitescript->save();

        $forums = new Category();
        $forums->parent_category = $websitescript->id;
        $forums->name = 'Forums';
        $forums->slug = 'forums';
        $forums->save();

        $markets = new Category();
        $markets->parent_category = $websitescript->id;
        $markets->name = 'Markets';
        $markets->slug = 'markets';
        $markets->save();

        $directories = new Category();
        $directories->parent_category = $websitescript->id;
        $directories->name = 'Directories';
        $directories->slug = 'directories';
        $directories->save();

        $news = new Category();
        $news->parent_category = $websitescript->id;
        $news->name = 'News';
        $news->slug = 'news';
        $news->save();

        $vendorstores = new Category();
        $vendorstores->parent_category = $websitescript->id;
        $vendorstores->name = 'Vendor Stores';
        $vendorstores->slug = 'vendorstores';
        $vendorstores->save();

        $otherscripts = new Category();
        $otherscripts->parent_category = $websitescript->id;
        $otherscripts->name = 'Other Scripts';
        $otherscripts->slug = 'otherscripts';
        $otherscripts->save();
    }
}