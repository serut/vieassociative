{{ '<?xml version="1.0" encoding="UTF-8"?>'."\n" }}
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
@foreach($localURL as $l)
	<url>
		<loc>{{$l}}</loc>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
@endforeach
@foreach($listAssocs as $a)
	<url>
		<loc>http://association.vieassociative.fr/{{$a->id}}-{{$a->slug}}</loc>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
@endforeach
</urlset>