Hi {{$user['name']}},

<p>Check out this new post that we have published:</p>
<h1>{{ $post['title'] }}</h1>
<p>
    {{$post['featured']}}
    <br><a href="http://theblog/posts/{{$post['id']}}">Read More</a></p>
