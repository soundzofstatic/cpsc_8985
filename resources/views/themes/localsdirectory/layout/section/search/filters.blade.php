<script src="{{ parse_url(asset('js/jquery-3.3.1.min.js'), PHP_URL_PATH) }}"></script>
<!-- Filter Section Begin -->
<div class="col-lg-3">
    <div class="filter-left">
{{--        <div class="category-filter">--}}
{{--            <h3>Category Filter</h3>--}}
{{--            <div class="category-option">--}}
{{--                <div class="co-item">--}}
{{--                    <label class="active" onclick="filterOptions()"><input type="radio" name="category" value="Restaurants" checked>Restaurants</label>--}}
{{--                </div>--}}
{{--                <div class="co-item">--}}
{{--                    <label onclick="filterOptions()"> <input type="radio" name="category" value="pub">Bars & Pubs</label>--}}
{{--                </div>--}}
{{--                <div class="co-item">--}}
{{--                    <label onclick="filterOptions()"> <input type="radio" name="category" value="Clubs">Clubs</label>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
        <div class="rating-filter">
            <h3>Ratings</h3>
            <div class="rating-option ratings">
                <div class="ro-item">
                    <label><input type="radio" class="rating_select" name="rating" value="5.0"> 5.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label> <input type="radio" class="rating_select" name="rating" value="4.0"> 4.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label><input type="radio" class="rating_select" name="rating" value="3.0">3.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label> <input type="radio" class="rating_select" name="rating" value="2.0">2.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label> <input type="radio" class="rating_select" name="rating" value="1.0" checked>1.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <button class="btn btn-sm btn-danger reset-rating" role="button" style="display: none;">Reset</button>
                </div>
            </div>
        </div>
        <div class="rating-filter">
            <h3>Dollar Ratings</h3>
            <div class="rating-option ratings">
                <div class="ro-item">
                    <label><input type="radio" class="dollarRating_select" name="dollarRating" value="5"> 5</label>
                    <div class="rating-pic">
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label> <input type="radio" class="dollarRating_select" name="dollarRating" value="4"> 4</label>
                    <div class="rating-pic">
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label><input type="radio" class="dollarRating_select" name="dollarRating" value="3">3</label>
                    <div class="rating-pic">
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd grey-bg"></i>
                        <i class="fa fa-usd grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label> <input type="radio" class="dollarRating_select" name="dollarRating" value="2">2</label>
                    <div class="rating-pic">
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd grey-bg"></i>
                        <i class="fa fa-usd grey-bg"></i>
                        <i class="fa fa-usd grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label> <input type="radio" class="dollarRating_select" name="dollarRating" value="1" checked>1</label>
                    <div class="rating-pic">
                        <i class="fa fa-usd"></i>
                        <i class="fa fa-usd grey-bg"></i>
                        <i class="fa fa-usd grey-bg"></i>
                        <i class="fa fa-usd grey-bg"></i>
                        <i class="fa fa-usd grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <button class="btn btn-sm btn-danger reset-dollarRating" role="button" style="display: none;">Reset</button>
                </div>
            </div>
        </div>
        <div class="rating-filter">
            <h3>Services</h3>
            <div class="rating-option services">
                @foreach(\App\Service::get() as $service)
                <div class="ro-item">
                    <label> <input type="radio" name="service" value="{{ $service->id }}">{{ $service->name }}</label>
                </div>
                @endforeach
            </div>
            <div class="ro-item">
                <button class="btn btn-sm btn-danger reset-service" role="button" style="display: none;">Reset</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $('input[type="radio"][name="rating"]').click(function(){

            selectedRatingFilter = parseFloat($(this).val());

            $('div.business.listing').each(function(index, value){

                if( parseFloat($(value).data('rating')) > selectedRatingFilter) {

                    $(this).show();

                } else {

                    $(this).hide();

                }

            });

            $('button.reset-rating').show();

        });

        $('button.reset-rating').click(function(){

            $('input[type="radio"][name="rating"]:checked').removeAttr('checked');
            $('.rating-option.ratings .ro-item label').removeClass('active');
            $('div.business.listing').show();

        });
        //dollar rating
        $('input[type="radio"][name="dollarRating"]').click(function(){
                console.log(parseFloat($(this).val()));
            selectedDollarRatingFilter = parseFloat($(this).val());

            $('div.business.listing').each(function(index, value){
                console.log(value);
                if( parseFloat($(value).data('dollarrating')) >= selectedDollarRatingFilter) {

                    $(this).show();

                } else {

                    $(this).hide();

                }

            });

            $('button.reset-dollarRating').show();

        });

        $('button.reset-dollarRating').click(function(){

            $('input[type="radio"][name="dollarRating"]:checked').removeAttr('checked');
            $('.dollarRating-option.ratings .ro-item label').removeClass('active');
            $('div.business.listing').show();

        });

        $('input[type="radio"][name="service"]').click(function(){

            selectedServiceFilter = $(this).val();

            console.log(selectedServiceFilter);

            $('div.business.listing').each(function(index, value){

                $(value).data('services');

                var servicesArray = $(value).data('services').split(',');

                console.log(servicesArray);

                if( servicesArray.includes(selectedServiceFilter)) {

                    $(this).show();

                } else {

                    $(this).hide();

                }

            });

            $('button.reset-service').show();

        });

        $('button.reset-service').click(function(){

            $('input[type="radio"][name="service"]:checked').removeAttr('checked');
            $('.rating-option.services .ro-item label').removeClass('active');
            $('div.business.listing').show();

        });

    });
        {{--function filterOptions(){--}}
        {{--    let categories= document.getElementsByName('category');--}}
        {{--    let ratings = document.getElementsByName('rating');--}}
        {{--    let serviceProviders= document.getElementsByName('serviceProvider');--}}
        {{--    let getCategoryValue;--}}
        {{--    let getRatingValue;--}}
        {{--    let getProviderValue;--}}
        {{--    for(i=0;i<ratings.length;i++){--}}
        {{--        if(ratings[i].checked){--}}
        {{--            getRatingValue = ratings[i].value;--}}
        {{--        }--}}
        {{--        if(categories[i] && categories[i].checked){--}}
        {{--            getCategoryValue = categories[i].value;--}}
        {{--        }--}}
        {{--        if(serviceProviders[i] && serviceProviders[i].checked){--}}
        {{--            getProviderValue = serviceProviders[i].value;--}}
        {{--        }--}}
        {{--    }--}}
        {{--    console.log('cat', getCategoryValue);--}}
        {{--    console.log('rat', getRatingValue);--}}
        {{--    console.log('pro', getProviderValue);--}}
        {{--    $.ajax({--}}
        {{--        type:'POST',--}}
        {{--        url: '{{url("/filter-search")}}',--}}
        {{--        data:--}}
        {{--            {--}}
        {{--                '_token':$('input[name=_token]').val(),--}}
        {{--                'category': getCategoryValue,--}}
        {{--                'rating': getRatingValue,--}}
        {{--                'serviceProvider':getProviderValue,--}}
        {{--            },--}}
        {{--        headers:--}}
        {{--            {--}}
        {{--                'X-CSRF-Token': '{{ csrf_token() }}',--}}
        {{--            },--}}
        {{--        success:function(data)--}}
        {{--        {--}}
        {{--            window.location.reload();--}}
        {{--        },--}}
        {{--    });--}}
        {{--}--}}
</script>
<!-- Filter Section End -->