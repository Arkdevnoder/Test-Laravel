<form action="/login" method="POST">

	@csrf

	<h5>Login</h5>

	@if($errors->any())
		{!! implode('', $errors->all('<div>:message</div>')) !!}
	@endif

	<label for="emailForm" class="form-label">Email address</label>
	<input type="email" name="email" id="emailForm" placeholder="Email">

	<label for="passwordForm">Password</label>
	<input name="password" type="password" id="passwordForm" placeholder="Password">

	<input value="Submit" type="submit">
	<a class="registration" href="/register">Registration</a>
</form>