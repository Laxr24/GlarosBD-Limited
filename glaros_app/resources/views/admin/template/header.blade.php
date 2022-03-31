<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>🌏 Dashboard | {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('public/admin/asset/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('public/admin/asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/admin/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('public/admin/asset/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/asset/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('public/admin/asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/admin/asset/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/admin/asset/plugins/summernote/summernote-bs4.min.css') }}">

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"
        integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"
        integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <script>
        function tabMaker(tabName, closeFirstSection = false) {
            //prefix for controlling
            var containerName = tabName;

            // All classes included using the pefix
            var allClasses = [];

            // all elements in the webpage
            var allElements = document.querySelectorAll('*');

            //Storing all the used classes using the prefix including btns
            for (var i = 0; i < allElements.length; i++) {
                var classes = allElements[i].className.toString().split(/\s+/);
                for (var j = 0; j < classes.length; j++) {
                    var cls = classes[j];
                    if (cls && allClasses.indexOf(cls) === -1)
                        if (!cls.search(containerName)) {
                            allClasses.push(cls);
                        }
                }
            }

            var foundClasses = allClasses;


            // Storing only the tab container classes
            var tabContainerClass = [];
            //Storing only the button classes
            var tabBtnClass = [];


            // query and separate classnames container - buttons
            foundClasses.forEach(name => {
                if (name.search(containerName + "-btn")) {
                    tabContainerClass.push(name)
                } else if (name.search(containerName + name.replace(containerName + "-btn-", ""))) {
                    tabBtnClass.push(name)
                }
            });



            for (let i = 0; i < tabContainerClass.length; i++) {

                // if 2nd param is true the hide the first content 
                if (i != 0 || closeFirstSection != false) {
                    let singleContainer = document.querySelector("." + tabContainerClass[i]);
                    singleContainer.style.display = "none"
                }
            }

            // Each button takes actions
            tabBtnClass.forEach(btn => {

                // Adding event listener fucntion to all buttons
                document.querySelector(`.${btn}`).addEventListener("click", (e) => {
                    // Hide all athe container first
                    for (let i = 0; i < tabContainerClass.length; i++) {
                        let singleContainer = document.querySelector("." + tabContainerClass[i]);
                        singleContainer.style.display = "none"
                        document.querySelector(`.${btn}`).classList.remove("active")
                    }
                    // Removing all active class from buttons
                    for (let i = 0; i < tabBtnClass.length; i++) {
                        document.querySelector("." + tabBtnClass[i]).classList.remove("active")
                        console.log(tabBtnClass[i])
                    }
                    // Then find and select, then display the desired container 
                    let targetContainerClass = btn.replace("-btn", "")
                    let targetContainer = document.querySelector(`.${targetContainerClass}`);
                    targetContainer.style.display = "block"
                    e.target.classList.add("active")
                })
            });




        }


        /*
        This funciton creates a toast with given params
        */
        function Toast(message, time, toastType = null) {
            let div = document.createElement("div")
            let msg = document.createElement("p")


            // userPreferance
            let toastBG, toastContent
            switch (toastType) {
                case "warning":
                    toastBG = "yellow"
                    toastContent = "black"
                    break;
                case "danger":
                    toastBG = "red"
                    toastContent = "white"
                    break;
                default:
                    toastBG = "rgb(46, 150, 46)"
                    toastContent = "white"
                    break;
            }
            // Toast style
            div.style.width = "inherit"
            div.style.borderRadius = "5px 0 0 5px"
            div.style.position = "absolute"
            div.style.top = "10vh"
            div.style.right = "0"
            div.style.padding = "8px 14px 8px 14px"
            div.style.backgroundColor = toastBG
            div.style.color = toastContent
            div.style.boxShadow = "-1px 3px 8px -3px #0000006e"


            div.appendChild(msg)
            msg.innerText = message
            document.body.appendChild(div)



            setInterval(() => {
                div.remove()
            }, time);
        }
    </script>
