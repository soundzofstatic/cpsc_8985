
<form action="{{route('review-store')}}" method="post">
    @csrf
    <fieldset>


        <legend> SURVEY </legend>

        <p><label for="rating">Please rate the resturant: {{$business->name}}</label></p>
        <br>
        <input type="radio" name="rating" value="5"> Very Good &#128513; <br>
        <input type="radio" name="rating" value="4"> Good &#128512; <br>
        <input type="radio" name="rating" value="3"> Average &#128528; <br>
        <input type="radio" name="rating" value="2"> Bad &#128566; <br>
        <input type="radio" name="rating" value="1"> VeryBad &#128551; <br>
        <input type="radio" name="rating" value="0"> No Comment<br>


        <br><br>
        <textarea id="review" name="review" rows="20" cols="100" placeholder="Please leave your comments">
</textarea>

        <p>
            <input type="hidden" name="business_id" value="{{$business->id}}" />
            <input type="submit" name="submit" value="Submit My Information"/>
        </p>
    </fieldset>
</form>
</div>
</div>
