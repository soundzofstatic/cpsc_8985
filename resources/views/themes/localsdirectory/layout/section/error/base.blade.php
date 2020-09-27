@if ($errors->any())
    <div class="container-fluid" style="padding-top: 120px; padding-bottom: 72px;">
        <div class="container">
            <div class="row">
                <div class="col alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
