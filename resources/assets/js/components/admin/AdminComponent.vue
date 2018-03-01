<template>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(user, key) in allUsers">
      <th scope="row">{{key + 1}}.</th>
      <td><a :href="'/admin/update-user/'+user.id">{{ user.name}}</a></td>
      <td>{{ user.email}}</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
        <ul>
            
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