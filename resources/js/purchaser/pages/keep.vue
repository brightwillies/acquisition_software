<div class="row">
    <div class="col-lg-4">File </div>
    <div class="col-lg-6">Enter File Name</div>
    <div class="col-lg-2"> Delete</div>
</div>

    <div style="margin-bottom:20px;" v-for="(file, key) in files" :key="key" class="row">
        <div class="col-lg-4"> {{ file.name }}</div>
        <div class="col-lg-6"> <input type="text"> </div>

        <div class="col-lg-2">
            <i v-on:click="removeFile(key)" class="fas fa-fw fa-trash"></i>
        </div>

    </div>


