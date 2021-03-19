<?xml version="1.0" encoding="UTF-8"?>
<SHOP xmlns="http://www.zbozi.cz/ns/offer/1.0">
    @foreach ($products as $product)
    <SHOPITEM>
        <ITEM_ID>{{ $product->id }}</ITEM_ID>
        <PRODUCTNAME>{{ $product->title }}</PRODUCTNAME>
        <DESCRIPTION>{{ $product->teaser }}</DESCRIPTION>
        <CATEGORYTEXT>Oblečení a doplňky | Oblečení</CATEGORYTEXT>
        <URL>{{ config('option.frontend_url', '') }}produkt/{{ $product->slug }}/</URL>
        <IMGURL>{{ $product->files->where('type', 'thumbnail')->first()->full_path }}</IMGURL>
        <ITEM_TYPE>new</ITEM_TYPE>
        <PRICE_VAT>{{ number_format($product->variants->first()->price_include_VAT, 2) }} CZK</PRICE_VAT>
        <MANUFACTURER>{{ config('option.app_name', '') }}</MANUFACTURER>
        {{-- @foreach ($shipments as $shipping)
        TODO
        <DELIVERY>
            <DELIVERY_ID></DELIVERY_ID> // id podle seznamu
            <DELIVERY_PRICE>0,00</DELIVERY_PRICE> // cena
            <DELIVERY_PRICE_COD>0,00</DELIVERY_PRICE_COD> // cena s dobirkou
        </DELIVERY>
        @endforeach --}}
        <DELIVERY_DATE>0</DELIVERY_DATE>
        <VISIBILITY>1</VISIBILITY>
        <MAX_CPC>0</MAX_CPC>
        <MAX_CPC_SEARCH>0</MAX_CPC_SEARCH>
    </SHOPITEM>
    @endforeach
</SHOP>