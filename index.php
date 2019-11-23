<!DOCTYPE html>
<html>
<head>
	<title>Php Crud App</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
	<div class='container'>
 <h1> Contact Management System </h1>
 <div id="vueapp">
 	<table class="table table-responsive table-strip">
 		<tr>
 		<td>Name </td>
 		<td>Email </td>
 		<td> Country </td>
 		<td> City </td>
 		<td> Job </td>
		</tr>

		<tr v-for="contact in contacts" v-bind:key="contact.id">
			<td>{{ contact.name }}</td>
			<td>{{ contact.email }}</td>
			<td>{{ contact.country }}</td>
			<td>{{ contact.city }}</td>
			<td>{{ contact.job }}</td>

		</tr>
 	</table>

 	</br>

    <form>
      <label>Name</label>
      <input type="text" name="name" class='form-control' v-model="name">
      
      <label>Email</label>
      <input type="email" name="email" class='form-control'  v-model="email">
      
      <label>Country</label>
      <input type="text" name="country" class='form-control' v-model="country">
      
      <label>City</label>
      <input type="text" name="city" class='form-control' v-model="city">
      
      <label>Job</label>
      <input type="text" name="job" class='form-control' v-model="job">
      
     <input type="button" @click="createContact()" value="Add">
    </form>

</div>

 </div>
</div>

</body>
<script src='main.js'></script>
</html>