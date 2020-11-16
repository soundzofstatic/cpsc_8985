<script src="{{ parse_url(asset('js/jquery-3.3.1.min.js'), PHP_URL_PATH) }}"></script>
<!-- Filter Section Begin -->
<div class="col-lg-3">
    <div class="filter-left">
        <div class="category-filter">
            <h3>Category Filter</h3>
            <div class="category-option">
                <div class="co-item">
                    <label class="active" onclick="filterOptions()"><input type="radio" name="category" value="Restaurants" checked>Restaurants</label>
                </div>
                <div class="co-item">
                    <label onclick="filterOptions()"> <input type="radio" name="category" value="pub">Bars & Pubs</label>
                </div>
                <div class="co-item">
                    <label onclick="filterOptions()"> <input type="radio" name="category" value="Clubs">Clubs</label>
                </div>

            </div>
        </div>
        <div class="rating-filter">
            <h3>Ratings</h3>
            <div class="rating-option">
                <div class="ro-item">
                    <label class="active" onclick="filterOptions()"><input type="radio" name="rating" value="5" checked> 5.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label onclick="filterOptions()"> <input type="radio" name="rating" value="4"> 4.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label onclick="filterOptions()"><input type="radio" name="rating" value="3">3.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label onclick="filterOptions()"> <input type="radio" name="rating" value="2">2.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
                <div class="ro-item">
                    <label onclick="filterOptions()"> <input type="radio" name="rating" value="1">1.0</label>
                    <div class="rating-pic">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                        <i class="fa fa-star grey-bg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-filter">
            <h3>Service Provider</h3>
            <div class="distance-option">
                <div class="do-item">
                    <label onclick="filterOptions()"> <input type="radio" name="serviceProvider" value="1"  checked>Drive thru</label>
                </div>
                <div class=" ro-item"></div>
                    <label class="active" onclick="filterOptions()"> <input type="radio" name="serviceProvider" value="2" >Carry Out</label>
                </div>
                <div class="do-item">
                    <label onclick="filterOptions()"> <input type="radio" name="serviceProvider" value="3">Outdoor Dining </label>
                </div>
                <div class="do-item">
                    <label onclick="filterOptions()"> <input type="radio" name="serviceProvider" value="4">Pet Friendly</label>
                </div>
            </div>
        </div>
    </div>
<script>
        function filterOptions(){
            let categories= document.getElementsByName('category');
            let ratings = document.getElementsByName('rating');
            let serviceProviders= document.getElementsByName('serviceProvider');
            let getCategoryValue;
            let getRatingValue;
            let getProviderValue;
            for(i=0;i<ratings.length;i++){
                if(ratings[i].checked){
                    getRatingValue = ratings[i].value;
                }
                if(categories[i] && categories[i].checked){
                    getCategoryValue = categories[i].value;
                }
                if(serviceProviders[i] && serviceProviders[i].checked){
                    getProviderValue = serviceProviders[i].value;
                }
            }
            console.log('cat', getCategoryValue);
            console.log('rat', getRatingValue);
            console.log('pro', getProviderValue);
            $.ajax({
                type:'POST',
                url: '{{url("/filter-search")}}',
                data:
                    {
                        '_token':$('input[name=_token]').val(),
                        'category': getCategoryValue,
                        'rating': getRatingValue,
                        'serviceProvider':getProviderValue,
                    },
                headers:
                    {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                success:function(data)
                {
                    window.location.reload();
                },
            });
        }
</script>
<!-- Filter Section End -->