<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Verification</h3>
                        </div>
                        <div class="form-group mb-3">
                            <input id="code" type="text" required="" class="form-control" name="email"
                                placeholder="Verification Code">
                        </div>
                        <div class="form-group mb-3">
                            <button onclick="verify()" type="submit" class="btn btn-fill-out btn-block"
                                name="login">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    async function verify() {
        try {
            let code = document.getElementById('code').value;
            let email = sessionStorage.getItem('email');

            if (code.length === 0) {
                errorToast("Code Required");
            } else if (code.length < 6) {
                errorToast("Code Must be 6 digits");
            } else {
                $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
                let res = await axios.get("/verify/" + email + "/" + code);
                console.log(res);
                if (res.status === 200) {
                    if (sessionStorage.getItem("last_location")) {
                        successToast("Login Successful");
                        setTimeout(function() {
                            window.location.href = sessionStorage.getItem("last_location");
                        }, 1000);

                    } else {
                        successToast("Login Successful");
                        setTimeout(function() {
                            window.location.href = "/";
                        }, 1000);
                    }
                }
            }
        } catch (e) {
            if (e.response.status === 401) {
                errorToast("Request Failed");
                $(".preloader").delay(90).fadeOut(100).removeClass('loaded');
                setTimeout(function() {
                    sessionStorage.clear();
                    window.location.href = "/login";
                }, 1500);
            }
        }
    }
</script>
