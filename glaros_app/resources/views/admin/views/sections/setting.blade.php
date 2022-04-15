    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper tab-2">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Theme settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Theme settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container pt-4 ">
                <p class="font-mono uppercase text-blue-800 text-center p-2">Showing content of: Theme file<span
                        class="text-green-200" id="showFileName"></span></p>
                <textarea id="fileContent"
                    class="p-2 w-full  font-mono tracking-wider border-none outline-none rounded-md text-white bg-gray-700"
                    rows="20">
                    @if ($code)
                    {{ $code }} 
                @endif
                </textarea>
                <button class="rounded-md bg-gradient-to-br from-green-400 to-green-300 px-4 py-2 m-2"
                    onclick="updatePage()">Update</button>
                <button class="rounded-md bg-gradient-to-br from-yellow-400 to-yellow-300 px-4 py-2 m-2" onclick="rst()"
                    id="rstBtn">Reset</button>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <script>
        var rstBtn = document.getElementById("rstBtn");
        var rstData = "";
        var content = document.getElementById("fileContent");

        function updatePage() {
            axios.post("/api/updateHomepage", {
                "content": content.value
            }).then((res) => {
                console.log(res.data)
                if (res.status == 200) {
                    Toast("Updated", 2000)
                    content.value = res.data
                    rstData = res.data
                } else {
                    Toast("Some server side error happedend", 2000, "warning")
                }
            }).catch((e) => {
                Toast("Error!", 2000, "danger")
            })

        }

        function rst(){
            content.value = rstData
            Toast("Theme was reset!", 2000, "warning")
        }

    </script>
