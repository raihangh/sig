@include('partials.header')
@if (session()->has('status'))
    <h1>{{ session()->get('status') }}</h1>
@endif
<form method="POST" action="/reset-password" style="width: 600px;padding:20px;margin: 100px auto;">
    @csrf
    <div class="form-group">
        <input id="token" type="hidden" class="form-control  " name="token" value={{ $token }}> <br>
        <input id="email" type="hidden" class="form-control  " name="email" value={{ request()->email }}> <br>
        <input id="password" type="password" class="form-control  " name="password" value=""
            autocomplete="password" autofocus placeholder="Password Baru"> <br>
        <input id="password_confirmation" type="password_confirmation" class="form-control  "
            name="password_confirmation" value="" autocomplete="password_confirmation" autofocus
            placeholder="Masukka password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary btn-block">UPDATE PASSWORD</button>
</form>
@include('partials.footer')
