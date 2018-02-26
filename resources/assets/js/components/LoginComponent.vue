<template>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	 <!-- this will be displayed upon successful submission of form -->
        <div v-if="isUserLoggedIn" class="alert alert-success">
            User logged in successfully!
        </div>
    	<!--  prevent the page from refreshing after submission -->
		<form role="form"  @submit.prevent="loginUser" action="/login" method="POST" novalidate>
			<h2>Please Login</h2>
			<!-- add Bootstrap .has-error if title field has errors -->
			<div class="alert alert-danger" v-if="formErrors.length > 0">
				<ul>
					<li v-for="error in formErrors">{{ error }}</li>
				</ul>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group" :class="{'input': true, 'has-error': errors.has('email') }">
				<input type="email" name="email" v-validate="'required|email'"  id="email" class="form-control input-lg" v-model="user.email" placeholder="Email Address" tabindex="4">
				<span v-show="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
			</div>
			</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group" :class="{'input': true, 'has-error': errors.has('password') }">
						<input type="password" v-validate="'required'" name="password" v-model="user.password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
						<span v-show="errors.has('password')" class="help-block">{{ errors.first('password') }}</span>
					</div>
				</div>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<input type="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="7">
				</div>
			</div>
		</form>
	</div>
</div>
</template>

<script>
    export default {
    	data() {
    		return {
				formErrors: [],
				isFormValid: false,
				isUserLoggedIn: false,
				user: {
					email: null,
					password: null
				}
    		}
    	},
		methods: {
			loginUser: function(e) {
				var errors = [];
				this.formErrors = [];
				this.isUserLoggedIn = false;
				this.$validator.validateAll().then((result) => {
					if (result) {
						var formAction = e.target.action;
						axios.post(formAction, 
    					this.user)
						.then((response) => {
							this.isUserLoggedIn = true;
							window.location = response.data.redirect;
						})
						.catch((error) => {
							var errors = [];
							$.each(error.response.data.errors, function(fieldName, error)
							{
								errors.push(error[0]);
							});
							this.formErrors = errors;
							this.isUserLoggedIn = false;
						});
					}
				})
				
			}
		}
}
</script>