<?xml version="1.0" encoding="UTF-8"?>
<SHOP>
    @foreach ($products as $product)
    <SHOPITEM>
        <ITEM_ID>{{ $product->id }}</ITEM_ID>
        <PRODUCTNAME>{{ $product->title }}</PRODUCTNAME>
        <PRODUCT>{{ $product->title }}</PRODUCT>
        <DESCRIPTION>{{ $product->teaser }}</DESCRIPTION>
        <CATEGORYTEXT>Oblečení a doplňky | Oblečení</CATEGORYTEXT>
        <URL>{{ config('option.frontend_url', '') }}produkt/{{ $product->slug }}/</URL>
        <IMGURL>{{ $product->files->where('type', 'thumbnail')->first()->full_path }}</IMGURL>
        <ITEM_TYPE>new</ITEM_TYPE>
        <PRICE_VAT>{{ number_format($product->variants->first()->price_include_VAT, 2) }}</PRICE_VAT>
        <VAT>{{ $product->variants->first()->VAT_rate }}</VAT>
        <MANUFACTURER>{{ config('option.app_name', '') }}</MANUFACTURER>
        <DELIVERY_DATE>0</DELIVERY_DATE>
    </SHOPITEM>
    @endforeach
</SHOP>