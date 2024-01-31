<div class="container-fluid">

    <div class="row">
        <div class="col-md-3 p-2">
            <label class="form-label">Customer Name</label>
            <input type="text" id="cust_name" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Address</label>
            <input type="text" id="cust_add" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer City</label>
            <input type="text" id="cust_city" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer State</label>
            <input type="text" id="cust_state" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Post Code</label>
            <input type="text" id="cust_postcode" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Country</label>
            <input type="text" id="cust_country" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Customer Phone</label>
            <input type="text" id="cust_phone" class="form-control form-control-sm" />
        </div>

    </div>

    <hr />

    <div class="row">

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Name</label>
            <input type="text" id="ship_name" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Address</label>
            <input type="text" id="ship_add" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping City</label>
            <input type="text" id="ship_city" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping State</label>
            <input type="text" id="ship_state" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Post Code</label>
            <input type="text" id="ship_postcode" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Country</label>
            <input type="text" id="ship_country" class="form-control form-control-sm" />
        </div>

        <div class="col-md-3 p-2">
            <label class="form-label">Shipping Phone</label>
            <input type="text" id="ship_phone" class="form-control form-control-sm" />
        </div>

    </div>

    <hr />

    <div class="row">
        <div class="col-md-3">
            <button onclick="profileUpdate()" class="btn btn-danger my-3">Save Change</button>
        </div>
    </div>


</div>


<script>
    async function profileUpdate() {
        let cust_name = document.getElementById('cust_name').value;
        let cust_add = document.getElementById('cust_add').value;
        let cust_city = document.getElementById('cust_city').value;
        let cust_state = document.getElementById('cust_state').value;
        let cust_postcode = document.getElementById('cust_postcode').value;
        let cust_phone = document.getElementById('cust_phone').value;
        let cust_country = document.getElementById('cust_country').value;
        let ship_name = document.getElementById('ship_name').value;
        let ship_add = document.getElementById('ship_add').value;
        let ship_city = document.getElementById('ship_city').value;
        let ship_state = document.getElementById('ship_state').value;
        let ship_postcode = document.getElementById('ship_postcode').value;
        let ship_country = document.getElementById('ship_country').value;
        let ship_phone = document.getElementById('ship_phone').value;

        let postBody = {
            "cust_name": cust_name,
            "cust_add": cust_add,
            "cust_city": cust_city,
            "cust_state": cust_state,
            "cust_postcode": cust_postcode,
            "cust_country": cust_country,
            "cust_phone": cust_phone,
            "ship_name": ship_name,
            "ship_add": ship_add,
            "ship_city": ship_city,
            "ship_state": ship_state,
            "ship_postcode": ship_postcode,
            "ship_country": ship_country,
            "ship_phone": ship_phone
        }


        $(".preloader").delay(90).fadeIn(100).removeClass('loaded');

        let res = await axios.post("/profile", postBody);

        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        if (res.data['msg'] === "success") {
            successToast("Update Successful")
        } else {
            errorToast("Something Went Wrong")
        }

    }

    async function profileDetails() {
        let res = await axios.get("/userProfile");
        if (res.data['data'] !== null) {

            document.getElementById('cust_name').value = res.data['data']['cust_name']
            document.getElementById('cust_add').value = res.data['data']['cust_add']
            document.getElementById('cust_city').value = res.data['data']['cust_city']
            document.getElementById('cust_state').value = res.data['data']['cust_state']
            document.getElementById('cust_postcode').value = res.data['data']['cust_postcode']
            document.getElementById('cust_phone').value = res.data['data']['cust_phone']
            document.getElementById('cust_country').value = res.data['data']['cust_country']
            document.getElementById('ship_name').value = res.data['data']['ship_name']
            document.getElementById('ship_add').value = res.data['data']['ship_add']
            document.getElementById('ship_city').value = res.data['data']['ship_city']
            document.getElementById('ship_state').value = res.data['data']['ship_state']
            document.getElementById('ship_postcode').value = res.data['data']['ship_postcode']
            document.getElementById('ship_country').value = res.data['data']['ship_country']
            document.getElementById('ship_phone').value = res.data['data']['ship_phone']
        }
    }
</script>
