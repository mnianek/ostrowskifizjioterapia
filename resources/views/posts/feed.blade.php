<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ config('app.name') }} - Blog</title>
        <link>{{ route('posts.index') }}</link>
        <description>Aktualne wpisy blogowe o fizjoterapii i zdrowym ruchu.</description>
        <language>pl</language>
        <atom:link href="{{ route('posts.feed') }}" rel="self" type="application/rss+xml" />

        @foreach ($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ route('posts.show', $post->slug) }}</link>
                <guid>{{ route('posts.show', $post->slug) }}</guid>
                <pubDate>{{ optional($post->published_at ?? $post->created_at)->toRssString() }}</pubDate>
                <description><![CDATA[{{ $post->excerpt ?: ($post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 200)) }}]]></description>
            </item>
        @endforeach
    </channel>
</rss>
