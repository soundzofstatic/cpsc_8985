@extends('themes.localsdirectory.layout.base')
@section ('page_name')Error
@endsection
@section ('content')
    <div class="row content-wrapper">
        <div class="col">
            <h2>Unable to process your request</h2>
            <p>There was an error while processing your request. Error: <strong>{{ $exception->getMessage() }}</strong>.</p>
            <p>If you continue to receive this error please contact the <a href="mailto:aes_webmaster@uic.edu?subject=Open%20House%202020%20Error&body=Error:%20{{ $exception->getMessage() }}" title="AES Webmaster email">AES webmaster</a>.</p>
        </div>
    </div>
    <div class="row content-wrapper">
        <div class="col">
            <a href="/" class="btn btn-danger" title="Open House Home Page">Return Home</a>
        </div>
    </div>
@endsection