<?xml version="1.0"?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
    <channel>
        <title>{{ $shop->page_title }}</title>
        <link>{{ config('option.frontend_url', '') }}</link>
        <description>{{ $shop->meta_description }}</description>
        @foreach ($products as $product)
        <item>
            <g:id>{{ $product->id }}</g:id>
            <title>{{ $product->title }}</title>
            <description>{{ $product->teaser }}</description>
            <g:product_type>Oblečení a doplňky &amp;gt; Oblečení</g:product_type>
            <link>{{ config('option.frontend_url', '') }}produkt/{{ $product->slug }}/</link>
            <g:mobile_link>{{ config('option.frontend_url', '') }}produkt/{{ $product->slug }}/</g:mobile_link>
            <g:image_link>{{ $product->files->where('type', 'thumbnail')->first()->full_path }}</g:image_link>
            <g:condition>new</g:condition>
            <g:availability>in stock</g:availability>
            <g:price>{{ number_format($product->variants->first()->price_include_VAT, 2) }} CZK</g:price>
            <g:brand>{{ config('option.app_name', '') }}</g:brand>
            <g:identifier_exists>FALSE</g:identifier_exists>
            @foreach ($shipments as $shipping)
            <g:shipping>
                <g:country>CZ</g:country>
                <g:service>{{ $shipping->title }}</g:service>
                <g:price>{{ number_format($shipping->price, 2) }} CZK</g:price>
            </g:shipping>
            @endforeach
            <g:adult>FALSE</g:adult>
        </item>
        @endforeach
    </channel>
</rss>