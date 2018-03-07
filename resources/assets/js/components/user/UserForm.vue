<template>
<!--  prevent the page from refreshing after submission -->
		<form role="form"  @submit="registerUser" method="POST" novalidate>
		<input type="hidden" name="_token" :value="$csrf_token">
			<h2>Please Sign Up <small>It's free and always will be.</small></h2>
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
				<div class="col-xs-12 col-sm-12 col-md-12">
					 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
				</div>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
				</div>
				<div class="col-xs-12 col-md-6">
					<a href="#" class="btn btn-success btn-block btn-lg">Sign In</a>
				</div>
			</div>
			<input type="hidden" value="" class="btn btn-primary btn-block btn-lg" tabindex="7">
		</form>
		</template>
		<script>
export default {
  data() {
    return {
      searchText: "",
      user: {},
      selectedOption: null,
      open: false,
      formErrors: [],
      highlightIndex: 0,
      lastSearchText: ""
    };
  },
  props: {
    myObject: Object
  },
  created() {
	  console.log(this.myObject);
    if (this.myObject) {
    //   console.log(this.myObject.first_name);
    }
  },

  methods: {
    registerUser: function(e) {
      this.formErrors = [];
      this.isNewUserAdded = false;
      this.$validator.validateAll().then((result) => {
      	if (result) {
      		var formAction = e.target.action;
      		axios.post(formAction,
      		this.user)
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
    }
  }
};
</script>