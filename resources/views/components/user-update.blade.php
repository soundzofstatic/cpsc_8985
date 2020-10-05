<form method="POST" action="{{ route('console.update.user.details-update', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}" class="contact-form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-4">
            <input type="text" placeholder="First Name" name="first_name" value="{{ old('first_name', \Illuminate\Support\Facades\Auth::user()->first_name) }}">
        </div>
        <div class="col-lg-4">
            <input type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name', \Illuminate\Support\Facades\Auth::user()->last_name) }}">
        </div>
        <div class="col-lg-4">
            <input type="text" placeholder="Your E-mail" name="email" value="{{ old('email', \Illuminate\Support\Facades\Auth::user()->email) }}" readonly="readonly">
        </div>
        <div class="col-lg-12 text-center">
            <button type="submit">Update</button>
        </div>
    </div>
</form>