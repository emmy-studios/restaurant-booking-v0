<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CountryCode: string implements HasLabel
{
    case Albania = '+355';
    case Algeria = '+213';
    case Andorra = '+376';
    case Angola = '+244';
    case Argentina = '+54';
    case Armenia = '+374';
    case Australia = '+61';
    case Austria = '+43';
    case Azerbaijan = '+994';
    case Bahamas = '+1-242';
    case Bahrain = '+973';
    case Bangladesh = '+880';
    case Barbados = '+1-246';
    case Belarus = '+375';
    case Belgium = '+32';
    case Belize = '+501';
    case Benin = '+229';
    case Bhutan = '+975';
    case Bolivia = '+591';
    case BosniaHerzegovina = '+387';
    case Botswana = '+267';
    case Brazil = '+55';
    case Brunei = '+673';
    case Bulgaria = '+359';
    case BurkinaFaso = '+226';
    case Burundi = '+257';
    case Cambodia = '+855';
    case Cameroon = '+237';
    case Canada = '(+1)';
    case CentralAfricanRepublic = '+236';
    case Chad = '+235';
    case Chile = '+56';
    case China = '+86';
    case Colombia = '+57';
    case Comoros = '+269';
    case CongoBrazzaville = '+242';
    case CongoKinshasa = '+243';
    case CostaRica = '+506';
    case Croatia = '+385';
    case Cyprus = '+357';
    case CzechRepublic = '+420';
    case Denmark = '+45';
    case Djibouti = '+253';
    case Dominica = '+1-767';
    case DominicanRepublic = '+1-809';
    case EastTimor = '+670';
    case Ecuador = '+593';
    case Egypt = '+20';
    case ElSalvador = '+503';
    case EquatorialGuinea = '+240';
    case Eritrea = '+291';
    case Eswatini = '+268';
    case Estonia = '+372';
    case Ethiopia = '+251';
    case Fiji = '+679';
    case Finland = '+358';
    case France = '+33';
    case Gabon = '+241';
    case Gambia = '+220';
    case Georgia = '+995';
    case Germany = '+49';
    case Ghana = '+233';
    case Greece = '+30';
    case Grenada = '+1-473';
    case Guatemala = '+502';
    case Guinea = '+224';
    case Guyana = '+592';
    case Haiti = '+509';
    case Honduras = '+504';
    case Hungary = '+36';
    case Iceland = '+354';
    case India = '+91';
    case Indonesia = '+62';
    case Iran = '+98';
    case Iraq = '+964';
    case Ireland = '+353';
    case Israel = '+972';
    case Italy = '+39';
    case Jamaica = '+1-876';
    case Japan = '+81';
    case Jordan = '+962';
    case Kazakhstan = '(+7)';
    case Kenya = '+254';
    case Kosovo = '+383';
    case Kuwait = '+965';
    case Kyrgyzstan = '+996';
    case Laos = '+856';
    case Latvia = '+371';
    case Lebanon = '+961';
    case Lesotho = '+266';
    case Liberia = '+231';
    case Libya = '+218';
    case Liechtenstein = '+423';
    case Lithuania = '+370';
    case Luxembourg = '+352';
    case Madagascar = '+261';
    case Malawi = '+265';
    case Malaysia = '+60';
    case Maldives = '+960';
    case Malta = '+356';
    case MarshallIslands = '+692';
    case Mauritania = '+222';
    case Mauritius = '+230';
    case Mexico = '+52';
    case Micronesia = '+691';
    case Monaco = '+377';
    case Montenegro = '+382';
    case Mongolia = '+976';
    case Morocco = '+212';
    case Mozambique = '+258';
    case Namibia = '+264';
    case Nauru = '+674';
    case Nepal = '+977';
    case Netherlands = '+31';
    case NewZealand = '+64';
    case Nicaragua = '+505';
    case Nigeria = '+234';
    case NorthMacedonia = '+389';
    case Norway = '+47';
    case Oman = '+968';
    case Pakistan = '+92';
    case Palestine = '+970';
    case Panama = '+507';
    case PapuaNewGuinea = '+675';
    case Paraguay = '+595';
    case Peru = '+51';
    case Philippines = '+63';
    case Poland = '+48';
    case Portugal = '+351';
    case Qatar = '+974';
    case Romania = '+40';
    case Russia = '+7';
    case Rwanda = '+250';
    case SaintKittsNevis = '+1-869';
    case SaintLucia = '+1-758';
    case SaintVincentGrenadines = '+1-784';
    case Samoa = '+685';
    case SaudiArabia = '+966';
    case Senegal = '+221';
    case Serbia = '+381';
    case Seychelles = '+248';
    case SierraLeone = '+232';
    case Singapore = '+65';
    case Slovakia = '+421';
    case Slovenia = '+386';
    case SolomonIslands = '+677';
    case Somalia = '+252';
    case SouthAfrica = '+27';
    case SouthKorea = '+82';
    case SouthSudan = '+211';
    case Spain = '+34';
    case SriLanka = '+94';
    case Sudan = '+249';
    case Suriname = '+597';
    case Sweden = '+46';
    case Switzerland = '+41';
    case Syria = '+963';
    case Tajikistan = '+992';
    case Tanzania = '+255';
    case Thailand = '+66';
    case TimorLeste = '(+670)';
    case Togo = '+228';
    case TrinidadTobago = '+1-868';
    case Tunisia = '+216';
    case Turkey = '+90';
    case Turkmenistan = '+993';
    case Tuvalu = '+688';
    case UAE = '+971';
    case Uganda = '+256';
    case USA = '+1';
    case Uruguay = '+598';
    case Uzbekistan = '+998';
    case Vanuatu = '+678';
    case Vietnam = '+84';
    case Yemen = '+967';
    case Zambia = '+260';
    case Zimbabwe = '+263';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

}
