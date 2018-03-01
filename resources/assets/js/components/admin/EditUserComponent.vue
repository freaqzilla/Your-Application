<template>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<user-form>
		</user-form>
	</div>
</div>
</template>
<script>
import UserForm from '../../components/user/UserForm'
export default {
  components: {
    'user-form': UserForm
  }
};
</script>