<form method="POST" action="{{ route('console.update.user.password-update', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="contact-form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6">
            <input type="password" placeholder="Password" name="password" >
        </div>
        <div class="col-lg-6">
            <input type="password" placeholder="Password Confirmation" name="password_confirmation" >
        </div>
        <div class="col-lg-12 text-center">
            <button type="submit">Update</button>
        </div>
    </div>
</form>