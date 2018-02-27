<template>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <ul>
            <a v-for="user in allUsers" :href="'/admin/update-user/'+user.id"><li>{{ user.name}}</li></a>
        </ul>
	</div>
</div>
</template>
<script>
export default {
  data() {
    return {
      allUsers: null
    };
  },
  created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.users = null;
            this.loading = true;
            axios.get('/admin/get-all-users')
                .then(response => {
                    this.allUsers = response.data;
            });
        }
    }
};
</script>