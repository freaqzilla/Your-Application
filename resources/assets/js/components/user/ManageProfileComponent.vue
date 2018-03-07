<template>
<!--  prevent the page from refreshing after submission -->
		<form role="form"  @submit="updateProfile" method="POST" action="user/edit-profile" novalidate>
		<input type="hidden" name="_token" :value="$csrf_token">
			<h2>Manage Profile <small></small></h2>
			<!-- add Bootstrap .has-error if title field has errors -->
			<div class="alert alert-danger" v-if="formErrors.length > 0">
				<ul>
					<li v-for="error in formErrors">{{ error }}</li>
				</ul>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group" :class="{'input': true, 'has-error': errors.has('first_name') }">
						<input type="text" name="first_name" v-validate="'required'" required minlength="3" v-model="user.first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
						<span v-show="errors.has('first_name')" class="help-block">{{ errors.first('first_name') }}</span>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group" :class="{'input': true, 'has-error': errors.has('last_name') }">
						<input type="text" name="last_name" v-model="user.last_name" v-validate="'required'" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
						<span v-show="errors.has('last_name')" class="help-block">{{ errors.first('last_name') }}</span>
					</div>
				</div>
			</div>
			<div class="form-group" :class="{'input': true, 'has-error': errors.has('display_name') }">
				<input type="text" data-vv-as="Display Name" name="display_name" id="display_name" v-validate="'required'" v-model="user.display_name" class="form-control input-lg" placeholder="Display Name" tabindex="3">
				<span v-show="errors.has('display_name')" class="help-block">{{ errors.first('display_name') }}</span>
			</div>
			<div class="form-group" :class="{'input': true, 'has-error': errors.has('email') }">
				<input type="email" name="email" v-validate="'required|email'"  id="email" class="form-control input-lg" v-model="user.email" placeholder="Email Address" tabindex="4">
				<span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
			</div>
			<file-upload @onFileUpload="handleFileAfterUpload"></file-upload>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<input type="submit" value="Save" class="btn btn-primary btn-block btn-lg" tabindex="7">
				</div>
			</div>
		</form>
		</template>
		<script>
		import FileUpload from '../../components/FileUpload'
export default {
  data() {
    return {
      searchText: "",
			user: {},
			image: {},
      selectedOption: null,
      open: false,
      formErrors: [],
      highlightIndex: 0,
      lastSearchText: ""
    };
  },
  created() {
	},
	components: {
    'file-upload': FileUpload
  },

  methods: {
    updateProfile: function(e) {
			let formData = new FormData();
			var userDetails = JSON.stringify(this.user);
			formData.append('image', this.image);
			formData.append('data', userDetails);
      this.formErrors = [];
      this.isNewUserAdded = false;
      this.$validator.validateAll().then((result) => {
      	if (result) {
					const config = {
						headers: { 'Content-Type': 'multipart/form-data' }
        	}
					console.log(this.user.image);
      		var formAction = e.target.action;
      		axios.post(formAction,
      		formData, config)
      		.then((response) => {
      			this.isNewUserAdded = true;
      			// window.location = response.data.redirect;
      		})
      		.catch((error) => {
      			var errors = [];
      			$.each(error.response.data.errors, function(fieldName, error)
      			{
      				errors.push(error[0]);
      			});
      			this.formErrors = errors;
      			this.isNewUserAdded = false;
      		});
      	}
      	event.preventDefault();
      })
		},
		handleFileAfterUpload(file) {
			this.image = file;
			
		}
  }
};
</script>