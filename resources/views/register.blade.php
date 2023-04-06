<form action="/register" method="POST">

	@csrf

	<h5>Registration</h5>

	@if($errors->any())
		{!! implode('', $errors->all('<div>:message</div>')) !!}
	@endif

	<label for="emailForm">Email address</label>
	<input id="emailForm" name="email" placeholder="Email">

	<label for="passwordForm">Password</label>
	<input type="password" name="password" id="passwordForm" placeholder="Password">

	<input value="Submit" type="submit">
	<a class="auth" href="/auth" class="link-primary">Authorization</a>
</form>