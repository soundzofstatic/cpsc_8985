@if(session('message'))
    <div class="container-fluid" style="padding-top: 120px; padding-bottom: 72px;">
        <div class="container">
            <div class="row">
                <div class="col alert alert-success m-4" role="alert">
                    <div>{{session('message')}}</div>
                </div>
            </div>
        </div>
    </div>
@endif
