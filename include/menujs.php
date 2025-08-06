<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script id="rendered-js">
    feather.replace();
    function dropdownMenu() {
        var containerID = document.getElementById("dropdownContainerD"),
            btnSigninID = document.getElementById("btnSignin"),
            menuRightIcon = document.getElementsByClassName("menu-right-icon");

        /** Show/Hide dropdown menu */
        containerID.classList.toggle("show");

        /** Show/Hide Signin button */
        btnSigninID.classList.toggle("show");
        window.CP.exitedLoop(0);
    }
</script>