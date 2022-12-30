(function($){
    $('#filter-data').on('submit', function(e){
        e.preventDefault();
        $.get($(this).attr('action') , $(this).serialize(), function(items){
            $('#prod-det').empty();
            items.forEach(function(item){
                $('#prod-det').append(`
                        <div class="col-lg-4 col-md-4 col-sm-6 mt-40" >
                        <div class="single-product-wrap">
                        <div class="product-image">
                            <a href="${item.link}">
                                <img src="${item.image_url}"
                                    alt="Li's Product Image">
                            </a>
                            <span class="sticker">New</span>
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="${item.link}">${item.category.name}</a>
                                        </h5>
                                        
                                    </div>
                                    <h4><a class="product_name"
                                            href="${item.link}">${item.name}</a></h4>
                                    <div class="price-box">
                                        <span class="new-price">${item.price}</span>
                                    </div>
                                </div>
                                <div class="add-actions">
                                    <ul class="add-actions-link">
                                        <form action="${item.cart_link}" method="post">
                                            <input type="hidden" name="product_id" value="${item.id}">
                                            
                                            <button type="submit"> 
                                            <li class="add-cart active">Add to cart</li>
                                            </button>
                                        </form>
                                        <li>
                                            <a href="#" title="quick view"
                                            class="quick-view-btn" data-toggle="modal" 
                                            data-target="#exampleModalCenter">
                                            <i class="fa fa-eye"></i>
                                            </a>
                                        </li>
                                            <form action="${item.wishlist_link}" method="post">
                                                
                                                <input type="hidden" name="product_id" value="${item.id}">
                                                <button type="submit" class="heart"><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a></button>
                                            </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
                
            
        });
    });
})(jQuery); 