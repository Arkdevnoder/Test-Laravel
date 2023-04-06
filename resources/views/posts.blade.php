@if(count($posts) == 0)
No posts
@endif
@foreach($posts as $post)

<div>


<div>{{$post['id']}}</div>
<div>{{$post['name']}}</div>
<div>{{$post['slug']}}</div>
<div>{{$post['text']}}</div>
<div>{{$post['picture']}}</div>
<a href="/posts/{{$post['id']}}">Show picture</a>

<form action="{{ route('posts.destroy', $post['id']) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
	<button type="submit">Delete</button>
</form>

</div>
<br>

@endforeach

<form action="posts" method="POST" enctype="multipart/form-data">

	@csrf

	<input name="name" placeholder="name">
	<input type="file" name="picture" placeholder="name">
	<textarea name="text" placeholder="text"></textarea>
	<input type="submit">

</form>

@if (session('ok'))
	{{ session('ok') }}
@endif
@if($errors->any())
    {!! implode('', $errors->all(':message')) !!}
@endif

<br>
<br>
<br>
<a href="/">Index</a>