<template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <img :src="image" class="img-responsive">
            </div>
            <div class="col-md-8">
                <!-- <input type="file" 
                    multiple :name="uploadFieldName" 
                    :disabled="isSaving" 
                    @change="filesChange($event.target.name, $event.target.files); 
                    fileCount = $event.target.files.length" 
                    accept="image/*" 
                    class="input-file"> -->
                <input type="file" v-on:change="onFileChange" class="form-control">
            </div>
        </div>
    </div>
</template>
<style scoped>
    img{
        max-height: 36px;
    }
</style>
<script>
    export default{
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                this.image = file;
                reader.readAsDataURL(this.image);
                this.$emit('onFileUpload', this.image);
            },
            // upload(){
            //     axios.post('/user/upload',{image: this.image}).then(response => {

            //     });
            // }
        }
    }
</script>