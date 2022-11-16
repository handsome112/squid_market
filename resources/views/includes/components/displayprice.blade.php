{{ Currency::currencyConverter($price, auth()->user()->currency) }}
{{ App\Tools\Converter::getSymbol(auth()->user()->currency) }}