<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1><span id="policyName"></span></h1>
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
        <div class="row">
            <div id="policies" class="col-12">

            </div>
        </div>
    </div>
</div>


<script>
    async function policy() {
        let search = new URLSearchParams(window.location.search);
        let type = search.get('type');

        if (type === "about") {
            $("#policyName").text("About Us")
        }

        if (type === "refund") {
            $("#policyName").text("Refund Policy")
        }

        if (type === "terms") {
            $("#policyName").text("Terms & Condition")
        }

        if (type === "how to buy") {
            $("#policyName").text("How to Buy")
        }

        if (type === "contact") {
            $("#policyName").text("Our Contact Details")
        }

        if (type === "complain") {
            $("#policyName").text("How to complain")
        }

        let res = await axios.get("/policy/" + type);
        let des = res.data['description']
        $("#policies").html(des)
    }
</script>
