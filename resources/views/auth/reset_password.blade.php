@include('partials.header')
<form method="POST" action="/forgot-password" style="width: 600px;padding:20px;margin: 100px auto;">
    @csrf
    <div class="form-group">
        <label class="font-weight-bold text-uppercase">Email Address</label>
        <input id="email" type="email" class="form-control  " name="email" value="" required
            autocomplete="email" autofocus placeholder="Masukkan Alamat Email">
    </div>
    <button type="submit" class="btn btn-primary btn-block">SEND PASSWORD RESET LINK</button>
</form>
@include('partials.footer')
