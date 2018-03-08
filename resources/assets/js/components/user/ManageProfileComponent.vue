<template>
<!--  prevent the page from refreshing after submission -->
		<form role="form"  @submit="updateProfile" method="POST" action="/user/edit-profile" novalidate>
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
					<div class="form-group" :class="{'input': true, 'has-error': errors.has('name') }">
						<input type="text" name="name" v-validate="'required'" required minlength="3" v-model="user.name" id="name" class="form-control input-lg" placeholder="First Name" tabindex="1">
						<span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
					</div>
				</div>
			</div>
			<div class="form-group" :class="{'input': true, 'has-error': errors.has('address') }">
				<input type="text" data-vv-as="Address" name="address" id="address" v-validate="'required'" v-model="user.address" class="form-control input-lg" placeholder="Address" tabindex="3">
				<span v-show="errors.has('address')" class="help-block">{{ errors.first('address') }}</span>
			</div>
			<div class="form-group" :class="{'input': true, 'has-error': errors.has('email') }">
				<input disabled type="email" name="email" v-validate="'required|email'"  id="email" class="form-control input-lg" v-model="user.email" placeholder="Email Address" tabindex="4">
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
			user: {},
			image: {},
      formErrors: []
    };
  },
  created() {
		this.fetchData();
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
		fetchData() {
			axios.get('/user/get-user')
					.then(response => {
						if (response.data && response.data.success) {
							this.user = response.data.user;
						}
						console.log(this.user);
							// this.allUsers = response.data;
			});
		},
		handleFileAfterUpload(file) {
			this.image = file;	
		}
  }
};
</script>