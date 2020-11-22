@extends('themes.localsdirectory.layout.base')
@section ('page_name')Business Profile picture Settings
@endsection
@section ('content')
    <main class="container main-pad">
        <div class="row">
            <div class="col">
                <h1>Review</h1>
                <p>Rate the business {{$business->name}} by submitting the survey below.</p>
            </div>
        </div>
        <form action="{{route('review-store')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="review" class="col-sm-2 col-form-label">Comments</label>
                <div class="col-sm-10">
                    <textarea id="review" name="review" class="form-control" rows="20" cols="100" placeholder="Please leave your comments"></textarea>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating1" value="5" />
                            <label class="form-check-label" for="rating1">
                                Very Good &#128513;
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating2" value="4" />
                            <label class="form-check-label" for="rating2">
                                Good &#128512;
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating3" value="3" />
                            <label class="form-check-label" for="rating3">
                                Average &#128528;
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating14 value="2" />
                            <label class="form-check-label" for="rating4">
                                Bad &#128566;
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating5" value="1" />
                            <label class="form-check-label" for="rating5">
                                VeryBad &#128551;
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating6" value="0" />
                            <label class="form-check-label" for="rating6">
                                No Comment
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" name="business_id" value="{{$business->id}}" />
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </main>
@endsection
