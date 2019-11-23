var app = new Vue({
 el:"#vueapp",
 data : {
 	name: '',
 	email: '',
 	country: '',
 	job: '',
 	city : '',
 	contacts : []
 },
 mounted : function(){
	 console.log("Hello from Binayak");
	 
 	this.getContacts();

 },
 methods : {
 	 getContacts: function(){
		  const vm = this;
			  axios.get('api/contact.php')
			  .then(function (response) {
 	 			console.log(response.data);
				vm.contacts = response.data;
 	 		})
 	 		.catch(function(err) {console.log(err)});
 	},
 	createContact : function(){
		 const vm = this;
 		  let formData = new FormData();
 			console.log("Create Contact");
 			
 			formData.append('name',this.name);
 			formData.append('email',this.email);
 			formData.append('country',this.country);
 			formData.append('job',this.job);
 			formData.append('city',this.city);

 			var contact = {};
 			formData.forEach(function(key, value){
 					contact[key] = value;
 			});

 			axios({
 				method : "POST",
 				url: "api/contact.php",
 				data: formData,
 				config: { headers: {'Content-Type': 'multipart/form-data' }}
 				
 			})
 			.then(function(response){
 					console.log(response);
 					vm.contacts.push(response.data);
 					vm.resetForm();
 			})
 			.catch(function(err){ console.log(err); })
 	},
 	resetForm : function(){
		 const vm = this;
 				vm.name = '',
 				vm.email = '',
 				vm.country = '',
 				vm.city = '',
 				vm.job = ''
 	}

 }
});