<template>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	 <!-- this will be displayed upon successful submission of form -->
        <div v-if="isNewUserAdded" class="alert alert-success">
            User added successfully!
        </div>
		<user-form>
			</user-form>
	</div>
</div>
</template>
<script>
import UserForm from '../components/user/UserForm'
    export default {
		components: {
    'user-form': UserForm
  },
    	data() {
    		return {
				formErrors: [],
				isFormValid: false,
				isNewUserAdded: false,
				user: {
					first_name: null,
					last_name: null,
					display_name: null,
					email: null,
					password: null,
					password_confirmation: null
				}
    		}
    	},
		
}
</script>