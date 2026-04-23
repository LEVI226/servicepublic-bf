@if(isset($items) && count($items) > 1)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    @foreach($items as $i => $item)
    {
      "@type": "ListItem",
      "position": {{ $i + 1 }},
      "name": "{{ $item['name'] }}"@if(isset($item['url']) && $item['url']),
      "item": "{{ $item['url'] }}"@endif
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endif
