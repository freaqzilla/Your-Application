<template>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<user-form :action="formAction" :my-object="myObject">
		</user-form>
	</div>
</div>
</template>
<script>
import UserForm from '../../components/user/UserForm'
export default {
  data() {
    return {
      user: null,
      formAction: '/admin/edit-user'
    }
  },
  computed: {
    myObject: function() { 
      var userToBeEdited;
      userToBeEdited = this.fetchData();

      }
  },
  methods: {
          fetchData() {
            axios.get('/admin/get-user/' + userId)
                .then(response => {
                    this.user = response.data;
            });
          }
      },
  components: {
    'user-form': UserForm
  }
};
</script>