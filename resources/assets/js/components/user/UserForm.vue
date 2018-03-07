<template>
	<form role="form"  @submit="registerUser" method="POST" novalidate>
		<input type="hidden" name="_token" :value="$csrf_token">
		<h2>Please Sign Up <small>It's free and always will be.</small></h2>
		<div class="alert alert-danger" v-if="formErrors.length > 0">
			<ul>
				<li v-for="error in formErrors">{{ error }}</li>
			</ul>
		</div>
		<div v-if="isNewUserAdded" class="alert alert-success">
					{{response}}
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-12">
				<div class="form-group" :class="{'input': true, 'has-error': errors.has('name') }">
					<input type="text" name="name" v-validate="'required'" required minlength="3" v-model="user.name" id="name" class="form-control input-lg" placeholder="First Name" tabindex="1">
					<span v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</span>
				</div>
			</div>
		</div>
		<div class="form-group" :class="{'input': true, 'has-error': errors.has('email') }">
			<input type="email" name="email" v-validate="'required|email'"  id="email" class="form-control input-lg" v-model="user.email" placeholder="Email Address" tabindex="4">
			<span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
		</div>
		<div class="form-group" :class="{'input': true, 'has-error': errors.has('address') }">
				<input type="text" data-vv-as="Address" name="address" id="address" v-validate="'required'" v-model="user.address" class="form-control input-lg" placeholder="Address" tabindex="3">
				<span v-show="errors.has('address')" class="help-block">{{ errors.first('address') }}</span>
			</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group" :class="{'input': true, 'has-error': errors.has('password') }">
					<input type="password" v-validate="'required'" name="password" v-model="user.password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
					<span v-show="errors.has('password')" class="help-block">{{ errors.first('password') }}</span>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group" :class="{'input': true, 'has-error': errors.has('password_confirmation') }">
					<input type="password" v-validate="'required'" name="password_confirmation" v-model="user.password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					<span v-show="errors.has('password_confirmation')" class="help-block">{{ errors.first('password_confirmation') }}</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
			</div>
			<div class="col-xs-12 col-md-6">
				<a href="/login" class="btn btn-success btn-block btn-lg">Sign In</a>
			</div>
		</div>
	</form>
</template>

<script>
export default {
  data() {
    return {
      user: {},
			response: '',
			isNewUserAdded: false,
      formErrors: []
    };
  },
  methods: {
    registerUser: function(e) {
      this.formErrors = [];
      this.isNewUserAdded = false;
      this.$validator.validateAll().then((result) => {
      	if (result) {
      		var formAction = e.target.action;

					// submit form
      		axios.post(formAction, this.user)
      		.then((response) => {
						if (response.data && response.data.success) {
							this.isNewUserAdded = true;
							this.response = response.data.message;
						}
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
    }
  }
};
</script>