<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Brand: <span id="BrandName"></span></h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">This Page</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    <div class="container my-5">
        <div id="brandList" class="row">

        </div>
    </div>
</div>
<script>
    async function brandProductList() {
        let search = new URLSearchParams(window.location.search);
        let id = search.get('id');

        let res = await axios.get(`/product-brand/${id}`);
        $("#brandList").empty();

        res.data['data'].forEach((item, i) => {
            let eachItem = `<div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="#">
                                            <img src="${item['image']}" alt="product_img">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li>
                                                    <a href="/product?id=${item['id']}" class="popup-ajax">
                                                        <i class="icon-magnifier-add"></i></a>
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title">
                                            <a href="/product?id=${item['id']}">${item['title']}</a>
                                        </h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item['price']}</span>
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:${item['star']}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`

            $("#brandList").append(eachItem);
            $("#BrandName").text(res.data['data'][0]['brand']['brandName']);
        })
    }
</script>
