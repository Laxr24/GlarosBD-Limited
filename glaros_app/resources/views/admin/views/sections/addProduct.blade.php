    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper tab-4">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Add product</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="max-w-lg mx-auto md:border md:border-gray-200 px-2 py-4 rounded-md">
                <form class="px-3 md:px-2">
                    <label for="text"
                        class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Product
                        name</label>
                    <input type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Product name">



                    <label for="message"
                        class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Product
                        description</label>
                    <textarea id="description" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Leave a comment..."></textarea>


                    <label class="mt-4 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        for="user_avatar">Select product photo</label>
                    <input
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="user_avatar_help" id="image" type="file">


                    <fieldset class="my-4">
                        <legend class="sr-only">Post side</legend>

                        <div class="flex items-center mb-2">
                            <input id="" type="radio" name="side" value="true"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                aria-labelledby="country-option-1" aria-describedby="country-option-1" checked>
                            <label for="country-option-1"
                                class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Left
                            </label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input id="" type="radio" name="side" value="false"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                aria-labelledby="country-option-1" aria-describedby="country-option-1" checked>
                            <label for="country-option-1"
                                class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Right
                            </label>
                        </div>

                      </fieldset>

                      <button onclick="addProduct()" class="px-4 py-2 rounded-md shadow-md bg-gradient-to-br from-green-300 to-green-200">Add product</button>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<script>
function addProduct(){
 this.window.event.preventDefault()

 let name = document.querySelector("#name")
 let description = document.querySelector("#description")
 let image = document.querySelector("#image").files[0]
 let postOrientation = document.querySelector('input[name="side"]:checked');


  let formData = new FormData(); 

  formData.append("name",name.value || Date.now())
  formData.append("description", description.value)
  formData.append("image", image)
  formData.append("side", postOrientation.value)

  name.value = ""
  description.value = ""
  image= ""
  postOrientation.value = "true"
  

  axios.post("/api/addproduct",formData, {headers: { "Content-Type": "multipart/form-data" }},).then((res)=>{
    console.log(res.data)
  }).catch((e)=>{
    console.error(e)
  })

}

</script>