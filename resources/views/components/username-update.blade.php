<form method="POST" action="{{ route('console.update.username') }}" class="contact-form">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <label for="username" class="sr-only">Username</label>
            <input type="text" placeholder="Username" name="username" value="{{ old('username') }}">
        </div>
        <div class="col-lg-12 text-center">
            <button type="submit">Update</button>
        </div>
    </div>
</form>