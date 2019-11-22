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
 	 		axios.get('api/contact.php').
 	 		then(function(response){	
 	 			console.log(response.data);
 	 			this.contacts = response.data;
 	 		})
 	 		.catch(err => console.log(err));
 	},
 	createContact : function(){
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
 					app.contacts.push(contact);
 					app.resetForm();
 			})
 			.catch(function(err){ console.log(err); })
 	},
 	resetForm : function(){
 				this.name = '',
 				this.email = '',
 				this.country = '',
 				this.city = '',
 				this.job = ''
 	}

 }
});