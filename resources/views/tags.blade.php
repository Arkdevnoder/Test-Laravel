@if(count($tags) == 0)
No tags
@endif
@foreach($tags as $tag)

<div>

<div>{{$tag['id']}}</div>
<div>{{$tag['name']}}</div>
<div>{{$tag['slug']}}</div>

<form action="{{ route('tags.destroy', $tag['id']) }}" method="POST">
    @csrf
    {{ method_field('DELETE') }}
	<button type="submit">Delete</button>
</form>

</div>
<br>

@endforeach

<form action="tags" method="POST">
	
	@csrf

	<input name="name" placeholder="name">
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